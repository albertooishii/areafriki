-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-07-2016 a las 04:21:39
-- Versión del servidor: 5.5.45-cll-lve
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `lafrikitienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributos`
--

CREATE TABLE IF NOT EXISTS `atributos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tipo` set('size','color','modelo') CHARACTER SET latin1 NOT NULL,
  `categoria` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria` (`categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficio_valor`
--

CREATE TABLE IF NOT EXISTS `beneficio_valor` (
  `producto` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `beneficio` float(6,2) NOT NULL,
  PRIMARY KEY (`producto`,`valor`),
  KEY `valor` (`valor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE IF NOT EXISTS `carritos` (
  `user` int(11) NOT NULL,
  `phpsessid` varchar(40) CHARACTER SET latin1 NOT NULL,
  `token` varchar(8) CHARACTER SET latin1 NOT NULL,
  `pedido` text CHARACTER SET latin1 NOT NULL,
  `fecha` datetime NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `cp` varchar(6) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `provincia` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`user`,`phpsessid`),
  UNIQUE KEY `phpsessid` (`phpsessid`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(255) CHARACTER SET latin1 NOT NULL,
  `descripcion_corta` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `precio_base` float DEFAULT NULL,
  `beneficio` float DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos_beta`
--

CREATE TABLE IF NOT EXISTS `codigos_beta` (
  `codigo` varchar(8) NOT NULL,
  `usado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `producto` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `comentario` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(40) CHARACTER SET latin1 NOT NULL,
  `reported` tinyint(1) NOT NULL DEFAULT '0',
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`fecha`,`producto`,`user`),
  KEY `producto` (`producto`),
  KEY `user` (`user`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `designs`
--

CREATE TABLE IF NOT EXISTS `designs` (
  `token` varchar(8) NOT NULL,
  `user` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `publi` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`token`),
  UNIQUE KEY `token` (`token`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `producto` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`producto`,`user`),
  KEY `producto_2` (`producto`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_pedido`
--

CREATE TABLE IF NOT EXISTS `linea_pedido` (
  `linea` int(11) NOT NULL DEFAULT '0',
  `pedido` varchar(8) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `producto` int(11) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `color` int(11) NOT NULL,
  PRIMARY KEY (`linea`,`pedido`),
  KEY `pedido` (`pedido`),
  KEY `producto` (`producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listas`
--

CREATE TABLE IF NOT EXISTS `listas` (
  `nombre` varchar(70) NOT NULL,
  `user` int(11) NOT NULL,
  `token` varchar(8) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nombre`,`user`),
  KEY `user` (`user`),
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `packs`
--

CREATE TABLE IF NOT EXISTS `packs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` set('cantidad','design') CHARACTER SET latin1 NOT NULL,
  `categoria` int(11) NOT NULL,
  `valor_atributo` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET latin1 NOT NULL,
  `comision` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `token` varchar(8) CHARACTER SET latin1 NOT NULL,
  `fecha` datetime NOT NULL,
  `transporte` int(11) DEFAULT NULL,
  `estado` set('pendiente','pagado','enviado','entregado','cancelado') CHARACTER SET latin1 DEFAULT NULL,
  `pago` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`token`),
  KEY `transporte` (`transporte`),
  KEY `pago` (`pago`),
  KEY `cliente` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `beneficio` float(6,2) DEFAULT NULL,
  `design` varchar(8) NOT NULL,
  `categoria` int(11) NOT NULL,
  `color` varchar(7) CHARACTER SET latin1 DEFAULT NULL,
  `modelo` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `revisado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_publicacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `ventas` int(11) DEFAULT '0',
  `visitas` int(11) NOT NULL DEFAULT '0',
  `shares` int(11) NOT NULL DEFAULT '0',
  `height` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `top_pos` float DEFAULT NULL,
  `left_pos` float DEFAULT NULL,
  `scale` float DEFAULT NULL,
  `usado` tinyint(1) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `preparacion` int(11) DEFAULT NULL,
  `gastos_envio` float(6,2) DEFAULT NULL,
  `tiempo_envio` int(11) DEFAULT NULL,
  `lista` varchar(8) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `design` (`design`),
  KEY `lista` (`lista`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_tag`
--

CREATE TABLE IF NOT EXISTS `producto_tag` (
  `producto` int(11) NOT NULL,
  `tag` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`producto`,`tag`),
  KEY `tag` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `id` smallint(6) DEFAULT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `nombre` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `activa` tinyint(1) NOT NULL,
  PRIMARY KEY (`nombre`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportes`
--

CREATE TABLE IF NOT EXISTS `transportes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET latin1 NOT NULL,
  `peso_min` float NOT NULL,
  `peso_max` float NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pass` binary(20) NOT NULL,
  `name` varchar(60) CHARACTER SET latin1 NOT NULL,
  `idnum` varchar(9) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cp` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  `provincia` int(11) DEFAULT NULL,
  `localidad` varchar(75) CHARACTER SET latin1 DEFAULT NULL,
  `phone` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ocupacion` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `intereses` varchar(255) DEFAULT NULL,
  `banco` varchar(24) CHARACTER SET latin1 DEFAULT NULL,
  `paypal` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `avatar` tinyint(1) DEFAULT NULL,
  `banner` tinyint(1) NOT NULL DEFAULT '0',
  `rol` set('comprador','vendedor','moderador','admin') CHARACTER SET latin1 NOT NULL DEFAULT 'comprador',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `creation_date` datetime NOT NULL,
  `last_date` datetime DEFAULT NULL,
  `creation_ip` varchar(40) CHARACTER SET latin1 NOT NULL,
  `last_ip` varchar(40) CHARACTER SET latin1 DEFAULT NULL,
  `num_logins` int(11) NOT NULL DEFAULT '0',
  `recoverpasskey` binary(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `idnum` (`idnum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores`
--

CREATE TABLE IF NOT EXISTS `valores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atributo` int(11) NOT NULL,
  `codigo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `valor` varchar(60) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `precio_base` float(6,2) DEFAULT NULL,
  `beneficio` float(6,2) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `atributo` (`atributo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=179 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores_pack`
--

CREATE TABLE IF NOT EXISTS `valores_pack` (
  `pack` int(11) NOT NULL,
  `valor` varchar(60) CHARACTER SET latin1 NOT NULL,
  `codigo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `precio_base` float(6,2) NOT NULL,
  PRIMARY KEY (`pack`,`valor`,`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `atributos`
--
ALTER TABLE `atributos`
  ADD CONSTRAINT `atributos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `beneficio_valor`
--
ALTER TABLE `beneficio_valor`
  ADD CONSTRAINT `beneficio_valor_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `beneficio_valor_ibfk_2` FOREIGN KEY (`valor`) REFERENCES `valores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`parent`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `designs`
--
ALTER TABLE `designs`
  ADD CONSTRAINT `designs_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `listas`
--
ALTER TABLE `listas`
  ADD CONSTRAINT `listas_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`transporte`) REFERENCES `transportes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`pago`) REFERENCES `pagos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`design`) REFERENCES `designs` (`token`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`lista`) REFERENCES `listas` (`token`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_tag`
--
ALTER TABLE `producto_tag`
  ADD CONSTRAINT `producto_tag_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_tag_ibfk_2` FOREIGN KEY (`tag`) REFERENCES `tags` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `valores`
--
ALTER TABLE `valores`
  ADD CONSTRAINT `valores_ibfk_1` FOREIGN KEY (`atributo`) REFERENCES `atributos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
