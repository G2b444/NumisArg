-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2024 a las 21:10:00
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `numisarg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anomalia`
--

CREATE TABLE `anomalia` (
  `id_anomalia` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `detalle` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coleccion`
--

CREATE TABLE `coleccion` (
  `id_coleccion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coleccion`
--

INSERT INTO `coleccion` (`id_coleccion`, `id_usuario`, `nombre`) VALUES
(26, 14, 'Comoxd'),
(27, 14, 'Otra colección'),
(28, 16, 'xd'),
(32, 14, 'AGUSMONEDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_guarda`
--

CREATE TABLE `detalle_guarda` (
  `id_detalle_guarda` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor_de_mercado` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_guarda`
--

INSERT INTO `detalle_guarda` (`id_detalle_guarda`, `id_estado`, `cantidad`, `valor_de_mercado`) VALUES
(9, 3, 2, 3),
(10, 3, 10, 10),
(11, 6, 12, 12),
(12, 3, 12, 12),
(13, 2, 23, 23),
(14, 7, 23, 23),
(16, 2, 5, 1),
(20, 6, 10000, 18000),
(21, 5, 321, 987);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisa`
--

CREATE TABLE `divisa` (
  `id_divisa` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `divisa`
--

INSERT INTO `divisa` (`id_divisa`, `nombre`) VALUES
(1, 'Pesos'),
(2, 'Reales'),
(3, 'Australes'),
(4, 'Peso fuerte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(14) NOT NULL,
  `descripcion` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`, `descripcion`) VALUES
(2, 'muy bueno', ''),
(3, 'bueno', ''),
(4, 'regular', ''),
(5, 'malo', ''),
(6, 'muy malo', ''),
(7, 'anomalia', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guarda_anomalia`
--

CREATE TABLE `guarda_anomalia` (
  `id_guarda_anomalia` int(11) NOT NULL,
  `id_detalle_guarda` int(11) NOT NULL,
  `id_anomalia` int(11) NOT NULL,
  `id_coleccion` int(11) NOT NULL,
  `fecha_guardado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guarda_moneda`
--

CREATE TABLE `guarda_moneda` (
  `id_guarda_moneda` int(11) NOT NULL,
  `id_detalle_guarda` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `id_coleccion` int(11) NOT NULL,
  `fecha_guardado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `guarda_moneda`
--

INSERT INTO `guarda_moneda` (`id_guarda_moneda`, `id_detalle_guarda`, `id_moneda`, `id_coleccion`, `fecha_guardado`) VALUES
(36, 11, 23, 27, '2024-07-23'),
(40, 19, 23, 26, '2024-08-09'),
(41, 20, 18, 32, '2024-08-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_imagen` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id_imagen`, `direccion`) VALUES
(57, '../../assets/multimedia/img/½-Centavo.jpg'),
(58, '../../assets/multimedia/img/½-Centavo-back.jpg'),
(63, '../../assets/multimedia/img/5-Pesos-1-Argentino.jpg'),
(64, '../../assets/multimedia/img/5-Pesos-1-Argentino-back.jpg'),
(65, '../../assets/multimedia/img/5-Pesos-1-Argentino.jpg'),
(66, '../../assets/multimedia/img/5-Pesos-1-Argentino-back.jpg'),
(69, '../../assets/multimedia/img/5-Centavos.jpg'),
(70, '../../assets/multimedia/img/5-Centavos-back.jpg'),
(71, '../../assets/multimedia/img/10-Centavos.jpg'),
(72, '../../assets/multimedia/img/10-Centavos-back.jpg'),
(73, '../../assets/multimedia/img/20-Centavos.jpg'),
(74, '../../assets/multimedia/img/20-Centavos-back.jpg'),
(75, '../../assets/multimedia/img/50-Centavos.jpg'),
(76, '../../assets/multimedia/img/50-Centavos-back (1).jpg'),
(83, '../../assets/multimedia/img/m1b.jpg'),
(84, '../../assets/multimedia/img/m1a.jpg'),
(85, '../../assets/multimedia/img/m4a.jpg'),
(86, '../../assets/multimedia/img/m4b.jpg'),
(87, '../../assets/multimedia/img/m5a.jpg'),
(88, '../../assets/multimedia/img/M5b.jpg'),
(89, '../../assets/multimedia/img/½-Centavo.jpg'),
(90, '../../assets/multimedia/img/½-Centavo-back.jpg'),
(91, '../../assets/multimedia/img/1-Centavo-Thin.jpg'),
(92, '../../assets/multimedia/img/1-Centavo-Thin-back.jpg'),
(99, '../../assets/multimedia/img/1-Centavo.jpg'),
(100, '../../assets/multimedia/img/1-Centavo-back.jpg'),
(101, '../../assets/multimedia/img/sigma).jpg'),
(102, '../../assets/multimedia/img/sigma2.jpg'),
(103, '../../assets/multimedia/img/sigma3.jpg'),
(104, '../../assets/multimedia/img/sigma4.jpg'),
(105, '../../assets/multimedia/img/sigma5.jpg'),
(106, '../../assets/multimedia/img/sigma6.jpg'),
(107, '../../assets/multimedia/img/sigma7.jpg'),
(108, '../../assets/multimedia/img/sigma8.jpg'),
(109, '../../assets/multimedia/img/sigma9.jpg'),
(110, '../../assets/multimedia/img/SIGMA10.jpg'),
(111, '../../assets/multimedia/img/sigma9.jpg'),
(112, '../../assets/multimedia/img/SIGMA10.jpg'),
(113, '../../assets/multimedia/img/sigma9.jpg'),
(114, '../../assets/multimedia/img/SIGMA10.jpg'),
(115, '../../assets/multimedia/img/sigma9.jpg'),
(116, '../../assets/multimedia/img/SIGMA10.jpg'),
(117, '../../assets/multimedia/img/sigma9.jpg'),
(118, '../../assets/multimedia/img/SIGMA10.jpg'),
(119, '../../assets/multimedia/img/sigmaa.jpg'),
(120, '../../assets/multimedia/img/sigmab.jpg'),
(121, '../../assets/multimedia/img/sigmac.jpg'),
(122, '../../assets/multimedia/img/sigmad.jpg'),
(123, '../../assets/multimedia/img/sigmae.jpg'),
(124, '../../assets/multimedia/img/sigmaf.jpg'),
(125, '../../assets/multimedia/img/sigmag.jpg'),
(126, '../../assets/multimedia/img/sigmah.jpg'),
(127, '../../assets/multimedia/img/sigmai.jpg'),
(128, '../../assets/multimedia/img/sigmaj.jpg'),
(129, '../../assets/multimedia/img/sigmak.jpg'),
(130, '../../assets/multimedia/img/sigmal.jpg'),
(131, '../../assets/multimedia/img/sigmam.jpg'),
(132, '../../assets/multimedia/img/sigman.jpg'),
(133, '../../assets/multimedia/img/sigmañ.jpg'),
(134, '../../assets/multimedia/img/sigmao.jpg'),
(135, '../../assets/multimedia/img/sigmañ.jpg'),
(136, '../../assets/multimedia/img/sigmao.jpg'),
(137, '../../assets/multimedia/img/sigmañ.jpg'),
(138, '../../assets/multimedia/img/sigmao.jpg'),
(139, '../../assets/multimedia/img/sigmap.jpg'),
(140, '../../assets/multimedia/img/sigmaq.jpg'),
(141, '../../assets/multimedia/img/sigmap.jpg'),
(142, '../../assets/multimedia/img/sigmaq.jpg'),
(143, '../../assets/multimedia/img/sigmar.jpg'),
(144, '../../assets/multimedia/img/sigmas.jpg'),
(145, '../../assets/multimedia/img/sigmat.jpg'),
(146, '../../assets/multimedia/img/sigmau.jpg'),
(147, '../../assets/multimedia/img/sigmav.jpg'),
(148, '../../assets/multimedia/img/sigmaw.jpg'),
(149, '../../assets/multimedia/img/qatar2.jpg'),
(150, '../../assets/multimedia/img/qatar1.jpg'),
(151, '../../assets/multimedia/img/qatar4.jpg'),
(152, '../../assets/multimedia/img/qatar3.jpg'),
(153, '../../assets/multimedia/img/a1.jpg'),
(154, '../../assets/multimedia/img/a2.jpg'),
(155, '../../assets/multimedia/img/a3.jpg'),
(156, '../../assets/multimedia/img/a4.jpg'),
(157, '../../assets/multimedia/img/a5.jpg'),
(158, '../../assets/multimedia/img/a6.jpg'),
(159, '../../assets/multimedia/img/a7.jpg'),
(160, '../../assets/multimedia/img/a8.jpg'),
(161, '../../assets/multimedia/img/a9.jpg'),
(162, '../../assets/multimedia/img/a10.jpg'),
(163, '../../assets/multimedia/img/a11.jpg'),
(164, '../../assets/multimedia/img/a12.jpg'),
(165, '../../assets/multimedia/img/a13.jpg'),
(166, '../../assets/multimedia/img/a14.jpg'),
(167, '../../assets/multimedia/img/a15.jpg'),
(168, '../../assets/multimedia/img/a16.jpg'),
(169, '../../assets/multimedia/img/a17.jpg'),
(170, '../../assets/multimedia/img/a18.jpg'),
(171, '../../assets/multimedia/img/a19.jpg'),
(172, '../../assets/multimedia/img/a20.jpg'),
(173, '../../assets/multimedia/img/A21.jpg'),
(174, '../../assets/multimedia/img/A22.jpg'),
(175, '../../assets/multimedia/img/a23.jpg'),
(176, '../../assets/multimedia/img/a24.jpg'),
(177, '../../assets/multimedia/img/a25.jpg'),
(178, '../../assets/multimedia/img/a26.jpg'),
(179, '../../assets/multimedia/img/a27.jpg'),
(180, '../../assets/multimedia/img/a28.jpg'),
(181, '../../assets/multimedia/img/a30.jpg'),
(182, '../../assets/multimedia/img/a31.jpg'),
(183, '../../assets/multimedia/img/a32.jpg'),
(184, '../../assets/multimedia/img/a33.jpg'),
(185, '../../assets/multimedia/img/a34.jpg'),
(186, '../../assets/multimedia/img/a35.jpg'),
(187, '../../assets/multimedia/img/a36.jpg'),
(188, '../../assets/multimedia/img/a37.jpg'),
(189, '../../assets/multimedia/img/a38.jpg'),
(190, '../../assets/multimedia/img/a39.jpg'),
(191, '../../assets/multimedia/img/a40.jpg'),
(192, '../../assets/multimedia/img/a41.jpg'),
(193, '../../assets/multimedia/img/a42}.jpg'),
(194, '../../assets/multimedia/img/a43.jpg'),
(195, '../../assets/multimedia/img/a44.jpg'),
(196, '../../assets/multimedia/img/a45.jpg'),
(197, '../../assets/multimedia/img/a46.jpg'),
(198, '../../assets/multimedia/img/a47.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lado`
--

CREATE TABLE `lado` (
  `id_lado` int(11) NOT NULL,
  `id_anomalia` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `lado` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `id_moneda` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`id_moneda`, `nombre`) VALUES
(2, '10 Centavos'),
(5, '½ Real Provincias de'),
(6, 'asdsad'),
(8, '10 Centavos'),
(9, '10 Centavos'),
(17, '½ Centavo'),
(18, '½ Centavo'),
(20, ' 5 Pesos (1 Argentin'),
(21, ' 5 Pesos (1 Argentin'),
(23, '5 Centavos'),
(24, '10 Centavos'),
(28, '1 Centavo Fuertes'),
(29, '1 Peso'),
(30, '1 Centavo'),
(31, 'Medio Centavo argent'),
(32, '1 Centavo (Thin)'),
(36, '1 centavo (1983~1985'),
(37, '1 centavo (1983~1985'),
(38, '5 Centavos ( 1985~19'),
(39, '10 centavos ( 1985~1'),
(40, '50 centavos (1985~19'),
(41, '20 centavos ( 1896~1'),
(42, '20 centavos ( 1896~1'),
(43, '20 centavos ( 1896~1'),
(44, '20 centavos ( 1896~1'),
(45, '20 centavos ( 1896~1'),
(46, '5 centavos (1992~Hoy'),
(47, '10 centavos (1992~Ho'),
(48, '25 centavos (1992~Ho'),
(49, '25 centavos (1992~Ho'),
(50, '50 centavos (50 Cent'),
(51, '5 centavos (magnétic'),
(52, '10 centavos (magneti'),
(53, ' 5 Pesos (Human Righ'),
(54, ' 5 Pesos (Human Righ'),
(55, ' 5 Pesos (Human Righ'),
(56, '2 Pesos (Human Right'),
(57, '2 Pesos (Human Right'),
(58, '1 Peso (Jacaranda)'),
(59, '10 Pesos (Calden Tre'),
(60, '2 Pesos (75th Annive'),
(61, '5 Pesos (FIFA World '),
(62, '10 Pesos (FIFA World'),
(63, '2 Pesos (200th Anniv'),
(64, '2 pesos (1992~Hoy - '),
(65, '5 Pesos (El Payador)'),
(66, ' 5 Pesos (Tango)'),
(67, '50 Centavos (Pattern'),
(68, '25 Centavos (Pattern'),
(69, '5 Centavos (Fine Let'),
(70, '1 Centavo ( 1992~Hoy'),
(71, '25 Centavos (CuNi - '),
(72, '25 Centavos (bold cu'),
(73, '1 Centavo (Round)'),
(74, '5 Pesos ( 1983~1985 '),
(75, '10 pesos ( 1983~1985'),
(76, '50 Pesos (50º Annive'),
(77, '50ctvs(Aniversario 1'),
(78, '50Ctvs(150th Death G'),
(79, '5 Pesos 180th Death '),
(80, '5 Pesos 150th Death '),
(81, '10 pesos ( 1970~1983'),
(82, '50 Pesos 200th Anniv'),
(83, '100 Pesos 200th Anni'),
(84, '5 pesos ( 1957~1969 '),
(85, '50Cs( 1957~1969 - Mo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda_atributo`
--

CREATE TABLE `moneda_atributo` (
  `id_moneda_atributo` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `id_divisa` int(11) NOT NULL,
  `id_valor_nominal` int(11) NOT NULL,
  `id_tipo_canto` int(11) NOT NULL,
  `id_tipo_moneda` int(11) NOT NULL,
  `composicion` varchar(100) NOT NULL,
  `diametro` float NOT NULL,
  `espesor` float NOT NULL,
  `historia` longtext NOT NULL,
  `inicio_emision` date NOT NULL,
  `fin_emision` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `moneda_atributo`
--

INSERT INTO `moneda_atributo` (`id_moneda_atributo`, `id_moneda`, `id_divisa`, `id_valor_nominal`, `id_tipo_canto`, `id_tipo_moneda`, `composicion`, `diametro`, `espesor`, `historia`, `inicio_emision`, `fin_emision`) VALUES
(19, 21, 1, 8, 10, 1, 'Cobre', 1, 1, 'Sin especificar...', '1876-01-01', '1876-01-01'),
(21, 23, 1, 8, 1, 2, ' interior: 90,8% acero, 1,2% carbono, baño: 6% cobre, 2% níquel', 17, 1, 'Sin especificar...', '1975-01-01', '1959-01-01'),
(22, 24, 1, 9, 1, 2, 'Interior: 90,8% acero, 1,2% carbono, enchapado: 8% níquel', 20, 2, 'Sin especificar...', '1957-01-01', '1959-01-01'),
(23, 25, 1, 10, 1, 2, ' Interior: 90,8% acero, 1,2% carbono, enchapado: 8% níquel', 21, 2, 'Sin especeficar...', '1957-01-01', '1961-01-01'),
(24, 26, 1, 11, 1, 2, ' Interior: 90,8% acero, 1,2% carbono, enchapado: 8% níquel', 21, 2, 'Sin especificar', '1957-01-01', '1961-01-01'),
(26, 28, 4, 1, 1, 1, 'Cobre', 23.5, 1.5, 'El Patrón de 1 Centavo Fuertes de 1880 es parte de una serie de ensayos realizados en Argentina para definir el diseño y composición de nuevas monedas durante el proceso de modernización de su sistema monetario. Si bien estas monedas nunca circularon oficialmente, son muy valoradas por los coleccionistas debido a su rareza y su papel en la historia monetaria argentina.', '1880-01-01', '0000-00-00'),
(27, 29, 1, 6, 1, 2, '90,8% acero, 1,2% carbono, enchapado: 8% níquel', 25, 1, 'La moneda de 1 peso emitida entre 1957 y 1962 se enmarca en un período de transición económica y política en Argentina. En 1957, Argentina enfrentaba desafíos económicos y un alto nivel de inflación. La necesidad de reformas monetarias llevó a la emisión de nuevas monedas y billetes para estabilizar la economía.', '1957-01-01', '1962-01-01'),
(28, 30, 1, 1, 1, 2, '100% Cobre', 16, 1, 'La moneda de 1 centavo argentino fue emitida durante la posguerra, en un período de ajuste y recuperación económica para Argentina. Forma parte de la segunda serie de circulación de la Moneda Nacional.', '1945-01-01', '1948-01-01'),
(29, 31, 3, 1, 1, 2, ' 60%-70% Cobre, 40%-30% Zinc', 19.6, 1.8, 'La moneda de ½ centavo fue emitida en 1985 como parte de la serie Austral, que reemplazó al peso argentino como parte de una reforma monetaria destinada a controlar la inflación y estabilizar la economía. La serie Austral fue introducida durante el gobierno de Raúl Alfonsín, y se utilizó hasta que el Austral fue reemplazado por el peso argentino en 1992.', '1985-01-01', '1985-01-01'),
(30, 32, 3, 1, 1, 2, ' 60%-70% Cobre, 40%-30% Zinc', 20.56, 1.6, 'La moneda de 1 centavo fue emitida entre 1986 y 1987 como parte de la serie Austral, que fue introducida en 1985 para reemplazar al peso argentino en un esfuerzo por controlar la inflación y estabilizar la economía.', '1986-01-01', '1987-01-01'),
(34, 36, 1, 1, 1, 2, '70% aluminio, 30% magnesio', 15.62, 1.5, 'La moneda de 1 centavo fue emitida bajo la serie Peso Ley 18.188, que reemplazó al peso argentino en un esfuerzo por estabilizar la economía de Argentina en la década de 1970.', '1983-01-01', '1983-01-01'),
(35, 37, 1, 1, 1, 2, '70% aluminio, 30% magnesio', 15.62, 1.5, 'La moneda de 1 centavo fue emitida bajo la serie Peso Ley 18.188, que reemplazó al peso argentino en un esfuerzo por estabilizar la economía de Argentina en la década de 1970.', '1983-01-01', '1983-01-01'),
(36, 38, 3, 2, 1, 2, '60%-70% Cobre, 40%-30% Zinc', 23, 1.8, 'Esta moneda fue emitida como parte de la serie Austral, que se introdujo en 1985 para reemplazar al peso argentino y controlar la inflación. La serie Austral formó parte de una reforma monetaria durante el gobierno de Raúl Alfonsín, en un intento de estabilizar la economía y reestructurar el sistema monetario nacional.', '1985-01-01', '1986-01-01'),
(37, 39, 3, 3, 1, 2, '60%-70% Cobre, 40%-30% Zinc', 21.5, 1.7, ' Emitida entre 1985 y 1988, la moneda tuvo una circulación estándar durante esos años. Con una acuñación conocida de 540.028.129 ejemplares', '1985-01-01', '1988-01-01'),
(38, 40, 3, 5, 1, 2, ' 92% Cu 8% Al', 24.5, 1.9, 'Emitida entre 1985 y 1988, la moneda tuvo una circulación estándar durante esos años, con una acuñación conocida de 199.371.042 ejemplares.', '1985-01-01', '1988-01-01'),
(39, 45, 1, 4, 10, 2, '75% cobre, 25% níquel', 21, 1.3, 'Emitida por la Casa de la Moneda de la República Argentina en Buenos Aires, tuvo una acuñación conocida de 116.503.000 ejemplares. ', '1896-01-01', '1942-01-01'),
(40, 46, 1, 2, 10, 2, ' 75% cobre, 25% níquel', 17.2, 1.3, 'La moneda de 5 centavos fue parte de la serie del peso argentino emitida entre 1992 y 2001. Fue acuñada por la South African Mint Company en cobre-níquel, con un diseño que incluye el Sol de Mayo en el reverso, símbolo nacional de Argentina. Esta serie fue parte del proceso de estabilización económica de Argentina en la década de 1990, conocida como el Plan de Convertibilidad, que introdujo el peso convertible y reemplazó el austral.', '1993-01-01', '1995-01-01'),
(41, 47, 1, 3, 10, 2, '92% cobre, 8% aluminio', 18.3, 1.4, 'La moneda de 10 centavos fue parte de la serie del peso argentino que se introdujo en 1992, después de la reforma monetaria que reemplazó al austral. Esta serie fue acuñada por diversas casas de moneda en varios países, incluyendo la Casa de la Moneda de Argentina. La moneda de 10 centavos fue utilizada en la circulación diaria hasta que el peso convertible fue reemplazado por el peso argentino en 2002.', '1992-01-01', '2006-01-01'),
(42, 48, 1, 4, 10, 2, '75% cobre, 25% níquel', 24.3, 1.8, 'La moneda de 25 centavos presenta el Cabildo de Buenos Aires en su reverso, un edificio histórico que desempeñó un papel importante durante el período colonial y que ahora es un museo. Este diseño refleja la importancia histórica y cultural del Cabildo y celebra el patrimonio arquitectónico de Argentina. La moneda estuvo en circulación estándar hasta la sustitución del peso convertible en 2002.', '1993-01-01', '1996-01-01'),
(43, 49, 1, 4, 10, 2, '75% cobre, 25% níquel', 24.2, 1.8, 'El Cabildo, originalmente una casa de gobierno del Virreinato del Río de la Plata, ahora funciona como un museo, y su representación en la moneda refleja la importancia del patrimonio arquitectónico del país. La moneda estuvo en circulación estándar hasta la introducción del peso argentino en 2002.', '1993-01-01', '1994-01-01'),
(44, 50, 1, 5, 10, 2, ' 92% cobre, 8% aluminio', 25.2, 1.8, 'La moneda de 50 centavos fue emitida como parte de la serie del peso argentino que reemplazó al austral en 1992. El anverso de la moneda muestra el valor facial en números grandes, mientras que el reverso presenta la Casa de Tucumán, un edificio histórico crucial en la historia de Argentina como lugar donde se proclamó la independencia del país en 1816.', '1992-01-01', '2010-01-01'),
(45, 51, 1, 2, 1, 2, '90,8% hierro, 1,2% carbono, enchapado: 6,4%-7,2% cobre, 3,2%-2,4% zinc', 17.2, 1.3, 'La moneda de 5 centavos fue emitida en 2006, dentro de una serie que continuó después de la introducción inicial del Peso argentino. Esta serie se mantuvo hasta el año 2011, cuando el país cambió su enfoque monetario.', '2006-01-01', '2011-01-01'),
(46, 52, 1, 3, 1, 2, '90,8% hierro, 1,2% carbono, enchapado: 6,4%-7,2% cobre, 3,2%-2,4% zinc', 18.2, 1.4, 'La emisión de esta moneda continuó hasta 2011, cuando se empezó a retirar gradualmente del mercado a favor de monedas de mayor denominación y nuevos billetes. La inflación y los cambios en la economía argentina llevaron a la sustitución de monedas de baja denominación por otras con mayor valor nominal.', '2006-01-01', '2011-01-01'),
(47, 55, 1, 8, 10, 3, '900/1000 oro .xxx oz. AGW, 100/1000 cobre', 22, 2, 'En 2006, Argentina emitió una medalla de oro de 5 pesos para conmemorar el Día de los Derechos Humanos y recordar la importancia de la memoria, la verdad y la justicia en el contexto de los derechos humanos. Este evento es significativo en la historia argentina debido a la lucha por la justicia durante y después de la dictadura militar (1976-1983).', '2006-01-01', '2006-01-01'),
(48, 57, 1, 7, 10, 3, '75% cobre, 25% níquel', 30, 2, 'Emitida en 2006 por la Casa de la Moneda de la República Argentina, esta moneda de 2 pesos celebra los Derechos Humanos en el contexto de la memoria y justicia por las víctimas de la dictadura militar (1976-1983). Aunque la emisión es de 2006, las monedas fueron acuñadas en 2009. El diseño presenta un pañuelo anudado, símbolo de resistencia y homenaje a las víctimas. La moneda refleja el compromiso de Argentina con la verdad y la justicia, destacando el lema \"Memoria, Verdad y Justicia\".', '2006-01-01', '2006-01-01'),
(49, 58, 1, 6, 1, 2, 'Acero bañado en cobre', 20, 1.7, 'Emitida entre 2017 y 2020 por la Casa de la Moneda de Argentina, esta moneda de 1 peso presenta el jacarandá, un árbol emblemático de Argentina. El anverso muestra un jacarandá estilizado junto al valor facial \"1 PESO\", mientras que el reverso destaca el árbol de jacarandá en un diseño inciso. La moneda está hecha de acero chapado en cobre, con un canto liso y un borde elevado sin decoraciones. El lema \"EN UNIÓN Y LIBERTAD\" está presente en el anverso.', '2017-01-01', '2020-01-01'),
(50, 59, 1, 9, 10, 2, 'Acero 85% - Níquel 10% - Cobre 5%', 24.5, 2.6, 'País:\r\nArgentina\r\nSerie:\r\n1992~Hoy - Peso (Convertible Hasta 2001)\r\nCódigo de catálogo:\r\nCódigos Colnect AR-000210\r\nMonedas del Mundo km189\r\nTemas:\r\nCiencia | Frutas y bayas | Hojas | Árboles\r\nFecha emisión:\r\n2018\r\nFecha última emisión:\r\n2020\r\nDistribución:\r\nCirculación Estándar\r\nCasas de moneda (Cecas):\r\nCasa de la Moneda de la República Argentina, Buenos Aires, Argentina\r\nComposición:\r\nNíquel Plata\r\nCanto:\r\nEstriado/Rayado\r\nOrientación:\r\nAlineación Moneda ↑O↓\r\nForma:\r\nCircular\r\nBorde:\r\nElevado. No decorado. Ambas caras', '2018-01-01', '2020-01-01'),
(51, 60, 1, 7, 10, 3, '75% cobre, 25% níquel', 30, 2, 'La moneda de 2 Pesos emitida en 2010 celebra el 75º aniversario del Banco Central de la República Argentina, fundado el 31 de mayo de 1935. La moneda destaca el papel fundamental del Banco Central en la economía del país y su evolución a lo largo de los años.', '2010-01-01', '2010-01-01'),
(52, 61, 1, 8, 10, 3, 'plata', 40, 3, 'Moneda diseñada y producida en alegoria al campeonato Mundial ganado pro la selección Argentina en el año 2022', '2021-01-01', '2021-01-01'),
(53, 62, 1, 9, 10, 3, 'oro', 23, 2, 'Moneda diseñada y producida en alegoria al campeonato Mundial ganado pro la selección Argentina en el año 2022', '2021-01-01', '2021-01-01'),
(54, 63, 1, 7, 10, 3, 'anillo: Cobre 92%, aluminio 6%, niquel 2% Nucleo: cobre 75% niquel 25%', 24.5, 2.2, 'Porque cumplio 200 años la independencia capo', '2016-01-01', '2016-01-01'),
(55, 64, 1, 7, 10, 2, 'anillo: Cobre 92%, aluminio 6%, niquel 2% Nucleo: cobre 75% niquel 25%', 24.5, 2.2, '2 pesos común', '2010-01-01', '2016-01-01'),
(56, 65, 1, 8, 10, 3, '90% plata, 10% cobre', 33, 2.8, 'Hombre sentado con guitarra en un paisaje con árbol a la izquierda, nubes y pájaros. Incluye la leyenda \"EL PAYADOR\".\r\n Escudo de armas (1813, modificado en 1944). Incluye el nombre del país “REPÚBLICA ARGENTINA” y el año 2014.', '2014-01-01', '2014-01-01'),
(57, 66, 1, 8, 10, 3, '92.5% plata, 7.5% cobre', 33, 2.8, 'Emitida en 2013, la moneda es parte de una serie conmemorativa que celebra aspectos significativos de la cultura argentina, especialmente relacionados con el tango y la herencia nacional.', '2013-01-01', '2013-01-01'),
(58, 67, 1, 5, 1, 2, '92% acero, 8% niquel', 25.17, 1.5, 'Originalmente, se solicitaron 75.000.000 de piezas en bruto a la empresa chilena AMERA de Chile S.A. en una aleación de cruponíquel Cu 75 Ni 25, pero finalmente se fabricaron en acero niquelado Fe 92 Ni 8. La mala calidad de las monedas hizo que no se acuñaran todas las monedas previstas y que nunca se emitieran para su circulación.\r\nAños más tarde el BCRA ordenó la destrucción de las piezas en una máquina dentada, pero algunas monedas sobrevivieron a la destrucción.', '2013-01-01', '2013-01-01'),
(59, 68, 1, 4, 1, 1, '92% acero, 8% niquel', 19.5, 1.5, 'Originalmente, se solicitaron 125.000.000 de piezas en bruto a la empresa chilena AMERA de Chile S.A. en una aleación de cruponíquel Cu 75 Ni 25, pero finalmente se fabricaron en acero niquelado Fe 92 Ni 8. La mala calidad de las monedas hizo que no se acuñaran todas las monedas previstas y que nunca se emitieran para su circulación.\r\nAños más tarde el BCRA ordenó la destrucción de las piezas en una máquina dentada, pero algunas monedas sobrevivieron a la destrucción.', '2013-01-01', '2013-01-01'),
(60, 69, 1, 2, 10, 2, '75% cobre, 25% níquel', 17.2, 1.3, 'Esta moneda forma parte del periodo de estabilización económica de Argentina, cuando el peso convertible se introdujo para controlar la inflación. Emitida solo en 1993, fue acuñada por la Birmingham Mint en Gran Bretaña, con una tirada de 245,500,000 piezas.', '1993-01-01', '1993-01-01'),
(61, 70, 1, 1, 10, 2, ' 97% cobre, 2.5% zinc, 0.5% estaño', 16.2, 1.3, 'Fue lanzada como parte del esfuerzo de estabilización monetaria durante la década de 1990 en Argentina. Emitida por la Casa de la Moneda de Brasil y la Casa de la Moneda de Argentina, con una acuñación de 255.100.000 piezas.', '1993-01-01', '2000-01-01'),
(62, 71, 1, 4, 10, 2, '75% cobre, 25% níquel', 24.3, 1.8, 'La moneda de 25 centavos de Argentina, emitida entre 1993 y 1996, es parte de la serie del Peso Convertible (hasta 2001). Esta moneda conmemorativa fue acuñada en varias casas de moneda, incluyendo la de Birmingham (Reino Unido), la Korea Minting and Security Printing Corporation (KOMSCO) en Corea del Sur y la South African Mint en Sudáfrica.', '1993-01-01', '1996-01-01'),
(63, 72, 1, 4, 10, 2, ' 92% cobre 8% aluminio', 24.3, 1.8, 'La moneda de 25 centavos de Argentina, emitida entre 1993 y 2010, es parte de la serie del Peso Convertible (hasta 2001). Se acuñó en varias casas de moneda, incluyendo la Casa de Moneda de Chile (Santiago), la Casa de la Moneda de la República Argentina (Buenos Aires), y la South African Mint Company.', '1993-01-01', '2010-01-01'),
(64, 73, 1, 1, 10, 2, '92% acero, 8% niquel', 16.2, 1.3, 'La moneda de 1 centavo de Argentina, emitida entre 1992 y 1993, es parte de la serie del Peso Convertible. Se acuñó en varias casas de moneda, incluyendo la Casa de Moneda de México, la Royal Canadian Mint (Ottawa), y la South African Mint Company.', '1992-01-01', '1993-01-01'),
(65, 74, 1, 8, 1, 2, '92% cobre, 8% aluminio', 19.5, 1.7, 'La moneda de 5 pesos de Argentina, emitida entre 1984 y 1985, forma parte de la serie del Peso Argentino y está asociada a temas de colonización y edificios gubernamentales. Se acuñaron 25.820.580 monedas, distribuidas para circulación estándar.', '1984-01-01', '1985-01-01'),
(66, 75, 1, 9, 1, 2, '92% cobre, 8% aluminio', 20.6, 1.8, 'La moneda de 10 pesos de Argentina, emitida entre 1984 y 1985, forma parte de la serie del Peso Argentino y está asociada a temas de casas y edificios históricos. Se acuñaron 26.427.060 monedas, distribuidas para circulación estándar.', '1984-01-01', '1985-01-01'),
(67, 76, 1, 11, 1, 2, '92% cobre, 8% aluminio', 23, 1.7, 'La moneda conmemora el 50º aniversario del Banco Central de Argentina, una institución clave en la política monetaria y económica del país. La imagen de La Libertad simboliza los ideales de libertad y independencia.', '1985-01-01', '1985-01-01'),
(68, 77, 1, 5, 1, 3, '92% cobre, 8% aluminio', 25.2, 1.8, 'La moneda conmemora a José de San Martín, un líder fundamental en las guerras de independencia de Argentina, Chile y Perú. Su imagen en la moneda honra su contribución a la libertad y la independencia en Sudamérica.\r\nSe acuñaron 5,000 monedas para productos numismáticos, lo que indica su carácter conmemorativo y coleccionista.', '2000-01-01', '2000-01-01'),
(69, 78, 1, 5, 10, 3, '92% cobre, 8% aluminio', 25.2, 1.8, 'Martín Miguel de Güemes fue un líder crucial en la lucha por la independencia de Argentina. Fue conocido por su rol en la defensa del norte argentino contra las fuerzas realistas y por su habilidad en la guerra de guerrillas.\r\nLa moneda conmemora el 179º aniversario de su muerte y resalta su contribución a la independencia argentina.', '2000-01-01', '2000-01-01'),
(70, 79, 1, 8, 10, 3, '90% oro 10% cobre', 22, 1.8, 'Martín Miguel de Güemes fue un líder clave en la defensa del norte argentino durante la lucha por la independencia. Su figura es altamente respetada en la historia argentina por su valentía y estrategia en la guerra de guerrillas.\r\nLa emisión de esta moneda en oro conmemora el 179º aniversario de su muerte y subraya su importante legado en la historia de Argentina.', '2000-01-01', '2000-01-01'),
(71, 80, 1, 8, 10, 3, '90% plata, 10% cobre', 22, 1.5, 'La moneda conmemora a José de San Martín, uno de los padres de la independencia de Sudamérica. Su influencia y liderazgo fueron determinantes en la liberación de Argentina, Chile y Perú del dominio español.\r\nLa emisión de esta moneda en oro destaca el respeto y la admiración por su papel en la historia argentina.', '2000-01-01', '2000-01-01'),
(72, 81, 1, 9, 10, 2, '92% cobre, 8% aluminio', 25, 2, 'El \"Sol de Mayo\" es un emblema nacional que simboliza la libertad y la independencia. Aparece en el escudo de armas de Argentina y en la bandera nacional.\r\nLa emisión de esta moneda bajo la Ley 18.188 está vinculada a la normativa monetaria de la época, marcando un período de transición en la historia económica de Argentina.', '1976-01-01', '1978-01-01'),
(73, 82, 1, 11, 10, 3, '92% cobre, 8% aluminio', 26, 2.2, 'La moneda conmemora el 200º aniversario del nacimiento del General José de San Martín, una figura clave en la independencia de Argentina y otros países sudamericanos.\r\nEl diseño celebra su legado y la contribución a la liberación de Sudamérica del dominio colonial.', '1978-01-01', '1978-01-01'),
(74, 83, 1, 12, 10, 3, '92% cobre, 8% aluminio', 27.3, 2, 'La moneda conmemora el bicentenario del nacimiento del General José de San Martín, una figura clave en la independencia de Argentina y otros países sudamericanos.\r\nEl diseño refleja la importancia histórica de San Martín en la liberación de Sudamérica del dominio colonial.\r\n', '1978-01-01', '1979-01-01'),
(75, 84, 1, 8, 1, 2, ' ~ 91% acero, 8% níquel, 1,2% carbono', 21.5, 1.9, 'La Fragata \"Presidente Sarmiento\" fue un buque escuela de la Armada Argentina, utilizado para la formación de cadetes y también para viajes internacionales, simbolizando la importancia del mar en la historia y cultura de Argentina.\r\nEsta moneda destaca tanto por su diseño, que incluye elementos marítimos, como por su forma dodecagonal, que la hace distintiva en la colección de monedas argentinas.', '1961-01-01', '1968-01-01'),
(76, 85, 1, 5, 1, 2, ' Interior: 90,8% acero, 1,2% carbono, enchapado: 8% níquel', 23.2, 1.8, 'La Libertad de Oudiné es una representación clásica de la libertad, muy utilizada en la iconografía numismática de varios países. La estrella en el reverso enfatiza el tema de libertad y el valor nacional.\r\nEsta moneda, con su diseño simbólico y su composición en acero revestido de níquel, forma parte de una serie con características distintivas, reflejando el contexto histórico y cultural de Argentina durante ese período.', '1957-01-01', '1961-01-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partes`
--

CREATE TABLE `partes` (
  `id_partes` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `id_moneda_atributo` int(11) NOT NULL,
  `lado` varchar(7) NOT NULL,
  `listel` varchar(100) DEFAULT NULL,
  `efigie` varchar(100) DEFAULT NULL,
  `leyenda` varchar(100) DEFAULT NULL,
  `exergo` varchar(100) DEFAULT NULL,
  `ley` varchar(100) DEFAULT NULL,
  `grafilia` varchar(100) DEFAULT NULL,
  `detalles` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partes`
--

INSERT INTO `partes` (`id_partes`, `id_imagen`, `id_moneda_atributo`, `lado`, `listel`, `efigie`, `leyenda`, `exergo`, `ley`, `grafilia`, `detalles`) VALUES
(37, 65, 19, 'anverso', 'Linea entrecortada', 'NO', 'LIBERTAD 9 D FINO', 'UN ARGENTINO', 'NO', 'Linea con relieve', NULL),
(38, 66, 19, 'reverso', 'Linea entrecortada', 'Escudo Nacional Argentino', 'REPUBLICA ARGENTINA', 'NO', '1932', 'Linea con relieve', NULL),
(41, 69, 21, 'anverso', 'Linea entrecortada', '5 / CENTAVOS 2', '2 espigas enfrentadas una haci', '1958', 'No', 'Linea con relieve', NULL),
(42, 70, 21, 'reverso', 'Linea entrecortada', 'Cabeza de La Libertad (a izqui', 'REPUBLICA ARGENTINA ☆ LIBERTAD', 'no', 'No', 'Linea con relieve', NULL),
(43, 71, 22, 'anverso', 'Linea entrecortada', '10 / CENTAVOS', '2 espigas enfrentadas una haci', '1958', '1958', 'Linea con relieve', NULL),
(44, 72, 22, 'reverso', 'Linea entrecortada', 'Cabeza de La Libertad (a izqui', 'REPUBLICA ARGENTINA', 'no', 'No', 'Linea con relieve', NULL),
(45, 73, 23, 'anverso', 'Linea entrecortada', '20 / CENTAVOS', '2 espigas enfrentadas una haci', '1959', '1959', 'Linea con relieve', NULL),
(46, 74, 23, 'reverso', 'Linea entrecortada', 'Cabeza de La Libertad (a izqui', 'REPUBLICA ARGENTINA', 'No', 'No', 'Linea con relieve', NULL),
(47, 75, 24, 'anverso', 'Linea entrecortada', '50 / CENTAVOS', '2 espigas enfrentadas una haci', '1960', '1960', 'Linea con relieve', NULL),
(48, 76, 24, 'reverso', 'Linea entrecortada', 'Cabeza de La Libertad (a izqui', 'REPUBLICA ARGENTINA', 'No', 'No', 'Linea con relieve', NULL),
(51, 83, 26, 'anverso', 'Borde elevado y decorado con puntos alrededor de todo el perímetro', '1', 'REPUBLICA ARGENTINA 1 ✶ UN CENTAVO 1880 ✶', '\"UN CENTAVO 1880\"', ' El valor nominal (1 centavo)', 'Decoración de borde punteado o dentado en todo el perímetro', NULL),
(52, 84, 26, 'reverso', 'Borde elevado y decorado con puntos alrededor de todo el perímetro', 'Escudo de armas de la República Argentina en el centro, con el gorro frigio y los laureles rodeados', 'E', 'E', 'Escudo nacional representativo de la soberanía de la nación', 'Decoración de borde punteado o dentado en todo el perímetro', NULL),
(53, 85, 27, 'anverso', 'perlado', 'No', '1 Peso ', '1962', 'No', 'Punteado', NULL),
(54, 86, 27, 'reverso', 'perlado', 'Cabeza de La Libertad', 'Republica Argentina', 'Libertad', 'No', 'Punteado', NULL),
(55, 87, 28, 'anverso', 'Elevado con un patrón encadenado', 'No', '1 Centavo', 'No', 'No', 'Lineas entrecortadas', NULL),
(56, 88, 28, 'reverso', 'Elevado con un patrón encadenado', 'Escudo de armas', 'Republica Argentina', '1946', 'No', 'Lineas entrecortadas', NULL),
(57, 89, 29, 'anverso', 'Borde elevado liso', 'No', '₳ 1/2 centavo ', '985 (1985)', 'No', 'No', NULL),
(58, 90, 29, 'reverso', 'Borde elevado liso', 'Rufous Hornero', 'Republica Argentina', 'No', 'No', 'No', NULL),
(59, 91, 30, 'anverso', 'Borde elevado liso	', 'No', '₳ 1/2 centavo', '1986', 'No', 'No', NULL),
(60, 92, 30, 'reverso', 'Borde elevado liso	', 'Ñandú común', 'Republica Argentina', 'No', 'No', 'No', NULL),
(67, 99, 34, 'anverso', 'borde elevado con forma de polígono', 'No', '1 centavo', '1972', 'No', 'Punteado', NULL),
(68, 100, 34, 'reverso', 'borde elevado con forma de polígono\n', 'Cabeza de La Libertad con gorro frigio', 'Republica Argentina Libertad', 'No', 'No', 'Punteado', NULL),
(69, 101, 35, 'anverso', 'borde elevado con forma de polígono', 'No', '1 Centavo', '1972', 'No', 'Punteado', NULL),
(70, 102, 35, 'reverso', 'Borde elevado liso', 'Cabeza de La Libertad con gorro frigio', 'Republica Argentina Libertad', 'No', 'No', 'Punteado', NULL),
(71, 103, 36, 'anverso', 'Borde elevado liso', 'No', '₳ 5 centavos', '1985', '-', '-', NULL),
(72, 104, 36, 'reverso', 'Borde elevado liso', 'Puma', 'Republica Argentina', '-', '-', '-', NULL),
(73, 105, 37, 'anverso', 'Borde liso \"arqueado\"', '-', '₳ 10 centavos', '1986', '-', '-', NULL),
(74, 106, 37, 'reverso', 'Borde liso \"arqueado\"', 'Escudo de armas (1814, modificado en 1944)', 'Republica Argentina', '-', '-', '-', NULL),
(75, 107, 38, 'anverso', 'Borde liso \"arqueado\"', '-', '₳ 50 centavos', '985 (1985)', '-', '-', NULL),
(76, 108, 38, 'reverso', 'Borde liso \"arqueado\"', 'Cabeza de La Libertad con gorro frigio', 'Republica Argentina', '-', '-', '-', NULL),
(77, 117, 39, 'anverso', 'Borde pins', '-', '20 centavos', '-', '-', 'Lineas entrecortadas', NULL),
(78, 118, 39, 'reverso', 'Borde escamado', 'Cabeza de La Libertad con gorro frigio', 'Republica Argentina', '1896', '-', 'Lineas entrecortadas', NULL),
(79, 119, 40, 'anverso', 'Elevado con circulo de puntos', '-', '5 centavos', '1994', '-', 'Punteado', NULL),
(80, 120, 40, 'reverso', 'Elevado con circulo de puntos', 'Sol de Mayo', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(81, 121, 41, 'anverso', 'Borde elevado y decorado liso', '-', '10 centavos', '2004', '-', 'Punteado', NULL),
(82, 122, 41, 'reverso', 'Borde elevado liso', 'Escudo de armas (1813, modificado en 1944)', 'Republica Argentina', '-', '-', 'Punteado', NULL),
(83, 123, 42, 'anverso', 'Borde elevado y decorado liso	', '-', '25 centavos', '1993', '-', 'Punteado', NULL),
(84, 124, 42, 'reverso', 'Borde elevado y decorado liso	', 'Cabildo de Buenos Aires (casa de gobierno del Virreinato del Río de la Plata; actualmente es museo.)', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(85, 125, 43, 'anverso', 'Borde elevado liso', '-', '25 centavos', '1994', '-', 'Punteado', NULL),
(86, 126, 43, 'reverso', 'Borde elevado liso', 'edificio del Cabildo de Buenos Aires', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(87, 127, 44, 'anverso', 'Borde elevado y decorado con puntos alrededor de todo el perímetro', '-', '50 centavos', '2009', '-', 'Punteado', NULL),
(88, 128, 44, 'reverso', 'Borde elevado y decorado con puntos alrededor de todo el perímetro', 'Casa de Tucumán (1760, edificio histórico)', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(89, 129, 45, 'anverso', 'Borde elevado y decorado con puntos alrededor de todo el perímetro', '-', '5 centavos', '2009', '-', 'Punteado', NULL),
(90, 130, 45, 'reverso', 'Borde elevado y decorado con puntos alrededor de todo el perímetro', 'Sol de mayo', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(91, 131, 46, 'anverso', 'Borde elevado y decorado con puntos alrededor de todo el perímetro', '-', '10 centavos', '2011', '-', 'Punteado', NULL),
(92, 132, 46, 'reverso', 'Borde elevado y decorado con puntos alrededor de todo el perímetro', 'Escudo de armas (1813, modificado en 1944)', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(93, 137, 47, 'anverso', 'Elevado. No decorado.', '-', 'Republica Argentina - 5 pesos', '2006', '-', '-', NULL),
(94, 138, 47, 'reverso', 'Elevado. No decorado.', 'Pañuelo anudado', 'Derechos Humanos - Memoria, Verdad Y Justicia', '-', '-', '-', NULL),
(95, 141, 48, 'anverso', 'Elevado. No decorado.', '-', 'Republica Argentina - 2 pesos', '2006', '-', '-', NULL),
(96, 142, 48, 'reverso', 'Elevado. No decorado.', 'Pañuelo anudado', 'Derechos Humanos - Memoria, Verdad Y Justicia', '-', '-', '-', NULL),
(97, 143, 49, 'anverso', 'Elevado. No decorado.', '-', '1 Peso - En Union y Libertad', '2017', '-', '-', NULL),
(98, 144, 49, 'reverso', 'Elevado. No decorado.', 'Árbol de Jacarandá', 'Republica Argentina - Jacarandá', '-', '-', '-', NULL),
(99, 145, 50, 'anverso', 'Elevado. No decorado.', '-', 'En Unión y Libertad - 10 Pesos', '2018', '-', '-', NULL),
(100, 146, 50, 'reverso', 'Elevado. No decorado.', 'Árbol de Caldén', 'Republica Argentina - Caldén', '-', '-', '-', NULL),
(101, 147, 51, 'anverso', 'Elevado. No decorado.', 'Cabeza de la Libertad Estilizada', '2 pesos', '2010', '-', '-', NULL),
(102, 148, 51, 'reverso', 'Elevado. No decorado.', 'Entrada al Banco Central', '31•V•1935 - 31•V•2010 - Banco Central de la Republica Argentina', '-', '-', '-', NULL),
(103, 149, 52, 'anverso', 'Elevado. No decorado.', '-', 'Copa Mundial de la FIFA Qatar™ - 5 pesos', '2021', '-', '-', NULL),
(104, 150, 52, 'reverso', 'Elevado. No decorado.', 'Momento del Penal de Gonzalo Montiel', 'Republica Argentina', '-', '-', '-', NULL),
(105, 151, 53, 'anverso', 'Elevado. No decorado.', '-', 'Copa Mundial de la FIFA Qatar™ - 10 pesos', '2021', '-', '-', NULL),
(106, 152, 53, 'reverso', 'Elevado. No decorado.', 'Momento del Penal de Gonzalo Montiel', 'Republica Argentina', '-', '-', '-', NULL),
(107, 153, 54, 'anverso', 'Elevado. No decorado.', '-', 'En Unión y Libertad - 2 Pesos', '2016', '-', '-', NULL),
(108, 154, 54, 'reverso', 'Elevado. No decorado.', 'gorro frigio en poste frente a 6 líneas horizontales detrás de man', 'Republica Argentina', '1816 - Independencia - 2016', '-', '-', NULL),
(109, 155, 55, 'anverso', 'Elevado. No decorado.', '-', '2 pesos', '2011', '-', 'Punteado', NULL),
(110, 156, 55, 'reverso', 'Elevado. No decorado.', 'Sol de mayo', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(111, 157, 56, 'anverso', 'Elevado. No decorado.', 'Payador tocando la guitarra, con árbol de fondo', 'El payador - 5 pesos', '-', '-', '-', NULL),
(112, 158, 56, 'reverso', 'Elevado. No decorado.', ' Escudo de armas (1813, modificado en 1944)', 'República Argentina', '2014', '-', '-', NULL),
(113, 159, 57, 'anverso', 'Elevado. No decorado.', 'Pareja bailando tango sobre un suelo de ladrillos, de fondo un acordeón', 'Tango - 5 pesos', '-', '-', '-', NULL),
(114, 160, 57, 'reverso', 'Elevado. No decorado.', 'Escudo de armas', 'Republica Argentina ', '2013', '-', '-', NULL),
(115, 161, 58, 'anverso', 'Elevado. No decorado.', '-', '50 centavos', '2013', '-', 'Punteado', NULL),
(116, 162, 58, 'reverso', 'Elevado. No decorado.', 'Casa de Tucumán (1760, edificio histórico)', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(117, 163, 59, 'anverso', 'Elevado. No decorado.', '-', '25 centvos', '2013', '-', 'Punteado', NULL),
(118, 164, 59, 'reverso', 'Elevado. No decorado.', 'Edificio de la Municipalidad de Buenos Aires', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(119, 165, 60, 'anverso', ' Elevado. Círculo de puntos.', '-', '5 centavos', '1993', '-', 'Punteado', NULL),
(120, 166, 60, 'reverso', ' Elevado. Círculo de puntos.', 'Sol de mayo', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(121, 167, 61, 'anverso', ' Elevado. Interno 8 ángulos', '-', '1 centavo', '1993', '-', '-', NULL),
(122, 168, 61, 'reverso', ' Elevado. Interno 8 ángulos', 'Corona de Olivos', 'Republica Argentina - En unión y libertad', '-', '-', '-', NULL),
(123, 169, 62, 'anverso', 'Elevado. No decorado.', '-', '25 centavos', '1993', '-', 'Punteado', NULL),
(124, 170, 62, 'reverso', 'Elevado. No decorado.', 'Cabildo de Buenos Aires (casa de gobierno del Virreinato del Río de la Plata; actualmente es museo.)', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(125, 171, 63, 'anverso', ' Elevado. Círculo de puntos.', '-', '25 centavos', '1993', '-', 'Punteado', NULL),
(126, 172, 63, 'reverso', ' Elevado. Círculo de puntos.', 'Cabildo de Buenos Aires (casa de gobierno del Virreinato del Río de la Plata; actualmente es museo.)', 'Republica Argentina - En unión y libertad', '-', '-', 'Punteado', NULL),
(127, 173, 64, 'anverso', ' Elevado. Interno 8 ángulos.', '-', '1 centavo', '1993', '-', '-', NULL),
(128, 174, 64, 'reverso', ' Elevado. Interno 8 ángulos.', 'Corona de Olivos', 'Republica Argentina - En unión y libertad', '-', '-', '-', NULL),
(129, 175, 65, 'anverso', 'Elevado. No decorado.', '-', '5 pesos', '1985', '-', '-', NULL),
(130, 176, 65, 'reverso', 'Elevado. No decorado.', 'Cabildo de Buenos Aires (casa de gobierno del Virreinato del Río de la Plata; actualmente es museo.)', 'Cabildo de Buenos Aires - Republica Argentina', '-', '-', '-', NULL),
(131, 177, 66, 'anverso', 'Elevado. No decorado.', '-', '10 pesos', '1985', '-', '-', NULL),
(132, 178, 66, 'reverso', 'Elevado. No decorado.', 'Casa de Tucumán (1760, edificio histórico)', 'Casa de tucumán - República Argentina', '-', '-', '-', NULL),
(133, 179, 67, 'anverso', 'Elevado. No decorado.', '-', 'Republica Argentina - 50 pesos', '1985', '-', '-', NULL),
(134, 180, 67, 'reverso', 'Elevado. No decorado.', 'Cabeza de La Libertad con gorro frigio rodeada por corona de laureles', 'Cincuentenario del Banco Central - 1983-1985 - B.C.R.A', '-', '-', '-', NULL),
(135, 181, 68, 'anverso', 'Elevado. No decorado.', 'Parte superior de un edificio a la izquierda de IPTA', ' LA PATRIA AL LIBERTADOR - 2000 - 50 Ctvs', '2000', '-', '-', NULL),
(136, 182, 68, 'reverso', 'Elevado. No decorado.', 'Busto estilizado del General José de San Martín', 'Republica Argentina - 1850-2000 - Gral don José de San Martín', '-', '-', '-', NULL),
(137, 183, 69, 'anverso', 'Elevado. No decorado.', '-', '17 de junio de 1821 - 2000 - 50 centavos', '2000', '-', '-', NULL),
(138, 184, 69, 'reverso', 'Elevado. No decorado.', 'Cabeza del General Martin Miguel de Guemes (mirando hacia la derecha)', 'Republica Argentina - Gral. Martin Miguel de Guemes', '-', '-', '-', NULL),
(139, 185, 70, 'anverso', 'Elevado. No decorado.', '-', '17 de junio de 1821 - 2000 - 5 pesos', '2000', '-', '-', NULL),
(140, 186, 70, 'reverso', 'Elevado. No decorado.', 'Cabeza del General Martin Miguel de Guemes (mirando hacia la derecha)', 'Republica Argentina - Gral. Martin Miguel de Güemes', '-', '--', '-', NULL),
(141, 187, 71, 'anverso', 'Elevado. No decorado.', '-', 'la patria al libertador 2000 5 pesos', '2000', '-', '-', NULL),
(142, 188, 71, 'reverso', 'Elevado. No decorado.', 'Busto estilizado del General José de San Martín', 'Republica Argentina - 1850-2000 - Gral don José de San Martín', '-', '-', '-', NULL),
(143, 189, 72, 'anverso', 'Elevado. Punteado de 12 lados', '-', '10 pesos 1978 -  BAˢ', '1978', '-', 'Punteado', NULL),
(144, 190, 72, 'reverso', 'Elevado. Circulo de puntos', 'Sol de mayo', 'Republica Argentina', '-', '-', 'Punteado', NULL),
(145, 191, 73, 'anverso', ' Elevado. Círculo de puntos.', '-', 'Republica Argentina - BAs - 50 pesos', '1978', '-', 'Punteado', NULL),
(146, 192, 73, 'reverso', ' Elevado. Círculo de puntos.', 'Busto del General José de San Martín (izquierda)', 'General Jose de San Martin - 1778-1978', '-', '-', 'Punteado', NULL),
(147, 193, 74, 'anverso', ' Elevado. Círculo de puntos.', '-', 'Republica Argentina - BAs - 50 pesos', '1978', '-', 'Punteado', NULL),
(148, 194, 74, 'reverso', ' Elevado. Círculo de puntos.', 'Busto del General José de San Martín (izquierda)', 'General Jose de San Martin - 1778-1978', '-', '-', 'Punteado', NULL),
(149, 195, 75, 'anverso', ' Elevado. Punteado 12 lados.', '-', '5 pesos', '1966', '-', 'Punteado', NULL),
(150, 196, 75, 'reverso', ' Elevado. Punteado 12 lados.', 'Vista desde la proa, la Fragata \"Presidente Sarmiento\"', 'Republica Argentina', '-', '-', 'Punteado', NULL),
(151, 197, 76, 'anverso', ' Elevado. Círculo de puntos.', '-', '50 CENTAVOS', '1960', '-', 'Punteado', NULL),
(152, 198, 76, 'reverso', ' Elevado. Círculo de puntos.', 'Cabeza de La Libertad con gorro frigio', 'Republica Argentina Libertad', '-', '-', 'Punteado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_canto`
--

CREATE TABLE `tipo_canto` (
  `id_tipo_canto` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_canto`
--

INSERT INTO `tipo_canto` (`id_tipo_canto`, `tipo`) VALUES
(1, 'Liso'),
(2, 'Redondeado'),
(3, 'Serrado'),
(4, 'Epigráfico con leyenda en relieve'),
(5, 'Epigráfico con leyenda grabada'),
(6, 'Estriado con leyenda'),
(7, 'Con patrón en relieve'),
(8, 'Con patrón grabado'),
(9, 'En espiguila'),
(10, 'Estriado'),
(11, 'Estriado oblicuo a la izquierda'),
(12, 'Estriado oblicuo a la derecha'),
(13, 'Estriado interrumpido'),
(14, 'Reticulado'),
(15, 'Estriado personalizado'),
(16, 'Acanalado'),
(17, 'De seguridad'),
(18, 'Estampado a mano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_moneda`
--

CREATE TABLE `tipo_moneda` (
  `id_tipo_moneda` int(11) NOT NULL,
  `tipo_moneda` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_moneda`
--

INSERT INTO `tipo_moneda` (`id_tipo_moneda`, `tipo_moneda`) VALUES
(1, 'Ensayo'),
(2, 'Emision Oficial'),
(3, 'Conmemorativa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `nombre` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `contraseña` varchar(15) NOT NULL,
  `fecha_inicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_tipo_usuario`, `nombre`, `correo`, `contraseña`, `fecha_inicio`) VALUES
(13, 1, 'GFDSDEGSG', 'gabriellxgandgxl@gmail.com', '123', '0000-00-00'),
(14, 2, 'Gania', 'gabriel42172332@gmail.com', '777', '2024-07-13'),
(15, 2, 'ThDaEs', 'thomasesquivel08@gmail.com', '123', '2024-08-02'),
(16, 2, 'pepe', 'kevinkoncerewic@gmail.com', '123', '2024-08-09'),
(17, 2, 'Xd', '21321@gmail.com', '123', '2024-08-09'),
(19, 1, 'GFDSDEGSG', 'fgdgdf@gmail.com', '1223', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_nominal`
--

CREATE TABLE `valor_nominal` (
  `id_valor_nominal` int(11) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valor_nominal`
--

INSERT INTO `valor_nominal` (`id_valor_nominal`, `valor`) VALUES
(1, 0.01),
(2, 0.05),
(3, 0.1),
(4, 0.25),
(5, 0.5),
(6, 1),
(7, 2),
(8, 5),
(9, 10),
(10, 20),
(11, 50),
(12, 100),
(13, 0),
(14, 0.4),
(15, 0.8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anomalia`
--
ALTER TABLE `anomalia`
  ADD PRIMARY KEY (`id_anomalia`),
  ADD KEY `id_moneda` (`id_moneda`);

--
-- Indices de la tabla `coleccion`
--
ALTER TABLE `coleccion`
  ADD PRIMARY KEY (`id_coleccion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_guarda`
--
ALTER TABLE `detalle_guarda`
  ADD PRIMARY KEY (`id_detalle_guarda`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `divisa`
--
ALTER TABLE `divisa`
  ADD PRIMARY KEY (`id_divisa`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `guarda_anomalia`
--
ALTER TABLE `guarda_anomalia`
  ADD PRIMARY KEY (`id_guarda_anomalia`),
  ADD KEY `id_detalle_guarda` (`id_detalle_guarda`,`id_anomalia`,`id_coleccion`),
  ADD KEY `guarda_anomalia_ibfk_2` (`id_anomalia`),
  ADD KEY `id_coleccion` (`id_coleccion`);

--
-- Indices de la tabla `guarda_moneda`
--
ALTER TABLE `guarda_moneda`
  ADD PRIMARY KEY (`id_guarda_moneda`),
  ADD KEY `id_detalle_guarda` (`id_detalle_guarda`,`id_moneda`,`id_coleccion`),
  ADD KEY `id_coleccion` (`id_coleccion`),
  ADD KEY `guarda_moneda_ibfk_3` (`id_moneda`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `lado`
--
ALTER TABLE `lado`
  ADD PRIMARY KEY (`id_lado`),
  ADD KEY `id_anomalia` (`id_anomalia`),
  ADD KEY `id_imagen` (`id_imagen`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`id_moneda`);

--
-- Indices de la tabla `moneda_atributo`
--
ALTER TABLE `moneda_atributo`
  ADD PRIMARY KEY (`id_moneda_atributo`),
  ADD KEY `id_moneda` (`id_moneda`,`id_divisa`,`id_valor_nominal`,`id_tipo_canto`,`id_tipo_moneda`),
  ADD KEY `id_divisa` (`id_divisa`),
  ADD KEY `moneda_atributo_ibfk_2` (`id_valor_nominal`),
  ADD KEY `id_tipo_canto` (`id_tipo_canto`),
  ADD KEY `moneda_atributo_ibfk_5` (`id_tipo_moneda`);

--
-- Indices de la tabla `partes`
--
ALTER TABLE `partes`
  ADD PRIMARY KEY (`id_partes`),
  ADD KEY `id_imagen` (`id_imagen`,`id_moneda_atributo`),
  ADD KEY `id_moneda_atributo` (`id_moneda_atributo`);

--
-- Indices de la tabla `tipo_canto`
--
ALTER TABLE `tipo_canto`
  ADD PRIMARY KEY (`id_tipo_canto`);

--
-- Indices de la tabla `tipo_moneda`
--
ALTER TABLE `tipo_moneda`
  ADD PRIMARY KEY (`id_tipo_moneda`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`);

--
-- Indices de la tabla `valor_nominal`
--
ALTER TABLE `valor_nominal`
  ADD PRIMARY KEY (`id_valor_nominal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anomalia`
--
ALTER TABLE `anomalia`
  MODIFY `id_anomalia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `coleccion`
--
ALTER TABLE `coleccion`
  MODIFY `id_coleccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `detalle_guarda`
--
ALTER TABLE `detalle_guarda`
  MODIFY `id_detalle_guarda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `divisa`
--
ALTER TABLE `divisa`
  MODIFY `id_divisa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `guarda_anomalia`
--
ALTER TABLE `guarda_anomalia`
  MODIFY `id_guarda_anomalia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `guarda_moneda`
--
ALTER TABLE `guarda_moneda`
  MODIFY `id_guarda_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de la tabla `lado`
--
ALTER TABLE `lado`
  MODIFY `id_lado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `moneda_atributo`
--
ALTER TABLE `moneda_atributo`
  MODIFY `id_moneda_atributo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `partes`
--
ALTER TABLE `partes`
  MODIFY `id_partes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT de la tabla `tipo_canto`
--
ALTER TABLE `tipo_canto`
  MODIFY `id_tipo_canto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipo_moneda`
--
ALTER TABLE `tipo_moneda`
  MODIFY `id_tipo_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `valor_nominal`
--
ALTER TABLE `valor_nominal`
  MODIFY `id_valor_nominal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anomalia`
--
ALTER TABLE `anomalia`
  ADD CONSTRAINT `anomalia_ibfk_1` FOREIGN KEY (`id_moneda`) REFERENCES `moneda` (`id_moneda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `coleccion`
--
ALTER TABLE `coleccion`
  ADD CONSTRAINT `coleccion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_guarda`
--
ALTER TABLE `detalle_guarda`
  ADD CONSTRAINT `detalle_guarda_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `guarda_anomalia`
--
ALTER TABLE `guarda_anomalia`
  ADD CONSTRAINT `guarda_anomalia_ibfk_1` FOREIGN KEY (`id_detalle_guarda`) REFERENCES `detalle_guarda` (`id_detalle_guarda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guarda_anomalia_ibfk_2` FOREIGN KEY (`id_anomalia`) REFERENCES `anomalia` (`id_anomalia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guarda_anomalia_ibfk_3` FOREIGN KEY (`id_coleccion`) REFERENCES `coleccion` (`id_coleccion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `guarda_moneda`
--
ALTER TABLE `guarda_moneda`
  ADD CONSTRAINT `guarda_moneda_ibfk_2` FOREIGN KEY (`id_coleccion`) REFERENCES `coleccion` (`id_coleccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guarda_moneda_ibfk_3` FOREIGN KEY (`id_moneda`) REFERENCES `moneda` (`id_moneda`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `lado`
--
ALTER TABLE `lado`
  ADD CONSTRAINT `lado_ibfk_1` FOREIGN KEY (`id_anomalia`) REFERENCES `anomalia` (`id_anomalia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lado_ibfk_2` FOREIGN KEY (`id_imagen`) REFERENCES `imagen` (`id_imagen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `moneda_atributo`
--
ALTER TABLE `moneda_atributo`
  ADD CONSTRAINT `moneda_atributo_ibfk_1` FOREIGN KEY (`id_divisa`) REFERENCES `divisa` (`id_divisa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moneda_atributo_ibfk_2` FOREIGN KEY (`id_valor_nominal`) REFERENCES `valor_nominal` (`id_valor_nominal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moneda_atributo_ibfk_3` FOREIGN KEY (`id_tipo_canto`) REFERENCES `tipo_canto` (`id_tipo_canto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `moneda_atributo_ibfk_4` FOREIGN KEY (`id_tipo_moneda`) REFERENCES `tipo_moneda` (`id_tipo_moneda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moneda_atributo_ibfk_5` FOREIGN KEY (`id_tipo_moneda`) REFERENCES `tipo_moneda` (`id_tipo_moneda`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `partes`
--
ALTER TABLE `partes`
  ADD CONSTRAINT `partes_ibfk_1` FOREIGN KEY (`id_imagen`) REFERENCES `imagen` (`id_imagen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partes_ibfk_2` FOREIGN KEY (`id_moneda_atributo`) REFERENCES `moneda_atributo` (`id_moneda_atributo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
