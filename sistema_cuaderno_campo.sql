-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2016 a las 20:05:03
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sistema_cuaderno_campo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_01_usuarios`
--

CREATE TABLE IF NOT EXISTS `tabla_01_usuarios` (
  `id_tabla01` int(11) NOT NULL,
  `tabla01_nombre` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `tabla01_usuario` varchar(250) CHARACTER SET latin1 NOT NULL,
  `tabla01_contrasena` varchar(250) CHARACTER SET latin1 NOT NULL,
  `tabla01_mail` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `tabla01_activo` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

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
(92, 0, 68, 'Cultivo', 'cultivo/php/ver_cultivo_busqueda.php', '', 5, ''),
(93, 0, 68, 'Fitosanitario', 'fitosanitarios/php/ver_fitosanitarios_busqueda.php', '', 0, '');

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
  `rela_tabla02` int(11) NOT NULL,
  `tabla05_accion` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `tabla05_descripcion` text CHARACTER SET latin1 COLLATE latin1_bin,
  `tabla05_fecha` varchar(250) DEFAULT NULL,
  `tabla05_hora` varchar(250) NOT NULL,
  `tabla05_mensaje` varchar(250) DEFAULT NULL,
  `tabla05_operacion` varchar(45) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_05_log`
--

INSERT INTO `tabla_05_log` (`id_tabla05`, `rela_tabla01`, `rela_tabla02`, `tabla05_accion`, `tabla05_descripcion`, `tabla05_fecha`, `tabla05_hora`, `tabla05_mensaje`, `tabla05_operacion`) VALUES
(3, 1, 0, 'ABM', 'root', '2016-07-01', '15:36:15', 'Logueado correctamente', 'Logueo'),
(4, 1, 0, 'ABM', 'root', '2016-07-04', '02:13:44', 'Logueado correctamente', 'Logueo'),
(5, 1, 0, 'ABM', 'root', '2016-07-05', '00:00:30', 'Logueado correctamente', 'Logueo'),
(6, 1, 0, 'ABM', 'root', '2016-07-05', '17:07:03', 'Logueado correctamente', 'Logueo'),
(7, 1, 0, 'ABM', 'root', '2016-07-05', '18:31:02', 'Logueado correctamente', 'Logueo'),
(8, 1, 0, 'ABM', 'root', '2016-07-07', '18:04:41', 'Logueado correctamente', 'Logueo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_06_det_usuarios_perfiles`
--

CREATE TABLE IF NOT EXISTS `tabla_06_det_usuarios_perfiles` (
  `id_tabla06` int(11) NOT NULL,
  `rela_tabla01` int(11) NOT NULL,
  `rela_tabla03` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

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
  `id_tabla09` int(11) NOT NULL,
  `rela_padre` int(11) DEFAULT NULL,
  `rela_tabla10` int(11) DEFAULT NULL,
  `tabla09_descripcion` varchar(255) DEFAULT NULL,
  `tabla09_codigo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_10_arb_niveles_arbol`
--

CREATE TABLE IF NOT EXISTS `tabla_10_arb_niveles_arbol` (
  `id_tabla10` int(11) NOT NULL,
  `rela_padre` int(11) DEFAULT NULL,
  `rela_tabla11` int(11) DEFAULT NULL,
  `tabla10_descripcion` varchar(255) NOT NULL,
  `tabla10_nivel` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_11_cab_nomenclador`
--

CREATE TABLE IF NOT EXISTS `tabla_11_cab_nomenclador` (
  `id_tabla11` int(11) NOT NULL,
  `tabla11_descripcion` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_13_cab_trabajo`
--

CREATE TABLE IF NOT EXISTS `tabla_13_cab_trabajo` (
  `id_tabla13` int(11) NOT NULL,
  `Rela_Tabla14` int(11) NOT NULL,
  `Tabla13_Descripcion` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_14_det_tipo_trabajo`
--

CREATE TABLE IF NOT EXISTS `tabla_14_det_tipo_trabajo` (
  `id_Tabla14` int(11) NOT NULL,
  `tabla14_Descripcion` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_15_tbl_variedad`
--

CREATE TABLE IF NOT EXISTS `tabla_15_tbl_variedad` (
  `id_tabla15` int(11) NOT NULL,
  `tabla15_nombre` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla15_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla15_temperatura_maxima` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla15_temperatura_minima` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla15_temperatura_optima` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `id_tabla16` int(11) NOT NULL,
  `tabla16_fecha_siembra` date DEFAULT NULL,
  `tabla16_fecha_cosecha` date DEFAULT NULL,
  `rela_tabla65` int(11) DEFAULT NULL,
  `rela_tabla15` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `id_tabla17` int(11) NOT NULL,
  `rela_tabla100` int(11) NOT NULL,
  `rela_tabla16` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_18_cab_fitosanitario`
--

CREATE TABLE IF NOT EXISTS `tabla_18_cab_fitosanitario` (
  `id_tabla18` int(11) NOT NULL,
  `Fitosanitario_Nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Fitosanitario_Fecha_caducidad` date DEFAULT NULL,
  `Fitosanitario_Fabricante` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Rela_tabla33` int(11) NOT NULL,
  `Rela_tabla20` int(11) DEFAULT NULL,
  `Rela_tabla21` int(11) DEFAULT NULL,
  `Rela_tabla19` int(11) DEFAULT NULL,
  `Cantidad_Agua` int(11) DEFAULT NULL,
  `tabla_18_fitosanitariocol` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tabla_18_cab_fitosanitario`
--

INSERT INTO `tabla_18_cab_fitosanitario` (`id_tabla18`, `Fitosanitario_Nombre`, `Fitosanitario_Fecha_caducidad`, `Fitosanitario_Fabricante`, `Rela_tabla33`, `Rela_tabla20`, `Rela_tabla21`, `Rela_tabla19`, `Cantidad_Agua`, `tabla_18_fitosanitariocol`) VALUES
(15, 'Cera de abejas', '2016-07-13', 'Senasa', 0, 1, 1, 1, 1, NULL),
(18, 'Proteínas hidrolizadas', '2016-07-22', 'Fabricante', 3, 2, 1, 3, 1, NULL),
(14, 'Azadiractina', '2016-07-01', 'Senasa', 1, 2, 3, 4, 5, NULL),
(17, 'Gelatina', '2016-07-12', NULL, 3, 3, 2, 2, 4, NULL),
(16, 'Gelatina', '2016-07-05', 'Senasa', 1, 1, 1, 1, 1, NULL),
(19, 'Lecitina', '2016-07-30', 'Senasa', 3, 3, 3, 2, 2, NULL),
(20, 'Aceites vegetales', '2016-07-15', 'Senasa', 3, 2, 2, 1, 4, NULL),
(21, 'Piretrinas ', '2016-07-06', 'Senasa', 3, 1, 2, 2, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_19_tbl_tipo_dosis`
--

CREATE TABLE IF NOT EXISTS `tabla_19_tbl_tipo_dosis` (
  `id_tabla19` int(11) NOT NULL,
  `Tipo_Dosis` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tabla_19_tbl_tipo_dosis`
--

INSERT INTO `tabla_19_tbl_tipo_dosis` (`id_tabla19`, `Tipo_Dosis`) VALUES
(0, 'Kg'),
(3, 'Mg'),
(4, 'Bolsa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_20_tbl_tipo_preparado`
--

CREATE TABLE IF NOT EXISTS `tabla_20_tbl_tipo_preparado` (
  `id_tabla20` int(11) NOT NULL,
  `tabla20_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tabla_20_tbl_tipo_preparado`
--

INSERT INTO `tabla_20_tbl_tipo_preparado` (`id_tabla20`, `tabla20_descripcion`) VALUES
(0, 'preparado'),
(1, 'preparado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_21_tbl_tipo_funcion`
--

CREATE TABLE IF NOT EXISTS `tabla_21_tbl_tipo_funcion` (
  `id_tabla21` int(11) NOT NULL,
  `tabla21_funcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tabla_21_tbl_tipo_funcion`
--

INSERT INTO `tabla_21_tbl_tipo_funcion` (`id_tabla21`, `tabla21_funcion`) VALUES
(2, 'Coadyuvante'),
(1, 'Abono'),
(3, 'fungicida'),
(4, 'Fitoregulador\r\n'),
(5, ' Herbicida'),
(6, 'Insecticida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_22_tbl_maquinaria`
--

CREATE TABLE IF NOT EXISTS `tabla_22_tbl_maquinaria` (
  `id_tabla22` int(11) NOT NULL,
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
  `tabla22_funcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_23_tbl_mantenimiento`
--

CREATE TABLE IF NOT EXISTS `tabla_23_tbl_mantenimiento` (
  `id_tabla23` int(11) NOT NULL,
  `tabla23_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla23_fecha_mantenimiento` datetime DEFAULT NULL,
  `tabla23_estado` tinyint(1) DEFAULT NULL,
  `tabla23_fecha_trabajo` datetime DEFAULT NULL,
  `tabla23_observacion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla22` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_25_cab_semilla`
--

CREATE TABLE IF NOT EXISTS `tabla_25_cab_semilla` (
  `id_tabla25` int(11) NOT NULL,
  `tabla25_nombre` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla15` int(11) DEFAULT NULL,
  `tabla25_dosis` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla74` int(11) DEFAULT NULL,
  `rela_tabla26` int(11) DEFAULT NULL,
  `rela_tabla27` int(11) DEFAULT NULL,
  `rela_tabla76` int(11) DEFAULT NULL,
  `rela_tabla28` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_26_tbl_tipo_fruto`
--

CREATE TABLE IF NOT EXISTS `tabla_26_tbl_tipo_fruto` (
  `id_tabla26` int(11) NOT NULL,
  `tabla26_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_27_tbl_tipo_germinacion`
--

CREATE TABLE IF NOT EXISTS `tabla_27_tbl_tipo_germinacion` (
  `id_tabla27` int(11) NOT NULL,
  `tabla27_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_28_tbl_temperatura_humedad`
--

CREATE TABLE IF NOT EXISTS `tabla_28_tbl_temperatura_humedad` (
  `id_tabla28` int(11) NOT NULL,
  `tabla28_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_30_mov_actividad_abono`
--

CREATE TABLE IF NOT EXISTS `tabla_30_mov_actividad_abono` (
  `id_tabla30` int(11) NOT NULL,
  `rela_tabla100` int(11) NOT NULL,
  `rela_tabla73` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_31_mov_actividad_fitosanitario`
--

CREATE TABLE IF NOT EXISTS `tabla_31_mov_actividad_fitosanitario` (
  `id_tabla31` int(11) NOT NULL,
  `rela_tabla100` int(11) NOT NULL,
  `rela_tabla18` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_32_mov_actividad_semilla`
--

CREATE TABLE IF NOT EXISTS `tabla_32_mov_actividad_semilla` (
  `id_tabla32` int(11) NOT NULL,
  `rela_tabla100` int(11) NOT NULL,
  `rela_tabla25` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_33_tbl_plaga`
--

CREATE TABLE IF NOT EXISTS `tabla_33_tbl_plaga` (
  `id_tabla33` int(11) NOT NULL,
  `tabla33_descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tabla_33_tbl_plaga`
--

INSERT INTO `tabla_33_tbl_plaga` (`id_tabla33`, `tabla33_descripcion`) VALUES
(1, 'plaga'),
(2, 'Pedro'),
(3, 'Cucaracha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_34_mov_fitosanitario_plaga`
--

CREATE TABLE IF NOT EXISTS `tabla_34_mov_fitosanitario_plaga` (
  `id_tabla34` int(11) NOT NULL,
  `tabla34_descri` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rela_tabla18` int(11) DEFAULT NULL,
  `rela_tabla33` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_35_cab_observacion`
--

CREATE TABLE IF NOT EXISTS `tabla_35_cab_observacion` (
  `id_tabla35` int(11) NOT NULL,
  `tabla35_fecha_hora` datetime DEFAULT NULL,
  `tabla35_cantidad` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla35_observacion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla36` int(11) DEFAULT NULL,
  `rela_tabla71` int(11) DEFAULT NULL,
  `rela_tabla33` int(11) DEFAULT NULL,
  `rela_tabla16` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_36_tbl_tipo_observacion`
--

CREATE TABLE IF NOT EXISTS `tabla_36_tbl_tipo_observacion` (
  `id_tabla36` int(11) NOT NULL,
  `tabla36_descripcion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla74` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_63_tbl_finca`
--

CREATE TABLE IF NOT EXISTS `tabla_63_tbl_finca` (
  `id_tabla63` int(11) NOT NULL,
  `tabla63_areatotal` float DEFAULT NULL,
  `tabla63_tiporepresentante` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla67` int(11) DEFAULT NULL,
  `tabla63_entidadcertificadora` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla70_finca` int(11) DEFAULT NULL,
  `rela_tabla70_titular` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `id_tabla64` int(11) NOT NULL,
  `tabla64_nombrepredio` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla63` int(11) DEFAULT NULL,
  `tabla64_areatotal` float DEFAULT NULL,
  `tabla64_limites` mediumtext COLLATE utf8mb4_spanish_ci,
  `rela_tabla09` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `id_tabla65` int(11) NOT NULL,
  `rela_tabla64` int(11) DEFAULT NULL,
  `tabla65_limites` mediumtext COLLATE utf8mb4_spanish_ci,
  `tabla65_areatotal` float DEFAULT NULL,
  `tabla65_tieneregadio` tinyint(1) DEFAULT NULL,
  `rela_tabla66` int(11) DEFAULT NULL,
  `rela_tabla09` int(11) DEFAULT NULL,
  `tabla65_numero` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `id_tabla66` int(11) NOT NULL,
  `tabla66_descrip` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_67_tbl_tipocertifica`
--

CREATE TABLE IF NOT EXISTS `tabla_67_tbl_tipocertifica` (
  `id_tabla67` int(11) NOT NULL,
  `tabla67_descrip` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Tipo de certificación';

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
  `id_tabla70` int(11) NOT NULL,
  `tabla70_razon_social` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_cuit` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_nombre_apellido` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_dni` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_telefono` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tabla70_foto` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rela_tabla09` int(11) DEFAULT NULL,
  `tabla70_direccion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_71_cab_personal`
--

CREATE TABLE IF NOT EXISTS `tabla_71_cab_personal` (
  `id_tabla71` int(11) NOT NULL,
  `rela_tabla72` int(11) NOT NULL,
  `rela_tabla70` int(11) NOT NULL,
  `rela_tabla63` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_72_tbl_tipo_personal`
--

CREATE TABLE IF NOT EXISTS `tabla_72_tbl_tipo_personal` (
  `id_tabla72` int(11) NOT NULL,
  `tabla72_descripcion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_73_cab_abono`
--

CREATE TABLE IF NOT EXISTS `tabla_73_cab_abono` (
  `id_tabla73` int(11) NOT NULL,
  `tabla73_nombre` varchar(255) NOT NULL,
  `Rela_tabla75` int(11) DEFAULT NULL,
  `Rela_tabla74` int(11) DEFAULT NULL,
  `tabla73_volumen_caldo` decimal(8,3) DEFAULT NULL,
  `tabla73_dosis` decimal(8,3) DEFAULT NULL,
  `rela_tabla76` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_74_tbl_unidad_medicion`
--

CREATE TABLE IF NOT EXISTS `tabla_74_tbl_unidad_medicion` (
  `id_tabla74` int(11) NOT NULL,
  `tabla74_Tipo_Unidad` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_75_tbl_tipo_quimico`
--

CREATE TABLE IF NOT EXISTS `tabla_75_tbl_tipo_quimico` (
  `id_tabla75` int(11) NOT NULL,
  `tabla75_tipo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_76_tbl_unidad_dosis`
--

CREATE TABLE IF NOT EXISTS `tabla_76_tbl_unidad_dosis` (
  `id_tabla76` int(11) NOT NULL,
  `tabla76_ descripcion` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_98_tbl_tipo_evento`
--

CREATE TABLE IF NOT EXISTS `tabla_98_tbl_tipo_evento` (
  `id_tabla98` int(11) NOT NULL,
  `tabla98_descripcion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_99_cab_eventoclimatologico`
--

CREATE TABLE IF NOT EXISTS `tabla_99_cab_eventoclimatologico` (
  `id_tabla99` int(11) NOT NULL,
  `tabla99_observacion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tabla99_fecha_inicio` datetime DEFAULT NULL,
  `tabla99_fecha_fin` datetime DEFAULT NULL,
  `rela_tabla16` int(11) DEFAULT NULL,
  `rela_tabla01` int(11) DEFAULT NULL,
  `rela_tabla74` int(11) DEFAULT NULL,
  `rela_tabla71` int(11) DEFAULT NULL,
  `tabla99_cantidad` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rela_tabla98` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `rela_tabla13` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_101_mov_actividad_maquinaria`
--

CREATE TABLE IF NOT EXISTS `tabla_101_mov_actividad_maquinaria` (
  `id_tabla101` int(11) NOT NULL,
  `rela_tabla22` int(11) NOT NULL,
  `rela_tabla100` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_102_mov_actividad_personal`
--

CREATE TABLE IF NOT EXISTS `tabla_102_mov_actividad_personal` (
  `id_tabla102` int(11) NOT NULL,
  `rela_tabla100` int(11) NOT NULL,
  `rela_tabla71` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tabla_01_usuarios`
--
ALTER TABLE `tabla_01_usuarios`
  ADD PRIMARY KEY (`id_tabla01`), ADD KEY `id_tabla01` (`id_tabla01`);

--
-- Indices de la tabla `tabla_02_modulos`
--
ALTER TABLE `tabla_02_modulos`
  ADD PRIMARY KEY (`id_tabla02`), ADD KEY `id_tabla02` (`id_tabla02`);

--
-- Indices de la tabla `tabla_03_perfiles`
--
ALTER TABLE `tabla_03_perfiles`
  ADD PRIMARY KEY (`id_tabla03`), ADD KEY `id_tabla03` (`id_tabla03`);

--
-- Indices de la tabla `tabla_04_det_perfiles`
--
ALTER TABLE `tabla_04_det_perfiles`
  ADD PRIMARY KEY (`id_tabla04`), ADD KEY `id_tabla04` (`id_tabla04`), ADD KEY `rela_tabla02_idx` (`rela_tabla02`), ADD KEY `rela_tabla03_idx` (`rela_tabla03`);

--
-- Indices de la tabla `tabla_05_log`
--
ALTER TABLE `tabla_05_log`
  ADD PRIMARY KEY (`id_tabla05`), ADD KEY `id_tabla05` (`id_tabla05`), ADD KEY `rela_tabla01_idx` (`rela_tabla01`), ADD KEY `rela_tabla002_idx` (`rela_tabla02`);

--
-- Indices de la tabla `tabla_06_det_usuarios_perfiles`
--
ALTER TABLE `tabla_06_det_usuarios_perfiles`
  ADD PRIMARY KEY (`id_tabla06`), ADD KEY `id_tabla06` (`id_tabla06`), ADD KEY `rela_tabla001_idx` (`rela_tabla01`), ADD KEY `rela_tabla003_idx` (`rela_tabla03`);

--
-- Indices de la tabla `tabla_09_arb_ubicacion_geografica`
--
ALTER TABLE `tabla_09_arb_ubicacion_geografica`
  ADD PRIMARY KEY (`id_tabla09`), ADD KEY `fk_tabla_09_arb_ubicacion_geografica_tabla_09_arb_ubicacion_idx` (`rela_padre`), ADD KEY `id_tabla09` (`id_tabla09`), ADD KEY `rela_tabla10_idx` (`rela_tabla10`);

--
-- Indices de la tabla `tabla_10_arb_niveles_arbol`
--
ALTER TABLE `tabla_10_arb_niveles_arbol`
  ADD PRIMARY KEY (`id_tabla10`), ADD KEY `fk_tabla_10_tab_niveles_arbol_tabla_11_cab_nomenclador1_idx` (`rela_tabla11`), ADD KEY `fk_tabla_10_tab_niveles_arbol_tabla_10_tab_niveles_arbol1_idx` (`rela_padre`);

--
-- Indices de la tabla `tabla_11_cab_nomenclador`
--
ALTER TABLE `tabla_11_cab_nomenclador`
  ADD PRIMARY KEY (`id_tabla11`);

--
-- Indices de la tabla `tabla_13_cab_trabajo`
--
ALTER TABLE `tabla_13_cab_trabajo`
  ADD PRIMARY KEY (`id_tabla13`), ADD KEY `id_tabla13` (`id_tabla13`), ADD KEY `Rela_Tabla14` (`Rela_Tabla14`);

--
-- Indices de la tabla `tabla_14_det_tipo_trabajo`
--
ALTER TABLE `tabla_14_det_tipo_trabajo`
  ADD PRIMARY KEY (`id_Tabla14`), ADD KEY `id_tabla14` (`id_Tabla14`);

--
-- Indices de la tabla `tabla_15_tbl_variedad`
--
ALTER TABLE `tabla_15_tbl_variedad`
  ADD PRIMARY KEY (`id_tabla15`);

--
-- Indices de la tabla `tabla_16_cab_cultivo`
--
ALTER TABLE `tabla_16_cab_cultivo`
  ADD PRIMARY KEY (`id_tabla16`), ADD KEY `id_tabla16` (`id_tabla16`), ADD KEY `rela_tabla65_idx` (`rela_tabla65`), ADD KEY `rela_tabla15_idx` (`rela_tabla15`);

--
-- Indices de la tabla `tabla_17_mov_cultivo_actividad`
--
ALTER TABLE `tabla_17_mov_cultivo_actividad`
  ADD PRIMARY KEY (`id_tabla17`), ADD KEY `id_tabla17` (`id_tabla17`), ADD KEY `rela_tablaa15_idx` (`rela_tabla16`), ADD KEY `rela_tablaa_idx` (`rela_tabla100`);

--
-- Indices de la tabla `tabla_18_cab_fitosanitario`
--
ALTER TABLE `tabla_18_cab_fitosanitario`
  ADD PRIMARY KEY (`id_tabla18`), ADD KEY `id_tabla18` (`id_tabla18`), ADD KEY `rela_tabla19_idx` (`Rela_tabla19`), ADD KEY `rela_tabla20_idx` (`Rela_tabla20`), ADD KEY `rela_tabla21_idx` (`Rela_tabla21`);

--
-- Indices de la tabla `tabla_19_tbl_tipo_dosis`
--
ALTER TABLE `tabla_19_tbl_tipo_dosis`
  ADD PRIMARY KEY (`id_tabla19`), ADD KEY `id_tabla19` (`id_tabla19`);

--
-- Indices de la tabla `tabla_20_tbl_tipo_preparado`
--
ALTER TABLE `tabla_20_tbl_tipo_preparado`
  ADD PRIMARY KEY (`id_tabla20`), ADD KEY `id_tabla20` (`id_tabla20`);

--
-- Indices de la tabla `tabla_21_tbl_tipo_funcion`
--
ALTER TABLE `tabla_21_tbl_tipo_funcion`
  ADD PRIMARY KEY (`id_tabla21`), ADD KEY `id_tabla21` (`id_tabla21`);

--
-- Indices de la tabla `tabla_22_tbl_maquinaria`
--
ALTER TABLE `tabla_22_tbl_maquinaria`
  ADD PRIMARY KEY (`id_tabla22`), ADD KEY `id_tabla22` (`id_tabla22`);

--
-- Indices de la tabla `tabla_23_tbl_mantenimiento`
--
ALTER TABLE `tabla_23_tbl_mantenimiento`
  ADD PRIMARY KEY (`id_tabla23`), ADD KEY `id_tabla23` (`id_tabla23`), ADD KEY `rela_tabla22_idx` (`rela_tabla22`);

--
-- Indices de la tabla `tabla_25_cab_semilla`
--
ALTER TABLE `tabla_25_cab_semilla`
  ADD PRIMARY KEY (`id_tabla25`), ADD KEY `id_tabla25` (`id_tabla25`), ADD KEY `rela_tablaaaa74_idx` (`rela_tabla74`), ADD KEY `rela_tablaaaa76_idx` (`rela_tabla76`), ADD KEY `rela_tablaaaa15_idx` (`rela_tabla15`), ADD KEY `rela_tablaaaa26_idx` (`rela_tabla26`), ADD KEY `rela_tablaaaa27_idx` (`rela_tabla27`), ADD KEY `rela_tablaaaa28_idx` (`rela_tabla28`);

--
-- Indices de la tabla `tabla_26_tbl_tipo_fruto`
--
ALTER TABLE `tabla_26_tbl_tipo_fruto`
  ADD PRIMARY KEY (`id_tabla26`), ADD KEY `id_tabla26` (`id_tabla26`);

--
-- Indices de la tabla `tabla_27_tbl_tipo_germinacion`
--
ALTER TABLE `tabla_27_tbl_tipo_germinacion`
  ADD PRIMARY KEY (`id_tabla27`), ADD KEY `id_tabla27` (`id_tabla27`);

--
-- Indices de la tabla `tabla_28_tbl_temperatura_humedad`
--
ALTER TABLE `tabla_28_tbl_temperatura_humedad`
  ADD PRIMARY KEY (`id_tabla28`), ADD KEY `id_tabla28` (`id_tabla28`);

--
-- Indices de la tabla `tabla_30_mov_actividad_abono`
--
ALTER TABLE `tabla_30_mov_actividad_abono`
  ADD PRIMARY KEY (`id_tabla30`), ADD KEY `id_tabla30` (`id_tabla30`), ADD KEY `rela_tabla100_actividad_idx` (`rela_tabla100`), ADD KEY `rela_tabla73_abono_idx` (`rela_tabla73`);

--
-- Indices de la tabla `tabla_31_mov_actividad_fitosanitario`
--
ALTER TABLE `tabla_31_mov_actividad_fitosanitario`
  ADD PRIMARY KEY (`id_tabla31`), ADD KEY `id_tabla31` (`id_tabla31`), ADD KEY `rela_tabla100_act_idx` (`rela_tabla100`), ADD KEY `rela_tabla18_fito_idx` (`rela_tabla18`);

--
-- Indices de la tabla `tabla_32_mov_actividad_semilla`
--
ALTER TABLE `tabla_32_mov_actividad_semilla`
  ADD PRIMARY KEY (`id_tabla32`), ADD KEY `id_tabla32` (`id_tabla32`), ADD KEY `rela_tabla100_acti_idx` (`rela_tabla100`), ADD KEY `rela_tabla25_semi_idx` (`rela_tabla25`);

--
-- Indices de la tabla `tabla_33_tbl_plaga`
--
ALTER TABLE `tabla_33_tbl_plaga`
  ADD PRIMARY KEY (`id_tabla33`);

--
-- Indices de la tabla `tabla_34_mov_fitosanitario_plaga`
--
ALTER TABLE `tabla_34_mov_fitosanitario_plaga`
  ADD PRIMARY KEY (`id_tabla34`), ADD KEY `id_tabla34` (`id_tabla34`), ADD KEY `rela_tabla18_fitosa_idx` (`rela_tabla18`), ADD KEY `rela_tabla33_plaga_idx` (`rela_tabla33`);

--
-- Indices de la tabla `tabla_35_cab_observacion`
--
ALTER TABLE `tabla_35_cab_observacion`
  ADD PRIMARY KEY (`id_tabla35`), ADD KEY `id_tabla35` (`id_tabla35`), ADD KEY `rela_tabla_idx` (`rela_tabla71`), ADD KEY `rela_tabla33_plag_idx` (`rela_tabla33`), ADD KEY `rela_tabla36_cabobs_idx` (`rela_tabla36`), ADD KEY `rela_tabla16cultivs_idx` (`rela_tabla16`);

--
-- Indices de la tabla `tabla_36_tbl_tipo_observacion`
--
ALTER TABLE `tabla_36_tbl_tipo_observacion`
  ADD PRIMARY KEY (`id_tabla36`), ADD KEY `id_tabla36` (`id_tabla36`), ADD KEY `rela_tabla74_unidmed_idx` (`rela_tabla74`);

--
-- Indices de la tabla `tabla_63_tbl_finca`
--
ALTER TABLE `tabla_63_tbl_finca`
  ADD PRIMARY KEY (`id_tabla63`), ADD KEY `id_tabla63` (`id_tabla63`), ADD KEY `rela_tabla67` (`rela_tabla67`), ADD KEY `rela_tabla70_finca_idx` (`rela_tabla70_finca`), ADD KEY `rela_tabla70_titular_idx` (`rela_tabla70_titular`);

--
-- Indices de la tabla `tabla_64_tbl_predio`
--
ALTER TABLE `tabla_64_tbl_predio`
  ADD PRIMARY KEY (`id_tabla64`), ADD KEY `id_tabla64` (`id_tabla64`), ADD KEY `rela_tabla63` (`rela_tabla63`), ADD KEY `rela_tabla09_idx` (`rela_tabla09`);

--
-- Indices de la tabla `tabla_65_tbl_parcela`
--
ALTER TABLE `tabla_65_tbl_parcela`
  ADD PRIMARY KEY (`id_tabla65`), ADD KEY `id_tabla65` (`id_tabla65`), ADD KEY `rela_tabla66` (`rela_tabla66`), ADD KEY `rela_tabla64` (`rela_tabla64`), ADD KEY `rela_tabla09_idx` (`rela_tabla09`);

--
-- Indices de la tabla `tabla_66_tbl_sisriego`
--
ALTER TABLE `tabla_66_tbl_sisriego`
  ADD PRIMARY KEY (`id_tabla66`);

--
-- Indices de la tabla `tabla_67_tbl_tipocertifica`
--
ALTER TABLE `tabla_67_tbl_tipocertifica`
  ADD PRIMARY KEY (`id_tabla67`);

--
-- Indices de la tabla `tabla_70_tbl_persona`
--
ALTER TABLE `tabla_70_tbl_persona`
  ADD PRIMARY KEY (`id_tabla70`), ADD KEY `id_tabla70` (`id_tabla70`), ADD KEY `rela_tabla09_idx` (`rela_tabla09`);

--
-- Indices de la tabla `tabla_71_cab_personal`
--
ALTER TABLE `tabla_71_cab_personal`
  ADD PRIMARY KEY (`id_tabla71`), ADD KEY `id_tabla71` (`id_tabla71`), ADD KEY `rela_tabla70_idx` (`rela_tabla70`), ADD KEY `rela_tabla72_idx` (`rela_tabla72`), ADD KEY `rela_tabla63_idx` (`rela_tabla63`);

--
-- Indices de la tabla `tabla_72_tbl_tipo_personal`
--
ALTER TABLE `tabla_72_tbl_tipo_personal`
  ADD PRIMARY KEY (`id_tabla72`), ADD KEY `id_tabla72` (`id_tabla72`);

--
-- Indices de la tabla `tabla_73_cab_abono`
--
ALTER TABLE `tabla_73_cab_abono`
  ADD PRIMARY KEY (`id_tabla73`), ADD KEY `Rela_tipo_quimico` (`Rela_tabla74`), ADD KEY `Rela_unidad_medicion` (`Rela_tabla75`), ADD KEY `id_tabla73` (`id_tabla73`), ADD KEY `rela_tabla76_idx` (`rela_tabla76`);

--
-- Indices de la tabla `tabla_74_tbl_unidad_medicion`
--
ALTER TABLE `tabla_74_tbl_unidad_medicion`
  ADD PRIMARY KEY (`id_tabla74`), ADD KEY `id_tabla74|` (`id_tabla74`);

--
-- Indices de la tabla `tabla_75_tbl_tipo_quimico`
--
ALTER TABLE `tabla_75_tbl_tipo_quimico`
  ADD PRIMARY KEY (`id_tabla75`), ADD KEY `id_tabla75` (`id_tabla75`);

--
-- Indices de la tabla `tabla_76_tbl_unidad_dosis`
--
ALTER TABLE `tabla_76_tbl_unidad_dosis`
  ADD PRIMARY KEY (`id_tabla76`), ADD KEY `id_tabla76` (`id_tabla76`);

--
-- Indices de la tabla `tabla_98_tbl_tipo_evento`
--
ALTER TABLE `tabla_98_tbl_tipo_evento`
  ADD PRIMARY KEY (`id_tabla98`);

--
-- Indices de la tabla `tabla_99_cab_eventoclimatologico`
--
ALTER TABLE `tabla_99_cab_eventoclimatologico`
  ADD PRIMARY KEY (`id_tabla99`), ADD KEY `rela_tabla74_unidmed_idx` (`rela_tabla74`), ADD KEY `id_tabla99` (`id_tabla99`), ADD KEY `rela_tabla01_usua_idx` (`rela_tabla01`), ADD KEY `rela_tabla71_person_idx` (`rela_tabla71`), ADD KEY `rela_tabla16_cult_idx` (`rela_tabla16`), ADD KEY `rela_tabla98_tipoeve_idx` (`rela_tabla98`);

--
-- Indices de la tabla `tabla_100_tbl_actividad`
--
ALTER TABLE `tabla_100_tbl_actividad`
  ADD PRIMARY KEY (`id_tabla100`), ADD KEY `id_tabla100` (`id_tabla100`), ADD KEY `rela_tabla01_idx` (`rela_tabla01`), ADD KEY `rela_tablaaa65_idx` (`rela_tabla65`), ADD KEY `rela_tablaaa13_idx` (`rela_tabla13`);

--
-- Indices de la tabla `tabla_101_mov_actividad_maquinaria`
--
ALTER TABLE `tabla_101_mov_actividad_maquinaria`
  ADD PRIMARY KEY (`id_tabla101`), ADD KEY `id_tabla101` (`id_tabla101`), ADD KEY `rela_tabla22_idx` (`rela_tabla22`), ADD KEY `rela_tabla100_idx` (`rela_tabla100`);

--
-- Indices de la tabla `tabla_102_mov_actividad_personal`
--
ALTER TABLE `tabla_102_mov_actividad_personal`
  ADD PRIMARY KEY (`id_tabla102`), ADD KEY `id_tabla102` (`id_tabla102`), ADD KEY `rela_tabla100_idx` (`rela_tabla100`), ADD KEY `rela_tablaa71_idx` (`rela_tabla71`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tabla_01_usuarios`
--
ALTER TABLE `tabla_01_usuarios`
  MODIFY `id_tabla01` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tabla_02_modulos`
--
ALTER TABLE `tabla_02_modulos`
  MODIFY `id_tabla02` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
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
  MODIFY `id_tabla05` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tabla_06_det_usuarios_perfiles`
--
ALTER TABLE `tabla_06_det_usuarios_perfiles`
  MODIFY `id_tabla06` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `tabla_09_arb_ubicacion_geografica`
--
ALTER TABLE `tabla_09_arb_ubicacion_geografica`
  MODIFY `id_tabla09` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_11_cab_nomenclador`
--
ALTER TABLE `tabla_11_cab_nomenclador`
  MODIFY `id_tabla11` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_13_cab_trabajo`
--
ALTER TABLE `tabla_13_cab_trabajo`
  MODIFY `id_tabla13` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_14_det_tipo_trabajo`
--
ALTER TABLE `tabla_14_det_tipo_trabajo`
  MODIFY `id_Tabla14` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_15_tbl_variedad`
--
ALTER TABLE `tabla_15_tbl_variedad`
  MODIFY `id_tabla15` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tabla_16_cab_cultivo`
--
ALTER TABLE `tabla_16_cab_cultivo`
  MODIFY `id_tabla16` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `tabla_17_mov_cultivo_actividad`
--
ALTER TABLE `tabla_17_mov_cultivo_actividad`
  MODIFY `id_tabla17` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_18_cab_fitosanitario`
--
ALTER TABLE `tabla_18_cab_fitosanitario`
  MODIFY `id_tabla18` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `tabla_22_tbl_maquinaria`
--
ALTER TABLE `tabla_22_tbl_maquinaria`
  MODIFY `id_tabla22` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_23_tbl_mantenimiento`
--
ALTER TABLE `tabla_23_tbl_mantenimiento`
  MODIFY `id_tabla23` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_25_cab_semilla`
--
ALTER TABLE `tabla_25_cab_semilla`
  MODIFY `id_tabla25` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_26_tbl_tipo_fruto`
--
ALTER TABLE `tabla_26_tbl_tipo_fruto`
  MODIFY `id_tabla26` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_27_tbl_tipo_germinacion`
--
ALTER TABLE `tabla_27_tbl_tipo_germinacion`
  MODIFY `id_tabla27` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_28_tbl_temperatura_humedad`
--
ALTER TABLE `tabla_28_tbl_temperatura_humedad`
  MODIFY `id_tabla28` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_30_mov_actividad_abono`
--
ALTER TABLE `tabla_30_mov_actividad_abono`
  MODIFY `id_tabla30` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_31_mov_actividad_fitosanitario`
--
ALTER TABLE `tabla_31_mov_actividad_fitosanitario`
  MODIFY `id_tabla31` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_32_mov_actividad_semilla`
--
ALTER TABLE `tabla_32_mov_actividad_semilla`
  MODIFY `id_tabla32` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_33_tbl_plaga`
--
ALTER TABLE `tabla_33_tbl_plaga`
  MODIFY `id_tabla33` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tabla_34_mov_fitosanitario_plaga`
--
ALTER TABLE `tabla_34_mov_fitosanitario_plaga`
  MODIFY `id_tabla34` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_35_cab_observacion`
--
ALTER TABLE `tabla_35_cab_observacion`
  MODIFY `id_tabla35` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_36_tbl_tipo_observacion`
--
ALTER TABLE `tabla_36_tbl_tipo_observacion`
  MODIFY `id_tabla36` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_63_tbl_finca`
--
ALTER TABLE `tabla_63_tbl_finca`
  MODIFY `id_tabla63` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tabla_64_tbl_predio`
--
ALTER TABLE `tabla_64_tbl_predio`
  MODIFY `id_tabla64` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tabla_65_tbl_parcela`
--
ALTER TABLE `tabla_65_tbl_parcela`
  MODIFY `id_tabla65` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tabla_66_tbl_sisriego`
--
ALTER TABLE `tabla_66_tbl_sisriego`
  MODIFY `id_tabla66` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_67_tbl_tipocertifica`
--
ALTER TABLE `tabla_67_tbl_tipocertifica`
  MODIFY `id_tabla67` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tabla_70_tbl_persona`
--
ALTER TABLE `tabla_70_tbl_persona`
  MODIFY `id_tabla70` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_71_cab_personal`
--
ALTER TABLE `tabla_71_cab_personal`
  MODIFY `id_tabla71` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_72_tbl_tipo_personal`
--
ALTER TABLE `tabla_72_tbl_tipo_personal`
  MODIFY `id_tabla72` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_73_cab_abono`
--
ALTER TABLE `tabla_73_cab_abono`
  MODIFY `id_tabla73` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_74_tbl_unidad_medicion`
--
ALTER TABLE `tabla_74_tbl_unidad_medicion`
  MODIFY `id_tabla74` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_75_tbl_tipo_quimico`
--
ALTER TABLE `tabla_75_tbl_tipo_quimico`
  MODIFY `id_tabla75` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_76_tbl_unidad_dosis`
--
ALTER TABLE `tabla_76_tbl_unidad_dosis`
  MODIFY `id_tabla76` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_98_tbl_tipo_evento`
--
ALTER TABLE `tabla_98_tbl_tipo_evento`
  MODIFY `id_tabla98` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_99_cab_eventoclimatologico`
--
ALTER TABLE `tabla_99_cab_eventoclimatologico`
  MODIFY `id_tabla99` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla_102_mov_actividad_personal`
--
ALTER TABLE `tabla_102_mov_actividad_personal`
  MODIFY `id_tabla102` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
