function changeImage(element) {
    const img = element.querySelector(".product-image");
    const originalSrc = img.src;

    // Definir las imágenes alternativas para cada desktop
    if (originalSrc.includes("acer-predator")) {
        img.src = "Imagenes/acer-predator-hover.jpg";
    } else if (originalSrc.includes("asus-rog")) {
        img.src = "Imagenes/asus-rog-hover.jpg";
    } else if (originalSrc.includes("dell-gaming")) {
        img.src = "Imagenes/dell-gaming-hover.jpg";
    } else if (originalSrc.includes("hp-omen")) {
        img.src = "Imagenes/hp-omen-hover.jpg";
    }
}

function resetImage(element) {
    const img = element.querySelector(".product-image");

    // Volver a las imágenes originales
    if (img.src.includes("hover")) {
        if (img.src.includes("acer-predator-hover")) {
            img.src = "Imagenes/acer-predator.jpg";
        } else if (img.src.includes("asus-rog-hover")) {
            img.src = "Imagenes/asus-rog.jpg";
        } else if (img.src.includes("dell-gaming-hover")) {
            img.src = "Imagenes/dell-gaming.jpg";
        } else if (img.src.includes("hp-omen-hover")) {
            img.src = "Imagenes/hp-omen.jpg";
        }
    }
}
