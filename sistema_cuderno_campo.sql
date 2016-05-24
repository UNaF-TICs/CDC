-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2016 a las 17:33:18
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sistema_cuderno_campo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_01_usuarios`
--

CREATE TABLE IF NOT EXISTS `tabla_01_usuarios` (
  `id_tabla01` int(11) NOT NULL,
  `tabla01_nombre` varchar(250) DEFAULT NULL,
  `tabla01_usuario` varchar(250) NOT NULL,
  `tabla01_contrasena` varchar(250) NOT NULL,
  `tabla01_mail` varchar(250) DEFAULT NULL,
  `tabla01_activo` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_01_usuarios`
--

INSERT INTO `tabla_01_usuarios` (`id_tabla01`, `tabla01_nombre`, `tabla01_usuario`, `tabla01_contrasena`, `tabla01_mail`, `tabla01_activo`) VALUES
(1, 'Administrador', 'root', 'root', 'afv0185@hotmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_02_modulos`
--

CREATE TABLE IF NOT EXISTS `tabla_02_modulos` (
  `id_tabla02` int(11) NOT NULL,
  `tabla02_tipo` int(11) NOT NULL,
  `rela_padre` int(11) DEFAULT NULL,
  `tabla02_nombre` varchar(250) NOT NULL,
  `tabla02_path_home` varchar(250) NOT NULL,
  `tabla02_imagen` varchar(250) DEFAULT NULL,
  `tabla02_orden` int(11) DEFAULT NULL,
  `tabla02_ayuda` varchar(250) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_02_modulos`
--

INSERT INTO `tabla_02_modulos` (`id_tabla02`, `tabla02_tipo`, `rela_padre`, `tabla02_nombre`, `tabla02_path_home`, `tabla02_imagen`, `tabla02_orden`, `tabla02_ayuda`) VALUES
(1, 0, 17, 'Módulos', 'modulos/php/ver_modulos.php', 'icono_1.png', 0, ''),
(2, 0, 17, 'Perfiles', 'perfiles/php/ver_perfiles.php', 'icono_2.png', 0, ''),
(7, 0, 17, 'Usuarios', 'usuarios/php/ver_usuarios.php', 'icono_7.png', 0, ''),
(13, 0, 17, 'Control', 'control/php/ver_control_busqueda.php', 'icono_13.png', 0, ''),
(17, 1, NULL, 'Configuración', '', 'icono_17.png', 2, ''),
(18, 1, NULL, 'Soporte', '', '', 3, 'asda'),
(19, 0, 18, 'Enviar Consulta', 'consultas/php/ver_enviar_consultas.php', 'icono_19.png', 1, ''),
(27, 0, 17, 'Backup', 'backup/php/ver_backup.php', 'icono_27.png', 5, ''),
(68, 1, NULL, 'Administracion central', '', '', 3, ''),
(69, 0, 68, 'Temas', 'temas/php/ver_temas_busqueda.php', '', 2, ''),
(70, 0, 68, 'Libros', 'libros/php/ver_libros_busqueda.php', '', 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_03_perfiles`
--

CREATE TABLE IF NOT EXISTS `tabla_03_perfiles` (
  `id_tabla03` int(11) NOT NULL,
  `tabla03_nombre` varchar(250) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_03_perfiles`
--

INSERT INTO `tabla_03_perfiles` (`id_tabla03`, `tabla03_nombre`) VALUES
(1, 'Administrador'),
(8, 'Empleado'),
(10, 'Analista'),
(11, 'Diseñador'),
(12, 'Desarrollador'),
(13, 'Testing');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_04_det_perfiles`
--

CREATE TABLE IF NOT EXISTS `tabla_04_det_perfiles` (
  `id_tabla04` int(11) NOT NULL,
  `rela_tabla02` int(11) NOT NULL,
  `rela_tabla03` int(11) NOT NULL,
  `tabla04_alta` int(11) DEFAULT NULL,
  `tabla04_baja` int(11) DEFAULT NULL,
  `tabla04_modificacion` int(11) DEFAULT NULL,
  `tabla04_reporte` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_04_det_perfiles`
--

INSERT INTO `tabla_04_det_perfiles` (`id_tabla04`, `rela_tabla02`, `rela_tabla03`, `tabla04_alta`, `tabla04_baja`, `tabla04_modificacion`, `tabla04_reporte`) VALUES
(1, 38, 11, 0, 0, 1, 0),
(2, 39, 11, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_05_log`
--

CREATE TABLE IF NOT EXISTS `tabla_05_log` (
  `id_tabla05` int(11) NOT NULL,
  `rela_tabla01` int(11) NOT NULL,
  `rela_tabla02` int(11) DEFAULT NULL,
  `tabla05_accion` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `tabla05_descripcion` text CHARACTER SET latin1 COLLATE latin1_bin,
  `tabla05_fecha` varchar(250) DEFAULT NULL,
  `tabla05_hora` varchar(250) NOT NULL,
  `tabla05_mensaje` varchar(250) DEFAULT NULL,
  `tabla05_operacion` varchar(45) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_05_log`
--

INSERT INTO `tabla_05_log` (`id_tabla05`, `rela_tabla01`, `rela_tabla02`, `tabla05_accion`, `tabla05_descripcion`, `tabla05_fecha`, `tabla05_hora`, `tabla05_mensaje`, `tabla05_operacion`) VALUES
(1, 1, 0, 'ABM', 'root', '2016-05-16', '20:38:24', 'Logueado correctamente', 'Logueo'),
(2, 1, 0, 'ABM', 'root', '2016-05-17', '00:09:23', 'Logueado correctamente', 'Logueo'),
(3, 1, 0, 'ABM', 'root', '2016-05-17', '00:11:58', 'Logueado correctamente', 'Logueo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_06_det_usuarios_perfiles`
--

CREATE TABLE IF NOT EXISTS `tabla_06_det_usuarios_perfiles` (
  `id_tabla06` int(11) NOT NULL,
  `rela_tabla01` int(11) NOT NULL,
  `rela_tabla03` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_06_det_usuarios_perfiles`
--

INSERT INTO `tabla_06_det_usuarios_perfiles` (`id_tabla06`, `rela_tabla01`, `rela_tabla03`) VALUES
(17, 3, 8),
(19, 4, 11),
(20, 1, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_09_temas`
--

CREATE TABLE IF NOT EXISTS `tabla_09_temas` (
  `id_tabla09` int(11) NOT NULL,
  `tabla09_nombre` varchar(255) DEFAULT NULL,
  `tabla09_descripcion` varchar(255) DEFAULT NULL,
  `tabla09_subtema` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_09_temas`
--

INSERT INTO `tabla_09_temas` (`id_tabla09`, `tabla09_nombre`, `tabla09_descripcion`, `tabla09_subtema`) VALUES
(1, 'trazabilidad', 'seguiemiento de requerimientos', 'traza'),
(2, 'Personas mayores', 'varias', 'Nuntrion Personas mayores'),
(3, 'Desnutrición', 'varais', 'Desnutricion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_10_libros`
--

CREATE TABLE IF NOT EXISTS `tabla_10_libros` (
  `id_tabla10` int(11) NOT NULL,
  `rela_tabla09` int(11) DEFAULT NULL,
  `rela_tabla11` int(11) DEFAULT NULL,
  `rela_tabla08` int(11) DEFAULT NULL,
  `tabla10_titulo` varchar(255) DEFAULT NULL,
  `tabla10_subtitulo` varchar(255) DEFAULT NULL,
  `tabla10_descripcion` varchar(255) DEFAULT NULL,
  `tabla10_fecha_entrada` varchar(255) DEFAULT NULL,
  `tabla10_tomo` varchar(255) DEFAULT NULL,
  `tabla10_cantidad` int(11) DEFAULT NULL,
  `tabla10_isbn` varchar(45) DEFAULT NULL,
  `tabla10_edicion` varchar(5) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_10_libros`
--

INSERT INTO `tabla_10_libros` (`id_tabla10`, `rela_tabla09`, `rela_tabla11`, `rela_tabla08`, `tabla10_titulo`, `tabla10_subtitulo`, `tabla10_descripcion`, `tabla10_fecha_entrada`, `tabla10_tomo`, `tabla10_cantidad`, `tabla10_isbn`, `tabla10_edicion`) VALUES
(1, 3, 3, NULL, 'sdasda', 'dasda', 'dasdas', '2016-05-14', 'dasdad', 3, NULL, NULL),
(2, 2, 1, NULL, 'xx', 'xxxx', '312312', '14-05-2016', '1', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_11_editoriales`
--

CREATE TABLE IF NOT EXISTS `tabla_11_editoriales` (
  `id_tabla11` int(11) NOT NULL,
  `tabla11_nombre` varchar(255) DEFAULT NULL,
  `tabla11_descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_11_editoriales`
--

INSERT INTO `tabla_11_editoriales` (`id_tabla11`, `tabla11_nombre`, `tabla11_descripcion`) VALUES
(1, 'kapeluz', 'estudiantes'),
(2, 'PRUEBA', 'VARIOS'),
(3, 'kapeluz 2', 'varias'),
(4, 'EDITORIAL 4', 'EDITORIAL 4');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tabla_01_usuarios`
--
ALTER TABLE `tabla_01_usuarios`
  ADD PRIMARY KEY (`id_tabla01`);

--
-- Indices de la tabla `tabla_02_modulos`
--
ALTER TABLE `tabla_02_modulos`
  ADD PRIMARY KEY (`id_tabla02`);

--
-- Indices de la tabla `tabla_03_perfiles`
--
ALTER TABLE `tabla_03_perfiles`
  ADD PRIMARY KEY (`id_tabla03`);

--
-- Indices de la tabla `tabla_04_det_perfiles`
--
ALTER TABLE `tabla_04_det_perfiles`
  ADD PRIMARY KEY (`id_tabla04`), ADD KEY `rela_tabla02` (`rela_tabla02`), ADD KEY `rela_tabla03` (`rela_tabla03`);

--
-- Indices de la tabla `tabla_05_log`
--
ALTER TABLE `tabla_05_log`
  ADD PRIMARY KEY (`id_tabla05`), ADD KEY `rela_tabla01` (`rela_tabla01`), ADD KEY `rela_tabla02` (`rela_tabla02`);

--
-- Indices de la tabla `tabla_06_det_usuarios_perfiles`
--
ALTER TABLE `tabla_06_det_usuarios_perfiles`
  ADD PRIMARY KEY (`id_tabla06`), ADD KEY `rela_tabla01` (`rela_tabla01`), ADD KEY `rela_tabla03` (`rela_tabla03`);

--
-- Indices de la tabla `tabla_09_temas`
--
ALTER TABLE `tabla_09_temas`
  ADD PRIMARY KEY (`id_tabla09`);

--
-- Indices de la tabla `tabla_10_libros`
--
ALTER TABLE `tabla_10_libros`
  ADD PRIMARY KEY (`id_tabla10`);

--
-- Indices de la tabla `tabla_11_editoriales`
--
ALTER TABLE `tabla_11_editoriales`
  ADD PRIMARY KEY (`id_tabla11`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tabla_01_usuarios`
--
ALTER TABLE `tabla_01_usuarios`
  MODIFY `id_tabla01` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tabla_02_modulos`
--
ALTER TABLE `tabla_02_modulos`
  MODIFY `id_tabla02` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT de la tabla `tabla_03_perfiles`
--
ALTER TABLE `tabla_03_perfiles`
  MODIFY `id_tabla03` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `tabla_04_det_perfiles`
--
ALTER TABLE `tabla_04_det_perfiles`
  MODIFY `id_tabla04` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tabla_05_log`
--
ALTER TABLE `tabla_05_log`
  MODIFY `id_tabla05` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tabla_06_det_usuarios_perfiles`
--
ALTER TABLE `tabla_06_det_usuarios_perfiles`
  MODIFY `id_tabla06` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `tabla_09_temas`
--
ALTER TABLE `tabla_09_temas`
  MODIFY `id_tabla09` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tabla_10_libros`
--
ALTER TABLE `tabla_10_libros`
  MODIFY `id_tabla10` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tabla_11_editoriales`
--
ALTER TABLE `tabla_11_editoriales`
  MODIFY `id_tabla11` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
