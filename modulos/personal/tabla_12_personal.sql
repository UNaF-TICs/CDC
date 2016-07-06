-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2016 a las 22:45:25
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_cuaderno_campo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_12_personal`
--

CREATE TABLE `tabla_12_personal` (
  `id_tabla12` int(11) NOT NULL,
  `tabla12_nombre_empresa` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rela_tabla09` int(11) NOT NULL,
  `tabla12_dni_nif` int(10) DEFAULT NULL,
  `tabla12_num_carne` int(20) DEFAULT NULL,
  `tabla12_email` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tabla12_telefono` int(20) DEFAULT NULL,
  `tabla12_direccion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tabla12_comentario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tabla_12_personal`
--

INSERT INTO `tabla_12_personal` (`id_tabla12`, `tabla12_nombre_empresa`, `rela_tabla09`, `tabla12_dni_nif`, `tabla12_num_carne`, `tabla12_email`, `tabla12_telefono`, `tabla12_direccion`, `tabla12_comentario`) VALUES
(3, 'asdsdf', 2, 3143, 876, 'asdf@gmail.com', 6546, 'sadf', 'sdfsdf');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tabla_12_personal`
--
ALTER TABLE `tabla_12_personal`
  ADD PRIMARY KEY (`id_tabla12`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tabla_12_personal`
--
ALTER TABLE `tabla_12_personal`
  MODIFY `id_tabla12` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
