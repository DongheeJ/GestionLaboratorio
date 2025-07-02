-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 02-07-2025 a las 19:28:31
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
-- Base de datos: `gestionlaboratorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `idAsignatura` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`idAsignatura`, `nombre`) VALUES
(1, 'cálculo diferencial'),
(2, 'física de ondas'),
(3, 'física I: mecánica newtoniana'),
(4, 'física II: electromagnetismo'),
(5, 'física III: ondas y física moderna'),
(6, 'mecánica de suelos'),
(7, 'microondas'),
(8, 'pensamiento científico'),
(9, 'redes inalámbricas'),
(10, 'termodinámica'),
(11, 'termodinámica y fluidos'),
(12, 'energía y medio ambiente'),
(13, 'ingeniería ambiental'),
(14, 'materiales industriales'),
(15, 'química general'),
(16, 'química industrial'),
(17, 'tratamiento de aguas residuales'),
(18, 'tratamiento de residuos sólidos'),
(19, 'cálculo integral'),
(20, 'ecuaciones diferenciales'),
(21, 'geometría euclidiana'),
(22, 'matemáticas especiales'),
(23, 'análisis y métodos numéricos'),
(24, 'probabilidad y estadística'),
(25, 'control de procesos'),
(26, 'métodos numéricos'),
(27, 'análisis de Fourier'),
(28, 'computación cuántica'),
(29, 'teoría y lógica de programación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idAsistencia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `proyectoC` varchar(75) NOT NULL,
  `actividad` varchar(45) NOT NULL,
  `asignatura` varchar(80) NOT NULL,
  `docente` varchar(150) NOT NULL,
  `codigoGrupo` varchar(45) NOT NULL,
  `numeroEstudiante` int(11) NOT NULL,
  `horaEntrada` time NOT NULL,
  `horaSalida` time NOT NULL,
  `firma` varchar(255) DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectoc`
--

CREATE TABLE `proyectoc` (
  `idProyectoC` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `codigo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectoc`
--

INSERT INTO `proyectoc` (`idProyectoC`, `nombre`, `codigo`) VALUES
(1, 'INSTITUTO DE LENGUAS UNIVERSIDAD DISTRITAL', '105'),
(2, 'MAESTRÍA EN INGENIERÍA CIVIL', '111'),
(3, 'INGENIERÍA INDUSTRIAL', '015'),
(4, 'ESPECIALIZACIÓN EN GERENCIA DE LA CONSTRUCCIÓN', '036'),
(5, 'INGENIERÍA ELÉCTRICA (CICLOS PROPEDÉUTICOS)', '372'),
(6, 'INGENIERÍA EN TELECOMUNICACIONES (CICLOS PROPEDÉUTICOS)', '373'),
(7, 'INGENIERÍA MECÁNICA (CICLOS PROPEDÉUTICOS)', '375'),
(8, 'INGENIERÍA DE PRODUCCIÓN (CICLOS PROPEDÉUTICOS)', '377'),
(9, 'TECNOLOGÍA EN CONSTRUCCIONES CIVILES (CICLOS PROPEDÉUTICOS)', '378'),
(10, 'ESPECIALIZACIÓN EN INTERVENTORÍA Y SUPERVISIÓN DE OBRAS DE CONSTRUCCIÓN', '038'),
(11, 'TECNOLOGÍA EN ELECTRICIDAD DE MEDIA Y BAJA TENSIÓN', '379'),
(12, 'TECNOLOGÍA EN MECÁNICA INDUSTRIAL', '574'),
(13, 'TECNOLOGÍA EN GESTIÓN DE LA PRODUCCIÓN INDUSTRIAL', '576'),
(14, 'TECNOLOGÍA EN SISTEMATIZACIÓN DE DATOS (CICLOS PROPEDÉUTICOS)', '578'),
(15, 'INGENIERÍA CIVIL (CICLOS PROPEDÉUTICOS)', '579'),
(16, 'INGENIERÍA EN CONTROL Y AUTOMATIZACIÓN (CICLOS PROPEDÉUTICOS)', '583'),
(17, 'TECNOLOGÍA EN ELECTRÓNICA INDUSTRIAL (CICLOS PROPEDÉUTICOS)', '675'),
(18, 'INGENIERÍA EN TELEMÁTICA (CICLOS PROPEDÉUTICOS)', '678'),
(19, 'INGENIERÍA ELÉCTRICA', '007');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`idAsignatura`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idAsistencia`),
  ADD KEY `fk_Asistencia_Usuario1_idx` (`Usuario_idUsuario`),
  ADD KEY `idx_proyectoC` (`proyectoC`),
  ADD KEY `idx_asignatura` (`asignatura`);

--
-- Indices de la tabla `proyectoc`
--
ALTER TABLE `proyectoc`
  ADD PRIMARY KEY (`idProyectoC`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `idAsignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idAsistencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyectoc`
--
ALTER TABLE `proyectoc`
  MODIFY `idProyectoC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_Asistencia_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
