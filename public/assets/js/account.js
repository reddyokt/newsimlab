/*----------------------jsaccount-------------------------*/
$(document).on('change', '#role', function () {
    var val = $(this).val();

    if (val == 2) {

        $('#divmajelis').css("display", "none");
        $('#divpda').css("display", "none");

        } else if (val == 3) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/account/pda',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#pda').append($('<option>').val(option.pda_id).text(option.pda_name));
                    });
                }
            });

            $('#pda').html("")
            $('#divmajelis').css("display", "none");
            $('#divpda').css("display", "flex");

        } else if (val == 4) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/account/majelis',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#majelis').append($('<option>').val(option.id_majelis).text(option.name));
                    });
                }
            });

            $('#majelis').html("")
            $('#divmajelis').css("display", "flex");
            $('#divpda').css("display", "none");

        } else if (val == 5) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/account/majelis',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#majelis').append($('<option>').val(option.id_majelis).text(option.name));
                    });
                }
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/account/pda',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#pda').append($('<option>').val(option.pda_id).text(option.pda_name));
                    });
                }
            });

            $('#pda').html("")
            $('#majelis').html("")
            $('#divpda').css("display", "flex");
            $('#divmajelis').css("display", "flex");

        }else if (val == 6) {

                $('#divmajelis').css("display", "none");
                $('#divpda').css("display", "none");

        } else if (val == 7) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/account/pda',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#pda').append($('<option>').val(option.pda_id).text(option.pda_name));
                    });
                }
            });

            $('#divpda').css("display", "flex");
            $('#divmajelis').css("display", "none");


        } else if (val == 8) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/account/majelis',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#majelis').append($('<option>').val(option.id_majelis).text(option.name));
                    });
                }
            });

            $('#majelis').html("")
            $('#divmajelis').css("display", "flex");
            $('#divpda').css("display", "none");

        } else if (val == 9) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/account/majelis',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#majelis').append($('<option>').val(option.id_majelis).text(option.name));
                    });
                }
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/account/pda',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#pda').append($('<option>').val(option.pda_id).text(option.pda_name));
                    });
                }
            });

            $('#pda').html("")
            $('#majelis').html("")
            $('#divpda').css("display", "flex");
            $('#divmajelis').css("display", "flex");
        }

    });

    
/*-----------------jskader---------------------------------*/
$(document).on('change', '#pda', function () {
    var id = $(this).val();
    $('#pca').html("");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        url: '/kader/pcabypda/' + id,
        success: function (data) {
            $.each(data, function (index, option) {
                $('#pca').append($('<option>').val(option.pca_id).text(option.pca_name));
            });
        }
    });
    $('#divpca').css("display", "flex");

});

$(document).on('change', '#pdaforpca', function () {
    var id = $(this).val();
    $('#districts').html("");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        url: '/pca/pdabydistricts/' + id,
        success: function (data) {
            $.each(data, function (index, option) {
                $('#districts').append($('<option>').val(option.id).text(option.name));
            });
        }
    });
    $('#divdistricts').css("display", "flex");

});

$(document).on('change', '#pcaforranting', function () {
    var id = $(this).val();
    $('#villages').html("");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        url: '/ranting/pcabyvillages/' + id,
        success: function (data) {
            $.each(data, function (index, option) {
                $('#villages').append($('<option>').val(option.id).text(option.name));
            });
        }
    });
    $('#divvillages').css("display", "flex");

});

$(document).on('click', '#pengelola1', function () {
    var val = $(this).val();
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/aum/aumbyranting',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#rantings').append($('<option>').val(option.ranting_id).text(option.ranting_name));
                    });
                }
            });

            $('#rantings').html("")
            $('#rantings').removeAttr('disabled');
            $('#divrantings').css("display", "initial");
            $('#divpcas').css("display", "none");
            $('#divpdas').css("display", "none");
            $('#pdas').attr('disabled', true);
            $('#pcas').attr('disabled',true);
});

$(document).on('click', '#pengelola2', function () {
        var val = $(this).val(); 
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/aum/aumbypca',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#pcas').append($('<option>').val(option.pca_id).text(option.pca_name));
                    });
                }
            });
            
            $('#pcas').html("")
            $('#pcas').removeAttr('disabled');
            $('#divpcas').css("display", "initial");
            $('#divrantings').css("display", "none");
            $('#divpdas').css("display", "none");
            $('#pdas').attr('disabled', true);
            $('#rantings').attr('disabled',true);

});

$(document).on('click', '#pengelola3', function () {
    var val = $(this).val(); 
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/aum/aumbypda',
                success: function (data) {
                    $.each(data, function (index, option) {
                        $('#pdas').append($('<option>').val(option.pda_id).text(option.pda_name));
                    });
                }
            });

            $('#pdas').html("")
            $('#pdas').removeAttr('disabled');
            $('#divpdas').css("display", "initial");
            $('#divrantings').css("display", "none");
            $('#divpcas').css("display", "none");
            $('#rantings').attr('disabled', true);
            $('#pcas').attr('disabled', true);
        
});
/*--------------------------------------------------------------------------------------------*/

$(document).on('keydown', '.nums', function(e) {
    if (!((e.keyCode > 95 && e.keyCode < 106) ||
            (e.keyCode > 47 && e.keyCode < 58) ||
            e.keyCode == 8)) {
        return false;
    }
});

$(document).on('keyup', '.nums', function() {
    var n = parseInt($(this).val().replace(/\D/g, ''), 10);
    if($(this).val() == ''){
        $(this).val("0");
    } else {
        $(this).val(n.toLocaleString());
    }
});
