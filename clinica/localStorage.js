// Obtener los productos del carrito desde el localStorage al cargar la página
var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

// Obtener el nombre del usuario desde el localStorage
var username = localStorage.getItem("username");

// Función para actualizar la vista del carrito
function updateCart() {
    var cartList = document.getElementById("cartList");
    var cartCount = document.getElementById("cartCount");

    // Limpiar la lista de productos
    cartList.innerHTML = '';

    // Agregar productos al carrito
    cartItems.forEach(function(item) {
        var li = document.createElement("li");
        li.textContent = item;
        cartList.appendChild(li);
    });

    // Actualizar el número de artículos en el carrito
    cartCount.textContent = cartItems.length;

    // Guardar el carrito en el localStorage
    localStorage.setItem("cartItems", JSON.stringify(cartItems));
}

// Agregar un producto al carrito
function addProductToCart(productName) {
    cartItems.push(productName);
    updateCart(); // Actualizar el desglose del carrito
}

// Vaciar el carrito
function clearCart() {
    cartItems = [];
    updateCart(); // Limpiar el carrito y actualizar la vista
}

// Mostrar el desglose del carrito
function toggleCartDetails() {
    var cartDetails = document.getElementById("cartDetails");
    cartDetails.style.display = cartDetails.style.display === "block" ? "none" : "block";
}

// Función de búsqueda (solo muestra alerta por ahora)
function searchProducts() {
    var query = document.getElementById("searchInput").value.toLowerCase();
    alert("Buscando productos para: " + query);
}

// Mostrar el nombre del usuario si está logueado
window.onload = function() {
    if (username) {
        // Mostrar el nombre del usuario logueado
        document.getElementById("userLoggedIn").textContent = "Bienvenido, " + username;
    } else {
        // Si no hay usuario logueado, mostrar "Iniciar sesión"
        document.getElementById("userLoggedIn").textContent = "Iniciar sesión";
    }

    // Inicializar el carrito al cargar la página
    updateCart();
};
