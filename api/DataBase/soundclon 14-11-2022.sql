-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 07:35 AM
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
-- Database: `soundclon`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `ID_Album` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL,
  `Nombre_Album` varchar(20) NOT NULL,
  `Img_Path` varchar(200) NOT NULL,
  `Fecha_Subida` date NOT NULL,
  `Estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`ID_Album`, `ID_Usuario`, `Nombre_Album`, `Img_Path`, `Fecha_Subida`, `Estatus`) VALUES
(1, 1, 'Monas Chinas', 'https://soundclon.000webhostapp.com/music_img/ずっと真夜中でいいのに。『こんなこと騒動』MV.png', '2022-10-19', 'A'),
(2, 1, 'Funki', 'https://soundclon.000webhostapp.com/music_img/ずっと真夜中でいいのに。『こんなこと騒動』MV.png', '2022-11-14', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `albums_usuario`
--

CREATE TABLE `albums_usuario` (
  `ID_Album` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albums_usuario`
--

INSERT INTO `albums_usuario` (`ID_Album`, `ID_Usuario`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `amigo`
--

CREATE TABLE `amigo` (
  `ID_Amigo` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amigo`
--

INSERT INTO `amigo` (`ID_Amigo`, `ID_Usuario`) VALUES
(1, 3),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `ID_Categoria` int(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`ID_Categoria`, `Nombre`, `Estatus`) VALUES
(1, 'hola', '0'),
(3, 'Reggaeton', '0'),
(4, 'prueba', '0'),
(5, 'prueba-herman', '0'),
(6, 'rock', '0'),
(7, 'Thrash Metal', '0'),
(8, 'pruba otra vez', '1'),
(9, 'rock2jy', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `ID_remitente` int(10) NOT NULL,
  `ID_destinatario` int(10) NOT NULL,
  `Mensaje` varchar(1000) NOT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`ID_remitente`, `ID_destinatario`, `Mensaje`, `Fecha`) VALUES
(1, 3, '', NULL),
(3, 1, '', NULL),
(1, 3, 'hola como estas?', '2022-11-07 00:19:19'),
(3, 1, 'bien depre carnal, perdio t1', '2022-11-07 00:19:51'),
(3, 1, 'sdfsd', '2022-11-07 01:16:26'),
(3, 1, 'Y el ggp es un pendejo por apostar por DRX', '2022-11-07 01:16:49'),
(3, 1, 'puto', '2022-11-07 01:21:34'),
(3, 1, 'el ggp es puto', '2022-11-07 22:50:06'),
(3, 4, 'el ggp es puto', '2022-11-07 22:51:45'),
(3, 1, 'asdfs', '2022-11-14 22:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `chat_mensaje`
--

CREATE TABLE `chat_mensaje` (
  `ID_Mensaje` int(10) NOT NULL,
  `Mensaje` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `ID_Comentario` int(10) NOT NULL,
  `ID_Publicacion` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `Comentario` varchar(100) NOT NULL,
  `fecha_comentario` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Reacciones` int(10) NOT NULL,
  `Estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comentario`
--

INSERT INTO `comentario` (`ID_Comentario`, `ID_Publicacion`, `id_usuario`, `Comentario`, `fecha_comentario`, `Reacciones`, `Estatus`) VALUES
(1, 1, 3, 'hola', '2022-10-17 06:45:24', 0, 'I');

-- --------------------------------------------------------

--
-- Table structure for table `lista_amigos`
--

CREATE TABLE `lista_amigos` (
  `ID_Amigos` int(10) NOT NULL,
  `ID_Amigo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lista_amigos`
--

INSERT INTO `lista_amigos` (`ID_Amigos`, `ID_Amigo`) VALUES
(1, 1),
(1, 4),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `musica`
--

CREATE TABLE `musica` (
  `ID_Musica` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `ID_Categoria` int(10) NOT NULL,
  `ID_Album` int(10) NOT NULL,
  `Img_Path` varchar(200) DEFAULT NULL,
  `Music_Path` varchar(200) NOT NULL,
  `Estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `musica`
--

INSERT INTO `musica` (`ID_Musica`, `ID_Usuario`, `Nombre`, `ID_Categoria`, `ID_Album`, `Img_Path`, `Music_Path`, `Estatus`) VALUES
(2, 3, 'ずっと真夜中でいいのに。『こんなこと騒動』MV', 1, 1, 'https://soundclon.000webhostapp.com/music_img/ずっと真夜中でいいのに。『こんなこと騒動』MV.png', 'https://soundclon.000webhostapp.com/musica/ずっと真夜中でいいのに。『こんなこと騒動』MV.mp3', '1'),
(3, 3, 'ずっと真夜中でいいのに。『残機』MV (ZUTOMAYO - Time Left)', 1, 1, 'https://soundclon.000webhostapp.com/music_img/ずっと真夜中でいいのに。『残機』MV (ZUTOMAYO - Time Left).png', 'https://soundclon.000webhostapp.com/musica/ずっと真夜中でいいのに。『残機』MV%20(ZUTOMAYO%20-%20Time%20Left).mp3', '1');

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
  `Estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`ID_Post`, `ID_Usuario`, `Comentario`, `ID_Musica`, `ID_Album`, `Reacciones`, `Estatus`) VALUES
(1, 1, 'Hola public', NULL, NULL, 4, 'I'),
(3, 4, 'hola como estan', 1, 1, 0, 'I');

-- --------------------------------------------------------

--
-- Table structure for table `reacciones_comentario`
--

CREATE TABLE `reacciones_comentario` (
  `id_usuario` int(10) NOT NULL,
  `id_comentario` int(10) NOT NULL,
  `fecha_reaccion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reacciones_publicacion`
--

CREATE TABLE `reacciones_publicacion` (
  `id_usuario` int(10) NOT NULL,
  `id_publicacion` int(10) NOT NULL,
  `fecha_reaccion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reacciones_publicacion`
--

INSERT INTO `reacciones_publicacion` (`id_usuario`, `id_publicacion`, `fecha_reaccion`) VALUES
(1, 1, '2022-10-17 06:27:07'),
(2, 1, '2022-10-19 05:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_rol` int(1) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_rol`, `descripcion`) VALUES
(1, 'usuario_comun'),
(2, 'admin'),
(3, 'usuario_comun'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(10) NOT NULL,
  `Nombre_Usuario` varchar(20) DEFAULT NULL,
  `Correo` varchar(50) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Foto_Perfil` varchar(100) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Followers` int(10) NOT NULL,
  `Following` int(10) NOT NULL,
  `Rol` int(1) NOT NULL,
  `Estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre_Usuario`, `Correo`, `Contraseña`, `Fecha_Nacimiento`, `Foto_Perfil`, `Descripcion`, `Followers`, `Following`, `Rol`, `Estatus`) VALUES
(1, 'axl.sl_', 'axeel_58@hotmail.com', '941c209cdd93ee6876bc2c40c51ad9dd21f38d85dc6a48add441ec25a3ae2ec5631f184823472c65b860ef23376b5c35bed47c2180581fbe1dd99ad423eede55', '2001-05-21', 'imagen.jpg', 'Soy jot0', 0, 0, 1, 'I'),
(3, 'chrisxd', 'chris_58@hotmail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2001-12-19', '/images/chris.jpg', 'holi, soy una prueba', 0, 0, 2, 'A'),
(4, 'Dylan2', 'correo_random@gmail.com', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', '2001-12-19', 'joto.jpg', 'joto', 0, 0, 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `usuariostoken`
--

CREATE TABLE `usuariostoken` (
  `id_usuario` int(10) NOT NULL,
  `token` varchar(1000) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuariostoken`
--

INSERT INTO `usuariostoken` (`id_usuario`, `token`, `fecha_creacion`, `estatus`) VALUES
(1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXNzYWdlIjoiXHUwMGExT3BlcmFjaW9uIGNvbiBFeGl0byEiLCJzdGF0dXMiOjIwMCwiZGF0YSI6eyJJRF9Vc3VhcmlvIjoiMSIsIkNvcnJlbyI6ImF4ZWVsXzU4QGhvdG1haWwuY29tIiwiTm9tYnJlX1VzdWFyaW8iOiJheGwuc2xfIiwiRmVjaGFfTmFjaW1pZW50byI6IjIwMDEtMDUtMjEiLCJGb3RvX1BlcmZpbCI6ImltYWdlbi5qcGciLCJEZXNjcmlwY2lvbiI6IlNveSBqb3QwIiwiRm9sbG93ZXJzIjoiMCIsIkZvbGxvd2luZyI6IjAiLCJSb2wiOiIxIn19.PAOoWiliuhIZWV-1af7VXa2cXfSMRq6r7djvaSb0f2U', '2022-10-18 15:40:41', 'A'),
(3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXNzYWdlIjoiXHUwMGExT3BlcmFjaW9uIGNvbiBFeGl0byEiLCJzdGF0dXMiOjIwMCwiZGF0YSI6eyJJRF9Vc3VhcmlvIjoiMyIsIkNvcnJlbyI6ImNocmlzXzU4QGhvdG1haWwuY29tIiwiTm9tYnJlX1VzdWFyaW8iOiJjaHJpc3hkIiwiRmVjaGFfTmFjaW1pZW50byI6IjIwMDEtMTItMTkiLCJGb3RvX1BlcmZpbCI6Ii9pbWFnZXMvY2hyaXMuanBnIiwiRGVzY3JpcGNpb24iOiJob2xpLCBzb3kgdW5hIHBydWViYSIsIkZvbGxvd2VycyI6IjAiLCJGb2xsb3dpbmciOiIwIiwiUm9sIjoiMiJ9fQ.Y2IiGvCZT4IhLy8oarqT6y5mVt7QfypXoi63tzf0FNA', '2022-11-07 06:29:28', 'A'),
(4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXNzYWdlIjoiXHUwMGExT3BlcmFjaW9uIGNvbiBFeGl0byEiLCJzdGF0dXMiOjIwMCwiZGF0YSI6eyJJRF9Vc3VhcmlvIjoiNCIsIkNvcnJlbyI6ImNvcnJlb19yYW5kb21AZ21haWwuY29tIiwiTm9tYnJlX1VzdWFyaW8iOiJEeWxhbjIiLCJGZWNoYV9OYWNpbWllbnRvIjoiMjAwMS0xMi0xOSIsIkZvdG9fUGVyZmlsIjoiam90by5qcGciLCJEZXNjcmlwY2lvbiI6ImpvdG8iLCJGb2xsb3dlcnMiOiIwIiwiRm9sbG93aW5nIjoiMCIsIlJvbCI6IjEifX0.Ml25q9M4vxhd-YQTeSBkv0zxCcST-5G5a4YrdUq_mkQ', '2022-10-19 05:52:15', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`ID_Album`);

--
-- Indexes for table `albums_usuario`
--
ALTER TABLE `albums_usuario`
  ADD PRIMARY KEY (`ID_Album`,`ID_Usuario`),
  ADD KEY `usuario_album` (`ID_Usuario`);

--
-- Indexes for table `amigo`
--
ALTER TABLE `amigo`
  ADD PRIMARY KEY (`ID_Amigo`,`ID_Usuario`),
  ADD KEY `usuario` (`ID_Usuario`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indexes for table `chat_mensaje`
--
ALTER TABLE `chat_mensaje`
  ADD PRIMARY KEY (`ID_Mensaje`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`ID_Comentario`),
  ADD KEY `fkusucom` (`id_usuario`),
  ADD KEY `fkpubcom` (`ID_Publicacion`);

--
-- Indexes for table `lista_amigos`
--
ALTER TABLE `lista_amigos`
  ADD PRIMARY KEY (`ID_Amigos`,`ID_Amigo`),
  ADD KEY `amigo` (`ID_Amigo`);

--
-- Indexes for table `musica`
--
ALTER TABLE `musica`
  ADD PRIMARY KEY (`ID_Musica`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID_Post`),
  ADD KEY `fkusupost` (`ID_Usuario`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `fkrole` (`Rol`);

--
-- Indexes for table `usuariostoken`
--
ALTER TABLE `usuariostoken`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `ID_Album` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `amigo`
--
ALTER TABLE `amigo`
  MODIFY `ID_Amigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_Categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `ID_Comentario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `musica`
--
ALTER TABLE `musica`
  MODIFY `ID_Musica` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `ID_Post` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_rol` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums_usuario`
--
ALTER TABLE `albums_usuario`
  ADD CONSTRAINT `album` FOREIGN KEY (`ID_Album`) REFERENCES `album` (`ID_Album`),
  ADD CONSTRAINT `usuario_album` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Constraints for table `amigo`
--
ALTER TABLE `amigo`
  ADD CONSTRAINT `usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Constraints for table `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fkpubcom` FOREIGN KEY (`ID_Publicacion`) REFERENCES `post` (`ID_Post`),
  ADD CONSTRAINT `fkusucom` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Constraints for table `lista_amigos`
--
ALTER TABLE `lista_amigos`
  ADD CONSTRAINT `amigo` FOREIGN KEY (`ID_Amigo`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `lista` FOREIGN KEY (`ID_Amigos`) REFERENCES `amigo` (`ID_Amigo`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fkusupost` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fkrole` FOREIGN KEY (`Rol`) REFERENCES `role` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
