/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

window.addEventListener('DOMContentLoaded', (event) => {

    // Fonction pour basculer la classe de l'image
    function toggleZoom(event) {
        const element = event.target;
        element.classList.toggle('img-zoomed');
    }

    // Ajout de l'écouteur d'événements à chaque image
    const image1 = document.getElementById('image1');
    if (image1) {
		image1.addEventListener('click', toggleZoom);
	}
	const image2 = document.getElementById('image2');
	if (image2) {
		image2.addEventListener('click', toggleZoom);
	}

    const cocheUser = document.getElementById('register_form_roles_0');
    if (cocheUser) {
        cocheUser.setAttribute('disabled', true);
    }
});
