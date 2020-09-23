-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 10, 2020 at 11:22 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Plantas`
--

-- --------------------------------------------------------

--
-- Table structure for table `Clase`
--

CREATE TABLE `Clase` (
  `clase` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Clase`
--

INSERT INTO `Clase` (`clase`) VALUES
('Coniferopsida'),
('Liliopsida'),
('Magnoliopsida');

-- --------------------------------------------------------

--
-- Table structure for table `ColorFlor`
--

CREATE TABLE `ColorFlor` (
  `id_color` int(11) NOT NULL,
  `genero` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `especie` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `color_flor` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `ColorFlor`
--

INSERT INTO `ColorFlor` (`id_color`, `genero`, `especie`, `color_flor`) VALUES
(1, 'Castanea', 'sativa', 'amarillo'),
(2, 'Quercus', 'suber', 'amarillo'),
(3, 'Cercis', 'siliquastrum', 'rosa violáceo'),
(4, 'Calycotome', 'villosa', 'amarillo'),
(5, 'Acacia', 'farnesiana', 'amarillo'),
(6, 'Jasminum', 'officinale', 'blanco'),
(7, 'Opuntia', 'ficus-indica', 'amarillo'),
(8, 'Opuntia', 'ficus-indica', 'naranja'),
(9, 'Opuntia', 'ficus-indica', 'rojo'),
(19, 'Agave', 'americana', 'amarillo'),
(20, 'Yucca', 'elephantipes', 'amarillo'),
(21, 'Yucca', 'elephantipes', 'crema'),
(22, 'Yucca', 'aloifolia', 'blanco'),
(23, 'Yucca', 'aloifolia', 'púrpura');

-- --------------------------------------------------------

--
-- Table structure for table `Familia`
--

CREATE TABLE `Familia` (
  `familia` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fruto` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'false',
  `forma_flor` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'false',
  `forma_flor_masculina` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'false',
  `forma_flor_femenina` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'false',
  `orden` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Familia`
--

INSERT INTO `Familia` (`familia`, `fruto`, `forma_flor`, `forma_flor_masculina`, `forma_flor_femenina`, `orden`) VALUES
('Agavaceae', 'cápsula', 'tépalos soldados en un tubo', 'false', 'false', 'Liliales'),
('Araceae', 'baya', 'muy numerosas, pequeñas y sin brácteas', 'false', 'false', 'Arales'),
('Asteraceae', 'aquenio', 'pentámeras', 'false', 'false', 'Asterales'),
('Cactaceae', 'baya', 'débiles sepaloides y corolinas', 'false', 'false', 'Caryophyllales'),
('Casuarinaceae', 'sámara', 'false', 'un sólo estambre con periantio de dos sépalos', 'cabezuelas sin periantio', 'Casuarinales'),
('Euphorbiaceae', 'cápsula', 'actimorfas agrupadas en pseudantos bisexuales', 'false', 'false', 'Euphorbiales'),
('Fabaceae', 'legumbre', 'de radiadas a simétricas dorsiventrales', 'false', 'false', 'Fabales'),
('Fagaceae', 'nuciforme', 'pequeña, unisexual y anemófila', 'false', 'false', 'Fagales'),
('Myrtaceae', 'baya', 'inflorescencia tipo umbela', 'false', 'false', 'Myrtales'),
('Oleaceae', 'baya', 'false', 'false', 'false', 'Scrophulariales'),
('Pinaceae', 'piña', 'false', 'false', 'false', 'Coniferales'),
('Ulmaceae', 'sámara', 'false', 'false', 'false', 'Urticales');

-- --------------------------------------------------------

--
-- Table structure for table `Genero`
--

CREATE TABLE `Genero` (
  `genero` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `familia` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Genero`
--

INSERT INTO `Genero` (`genero`, `familia`) VALUES
('Agave', 'Agavaceae'),
('Dracaena', 'Agavaceae'),
('Yucca', 'Agavaceae'),
('Montsera', 'Araceae'),
('Zantedeschia', 'Araceae'),
('Dittrichia', 'Asteraceae'),
('Osteospermum', 'Asteraceae'),
('Senecio', 'Asteraceae'),
('Opuntia', 'Cactaceae'),
('Casuarina', 'Casuarinaceae'),
('Acalypha', 'Euphorbiaceae'),
('Rizinus', 'Euphorbiaceae'),
('Acacia', 'Fabaceae'),
('Calycotome', 'Fabaceae'),
('Cercis', 'Fabaceae'),
('Castanea', 'Fagaceae'),
('Quercus', 'Fagaceae'),
('Eucalyptus', 'Myrtaceae'),
('Metrosideros', 'Myrtaceae'),
('Jasminum', 'Oleaceae'),
('Cedrus', 'Pinaceae'),
('Pinus', 'Pinaceae'),
('Ulmus', 'Ulmaceae');

-- --------------------------------------------------------

--
-- Table structure for table `Imagen`
--

CREATE TABLE `Imagen` (
  `id_imagen` int(11) NOT NULL,
  `genero` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `especie` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Imagen`
--

INSERT INTO `Imagen` (`id_imagen`, `genero`, `especie`, `imagen`) VALUES
(40, 'Acacia', 'karoo', 'Acaciakaroo2.jpg'),
(41, 'Acacia', 'karoo', 'Acaciakaroo1.jpg'),
(42, 'Acacia', 'karoo', 'Acaciakaroo0.jpg'),
(47, 'Acacia', 'farnesiana', 'Acaciafarnesiana0.jpeg'),
(48, 'Agave', 'americana', 'Agaveamericana0.jpeg'),
(49, 'Calycotome', 'villosa', 'Calycotomevillosa0.jpeg'),
(50, 'Castanea', 'sativa', 'Castaneasativa0.jpeg'),
(51, 'Casuarina', 'cunninghamiana', 'Casuarinacunninghamiana0.jpeg'),
(54, 'Eucalyptus', 'globulus', 'Eucalyptusglobulus0.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `Multiplicacion`
--

CREATE TABLE `Multiplicacion` (
  `id_multiplicacion` int(11) NOT NULL,
  `genero` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `especie` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `multiplicacion` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Multiplicacion`
--

INSERT INTO `Multiplicacion` (`id_multiplicacion`, `genero`, `especie`, `multiplicacion`) VALUES
(1, 'Pinus', 'pinea', 'semilla'),
(2, 'Pinus', 'halepensis', 'semilla'),
(3, 'Pinus', 'canariensis', 'semilla'),
(4, 'Casuarina', 'cunninghamiana', 'semilla'),
(5, 'Casuarina', 'cunninghamiana', 'estaca'),
(6, 'Quercus', 'rotundifolia', 'semilla'),
(7, 'Quercus', 'rotundifolia', 'injerto'),
(8, 'Cedrus', 'atlantica', 'semilla'),
(9, 'Castanea', 'sativa', 'acodo'),
(10, 'Castanea', 'sativa', 'injerto'),
(11, 'Castanea', 'sativa', 'semilla'),
(13, 'Quercus', 'suber', 'injerto'),
(14, 'Quercus', 'suber', 'semilla'),
(15, 'Ulmus', 'minor', 'semilla madura fresca'),
(16, 'Ulmus', 'minor', 'acodo'),
(17, 'Ulmus', 'minor', 'chupón'),
(18, 'Cercis', 'siliquastrum', 'semilla'),
(19, 'Cercis', 'siliquastrum', 'esqueje'),
(20, 'Calycotome', 'villosa', 'semilla'),
(21, 'Calycotome', 'villosa', 'esqueje'),
(22, 'Acacia', 'farnesiana', 'semilla'),
(23, 'Acacia', 'farnesiana', 'acodo'),
(24, 'Acacia', 'farnesiana', 'injerto'),
(25, 'Acacia', 'karoo', 'semilla'),
(26, 'Acacia', 'karoo', 'esqueje'),
(27, 'Jasminum', 'Officinale', 'esqueje semileñoso'),
(28, 'Jasminum', 'Officinale', 'acodo'),
(31, 'Agave', 'americana', 'semilla'),
(32, 'Agave', 'americana', 'renuevos'),
(33, 'Yucca', 'elephantipes', 'división de rizoma'),
(34, 'Yucca', 'elephantipes', 'semilla'),
(35, 'Yucca', 'aloifolia', 'semilla'),
(36, 'Yucca', 'aloifolia', 'esqueje'),
(37, 'Dracaena', 'indivisa', 'esqueje'),
(38, 'Rizinus', 'communis', 'semilla');

-- --------------------------------------------------------

--
-- Table structure for table `Orden`
--

CREATE TABLE `Orden` (
  `orden` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `subclase` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Orden`
--

INSERT INTO `Orden` (`orden`, `subclase`) VALUES
('Arales', 'Arecidae'),
('Asterales', 'Asteridae'),
('Scrophulariales', 'Asteridae'),
('Caryophyllales', 'Caryophyllidae'),
('Salicales', 'Dilleniidae'),
('Casuarinales', 'Hamamelidae'),
('Fagales', 'Hamamelidae'),
('Urticales', 'Hamamelidae'),
('Liliales', 'Liliidae'),
('Coniferales', 'Pinidae'),
('Euphorbiales', 'Rosidae'),
('Fabales', 'Rosidae'),
('Myrtales', 'Rosidae');

-- --------------------------------------------------------

--
-- Table structure for table `Origen`
--

CREATE TABLE `Origen` (
  `id_origen` int(11) NOT NULL,
  `genero` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `especie` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `origen` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Origen`
--

INSERT INTO `Origen` (`id_origen`, `genero`, `especie`, `origen`) VALUES
(1, 'Pinus', 'halepensis', 'Mediterráneo'),
(2, 'Pinus', 'pinea', 'Mediterráneo'),
(3, 'Cedrus', 'atlantica', 'Norte de África'),
(4, 'Pinus', 'canariensis', 'Canarias'),
(5, 'Casuarina', 'cunninghamiana', 'Australia'),
(6, 'Casuarina', 'cunninghamiana', 'África oriental'),
(7, 'Casuarina', 'cunninghamiana', 'Madagascar'),
(8, 'Casuarina', 'cunninghamiana', 'Sumatra'),
(9, 'Casuarina', 'cunninghamiana', 'Borneo'),
(10, 'Quercus', 'rotundifolia', 'Mediterráneo'),
(11, 'Castanea', 'sativa', 'Mediterráneo oriental'),
(12, 'Quercus', 'suber', 'Mediterráneo occidental'),
(13, 'Ulmus', 'minor', 'Europa'),
(14, 'Cercis', 'siliquastrum', 'Mediterráneo'),
(15, 'Acacia', 'farnesiana', 'Chile'),
(16, 'Acacia', 'karoo', 'Sudáfrica'),
(17, 'Opuntia', 'ficus-indica', 'América'),
(18, 'Jasminum', 'officinale', 'Irán'),
(19, 'Jasminum', 'officinale', 'India'),
(20, 'Jasminum', 'officinale', 'China'),
(21, 'Agave', 'americana', 'Sur de Estados Unidos'),
(22, 'Agave', 'americana', 'Méjico'),
(23, 'Yucca', 'elephantipes', 'Méjico'),
(24, 'Yucca', 'elephantipes', 'Guatemala'),
(25, 'Yucca', 'aloifolia', 'Estados Unidos'),
(26, 'Yucca', 'aloifolia', 'Méjico'),
(27, 'Dracaena', 'indivisa', 'Nueva Zelanda'),
(28, 'Rizinus', 'communis', 'África tropical');

-- --------------------------------------------------------

--
-- Table structure for table `Papelera`
--

CREATE TABLE `Papelera` (
  `genero_p` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
  `especie_p` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
  `temp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Planta`
--

CREATE TABLE `Planta` (
  `genero` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `especie` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipo` enum('árbol','arbusto','trepadora','false') COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'false',
  `forma_hoja` enum('bipinnada','lanceolada','acicular','cordiforme','pinnada','aovada','false') COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'false',
  `disposicion_hoja` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'false',
  `persistencia` enum('caduca','perenne','false','') COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'false',
  `disposicion_flor` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'false',
  `n_petalos` int(11) NOT NULL DEFAULT -1,
  `tam` int(11) NOT NULL DEFAULT -1,
  `floracion_inicio` int(11) NOT NULL DEFAULT 0,
  `floracion_fin` int(11) NOT NULL DEFAULT 0,
  `maduracion_inicio` int(11) NOT NULL DEFAULT 0,
  `maduracion_fin` int(11) NOT NULL DEFAULT 0,
  `estado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Planta`
--

INSERT INTO `Planta` (`genero`, `especie`, `tipo`, `forma_hoja`, `disposicion_hoja`, `persistencia`, `disposicion_flor`, `n_petalos`, `tam`, `floracion_inicio`, `floracion_fin`, `maduracion_inicio`, `maduracion_fin`, `estado`) VALUES
('Acacia', 'farnesiana', 'arbusto', 'bipinnada', 'alterna', 'caduca', 'agrupadas en espigas, racimos o solitarias', -1, 400, 1, 5, 8, 9, 0),
('Acacia', 'karoo', 'árbol', 'bipinnada', 'false', 'caduca', 'agrupada', -1, 400, 4, 6, 6, 7, 0),
('Agave', 'americana', 'false', 'lanceolada', 'en espiral alrededor del centro', 'perenne', 'agrupadas', -1, 200, 6, 8, 0, 0, 0),
('Calycotome', 'villosa', 'arbusto', 'false', 'false', 'caduca', 'false', -1, 300, 4, 6, 7, 9, 0),
('Castanea', 'sativa', 'árbol', 'lanceolada', 'alterna', 'caduca', 'false', -1, 2800, 5, 6, 10, 11, 0),
('Casuarina', 'cunninghamiana', 'árbol', 'acicular', 'false', 'perenne', 'false', -1, 3500, 1, 2, 10, 11, 0),
('Cedrus', 'atlantica', 'árbol', 'acicular', 'false', 'perenne', 'false', -1, 3000, 0, 0, 11, 12, 0),
('Cercis', 'siliquastrum', 'árbol', 'cordiforme', 'false', 'caduca', 'false', -1, 500, 4, 5, 6, 7, 0),
('Dracaena', 'indivisa', 'árbol', 'lanceolada', 'false', 'perenne', 'agrupadas', -1, 800, 7, 8, 0, 0, 0),
('Eucalyptus', 'camaldulensis', 'árbol', 'lanceolada', 'axilas de las hojas', 'perenne', 'agrupadas', 4, 5000, 4, 6, 0, 0, 0),
('Eucalyptus', 'globulus', 'árbol', 'lanceolada', 'alterna', 'perenne', 'agrupadas', 4, 7500, 10, 2, 0, 0, 0),
('Jasminum', 'officinale', 'trepadora', 'pinnada', 'false', 'false', 'false', -1, 1000, 7, 9, 0, 0, 0),
('Opuntia', 'Ficus-indica', 'arbusto', 'false', 'false', 'false', 'false', -1, 500, 4, 6, 7, 8, 0),
('Pinus', 'canariensis', 'árbol', 'acicular', 'de tres en tres', 'perenne', 'false', -1, 4000, 4, 7, 7, 8, 0),
('Pinus', 'halepensis', 'árbol', 'acicular', 'de dos en dos', 'perenne', 'false', -1, 2000, 3, 5, 11, 12, 0),
('Pinus', 'pinea', 'árbol', 'acicular', 'false', 'perenne', 'false', -1, 2500, 3, 5, 11, 12, 0),
('Quercus', 'rotundifolia', 'árbol', 'lanceolada', 'false', 'caduca', 'false', -1, 1500, 4, 5, 10, 11, 0),
('Quercus', 'suber', 'árbol', 'false', 'false', 'perenne', 'false', -1, 2000, 6, 7, 10, 10, 0),
('Rizinus', 'communis', 'árbol', 'pinnada', 'false', 'caduca', 'agrupadas', 0, 550, 7, 9, 0, 0, 0),
('Ulmus', 'minor', 'árbol', 'aovada', 'alterna', 'caduca', 'false', -1, 2000, 4, 6, 5, 6, 0),
('Yucca', 'aloifolia', 'false', 'lanceolada', 'false', 'perenne', 'agrupadas', -1, 600, 3, 4, 0, 0, 0),
('Yucca', 'elephantipes', 'false', 'lanceolada', 'false', 'perenne', 'agrupadas', -1, 1000, 7, 9, 10, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Subclase`
--

CREATE TABLE `Subclase` (
  `subclase` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `clase` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Subclase`
--

INSERT INTO `Subclase` (`subclase`, `clase`) VALUES
('Pinidae', 'Coniferopsida'),
('Arecidae', 'Liliopsida'),
('Liliidae', 'Liliopsida'),
('Asteridae', 'Magnoliopsida'),
('Caryophyllidae', 'Magnoliopsida'),
('Dilleniidae', 'Magnoliopsida'),
('Hamamelidae', 'Magnoliopsida'),
('Rosidae', 'Magnoliopsida');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` varchar(12) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(12) COLLATE utf8mb4_spanish_ci NOT NULL,
  `mail` varchar(35) COLLATE utf8mb4_spanish_ci NOT NULL,
  `type` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `password`, `mail`, `type`) VALUES
('admin', 'holamundo', 'elenche@correo.ugr.es', 'administrador');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Clase`
--
ALTER TABLE `Clase`
  ADD PRIMARY KEY (`clase`);

--
-- Indexes for table `ColorFlor`
--
ALTER TABLE `ColorFlor`
  ADD PRIMARY KEY (`id_color`),
  ADD KEY `fk_colorPlanta` (`genero`,`especie`);

--
-- Indexes for table `Familia`
--
ALTER TABLE `Familia`
  ADD PRIMARY KEY (`familia`),
  ADD KEY `orden` (`orden`);

--
-- Indexes for table `Genero`
--
ALTER TABLE `Genero`
  ADD PRIMARY KEY (`genero`),
  ADD KEY `fk_familia` (`familia`);

--
-- Indexes for table `Imagen`
--
ALTER TABLE `Imagen`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `fk_img` (`genero`,`especie`);

--
-- Indexes for table `Multiplicacion`
--
ALTER TABLE `Multiplicacion`
  ADD PRIMARY KEY (`id_multiplicacion`),
  ADD KEY `fk_mult` (`genero`,`especie`);

--
-- Indexes for table `Orden`
--
ALTER TABLE `Orden`
  ADD PRIMARY KEY (`orden`),
  ADD KEY `subclase` (`subclase`);

--
-- Indexes for table `Origen`
--
ALTER TABLE `Origen`
  ADD PRIMARY KEY (`id_origen`),
  ADD KEY `fk_origen` (`genero`,`especie`);

--
-- Indexes for table `Papelera`
--
ALTER TABLE `Papelera`
  ADD PRIMARY KEY (`genero_p`,`especie_p`) USING BTREE,
  ADD KEY `genero_p` (`genero_p`,`especie_p`);

--
-- Indexes for table `Planta`
--
ALTER TABLE `Planta`
  ADD PRIMARY KEY (`genero`,`especie`);

--
-- Indexes for table `Subclase`
--
ALTER TABLE `Subclase`
  ADD PRIMARY KEY (`subclase`),
  ADD KEY `clase` (`clase`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ColorFlor`
--
ALTER TABLE `ColorFlor`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Imagen`
--
ALTER TABLE `Imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `Multiplicacion`
--
ALTER TABLE `Multiplicacion`
  MODIFY `id_multiplicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `Origen`
--
ALTER TABLE `Origen`
  MODIFY `id_origen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ColorFlor`
--
ALTER TABLE `ColorFlor`
  ADD CONSTRAINT `fk_color` FOREIGN KEY (`genero`,`especie`) REFERENCES `Planta` (`genero`, `especie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_colorPlanta` FOREIGN KEY (`genero`,`especie`) REFERENCES `Planta` (`genero`, `especie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Familia`
--
ALTER TABLE `Familia`
  ADD CONSTRAINT `fk_orden` FOREIGN KEY (`orden`) REFERENCES `Orden` (`orden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Genero`
--
ALTER TABLE `Genero`
  ADD CONSTRAINT `fk_familia` FOREIGN KEY (`familia`) REFERENCES `Familia` (`familia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Imagen`
--
ALTER TABLE `Imagen`
  ADD CONSTRAINT `fk_imagen` FOREIGN KEY (`genero`,`especie`) REFERENCES `Planta` (`genero`, `especie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_img` FOREIGN KEY (`genero`,`especie`) REFERENCES `Planta` (`genero`, `especie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Multiplicacion`
--
ALTER TABLE `Multiplicacion`
  ADD CONSTRAINT `fk_mult` FOREIGN KEY (`genero`,`especie`) REFERENCES `Planta` (`genero`, `especie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Orden`
--
ALTER TABLE `Orden`
  ADD CONSTRAINT `fk_subclase` FOREIGN KEY (`subclase`) REFERENCES `Subclase` (`subclase`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Origen`
--
ALTER TABLE `Origen`
  ADD CONSTRAINT `fk_origen` FOREIGN KEY (`genero`,`especie`) REFERENCES `Planta` (`genero`, `especie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Papelera`
--
ALTER TABLE `Papelera`
  ADD CONSTRAINT `fk_planta` FOREIGN KEY (`genero_p`,`especie_p`) REFERENCES `Planta` (`genero`, `especie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Planta`
--
ALTER TABLE `Planta`
  ADD CONSTRAINT `fk_plantita` FOREIGN KEY (`genero`) REFERENCES `Genero` (`genero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Subclase`
--
ALTER TABLE `Subclase`
  ADD CONSTRAINT `fk_clase` FOREIGN KEY (`clase`) REFERENCES `Clase` (`clase`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
