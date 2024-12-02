function changeImage(element) {
    const img = element.querySelector(".product-image");
    const originalSrc = img.src;
    
    // Definir las imágenes alternativas para cada laptop
    if (originalSrc.includes("acer-aspire")) {
        img.src = "Imagenes/acer-aspire-hover.jpg";
    } else if (originalSrc.includes("asus-zenbook")) {
        img.src = "Imagenes/asus-zenbook-hover.jpg";
    } else if (originalSrc.includes("dell-xps")) {
        img.src = "Imagenes/dell-xps-hover.jpg";
    }
}

function resetImage(element) {
    const img = element.querySelector(".product-image");
    
    // Volver a las imágenes originales
    if (img.src.includes("hover")) {
        if (img.src.includes("acer-aspire-hover")) {
            img.src = "Imagenes/acer-aspire.jpg";
        } else if (img.src.includes("asus-zenbook-hover")) {
            img.src = "Imagenes/asus-zenbook.jpg";
        } else if (img.src.includes("dell-xps-hover")) {
            img.src = "Imagenes/dell-xps.jpg";
        }
    }
}

