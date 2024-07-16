// Este scrpt funciona para que solo se pueda tener un elemento colapsable abierto a la vez.
// Si se abre uno, los demás se cierran automáticamente.
// Se debe agregar este script en la vista donde se encuentran los elementos colapsables.
$(document).ready(function() {
    $('.collapse').on('show.bs.collapse', function() {
    // Cierra todos los elementos colapsables
    $('.collapse').collapse('hide');
    // Abre el elemento actual. Bootstrap se encarga de esto automáticamente, así que no es necesario hacerlo manualmente aquí.
    });
});