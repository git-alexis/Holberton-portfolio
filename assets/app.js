/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// Fonction pour basculer la classe de l'image
function toggleZoom(event) {
    const element = event.target;
    element.classList.toggle('img-zoomed');
}

// Ajout de l'écouteur d'événements à chaque image
document.getElementById('image1').addEventListener('click', toggleZoom);
document.getElementById('image2').addEventListener('click', toggleZoom);

/*document.addEventListener('DOMContentLoaded', function(event) {
    var thumbnail_1Element = document.getElementById("smart_thumbnail_1");
    var thumbnail_2Element = document.getElementById("smart_thumbnail_2");
    if (thumbnail_1Element) {
        thumbnail_1Element.addEventListener("click", function() {
            if (thumbnail_1Element.className == "") {
                thumbnail_1Element.className = "small";
            } else {
                thumbnail_1Element.className = "";
            }
        });
    }
    if (thumbnail_2Element) {
        thumbnail_2Element.addEventListener("click", function() {
            if (thumbnail_2Element.className == "") {
                thumbnail_2Element.className = "small";
            } else {
                thumbnail_2Element.className = "";
            }
        });
    }
});*/
