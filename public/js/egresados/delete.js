$(document).ready(function() {
    $('.modal-delete').on('click', function() {
        var egresado_id = $(this).attr('aria-id');
        $('#delete_egresado_input').attr('value', egresado_id);
    });
});
