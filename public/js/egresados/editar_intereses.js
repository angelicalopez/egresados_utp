$(document).ready(function() {
    const form = $('#form-update-intereses');

    $(document).on('click', '.badge-delete', function() {
        var id = $(this).attr('aria-id');
        
        $('<input>').attr({
            type: 'hidden',
            name: 'borrar_intereses[]',
            value: id,
            id: "borrar-" + id
        }).appendTo(form);

        $(this).removeClass('badge-delete');
        $(this).removeClass('badge-success');
        $(this).addClass('badge-danger');
    });

    $(document).on('click', '.badge-danger', function() {
        var id = $(this).attr('aria-id');
        $('#borrar-'+id).remove();
        $(this).removeClass('badge-danger');
        $(this).addClass('badge-delete');
        $(this).addClass('badge-success');
    });

    $(document).on('click', '.badge-add', function() {
        var id = $(this).attr('aria-id');
        
        $('<input>').attr({
            type: 'hidden',
            name: 'agregar_intereses[]',
            value: id,
            id: "agregar-" + id
        }).appendTo(form);

        $(this).removeClass('badge-add');
        $(this).removeClass('badge-secondary');
        $(this).addClass('badge-info');
    });

    $(document).on('click', '.badge-info', function() {
        var id = $(this).attr('aria-id');
        $('#agregar-'+id).remove();
        $(this).removeClass('badge-info');
        $(this).addClass('badge-add');
        $(this).addClass('badge-secondary');
    });

    

});

const toggleDelete = () => {
    console.log('click');
}