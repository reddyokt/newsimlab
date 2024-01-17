//Other Settings
$(function(){
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host;

    $(document).on("submit", "#form_add", function(e) {
        var url = "/account/store";
        var form_data = $("#form_add").serializeArray();
        var bg_img = $('.image-input-wrapper').css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
        form_data.push({name: 'image', value: bg_img});

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
                                    window.location.replace("/account/index");
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
        var url = "/settings/update";
        var form_data = $("#form_edit").serializeArray();
        var bg_img1 = $('#ketua').css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
        var bg_img2 = $('#sekjen').css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
        form_data.push({name: 'file_ketua', value: bg_img1});
        form_data.push({name: 'file_sekjen', value: bg_img2});

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
                                    window.location.reload();
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
    
    $(document).on('click', '.delete', function(e) {
        var data_id = $(this).attr("data-id");
        var url = "/account/delete/" + data_id;
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

    if($('#nidn').length != 0)
		$('#nidn').mask('0000000000');

    $(document).on('click', '#btn_reset_password', function(e){
        var userRole = $(this).attr('data-userrole');
        var id = $(this).attr('data-id');
        var url = '/general/reset-password/'+userRole+'/'+id;
        var locale = $('html').attr('lang');
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host;
        var jsonfile = baseUrl+'/assets/'+locale+'.json';
        $.getJSON(jsonfile, function(json) {
            Swal.fire({
                title: json.title_alert_confirm,
                text: json.text_alert_reset, 
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
        
        return false;
    });

    $(document).on('keyup', '#username', function(){
        var val = $(this).val();
        val = val.replace(/\s+/g, '').toLowerCase();
        $(this).val(val);
    });

    $(document).on("submit", "#formUpload", function(e) {
        var url = "/master/accountmanagement/student/import";
        var form_data = new FormData($("#formUpload")[0]);

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
                        processData: false,
                        contentType: false,
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
                                    window.location.replace("/master/accountmanagement/student/index");
                                });
                            } else {
                                Swal.fire({
                                    title: json.title_alert_failed,
                                    text: data.message,
                                    icon: "warning",
                                    buttonsStyling: false,
                                    confirmButtonText: json.btn_alert_ok,
                                    customClass: {
                                        confirmButton: "btn btn-warning"
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

    $(document).on('change', '#role', function(){
        var val = $(this).val();

        if(val == 7)
            $('#rowproduct').hide();
        else
            $('#rowproduct').show();

    });

    // Define shared variables
    var datatable;
    var filterDate;
    var table

    // Private functions
    var initCustomerList = function () {
        // Set date data order
        const tableRows = table.querySelectorAll('tbody tr');

        // tableRows.forEach(row => {
        //     const dateRow = row.querySelectorAll('td');
        //     const realDate = moment(dateRow[5].innerHTML, "DD MMM YYYY, LT").format(); // select date from 5th column in table
        //     dateRow[5].setAttribute('data-order', realDate);
        // });

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
            ],
            'language': {
                emptyTable: `<div class="d-flex flex-column flex-center">
                    <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
                    <div class="fs-1 fw-bolder text-dark mb-4">`+lang1+`.</div>
                    <div class="fs-6">`+lang2+`</div>
                </div>`
            },
            conditionalPaging: true
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            KTMenu.init(); // reinit KTMenu instances 
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-customer-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();

            var countList = $('.listbody').find('tr').length;
            if (countList == 0) {
                $(".dataTables_empty").html(`<div class="d-flex flex-column flex-center">
                    <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
                    <div class="fs-1 fw-bolder text-dark">`+lang1+`.</div>
                    <div class="fs-6">`+lang2+`</div>
                </div>`)
            }
        });
    }

    // Hook export buttons
    var exportButtons = () => {
        const documentTitle = langReportTitle;
        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [
                {
                    extend: 'copyHtml5',
                    title: documentTitle,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: documentTitle,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: documentTitle,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: documentTitle,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
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

    table = document.querySelector('#kt_datatable');
            
    if (!table) {
        return;
    }

    initCustomerList();
    handleSearchDatatable();
    exportButtons();
});