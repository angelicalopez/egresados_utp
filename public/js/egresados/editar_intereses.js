$(document).ready(function() {
    const form = $('#form-update-intereses');
    $('.badge-delete').on('click', function() {
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

    $('.badge-danger').on('click', function() {
        console.log('entra');
        var id = $(this).attr('aria-id');
        alert(id);
        //$('#borrar-'+id).remove();
        $(this).removeClass('badge-danger');
        $(this).addClass('badge-success');
        $(this).addClass('badge-delete');
    });

    $('.badge-add').on('click', function() {
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

    

});

const toggleDelete = () => {
    console.log('click');
}