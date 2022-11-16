-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-10-2022 a las 03:28:56
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authors`
--

CREATE TABLE `authors` (
  `id_author` int(11) NOT NULL,
  `namename` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `bio` varchar(250) NOT NULL,
  `image` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `authors`
--

INSERT INTO `authors` (`id_author`, `namename`, `age`, `bio`, `image`) VALUES
(1, 'J K Rowling', 45, 'Es una escritora, productora de cine y guionista británica, conocida por ser la autora de la serie de libros Harry Potter, que han superado los quinientos millones de ejemplares vendidos.', 'img/634dee4fda3592.60230400.jpg'),
(2, 'Stephen King', 47, 'Es un escritor estadounidense de novelas de terror, ficción sobrenatural, misterio, ciencia ficción y literatura fantástica.', 'img/634ded1739bb85.35281370.jpeg'),
(3, 'Julio Cortazar', 62, 'Julio Florencio Cortázar fue un escritor y traductor argentino; este último oficio lo desempeñó para la Unesco y varias editoriales.​', 'img/634dee059ddd97.17138456.jpeg'),
(12, 'Edgar Allan Poe', 98, 'Reconocido como uno de los maestros universales del relato corto, del cual fue uno de los primeros practicantes en su país. Fue renovador de la novela gótica, recordado especialmente por sus cuentos de terror.', 'img/634e00a96e8c08.15886825.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `books`
--

CREATE TABLE `books` (
  `id_book` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `descrip` varchar(200) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `books`
--

INSERT INTO `books` (`id_book`, `title`, `genre`, `descrip`, `id_author`) VALUES
(5, 'El Resplandor 2', 'Terror', 'Jack Torrance se convierte en cuidador de invierno en el Hotel Overlook, en Colorado, con la esperanza de vencer su bloqueo con la escritura. Se instala allí junto con su esposa, Wendy, y su hijo.', 2),
(6, 'Carrie', 'Terror', 'Atormentada por sus compañeros y sobreprotegida por una madre fanática religiosa, una adolescente tímida desarrolla poderes sobrenaturales cuando una broma pesada la humilla especialmente.', 2),
(7, 'La Noche Boca Arriba', 'Aventura', 'El conflicto planteado es el misterio que existe en relación al supuesto sueño del personaje.', 3),
(8, 'Bestiario', 'Aventura', 'El sometimiento de cada movimiento del ser humano por parte de una fuerza extraña, representada en el cuento por un tigre.', 3),
(9, 'Harry Potter 2', 'Ficción', 'Harry Potter y los estudiantes de segundo año investigan una malévola amenaza para sus compañeros de clases de Hogwarts.', 1),
(10, 'El Visitante 2', 'Terror', 'En la ciudad ficticia de Oklahoma, el detective de la policía Ralph Anderson arresta al entrenador de béisbol Maitland frente a una multitud de espectadores, acusándolo de matar a un niño de 11 años.', 2),
(11, 'Harry Potter 3', 'Ficción', 'El tercer año de estudios de Harry en Hogwarts se ve amenazado por la fuga de Sirius Black de la prisión de Azkaban.', 1),
(12, 'El Gato Negro', 'Terror', 'Un clásico de la literatura de terror, narra la historia de un hombre que enloquece ante la presencia de un gato negro.', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `id_rol`) VALUES
(2, 'Gaspar', 'gasparshch@gmail.com', '$2y$10$PqVJ8dyNFkoeyczipzPtveoKdYCiRP3pcX.qCA9WvYXdcNY1Hrk4u', 2),
(4, 'Juan', 'juan@juan.com', '$2y$10$KAYE.VlFELCkrAD0cb3Kv.w0ws9XEJ/hA8/rYLgtNEsXQY6KHnYv.', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`);

--
-- Indices de la tabla `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `id_autor` (`id_author`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `authors`
--
ALTER TABLE `authors`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `books`
--
ALTER TABLE `books`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `id_autor` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id_author`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
