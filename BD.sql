-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2024 a las 04:49:32
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
-- Base de datos: `goldenstarhotel`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AsignarBoletoAHuesped` (IN `p_id_huesped` BIGINT, IN `p_id_boleto` BIGINT)   BEGIN
    UPDATE Huesped
    SET ID_boleto = p_id_boleto
    WHERE ID_huesped = p_id_huesped;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearHuesped` (IN `p_nombre` VARCHAR(255), IN `p_apellido` VARCHAR(255), IN `p_contrasena` VARCHAR(255), IN `p_correo` VARCHAR(255), IN `p_tipo` VARCHAR(50))   BEGIN
    DECLARE correo_existente INT;
    
    
    SELECT COUNT(*) INTO correo_existente
    FROM Huesped
    WHERE Correo = p_correo;
    
    IF correo_existente > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Este correo ya est� registrado.';
    ELSE
        
        INSERT INTO Huesped (Nombre, Apellido, Contrasena, Correo, Tipo)
        VALUES (p_nombre, p_apellido, p_contrasena, p_correo, p_tipo);
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerPaquetes` ()   BEGIN
    SELECT 
        paquete.ID_paquete, 
        plan_entretenimiento.nombre AS nombre_entretenimiento, 
        paquete.Plan_comida 
    FROM 
        paquete
    INNER JOIN 
        plan_entretenimiento ON paquete.Plan_entretenimiento = plan_entretenimiento.ID_entretenimiento;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleto`
--

