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
