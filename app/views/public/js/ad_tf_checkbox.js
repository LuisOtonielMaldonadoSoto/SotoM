// Este script permite seleccionar todos los checkboxes de un contenedor cuando se selecciona un checkbox "Seleccionar Todo"
// Se debe agregar este script en la vista donde se encuentran los elementos que activan el modal.
$(document).ready(function() {
    // Cuando el estado de cualquier checkbox "Seleccionar Todo" cambia
    $('.selectAll').change(function() {
        // Obtiene el estado actual del checkbox "Seleccionar Todo"
        var isChecked = $(this).prop('checked');
        // Establece el estado de todos los otros checkboxes en el mismo contenedor basado en el estado de "Seleccionar Todo"
        $(this).closest('.modal-content').find('.checkboxes-container .form-check-input').prop('checked', isChecked);
    });
});