-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2024 a las 08:32:48
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
-- Base de datos: `guia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_ambiente`
--

CREATE TABLE `guia_ambiente` (
  `id_ambiente` int(11) NOT NULL,
  `nombre_ambiente` varchar(30) NOT NULL,
  `descripcion_ambiente` text NOT NULL,
  `ubicacion_ambiente` varchar(100) NOT NULL,
  `categoria_ambiente` int(11) NOT NULL,
  `piso_ambiente` int(11) NOT NULL,
  `encargado_ambiente` int(11) DEFAULT NULL,
  `img_ambiente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_categoria`
--

CREATE TABLE `guia_categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion_categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_encargado`
--

CREATE TABLE `guia_encargado` (
  `ci_encargado` int(11) NOT NULL,
  `nombres_encargado` varchar(50) NOT NULL,
  `apellido_p_encargado` varchar(50) NOT NULL,
  `apellido_m_encargado` varchar(50) NOT NULL,
  `celular_encargado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_img`
--

CREATE TABLE `guia_img` (
  `id_img` int(11) NOT NULL,
  `nombre_img` varchar(50) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_piso`
--

CREATE TABLE `guia_piso` (
  `id_piso` int(11) NOT NULL,
  `lugar` varchar(30) NOT NULL,
  `descripcion_piso` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_usuarios`
--

CREATE TABLE `guia_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `guia_usuarios`
--

INSERT INTO `guia_usuarios` (`id_usuario`, `usuario`, `contrasena`, `estado`) VALUES
(1, 'admin', 'zxcv1234', NULL),
(2, '123', '123', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `guia_ambiente`
--
ALTER TABLE `guia_ambiente`
  ADD PRIMARY KEY (`id_ambiente`),
  ADD KEY `fk_categoria` (`categoria_ambiente`),
  ADD KEY `fk_piso` (`piso_ambiente`),
  ADD KEY `fk_encargado` (`encargado_ambiente`),
  ADD KEY `fk_img` (`img_ambiente`);

--
-- Indices de la tabla `guia_categoria`
--
ALTER TABLE `guia_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `guia_encargado`
--
ALTER TABLE `guia_encargado`
  ADD PRIMARY KEY (`ci_encargado`);

--
-- Indices de la tabla `guia_img`
--
ALTER TABLE `guia_img`
  ADD PRIMARY KEY (`id_img`);

--
-- Indices de la tabla `guia_piso`
--
ALTER TABLE `guia_piso`
  ADD PRIMARY KEY (`id_piso`);

--
-- Indices de la tabla `guia_usuarios`
--
ALTER TABLE `guia_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `guia_ambiente`
--
ALTER TABLE `guia_ambiente`
  MODIFY `id_ambiente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `guia_categoria`
--
ALTER TABLE `guia_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `guia_img`
--
ALTER TABLE `guia_img`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `guia_piso`
--
ALTER TABLE `guia_piso`
  MODIFY `id_piso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `guia_usuarios`
--
ALTER TABLE `guia_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `guia_ambiente`
--
ALTER TABLE `guia_ambiente`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria_ambiente`) REFERENCES `guia_categoria` (`id_categoria`),
  ADD CONSTRAINT `fk_encargado` FOREIGN KEY (`encargado_ambiente`) REFERENCES `guia_encargado` (`ci_encargado`),
  ADD CONSTRAINT `fk_img` FOREIGN KEY (`img_ambiente`) REFERENCES `guia_img` (`id_img`),
  ADD CONSTRAINT `fk_piso` FOREIGN KEY (`piso_ambiente`) REFERENCES `guia_piso` (`id_piso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
