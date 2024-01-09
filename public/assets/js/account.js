/*----------------------jsaccount-------------------------*/
$(document).on('change', '#role', function(){
    var val = $(this).val();

    if(val == 3) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '/account/pda',
            success: function(data) {
                $.each(data, function(index, option) {
                    $('#pda').append($('<option>').val(option.pda_id).text(option.pda_name));
                });
            }
        });

        $('#pda').html("")

        $('#divpda').css("display", "flex");
    } else if (val == 7) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '/account/pda',
            success: function(data) {
                $.each(data, function(index, option) {
                    $('#pda').append($('<option>').val(option.pda_id).text(option.pda_name));
                });
            }
        });

        $('#divpda').css("display", "flex");

    } else if (val == 9) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        url: '/account/pda',
        success: function(data) {
            $.each(data, function(index, option) {
                $('#pda').append($('<option>').val(option.pda_id).text(option.pda_name));
            });
        }
    });

    $('#divpda').css("display", "flex");
} else {
    $('#pda').html("")
    $('#divpda').css("display", "none");
}

});

/*-----------------jskader---------------------------------*/
$(document).on('change', '#pda', function(){
    var id = $(this).val();
    $('#pca').html("");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        url: '/kader/pcabypda/'+id,
        success: function(data) {
            $.each(data, function(index, option) {
                $('#pca').append($('<option>').val(option.pca_id).text(option.pca_name));
            });
        }
    });
    $('#divpca').css("display", "flex");

});