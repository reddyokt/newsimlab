"use strict";

$(function(){
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host;
    var lang = $('html').attr('lang');
    var table = null;
    if($('.tableServerSide').length != 0){
        table = $('.tableServerSide').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/validationregister/list",
                data: function (d) {
                    d.search = $('.searchTable').val();
                    d.status = $('.filterStatus').val();
                    d.date_range = $('#date_range').val();
                    if($('.filterDpc').length != 0){
                        d.dpc = $('.filterDpc').val();
                    }
                    if($('.filterDpd').length != 0){
                        d.dpd = $('.filterDpd').val();
                    }
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'registration_date_str', name: 'registration_date_str'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'dpd_dpc', name: 'dpd_dpc'},
                {
                    data: 'registration_status_str', 
                    name: 'registration_status_str',
                    render: function(data, type, full, meta) {
                        var str = '';
                        str = '<div class="badge badge-light-'+full.color+'">'+full.registration_status_str+'</div>';
                        return str;
                    }
                },
                {data: 'action', name: 'action', orderable:false, searchable:false},
            ],
            fnDrawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
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
            }
        });
    }

    $(document).on('click', '.sendreminder', function(e) {
        var data_id = $(this).attr("data-id");
        var url = "/validationregister/resend-payment/" + data_id;
        e.preventDefault(); //cancel default action
        var locale = $('html').attr('lang');
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host;
        var jsonfile = baseUrl+'/assets/'+locale+'.json';
        $.getJSON(jsonfile, function(json) {
            Swal.fire({
                title: json.title_alert_confirm,
                text: json.text_alert_send, 
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
                        type: 'GET',
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
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: json.title_alert_failed,
                                    text: json.text_alert_failed,
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
    });

    $(document).on('click', '.delete', function(e) {
        var data_id = $(this).attr("data-id");
        var url = "/validationregister/delete/" + data_id;
        e.preventDefault(); //cancel default action
        var locale = $('html').attr('lang');
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host;
        var jsonfile = baseUrl+'/assets/'+locale+'.json';
        $.getJSON(jsonfile, function(json) {
            Swal.fire({
                title: json.title_alert_confirm,
                text: json.text_alert_delete_pbl, 
                icon: "warning",
                showCancelButton: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                confirmButtonText: json.btn_alert_delete,
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
                        type: 'GET',
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
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: json.title_alert_failed,
                                    text: json.text_alert_failed,
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
    });

    var pathname = window.location.pathname;
    var flatpickr;
    
    if (pathname != "/validationregister/index") {
        $(document).ready(function(){
            //get detail first
            var id = $("#member_info_id").val()    
            loadContent(id, "detail", "#detail")
        })
    }

    function loadContent(id, content, idSubcontent) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/validationregister/detail/'+id,
            data: {content: content},
            beforeSend: function () {
                loaderPage(true)
            }, 
            success: function(data) { 
                setTimeout(function() {
                    loaderPage(false)
                    var oldActive = $('#tabmember li a.active').attr('id');
                    if (oldActive) {
                        $("#"+oldActive).removeClass('active')
                    }
    
                    $(idSubcontent).addClass('active');
                    $("#details_view").html(data.view)
                }, 500);
            }
        });
    }
    
    function loaderPage(condition) {
        const loadingEl = document.createElement("div");
        document.body.prepend(loadingEl);
        loadingEl.classList.add("page-loader");
        loadingEl.classList.add("flex-column");
        loadingEl.classList.add("bg-dark");
        loadingEl.classList.add("bg-opacity-25");
        loadingEl.innerHTML = `
            <span class="spinner-border text-primary" role="status"></span>
            <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
        `;

        if (condition) {    
            // Show page loading
            KTApp.showPageLoading();
        } else {
            KTApp.hidePageLoading();
            loadingEl.remove();
        }
    }

    $(document).on("click", ".subcontent", function(){
        var id = $("#member_info_id").val()
        var idSubcontent = "#"+$(this).attr('id')
        var content = $(this).attr('id')

        loadContent(id, content, idSubcontent)
    });

    $(document).on('click', '.approve-decline', function (){
        var type = $(this).attr('data-type')
        var id = $("#member_info_id").val()
        var locale = $('html').attr('lang');
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host;
        var jsonfile = baseUrl+'/assets/'+locale+'.json';
        var url = "/validationregister/approveDecline/"+id;

        if (type == "approve") {
            $.getJSON(jsonfile, function(json) {
                Swal.fire({
                    title: json.title_alert_confirm,
                    text: json.text_alert_approve, 
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
                            data: {type: type},
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
                                        location.reload()
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
        } else if (type == "decline") {
            $.getJSON(jsonfile, function(json) {
                Swal.fire({
                    title: json.title_alert_confirm,
                    icon: "warning",
                    showCancelButton: true,
                    html: json.text_alert_decline+`<br/><textarea id="reject_notes" class="swal2-input" placeholder="Alasan Decline" rows="4"></textarea>`,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    },
                    confirmButtonText: json.btn_alert_confirm,
                    cancelButtonText: json.btn_alert_cancel,
                    preConfirm: () => {
                        const reject_notes = Swal.getPopup().querySelector('#reject_notes').value
                        if (!reject_notes) {
                            Swal.showValidationMessage(`Harap diisi alasan decline`)
                        }
                        return { reject_notes: reject_notes }
                    }
                })
                .then(function(result){
                    if(result.value){
                        var reject_notes = result.value.reject_notes
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
                            data: {type: type, reject_notes: reject_notes},
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
                                        location.reload()
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
        }
    });

    // Handle clear flatpickr
    var handleClearFlatpickr = () => {
        const clearButton = document.querySelector('#kt_ecommerce_sales_flatpickr_clear');
        clearButton.addEventListener('click', e => {
            flatpickr.clear();
        });
    }

    $(".searchTable").keyup(function(){
        table.draw();
    });

    $(".btnclear").click(function(){
        $(".filterStatus").val(null).trigger('change');
        if($('.filterDpd').length != 0){
            $(".filterDpd").val(null).trigger('change');
        }
        if($('.filterDpc').length != 0){
            $(".filterDpc").val(null).trigger('change');
        }
        flatpickr.clear();
        table.draw();
    });

    $(".btnfilter").click(function(){
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
            mode: "range"
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
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        },
                        action: newexportaction
                    },
                    {
                        extend: 'csvHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        },
                        action: newexportaction
                    },
                    {
                        extend: 'pdfHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
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
    initFlatpickr();
    handleClearFlatpickr();
});