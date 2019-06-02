$(document).ready(function() {
    $('#add-file').on('click', function() {
        $('#input-archivo').clone().appendTo('#archivos');
    });
    $('#add-image').on('click', function() {
        $('#input-imagen').clone().appendTo('#imagenes');
    });
    $('#add-video').on('click', function() {
        $('#input-video').clone().appendTo('#videos');
    });
});