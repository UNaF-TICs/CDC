
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-07-2016 a las 19:57:02
-- Versión del servidor: 10.0.20-MariaDB
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u206244349_cdc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_01_usuarios`
--

CREATE TABLE IF NOT EXISTS `tabla_01_usuarios` (
  `id_tabla01` int(11) NOT NULL AUTO_INCREMENT,
  `tabla01_nombre` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `tabla01_usuario` varchar(250) CHARACTER SET latin1 NOT NULL,
  `tabla01_contrasena` varchar(250) CHARACTER SET latin1 NOT NULL,
  `tabla01_mail` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `tabla01_activo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_tabla01`),
  KEY `id_tabla01` (`id_tabla01`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=2 ;

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
  `id_tabla02` int(11) NOT NULL AUTO_INCREMENT,
  `tabla02_tipo` int(11) NOT NULL,
  `rela_padre` int(11) DEFAULT NULL,
  `tabla02_nombre` varchar(250) NOT NULL,
  `tabla02_path_home` varchar(250) NOT NULL,
  `tabla02_imagen` varchar(250) DEFAULT NULL,
  `tabla02_orden` int(11) DEFAULT NULL,
  `tabla02_ayuda` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_tabla02`),
  KEY `id_tabla02` (`id_tabla02`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

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
(70, 0, 68, 'Libros', 'libros/php/ver_libros_busqueda.php', '', 3, ''),
(87, 0, 68, 'xxxx', 'xxx', 'icono_87.png', 1, ''),
(88, 0, 13, 'probabdo', 'c', '', 0, ''),
(89, 0, 18, 'probando', '', '', 0, ''),
(90, 0, 89, 'xxxx', '', '', 1, ''),
(91, 0, 68, 'Variedad', 'variedad/php/ver_variedad_busqueda.php', '', 4, ''),
(92, 0, 68, 'Cultivo', 'cultivo/php/ver_cultivo_busqueda.php', '', 5, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_03_perfiles`
--

CREATE TABLE IF NOT EXISTS `tabla_03_perfiles` (
  `id_tabla03` int(11) NOT NULL AUTO_INCREMENT,
  `tabla03_nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id_tabla03`),
  KEY `id_tabla03` (`id_tabla03`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
  `id_tabla04` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla02` int(11) NOT NULL,
  `rela_tabla03` int(11) NOT NULL,
  `tabla04_alta` int(11) DEFAULT NULL,
  `tabla04_baja` int(11) DEFAULT NULL,
  `tabla04_modificacion` int(11) DEFAULT NULL,
  `tabla04_reporte` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla04`),
  KEY `id_tabla04` (`id_tabla04`),
  KEY `rela_tabla02_idx` (`rela_tabla02`),
  KEY `rela_tabla03_idx` (`rela_tabla03`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `id_tabla05` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla01` int(11) NOT NULL,
  `rela_tabla02` int(11) NOT NULL,
  `tabla05_accion` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `tabla05_descripcion` text CHARACTER SET latin1 COLLATE latin1_bin,
  `tabla05_fecha` varchar(250) DEFAULT NULL,
  `tabla05_hora` varchar(250) NOT NULL,
  `tabla05_mensaje` varchar(250) DEFAULT NULL,
  `tabla05_operacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tabla05`),
  KEY `id_tabla05` (`id_tabla05`),
  KEY `rela_tabla01_idx` (`rela_tabla01`),
  KEY `rela_tabla002_idx` (`rela_tabla02`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tabla_05_log`
--

INSERT INTO `tabla_05_log` (`id_tabla05`, `rela_tabla01`, `rela_tabla02`, `tabla05_accion`, `tabla05_descripcion`, `tabla05_fecha`, `tabla05_hora`, `tabla05_mensaje`, `tabla05_operacion`) VALUES
(3, 1, 0, 'ABM', 'root', '2016-07-01', '15:36:15', 'Logueado correctamente', 'Logueo'),
(4, 1, 0, 'ABM', 'root', '2016-07-04', '02:13:44', 'Logueado correctamente', 'Logueo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_06_det_usuarios_perfiles`
--

CREATE TABLE IF NOT EXISTS `tabla_06_det_usuarios_perfiles` (
  `id_tabla06` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla01` int(11) NOT NULL,
  `rela_tabla03` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla06`),
  KEY `id_tabla06` (`id_tabla06`),
  KEY `rela_tabla001_idx` (`rela_tabla01`),
  KEY `rela_tabla003_idx` (`rela_tabla03`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `tabla_06_det_usuarios_perfiles`
--

INSERT INTO `tabla_06_det_usuarios_perfiles` (`id_tabla06`, `rela_tabla01`, `rela_tabla03`) VALUES
(17, 3, 8),
(19, 4, 11),
(20, 1, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_09_arb_ubicacion_geografica`
--

CREATE TABLE IF NOT EXISTS `tabla_09_arb_ubicacion_geografica` (
  `id_tabla09` int(11) NOT NULL AUTO_INCREMENT,
  `rela_padre` int(11) DEFAULT NULL,
  `rela_tabla10` int(11) DEFAULT NULL,
  `tabla09_descripcion` varchar(255) DEFAULT NULL,
  `tabla09_codigo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tabla09`),
  KEY `fk_tabla_09_arb_ubicacion_geografica_tabla_09_arb_ubicacion_idx` (`rela_padre`),
  KEY `id_tabla09` (`id_tabla09`),
  KEY `rela_tabla10_idx` (`rela_tabla10`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_10_arb_niveles_arbol`
--

CREATE TABLE IF NOT EXISTS `tabla_10_arb_niveles_arbol` (
  `id_tabla10` int(11) NOT NULL,
  `rela_padre` int(11) DEFAULT NULL,
  `rela_tabla11` int(11) DEFAULT NULL,
  `tabla10_descripcion` varchar(255) NOT NULL,
  `tabla10_nivel` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla10`),
  KEY `fk_tabla_10_tab_niveles_arbol_tabla_11_cab_nomenclador1_idx` (`rela_tabla11`),
  KEY `fk_tabla_10_tab_niveles_arbol_tabla_10_tab_niveles_arbol1_idx` (`rela_padre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_11_cab_nomenclador`
--

CREATE TABLE IF NOT EXISTS `tabla_11_cab_nomenclador` (
  `id_tabla11` int(11) NOT NULL AUTO_INCREMENT,
  `tabla11_descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tabla11`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_13_cab_trabajo`
--

CREATE TABLE IF NOT EXISTS `tabla_13_cab_trabajo` (
  `id_tabla13` int(11) NOT NULL AUTO_INCREMENT,
  `Rela_Tabla14` int(11) NOT NULL,
  `Tabla13_Descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tabla13`),
  KEY `id_tabla13` (`id_tabla13`),
  KEY `Rela_Tabla14` (`Rela_Tabla14`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_14_det_tipo_trabajo`
--

CREATE TABLE IF NOT EXISTS `tabla_14_det_tipo_trabajo` (
  `id_Tabla14` int(11) NOT NULL AUTO_INCREMENT,
  `tabla14_Descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_Tabla14`),
  KEY `id_tabla14` (`id_Tabla14`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_15_tbl_variedad`
--

CREATE TABLE IF NOT EXISTS `tabla_15_tbl_variedad` (
  `id_tabla15` int(11) NOT NULL AUTO_INCREMENT,
  `tabla15_nombre` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla15_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla15_temperatura_maxima` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla15_temperatura_minima` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla15_temperatura_optima` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla15`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tabla_15_tbl_variedad`
--

INSERT INTO `tabla_15_tbl_variedad` (`id_tabla15`, `tabla15_nombre`, `tabla15_descripcion`, `tabla15_temperatura_maxima`, `tabla15_temperatura_minima`, `tabla15_temperatura_optima`) VALUES
(3, 'Lechuga', 'Planta verde grande', '30', '12', '25'),
(5, 'Frutilla', 'Fruta roja con semillas', '30', '12', '25'),
(6, 'Papas', 'Verdura Marron ', '30', '12', '25'),
(7, 'Banana', 'Platano Amarillo', '30', '12', '25'),
(8, 'Melon', 'Fruta redonda con muchas semillas', '30', '12', '24'),
(9, 'Naranjo', 'árbol de naranjas', '30', '12', '25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_16_cab_cultivo`
--

CREATE TABLE IF NOT EXISTS `tabla_16_cab_cultivo` (
  `id_tabla16` int(11) NOT NULL AUTO_INCREMENT,
  `tabla16_fecha_siembra` date DEFAULT NULL,
  `tabla16_fecha_cosecha` date DEFAULT NULL,
  `rela_tabla65` int(11) DEFAULT NULL,
  `rela_tabla15` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla16`),
  KEY `id_tabla16` (`id_tabla16`),
  KEY `rela_tabla65_idx` (`rela_tabla65`),
  KEY `rela_tabla15_idx` (`rela_tabla15`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `tabla_16_cab_cultivo`
--

INSERT INTO `tabla_16_cab_cultivo` (`id_tabla16`, `tabla16_fecha_siembra`, `tabla16_fecha_cosecha`, `rela_tabla65`, `rela_tabla15`) VALUES
(18, '2016-06-08', '2016-06-30', 2, 3),
(20, '2016-06-22', '2016-08-24', 2, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_17_mov_cultivo_actividad`
--

CREATE TABLE IF NOT EXISTS `tabla_17_mov_cultivo_actividad` (
  `id_tabla17` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla100` int(11) NOT NULL,
  `rela_tabla16` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla17`),
  KEY `id_tabla17` (`id_tabla17`),
  KEY `rela_tablaa15_idx` (`rela_tabla16`),
  KEY `rela_tablaa_idx` (`rela_tabla100`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_18_cab_fitosanitario`
--

CREATE TABLE IF NOT EXISTS `tabla_18_cab_fitosanitario` (
  `id_tabla18` int(11) NOT NULL AUTO_INCREMENT,
  `Fitosanitario_Nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Fitosanitario_Fecha_caducidad` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Fitosanitario_Fabricante` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Rela_tabla33` int(11) DEFAULT NULL,
  `Rela_tabla20` int(11) DEFAULT NULL,
  `Rela_tabla21` int(11) DEFAULT NULL,
  `Rela_tabla19` int(11) DEFAULT NULL,
  `Cantidad_Agua` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla_18_fitosanitariocol` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla18`),
  KEY `id_tabla18` (`id_tabla18`),
  KEY `rela_tabla19_idx` (`Rela_tabla19`),
  KEY `rela_tabla20_idx` (`Rela_tabla20`),
  KEY `rela_tabla21_idx` (`Rela_tabla21`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_19_tbl_tipo_dosis`
--

CREATE TABLE IF NOT EXISTS `tabla_19_tbl_tipo_dosis` (
  `id_tabla19` int(11) NOT NULL,
  `Tipo_Dosis` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla19`),
  KEY `id_tabla19` (`id_tabla19`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_20_tbl_tipo_preparado`
--

CREATE TABLE IF NOT EXISTS `tabla_20_tbl_tipo_preparado` (
  `id_tabla20` int(11) NOT NULL,
  `tabla20_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla20`),
  KEY `id_tabla20` (`id_tabla20`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_21_tbl_tipo_funcion`
--

CREATE TABLE IF NOT EXISTS `tabla_21_tbl_tipo_funcion` (
  `id_tabla21` int(11) NOT NULL,
  `tabla21_funcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla21`),
  KEY `id_tabla21` (`id_tabla21`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_22_tbl_maquinaria`
--

CREATE TABLE IF NOT EXISTS `tabla_22_tbl_maquinaria` (
  `id_tabla22` int(11) NOT NULL AUTO_INCREMENT,
  `tabla22_imagen` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla22_nombre` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla22_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla22_marca` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla22_modelo` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla22_fecha_compra` datetime DEFAULT NULL,
  `tabla22_costo_compra` decimal(10,2) DEFAULT NULL,
  `tabla22_matricula` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla22_empresa_seguro` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla22_rto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla22_funcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla22`),
  KEY `id_tabla22` (`id_tabla22`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_23_tbl_mantenimiento`
--

CREATE TABLE IF NOT EXISTS `tabla_23_tbl_mantenimiento` (
  `id_tabla23` int(11) NOT NULL AUTO_INCREMENT,
  `tabla23_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla23_fecha_mantenimiento` datetime DEFAULT NULL,
  `tabla23_estado` tinyint(1) DEFAULT NULL,
  `tabla23_fecha_trabajo` datetime DEFAULT NULL,
  `tabla23_observacion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla22` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla23`),
  KEY `id_tabla23` (`id_tabla23`),
  KEY `rela_tabla22_idx` (`rela_tabla22`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_25_cab_semilla`
--

CREATE TABLE IF NOT EXISTS `tabla_25_cab_semilla` (
  `id_tabla25` int(11) NOT NULL AUTO_INCREMENT,
  `tabla25_nombre` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla15` int(11) DEFAULT NULL,
  `tabla25_dosis` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla74` int(11) DEFAULT NULL,
  `rela_tabla26` int(11) DEFAULT NULL,
  `rela_tabla27` int(11) DEFAULT NULL,
  `rela_tabla76` int(11) DEFAULT NULL,
  `rela_tabla28` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla25`),
  KEY `id_tabla25` (`id_tabla25`),
  KEY `rela_tablaaaa74_idx` (`rela_tabla74`),
  KEY `rela_tablaaaa76_idx` (`rela_tabla76`),
  KEY `rela_tablaaaa15_idx` (`rela_tabla15`),
  KEY `rela_tablaaaa26_idx` (`rela_tabla26`),
  KEY `rela_tablaaaa27_idx` (`rela_tabla27`),
  KEY `rela_tablaaaa28_idx` (`rela_tabla28`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_26_tbl_tipo_fruto`
--

CREATE TABLE IF NOT EXISTS `tabla_26_tbl_tipo_fruto` (
  `id_tabla26` int(11) NOT NULL AUTO_INCREMENT,
  `tabla26_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla26`),
  KEY `id_tabla26` (`id_tabla26`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_27_tbl_tipo_germinacion`
--

CREATE TABLE IF NOT EXISTS `tabla_27_tbl_tipo_germinacion` (
  `id_tabla27` int(11) NOT NULL AUTO_INCREMENT,
  `tabla27_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla27`),
  KEY `id_tabla27` (`id_tabla27`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_28_tbl_temperatura_humedad`
--

CREATE TABLE IF NOT EXISTS `tabla_28_tbl_temperatura_humedad` (
  `id_tabla28` int(11) NOT NULL AUTO_INCREMENT,
  `tabla28_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla28`),
  KEY `id_tabla28` (`id_tabla28`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_30_mov_actividad_abono`
--

CREATE TABLE IF NOT EXISTS `tabla_30_mov_actividad_abono` (
  `id_tabla30` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla100` int(11) NOT NULL,
  `rela_tabla73` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla30`),
  KEY `id_tabla30` (`id_tabla30`),
  KEY `rela_tabla100_actividad_idx` (`rela_tabla100`),
  KEY `rela_tabla73_abono_idx` (`rela_tabla73`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_31_mov_actividad_fitosanitario`
--

CREATE TABLE IF NOT EXISTS `tabla_31_mov_actividad_fitosanitario` (
  `id_tabla31` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla100` int(11) NOT NULL,
  `rela_tabla18` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla31`),
  KEY `id_tabla31` (`id_tabla31`),
  KEY `rela_tabla100_act_idx` (`rela_tabla100`),
  KEY `rela_tabla18_fito_idx` (`rela_tabla18`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_32_mov_actividad_semilla`
--

CREATE TABLE IF NOT EXISTS `tabla_32_mov_actividad_semilla` (
  `id_tabla32` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla100` int(11) NOT NULL,
  `rela_tabla25` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla32`),
  KEY `id_tabla32` (`id_tabla32`),
  KEY `rela_tabla100_acti_idx` (`rela_tabla100`),
  KEY `rela_tabla25_semi_idx` (`rela_tabla25`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_33_tbl_plaga`
--

CREATE TABLE IF NOT EXISTS `tabla_33_tbl_plaga` (
  `id_tabla33` int(11) NOT NULL AUTO_INCREMENT,
  `tabla33_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla33`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_34_mov_fitosanitario_plaga`
--

CREATE TABLE IF NOT EXISTS `tabla_34_mov_fitosanitario_plaga` (
  `id_tabla34` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla18` int(11) DEFAULT NULL,
  `rela_tabla33` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla34`),
  KEY `id_tabla34` (`id_tabla34`),
  KEY `rela_tabla18_fitosa_idx` (`rela_tabla18`),
  KEY `rela_tabla33_plaga_idx` (`rela_tabla33`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_35_cab_observacion`
--

CREATE TABLE IF NOT EXISTS `tabla_35_cab_observacion` (
  `id_tabla35` int(11) NOT NULL AUTO_INCREMENT,
  `tabla35_fecha_hora` datetime DEFAULT NULL,
  `tabla35_cantidad` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla35_observacion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla36` int(11) DEFAULT NULL,
  `rela_tabla71` int(11) DEFAULT NULL,
  `rela_tabla33` int(11) DEFAULT NULL,
  `rela_tabla16` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla35`),
  KEY `id_tabla35` (`id_tabla35`),
  KEY `rela_tabla_idx` (`rela_tabla71`),
  KEY `rela_tabla33_plag_idx` (`rela_tabla33`),
  KEY `rela_tabla36_cabobs_idx` (`rela_tabla36`),
  KEY `rela_tabla16cultivs_idx` (`rela_tabla16`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_36_tbl_tipo_observacion`
--

CREATE TABLE IF NOT EXISTS `tabla_36_tbl_tipo_observacion` (
  `id_tabla36` int(11) NOT NULL AUTO_INCREMENT,
  `tabla36_descripcion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla74` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla36`),
  KEY `id_tabla36` (`id_tabla36`),
  KEY `rela_tabla74_unidmed_idx` (`rela_tabla74`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_63_tbl_finca`
--

CREATE TABLE IF NOT EXISTS `tabla_63_tbl_finca` (
  `id_tabla63` int(11) NOT NULL AUTO_INCREMENT,
  `tabla63_areatotal` float DEFAULT NULL,
  `tabla63_tiporepresentante` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla67` int(11) DEFAULT NULL,
  `tabla63_entidadcertificadora` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla70_finca` int(11) DEFAULT NULL,
  `rela_tabla70_titular` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla63`),
  KEY `id_tabla63` (`id_tabla63`),
  KEY `rela_tabla67` (`rela_tabla67`),
  KEY `rela_tabla70_finca_idx` (`rela_tabla70_finca`),
  KEY `rela_tabla70_titular_idx` (`rela_tabla70_titular`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tabla_63_tbl_finca`
--

INSERT INTO `tabla_63_tbl_finca` (`id_tabla63`, `tabla63_areatotal`, `tabla63_tiporepresentante`, `rela_tabla67`, `tabla63_entidadcertificadora`, `rela_tabla70_finca`, `rela_tabla70_titular`) VALUES
(1, 12, '121', 1, 'asdasda', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_64_tbl_predio`
--

CREATE TABLE IF NOT EXISTS `tabla_64_tbl_predio` (
  `id_tabla64` int(11) NOT NULL AUTO_INCREMENT,
  `tabla64_nombrepredio` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla63` int(11) DEFAULT NULL,
  `tabla64_areatotal` float DEFAULT NULL,
  `tabla64_limites` mediumtext COLLATE utf8mb4_spanish_ci,
  `rela_tabla09` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla64`),
  KEY `id_tabla64` (`id_tabla64`),
  KEY `rela_tabla63` (`rela_tabla63`),
  KEY `rela_tabla09_idx` (`rela_tabla09`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tabla_64_tbl_predio`
--

INSERT INTO `tabla_64_tbl_predio` (`id_tabla64`, `tabla64_nombrepredio`, `rela_tabla63`, `tabla64_areatotal`, `tabla64_limites`, `rela_tabla09`) VALUES
(1, 'asdasda', 1, 123, '1231', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_65_tbl_parcela`
--

CREATE TABLE IF NOT EXISTS `tabla_65_tbl_parcela` (
  `id_tabla65` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla64` int(11) DEFAULT NULL,
  `tabla65_limites` mediumtext COLLATE utf8mb4_spanish_ci,
  `tabla65_areatotal` float DEFAULT NULL,
  `tabla65_tieneregadio` tinyint(1) DEFAULT NULL,
  `rela_tabla66` int(11) DEFAULT NULL,
  `rela_tabla09` int(11) DEFAULT NULL,
  `tabla65_numero` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla65`),
  KEY `id_tabla65` (`id_tabla65`),
  KEY `rela_tabla66` (`rela_tabla66`),
  KEY `rela_tabla64` (`rela_tabla64`),
  KEY `rela_tabla09_idx` (`rela_tabla09`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tabla_65_tbl_parcela`
--

INSERT INTO `tabla_65_tbl_parcela` (`id_tabla65`, `rela_tabla64`, `tabla65_limites`, `tabla65_areatotal`, `tabla65_tieneregadio`, `rela_tabla66`, `rela_tabla09`, `tabla65_numero`) VALUES
(2, 1, '123123', 12, 12, NULL, NULL, '228');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_66_tbl_sisriego`
--

CREATE TABLE IF NOT EXISTS `tabla_66_tbl_sisriego` (
  `id_tabla66` int(11) NOT NULL AUTO_INCREMENT,
  `tabla66_descrip` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla66`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_67_tbl_tipocertifica`
--

CREATE TABLE IF NOT EXISTS `tabla_67_tbl_tipocertifica` (
  `id_tabla67` int(11) NOT NULL AUTO_INCREMENT,
  `tabla67_descrip` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla67`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Tipo de certificación' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tabla_67_tbl_tipocertifica`
--

INSERT INTO `tabla_67_tbl_tipocertifica` (`id_tabla67`, `tabla67_descrip`) VALUES
(1, 'asads');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_70_tbl_persona`
--

CREATE TABLE IF NOT EXISTS `tabla_70_tbl_persona` (
  `id_tabla70` int(11) NOT NULL AUTO_INCREMENT,
  `tabla70_razon_social` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_cuit` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_nombre_apellido` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_dni` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_telefono` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_foto` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rela_tabla09` int(11) DEFAULT NULL,
  `tabla70_direccion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla70`),
  KEY `id_tabla70` (`id_tabla70`),
  KEY `rela_tabla09_idx` (`rela_tabla09`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_71_cab_personal`
--

CREATE TABLE IF NOT EXISTS `tabla_71_cab_personal` (
  `id_tabla71` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla72` int(11) NOT NULL,
  `rela_tabla70` int(11) NOT NULL,
  `rela_tabla63` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla71`),
  KEY `id_tabla71` (`id_tabla71`),
  KEY `rela_tabla70_idx` (`rela_tabla70`),
  KEY `rela_tabla72_idx` (`rela_tabla72`),
  KEY `rela_tabla63_idx` (`rela_tabla63`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_72_tbl_tipo_personal`
--

CREATE TABLE IF NOT EXISTS `tabla_72_tbl_tipo_personal` (
  `id_tabla72` int(11) NOT NULL AUTO_INCREMENT,
  `tabla72_descripcion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla72`),
  KEY `id_tabla72` (`id_tabla72`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_73_cab_abono`
--

CREATE TABLE IF NOT EXISTS `tabla_73_cab_abono` (
  `id_tabla73` int(11) NOT NULL AUTO_INCREMENT,
  `tabla73_nombre` varchar(255) NOT NULL,
  `Rela_tabla75` int(11) DEFAULT NULL,
  `Rela_tabla74` int(11) DEFAULT NULL,
  `tabla73_volumen_caldo` decimal(8,3) DEFAULT NULL,
  `tabla73_dosis` decimal(8,3) DEFAULT NULL,
  `rela_tabla76` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla73`),
  KEY `Rela_tipo_quimico` (`Rela_tabla74`),
  KEY `Rela_unidad_medicion` (`Rela_tabla75`),
  KEY `id_tabla73` (`id_tabla73`),
  KEY `rela_tabla76_idx` (`rela_tabla76`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_74_tbl_unidad_medicion`
--

CREATE TABLE IF NOT EXISTS `tabla_74_tbl_unidad_medicion` (
  `id_tabla74` int(11) NOT NULL AUTO_INCREMENT,
  `tabla74_Tipo_Unidad` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tabla74`),
  KEY `id_tabla74|` (`id_tabla74`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_75_tbl_tipo_quimico`
--

CREATE TABLE IF NOT EXISTS `tabla_75_tbl_tipo_quimico` (
  `id_tabla75` int(11) NOT NULL AUTO_INCREMENT,
  `tabla75_tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tabla75`),
  KEY `id_tabla75` (`id_tabla75`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_76_tbl_unidad_dosis`
--

CREATE TABLE IF NOT EXISTS `tabla_76_tbl_unidad_dosis` (
  `id_tabla76` int(11) NOT NULL AUTO_INCREMENT,
  `tabla76_ descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tabla76`),
  KEY `id_tabla76` (`id_tabla76`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_98_tbl_tipo_evento`
--

CREATE TABLE IF NOT EXISTS `tabla_98_tbl_tipo_evento` (
  `id_tabla98` int(11) NOT NULL AUTO_INCREMENT,
  `tabla98_descripcion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla98`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_99_cab_eventoclimatologico`
--

CREATE TABLE IF NOT EXISTS `tabla_99_cab_eventoclimatologico` (
  `id_tabla99` int(11) NOT NULL AUTO_INCREMENT,
  `tabla99_observacion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla99_fecha_inicio` datetime DEFAULT NULL,
  `tabla99_fecha_fin` datetime DEFAULT NULL,
  `rela_tabla16` int(11) DEFAULT NULL,
  `rela_tabla01` int(11) DEFAULT NULL,
  `rela_tabla74` int(11) DEFAULT NULL,
  `rela_tabla71` int(11) DEFAULT NULL,
  `tabla99_cantidad` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla98` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tabla99`),
  KEY `rela_tabla74_unidmed_idx` (`rela_tabla74`),
  KEY `id_tabla99` (`id_tabla99`),
  KEY `rela_tabla01_usua_idx` (`rela_tabla01`),
  KEY `rela_tabla71_person_idx` (`rela_tabla71`),
  KEY `rela_tabla16_cult_idx` (`rela_tabla16`),
  KEY `rela_tabla98_tipoeve_idx` (`rela_tabla98`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_100_tbl_actividad`
--

CREATE TABLE IF NOT EXISTS `tabla_100_tbl_actividad` (
  `id_tabla100` int(11) NOT NULL,
  `tabla100_fecha_alta` datetime NOT NULL,
  `rela_tabla01` int(11) NOT NULL,
  `tabla100_fecha_inicio` datetime NOT NULL,
  `rela_tabla65` int(11) NOT NULL,
  `tabla100_fecha_fin` datetime NOT NULL,
  `tabla100_observaciones` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rela_tabla13` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla100`),
  KEY `id_tabla100` (`id_tabla100`),
  KEY `rela_tabla01_idx` (`rela_tabla01`),
  KEY `rela_tablaaa65_idx` (`rela_tabla65`),
  KEY `rela_tablaaa13_idx` (`rela_tabla13`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_101_mov_actividad_maquinaria`
--

CREATE TABLE IF NOT EXISTS `tabla_101_mov_actividad_maquinaria` (
  `id_tabla101` int(11) NOT NULL,
  `rela_tabla22` int(11) NOT NULL,
  `rela_tabla100` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla101`),
  KEY `id_tabla101` (`id_tabla101`),
  KEY `rela_tabla22_idx` (`rela_tabla22`),
  KEY `rela_tabla100_idx` (`rela_tabla100`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_102_mov_actividad_personal`
--

CREATE TABLE IF NOT EXISTS `tabla_102_mov_actividad_personal` (
  `id_tabla102` int(11) NOT NULL AUTO_INCREMENT,
  `rela_tabla100` int(11) NOT NULL,
  `rela_tabla71` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla102`),
  KEY `id_tabla102` (`id_tabla102`),
  KEY `rela_tabla100_idx` (`rela_tabla100`),
  KEY `rela_tablaa71_idx` (`rela_tabla71`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
