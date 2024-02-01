-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2023 a las 20:10:53
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `studium_dws_p2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ninos`
--

CREATE TABLE `ninos` (
  `idNino` int(11) NOT NULL,
  `nombreNino` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `bueno` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `ninos`
--

INSERT INTO `ninos` (`idNino`, `nombreNino`, `apellidos`, `fechaNacimiento`, `bueno`) VALUES
(54, 'Alberto', 'Alcántara', '1994-10-13', 0),
(55, 'Beatriz', 'Bueno', '1982-04-18', 1),
(56, 'Carlos', 'Crespo', '1998-12-01', 1),
(57, 'Diana', 'Domínguez', '1987-09-02', 0),
(58, 'Emilio', 'Enamorado', '1996-08-12', 1),
(59, 'Francisca', 'Fernández', '1990-07-28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ninos_juguetes`
--

CREATE TABLE `ninos_juguetes` (
  `id` int(11) NOT NULL,
  `idNinoFK` int(11) NOT NULL,
  `idJugueteFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `ninos_juguetes`
--

INSERT INTO `ninos_juguetes` (`id`, `idNinoFK`, `idJugueteFK`) VALUES
(72, 54, 4),
(73, 55, 1),
(74, 55, 13),
(75, 56, 3),
(76, 57, 9),
(77, 57, 6),
(78, 58, 7),
(79, 58, 5),
(80, 59, 11),
(81, 59, 10),
(82, 57, 8),
(83, 55, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regalos`
--

CREATE TABLE `regalos` (
  `idJuguete` int(11) NOT NULL,
  `nombreJuguete` varchar(45) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `idReyFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `regalos`
--

INSERT INTO `regalos` (`idJuguete`, `nombreJuguete`, `precio`, `idReyFK`) VALUES
(1, 'Aula de ciencia: Robot Mini ERP', 159.95, 1),
(2, 'Carbón', 0.00, 2),
(3, 'Cochecito Classic', 99.95, 3),
(4, 'Consola PS4 1 TB', 349.90, 1),
(5, 'Lego Villa familiar modular', 64.99, 3),
(6, 'Magia Borrás Clásica 150 trucos con luz', 32.95, 2),
(7, 'Meccano Excavadora construcción', 30.99, 3),
(8, 'Nenuco hace pompas', 29.95, 1),
(9, 'Peluche delfín rosa', 34.00, 2),
(10, 'Pequeordenador', 22.95, 1),
(11, 'Robot Coji', 69.95, 1),
(12, 'Telescopio astronómico terrestre', 72.00, 2),
(13, 'Twister', 17.95, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reyes`
--

CREATE TABLE `reyes` (
  `idRey` int(11) NOT NULL,
  `nombreRey` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `reyes`
--

INSERT INTO `reyes` (`idRey`, `nombreRey`) VALUES
(1, 'Melchor'),
(2, 'Gaspar'),
(3, 'Baltasar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ninos`
--
ALTER TABLE `ninos`
  ADD PRIMARY KEY (`idNino`);

--
-- Indices de la tabla `ninos_juguetes`
--
ALTER TABLE `ninos_juguetes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regalos_ninos` (`idNinoFK`),
  ADD KEY `regalos_juguetes` (`idJugueteFK`);

--
-- Indices de la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD PRIMARY KEY (`idJuguete`),
  ADD KEY `juguetes_reyes` (`idReyFK`);

--
-- Indices de la tabla `reyes`
--
ALTER TABLE `reyes`
  ADD PRIMARY KEY (`idRey`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ninos`
--
ALTER TABLE `ninos`
  MODIFY `idNino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `ninos_juguetes`
--
ALTER TABLE `ninos_juguetes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `regalos`
--
ALTER TABLE `regalos`
  MODIFY `idJuguete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reyes`
--
ALTER TABLE `reyes`
  MODIFY `idRey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ninos_juguetes`
--
ALTER TABLE `ninos_juguetes`
  ADD CONSTRAINT `regalos_juguetes` FOREIGN KEY (`idJugueteFK`) REFERENCES `regalos` (`idJuguete`),
  ADD CONSTRAINT `regalos_ninos` FOREIGN KEY (`idNinoFK`) REFERENCES `ninos` (`idNino`);

--
-- Filtros para la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD CONSTRAINT `juguetes_reyes` FOREIGN KEY (`idReyFK`) REFERENCES `reyes` (`idRey`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
