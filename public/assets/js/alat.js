$(document).ready(function() {
    // Event listener for modal shown
    $('[data-bs-target^="#modalAlat"]').on('shown.bs.modal', function (e) {
        // Get the id_alat from the data attribute
        var idAlat = $(this).data('id');

        // Call function to load QR code
        loadQRCode(idAlat);
    });

    // Function to load QR code
    function loadQRCode(idAlat) {
        // AJAX request to server to generate QR code
        $.ajax({
            url: '/generate-qrcode/' + idAlat,
            type: 'GET',
            success: function(response) {
                // Display QR code in modal
                $('#modalAlat-' + idAlat + ' .modal-body').html('<img src="' + response.qrCodeUrl + '" alt="QR Code">');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});
