-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-10-2022 a las 03:37:22
-- Versión del servidor: 10.5.16-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id19727003_soundclon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `album`
--

CREATE TABLE `album` (
  `ID_Album` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL,
  `Nombre_Album` varchar(20) NOT NULL,
  `Fecha_Subida` date NOT NULL,
  `Duracion` time NOT NULL,
  `Estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `album`
--

INSERT INTO `album` (`ID_Album`, `ID_Usuario`, `Nombre_Album`, `Fecha_Subida`, `Duracion`, `Estatus`) VALUES
(1, 1, 'tryhard', '2022-10-19', '03:30:00', 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_Categoria` int(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
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
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `ID_remitente` int(10) NOT NULL,
  `ID_destinatario` int(10) NOT NULL,
  `ID_Mensaje` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_mensaje`
--

CREATE TABLE `chat_mensaje` (
  `ID_Mensaje` int(10) NOT NULL,
  `Mensaje` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
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
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`ID_Comentario`, `ID_Publicacion`, `id_usuario`, `Comentario`, `fecha_comentario`, `Reacciones`, `Estatus`) VALUES
(1, 1, 3, 'hola', '2022-10-17 06:45:24', 0, 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido_albun`
--

CREATE TABLE `contenido_albun` (
  `ID_Album` int(10) NOT NULL,
  `ID_Musica` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `musica`
--

CREATE TABLE `musica` (
  `ID_Musica` int(10) NOT NULL,
  `ID_Usuario` int(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `ID_Categoria` int(10) NOT NULL,
  `ID_Album` int(10) NOT NULL,
  `Duracion` time NOT NULL,
  `Music_Path` varchar(50) NOT NULL,
  `Estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
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
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`ID_Post`, `ID_Usuario`, `Comentario`, `ID_Musica`, `ID_Album`, `Reacciones`, `Estatus`) VALUES
(1, 1, 'Hola public', NULL, NULL, 4, 'I'),
(3, 4, 'hola como estan', 1, 1, 0, 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reacciones_comentario`
--

CREATE TABLE `reacciones_comentario` (
  `id_usuario` int(10) NOT NULL,
  `id_comentario` int(10) NOT NULL,
  `fecha_reaccion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reacciones_publicacion`
--

CREATE TABLE `reacciones_publicacion` (
  `id_usuario` int(10) NOT NULL,
  `id_publicacion` int(10) NOT NULL,
  `fecha_reaccion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reacciones_publicacion`
--

INSERT INTO `reacciones_publicacion` (`id_usuario`, `id_publicacion`, `fecha_reaccion`) VALUES
(1, 1, '2022-10-17 06:27:07'),
(2, 1, '2022-10-19 05:11:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id_rol` int(1) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id_rol`, `descripcion`) VALUES
(1, 'usuario_comun'),
(2, 'admin'),
(3, 'usuario_comun'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
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
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre_Usuario`, `Correo`, `Contraseña`, `Fecha_Nacimiento`, `Foto_Perfil`, `Descripcion`, `Followers`, `Following`, `Rol`, `Estatus`) VALUES
(1, 'axl.sl_', 'axeel_58@hotmail.com', '941c209cdd93ee6876bc2c40c51ad9dd21f38d85dc6a48add441ec25a3ae2ec5631f184823472c65b860ef23376b5c35bed47c2180581fbe1dd99ad423eede55', '2001-05-21', 'imagen.jpg', 'Soy jot0', 0, 0, 1, 'I'),
(3, 'chrisxd', 'chris_58@hotmail.com', '607b1f885597867c5404315763afdc533362d02f79c8ba4f92af2488f245307a70aeff33bcbfd2c9156e1da11743ba4072950b78973c9c436919288c89c24071', '2001-12-19', '/images/chris.jpg', 'holi, soy una prueba', 0, 0, 1, 'A'),
(4, 'Dylan2', 'correo_random@gmail.com', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', '2001-12-19', 'joto.jpg', 'joto', 0, 0, 1, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariostoken`
--

CREATE TABLE `usuariostoken` (
  `id_usuario` int(10) NOT NULL,
  `token` varchar(1000) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuariostoken`
--

INSERT INTO `usuariostoken` (`id_usuario`, `token`, `fecha_creacion`, `estatus`) VALUES
(1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXNzYWdlIjoiXHUwMGExT3BlcmFjaW9uIGNvbiBFeGl0byEiLCJzdGF0dXMiOjIwMCwiZGF0YSI6eyJJRF9Vc3VhcmlvIjoiMSIsIkNvcnJlbyI6ImF4ZWVsXzU4QGhvdG1haWwuY29tIiwiTm9tYnJlX1VzdWFyaW8iOiJheGwuc2xfIiwiRmVjaGFfTmFjaW1pZW50byI6IjIwMDEtMDUtMjEiLCJGb3RvX1BlcmZpbCI6ImltYWdlbi5qcGciLCJEZXNjcmlwY2lvbiI6IlNveSBqb3QwIiwiRm9sbG93ZXJzIjoiMCIsIkZvbGxvd2luZyI6IjAiLCJSb2wiOiIxIn19.PAOoWiliuhIZWV-1af7VXa2cXfSMRq6r7djvaSb0f2U', '2022-10-18 15:40:41', 'A'),
(3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXNzYWdlIjoiXHUwMGExT3BlcmFjaW9uIGNvbiBFeGl0byEiLCJzdGF0dXMiOjIwMCwiZGF0YSI6eyJJRF9Vc3VhcmlvIjozLCJDb3JyZW8iOiJjaHJpc181OEBob3RtYWlsLmNvbSIsIk5vbWJyZV9Vc3VhcmlvIjoiY2hyaXN4ZCIsIkZlY2hhX05hY2ltaWVudG8iOiIyMDAxLTEyLTE5IiwiRm90b19QZXJmaWwiOiIvaW1hZ2VzL2NocmlzLmpwZyIsIkRlc2NyaXBjaW9uIjoiaG9saSwgc295IHVuYSBwcnVlYmEiLCJGb2xsb3dlcnMiOjAsIkZvbGxvd2luZyI6MCwiUm9sIjoxfX0.aCwMCryPyZ3pR-3I59EMF1Z_yaKc-8zxn781KyIiz7Y', '2022-10-17 00:11:08', 'A'),
(4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXNzYWdlIjoiXHUwMGExT3BlcmFjaW9uIGNvbiBFeGl0byEiLCJzdGF0dXMiOjIwMCwiZGF0YSI6eyJJRF9Vc3VhcmlvIjoiNCIsIkNvcnJlbyI6ImNvcnJlb19yYW5kb21AZ21haWwuY29tIiwiTm9tYnJlX1VzdWFyaW8iOiJEeWxhbjIiLCJGZWNoYV9OYWNpbWllbnRvIjoiMjAwMS0xMi0xOSIsIkZvdG9fUGVyZmlsIjoiam90by5qcGciLCJEZXNjcmlwY2lvbiI6ImpvdG8iLCJGb2xsb3dlcnMiOiIwIiwiRm9sbG93aW5nIjoiMCIsIlJvbCI6IjEifX0.Ml25q9M4vxhd-YQTeSBkv0zxCcST-5G5a4YrdUq_mkQ', '2022-10-19 05:52:15', 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`ID_Album`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indices de la tabla `chat_mensaje`
--
ALTER TABLE `chat_mensaje`
  ADD PRIMARY KEY (`ID_Mensaje`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`ID_Comentario`),
  ADD KEY `fkusucom` (`id_usuario`),
  ADD KEY `fkpubcom` (`ID_Publicacion`);

--
-- Indices de la tabla `musica`
--
ALTER TABLE `musica`
  ADD PRIMARY KEY (`ID_Musica`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID_Post`),
  ADD KEY `fkusupost` (`ID_Usuario`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `fkrole` (`Rol`);

--
-- Indices de la tabla `usuariostoken`
--
ALTER TABLE `usuariostoken`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `album`
--
ALTER TABLE `album`
  MODIFY `ID_Album` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_Categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `ID_Comentario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `musica`
--
ALTER TABLE `musica`
  MODIFY `ID_Musica` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `ID_Post` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id_rol` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fkpubcom` FOREIGN KEY (`ID_Publicacion`) REFERENCES `post` (`ID_Post`),
  ADD CONSTRAINT `fkusucom` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fkusupost` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fkrole` FOREIGN KEY (`Rol`) REFERENCES `role` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
