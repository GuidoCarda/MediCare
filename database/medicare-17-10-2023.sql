-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2023 a las 05:40:48
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `medicare`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blood_type`
--

CREATE TABLE `blood_type` (
  `id` int(11) NOT NULL,
  `denomination` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `blood_type`
--

INSERT INTO `blood_type` (`id`, `denomination`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'AB+'),
(6, 'AB-'),
(7, 'O+'),
(8, 'O-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frequency`
--

CREATE TABLE `frequency` (
  `id` int(11) NOT NULL,
  `denomination` varchar(50) DEFAULT NULL,
  `hours_interval` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `frequency`
--

INSERT INTO `frequency` (`id`, `denomination`, `hours_interval`) VALUES
(1, 'Diario', 24),
(2, 'Dia por medio', 48),
(3, 'Una vez por semana', 168),
(4, 'Cada 15 dias', 360),
(5, 'Cada 12 horas', 12),
(6, 'Cada 8 horas', 8),
(7, 'Cada 6 horas', 6),
(8, 'Cada 4 horas', 4),
(9, 'Cada 2 horas', 2),
(10, 'Cada 1 hora', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `generic_name` varchar(50) DEFAULT NULL,
  `drug` varchar(50) DEFAULT NULL,
  `medicine_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicine`
--

INSERT INTO `medicine` (`id`, `generic_name`, `drug`, `medicine_type_id`) VALUES
(1, 'Fluticort', 'Fluticasona', 9),
(2, 'Procolaran', 'Ivabradina', 1),
(3, 'Poenbioptal', 'Cloranifenicol', 10),
(4, 'Tafirol', 'Paracetamol', 1),
(5, '123', '12312', 1),
(6, 'test', 'test', 1),
(7, 'asd', 'asd', 1),
(8, 'asda', 'asdasd', 1),
(9, 'asdasd', 'asdasdas', 1),
(10, 'medicamento1', 'droga1', 1),
(11, '12312', '123123', 1),
(12, 'asdasd', '12312', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicine_type`
--

CREATE TABLE `medicine_type` (
  `id` int(11) NOT NULL,
  `denomination` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicine_type`
--

INSERT INTO `medicine_type` (`id`, `denomination`, `unit`) VALUES
(1, 'Pastilla', 'Comprimido'),
(2, 'Jarabe', 'Mililitros'),
(3, 'Inyección', 'Mililitros'),
(4, 'Cápsula', 'Comprimido'),
(5, 'Crema', 'Gramos'),
(6, 'Parche Transdérmico', 'Unidades'),
(7, 'Supositorio', 'Unidades'),
(8, 'Solución Oftálmica', 'Gotas'),
(9, 'Inhalador', 'Inhalaciones'),
(10, 'Gotas Orales', 'Gotas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `gender` enum('Masculino','Femenino') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `blood_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `patient`
--

INSERT INTO `patient` (`id`, `name`, `lastname`, `gender`, `birth_date`, `dni`, `user_id`, `blood_type_id`) VALUES
(1, 'Test', 'Test', NULL, '2001-02-05', '43233212', 1, 3),
(2, 'Guido', 'Cardarelli', NULL, '2001-02-05', '43237440', 2, 1),
(3, 'Test', 'Test3', NULL, '2001-02-05', '12345678', 3, 1),
(4, 'Guido', 'Casa', NULL, '2004-01-04', '43237440', 4, 1),
(5, '312312', '31231', NULL, '2005-10-02', '31231231', 5, 1),
(6, 'adas', 'dsada', NULL, '2005-02-02', '22222222', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patient_professional`
--

CREATE TABLE `patient_professional` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `professional_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `patient_professional`
--

INSERT INTO `patient_professional` (`id`, `patient_id`, `professional_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `professional_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `frequency_id` int(11) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prescription`
--

INSERT INTO `prescription` (`id`, `quantity`, `created_at`, `professional_id`, `patient_id`, `frequency_id`, `medicine_id`, `is_active`) VALUES
(1, 2, '2023-10-14', 1, 1, 5, 1, 1),
(2, 1, '2023-10-14', 2, 2, 1, 2, 1),
(3, 1, '2023-10-05', 1, 1, 1, 1, 1),
(4, 2, '2023-10-15', 3, 1, 1, 3, 1),
(5, 2, '2023-10-27', 1, 1, 6, 1, 1),
(6, 2, '2023-10-28', 1, 1, 7, 1, 1),
(7, 2, '2023-10-17', 2, 2, 1, 2, 1),
(8, 3, '2023-10-15', 2, 2, 1, 2, 1),
(9, 1, '2023-08-03', 3, 1, 3, 4, 1),
(11, 3, '2023-10-15', 3, 1, 3, 4, 0),
(12, 5, '2023-10-15', 3, 1, 1, 4, 0),
(13, 2, '2023-11-23', 1, 1, 5, 4, 1),
(14, 123123, '2023-10-16', 1, 1, 1, 5, 0),
(15, 2, '2023-10-28', 1, 1, 7, NULL, 1),
(16, 1, '2023-08-02', 3, 1, 1, 6, 1),
(17, 13, '2023-10-16', 1, 1, 1, 6, 0),
(18, 2, '2023-10-16', 1, 1, 10, 6, 0),
(19, 123, '2023-10-17', 1, 1, 1, 6, 1),
(20, 123, '2023-10-17', 1, 1, 1, 6, 0),
(21, 12312312, '2023-12-20', 1, 1, 1, 6, 1),
(22, 1, '2023-10-18', 1, 1, 1, 7, 1),
(23, 2, '2023-10-18', 1, 1, 1, NULL, 1),
(24, 2, '2023-10-18', 1, 1, 1, NULL, 1),
(25, 5, '2023-10-18', 1, 1, 1, NULL, 1),
(26, 5, '2023-10-18', 1, 1, 1, NULL, 1),
(27, 5, '2023-10-18', 1, 1, 1, NULL, 1),
(28, 5, '2023-10-18', 1, 1, 1, 7, 1),
(29, 5, '2023-10-18', 1, 1, 1, 7, 1),
(30, 10, '2023-10-19', 1, 1, 1, 7, 1),
(31, 10, '2023-10-19', 1, 1, 1, 7, 0),
(32, 2, '2024-01-23', 1, 1, 1, 7, 1),
(33, 1, '2023-08-03', 2, 2, 1, 6, 1),
(34, 1, '2023-08-03', 2, 2, 1, 6, 0),
(35, 1, '2023-09-20', 2, 2, 1, 6, 1),
(36, 0, '2023-10-28', 2, 2, 1, 8, 1),
(37, 0, '2023-10-19', 2, 2, 1, 9, 1),
(38, 2, '2024-04-24', 2, 2, 1, 6, 1),
(39, 5, '2023-10-18', 2, 2, 1, 6, 1),
(40, 54, '2023-10-27', 2, 2, 1, 6, 1),
(41, 544, '2023-10-27', 2, 2, 1, 6, 1),
(42, 544, '2023-10-27', 2, 2, 1, 6, 1),
(43, 542, '2023-10-27', 2, 2, 1, 6, 1),
(44, 542, '2023-10-27', 2, 2, 1, 6, 0),
(45, 5, '2024-06-25', 2, 2, 6, 6, 1),
(46, 2, '2023-10-20', 2, 2, 1, 10, 1),
(47, 123123, '2023-10-07', 2, 2, 1, 11, 1),
(48, 2, '2023-10-04', 2, 2, 1, 12, 1),
(49, 10, '2023-10-04', 2, 2, 1, 12, 1),
(50, 10, '2023-10-15', 3, 1, 1, 3, 1),
(51, 10, '2023-10-15', 3, 1, 4, 3, 1),
(52, 10, '2023-10-15', 3, 1, 4, 3, 1),
(53, 10, '2023-10-15', 1, 1, 4, 3, 1),
(54, 10, '2023-10-15', 3, 1, 4, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professional`
--

CREATE TABLE `professional` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `license_number` varchar(10) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `specialty_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `professional`
--

INSERT INTO `professional` (`id`, `name`, `lastname`, `email`, `license_number`, `phone_number`, `specialty_id`) VALUES
(1, 'Octavio', 'Fernandez', 'octafdez@gmail.com', '123', '1235435', 1),
(2, 'Roberto', 'Gomez', 'robertoGomez@gmail.com', '456', '123123123', 5),
(3, 'Alejando', 'Morales', 'alemorales@gmail.com', '789', '12312312', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specialty`
--

CREATE TABLE `specialty` (
  `id` int(11) NOT NULL,
  `denomination` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `specialty`
--

INSERT INTO `specialty` (`id`, `denomination`) VALUES
(1, 'Neumonólogo'),
(2, 'Neurologo'),
(3, 'Psicólogo'),
(4, 'Nutricionista'),
(5, 'Cardiólogo'),
(6, 'Dermatólogo'),
(7, 'Ginecólogo'),
(8, 'Oftalmólogo'),
(9, 'Pediatra'),
(10, 'Cirujano General'),
(11, 'Endocrinólogo'),
(12, 'Oncólogo'),
(13, 'Ortopedista'),
(14, 'Psiquiatra'),
(15, 'Radiólogo'),
(16, 'Urología'),
(17, 'Odontólogo'),
(18, 'Fisioterapeuta'),
(19, 'Geriatra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'test@test.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(2, 'guido@gmail.com', 'adfc8f0aec273eace2629141317c1eac53923f28'),
(3, 'test3@gmail.com', '3ebfa301dc59196f18593c45e519287a23297589'),
(4, '123@gmail.com', 'a3d63c0b0479ac50cd199d14a2725dadf1e1e95a'),
(5, 'adasd@gmail.com', 'e2baea3685c88a5ba29c0f4d6a465705d1c8bcad'),
(6, 'test2@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blood_type`
--
ALTER TABLE `blood_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `frequency`
--
ALTER TABLE `frequency`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicine_type_id` (`medicine_type_id`);

--
-- Indices de la tabla `medicine_type`
--
ALTER TABLE `medicine_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blood_type_id` (`blood_type_id`);

--
-- Indices de la tabla `patient_professional`
--
ALTER TABLE `patient_professional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `professional_id` (`professional_id`);

--
-- Indices de la tabla `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professional_id` (`professional_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `medicine_id` (`medicine_id`),
  ADD KEY `frequency_id` (`frequency_id`);

--
-- Indices de la tabla `professional`
--
ALTER TABLE `professional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialty_id` (`specialty_id`);

--
-- Indices de la tabla `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blood_type`
--
ALTER TABLE `blood_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `frequency`
--
ALTER TABLE `frequency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `medicine_type`
--
ALTER TABLE `medicine_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `patient_professional`
--
ALTER TABLE `patient_professional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `professional`
--
ALTER TABLE `professional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`medicine_type_id`) REFERENCES `medicine_type` (`id`);

--
-- Filtros para la tabla `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`blood_type_id`) REFERENCES `blood_type` (`id`);

--
-- Filtros para la tabla `patient_professional`
--
ALTER TABLE `patient_professional`
  ADD CONSTRAINT `patient_professional_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `patient_professional_ibfk_2` FOREIGN KEY (`professional_id`) REFERENCES `professional` (`id`);

--
-- Filtros para la tabla `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`professional_id`) REFERENCES `professional` (`id`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `prescription_ibfk_4` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`id`),
  ADD CONSTRAINT `prescription_ibfk_5` FOREIGN KEY (`frequency_id`) REFERENCES `frequency` (`id`);

--
-- Filtros para la tabla `professional`
--
ALTER TABLE `professional`
  ADD CONSTRAINT `professional_ibfk_1` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
