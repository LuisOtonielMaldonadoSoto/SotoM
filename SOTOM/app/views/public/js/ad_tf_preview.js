// Este script sirve para mostrar un modal con un iframe que contiene el tarifario seleccionado.
// Se debe agregar este script en la vista donde se encuentran los elementos que activan el modal.
$(document).ready(function(){
    $('#previewModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Boton que activa el modal
        var tarifarioId = button.data('tarifario-id') // Extraer la información de atributos de datos
        var modal = $(this)
        // Aqui se establece la url del iframe con el tarifario_id como parametro
        var url = "" +tarifarioId;
        // Establece la url del iframe
        modal.find('#previewIframe').html('src', url);
    
    })
});