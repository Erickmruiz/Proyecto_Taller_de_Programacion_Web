document.addEventListener('DOMContentLoaded', function() {
  const cartCountElement = document.getElementById('cart-count');
  const cartButtons = document.querySelectorAll('.add-to-cart');
  const cartModal = document.getElementById('cart-modal');
  const closeCartBtn = document.getElementById('close-cart-btn');
  const cartItemsElement = document.getElementById('cart-items');
  
  let cartCount = 0;

  cartButtons.forEach(button => {
    button.addEventListener('click', function() {
      cartCount++;
      cartCountElement.textContent = cartCount;

      const productName = this.dataset.product;
      const productElement = document.createElement('div');
      productElement.textContent = productName;
      cartItemsElement.appendChild(productElement);
      
      if (!cartModal.classList.contains('active')) {
        cartModal.classList.add('active');
        cartModal.style.display = 'flex'; // Mostrar el modal
      }

      alert(`El producto "${productName}" ha sido agregado al carrito.`);
    });
  });

  document.getElementById('cart-btn').addEventListener('click', function() {
    cartModal.classList.toggle('active');
    if (cartModal.classList.contains('active')) {
      cartModal.style.display = 'flex';
    } else {
      cartModal.style.display = 'none';
    }
  });

  closeCartBtn.addEventListener('click', function() {
    cartModal.classList.remove('active');
    cartModal.style.display = 'none';
  });

  const catalogoBtn = document.getElementById('catalogo-btn');
  const catalogoContent = document.getElementById('catalogo-content');
  
  catalogoBtn.addEventListener('click', function() {
    catalogoContent.classList.toggle('active');
    catalogoBtn.classList.toggle('active');
  });
});

let cart = [];
let currentIndex = 0;
const slides = document.querySelector('.slides');
const dots = document.querySelectorAll('.dot');

// Función para agregar productos al carrito
function addToCart(product) {
    cart.push(product);
    updateCartDisplay();
}

// Función para mostrar el contenido del carrito
function updateCartDisplay() {
    const cartCount = document.getElementById('cartCount');
    const cartItems = document.getElementById('cartItems');
    const totalPrice = document.getElementById('totalPrice');

    cartCount.textContent = cart.length;

    cartItems.innerHTML = '';
    let total = 0;

    cart.forEach(product => {
        const li = document.createElement('li');
        li.textContent = product;
        cartItems.appendChild(li);
        total += 100; // Precio simulado para cada producto
    });

    totalPrice.textContent = total.toFixed(2);
}

// Función para vaciar el carrito
function clearCart() {
    cart = [];
    updateCartDisplay();
}

// Función para mostrar/ocultar los detalles del carrito
function toggleCartDetails() {
    const cartDetails = document.getElementById('cartDetails');
    cartDetails.style.display = cartDetails.style.display === 'block' ? 'none' : 'block';
}

// Funciones para el carrusel
function currentSlide(index) {
    currentIndex = index;
    updateSlidePosition();
    updateDots();
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.children.length;
    updateSlidePosition();
    updateDots();
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + slides.children.length) % slides.children.length;
    updateSlidePosition();
    updateDots();
}

function updateSlidePosition() {
    slides.style.transform = `translateX(-${currentIndex * 100}%)`;
}

function updateDots() {
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentIndex);
    });
}

// Función de búsqueda simplificada
function searchProducts() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    alert("Buscando productos de la marca: " + searchInput);
}

const slides = document.querySelectorAll('.slide');
const indicatorsContainer = document.querySelector('.indicators');

// Crear indicadores según la cantidad de imágenes
slides.forEach((slide, index) => {
  const dot = document.createElement('div');
  dot.classList.add('dot');
  dot.addEventListener('click', () => showSlide(index)); // Asignar acción al hacer click
  indicatorsContainer.appendChild(dot);
});

// Función para mostrar la imagen correspondiente al índice
let currentSlide = 0;

function showSlide(index) {
  const slidesContainer = document.querySelector('.slides');
  const dots = document.querySelectorAll('.dot');
  
  // Asegurar que el índice sea válido
  if (index < 0) index = slides.length - 1;
  if (index >= slides.length) index = 0;

  currentSlide = index;
  
  // Mover el carrusel a la imagen correspondiente
  slidesContainer.style.transform = `translateX(-${index * 100}%)`;

  // Actualizar los puntos indicadores
  dots.forEach(dot => dot.classList.remove('active'));
  dots[index].classList.add('active');
}

// Funciones para los botones de navegación
function nextSlide() {
  showSlide(currentSlide + 1);
}

function prevSlide() {
  showSlide(currentSlide - 1);
}

// Agregar eventos a los botones de navegación
document.querySelector('.next').addEventListener('click', nextSlide);
document.querySelector('.prev').addEventListener('click', prevSlide);

// Inicializar la primera imagen activa
showSlide(currentSlide);

