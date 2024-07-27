$(document).ready(function() {
    // Mengambil hash dari URL saat ini
    var hash = window.location.hash;

    // Periksa apakah hash ada dan sesuai dengan ID tab-pane yang ingin Anda buka
    if (hash && $('a[href="' + hash + '"]').length) {
        // Aktifkan tab yang sesuai dengan hash
        $('a[href="' + hash + '"]').tab('show');
    }

    // Tangani perubahan hash saat tombol kembali atau navigasi
    $(window).on('hashchange', function() {
        var newHash = window.location.hash;

        // Periksa apakah hash ada dan sesuai dengan ID tab-pane yang ingin Anda buka
        if (newHash && $('a[href="' + newHash + '"]').length) {
            // Aktifkan tab yang sesuai dengan hash
            $('a[href="' + newHash + '"]').tab('show');
        }
    });
});
