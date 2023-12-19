const images_festivals = document.getElementsByClassName("img-festival");
const images_spectacles = document.getElementsByClassName("img-spectacle");

console.log(images_festivals);


/**
 * //Si l'image ne se charge pas, mettre le background en gris
 * @param parent_image La div parent de l'image
 */
function handle_image_is_notload(parent_image) {
    let image = parent_image.children[0];
    if (image.complete) {
        parent_image.style.backgroundColor = "#cccccc";
        parent_image.style.padding = "1vh";
    }
}

for (let i = 0; i < images_festivals.length; i++) {
    handle_image_is_notload(images_festivals[i]);
}
for (let i = 0; i < images_spectacles.length; i++) {
    handle_image_is_notload(images_spectacles[i]);
}