$(function () {
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host;
    var lang = $('html').attr('lang');
    
    var table = null;
    if($('.tableServerSide').length != 0){
        table = $('.tableServerSide').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/userlog/list",
                data: function (d) {
                    d.date_range = $("#date_range").val();
                    d.search = $('.searchTable').val();
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'role_name', name: 'role_name'},
                {data: 'description', name: 'description'},
                {data: 'action_date_str', name: 'action_date_str'},
            ],
            language: {
                emptyTable: `<div class="d-flex flex-column flex-center">
                    <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
                    <div class="fs-1 fw-bolder text-dark mb-4">`+lang1+`.</div>
                    <div class="fs-6">`+lang2+`</div>
                </div>`,
                zeroRecords : "<div class='d-flex flex-column flex-center'>"+
                "<img src="+baseUrl+"/assets/media/illustrations/sketchy-1/5.png class='mw-400px'>"+
                "<div class='fs-1 fw-bolder text-dark mb-4'>"+lang1+"</div>"+
                "<div class='fs-6'>"+lang3+"</div></div>"
            },
        });
    }

    // Handle clear flatpickr
    var handleClearFlatpickr = () => {
        const clearButton = document.querySelector('#kt_ecommerce_sales_flatpickr_clear');
        clearButton.addEventListener('click', e => {
            flatpickr.clear();
            table.draw();
        });
    }

    $(".searchTable").keyup(function(){
        table.draw();
    });
    
    // Init flatpickr --- more info :https://flatpickr.js.org/getting-started/
    var initFlatpickr = () => {
        var filterDate = $('#date_range');
        const element = document.querySelector('#date_range');
        flatpickr = $(element).flatpickr({
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
            locale: lang == 'en' ? 'default' : lang,
            mode: "range",
            onChange: function (selectedDates, dateStr, instance) {
                table.draw();
            }
        });
    }

    // Hook export buttons
    var exportButtons = () => {
        if (typeof langReportTitle !== 'undefined' ) {
            var documentTitle = langReportTitle;   
        
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        },
                        action: newexportaction
                    },
                    {
                        extend: 'csvHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        },
                        action: newexportaction
                    },
                    {
                        extend: 'pdfHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        },
                        action: newexportaction
                    }
                ]
            }).container().appendTo($('#kt_datatable_example_buttons'));
    
            // Hook dropdown menu click event to datatable export buttons
            const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();
    
                    // Get clicked export value
                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);
    
                    // Trigger click event on hidden datatable export buttons
                    target.click();
                });
            });
        }
    }

    function newexportaction (e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        dt.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = 2147483647;
            dt.one('preDraw', function (e, settings) {
                // Call the original action function
                if (button[0].className.indexOf('buttons-copy') >= 0) {
                    $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                    $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                    $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-print') >= 0) {
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
                dt.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });
                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(dt.ajax.reload, 0);
                // Prevent rendering of the full data to the DOM
                return false;
            });
        });
        // Requery the server with the new one-time export settings
        dt.ajax.reload();
    }

    initFlatpickr();
    handleClearFlatpickr();
    exportButtons();
});