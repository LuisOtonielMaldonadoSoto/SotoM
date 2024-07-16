// Este script para obbtener el id del cliente seleccionado en la tabla para visulaizar el dato correcto del cliente.
// Se debe agregar este script en la vista donde se encuentran los elementos que activan el modal. 
// Espera a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Selecciona todos los botones que tienen la clase 'valor-btn'
    const valorButtons = document.querySelectorAll('.valor-btn');

    // Asigna un controlador de eventos de clic a cada botón
    valorButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // 'this' se refiere al botón que fue clickeado
            const notaId = this.getAttribute('data-id'); // Obtiene el ID de la nota
            console.log('ID de la nota:', notaId); // Muestra el ID en la consola
            // Aquí puedes hacer lo que necesites con notaId
        });
    });
});