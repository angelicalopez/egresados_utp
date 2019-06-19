$(document).ready(function() {
    $('.modal-delete').on('click', function() {
        var admin_id = $(this).attr('aria-id');
        $('#delete_admin_input').attr('value', admin_id);
    });
});
