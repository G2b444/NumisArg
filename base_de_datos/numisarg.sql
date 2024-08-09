-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2024 a las 22:09:07
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
  `nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `divisa`
--

INSERT INTO `divisa` (`id_divisa`, `nombre`) VALUES
(1, 'Pesos'),
(2, 'Reales'),
(3, 'Australes');

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
(59, '../../assets/multimedia/img/½-Centavo.jpg'),
(60, '../../assets/multimedia/img/½-Centavo-back.jpg'),
(63, '../../assets/multimedia/img/5-Pesos-1-Argentino.jpg'),
(64, '../../assets/multimedia/img/5-Pesos-1-Argentino-back.jpg'),
(65, '../../assets/multimedia/img/5-Pesos-1-Argentino.jpg'),
(66, '../../assets/multimedia/img/5-Pesos-1-Argentino-back.jpg'),
(67, '../../assets/multimedia/img/1-Centavo.jpg'),
(68, '../../assets/multimedia/img/1-Centavo-back.jpg'),
(69, '../../assets/multimedia/img/5-Centavos.jpg'),
(70, '../../assets/multimedia/img/5-Centavos-back.jpg'),
(71, '../../assets/multimedia/img/10-Centavos.jpg'),
(72, '../../assets/multimedia/img/10-Centavos-back.jpg'),
(73, '../../assets/multimedia/img/20-Centavos.jpg'),
(74, '../../assets/multimedia/img/20-Centavos-back.jpg'),
(75, '../../assets/multimedia/img/50-Centavos.jpg'),
(76, '../../assets/multimedia/img/50-Centavos-back (1).jpg'),
(81, '../../assets/multimedia/img/diagrama3.png'),
(82, '../../assets/multimedia/img/diagramadeflujo.png');

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
(22, '1 Centavo'),
(23, '5 Centavos'),
(24, '10 Centavos'),
(27, 'iooawsfnjoweq');

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
(17, 18, 3, 2, 1, 2, ' 60%-70% Cobre, 40%-30% Zinc', 20, 2, 'Sin especificar...', '1985-01-01', '1985-01-01'),
(19, 21, 1, 8, 10, 1, 'Cobre', 1, 1, 'Sin especificar...', '1876-01-01', '1876-01-01'),
(20, 22, 1, 1, 10, 2, '100% Cobre', 16, 1, 'Sin especificar...', '1945-01-01', '1948-01-01'),
(21, 23, 1, 8, 1, 2, ' interior: 90,8% acero, 1,2% carbono, baño: 6% cobre, 2% níquel', 17, 1, 'Sin especificar...', '1975-01-01', '1959-01-01'),
(22, 24, 1, 9, 1, 2, 'Interior: 90,8% acero, 1,2% carbono, enchapado: 8% níquel', 20, 2, 'Sin especificar...', '1957-01-01', '1959-01-01'),
(23, 25, 1, 10, 1, 2, ' Interior: 90,8% acero, 1,2% carbono, enchapado: 8% níquel', 21, 2, 'Sin especeficar...', '1957-01-01', '1961-01-01'),
(24, 26, 1, 11, 1, 2, ' Interior: 90,8% acero, 1,2% carbono, enchapado: 8% níquel', 21, 2, 'Sin especificar', '1957-01-01', '1961-01-01'),
(25, 27, 3, 6, 10, 1, 'Oro', 2, 2, 'jhjkhjk', '1816-01-01', '2024-01-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partes`
--

CREATE TABLE `partes` (
  `id_partes` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `id_moneda_atributo` int(11) NOT NULL,
  `lado` varchar(7) NOT NULL,
  `listel` varchar(30) DEFAULT NULL,
  `efigie` varchar(30) DEFAULT NULL,
  `leyenda` varchar(30) DEFAULT NULL,
  `exergo` varchar(30) DEFAULT NULL,
  `ley` varchar(30) DEFAULT NULL,
  `grafilia` varchar(30) DEFAULT NULL,
  `detalles` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partes`
--

INSERT INTO `partes` (`id_partes`, `id_imagen`, `id_moneda_atributo`, `lado`, `listel`, `efigie`, `leyenda`, `exergo`, `ley`, `grafilia`, `detalles`) VALUES
(33, 59, 17, 'anverso', 'Liso', '½ ', 'CENTAVO', '₳', 'no', 'Linea con relieve', NULL),
(34, 60, 17, 'reverso', 'Liso', 'Rufous Hornero (izquierda: nid', 'REPUBLICA ARGENTINA', 'no', 'no', 'Linea con relieve', NULL),
(37, 65, 19, 'anverso', 'Linea entrecortada', 'NO', 'LIBERTAD 9 D FINO', 'UN ARGENTINO', 'NO', 'Linea con relieve', NULL),
(38, 66, 19, 'reverso', 'Linea entrecortada', 'Escudo Nacional Argentino', 'REPUBLICA ARGENTINA', 'NO', '1932', 'Linea con relieve', NULL),
(39, 67, 20, 'anverso', 'Linea entrecortada', '1 / CENTAVO', 'No', 'UN ARGENTINO', 'NO', 'Linea con relieve', NULL),
(40, 68, 20, 'reverso', 'Linea entrecortada', ' Escudo de armas (1813, escudo', 'REPUBLICA ARGENTINA', '1946', '1932', 'Linea con relieve', NULL),
(41, 69, 21, 'anverso', 'Linea entrecortada', '5 / CENTAVOS 2', '2 espigas enfrentadas una haci', '1958', 'No', 'Linea con relieve', NULL),
(42, 70, 21, 'reverso', 'Linea entrecortada', 'Cabeza de La Libertad (a izqui', 'REPUBLICA ARGENTINA ☆ LIBERTAD', 'no', 'No', 'Linea con relieve', NULL),
(43, 71, 22, 'anverso', 'Linea entrecortada', '10 / CENTAVOS', '2 espigas enfrentadas una haci', '1958', '1958', 'Linea con relieve', NULL),
(44, 72, 22, 'reverso', 'Linea entrecortada', 'Cabeza de La Libertad (a izqui', 'REPUBLICA ARGENTINA', 'no', 'No', 'Linea con relieve', NULL),
(45, 73, 23, 'anverso', 'Linea entrecortada', '20 / CENTAVOS', '2 espigas enfrentadas una haci', '1959', '1959', 'Linea con relieve', NULL),
(46, 74, 23, 'reverso', 'Linea entrecortada', 'Cabeza de La Libertad (a izqui', 'REPUBLICA ARGENTINA', 'No', 'No', 'Linea con relieve', NULL),
(47, 75, 24, 'anverso', 'Linea entrecortada', '50 / CENTAVOS', '2 espigas enfrentadas una haci', '1960', '1960', 'Linea con relieve', NULL),
(48, 76, 24, 'reverso', 'Linea entrecortada', 'Cabeza de La Libertad (a izqui', 'REPUBLICA ARGENTINA', 'No', 'No', 'Linea con relieve', NULL),
(49, 81, 25, 'anverso', 'No', 'no', 'no', 'no', 'no', 'no', NULL),
(50, 82, 25, 'reverso', 'no', 'no', 'no', 'no', 'no', 'no', NULL);

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
(12, 100);

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
  MODIFY `id_divisa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `lado`
--
ALTER TABLE `lado`
  MODIFY `id_lado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `moneda_atributo`
--
ALTER TABLE `moneda_atributo`
  MODIFY `id_moneda_atributo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `partes`
--
ALTER TABLE `partes`
  MODIFY `id_partes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
  MODIFY `id_valor_nominal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
