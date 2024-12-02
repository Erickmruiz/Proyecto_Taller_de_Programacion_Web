-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2024 a las 16:25:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laclinicabd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'Laptops'),
(2, 'Desktops'),
(3, 'Accesorios'),
(4, 'Componentes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` varchar(10) NOT NULL,
  `id_producto` varchar(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalles_pedido`
--

INSERT INTO `detalles_pedido` (`id_detalle`, `id_pedido`, `id_producto`, `nombre_producto`, `precio`, `cantidad`, `subtotal`) VALUES
(1, '0001', '1', 'Asus Vivobook', 750.00, 3, 2250.00),
(2, '0001', '3', 'HP Pavilion', 700.00, 1, 700.00),
(3, '0002', '2', 'Dell Inspiron', 850.00, 1, 850.00),
(4, '0002', '3', 'HP Pavilion', 700.00, 1, 700.00),
(5, '0003', '00004', 'Teclado Logitech', 50.00, 1, 50.00),
(6, '0003', '00005', 'Disco Duro Seagate', 60.00, 1, 60.00),
(7, '0004', '00004', 'Teclado Logitech', 50.00, 1, 50.00),
(8, '0005', '00005', 'Disco Duro Seagate', 60.00, 1, 60.00),
(9, '0006', '00001', 'Asus Vivobook', 750.00, 1, 750.00),
(10, '0006', '00004', 'Teclado Logitech', 50.00, 1, 50.00),
(11, '0007', '00003', 'HP Pavilion', 700.00, 1, 700.00),
(12, '0008', '00001', 'Asus Vivobook', 750.00, 1, 750.00),
(13, '0009', '00002', 'Dell Inspiron', 850.00, 1, 850.00),
(14, '0010', '00003', 'HP Pavilion', 700.00, 1, 700.00),
(15, '0011', '00001', 'Asus Vivobook', 750.00, 1, 750.00),
(16, '0012', '00003', 'HP Pavilion', 700.00, 1, 700.00),
(17, '0013', '00003', 'HP Pavilion', 700.00, 1, 700.00),
(18, '0014', '00002', 'Dell Inspiron', 850.00, 1, 850.00),
(19, '0017', '00001', 'Asus Vivobook', 750.00, 1, 750.00),
(20, '0018', '00004', 'Teclado Logitech', 50.00, 1, 50.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre_marca`) VALUES
(1, 'Asus'),
(2, 'HP'),
(3, 'Dell'),
(4, 'Lenovo'),
(5, 'Acer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` varchar(10) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha_pedido` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `nombre_cliente`, `correo`, `metodo_pago`, `fecha_pedido`, `total`, `estado`) VALUES
('0001', 'JHAIR', 'jmruiizz@gmail.com', 'Transferencia', '2024-11-30 22:26:48', 2950.00, 'Pendiente'),
('0002', 'JHAIR', 'jmruiizz@gmail.com', 'Efectivo', '2024-11-30 22:29:56', 1550.00, 'Pendiente'),
('0003', 'JHAIR', 'jmruiizz@gmail.com', 'Transferencia', '2024-11-30 22:30:59', 110.00, 'Pendiente'),
('0004', 'JHAIR', 'jmruiizz@gmail.com', 'Tarjeta', '2024-11-30 22:33:34', 50.00, 'Pendiente'),
('0005', 'JHAIR', 'jmruiizz@gmail.com', 'tarjeta', '2024-11-30 22:47:59', 60.00, 'Pendiente'),
('0006', 'JHAIR', 'jmruiizz@gmail.com', 'tarjeta', '2024-11-30 22:55:52', 800.00, 'Pendiente'),
('0007', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:12:13', 700.00, 'Pendiente'),
('0008', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:17:46', 750.00, 'Pendiente'),
('0009', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:19:56', 850.00, 'Pendiente'),
('0010', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:20:33', 700.00, 'Pendiente'),
('0011', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:24:31', 750.00, 'Pendiente'),
('0012', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:25:53', 700.00, 'Pendiente'),
('0013', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:33:35', 700.00, 'Pendiente'),
('0014', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:34:37', 850.00, 'Pendiente'),
('0015', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:34:52', 0.00, 'Pendiente'),
('0016', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:35:11', 0.00, 'Pendiente'),
('0017', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:36:21', 750.00, 'Pendiente'),
('0018', 'JHAIR', 'jmruiizz@gmail.com', 'transferencia', '2024-11-30 23:50:45', 50.00, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_producto` varchar(6) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_marca` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` enum('A','I') DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_producto`, `nombre`, `descripcion`, `id_marca`, `id_categoria`, `precio`, `cantidad`, `imagen`, `estado`) VALUES
(1, '00001', 'Asus Vivobook', 'Laptop portátil con procesador Intel i5', 1, 1, 750.00, 10, 'Imagenes/asus_vivobook.jpg', 'A'),
(2, '00002', 'Dell Inspiron', 'Laptop de uso profesional con gran rendimiento', 3, 1, 850.00, 5, 'Imagenes/dell_inspiron.jpg', 'A'),
(3, '00003', 'HP Pavilion', 'Laptop ideal para el trabajo y entretenimiento', 2, 1, 700.00, 8, 'Imagenes/hp_pavilion.jpg', 'A'),
(4, '00004', 'Teclado Logitech', 'Teclado mecánico con iluminación RGB', 3, 3, 50.00, 20, 'Imagenes/teclado_logitech.jpg', 'A'),
(5, '00005', 'Disco Duro Seagate', 'Disco duro externo de 1TB', 4, 4, 60.00, 15, 'Imagenes/disco_duro_seagate.jpg', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contrasena`, `role_id`, `role`) VALUES
(1, 'Jean Celiz Paredes', 'jeancp1291@gmail.com', '$2y$10$NF/0.Q46ct2w6Hz0kohpauyHKv3LjIVat1xjRTEaM5S2e1SLXEUZG', NULL, 'admin'),
(2, 'erick manuel', 'erick.manuel@gmail.com', '$2y$10$4piw9/wF4I.lppmVhswrbeTAfvEpsh1UXi0PsVHKmqaU2bkO6CQry', NULL, NULL),
(3, 'juan martin', 'romero_art45@hotmail.com', '$2y$10$OW/XM2Nbyl2J9Ak7E.78QeBMba1l7fYHEasakcQXVSa4iKKgQyege', NULL, NULL),
(4, 'ruth garcia', 'ruth.garcia@gmail.com', '$2y$10$qjpBVn3VYyRqJ4pJ/h2zfON/i/X77pggcY4J38dXosuW014uHqAeO', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_role` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
