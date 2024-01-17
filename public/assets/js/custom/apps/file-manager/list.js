"use strict";

// Class definition
var KTFileManagerList = function () {
    // Define shared variables
    var datatable;
    var table

    // Define template element variables
    var uploadTemplate;
    var renameTemplate;
    var actionTemplate;
    var checkboxTemplate;
    
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host;
    var hiddenPage = $('#ref_id').val();

    var locale = $('html').attr('lang');
    var jsonfile = baseUrl+'/assets/'+locale+'.json';

    // Private functions
    const initTemplates = () => {
        uploadTemplate = document.querySelector('[data-kt-filemanager-template="upload"]');
        renameTemplate = document.querySelector('[data-kt-filemanager-template="rename"]');
        actionTemplate = document.querySelector('[data-kt-filemanager-template="action"]');
        checkboxTemplate = document.querySelector('[data-kt-filemanager-template="checkbox"]');
    }

    const initDatatable = () => {
        // Set date data order
        const tableRows = table.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const dateRow = row.querySelectorAll('td');
            const dateCol = dateRow[3]; // select date from 4th column in table
            const realDate = moment(dateCol.innerHTML, "DD MMM YYYY, LT").format();
            dateCol.setAttribute('data-order', realDate);
        });

        const foldersListOptions = {
            "info": false,
            'order': [],
            "scrollY": "700px",
            "scrollCollapse": true,
            "paging": false,
            'ordering': false,
            'columns': [
                { data: 'checkbox' },
                { data: 'name' },
                { data: 'size' },
                { data: 'date' },
                { data: 'action' },
            ],
            'language': {
                emptyTable: `<div class="d-flex flex-column flex-center">
                    <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
                    <div class="fs-1 fw-bolder text-dark">`+lang1+`.</div>
                    <div class="fs-6">`+lang2+`</div>
                </div>`
            }
        };

        const filesListOptions = {
            "info": false,
            'order': [],
            'pageLength': 10,
            "lengthChange": false,
            'ordering': false,
            'columns': [
                { data: 'checkbox' },
                { data: 'name' },
                { data: 'size' },
                { data: 'date' },
                { data: 'action' },
            ],
            'language': {
                emptyTable: `<div class="d-flex flex-column flex-center">
                    <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
                    <div class="fs-1 fw-bolder text-dark mb-4">`+lang1+`.</div>
                    <div class="fs-6">`+lang2+`</div>
                </div>`
            },
            conditionalPaging: true
        };

        // Define datatable options to load
        var loadOptions;
        if (table.getAttribute('data-kt-filemanager-table') === 'folders') {
            loadOptions = foldersListOptions;
        } else {
            loadOptions = filesListOptions;
        }

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable(loadOptions);

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            initToggleToolbar();
            handleDeleteRows();
            toggleToolbars();
            resetNewFolder();
            KTMenu.createInstances();
            // initCopyLink();
            countTotalItems();
            handleRename();
        });
    }

    const reinitDatatable = (resp) => {
        // Set date data order
        const tableRows = table.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const dateRow = row.querySelectorAll('td');
            const dateCol = dateRow[3]; // select date from 4th column in table
            const realDate = moment(dateCol.innerHTML, "DD MMM YYYY, LT").format();
            dateCol.setAttribute('data-order', realDate);
        });

        var folderArr = [];
        var fileArr = [];

        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host;
        
        if(resp.length > 0){
            datatable.clear();
            for(var i=0;i<resp.length;i++){
                // var dt = [];
                if(resp[i].type == 'folder'){
                    var str = '';

                    str = '<div class="d-flex justify-content-end">'+
                        '<div class="ms-2">'+
                            '<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">'+
                                '<span class="svg-icon svg-icon-5 m-0">'+
                                    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                        '<rect x="10" y="10" width="4" height="4" rx="2" fill="currentColor" />'+
                                        '<rect x="17" y="10" width="4" height="4" rx="2" fill="currentColor" />'+
                                        '<rect x="3" y="10" width="4" height="4" rx="2" fill="currentColor" />'+
                                    '</svg>'+
                                '</span>'+
                            '</button>'+
                            '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">'+
                                '<div class="menu-item px-3">'+
                                    '<a href="#" class="menu-link px-3" data-kt-filemanager-table="rename">'+lang4+'</a>'+
                                '</div>'+
                                '<div class="menu-item px-3">'+
                                    '<a href="#" class="menu-link px-3">'+lang5+'</a>'+
                                '</div>'+
                                '<div class="menu-item px-3">'+
                                    '<a href="#" class="menu-link px-3" data-kt-filemanager-table-filter="move_row" data-bs-toggle="modal" data-bs-target="#kt_modal_move_to_folder">'+lang6+'</a>'+
                                '</div>'+
                                '<div class="menu-item px-3">'+
                                    '<a href="#" class="menu-link text-danger px-3" data-kt-filemanager-table-filter="delete_row">'+lang7+'</a>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>';

                    var str1 = '<div class="form-check form-check-sm form-check-custom form-check-solid">'+
                        '<input class="form-check-input" type="checkbox" value="'+resp[i].id+'||'+resp[i].type+'" />'+
                    '</div>';

                    var str2 = '<span class="svg-icon svg-icon-2x svg-icon-primary me-4">'+
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                            '<path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />'+
                            '<path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor" />'+
                        '</svg>'+
                    '</span>'+
                    '<a href="#" data-type="'+resp[i].type+'" data-id="'+resp[i].id+'" data-ref-id="'+resp[i].enc_ref_id+'" data-value="'+resp[i].name+'" class="text-gray-800 text-hover-primary btnFolder">'+resp[i].name+'</a>';
                }else if(resp[i].type == 'file'){
                    var str = '';

                    str = '<div class="d-flex justify-content-end">'+
                        '<div class="ms-2">'+
                            '<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">'+
                                '<span class="svg-icon svg-icon-5 m-0">'+
                                    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                        '<rect x="10" y="10" width="4" height="4" rx="2" fill="currentColor" />'+
                                        '<rect x="17" y="10" width="4" height="4" rx="2" fill="currentColor" />'+
                                        '<rect x="3" y="10" width="4" height="4" rx="2" fill="currentColor" />'+
                                    '</svg>'+
                                '</span>'+
                            '</button>'+
                            '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">'+
                                '<div class="menu-item px-3">'+
                                    '<a href="#" class="menu-link px-3" data-kt-filemanager-table-filter="move_row" data-bs-toggle="modal" data-bs-target="#kt_modal_move_to_folder">'+lang6+'</a>'+
                                '</div>'+
                                '<div class="menu-item px-3">'+
                                    '<a href="#" class="menu-link text-danger px-3" data-kt-filemanager-table-filter="delete_row_file">'+lang7+'</a>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>';

                    var str1 = '<div class="form-check form-check-sm form-check-custom form-check-solid">'+
                        '<input class="form-check-input" type="checkbox" value="'+resp[i].id+'||'+resp[i].type+'" />'+
                    '</div>';

                    var str2 = '<span class="svg-icon svg-icon-2x svg-icon-primary me-4">'+
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                            '<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor" />'+
                            '<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />'+
                        '</svg>'+
                    '</span>'+
                    '<a href="'+baseUrl+'/'+resp[i].file_path+'" target="_blank" data-type="'+resp[i].type+'" data-id="'+resp[i].id+'" data-ref-id="'+resp[i].enc_ref_id+'" class="text-gray-800 text-hover-primary">'+resp[i].name+'</a>';
                }

                const newRow = datatable.row.add({
                    'checkbox': str1,
                    'name': str2,
                    "size": resp[i].size+' MB',
                    "date": resp[i].last_modified,
                    'action': str
                }).node().id = resp[i].id;
                $(newRow).find('td').eq(4).attr('data-kt-filemanager-table', 'action_dropdown');
                $(newRow).find('td').eq(4).addClass('text-end'); // Add custom class to last 'td' element --- more info: https://datatables.net/forums/discussion/22341/row-add-cell-class

                // Re-sort datatable to allow new folder added at the top
                var index = datatable.row(0).index(),
                    rowCount = datatable.data().length - 1,
                    insertedRow = datatable.row(rowCount).data(),
                    tempRow;

                for (var j = rowCount; j > index; j--) {
                    tempRow = datatable.row(j - 1).data();
                    datatable.row(j).data(tempRow);
                    datatable.row(j - 1).data(insertedRow);
                }
            }
            
            datatable.draw(false);
        }else{
            const foldersListOptions = {
                "destroy": true,
                "data": [],
                "info": false,
                'order': [],
                "scrollY": "700px",
                "scrollCollapse": true,
                "paging": false,
                'ordering': false,
                "columns": [
                    { data: 'checkbox' },
                    { data: 'name' },
                    { data: 'size' },
                    { data: 'date' },
                    { data: 'action' },
                ],
                "headerCallback": function(thead, data, start, end, display) {
                    thead.getElementsByTagName('th')[0].innerHTML = `
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_file_manager_list .form-check-input" value="1" />
                        </div>`;
                },
                'language': {
                    emptyTable: `<div class="d-flex flex-column flex-center">
                        <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
                        <div class="fs-1 fw-bolder text-dark">`+lang1+`.</div>
                        <div class="fs-6">`+lang2+`</div>
                    </div>`
                }
            };

            // Define datatable options to load
            var loadOptions = foldersListOptions;

            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable(loadOptions);

            // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
            datatable.on('draw', function () {
                initToggleToolbar();
                handleDeleteRows();
                toggleToolbars();
                resetNewFolder();
                KTMenu.createInstances();
                // initCopyLink();
                countTotalItems();
                handleRename();
            });
        }


        // const filesListOptions = {
        //     "destroy": true,
        //     "data": fileArr,
        //     "info": false,
        //     'order': [],
        //     'pageLength': 10,
        //     "lengthChange": false,
        //     'ordering': false,
        //     'columns': [
        //         { data: 'checkbox' },
        //         { data: 'name' },
        //         { data: 'size' },
        //         { data: 'date' },
        //         { data: 'action' },
        //     ],
        //     'language': {
        //         emptyTable: `<div class="d-flex flex-column flex-center">
        //             <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
        //             <div class="fs-1 fw-bolder text-dark mb-4">`+lang1+`.</div>
        //             <div class="fs-6">`+lang2+`</div>
        //         </div>`
        //     },
        //     conditionalPaging: true
        // };

        // Define datatable options to load
        // var loadOptions = foldersListOptions;
        // if (table.getAttribute('data-kt-filemanager-table') === 'folders') {
        //     loadOptions = foldersListOptions;
        //     console.log(loadOptions);
        // } else {
        //     loadOptions = filesListOptions;
        //     console.log(loadOptions);
        // }

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        // datatable = $(table).DataTable(loadOptions);

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        // datatable.on('draw', function () {
        //     initToggleToolbar();
        //     handleDeleteRows();
        //     toggleToolbars();
        //     resetNewFolder();
        //     KTMenu.createInstances();
        //     // initCopyLink();
        //     countTotalItems();
        //     handleRename();
        // });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    const handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-filemanager-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Delete customer
    const handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-filemanager-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');
                const idFolder = $(this).closest('tr').attr('id');

                // Get customer name
                const fileName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                $.getJSON(jsonfile, function(json) {
                    Swal.fire({
                        text: msgDltFolder,
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: btnYesDlt,
                        cancelButtonText: btnNoDlt,
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function (result) {
                        if(result.value){
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'GET',
                                url: '/file-manager/folder/delete/'+idFolder,
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
                                        }).then(function () {
                                            // Remove current row
                                            datatable.row($(parent)).remove().draw();
                                            var countList = $('.listbody').find('tr').length
                                            if (countList == 0) {
                                                $(".listbody").html(`<tr class='odd'><td valign="top" colspan="5" class="dataTables_empty"><div class="d-flex flex-column flex-center">
                                                    <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
                                                    <div class="fs-1 fw-bolder text-dark">`+lang1+`.</div>
                                                    <div class="fs-6">`+lang2+`</div>
                                                </div></td></tr>`)
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
                    });
                });
            })
        });
    }

    const handleDeleteRowsFile = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-filemanager-table-filter="delete_row_file"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                const idFile = $(this).closest('tr').attr('id');

                $.getJSON(jsonfile, function(json) {
                    Swal.fire({
                        text: msgDltFile,
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: btnYesDlt,
                        cancelButtonText: btnNoDlt,
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function (result) {
                        if(result.value){
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'GET',
                                url: '/file-manager/file/delete/'+idFile,
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
                                        }).then(function () {
                                            // Remove current row
                                            $("#"+idFile).remove();
                                            var countList = $('.listbody').find('tr').length
                                            if (countList == 0) {
                                                $(".listbody").html(`<tr class='odd'><td valign="top" colspan="5" class="dataTables_empty"><div class="d-flex flex-column flex-center">
                                                    <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
                                                    <div class="fs-1 fw-bolder text-dark">`+lang1+`.</div>
                                                    <div class="fs-6">`+lang2+`</div>
                                                </div></td></tr>`)
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
                    });
                });
            })
        });
    }

    // Init toggle toolbar
    const initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        var checkboxes = table.querySelectorAll('[type="checkbox"]');
        if (table.getAttribute('data-kt-filemanager-table') === 'folders') {
            checkboxes = document.querySelectorAll('#kt_file_manager_list_wrapper [type="checkbox"]');
        }

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-filemanager-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {
            var arrayDel = []
            checkboxes.forEach((c, i) => {
                if (c.checked && checkboxes[i].defaultValue != "1") {
                    arrayDel.push(checkboxes[i].defaultValue)
                }
            });

            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: msgDltFolderFile,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: btnYesDlt,
                cancelButtonText: btnNoDlt,
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '/file-manager/folderfile/delete',
                        dataType: 'json',
                        data: {all_del: arrayDel},
                        success: function(data) {
                            if (data.status) {
                                Swal.fire({
                                    text: data.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: json.btn_alert_ok,
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    // Remove all selected customers
                                    checkboxes.forEach(c => {
                                        if (c.checked) {
                                            datatable.row($(c.closest('tbody tr'))).remove().draw();
                                        }
                                    });
            
                                    // Remove header checked box
                                    const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                                    headerCheckbox.checked = false;

                                    var countList = $('.listbody').find('tr').length
                                    if (countList == 0) {
                                        $(".listbody").html(`<tr class='odd'><td valign="top" colspan="5" class="dataTables_empty"><div class="d-flex flex-column flex-center">
                                            <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
                                            <div class="fs-1 fw-bolder text-dark">`+lang1+`.</div>
                                            <div class="fs-6">`+lang2+`</div>
                                        </div></td></tr>`)
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
                // else if (result.dismiss === 'cancel') {
                //     Swal.fire({
                //         text: "Selected files or folders was not deleted.",
                //         icon: "error",
                //         buttonsStyling: false,
                //         confirmButtonText: json.btn_alert_ok,
                //         customClass: {
                //             confirmButton: "btn fw-bold btn-primary",
                //         }
                //     });
                // }
            });
        });
    }

    // Toggle toolbars
    const toggleToolbars = () => {
        // Define variables
        const toolbarBase = document.querySelector('[data-kt-filemanager-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-filemanager-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-filemanager-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements 
        const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Handle new folder
    const handleNewFolder = () => {
        // Select button
        const newFolder = document.getElementById('kt_file_manager_new_folder');

        // Handle click action
        newFolder.addEventListener('click', e => {
            e.preventDefault();

            // Ignore if input already exist
            if (table.querySelector('#kt_file_manager_new_folder_row')) {
                return;
            }

            // Add new blank row to datatable
            const tableBody = table.querySelector('tbody');
            const rowElement = uploadTemplate.cloneNode(true); // Clone template markup
            tableBody.prepend(rowElement);

            // Define template interactive elements
            const rowForm = rowElement.querySelector('#kt_file_manager_add_folder_form');
            const rowButton = rowElement.querySelector('#kt_file_manager_add_folder');
            const cancelButton = rowElement.querySelector('#kt_file_manager_cancel_folder');
            const folderIcon = rowElement.querySelector('.svg-icon-2x');
            const rowInput = rowElement.querySelector('[name="new_folder_name"]');

            // Define validator
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                rowForm,
                {
                    fields: {
                        'new_folder_name': {
                            validators: {
                                notEmpty: {
                                    message: 'Folder name is required'
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
            );

            // Handle add new folder button
            rowButton.addEventListener('click', e => {
                e.preventDefault();

                // Activate indicator
                rowButton.setAttribute("data-kt-indicator", "on");

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function (status) {

                        if (status == 'Valid') {
                            // Simulate process for demo only
                            setTimeout(function () {
                                //Call ajax to create new folder in db
                                var form_data = {};
                                form_data.name = rowInput.value;
                                form_data.refId = $('#ref_id').val();
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    type: 'POST',
                                    data: form_data,
                                    async: false,
                                    url: '/file-manager/folder/store',
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.status) {
                                            // Create folder link
                                            const folderLink = document.createElement('a');
                                            const folderLinkClasses = ['text-gray-800', 'text-hover-primary', 'btnFolder'];
                                            folderLink.setAttribute('href', '#');
                                            folderLink.setAttribute('data-id', data.folder.id);
                                            folderLink.setAttribute('data-ref-id', data.folder.enc_ref_id);
                                            folderLink.setAttribute('data-type', 'folder');
                                            folderLink.classList.add(...folderLinkClasses);
                                            folderLink.innerText = form_data.name;

                                            const newRow = datatable.row.add({
                                                'checkbox': checkboxTemplate.innerHTML,
                                                'name': folderIcon.outerHTML + folderLink.outerHTML,
                                                "size": data.folder.size+' MB',
                                                "date": data.folder.custom_date,
                                                'action': actionTemplate.innerHTML
                                            }).node();
                                            $(newRow).find('td').eq(4).attr('data-kt-filemanager-table', 'action_dropdown');
                                            $(newRow).find('td').eq(4).addClass('text-end'); // Add custom class to last 'td' element --- more info: https://datatables.net/forums/discussion/22341/row-add-cell-class

                                            // Re-sort datatable to allow new folder added at the top
                                            var index = datatable.row(0).index(),
                                                rowCount = datatable.data().length - 1,
                                                insertedRow = datatable.row(rowCount).data(),
                                                tempRow;

                                            for (var i = rowCount; i > index; i--) {
                                                tempRow = datatable.row(i - 1).data();
                                                datatable.row(i).data(tempRow);
                                                datatable.row(i - 1).data(insertedRow);
                                            }

                                            toastr.options = {
                                                "closeButton": true,
                                                "debug": false,
                                                "newestOnTop": false,
                                                "progressBar": false,
                                                "positionClass": "toastr-top-right",
                                                "preventDuplicates": false,
                                                "showDuration": "300",
                                                "hideDuration": "1000",
                                                "timeOut": "5000",
                                                "extendedTimeOut": "1000",
                                                "showEasing": "swing",
                                                "hideEasing": "linear",
                                                "showMethod": "fadeIn",
                                                "hideMethod": "fadeOut"
                                            };

                                            toastr.success(data.message);
                                        } else {
                                            toastr.error(data.message);
                                        }
                                    }
                                });

                                // Disable indicator
                                rowButton.removeAttribute("data-kt-indicator");

                                // Reset input
                                rowInput.value = '';

                                datatable.draw(false);

                            }, 2000);
                        } else {
                            // Disable indicator
                            rowButton.removeAttribute("data-kt-indicator");
                        }
                    });
                }
            });

            // Handle cancel new folder button
            cancelButton.addEventListener('click', e => {
                e.preventDefault();

                // Activate indicator
                cancelButton.setAttribute("data-kt-indicator", "on");

                setTimeout(function () {
                    // Disable indicator
                    cancelButton.removeAttribute("data-kt-indicator");

                    // Toggle toastr
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toastr-top-right",
                        "preventDuplicates": false,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.error('Cancelled new folder creation');
                    resetNewFolder();
                }, 1000);
            });
        });
    }

    // Reset add new folder input
    const resetNewFolder = () => {
        const newFolderRow = table.querySelector('#kt_file_manager_new_folder_row');

        if (newFolderRow) {
            newFolderRow.parentNode.removeChild(newFolderRow);
        }
    }

    // Handle rename file or folder
    const handleRename = () => {
        const renameButton = table.querySelectorAll('[data-kt-filemanager-table="rename"]');     

        renameButton.forEach(button => {
            button.addEventListener('click', renameCallback);
        });
    }

    // Rename callback
    const renameCallback = (e) => {
        e.preventDefault();

        // Define shared value
        let nameValue;

        // Stop renaming if there's an input existing
        if (table.querySelectorAll('#kt_file_manager_rename_input').length > 0) {
            Swal.fire({
                text: "Unsaved input detected. Please save or cancel the current item",
                icon: "warning",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger"
                }
            });

            return;
        }

        // Select parent row
        const parent = e.target.closest('tr');
        const idFolder = $(".idfolder").attr('data-id');

        // Get name column
        const nameCol = parent.querySelectorAll('td')[1];
        const colIcon = nameCol.querySelector('.svg-icon');
        nameValue = nameCol.innerText;

        // Set rename input template
        const renameInput = renameTemplate.cloneNode(true);
        renameInput.querySelector('#kt_file_manager_rename_folder_icon').innerHTML = colIcon.outerHTML;

        // Swap current column content with input template
        nameCol.innerHTML = renameInput.innerHTML;

        // Set input value with current file/folder name
        parent.querySelector('#kt_file_manager_rename_input').value = nameValue;

        // Rename file / folder validator
        var renameValidator = FormValidation.formValidation(
            nameCol,
            {
                fields: {
                    'rename_folder_name': {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Rename input button action
        const renameInputButton = document.querySelector('#kt_file_manager_rename_folder');
        renameInputButton.addEventListener('click', e => {
            e.preventDefault();

            // Detect if valid
            if (renameValidator) {
                renameValidator.validate().then(function (status) {

                    if (status == 'Valid') {
                        $.getJSON(jsonfile, function(json) {
                            // Pop up confirmation
                            Swal.fire({
                                text: textRnm + nameValue + "?",
                                icon: "warning",
                                showCancelButton: true,
                                buttonsStyling: false,
                                confirmButtonText: btnYesRnm,
                                cancelButtonText: btnNoRnm,
                                customClass: {
                                    confirmButton: "btn fw-bold btn-danger",
                                    cancelButton: "btn fw-bold btn-active-light-primary"
                                }
                            }).then(function (result) {
                                if (result.value) {
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: 'POST',
                                        url: '/file-manager/folder/update/'+idFolder,
                                        dataType: 'json',
                                        data: {
                                            name: $("#kt_file_manager_rename_input").val()
                                        },
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
                                                }).then(function () {
                                                    // Get new file / folder name value
                                                    const newValue = document.querySelector('#kt_file_manager_rename_input').value;

                                                    // New column data template
                                                    const newData = `<div class="d-flex align-items-center">
                                                        ${colIcon.outerHTML}
                                                        <a href="?page=apps/file-manager/files/" class="text-gray-800 text-hover-primary">${newValue}</a>
                                                    </div>`;

                                                    // Draw datatable with new content -- Add more events here for any server-side events
                                                    datatable.cell($(nameCol)).data(newData).draw();
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
                                // else if (result.dismiss === 'cancel') {
                                //     Swal.fire({
                                //         text: nameValue + " was not renamed.",
                                //         icon: "error",
                                //         buttonsStyling: false,
                                //         confirmButtonText: "Ok, got it!",
                                //         customClass: {
                                //             confirmButton: "btn fw-bold btn-primary",
                                //         }
                                //     });
                                // }
                            });
                        });
                    }
                });
            }
        });

        // Cancel rename input
        const cancelInputButton = document.querySelector('#kt_file_manager_rename_folder_cancel');
        cancelInputButton.addEventListener('click', e => {
            e.preventDefault();

            // Simulate process for demo only
            cancelInputButton.setAttribute("data-kt-indicator", "on");

            setTimeout(function () {
                const revertTemplate = `<div class="d-flex align-items-center">
                    ${colIcon.outerHTML}
                    <a href="?page=apps/file-manager/files/" class="text-gray-800 text-hover-primary">${nameValue}</a>
                </div>`;

                // Remove spinner
                cancelInputButton.removeAttribute("data-kt-indicator");

                // Draw datatable with new content -- Add more events here for any server-side events
                datatable.cell($(nameCol)).data(revertTemplate).draw();

                // Toggle toastr
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toastr-top-right",
                    "preventDuplicates": false,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.error('Cancelled rename function');
            }, 1000);
        });
    }

    // Init dropzone
    const initDropzone = () => {
        const newFile = document.getElementById('btnkt_modal_upload');
        // Handle click action
        newFile.addEventListener('click', e => {
            e.preventDefault();

            $("#kt_modal_upload").show();
            // set the dropzone container id
            const id = "#kt_modal_upload_dropzone";

            var previewNode = $(id + " .dropzone-item");
            previewNode.id = "";
            var previewTemplate = previewNode.parent('.dropzone-items').html();
            previewNode.remove();
    
            var myDropzone4 = new Dropzone(id, { // Make the whole body a dropzone
                url: "/file-manager/file/store", // Set the url for your upload script location
                parallelUploads: 20,
                previewTemplate: previewTemplate,
                maxFilesize: 1, // Max filesize in MB
                autoQueue: false, // Make sure the files aren't queued until manually added
                previewsContainer: id + " .dropzone-items", // Define the container to display the previews
                clickable: id + " .dropzone-select", // Define the element that should be used as click trigger to select files.
                acceptedFiles: "application/pdf,.docx,.doc",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                params: {
                    folder_id: $("#ref_id").val()
                }
            });
    
            myDropzone4.on("addedfile", function(file) {
                // Hookup the start button
                file.previewElement.querySelector(id + " .dropzone-start").onclick = function() { myDropzone4.enqueueFile(file); };
                $(document).find( id + ' .dropzone-item').css('display', '');
                $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'inline-block');
            });
    
            // Update the total progress bar
            myDropzone4.on("totaluploadprogress", function(progress) {
                $(this).find( id + " .progress-bar").css('width', progress + "%");
            });
    
            myDropzone4.on("sending", function(file) {
                // Show the total progress bar when upload starts
                $( id + " .progress-bar").css('opacity', '1');
                // And disable the start button
                file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
            });
    
            // Hide the total progress bar when nothing's uploading anymore
            myDropzone4.on("complete", function(progress) {
                var thisProgressBar = id + " .dz-complete";
                setTimeout(function(){
                    $( thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress, " + thisProgressBar + " .dropzone-start").css('opacity', '0');
                }, 300)
    
            });
    
            // Setup the buttons for all transfers
            document.querySelector( id + " .dropzone-upload").onclick = function() {
                myDropzone4.enqueueFiles(myDropzone4.getFilesWithStatus(Dropzone.ADDED));
            };
    
            // Setup the button for remove all files
            document.querySelector(id + " .dropzone-remove-all").onclick = function() {
                $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
                myDropzone4.removeAllFiles(true);
            };
    
            // On all files completed upload
            myDropzone4.on("queuecomplete", function(progress){
                $( id + " .dropzone-upload").css('display', 'none');
            });
    
            // On all files removed
            myDropzone4.on("removedfile", function(file){
                if(myDropzone4.files.length < 1){
                    var response = JSON.parse(file.xhr.response)
                    var allData = response.data
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET',
                        url: '/file-manager/file/delete/'+allData.id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status) {
                                $("#"+allData.id).remove();
                                $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');

                                var countList = $('.listbody').find('tr').length
                                if (countList == 0) {
                                    $(".listbody").html(`<tr class='odd'><td valign="top" colspan="5" class="dataTables_empty"><div class="d-flex flex-column flex-center">
                                        <img src="`+baseUrl+`/assets/media/illustrations/sketchy-1/5.png" class="mw-400px" />
                                        <div class="fs-1 fw-bolder text-dark">`+lang1+`.</div>
                                        <div class="fs-6">`+lang2+`</div>
                                    </div></td></tr>`)
                                }
                            }
                        }
                    });
                }
            });

            myDropzone4.on("success", function(file) {
                var response = JSON.parse(file.xhr.response)
                var statusResp = response.status
                var allData = response.data
                if (statusResp) { 
                    //last class
                    var classNameFile = $(".listbody").children().last().attr('class') == "even "? "odd" : "even" 
                    $(".dataTables_empty").parent().remove();
                    var newDataFile = `<tr class=`+classNameFile+` id=`+allData.id+`>`+
                        `<td>`+
                            `<div class="form-check form-check-sm form-check-custom form-check-solid">`+
                                `<input class="form-check-input" type="checkbox" value="`+allData.id+`||file">`+
                            `</div>`+
                        `</td>`+
                        `<td>`+
                            `<span class="svg-icon svg-icon-2x svg-icon-primary me-4">`+
                                `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">`+
                                    `<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"></path>`+
                                    `<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"></path>`+
                                `</svg>`+
                            `</span>`+
                            `<a href="" target="_blank" data-type="file" data-id="`+allData.id+`" data-ref-id="`+allData.folder_id+`" class="text-gray-800 text-hover-primary">`+allData.name+`</a></td>`+
                            `<td>`+allData.size+` MB</td>`+
                            `<td>`+allData.last_modified+`</td>`+
                            `<td data-kt-filemanager-table="action_dropdown" class="text-end">`+
                                `<div class="d-flex justify-content-end">`+
                                    `<div class="ms-2">`+
                                        `<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">`+
                                            `<span class="svg-icon svg-icon-5 m-0">`+
                                                `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">`+
                                                    `<rect x="10" y="10" width="4" height="4" rx="2" fill="currentColor"></rect>`+
                                                    `<rect x="17" y="10" width="4" height="4" rx="2" fill="currentColor"></rect>`+
                                                    `<rect x="3" y="10" width="4" height="4" rx="2" fill="currentColor"></rect>`+
                                                `</svg>`+
                                            `</span>`+
                                        `</button>`+
                                        `<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">`+
                                            `<div class="menu-item px-3">`+
                                                `<a href="#" class="menu-link px-3" data-kt-filemanager-table-filter="move_row" data-bs-toggle="modal" data-bs-target="#kt_modal_move_to_folder">Pindahkan</a>`+
                                            `</div>`+
                                            `<div class="menu-item px-3">`+
                                                `<a href="#" class="menu-link text-danger px-3" data-kt-filemanager-table-filter="delete_row_file">Hapus</a>`+
                                                `</div>`+
                                        `</div>`+
                                    `</div>`+
                                `</div>`+
                            `</td>`+
                        `</td>`+
                    `</tr>`
                    $(".listbody").append(newDataFile)
                }
            })
        })
    }

    // Init copy link
    const initCopyLink = () => {
        // Select all copy link elements
        const elements = table.querySelectorAll('[data-kt-filemanger-table="copy_link"]');

        elements.forEach(el => {
            // Define elements
            const button = el.querySelector('button');
            const generator = el.querySelector('[data-kt-filemanger-table="copy_link_generator"]');
            const result = el.querySelector('[data-kt-filemanger-table="copy_link_result"]');
            const input = el.querySelector('input');

            // Click action
            button.addEventListener('click', e => {
                e.preventDefault();

                // Reset toggle
                generator.classList.remove('d-none');
                result.classList.add('d-none');

                var linkTimeout;
                clearTimeout(linkTimeout);
                linkTimeout = setTimeout(() => {
                    generator.classList.add('d-none');
                    result.classList.remove('d-none');
                    input.select();
                }, 2000);
            });
        });
    }

    // Handle move to folder
    const handleMoveToFolder = () => {
        const element = document.querySelector('#kt_modal_move_to_folder');
        const form = element.querySelector('#kt_modal_move_to_folder_form');
        const saveButton = form.querySelector('#kt_modal_move_to_folder_submit');
        const moveModal = new bootstrap.Modal(element);

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'move_to_folder': {
                        validators: {
                            notEmpty: {
                                message: 'Please select a folder.'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        saveButton.addEventListener('click', e => {
            e.preventDefault();

            saveButton.setAttribute("data-kt-indicator", "on");

            if (validator) {
                validator.validate().then(function (status) {

                    if (status == 'Valid') {
                        // Simulate process for demo only
                        setTimeout(function () {

                            Swal.fire({
                                text: "Are you sure you would like to move to this folder",
                                icon: "warning",
                                showCancelButton: true,
                                buttonsStyling: false,
                                confirmButtonText: "Yes, move it!",
                                cancelButtonText: "No, return",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                    cancelButton: "btn btn-active-light"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    form.reset(); // Reset form	
                                    moveModal.hide(); // Hide modal			

                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": false,
                                        "positionClass": "toastr-top-right",
                                        "preventDuplicates": false,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    };

                                    toastr.success('1 item has been moved.');

                                    saveButton.removeAttribute("data-kt-indicator");
                                } else {
                                    Swal.fire({
                                        text: "Your action has been cancelled!.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        }
                                    });

                                    saveButton.removeAttribute("data-kt-indicator");
                                }
                            });
                        }, 500);
                    } else {
                        saveButton.removeAttribute("data-kt-indicator");
                    }
                });
            }
        });
    }

    // Count total number of items
    const countTotalItems = () => {
        const counter = document.getElementById('kt_file_manager_items_counter');

        // Count total number of elements in datatable --- more info: https://datatables.net/reference/api/count()
        counter.innerText = datatable.rows().count() + ' '+lang3;
    }

    // Public methods
    return {
        init: function () {
            table = document.querySelector('#kt_file_manager_list');

            if (!table) {
                return;
            }
            
            Dropzone.autoDiscover = false;

            initTemplates();
            initDatatable();
            initToggleToolbar();
            handleSearchDatatable();
            handleDeleteRows();
            handleNewFolder();
            handleDeleteRowsFile();
            initDropzone();
            // initCopyLink();
            handleRename();
            handleMoveToFolder();
            countTotalItems();
            KTMenu.createInstances();
        },
        reinit: function(data){            
            table = document.querySelector('#kt_file_manager_list');

            if (!table) {
                return;
            }

            initTemplates();
            reinitDatatable(data);
            initToggleToolbar();
            handleSearchDatatable();
            handleDeleteRows();
            handleNewFolder();
            handleDeleteRowsFile();
            // initDropzone();
            // initCopyLink();
            handleRename();
            handleMoveToFolder();
            countTotalItems();
            KTMenu.createInstances();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    Dropzone.autoDiscover = false;
    var arrBc = [];
    KTFileManagerList.init();

    if($('.btnFolder').length != 0){
        $(document).on('click', '.btnFolder', function(){
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            var name = $(this).attr('data-value');
            var refId = $(this).attr('data-ref-id');

            arrBc.push(name);

            var str = '';
            str += '<span class="svg-icon svg-icon-2 svg-icon-primary mx-1">'+
                    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                    '<path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor" />'+
                '</svg>'+
            '</span>';
            str += '<a href="#" data-value="'+name+'" data-id="'+id+'" data-type="'+type+'" data-ref-id="'+refId+'" class="btnFolders">'+name+'</a>';

            $('#appendBc').append(str);

            $('#ref_id').val(refId);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/file-manager/folder/getby/'+refId,
                dataType: 'json',
                success: function(data) {
                    KTFileManagerList.reinit(data);
                }
            });
            
            return false;
        });
    }
});