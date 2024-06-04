-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-06-2024 a las 17:58:38
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jardin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `idCargo` int NOT NULL AUTO_INCREMENT,
  `nombreCargo` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`idCargo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`idCargo`, `nombreCargo`) VALUES
(1, 'directivo'),
(2, 'maestra'),
(3, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `fkSalita` int NOT NULL,
  `imagen` varchar(200) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

DROP TABLE IF EXISTS `informacion`;
CREATE TABLE IF NOT EXISTS `informacion` (
  `fkSalita` int NOT NULL,
  `texto` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `nombreProyecto` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestras`
--

DROP TABLE IF EXISTS `maestras`;
CREATE TABLE IF NOT EXISTS `maestras` (
  `dni` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `edad` int NOT NULL,
  `añosActiva` int NOT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestrasespeciales`
--

DROP TABLE IF EXISTS `maestrasespeciales`;
CREATE TABLE IF NOT EXISTS `maestrasespeciales` (
  `dni` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `edad` int NOT NULL,
  `añosActiva` int NOT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salita`
--

DROP TABLE IF EXISTS `salita`;
CREATE TABLE IF NOT EXISTS `salita` (
  `idSalita` int NOT NULL AUTO_INCREMENT,
  `fkMaestra` int NOT NULL,
  `fkMaestraEspecial` int NOT NULL,
  `color` int NOT NULL,
  PRIMARY KEY (`idSalita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salitacolor`
--

DROP TABLE IF EXISTS `salitacolor`;
CREATE TABLE IF NOT EXISTS `salitacolor` (
  `idColor` int NOT NULL AUTO_INCREMENT,
  `color` int NOT NULL,
  PRIMARY KEY (`idColor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE IF NOT EXISTS `tokens` (
  `token` varchar(128) COLLATE utf8mb3_unicode_ci NOT NULL,
  `dni` int NOT NULL,
  `fecha_creacion` int NOT NULL,
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`token`, `dni`, `fecha_creacion`) VALUES
('664d2e92a24ae', 46736648, 0),
('664d316c27962', 46736648, 0),
('664d329357bbb', 46736648, 0),
('664d3335554b0', 46736648, 0),
('66564d864b035', 46736648, 0),
('665664263829d', 46736648, 0),
('6656657d9ab07', 46736648, 0),
('665f555328616', 46736648, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `dni` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `gmail` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `contraseña` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cargo` int NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`dni`),
  KEY `cargosUsuarios` (`cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `apellido`, `gmail`, `contraseña`, `cargo`, `estado`) VALUES
(12345678, 'juancito', 'holman', 'santiago16200@gmail.com', '$2y$10$nttaThOojEWXkRDLP8nJcef3sWMhjUr7UZpv/kroz5tkV7zEzap9O', 2, 1),
(46736648, 'santiago', 'exposito', 'strixer1605@gmail.com', '$2y$10$KXVC19icikxKI7.fDcphpOkBv8biHdbpP1NsJLtAS4I/ONIKrKjyG', 1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `cargosUsuarios` FOREIGN KEY (`cargo`) REFERENCES `cargos` (`idCargo`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
