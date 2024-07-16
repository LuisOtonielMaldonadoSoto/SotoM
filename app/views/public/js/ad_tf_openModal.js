// Este script sirve para abrir un modal y cerrar el modal anterior si es que hay uno abierto.
// Se debe agregar este script en la vista donde se encuentran los elementos que activan el modal.
$(document).ready(function() {
    var modalsState = {
        currentOpen: null,
        previousOpen: null
    };

    function openModal(targetModalId) {
        var targetModal = $(targetModalId);
        if (modalsState.currentOpen) {
            // Se cierra el modal actual y se establece un callback para abrir el nuevo modal después de que se haya cerrado completamente.
            $(modalsState.currentOpen).modal('hide').on('hidden.bs.modal', function () {
                // Este callback se asegura de que el modal anterior se abra solo después de que el modal actual se haya cerrado completamente.
                $(this).off('hidden.bs.modal'); // Remueve el listener para evitar que se dispare múltiples veces
                setTimeout(function() {
                    targetModal.modal('show');
                }, 300);
            });
            modalsState.previousOpen = modalsState.currentOpen;
        } else {
            // Si no hay un modal abierto actualmente, simplemente abre el nuevo modal.
            setTimeout(function() {
                targetModal.modal('show');
            }, 300);
        }
        modalsState.currentOpen = targetModalId;
    }

    function closeModalAndReopenPrevious() {
        $(modalsState.currentOpen).modal('hide');
        if (modalsState.previousOpen) {
            setTimeout(function() {
                $(modalsState.previousOpen).modal('show');
                modalsState.currentOpen = modalsState.previousOpen;
                modalsState.previousOpen = null;
            }, 300);
        } else {
            modalsState.currentOpen = null;
        }
    }

    $('.btn[data-target]').click(function() {
        var targetModalId = $(this).data('target');
        openModal(targetModalId);
    });

    $('.modal').on('hidden.bs.modal', function() {
        // Asegúrate de que este evento no interfiera con el callback de 'hidden.bs.modal' definido en openModal
        if (!modalsState.previousOpen) {
            closeModalAndReopenPrevious();
        }
    });
});