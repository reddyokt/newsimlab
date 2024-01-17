"use strict";

// Class definition
	
var eduOnly = [];
var edu = [];
var unOnly = [];
var un = [];
var extOrg = [];
var intOrg = [];
var kdrOnly = [];
var kdr = [];
var pltOnly = [];
var plt = [];

var extOrgVal = [];
var intOrgVal = [];
var fileRecommendation = '';
var filePhoto = '';
var arrFile = [];
var arrFile2 = [];
var files = [];

var KTCreateAccount = function () {
	// Elements
	var modal;	
	var modalEl;

	var stepper;
	var form;
	var formPrevButton;
	var formSubmitButton;
	var formContinueButton;

	// Variables
	var stepperObj;
	var validations = [];

	// Private Functions
	var initStepper = function () {
		// Initialize Stepper
		stepperObj = new KTStepper(stepper);

		// Stepper change event
		stepperObj.on('kt.stepper.changed', function (stepper) {
			if (stepperObj.getCurrentStepIndex() === 5) {
				formSubmitButton.classList.remove('d-none');
				formSubmitButton.classList.add('d-inline-block');
				formContinueButton.classList.add('d-none');
			} else if (stepperObj.getCurrentStepIndex() === 6) {
				formSubmitButton.classList.add('d-none');
				formContinueButton.classList.add('d-none');
				formPrevButton.classList.add('d-none');
			} else {
				formSubmitButton.classList.remove('d-inline-block');
				formSubmitButton.classList.remove('d-none');
				formContinueButton.classList.remove('d-none');
			}
		});

		// Validation before going to next page
		stepperObj.on('kt.stepper.next', function (stepper) {
			console.log('stepper.next');

			// Validate form before change stepper step
			var validator = validations[stepper.getCurrentStepIndex() - 1]; // get validator for currnt step

			if (validator) {
				validator.validate().then(function (status) {
					console.log('validated!');

					if (status == 'Valid') {
						stepper.goNext();

						KTUtil.scrollTop();
					} else {
						Swal.fire({
							text: "Terdapat beberapa kesalahan dalam pengisian, silahkan periksa kembali",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "OK",
							customClass: {
								confirmButton: "btn btn-light"
							}
						});
					}
				});
			} else {
				stepper.goNext();

				KTUtil.scrollTop();
			}
		});

		// Prev event
		stepperObj.on('kt.stepper.previous', function (stepper) {
			console.log('stepper.previous');

			stepper.goPrevious();
			KTUtil.scrollTop();
		});
	}

	var handleForm = function() {
		formSubmitButton.addEventListener('click', function (e) {
			// Validate form before change stepper step
			var validator = validations[1]; // get validator for last form

			validator.validate().then(function (status) {
				console.log('validated!');

				if (status == 'Valid') {
					// Prevent default button action
					e.preventDefault();

					Swal.fire({
						title: "Anda yakin ingin menyimpan?",
						text: "Pastikan anda sudah memeriksa isian anda sudah baik dan benar", 
						icon: "warning",
						showCancelButton: true,
						showClass: {
							popup: 'animate__animated animate__fadeInDown'
						},
						hideClass: {
							popup: 'animate__animated animate__fadeOutUp'
						},
						confirmButtonText: "Ya, Lanjutkan",
						cancelButtonText: "Batalkan",
					})
					.then(function(result){
						if(result.value){
							// Disable button to avoid multiple click 
							formSubmitButton.disabled = true;
							formPrevButton.disabled = true;

							// Show loading indication
							formSubmitButton.setAttribute('data-kt-indicator', 'on');

							var url = '/post-register';
							var form_data = new FormData($('#kt_create_account_form')[0]);
							form_data.append("educationList", JSON.stringify(edu));
							form_data.append("universityList", JSON.stringify(un));
							form_data.append("internalExpList", JSON.stringify(intOrg));
							form_data.append("externalExpList", JSON.stringify(extOrg));
							form_data.append("cadreExpList", JSON.stringify(kdr));
							form_data.append("trainingExpList", JSON.stringify(plt));
							form_data.append("files", JSON.stringify(files));

							// Simulate form submission
							setTimeout(function() {
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
										// Hide loading indication
										formSubmitButton.removeAttribute('data-kt-indicator');
										
										// Enable button
										formSubmitButton.disabled = false;
										formPrevButton.disabled = false;

										if (data.status) {
											stepperObj.goNext();

											toastr.options = {
												"closeButton": false,
												"debug": false,
												"newestOnTop": false,
												"progressBar": false,
												"positionClass": "toastr-top-right",
												"preventDuplicates": false,
												"onclick": null,
												"showDuration": "300",
												"hideDuration": "1000",
												"timeOut": "5000",
												"extendedTimeOut": "1000",
												"showEasing": "swing",
												"hideEasing": "linear",
												"showMethod": "fadeIn",
												"hideMethod": "fadeOut"
											  };
											  
											  toastr.success("Registrasi berhasil disimpan", "Berhasil");
										} else {
											toastr.options = {
												"closeButton": false,
												"debug": false,
												"newestOnTop": false,
												"progressBar": false,
												"positionClass": "toastr-top-right",
												"preventDuplicates": false,
												"onclick": null,
												"showDuration": "300",
												"hideDuration": "1000",
												"timeOut": "5000",
												"extendedTimeOut": "1000",
												"showEasing": "swing",
												"hideEasing": "linear",
												"showMethod": "fadeIn",
												"hideMethod": "fadeOut"
											};
											  
											toastr.warning(data.message, "Perhatian");
										}
									},
									error: function(){
										// Hide loading indication
										formSubmitButton.removeAttribute('data-kt-indicator');
										
										// Enable button
										formSubmitButton.disabled = false;
										formPrevButton.disabled = false;

										toastr.options = {
											"closeButton": false,
											"debug": false,
											"newestOnTop": false,
											"progressBar": false,
											"positionClass": "toastr-top-right",
											"preventDuplicates": false,
											"onclick": null,
											"showDuration": "300",
											"hideDuration": "1000",
											"timeOut": "5000",
											"extendedTimeOut": "1000",
											"showEasing": "swing",
											"hideEasing": "linear",
											"showMethod": "fadeIn",
											"hideMethod": "fadeOut"
										};
										
										toastr.error("Terdapat kesalahan dalam sistem, silahkan coba kembali beberapa saat", "Gagal");
									}
								});
							}, 2000);
						}
					});
				} else {
					Swal.fire({
						text: "Terdapat beberapa kesalahan dalam pengisian, silahkan periksa kembali",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "OK",
						customClass: {
							confirmButton: "btn btn-light"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			});
		});

		// Expiry month. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="card_expiry_month"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validations[3].revalidateField('card_expiry_month');
        });

		// Expiry year. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="card_expiry_year"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validations[3].revalidateField('card_expiry_year');
        });

		// Expiry year. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="business_type"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validations[2].revalidateField('business_type');
        });
	}

	var initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		const religion = jQuery(form.querySelector('[name="religion"]'));
		const maritalStatus = jQuery(form.querySelector('[name="marital_status"]'));
		const nationality = jQuery(form.querySelector('[name="nationality"]'));
		
		var validationStep1 = FormValidation.formValidation(
			form,
			{
				fields: {
					'name': {
						validators: {
							notEmpty: {
								message: 'Nama Lengkap wajib diisi'
							}
						}
					},
					'phone': {
						validators: {
							notEmpty: {
								message: 'No. HP wajib diisi'
							}
						}
					},
					'email': {
						validators: {
							notEmpty: {
								message: 'Email wajib diisi'
							},
							emailAddress: {
								message: 'Format Email tidak sesuai'
							},
							identical: {
								compare: function () {
									return form.querySelector('[name="reconfirmEmail"]').value;
								},
								message: 'Email yang dikonfirmasi tidak sama',
							},
							remote: {
								message: 'Email sudah terdaftar sebelumnya',
								method: 'POST',
								url: '/member/check/email',
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
							},
						}
					},
					'reconfirmEmail': {
						validators: {
							notEmpty: {
								message: 'Email wajib diisi'
							},
							emailAddress: {
								message: 'Format Email tidak sesuai'
							},
							identical: {
								compare: function () {
									return form.querySelector('[name="email"]').value;
								},
								message: 'Email yang dikonfirmasi tidak sama',
							},
						},
					},
					'nik': {
						validators: {
							notEmpty: {
								message: 'NIK wajib diisi'
							},
							stringLength:{
                                min: 19,
                                max: 19,
                                message: 'NIK harus sejumlah 16 karakter',
                            },
							remote: {
								message: 'NIK sudah terdaftar sebelumnya',
								method: 'POST',
								url: '/member/check/nik',
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
							},
						}
					},
					'religion': {
						validators: {
							callback: {
								message: 'Agama wajib dipilih',
								callback: function (input) {
									// Get the selected options
									const options = religion.select2('data');
									return options[0].id !== "";
								},
							},
						}
					},
					'marital_status': {
						validators: {
							callback: {
								message: 'Status wajib dipilih',
								callback: function (input) {
									// Get the selected options
									const options = status.select2('data');
									return options[0].id !== "";
								},
							},
						}
					},
					'nationality': {
						validators: {
							callback: {
								message: 'Kebangsaan wajib dipilih',
								callback: function (input) {
									// Get the selected options
									const options2 = nationality.select2('data');
									return options2[0].id !== "";
								},
							},
						}
					},
					'birth_place': {
						validators: {
							notEmpty: {
								message: 'Tempat Lahir wajib dipilih'
							}
						}
					},
					'birth_date': {
						validators: {
							notEmpty: {
								message: 'Tanggal Lahir wajib diisi'
							}
						}
					},
					'domisili': {
						validators: {
							notEmpty: {
								message: 'Domisili wajib dipilih'
							}
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		);
		validations.push(validationStep1);

		religion.select2().on('change.select2', function () {
			// Revalidate the color field when an option is chosen
			validationStep1.revalidateField('religion');
		});

		maritalStatus.select2().on('change.select2', function () {
			// Revalidate the color field when an option is chosen
			validationStep1.revalidateField('marital_status');
		});

		nationality.select2().on('change.select2', function () {
			// Revalidate the color field when an option is chosen
			validationStep1.revalidateField('nationality');
		});

		// Step 2
		const university = jQuery(form.querySelector('[name="university"]'));
		const dpc = jQuery(form.querySelector('[name="dpc"]'));
		const dpd = jQuery(form.querySelector('[name="dpd"]'));
		var validationStep2 = FormValidation.formValidation(
			form,
			{
				fields: {
					'dpd': {
						validators: {
							notEmpty: {
								message: 'DPD wajib dipilih'
							}
						}
					},
					'commisariat': {
						validators: {
							notEmpty: {
								message: 'Komisariat wajib diisi'
							}
						}
					},
					'faculty': {
						validators: {
							notEmpty: {
								message: 'Nama Fakultas wajib diisi'
							}
						}
					},
					'major': {
						validators: {
							notEmpty: {
								message: 'Nama Program Studi wajib diisi'
							}
						}
					},
					'dpc': {
						validators: {
							callback: {
								message: 'PC wajib dipilih',
								callback: function (input) {
									// Get the selected options
									const options3 = dpc.select2('data');

									return options3.length != 0 && options3[0].id !== "";
								},
							},
						}
					},
					'university': {
						validators: {
							callback: {
								message: 'Perguruan Tinggi wajib dipilih',
								callback: function (input) {
									// Get the selected options
									const options4 = university.select2('data');
									return options4.length != 0 && options4[0].id !== "";
								},
							},
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		);
		validations.push(validationStep2);

		dpc.select2().on('change.select2', function () {
			// Revalidate the color field when an option is chosen
			validationStep2.revalidateField('dpc');
		});

		university.select2().on('change.select2', function () {
			// Revalidate the color field when an option is chosen
			validationStep2.revalidateField('university');
		});
		
		dpd.select2().on('change.select2', function () {
			// Revalidate the color field when an option is chosen
			validationStep2.revalidateField('dpd');
		});
	}

	return {
		// Public Functions
		init: function () {
			// Elements
			modalEl = document.querySelector('#kt_modal_create_account');

			if ( modalEl ) {
				modal = new bootstrap.Modal(modalEl);	
			}					

			stepper = document.querySelector('#kt_create_account_stepper');

			if ( !stepper ) {
				return;
			}

			form = stepper.querySelector('#kt_create_account_form');
			formSubmitButton = stepper.querySelector('[data-kt-stepper-action="submit"]');
			formPrevButton = stepper.querySelector('[data-kt-stepper-action="previous"]');
			formContinueButton = stepper.querySelector('[data-kt-stepper-action="next"]');

			initStepper();
			initValidation();
			handleForm();
		}
	};
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
	window.localStorage['ptma'] = 'N';

    KTCreateAccount.init();

	var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
		url: "/files/upload/recommendation", // Set the url for your upload script location
		paramName: "file", // The name that will be used to transfer the file
		maxFiles: 1,
		maxFilesize: 10, // MB
		addRemoveLinks: true,
		acceptedFiles: "application/pdf,.docx,.doc",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
        success: function( file, response ){
			arrFile = [];
            var fileRecommendation = response.fileData.file_id;
			var filename = response.fileData.name;
			var objFile = {};
			objFile.fid = fileRecommendation;
			objFile.name = filename;
			files.push(objFile);

            arrFile.push(filename);
            $('#filename').val(JSON.stringify(arrFile));
        },
		accept: function(file, done) {
			console.log("uploaded");
			done();
		},
        init: function() { 
            myDropzone = this;
			myDropzone.on("maxfilesexceeded", function(file){
				this.removeFile(file);
			});
			
            var defFile = $('#filename').val();
            $.ajax({
                url: '/files/upload/recommendation',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {read: 2, defFile: defFile},
                dataType: 'json',
                success: function(response) {
					$.each(response.fileList, function(key,value){
						var mockFile = { 
							newName: value.name,
							name: value.name.substr(value.name.indexOf('_') + 1),
							size: value.size
						};
						myDropzone.emit("addedfile", mockFile, value.path);
						myDropzone.emit("thumbnail", mockFile, value.path);
						myDropzone.emit("complete", mockFile);
					});
                }
            });
        },
        // Rename uploaded files to unique name
        renameFile: function (file) {
			var ext = file.name.substring(file.name.lastIndexOf('.') + 1, file.name.length)
            let newName = new Date().getTime() + '_' + makeid(6)+'.'+ext;
            // Add new name to the file object:
            file.newName = newName;
            // As an object is handed over by reference it will persist
            return newName;
        },
        removedfile: function(file) {
            var name = file.newName;
            var arrFile = JSON.parse($('#filename').val());      
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/files/removefile/recommendation',
                data: {fileName: name},
                dataType: 'json',
                success: function(data){
                    var idx = arrFile.indexOf(name);
					if(idx > -1){
						arrFile.splice(idx, 1);
						$('#filename').val(JSON.stringify(arrFile));
					}
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }
	});

	var myDropzone2 = new Dropzone("#kt_dropzonejs_example_2", {
		url: "/files/upload/photo", // Set the url for your upload script location
		paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1,
        maxFilesize: 5, // MB
		maxFileHeight: 450,
		maxFileWidth: 330,
        addRemoveLinks: true,
		acceptedFiles: "image/jpeg,image/png",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
        success: function( file, response ){
			arrFile2 = [];
            var filePhoto = response.fileData.file_id;
			var filename = response.fileData.name;
			var objFile = {};
			objFile.fid = filePhoto;
			objFile.name = filename;
			files.push(objFile);

            arrFile2.push(filename);
            $('#filename2').val(JSON.stringify(arrFile2));
        },
		accept: function(file, done) {
			done();
		},
        init: function() { 
            myDropzone2 = this;
			myDropzone2.on("maxfilesexceeded", function(file){
				this.removeFile(file);
			});
            var defFile = $('#filename2').val();
            $.ajax({
                url: '/files/upload/photo',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {read: 2, defFile: defFile},
                dataType: 'json',
                success: function(response) {
                    $.each(response.fileList, function(key,value){
                        var mockFile = { 
                            newName: value.name,
                            name: value.name.substr(value.name.indexOf('_') + 1),
                            size: value.size
                        };
                        myDropzone2.emit("addedfile", mockFile, value.path);
                        myDropzone2.emit("thumbnail", mockFile, value.path);
                        myDropzone2.emit("complete", mockFile);
                    });
                }
            });
        },
        // Rename uploaded files to unique name
        renameFile: function (file) {
			var ext = file.name.substring(file.name.lastIndexOf('.') + 1, file.name.length)
            let newName = new Date().getTime() + '_' + makeid(6)+'.'+ext;
            // Add new name to the file object:
            file.newName = newName;
            // As an object is handed over by reference it will persist
            return newName;
        },
        removedfile: function(file) {
            var name = file.newName;
            var arrFile2 = JSON.parse($('#filename2').val());      
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/files/removefile/photo',
                data: {fileName: name},
                dataType: 'json',
                success: function(data){
                    var idx = arrFile2.indexOf(name);
					if(idx > -1){
						arrFile2.splice(idx, 1);
						$('#filename2').val(JSON.stringify(arrFile2));
					}
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
	});

	$('.year').mask('0000');
	$('.phone').mask('0000-000-000-000');
	$('.nik').mask('0000-0000-0000-0000');

	Inputmask({
		"mask" : "999/999"
	}).mask(".rt_rw");

	$("#kt_datepicker_1").flatpickr();

	$('#domisili').select2({
		ajax: {
		  	url: '/region',
		  	data: function (params) {
				var query = {
					search: params.term,
					page: 100
				}
	  
				// Query parameters will be ?search=[term]&page=[page]
				return query;
		  	},
		  	processResults: function (data, params) {
				params.page = params.page || 1;
		
				return {
					results: data.results,
					pagination: {
						more: (params.page * 100) < data.count_filtered
					}
				};
			},
			cache: true
		}
	});

	$(document).on('click', '#is_ptma', function(){
		var checked = $(this).is(":checked");
		if(checked){
			window.localStorage['ptma'] = 'Y';
		}else{
			window.localStorage['ptma'] = 'N';
		}
	});

	$(document).on('click', '#btnModalEdu', function(){
		$('#kt_modal_1').modal('show');
		
		return false;
	});

	$(document).on('click', '#btnModalUn', function(){
		$('#kt_modal_2').modal('show');
		
		return false;
	});

	$(document).on('click', '#btnModalInt', function(){
		$('#kt_modal_3').modal('show');
		
		return false;
	});

	$(document).on('click', '#btnModalExt', function(){
		$('#kt_modal_4').modal('show');
		
		return false;
	});
	
	$(document).on('click', '#btnModalKdr', function(){
		$('#kt_modal_5').modal('show');
		
		return false;
	});

	$(document).on('click', '#btnModalPlt', function(){
		$('#kt_modal_6').modal('show');
		
		return false;
	});

	$(document).on('click', '#closeEduBtn', function(){
		$('#kt_modal_1').modal('hide');

		return false;
	});

	$(document).on('click', '#closeUnBtn', function(){
		$('#kt_modal_2').modal('hide');

		return false;
	});

	$(document).on('click', '#closeIntBtn', function(){
		$('#kt_modal_3').modal('hide');

		return false;
	});

	$(document).on('click', '#closeExtBtn', function(){
		$('#kt_modal_4').modal('hide');

		return false;
	});

	$(document).on('click', '#closeKdrBtn', function(){
		$('#kt_modal_5').modal('hide');

		return false;
	});

	$(document).on('click', '#closePltBtn', function(){
		$('#kt_modal_6').modal('hide');

		return false;
	});

	$(document).on('click', '#applyIntBtn', function(){
		var str = '';

		if(intOrg.length == 0){
			$('#appendRowInt').empty();
		}

		var post = {};
		post.position = $('#position').val();
		post.start_year = $('#start_year').val();
		post.end_year = $('#end_year').val();
		post.is_current = $('#is_current').is(":checked");

		intOrg.push(post);
		var rowId = makeid(3);
		intOrgVal.push(rowId);

		str += '<tr id="rowInt_'+rowId+'">';
		str += '<td align="left">'+$('#position').val()+'</td>';
		str += '<td align="center">'+post.start_year+'</td>';
		str += '<td align="center">'+post.end_year+'</td>';
		str += '<td align="center"><a href="#" data-id="'+rowId+'" class="btn btn-sm fw-bold btn-danger deleteIntRow"><i class="fa fa-trash text-light"></i></a></td>';
		str += '</tr>';

		$('#appendRowInt').append(str);
		
		$('#kt_modal_3').modal('hide');

		$('#position').val('');
		$('#start_year').val('');
		$('#end_year').val('');

		return false;
	});

	$(document).on('click', '.deleteIntRow', function(){
		var id = $(this).attr('data-id');
		var str = '';

		var index = intOrgVal.indexOf(id);
		if(index > -1){
			var rowV = intOrgVal[index];

			intOrgVal.splice(index,1);
			intOrg.splice(index,1);

			$('#rowInt_'+rowV).remove();
		}

		if(intOrg.length == 0){
			str += '<tr>';
			str += '<td align="center" colspan="4">Belum ada data yang ditambahkan</td>';
			str += '</tr>';

			$('#appendRowInt').append(str);
		}

		return false;
	});

	$(document).on('click', '#applyExtBtn', function(){
		var str = '';

		if(extOrg.length == 0){
			$('#appendRowExt').empty();
		}

		var post = {};
		post.place = $('#ext_place').val();
		post.position = $('#ext_position').val();
		post.start_year = $('#ext_start_year').val();
		post.end_year = $('#ext_end_year').val();
		post.is_current = $('#ext_is_current').is(":checked");

		extOrg.push(post);
		var rowId = makeid(3);
		extOrgVal.push(rowId);

		str += '<tr id="rowExt_'+rowId+'">';
		str += '<td align="left">'+$('#ext_place').val()+'</td>';
		str += '<td align="left">'+$('#ext_position').val()+'</td>';
		str += '<td align="center">'+post.start_year+'</td>';
		str += '<td align="center">'+post.end_year+'</td>';
		str += '<td align="center"><a href="#" data-id="'+rowId+'" class="btn btn-sm fw-bold btn-danger deleteExtRow"><i class="fa fa-trash text-light"></i></a></td>';
		str += '</tr>';

		$('#appendRowExt').append(str);
		
		$('#kt_modal_4').modal('hide');

		$('#ext_position').val('');
		$('#ext_place').val('');
		$('#ext_start_year').val('');
		$('#ext_end_year').val('');

		return false;
	});

	$(document).on('click', '.deleteExtRow', function(){
		var id = $(this).attr('data-id');
		var str = '';

		var index = extOrgVal.indexOf(id);
		if(index > -1){
			var rowV = extOrgVal[index];

			extOrgVal.splice(index,1);
			extOrg.splice(index,1);

			$('#rowExt_'+rowV).remove();
		}

		if(extOrg.length == 0){
			str += '<tr>';
			str += '<td align="center" colspan="5">Belum ada data yang ditambahkan</td>';
			str += '</tr>';

			$('#appendRowExt').append(str);
		}

		return false;
	});
	
	$(document).on('click', '#applyUnBtn', function(){
		var str = '';

		if(un.length == 0){
			$('#appendRowUn').empty();
		}

		var unValue = $('#grade option:selected').val();

		if(unOnly.includes(unValue)){
			Swal.fire({
				text: unValue+" sudah terdaftar sebelumnya",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "OK",
				customClass: {
					confirmButton: "btn btn-light"
				}
			})
		}else{
			var post = {};
			post.grade = $('#grade option:selected').val();
			post.status = $('#status option:selected').val();

			un.push(post);
			var rowId = $('#grade option:selected').val();
			unOnly.push(rowId);

			str += '<tr id="rowUn_'+rowId+'">';
			str += '<td align="left">'+$('#grade option:selected').text()+'</td>';
			str += '<td align="center">'+$('#status option:selected').text()+'</td>';
			str += '<td align="center"><a href="#" data-id="'+rowId+'" class="btn btn-sm fw-bold btn-danger deleteUnRow">&nbsp;<i class="fa fa-trash text-light"></i></a></td>';
			str += '</tr>';

			$('#appendRowUn').append(str);
			
			$('#kt_modal_2').modal('hide');

			$('#grade').val(null).trigger('change');
			$('#status').val(null).trigger('change');
		}
		
		return false;
	});

	$(document).on('click', '.deleteUnRow', function(){
		var id = $(this).attr('data-id');
		var str = '';

		var index = unOnly.indexOf(id);
		if(index > -1){
			var rowV = un[index].grade;

			unOnly.splice(index,1);
			un.splice(index,1);

			$('#rowUn_'+rowV).remove();
		}

		if(un.length == 0){
			str += '<tr>';
			str += '<td align="center" colspan="3">Belum ada data yang ditambahkan</td>';
			str += '</tr>';

			$('#appendRowUn').append(str);
		}

		return false;
	});

	$(document).on('click', '#applyEduBtn', function(){
		var str = '';

		if(edu.length == 0){
			$('#appendRowEd').empty();
		}

		var eduValue = $('#education option:selected').val();

		if(eduOnly.includes(eduValue)){
			Swal.fire({
				text: eduValue+" sudah terdaftar sebelumnya",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "OK",
				customClass: {
					confirmButton: "btn btn-light"
				}
			})
		}else{
			var post = {};
			post.education = $('#education option:selected').val();
			post.graduation_year = $('#graduation_year').val() == '' ? '0' : $('#graduation_year').val();

			edu.push(post);
			var rowId = $('#education option:selected').val();
			eduOnly.push(rowId);

			str += '<tr id="row_'+rowId+'">';
			str += '<td align="left">'+$('#education option:selected').text()+'</td>';
			str += '<td align="left">'+$('#graduation_year').val()+'</td>';
			str += '<td align="center"><a href="#" data-id="'+rowId+'" class="btn btn-sm fw-bold btn-danger deleteEduRow">&nbsp;<i class="fa fa-trash text-light"></i></a></td>';
			str += '</tr>';

			$('#appendRowEd').append(str);
			
			$('#kt_modal_1').modal('hide');

			$('#education').val(null).trigger('change');
			$('#graduation_year').val('');
		}
		
		return false;
	});

	$(document).on('click', '.deleteEduRow', function(){
		var id = $(this).attr('data-id');
		var str = '';

		var index = eduOnly.indexOf(id);
		if(index > -1){
			var rowV = eduOnly[index].education;

			eduOnly.splice(index,1);
			edu.splice(index,1);

			$('#row_'+rowV).remove();
		}

		if(edu.length == 0){
			str += '<tr>';
			str += '<td align="center" colspan="3">Belum ada data yang ditambahkan</td>';
			str += '</tr>';

			$('#appendRowEd').append(str);
		}

		return false;
	});

	$(document).on('click', '#applyKdrBtn', function(){
		var str = '';

		if(kdr.length == 0){
			$('#appendRowKdr').empty();
		}

		var kdrValue = $('#kdr_activity option:selected').val();

		if(kdrOnly.includes(kdrValue)){
			Swal.fire({
				text: kdrValue+" sudah terdaftar sebelumnya",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "OK",
				customClass: {
					confirmButton: "btn btn-light"
				}
			})
		}else{
			var post = {};
			post.activity = $('#kdr_activity option:selected').val();
			post.year = $('#kdr_year').val();

			kdr.push(post);
			var rowId = $('#kdr_activity option:selected').val();
			kdrOnly.push(rowId);

			str += '<tr id="rowKdr_'+rowId+'">';
			str += '<td align="left">'+$('#kdr_activity option:selected').text()+'</td>';
			str += '<td align="left">'+$('#kdr_year').val()+'</td>';
			str += '<td align="center"><a href="#" data-id="'+rowId+'" class="btn btn-sm fw-bold btn-danger deleteKdrRow">&nbsp;<i class="fa fa-trash text-light"></i></a></td>';
			str += '</tr>';

			$('#appendRowKdr').append(str);
			
			$('#kt_modal_5').modal('hide');

			$('#kdr_activity').val(null).trigger('change');
			$('#kdr_year').val('');
		}

		return false;
	});

	$(document).on('click', '.deleteKdrRow', function(){
		var id = $(this).attr('data-id');
		var str = '';

		var index = kdrOnly.indexOf(id);
		if(index > -1){
			var rowV = kdr[index].activity;

			kdrOnly.splice(index,1);
			kdr.splice(index,1);

			$('#rowKdr_'+rowV).remove();
		}

		if(kdr.length == 0){
			str += '<tr>';
			str += '<td align="center" colspan="3">Belum ada data yang ditambahkan</td>';
			str += '</tr>';

			$('#appendRowKdr').append(str);
		}

		return false;
	});

	$(document).on('click', '#applyPltBtn', function(){
		var str = '';

		if(plt.length == 0){
			$('#appendRowPlt').empty();
		}

		var pltValue = $('#plt_activity option:selected').val();

		if(pltOnly.includes(pltValue)){
			Swal.fire({
				text: pltValue+" sudah terdaftar sebelumnya",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "OK",
				customClass: {
					confirmButton: "btn btn-light"
				}
			})
		}else{
			var post = {};
			post.activity = $('#plt_activity option:selected').val();
			post.year = $('#plt_year').val();

			plt.push(post);
			var rowId = $('#plt_activity option:selected').val();
			pltOnly.push(rowId);

			str += '<tr id="rowPlt_'+rowId+'">';
			str += '<td align="left">'+$('#plt_activity option:selected').text()+'</td>';
			str += '<td align="left">'+$('#plt_year').val()+'</td>';
			str += '<td align="center"><a href="#" data-id="'+rowId+'" class="btn btn-sm fw-bold btn-danger deletePltRow">&nbsp;<i class="fa fa-trash text-light"></i></a></td>';
			str += '</tr>';

			$('#appendRowPlt').append(str);
			
			$('#kt_modal_6').modal('hide');

			$('#plt_activity').val(null).trigger('change');
			$('#plt_year').val('');
		}

		return false;
	});

	$(document).on('click', '.deletePltRow', function(){
		var id = $(this).attr('data-id');
		var str = '';

		var index = pltOnly.indexOf(id);
		if(index > -1){
			var rowV = plt[index].activity;

			pltOnly.splice(index,1);
			plt.splice(index,1);

			$('#rowPlt_'+rowV).remove();
		}

		if(plt.length == 0){
			str += '<tr>';
			str += '<td align="center" colspan="3">Belum ada data yang ditambahkan</td>';
			str += '</tr>';

			$('#appendRowPlt').append(str);
		}

		return false;
	});

	$(document).on('keyup', '#position', function(){
		var val = $(this).val();
		val = toTitleCase(val);
			
		$(this).val(val);
	});

	$(document).on('keyup', '#ext_position', function(){
		var val = $(this).val();
		val = toTitleCase(val);
			
		$(this).val(val);
	});

	$(document).on('keyup', '.txtCase', function(){
		var val = $(this).val();
		val = toTitleCase(val);
			
		$(this).val(val);
	});

	$(document).on('click', '#is_current', function(){
		var d = new Date();
		var year = d.getFullYear();

		var chk = $(this).is(":checked");

		if(chk){
			$('#end_year').val(year);
			$('#end_year').attr('readonly', true);
		}else{
			$('#end_year').attr('readonly', false);
		}
	});

	$(document).on('click', '#ext_is_current', function(){
		var d = new Date();
		var year = d.getFullYear();

		var chk = $(this).is(":checked");

		if(chk){
			$('#ext_end_year').val(year);
			$('#ext_end_year').attr('readonly', true);
		}else{
			$('#ext_end_year').attr('readonly', false);
		}
	});

	$(document).on('change', '#dpd', function(){
		var id = $(this).val();
		
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'GET',
			async:false, 
			url: '/dpc/'+id,
			dataType: 'json',
			success: function(resp) {
				$("#dpc").empty().trigger('change');
				var data = [];
				for(var i=0;i<resp.length;i++){
					var post = {};
					post.id = resp[i].dpc_id;
					post.text = resp[i].name;
					data.push(post);
				}

				$("#dpc").select2({
					data: data
				});
			}
		});
	});

	$('#university').select2({
		ajax: {
		  	url: '/university',
		  	data: function (params) {
				var query = {
					search: params.term,
					ptma: window.localStorage['ptma'],
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
		}
	});

	function makeid(length) {
		let result = '';
		const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		const charactersLength = characters.length;
		let counter = 0;
		while (counter < length) {
		  result += characters.charAt(Math.floor(Math.random() * charactersLength));
		  counter += 1;
		}
		return result;
	}

	function toTitleCase(str) {
		return str.replace(/(?:^|\s)\w/g, function(match) {
			return match.toUpperCase();
		});
	}
});