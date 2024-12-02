var cartItems = []; // Array para almacenar los productos del carrito

function toggleCartDetails() {
    var cartDetails = document.getElementById("cartDetails");
    cartDetails.style.display = cartDetails.style.display === "none" || cartDetails.style.display === "" ? "block" : "none";
    updateCart();
}

function updateCart() {
    var cartList = document.getElementById("cartList");
    var cartCount = document.getElementById("cartCount");
    cartList.innerHTML = ""; // Limpiar la lista antes de agregar productos

    if (cartItems.length === 0) {
        cartList.innerHTML = "<li>El carrito está vacío</li>";
        cartCount.textContent = "0"; // Si el carrito está vacío, mostrar 0
    } else {
        cartItems.forEach(function(item) {
            var li = document.createElement("li");
            li.textContent = item;
            cartList.appendChild(li);
        });
        cartCount.textContent = cartItems.length; // Mostrar el número de productos en el carrito
    }
}

// Simulación de agregar productos al carrito
function addProductToCart(productName) {
    cartItems.push(productName);
    updateCart();
}

// Función para vaciar el carrito
function clearCart() {
    cartItems = [];
    updateCart();
}

// Para pruebas, agrega productos automáticamente
addProductToCart("Laptop Dell XPS 13");
addProductToCart("Mouse Logitech");
