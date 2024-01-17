$(function () {
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host;

    var table = null;

    if($('.tableServerSide').length != 0){
        table = $('.tableServerSide').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/dpd/list",
                data: function (d) {
                    d.provinsi = $(".filterProvince").val();
                    d.search = $('.searchTable').val()
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'provinsi', name: 'provinsi'},
                {data: 'name', name: 'name'},
                {data: 'branch_total', name: 'branch_total'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            fnDrawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
            language: {
                emptyTable: "<div class='d-flex flex-column flex-center'>"+
                "<img src="+baseUrl+"/assets/media/illustrations/sketchy-1/5.png class='mw-400px'>"+
                "<div class='fs-1 fw-bolder text-dark mb-4'>"+emptyData+"</div>"+
                "<div class='fs-6'>"+emptyDataDesc+"</div></div>",
                zeroRecords : "<div class='d-flex flex-column flex-center'>"+
                "<img src="+baseUrl+"/assets/media/illustrations/sketchy-1/5.png class='mw-400px'>"+
                "<div class='fs-1 fw-bolder text-dark mb-4'>"+emptyData+"</div>"+
                "<div class='fs-6'>"+emptySearch+"</div></div>"
            },
        });

        $(".searchTable").keyup(function(){
            table.draw();
        });

        $(".btnfilter").click(function(){
            table.draw();
        });

        $(".btnclear").click(function(){
            $(".filterProvince").val(null).trigger('change');
        });

        // Hook export buttons
        exportButtons = () => {
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
        
        exportButtons();
    }

    $("#province").change(function(){
        var value = $("#province option:selected").text();
        $("#name").val(value)
    })

    $(document).on("submit", "#form_add", function(e) {
        var url = "/dpd/store";
        var form_data = $("#form_add").serializeArray();

        var locale = $('html').attr('lang');
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host;
        var jsonfile = baseUrl+'/assets/'+locale+'.json';

        $.getJSON(jsonfile, function(json) {
            Swal.fire({
                title: json.title_alert_confirm,
                text: json.text_alert_pbl, 
                icon: "warning",
                showCancelButton: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                confirmButtonText: json.btn_alert_confirm,
                cancelButtonText: json.btn_alert_cancel,
            })
            .then(function(result){
                if(result.value){
                    Swal.fire({
                        title: json.title_alert_process,
                        text: json.text_alert_process,
                        showConfirmButton: false, //hide OK button
                        allowOutsideClick: false, //optional, disable outside click for close the modal
                        icon: "info"
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: form_data,
                        url: url,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status) {
                                Swal.fire({
                                    title: json.title_alert_success,
                                    text: data.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: json.btn_alert_ok,
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    window.location.replace("/dpd/index");
                                });
                            } else {
                                Swal.fire({
                                    title: json.title_alert_failed,
                                    text: data.message,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: json.btn_alert_ok,
                                    customClass: {
                                        confirmButton: "btn btn-danger"
                                    }
                                });
                            }
                        }
                    });
                }
            })
        });

        return false;
    });

    $(document).on("submit", "#form_edit", function(e) {
        var id = $('#dpd_id').val();
        var url = "/dpd/update/"+id;
        var form_data = $("#form_edit").serializeArray();

        var locale = $('html').attr('lang');
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host;
        var jsonfile = baseUrl+'/assets/'+locale+'.json';

        $.getJSON(jsonfile, function(json) {
            Swal.fire({
                title: json.title_alert_confirm,
                text: json.text_alert_pbl, 
                icon: "warning",
                showCancelButton: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                confirmButtonText: json.btn_alert_confirm,
                cancelButtonText: json.btn_alert_cancel,
            })
            .then(function(result){
                if(result.value){
                    Swal.fire({
                        title: json.title_alert_process,
                        text: json.text_alert_process,
                        showConfirmButton: false, //hide OK button
                        allowOutsideClick: false, //optional, disable outside click for close the modal
                        icon: "info",
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: form_data,
                        url: url,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status) {
                                Swal.fire({
                                    title: json.title_alert_success,
                                    text: data.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: json.btn_alert_ok,
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    window.location.replace("/dpd/index");
                                });
                            } else {
                                Swal.fire({
                                    title: json.title_alert_failed,
                                    text: data.message,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: json.btn_alert_ok,
                                    customClass: {
                                        confirmButton: "btn btn-danger"
                                    }
                                });
                            }
                        }
                    });
                }
            })
        });

        return false;
    });

});