CREATE TABLE `boleto` (
  `ID_boleto` bigint(20) NOT NULL,
  `Cajero` int(11) NOT NULL,
  `Cliente` bigint(20) NOT NULL,
  `Producto` bigint(20) DEFAULT NULL,
  `Precio` int(11) NOT NULL,
  `Caducidad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `boleto`
--

INSERT INTO `boleto` (`ID_boleto`, `Cajero`, `Cliente`, `Producto`, `Precio`, `Caducidad`) VALUES
(38, 2, 12, 13, 1000, '2024-06-09'),
(39, 1, 17, 2, 100, '2024-12-31'),
(40, 1, 18, 2, 100, '2024-12-31'),
(41, 1, 19, 2, 100, '2024-12-31'),
(42, 1, 20, 2, 100, '2024-12-31'),
(43, 1, 21, 2, 100, '2024-12-31'),
(44, 1, 22, 2, 100, '2024-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajero`
--

CREATE TABLE `cajero` (
  `Usuario` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `Correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cajero`
--

INSERT INTO `cajero` (`Usuario`, `Nombre`, `Apellido`, `Contrasena`, `Correo`) VALUES
(1, 'Cajero1', 'Apellido1', '$2y$10$5FmixOuLaSie8yQAEi0u0O8bO9dGStqeQfWS0eCKDSHl2OvZQzVPq', 'cajero1@example.com'),
(2, 'Emilio Uriel', 'Higareda Orozco', '$2y$10$Np73hDogAGl.2qcbLzHH8uNJfXBCfo9UsqImXMovQ8nkfQefiN0Zm', 'higaredaemilio@gmail.com'),
(3, 'Evelin In?s', 'Urzua Herrera', '$2y$10$6OHwGEmFNP2fTMycU1Ttg.ZXll9Kkg7vL05KR2q97lFcx5XyVLSC2', 'higaredaemilio1@gmail.com'),
(4, 'Ana', 'Martinez', '$2y$10$.4x5pyAfPdfvA93QYWK15eLJJvXPiJWpoXg5vZuqszFr1mubrR4jO', 'ana.martinez@example.com'),
(6, 'Laura', 'Hern?ndez', 'contrase?a6', 'laura.hernandez@example.com'),
(7, 'Luis', 'Jim?nez', 'contrase?a7', 'luis.jimenez@example.com'),
(8, 'Marta', 'Ruiz', 'contrase?a8', 'marta.ruiz@example.com'),
(9, 'Jorge', 'D?az', 'contrase?a9', 'jorge.diaz@example.com'),
(11, 'Uriel', 'El gran Uriel', '$2y$10$2tJnaz760yT2Cjr0K/1DsOmHctrAU27htFBCX/KnGOzsq6LV4/PWm', 'uririri@gmail.com'),
(14, 'ejemplo', 'ejemcajero', '$2y$10$Fn8RWYUx4X9Ytddcrt3pAepZ9qKhV50NixSdCZV7Vpr2hkMI7rDNe', 'ejemplocajero@gmail.com'),
(15, 'cajeroejemplo', 'cajeroejemplo', '$2y$10$uhVS139NccoSJvQcIBPe..6UMUw8GfOXP2QbXDQxGJglaEBcg7t9C', 'cajeroejemplo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `No_Habitacion` bigint(20) NOT NULL,
  `Capacidad` bigint(20) NOT NULL,
  `Estado` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`No_Habitacion`, `Capacidad`, `Estado`) VALUES
(101, 1, 1),
(102, 1, 1),
(103, 1, 1),
(104, 2, 1),
(105, 2, 1),
(106, 2, 1),
(107, 3, 1),
(108, 3, 1),
(109, 3, 1),
(110, 3, 1),
(1001, 1, 1),
(1002, 1, 1),
(1003, 1, 1),
(1004, 0, 1),
(1005, 1, 1),
(1006, 2, 0),
(1007, 1, 1),
(1008, 2, 0),
(1009, 2, 0),
(2001, 4, 0),
(2012, 4, 0),
(3021, 6, 0),
(3022, 6, 0),
(3023, 6, 0),
(3024, 6, 0),
(3025, 4, 0),
(3026, 6, 0),
(4031, 10, 0),
(4032, 10, 0),
(4043, 10, 0),
(4044, 10, 0),
(20011, 4, 0),
(20013, 4, 0),
(20014, 4, 0),
(20015, 4, 0),
(20016, 4, 0),
(20017, 4, 0),
(20018, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huesped`
--

CREATE TABLE `huesped` (
  `ID_huesped` bigint(20) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `ID_boleto` bigint(20) DEFAULT NULL,
  `Tipo` enum('usuario','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `huesped`
--

INSERT INTO `huesped` (`ID_huesped`, `Nombre`, `Apellido`, `Contrasena`, `Correo`, `ID_boleto`, `Tipo`) VALUES
(3, 'Enano', 'Higareda', '$2y$10$XxCcYHh2.HoKkeykkDuGVuCEC0VscQuAziTrXpDlG.xBolIIJfJ0e', 'enano@gmail.com', NULL, 'usuario'),
(12, 'Ikey', 'El Ike', '$2y$10$.L7kmhyOtqjp60clULmznOUEwhjBkoTPBGIno8P9OjmBBamiVk.eq', 'ikey@gmail.com', 38, 'usuario'),
(17, 'Norman Emilio', 'Santana Urzua', '$2y$10$JoW1FUqP3xeP/3VcDL5x6uMdpttW.m.RmPMeH/BCwCoi7biJQnLau', 'normane@gmail.com', 39, 'usuario'),
(19, 'ejemplo', 'ejem', '$2y$10$CAoI8f7gV0yvnXT.gc83BeuK5yZVb0aMH9Jw43/IOjN9ah5eFu6pC', 'ejemplo@gmail.com', 41, 'usuario'),
(21, 'ejemplo', 'ejempcajero', '$2y$10$bKlDIXDt3lWDCE.RzKig.OBaJ6zRA7SnYkAbiYQlkH5g3bY2ubnBe', 'ejempcajero@gmail.com', 43, 'usuario'),
(22, 'ejemplo', 'ejempcajero', '$2y$10$zCzZtUAVSc0BYfwDewOP/udz8fogTwHYKSNDnyda3.CViMrGr.Lw.', 'ejemplocajero2@gmail.com', 44, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `ID_paquete` bigint(20) NOT NULL,
  `Plan_entretenimiento` bigint(20) NOT NULL,
  `Plan_comida` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`ID_paquete`, `Plan_entretenimiento`, `Plan_comida`) VALUES
(1, 2, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 1, 0),
(12, 2, 0),
(13, 3, 0),
(14, 4, 0),
(15, 5, 0),
(16, 6, 0),
(17, 7, 0),
(18, 8, 0),
(19, 9, 0),
(20, 10, 0),
(1000, 1, 1),
(1001, 2, 2),
(1002, 4, 1),
(1003, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_entretenimiento`
--

CREATE TABLE `plan_entretenimiento` (
  `ID_entretenimiento` bigint(20) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plan_entretenimiento`
--

INSERT INTO `plan_entretenimiento` (`ID_entretenimiento`, `Nombre`, `Descripcion`) VALUES
(1, '', NULL),
(2, 'Casino', 'Disfruta de la convivencia y ambiente de nuestros casinos con nuestros juegos de mesa y tragamonedas'),
(3, 'Cine', 'Disfruta de nuestros matarones de peliculas'),
(4, 'Discoteca', 'M?sica inolvidable en la mejor discoteca de la zona'),
(5, 'Entretenimiento en vivo', 'Disfruta de los invitados especiales que se presentan en nuestro teatro, musica, bailes, y muchos mas espectaculos aqui'),
(6, 'Spa', 'Disfruta de nuestros relajantes spa que le ofrecen masajes, faciales, Jacuzzi y Piscinas de Hidroterapia'),
(7, 'Guarderia', 'Deja a tus hijos al cuidado de nuestra guarderia para que pueda descansar '),
(8, 'Bicicletas y motos', 'Tenga acceso a nuestro equipo (nuestra serie de bicicletas y motocicletas) para explorar la zona'),
(9, 'Canchas', 'Entre a nuestras canchas de b?squetbol y f?tbol'),
(10, 'Area comun', 'La agradable convivencia de todos los visitantes en nuestro jardin con acceso a bocadillos especiales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_producto` bigint(20) NOT NULL,
  `No_Habit` bigint(20) NOT NULL,
  `Paquete` bigint(20) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_final` date NOT NULL,
  `ID_entretenimiento` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_producto`, `No_Habit`, `Paquete`, `Fecha_Inicio`, `Fecha_final`, `ID_entretenimiento`) VALUES
(2, 102, 2, '2024-07-01', '2024-07-05', NULL),
(3, 103, 3, '2024-08-01', '2024-08-15', NULL),
(4, 104, 4, '2024-09-01', '2024-09-10', NULL),
(5, 105, 5, '2024-10-01', '2024-10-20', NULL),
(6, 106, 6, '2024-11-01', '2024-11-10', NULL),
(7, 107, 7, '2024-12-01', '2024-12-15', NULL),
(8, 108, 8, '2025-01-01', '2025-01-10', NULL),
(9, 109, 9, '2025-02-01', '2025-02-15', NULL),
(10, 110, 10, '2025-03-01', '2025-03-10', NULL),
(11, 1003, 1, '2024-06-03', '2024-06-07', NULL),
(13, 1005, 1, '2024-06-01', '2024-06-08', NULL),
(14, 1004, 3, '2024-06-03', '2024-06-07', NULL),
(15, 1007, 3, '2024-06-03', '2024-06-07', NULL);

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `ActualizarCapacidadHabitacion` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
    UPDATE Habitacion
    SET Capacidad = Capacidad - 1
    WHERE No_Habitacion = NEW.No_Habit;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_delete_producto` AFTER DELETE ON `producto` FOR EACH ROW BEGIN
    UPDATE habitacion
    SET Estado = 0
    WHERE No_Habitacion = OLD.No_Habit;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistaboletohuesped`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistaboletohuesped` (
`Nombre` varchar(255)
,`Apellido` varchar(255)
,`Correo` varchar(255)
,`ID_boleto` bigint(20)
,`Producto` bigint(20)
,`Precio` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistaboletoscompleta`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistaboletoscompleta` (
`ID_boleto` bigint(20)
,`Cajero` int(11)
,`Cliente` bigint(20)
,`Producto` bigint(20)
,`Precio` int(11)
,`Caducidad` date
,`Fecha_Inicio` date
,`Fecha_final` date
,`No_Habitacion` bigint(20)
,`Capacidad` bigint(20)
,`Estado` bigint(20)
,`Plan_entretenimiento` bigint(20)
,`Plan_comida` bigint(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistahuespedesboletos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistahuespedesboletos` (
`ID_huesped` bigint(20)
,`Nombre` varchar(255)
,`Apellido` varchar(255)
,`Correo` varchar(255)
,`ID_boleto` bigint(20)
,`Cajero` int(11)
,`Producto` bigint(20)
,`Precio` int(11)
,`Caducidad` date
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistapaquetes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistapaquetes` (
`ID_paquete` bigint(20)
,`nombre_entretenimiento` varchar(255)
,`Plan_comida` bigint(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistaproductoshabitaciones`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistaproductoshabitaciones` (
`ID_producto` bigint(20)
,`No_Habit` bigint(20)
,`Paquete` bigint(20)
,`Fecha_Inicio` date
,`Fecha_final` date
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_habitaciones`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_habitaciones` (
`No_Habitacion` bigint(20)
,`Capacidad` bigint(20)
,`Estado` bigint(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_huespedes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_huespedes` (
`ID_huesped` bigint(20)
,`Nombre` varchar(255)
,`Apellido` varchar(255)
,`Correo` varchar(255)
,`ID_boleto` bigint(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_planes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_planes` (
`ID_entretenimiento` bigint(20)
,`Nombre` varchar(255)
,`Descripcion` text
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vistaboletohuesped`
--
DROP TABLE IF EXISTS `vistaboletohuesped`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistaboletohuesped`  AS SELECT `h`.`Nombre` AS `Nombre`, `h`.`Apellido` AS `Apellido`, `h`.`Correo` AS `Correo`, `b`.`ID_boleto` AS `ID_boleto`, `b`.`Producto` AS `Producto`, `b`.`Precio` AS `Precio` FROM (`huesped` `h` join `boleto` `b` on(`h`.`ID_boleto` = `b`.`ID_boleto`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistaboletoscompleta`
--
DROP TABLE IF EXISTS `vistaboletoscompleta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistaboletoscompleta`  AS SELECT `b`.`ID_boleto` AS `ID_boleto`, `b`.`Cajero` AS `Cajero`, `b`.`Cliente` AS `Cliente`, `b`.`Producto` AS `Producto`, `b`.`Precio` AS `Precio`, `b`.`Caducidad` AS `Caducidad`, `p`.`Fecha_Inicio` AS `Fecha_Inicio`, `p`.`Fecha_final` AS `Fecha_final`, `h`.`No_Habitacion` AS `No_Habitacion`, `h`.`Capacidad` AS `Capacidad`, `h`.`Estado` AS `Estado`, `pq`.`Plan_entretenimiento` AS `Plan_entretenimiento`, `pq`.`Plan_comida` AS `Plan_comida` FROM (((`boleto` `b` join `producto` `p` on(`b`.`Producto` = `p`.`ID_producto`)) join `habitacion` `h` on(`p`.`No_Habit` = `h`.`No_Habitacion`)) join `paquete` `pq` on(`p`.`Paquete` = `pq`.`ID_paquete`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistahuespedesboletos`
--
DROP TABLE IF EXISTS `vistahuespedesboletos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistahuespedesboletos`  AS SELECT `h`.`ID_huesped` AS `ID_huesped`, `h`.`Nombre` AS `Nombre`, `h`.`Apellido` AS `Apellido`, `h`.`Correo` AS `Correo`, `b`.`ID_boleto` AS `ID_boleto`, `b`.`Cajero` AS `Cajero`, `b`.`Producto` AS `Producto`, `b`.`Precio` AS `Precio`, `b`.`Caducidad` AS `Caducidad` FROM (`huesped` `h` left join `boleto` `b` on(`h`.`ID_boleto` = `b`.`ID_boleto`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistapaquetes`
--
DROP TABLE IF EXISTS `vistapaquetes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistapaquetes`  AS SELECT `p`.`ID_paquete` AS `ID_paquete`, `e`.`Nombre` AS `nombre_entretenimiento`, `p`.`Plan_comida` AS `Plan_comida` FROM (`paquete` `p` join `plan_entretenimiento` `e` on(`p`.`Plan_entretenimiento` = `e`.`ID_entretenimiento`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistaproductoshabitaciones`
--
DROP TABLE IF EXISTS `vistaproductoshabitaciones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistaproductoshabitaciones`  AS SELECT `p`.`ID_producto` AS `ID_producto`, `p`.`No_Habit` AS `No_Habit`, `p`.`Paquete` AS `Paquete`, `p`.`Fecha_Inicio` AS `Fecha_Inicio`, `p`.`Fecha_final` AS `Fecha_final` FROM `producto` AS `p` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_habitaciones`
--
DROP TABLE IF EXISTS `vista_habitaciones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_habitaciones`  AS SELECT `habitacion`.`No_Habitacion` AS `No_Habitacion`, `habitacion`.`Capacidad` AS `Capacidad`, `habitacion`.`Estado` AS `Estado` FROM `habitacion` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_huespedes`
--
DROP TABLE IF EXISTS `vista_huespedes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_huespedes`  AS SELECT `huesped`.`ID_huesped` AS `ID_huesped`, `huesped`.`Nombre` AS `Nombre`, `huesped`.`Apellido` AS `Apellido`, `huesped`.`Correo` AS `Correo`, `huesped`.`ID_boleto` AS `ID_boleto` FROM `huesped` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_planes`
--
DROP TABLE IF EXISTS `vista_planes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_planes`  AS SELECT `plan_entretenimiento`.`ID_entretenimiento` AS `ID_entretenimiento`, `plan_entretenimiento`.`Nombre` AS `Nombre`, `plan_entretenimiento`.`Descripcion` AS `Descripcion` FROM `plan_entretenimiento` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boleto`
--
ALTER TABLE `boleto`
  ADD PRIMARY KEY (`ID_boleto`),
  ADD KEY `FK_Boleto_Cajero` (`Cajero`),
  ADD KEY `FK_Boleto_Producto` (`Producto`);

--
-- Indices de la tabla `cajero`
--
ALTER TABLE `cajero`
  ADD PRIMARY KEY (`Usuario`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`No_Habitacion`);

--
-- Indices de la tabla `huesped`
--
ALTER TABLE `huesped`
  ADD PRIMARY KEY (`ID_huesped`),
  ADD KEY `ID_boleto` (`ID_boleto`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`ID_paquete`),
  ADD KEY `FK_Paquete_Plan` (`Plan_entretenimiento`);

--
-- Indices de la tabla `plan_entretenimiento`
--
ALTER TABLE `plan_entretenimiento`
  ADD PRIMARY KEY (`ID_entretenimiento`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_producto`),
  ADD KEY `FK_Producto_Habitacion` (`No_Habit`),
  ADD KEY `FK_Producto_Paquete` (`Paquete`),
  ADD KEY `FK_Producto_Entretenimiento` (`ID_entretenimiento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boleto`
--
ALTER TABLE `boleto`
  MODIFY `ID_boleto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `cajero`
--
ALTER TABLE `cajero`
  MODIFY `Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `huesped`
--
ALTER TABLE `huesped`
  MODIFY `ID_huesped` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `ID_paquete` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT de la tabla `plan_entretenimiento`
--
ALTER TABLE `plan_entretenimiento`
  MODIFY `ID_entretenimiento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_producto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boleto`
--
ALTER TABLE `boleto`
  ADD CONSTRAINT `FK_Boleto_Cajero` FOREIGN KEY (`Cajero`) REFERENCES `cajero` (`Usuario`),
  ADD CONSTRAINT `FK_Boleto_Producto` FOREIGN KEY (`Producto`) REFERENCES `producto` (`ID_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `huesped`
--
ALTER TABLE `huesped`
  ADD CONSTRAINT `huesped_ibfk_1` FOREIGN KEY (`ID_boleto`) REFERENCES `boleto` (`ID_boleto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_Producto_Entretenimiento` FOREIGN KEY (`ID_entretenimiento`) REFERENCES `plan_entretenimiento` (`ID_entretenimiento`),
  ADD CONSTRAINT `FK_Producto_Habitacion` FOREIGN KEY (`No_Habit`) REFERENCES `habitacion` (`No_Habitacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
