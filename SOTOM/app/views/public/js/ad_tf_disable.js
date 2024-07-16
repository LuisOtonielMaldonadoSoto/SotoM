// Este script sirve para deshabilitar los botones de aprobación hasta que el usuario haya revisado el documento.
// Se debe agregar este script en la vista donde se encuentran los elementos que activan el modal.
document.addEventListener('DOMContentLoaded', function() {
    // Vincula el evento change al checkbox
    document.getElementById("usuarioHaRevisado").addEventListener('change', function() {
        // Habilita o deshabilita los botones basado en el estado del checkbox
        var revisado = this.checked;
        document.getElementById("btnAprobado").disabled = !revisado;
    });
});