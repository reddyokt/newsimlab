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
                url: "/member/list",
                data: function (d) {
                    d.search = $('.searchTable').val();
                    d.status = $('.filterStatus').val();
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
                {data: 'member_number', name: 'member_number'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'dpd_dpc', name: 'dpd_dpc'},
                {
                    data: 'membership_status_str', 
                    name: 'membership_status_str',
                    render: function(data, type, full, meta) {
                        var str = '';
                        str = '<div class="badge badge-light-'+full.color+'">'+full.membership_status_str+'</div>';
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

	$("#kt_datepicker_1").flatpickr();
	$("#kt_datepicker_2").flatpickr();

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
    
    $('#kt_table').on('click', '.editMember', function(){
		$('#kt_modal_1').modal('show');
        
        $('.year').mask('0000');
        $('.phone').mask('0000-0000-0000');
        $('.nik').mask('0000-0000-0000-0000');

        Inputmask({
            "mask" : "99/99"
        }).mask(".rt_rw");

        var id = $(this).attr('data-id');
        var url = '/member/getdataby/'+id;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(data) {
                var imageUrl = baseUrl+'/upload/member_files/photo/'+data.photo;
                $('#memberImg').css('background-image', 'url(' + imageUrl + ')');
                $('#memberId').val(data.id);
                $('#memberName').val(data.name);
                $('#memberPhone').val(data.phone_number);
                $('#memberEmail').val(data.email);
                $('#memberNik').val(data.nik);
                if(data.gender == 'male'){
                    $('#labelMale').addClass('active');
                    $('#memberGenderMale').attr('checked', true);
                }else{
                    $('#labelFemale').addClass('active');
                    $('#memberGenderFemale').attr('checked', true);
                }
                $('#memberReligion').val(data.religion).trigger("change");
                $('#memberNationality').val(''+data.country_id).trigger("change");
                $('#memberMaritalStatus').val(data.marital_status).trigger("change");
                $('#memberBirthPlace').val($("#memberBirthPlace option:contains('"+data.place_birth+"')").val()).trigger("change");
                $('#kt_datepicker_1').flatpickr({
                    dateFormat: "Y-m-d",
                    defaultDate: data.birth_date 
                });
                
                var selected = [];
                var initials = [];
                initials.push({id: data.villages_id, name: data.village_name});
                selected.push(data.villages_id);
                
                $('#domisili').select2({
                    // data: initials,
                    ajax: {
                        url: '/region',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                page: 10
                            }
                
                            // Query parameters will be ?search=[term]&page=[page]
                            return query;
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                    
                            return {
                                results: data.results,
                                pagination: {
                                    more: (params.page * 10) < data.count_filtered
                                }
                            };
                        },
                        cache: true
                    },
                    // templateResult: function (item) { return item.name; },
                    // templateSelection: function (item) { return item.name; },
                    // matcher: function(term, text) { return text.name.toUpperCase().indexOf(term.toUpperCase()) != -1; },
                });
                var newOption = new Option(data.village_name, data.villages_id, true, true);
                // Append it to the select
                $('#domisili').append(newOption).trigger('change');
                $('#memberRtRw').val(data.rt_rw);
                $('#memberAddress').val(data.address_detail);
            }
        });
		
		return false;
	});

    
    $('#kt_table').on('click', '.inactiveMember', function(){
		$('#kt_modal_2').modal('show');

        var id = $(this).attr('data-id');
        var url = '/member/getdataby/'+id;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(data) {
                $('#memberNameTxt').html(data.name);
                $('#memberNumberTxt').html(data.member_number);
                $('#memberId2').val(data.id);
            }
        });
		
		return false;
	});
    
	$(document).on('click', '#closeBtn', function(){
		$('#kt_modal_1').modal('hide');

		return false;
	});
    
	$(document).on('click', '#closeBtn2', function(){
		$('#kt_modal_2').modal('hide');

		return false;
	});

    $(document).on('submit', '#formEdit', function(){
        var url = '/member/update/'+$('#memberId').val();

        var form_data = new FormData($('#formEdit')[0]);
        var bg_img = $('.image-input-wrapper').css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
        form_data.append('image', bg_img);

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
                        processData: false,
                        contentType: false,
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

    $(document).on('submit', '#formDeactivate', function(){
        var url = '/member/updateinactive/'+$('#memberId2').val();

        var form_data = new FormData($('#formDeactivate')[0]);
        
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
                        processData: false,
                        contentType: false,
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

    $('#kt_table').on('click', '.generateMember', function(){
        var id = $(this).attr('data-id');
        var url = '/member/generate-card-manual/'+id;

        var locale = $('html').attr('lang');
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host;
        var jsonfile = baseUrl+'/assets/'+locale+'.json';

        $.getJSON(jsonfile, function(json) {
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
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response, status, xhr) {
                    Swal.fire({
                        title: json.title_alert_success,
                        text: json.text_alert_success_download,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: json.btn_alert_ok,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        },
                        allowOutsideClick : false
                    }).then(function () {
                        var filename = "card.pdf";
                        var disposition = xhr.getResponseHeader('Content-Disposition');
                        if (disposition && disposition.indexOf('attachment') !== -1) {
                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            var matches = filenameRegex.exec(disposition);
                            if (matches != null && matches[1]) { 
                              filename = matches[1].replace(/['"]/g, '');
                            }
                        }
                        var blob = new Blob([response]);
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;
                        link.click();
                    });
                }
            });
        });
		
		return false;
	});
});