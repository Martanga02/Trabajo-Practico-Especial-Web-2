-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2024 a las 20:44:49
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
-- Base de datos: `almacen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_Categoría` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Descripción` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_Categoría`, `Nombre`, `Descripción`) VALUES
(1, 'Verduras', 'Las verduras son alimentos de origen vegetal indispensables para una buena alimentación y nutrición '),
(2, 'Frutas', 'Las frutas son productos alimenticios comestibles que se obtienen de plantas o árboles y que se cara'),
(3, 'Lacteos', 'Los productos lácteos como la leche, el yogur y el queso, son alimentos de elevada densidad nutricio'),
(4, 'Carnes', 'Carne es todo tejido muscular de los animales que se utiliza para la alimentación humana, así como l');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_Producto` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Descripción` varchar(100) NOT NULL,
  `Precio` double NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `ID_Categoría` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Producto`, `Nombre`, `Descripción`, `Precio`, `Cantidad`, `ID_Categoría`) VALUES
(1, 'Lechuga', 'La lechuga es una planta anual de la familia Asteraceae. Se cultiva sobre todo como verdura de hoja,', 1000, 10, 1),
(2, 'Tomate', 'El tomate es una especie de planta herbácea. Es una planta de importancia global por su uso como ali', 500, 5, 1),
(3, 'Zanahoria', 'La zanahoria silvestre o carrota es una especie de planta herbácea de la familia Apiaceae. Es la for', 200, 4, 1),
(4, 'Manzana', 'Es una fruta pomácea de forma redonda y sabor dulce o agrio. Los manzanos se cultivan en todo el mun', 200, 10, 2),
(5, 'Banana', 'La banana, ​ conocida también como banano, plátano, ​ guineo maduro, guineo, cambur gualele o minimo', 500, 5, 2),
(6, 'Kiwi', 'El kiwi, kivi​ o quivi​ es la baya de la enredadera Actinidia deliciosa. Es originaria de una gran á', 200, 10, 2),
(7, 'Leche', 'La leche es una secreción nutritiva de color blanquecino opaco producida por las células secretoras ', 1000, 20, 3),
(8, 'Queso', 'El queso es un derivado lácteo que se obtiene por maduración de la cuajada de la leche una vez elimi', 2000, 15, 3),
(9, 'Yogur', 'El yogur​ ​ es un producto lácteo obtenido mediante la fermentación de la leche​ por medio de bacter', 1000, 10, 3),
(10, 'Hamburguesa', 'Una hamburguesa es un emparedado que contiene, generalmente, carne picada o de origen vegetal, ​ agl', 3000, 20, 4),
(11, 'Salchichas', 'Las salchichas son embutidos a base de carne picada. Para la elaboración se suelen aprovechar partes', 2000, 5, 4),
(12, 'Milanesas', 'La milanesa es un filete, normalmente de carne vacuna, pero también puede ser con pollo o cordero, e', 1000, 10, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_Categoría`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `ID_Categoría` (`ID_Categoría`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_Categoría` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `ID_Categoría` FOREIGN KEY (`ID_Categoría`) REFERENCES `categoria` (`ID_Categoría`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
