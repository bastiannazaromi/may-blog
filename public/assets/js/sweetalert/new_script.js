let flash_sukses = $('.flash-sukses').data('flashdata');
let flash_error = $('.flash-error').data('flashdata');

if (flash_sukses) {
    Swal.fire({
        title: 'Sukses',
        text: flash_sukses,
        icon: 'success'
    });
}

if (flash_error) {
    Swal.fire({
        title: 'Sorry !!',
        text: flash_error,
        icon: 'warning'
    });
}