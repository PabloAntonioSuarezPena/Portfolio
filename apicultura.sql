-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2023 a las 12:15:19
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `apicultura`
--

DROP Database IF EXISTS apicultura;
create database apicultura;
use apicultura;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apicultor`
--

CREATE TABLE `apicultor` (
  `idApicultor` int(11) NOT NULL,
  `DNI/NIF` varchar(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `foto` varchar(256) NOT NULL,
  `hash` varchar(256) NOT NULL,
  `correo` varchar(256) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apicultor`
--

INSERT INTO `apicultor` (`idApicultor`, `DNI/NIF`, `Nombre`, `foto`, `hash`, `correo`, `activo`) VALUES
(1, '00000000X', 'Apicultor1', 'icono.jpg', '$2y$10$pl1ykN5hOO1zJUwNAsV6seT4oVXUhUoJPwgexGdtliB/Xs85d1JIW', 'apicultor1@apicultura.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arrendador`
--

CREATE TABLE `arrendador` (
  `idArrendador` int(11) NOT NULL,
  `DNI/NIF` varchar(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `foto` varchar(256) NOT NULL,
  `hash` varchar(256) NOT NULL,
  `correo` varchar(256) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `arrendador`
--

INSERT INTO `arrendador` (`idArrendador`, `DNI/NIF`, `Nombre`, `foto`, `hash`, `correo`, `activo`) VALUES
(1, '00000000X', 'Arrendador1', 'icono.jpg', '$2y$10$pl1ykN5hOO1zJUwNAsV6seT4oVXUhUoJPwgexGdtliB/Xs85d1JIW', 'arrendador1@apicultura.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campaña`
--

CREATE TABLE `campaña` (
  `idCampaña` int(11) NOT NULL,
  `Año` date NOT NULL,
  `produccion_total` decimal(50,0) NOT NULL,
  `idApicultor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colmena`
--

CREATE TABLE `colmena` (
  `idColmena` int(11) NOT NULL,
  `numAbejas` int(11) NOT NULL,
  `idApicultor` int(11) NOT NULL,
  `idTerreno` int(11) DEFAULT NULL,
  `ultima_extraccion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colmena`
--

INSERT INTO `colmena` (`idColmena`, `numAbejas`, `idApicultor`, `idTerreno`, `ultima_extraccion`) VALUES
(1, 1500, 1, 1, '2023-05-10'),
(2, 1500, 1, 11, '2023-05-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `idProduccion` int(11) NOT NULL,
  `idColmena` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `kg` decimal(50,0) NOT NULL,
  `tipo_terreno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `produccion`
--

INSERT INTO `produccion` (`idProduccion`, `idColmena`, `fecha`, `kg`, `tipo_terreno`) VALUES
(1, 1, '2023-05-10', '22', 1),
(2, 2, '2023-05-12', '355', 2);

--
-- Disparadores `produccion`
--
DELIMITER $$
CREATE TRIGGER `ActFecExt` AFTER INSERT ON `produccion` FOR EACH ROW UPDATE colmena SET ultima_extraccion = NEW.fecha
WHERE colmena.idColmena = NEW.idColmena
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terreno`
--

CREATE TABLE `terreno` (
  `idTerreno` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `superficie` decimal(50,0) NOT NULL,
  `referencia_catastro` varchar(256) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `tipo_terreno` int(11) NOT NULL,
  `idArrendador` int(11) NOT NULL,
  `idApicultor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `terreno`
--

INSERT INTO `terreno` (`idTerreno`, `nombre`, `superficie`, `referencia_catastro`, `estado`, `tipo_terreno`, `idArrendador`, `idApicultor`) VALUES
(1, 'La Soleada', '150', '37010A004003760000TG', 1, 1, 1, 1),
(3, 'El Campito', '500', '37010A004003760000TG', 0, 1, 1, NULL),
(4, 'Pablo Antonio', '123', '123213SADAA1', 0, 1, 1, NULL),
(8, 'El Dolor', '2345', '213', 0, 1, 1, NULL),
(9, 'El Dolor', '2345', '213', 0, 1, 1, NULL),
(11, 'Las Retamas', '10', 'ALFA12312RR', 0, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoterrenos`
--

CREATE TABLE `tipoterrenos` (
  `tipo_terreno` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipoterrenos`
--

INSERT INTO `tipoterrenos` (`tipo_terreno`, `nombre`, `descripcion`) VALUES
(1, 'Pradera', 'Vegetación predominantemente herbácea con una fracción de cabida cubierta inferior al 20%'),
(2, 'Robledal', 'Masa arbolada en la que la especie predominante es alguna una mezcla de varias de las especies conocidas comúnmente como \"Roble\", siendo la más característica el Quercus pyrenaica');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apicultor`
--
ALTER TABLE `apicultor`
  ADD PRIMARY KEY (`idApicultor`);

--
-- Indices de la tabla `arrendador`
--
ALTER TABLE `arrendador`
  ADD PRIMARY KEY (`idArrendador`);

--
-- Indices de la tabla `campaña`
--
ALTER TABLE `campaña`
  ADD PRIMARY KEY (`idCampaña`),
  ADD KEY `fk_campanha_apicultor` (`idApicultor`);

--
-- Indices de la tabla `colmena`
--
ALTER TABLE `colmena`
  ADD PRIMARY KEY (`idColmena`),
  ADD KEY `fk_colmena_apicultor` (`idApicultor`),
  ADD KEY `fk_colmena_terreno` (`idTerreno`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`idProduccion`),
  ADD KEY `fk_produccion_colmena` (`idColmena`),
  ADD KEY `fk_produccion_tipoTerreno` (`tipo_terreno`);

--
-- Indices de la tabla `terreno`
--
ALTER TABLE `terreno`
  ADD PRIMARY KEY (`idTerreno`),
  ADD KEY `fk_terreno_apicultor` (`idApicultor`),
  ADD KEY `fk_terreno_arrendador` (`idArrendador`),
  ADD KEY `fk_terreno_tipoTerrenos` (`tipo_terreno`);

--
-- Indices de la tabla `tipoterrenos`
--
ALTER TABLE `tipoterrenos`
  ADD PRIMARY KEY (`tipo_terreno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apicultor`
--
ALTER TABLE `apicultor`
  MODIFY `idApicultor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `campaña`
--
ALTER TABLE `campaña`
  MODIFY `idCampaña` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colmena`
--
ALTER TABLE `colmena`
  MODIFY `idColmena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `idProduccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `terreno`
--
ALTER TABLE `terreno`
  MODIFY `idTerreno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipoterrenos`
--
ALTER TABLE `tipoterrenos`
  MODIFY `tipo_terreno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `campaña`
--
ALTER TABLE `campaña`
  ADD CONSTRAINT `fk_campanha_apicultor` FOREIGN KEY (`idApicultor`) REFERENCES `apicultor` (`idApicultor`);

--
-- Filtros para la tabla `colmena`
--
ALTER TABLE `colmena`
  ADD CONSTRAINT `fk_colmena_apicultor` FOREIGN KEY (`idApicultor`) REFERENCES `apicultor` (`idApicultor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_colmena_terreno` FOREIGN KEY (`idTerreno`) REFERENCES `terreno` (`idTerreno`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD CONSTRAINT `fk_produccion_colmena` FOREIGN KEY (`idColmena`) REFERENCES `colmena` (`idColmena`),
  ADD CONSTRAINT `fk_produccion_tipoTerreno` FOREIGN KEY (`tipo_terreno`) REFERENCES `tipoterrenos` (`tipo_terreno`);

--
-- Filtros para la tabla `terreno`
--
ALTER TABLE `terreno`
  ADD CONSTRAINT `fk_terreno_apicultor` FOREIGN KEY (`idApicultor`) REFERENCES `apicultor` (`idApicultor`),
  ADD CONSTRAINT `fk_terreno_arrendador` FOREIGN KEY (`idArrendador`) REFERENCES `arrendador` (`idArrendador`),
  ADD CONSTRAINT `fk_terreno_tipoTerrenos` FOREIGN KEY (`tipo_terreno`) REFERENCES `tipoterrenos` (`tipo_terreno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
