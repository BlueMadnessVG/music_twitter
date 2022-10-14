-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2022 at 06:46 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music_twitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `ID_Album` int(10) NOT NULL,
  `ID_Contenido_Alb` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL,
  `Nombre_Album` varchar(20) NOT NULL,
  `Fecha_Subida` date NOT NULL,
  `Duracion` time NOT NULL,
  `Estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `ID_Categoria` int(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `ID_Chat` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL,
  `ID_Mensaje` int(10) NOT NULL,
  `Estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chat_mensaje`
--

CREATE TABLE `chat_mensaje` (
  `ID_Mensaje` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL,
  `Mensaje` varchar(100) NOT NULL,
  `Estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `ID_Comentario` int(10) NOT NULL,
  `ID_Publicacion` int(10) NOT NULL,
  `Comentario` varchar(100) NOT NULL,
  `Reacciones` int(10) NOT NULL,
  `Estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contenido_albun`
--

CREATE TABLE `contenido_albun` (
  `ID_Contenido_Alb` int(10) NOT NULL,
  `ID_Album` int(10) NOT NULL,
  `ID_Musica` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `musica`
--

CREATE TABLE `musica` (
  `ID_Musica` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Artista` varchar(20) NOT NULL,
  `Categorias` varchar(100) NOT NULL,
  `Album` varchar(20) NOT NULL,
  `Duracion` time NOT NULL,
  `Music_Path` varchar(50) NOT NULL,
  `Estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `ID_Post` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL,
  `Comentario` varchar(100) NOT NULL,
  `ID_Musica` int(10) DEFAULT NULL,
  `ID_Album` int(10) DEFAULT NULL,
  `Reacciones` int(10) NOT NULL,
  `Estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(10) NOT NULL,
  `Nombre_Usuario` varchar(20) DEFAULT NULL,
  `Correo` varchar(50) NOT NULL,
  `Contraseña` varchar(20) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Foto_Perfil` varchar(100) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `Followers` int(10) NOT NULL,
  `Following` int(10) NOT NULL,
  `Rol` int(1) NOT NULL,
  `Estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`ID_Album`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID_Chat`);

--
-- Indexes for table `chat_mensaje`
--
ALTER TABLE `chat_mensaje`
  ADD PRIMARY KEY (`ID_Mensaje`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`ID_Comentario`);

--
-- Indexes for table `contenido_albun`
--
ALTER TABLE `contenido_albun`
  ADD PRIMARY KEY (`ID_Contenido_Alb`);

--
-- Indexes for table `musica`
--
ALTER TABLE `musica`
  ADD PRIMARY KEY (`ID_Musica`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID_Post`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `ID_Album` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `ID_Comentario` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contenido_albun`
--
ALTER TABLE `contenido_albun`
  MODIFY `ID_Contenido_Alb` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `musica`
--
ALTER TABLE `musica`
  MODIFY `ID_Musica` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `ID_Post` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
