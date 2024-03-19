(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

function submitForm(url) {
	var form = document.createElement('form');
	form.setAttribute('method', 'post');
	form.setAttribute('action', window.location.href); // Envía el formulario a la misma URL actual
	
	var input = document.createElement('input');
	input.setAttribute('type', 'hidden');
	input.setAttribute('name', 'pagination_url');
	input.setAttribute('value', url);
	form.appendChild(input);
	
	document.body.appendChild(form);
	form.submit();
}

document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los elementos con la clase .row-title.pokeshortcode
    var pokeshortcodeElements = document.querySelectorAll('.row-title.pokeshortcode');
    
    // Agregar un evento de clic a cada uno de ellos
    pokeshortcodeElements.forEach(function(element) {
        element.addEventListener('click', function() {
            // Copiar el contenido del elemento al portapapeles
            var textToCopy = this.innerText;
            navigator.clipboard.writeText(textToCopy)
                .then(function() {
                    console.log('Texto copiado al portapapeles: ' + textToCopy);
                    // Puedes agregar aquí una notificación o realizar otras acciones después de copiar el texto
                })
                .catch(function(error) {
                    console.error('Error al copiar el texto: ', error);
                });
        });
    });
});