document.addEventListener("DOMContentLoaded", function () {
  fetch("obtener_marcas.php")
      .then(response => response.json())
      .then(marcas => {
          const dropdown = document.getElementById("categoryDropdown");
          marcas.forEach(marca => {
              const option = document.createElement("option");
              option.value = marca.id;
              option.textContent = marca.nombre;
              dropdown.appendChild(option);
          });
      })
      .catch(error => console.error("Error al cargar las marcas:", error));
});

function searchProducts() {
  const brandDropdown = document.getElementById("categoryDropdown");
  const marcaId = brandDropdown.value;

  if (!marcaId) {
      alert("Por favor, selecciona una marca.");
      return;
  }

  fetch(`obtener_productos.php?marca_id=${marcaId}`)
      .then(response => response.json())
      .then(productos => {
          const mainContent = document.querySelector(".main-content");
          mainContent.innerHTML = ""; // Limpiar contenido actual

          if (productos.error) {
              mainContent.innerHTML = `<p>${productos.error}</p>`;
              return;
          }

          productos.forEach(producto => {
              const productSection = document.createElement("section");
              productSection.className = "brand-section";

              productSection.innerHTML = `
                  <h2>${producto.nombre_producto}</h2>
                  <img src="Imagenes/${producto.imagen}" alt="${producto.nombre_producto}">
                  <p>Precio: S/ ${producto.precio}</p>
                  <p>${producto.descripcion}</p>
              `;
              mainContent.appendChild(productSection);
          });
      })
      .catch(error => console.error("Error al cargar productos:", error));
}
document.addEventListener("DOMContentLoaded", function () {
  const logos = document.querySelectorAll(".brand-logo");

  logos.forEach(logo => {
      logo.addEventListener("click", function () {
          const marcaId = this.getAttribute("data-id");

          // Realizar la solicitud AJAX
          fetch(`productos_por_marca.php?marca_id=${marcaId}`)
              .then(response => response.json())
              .then(productos => {
                  const mainContent = document.querySelector(".main-content");
                  mainContent.innerHTML = ""; // Limpiar contenido actual

                  if (productos.error) {
                      mainContent.innerHTML = `<p>${productos.error}</p>`;
                      return;
                  }

                  productos.forEach(producto => {
                      const productSection = document.createElement("section");
                      productSection.className = "brand-section";

                      productSection.innerHTML = `
                          <h2>${producto.nombre_producto}</h2>
                          <img src="Imagenes/${producto.imagen}" alt="${producto.nombre_producto}">
                          <p>Precio: S/ ${producto.precio}</p>
                          <p>${producto.descripcion}</p>
                      `;
                      mainContent.appendChild(productSection);
                  });
              })
              .catch(error => console.error("Error al cargar productos:", error));
      });
  });
});

function searchProducts() {
    const query = document.getElementById("searchInput").value.toLowerCase();

    fetch(`fetch_laptops.php?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            const productGrid = document.querySelector(".product-grid");
            productGrid.innerHTML = ""; // Limpiar productos actuales

            if (data.length === 0) {
                productGrid.innerHTML = "<p>No se encontraron productos.</p>";
            } else {
                data.forEach(product => {
                    const productCard = document.createElement("div");
                    productCard.classList.add("product-card");

                    productCard.innerHTML = `
                        <img src="Imagenes/${product.imagen}" alt="${product.nombre}" class="product-image">
                        <h2>${product.nombre}</h2>
                        <p>${product.descripcion}</p>
                        <p class="stock">Stock: ${product.stock} Artículos</p>
                        <p class="brand">Marca: ${product.marca}</p>
                        <p class="price">$${product.precio.toFixed(2)}</p>
                        <button class="add-to-cart" onclick="addProductToCart('${product.nombre}')">Agregar al carrito</button>
                    `;

                    productGrid.appendChild(productCard);
                });
            }
        })
        .catch(error => {
            console.error("Error al buscar productos:", error);
        });
}


document.getElementById("searchInput").addEventListener("input", function () {
    const searchValue = this.value.trim().toLowerCase();
    const brandUrls = {
        acer: "pagina_acer.html",
        asus: "pagina_asus.html",
        benq: "pagina_benq.html",
        canon: "pagina_canon.html",
        corsair: "pagina_corsair.html",
        dell: "pagina_dell.html",
        epson: "pagina_epson.html",
    };

    // Mostrar sugerencia dinámica
    const suggestion = Object.keys(brandUrls).find(brand => brand.startsWith(searchValue));
    if (suggestion) {
        this.setAttribute("placeholder", `¿Quisiste decir "${suggestion}"?`);
    } else {
        this.setAttribute("placeholder", "Buscar marca...");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Seleccionar todas las imágenes con la clase 'brand-logo'
    const brandLogos = document.querySelectorAll(".brand-logo");

    // Agregar un evento de clic a cada logo
    brandLogos.forEach(logo => {
        logo.addEventListener("click", function () {
            // Obtener la URL de destino desde el atributo 'data-url'
            const targetUrl = this.getAttribute("data-url");
            if (targetUrl) {
                window.location.href = targetUrl; // Redirigir a la página
            }
        });
    });
});
