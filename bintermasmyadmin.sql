-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2024 a las 03:37:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bintermas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idreserva` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idvuelo` int(11) DEFAULT NULL,
  `fecha_reserva` datetime DEFAULT NULL,
  `fecha_limite` datetime DEFAULT NULL,
  `estado` enum('activa','inactiva','pagada') DEFAULT NULL,
  `tipoTarifa` enum('superpromo','promo','económica','flexible','fleximas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idreserva`, `idusuario`, `idvuelo`, `fecha_reserva`, `fecha_limite`, `estado`, `tipoTarifa`) VALUES
(17, 1, 2, '2024-12-02 18:13:41', '2024-12-03 18:13:41', 'activa', 'superpromo'),
(18, 1, 3, '2024-12-02 18:23:38', '2024-12-03 18:23:38', 'activa', 'económica'),
(20, 2, 9, '2024-12-02 18:38:26', '2024-12-05 18:38:26', 'activa', 'económica'),
(21, 3, 8, '2024-12-02 18:38:57', '2024-12-04 18:38:57', 'activa', 'flexible'),
(22, 1, 5, '2024-12-01 10:30:00', '2024-12-02 10:30:00', 'pagada', 'flexible'),
(24, 1, 6, '2024-12-01 10:30:00', '2024-12-02 10:30:00', 'inactiva', 'flexible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restablecimiento`
--

CREATE TABLE `restablecimiento` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `expiracion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `restablecimiento`
--

INSERT INTO `restablecimiento` (`id`, `user_id`, `codigo`, `expiracion`) VALUES
(3, 1, 'a2fdfea7', '2024-12-02 20:09:59'),
(4, 1, '582813b2', '2024-12-02 20:13:28'),
(7, 1, '14fa5964', '2024-12-03 03:44:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `residente` enum('Si','No') NOT NULL,
  `isla` varchar(50) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `documento_tipo` enum('DNI','NIE') NOT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `tarjeta_tipo` enum('Verde','Plata','Oro') DEFAULT 'Verde',
  `puntos` int(11) DEFAULT 100,
  `numero_tarjeta` varchar(20) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `primer_apellido`, `segundo_apellido`, `fecha_nacimiento`, `nacionalidad`, `residente`, `isla`, `municipio`, `telefono`, `email`, `documento_tipo`, `numero_documento`, `contraseña`, `tarjeta_tipo`, `puntos`, `numero_tarjeta`, `foto_perfil`) VALUES
(1, 'cristian', 'martinez', 'foncubierta', '1990-10-26', 'Española', 'Si', 'Fuerteventura', 'Puerto del Rosario', '666777888', 'foncu90@gmail.com', 'DNI', '48966176g', '$2y$10$Sd7Aux3JKRWhulPPwCgt8u9tqYVMJGwdg3e3uLpilif0upB8DcpIC', 'Verde', 360, 'NT109594', 'b3137760d76f798f302d78c26c73826079062bd4.jpg'),
(2, 'paco', 'pepe', 'papo', '2010-10-10', 'Española', 'Si', 'Fuerteventura', 'Puerto del Rosario', '666776677', 'pepe@gmail.com', 'DNI', '44444444g', '$2y$10$ImmCt3IMciyjAoaVWfMOIuHZ7gk/3jvRwwbjmKxSvSspzMO5oZpNG', 'Oro', 9850, 'NT306069', '3af4189a6fae69a2c53f39ca6132102a2455a1d2.jpg'),
(3, 'Pepe', 'pepe', 'papo', '2002-02-20', 'Española', 'No', 'Fuerteventura', 'Puerto del Rosario', '666666666', 'pepe@lajaresrealstate.com', 'DNI', '66666666g', '$2y$10$Kp/FU5kZIC.XICESVU3ooedP3wwLAMlJFGhPgnWEAf9CdE/821MUC', 'Plata', 3000, 'NT206074', '8436fd298982687f5788fc8caac6d23578068ca0.jpg'),
(4, 'paul', 'paul', 'paul', '1990-12-12', 'Española', 'Si', 'Fuerteventura', 'Antigua', '66667766', 'paul@lajaresrealstate.com', 'DNI', '55555555g', '$2y$10$QsljAN83skPIZXgiU5x6jeDObhdHemLCy1bbLqrbqGRA2a9YK2Bsm', 'Verde', 100, 'NT106840', NULL),
(5, 'Manu', 'manu', 'manu', '1999-12-13', 'Española', 'Si', 'Lanzarote', 'Arrecife', '677676767', 'manumanu@gmail.com', 'DNI', '33333333g', '$2y$10$dxlK4sxyB/YulTYfL0NgKuAZJKU99kc6Lwy4SGWu5RIFGM.iWf5G.', 'Verde', 100, 'NT103914', NULL),
(6, 'Luis', 'Manuel', '', '2008-12-03', 'Española', 'Si', 'Tenerife', 'La Laguna', '666555444', 'luis@gmail.com', 'NIE', 'X4567658T', '$2y$10$iuOoSd1gFkGPoAWSkgUmaONTp/2k0CeECwUDqQQYBC5ZDmnjIunSu', 'Verde', 100, 'NT105124', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `IdVuelo` int(11) NOT NULL,
  `NumVuelo` char(5) DEFAULT NULL,
  `origen` enum('TFN','TFS','LPA','FUE','ACE','SPC','GMZ','VDE') DEFAULT NULL,
  `destino` enum('TFN','TFS','LPA','FUE','ACE','SPC','GMZ','VDE') DEFAULT NULL,
  `fechaHora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`IdVuelo`, `NumVuelo`, `origen`, `destino`, `fechaHora`) VALUES
(1, 'NT223', 'LPA', 'FUE', '2024-12-03 12:00:00'),
(2, 'NT935', 'FUE', 'TFN', '2024-12-03 12:15:00'),
(3, 'NT624', 'TFN', 'LPA', '2024-12-03 13:30:00'),
(4, 'NT448', 'LPA', 'ACE', '2024-12-03 14:45:00'),
(5, 'NT756', 'ACE', 'TFN', '2024-12-03 16:00:00'),
(6, 'NT234', 'LPA', 'TFN', '2024-12-03 17:15:00'),
(7, 'NT812', 'FUE', 'ACE', '2024-12-03 18:30:00'),
(8, 'NT987', 'FUE', 'LPA', '2024-12-03 19:45:00'),
(9, 'NT456', 'SPC', 'GMZ', '2024-12-03 10:30:00'),
(10, 'NT789', 'GMZ', 'VDE', '2024-12-03 11:45:00'),
(11, 'NT321', 'VDE', 'SPC', '2024-12-03 13:00:00'),
(12, 'NT654', 'GMZ', 'LPA', '2024-12-03 14:15:00'),
(13, 'NT987', 'SPC', 'TFN', '2024-12-03 15:30:00'),
(14, 'NT246', 'VDE', 'FUE', '2024-12-03 16:45:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idreserva`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idvuelo` (`idvuelo`);

--
-- Indices de la tabla `restablecimiento`
--
ALTER TABLE `restablecimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `numero_documento` (`numero_documento`);

--
-- Indices de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`IdVuelo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idreserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `restablecimiento`
--
ALTER TABLE `restablecimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  MODIFY `IdVuelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`idvuelo`) REFERENCES `vuelos` (`IdVuelo`);

--
-- Filtros para la tabla `restablecimiento`
--
ALTER TABLE `restablecimiento`
  ADD CONSTRAINT `restablecimiento_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `activas` ON SCHEDULE EVERY 1 DAY STARTS '2024-11-27 16:17:30' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE reservas SET estado = 'inactiva' WHERE current_timestamp >= OutReserva$$

CREATE DEFINER=`root`@`localhost` EVENT `activasss` ON SCHEDULE EVERY 1 DAY STARTS '2024-12-02 17:25:10' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE reservas SET estado = 'inactiva' where current_timestamp>=fecha_limite$$

CREATE DEFINER=`root`@`localhost` EVENT `actualizar_dia_vuelos` ON SCHEDULE EVERY 1 DAY STARTS '2024-12-03 02:20:22' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE vuelos
SET fechahora = CONCAT(CURDATE(), ' ', TIME(fechahora))$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
