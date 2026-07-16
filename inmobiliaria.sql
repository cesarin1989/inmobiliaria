-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2018 a las 09:49:11
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
`id` bigint(20) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `lugar` varchar(30) NOT NULL,
  `id_cliente` bigint(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `fecha`, `hora`, `motivo`, `lugar`, `id_cliente`) VALUES
(11, '2026-07-20', '11:00:00', 'Entrega llaves casa', 'Urbanización Entre Ríos, Mz. C V. 4', 3),
(15, '2026-07-22', '17:00:00', 'Visita de suite', 'Edificio Bellini, suite 105', 15),
(16, '2026-07-25', '09:30:00', 'Firma de promesa compraventa', 'Oficina', 3),
(20, '2026-07-28', '13:00:00', 'Visitar local comercial', 'Urdesa Central, Calle Guayacanes', 2),
(21, '2026-07-29', '11:00:00', 'Visita de departamento', 'Ceibos Altos, Edificio Ceibos', 15),
(22, '2026-07-30', '09:00:00', 'Firma de contrato arrendamiento', 'Oficina', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono1` varchar(15) NOT NULL,
  `telefono2` varchar(15) DEFAULT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `direccion`, `telefono1`, `telefono2`, `nombre_usuario`, `pass`) VALUES
(0, 'disponible', '', '', '', NULL, '', ''),
(1, 'administrador', 'administrador', 'administrador', '111111111', '', 'admin', 'c3284d0f94606de1fd2af172aba15bf3'),
(2, 'Marisa', 'Perez Martínez', 'Av. Nueva, 123', '611622633', '', '', ''),
(3, 'Timoteo', 'Torrecillas ', 'Plaza vieja, 89', '611622633', '644323198', '', ''),
(15, 'Rubén', 'Segura Romo', 'C/ Doctor Pareja Yébenes, 8', '664790808', '', 'ruben', '9c4ef266a68738cf884f1a990424f05f'),
(16, 'Delia', 'Sánchez Carrillo', 'C/ industrial, 17', '612321441', '', 'delia', '6bc5e6e2c31e813fb33bef0f2d938f05'),
(17, 'José', 'Torrecillas Fernández', 'C/ Tahona ,5', '685633215', '615993215', 'jose', '9b68086445d968e8a97f74f00df9738f'),
(18, 'Cesar', 'Mora', 'Urb. Vía a la Costa, Guayaquil', '0969048724', NULL, 'cesar', '83b33026118508c924a3931f183a194f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE IF NOT EXISTS `inmuebles` (
`id` bigint(20) unsigned NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `descripcion` varchar(1500) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `id_cliente` bigint(20) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `direccion`, `descripcion`, `precio`, `id_cliente`, `imagen`) VALUES
(7, 'Urbanización Entre Ríos, Av. Samborondón', 'Hermosa casa de dos plantas con acabados de primera, sala familiar, patio amplio, cocina equipada, club social con piscina.', '220000.00', 15, './img_inmuebles/7.png'),
(8, 'Puerto Santa Ana, Edificio The Point', 'Espectacular suite amoblada de estreno, vista al río Guayas, incluye parqueo, área social con jacuzzi, gimnasio y seguridad las 24 horas.', '135000.00', 14, './img_inmuebles/8.png'),
(10, 'Urdesa Central, Calle Guayacanes', 'Amplia propiedad de una planta ideal para oficinas o vivienda, excelente ubicación comercial, patio trasero, parqueo para 3 vehículos.', '180000.00', 0, './img_inmuebles/10.jpg'),
(12, 'Vía a la Costa, Urbanización Portal al Sol', 'Moderna casa por estrenar, 3 dormitorios con baños privados, sala, comedor, cocina abierta, amplio jardín, club social deportivo.', '165000.00', 0, './img_inmuebles/12.png'),
(15, 'Isla Mocolí, Samborondón', 'Exclusiva residencia de superlujo frente al lago, acabados importados, piscina privada, domótica integrada, 4 dormitorios máster.', '850000.00', 0, './img_inmuebles/15.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
`id` bigint(20) unsigned NOT NULL,
  `titular` varchar(30) NOT NULL,
  `contenido` varchar(1500) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titular`, `contenido`, `imagen`, `fecha`) VALUES
(1, 'Lanzamiento de Socio Bienes', 'Nos complace anunciar el lanzamiento oficial de la plataforma web de Socio Bienes. Ofrecemos soluciones habitacionales personalizadas en Guayaquil, con asesoramiento profesional de inicio a fin en la compra, venta y alquiler de bienes inmuebles.', './img_noticias/1.png', '2026-07-01'),
(4, 'Créditos VIP en Ecuador', 'El mercado de viviendas de Interés Público (VIP) en Ecuador registra un fuerte dinamismo debido a las tasas de interés preferenciales del 4.87% para la primera vivienda. Socio Bienes cuenta con un amplio catálogo que aplica a este beneficio estatal.', './img_noticias/4.png', '2026-07-05'),
(7, 'Crecimiento de Vía a la Costa', 'Vía a la Costa se consolida como uno de los polos de desarrollo inmobiliario y de plusvalía más importantes en Guayaquil. Nuevos proyectos urbanísticos y centros comerciales atraen a compradores que buscan seguridad y bienestar familiar.', './img_noticias/6.png', '2026-07-10'),
(16, 'Auge de Puerto Santa Ana', 'Puerto Santa Ana se mantiene como el sector con mayor demanda para suites de lujo y oficinas en la urbe. Su excelente rentabilidad para alquileres vacacionales y ejecutivos atrae constantemente a inversionistas locales e internacionales.', './img_noticias/16.png', '2026-07-12'),
(17, 'Consejos de Inversión', 'Invertir en bienes raíces en Guayaquil sigue siendo la alternativa más estable para proteger el capital contra la inflación. En Socio Bienes te brindamos asesoramiento integral en cada paso del proceso para garantizar tu rentabilidad.', './img_noticias/17.png', '2026-07-13'),
(18, 'Exclusividad en Samborondón', 'Ampliamos nuestro portafolio en la zona de Samborondón e Isla Mocolí. Te invitamos a conocer nuestras residencias premium, diseñadas con los más altos estándares de diseño, seguridad y exclusividad para el confort de tu familia.', './img_noticias/18.png', '2026-07-14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Estructura de tabla para la tabla `mensajes`
--
CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `asunto` varchar(50) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
