<?php
require_once 'config.php';
/*Se establece una conexión a la base de datos utilizando PDO con las constantes definidas en config.php.*/
class Model {
    protected $db;

    function __construct() {
        $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
        if ($this->db) {
            $this->createDatabaseSiNoExiste();
            $this->db->exec('USE ' . MYSQL_DB);
            $this->deploy();
        }
    }
    
/*Verifica si la base de datos especificada existe, si no, la crea con el conjunto de caracteres y la colación especificados.*/

    function createDatabaseSiNoExiste() {
        $databaseName = MYSQL_DB;
        $query = "CREATE DATABASE IF NOT EXISTS `$databaseName` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
        $this->db->exec($query);
    }

/*Comprueba si ya hay tablas en la base de datos. Si no hay tablas, ejecuta el código SQL que crea las tablas y las llena con datos iniciales. */
    function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        $w3OUohfKw28vCSrxTHN0Su7dk1xGIJZ='$w3OUohfKw28vCSrxTHN0Su7dk1xGIJZ';

        if (count($tables) == 0) {
            $sql = <<<END
            
            --
            -- Estructura de tabla para la tabla `categorias`
            --

            CREATE TABLE `categorias` (
                `categoriaID` int(11) NOT NULL,
                `nombre` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `categorias`
            --

            INSERT INTO `categorias` (`categoriaID`, `nombre`) VALUES
            (1, 'Frutas'),
            (2, 'Verduras'),
            (3, 'Carnes'),
            (4, 'Lácteos');

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `productos`
            --

            CREATE TABLE `productos` (
                `id` int(11) NOT NULL,
                `categoriaID` int(11) NOT NULL,
                `producto` varchar(200) NOT NULL,
                `precio` double NOT NULL,
                `stock` tinyint(1) NOT NULL DEFAULT 1
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `productos`
            --

            INSERT INTO `productos` (`id`, `categoriaID`, `producto`, `precio`, `stock`) VALUES
            (1, 2, 'Lechuga', 1000, 10),
            (2, 1, 'Manzana', 200, 10),
            (3, 1, 'Banana', 500, 5),
            (4, 3, 'Hamburguesa', 3000, 20),
            (5, 3, 'Salchichas', 2000, 5),
            (6, 4, 'Leche', 1000, 20),
            (7, 4, 'Queso', 2000, 15);

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `users`
            --

            CREATE TABLE `users` (
                `id` int(11) NOT NULL,
                `user` varchar(250) NOT NULL,
                `password` varchar(250) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `users`
            --

            INSERT INTO `users` (`id`, `user`, `password`) VALUES
            (0, 'webadmin', '2a$12$5s10NiQMYSiqSCUVdnQQLO9FtQRzea2ZJBjHSB6jz4/JoPS7rjPl2');

            -- --------------------------------------------------------

            -- Índices para tablas volcadas
            --

            -- Indices de la tabla `categorias`
            ALTER TABLE `categorias`
                ADD PRIMARY KEY (`categoriaID`);

            -- Indices de la tabla `productos`
            ALTER TABLE `productos`
                ADD PRIMARY KEY (`id`),
                ADD KEY `categoriaID` (`categoriaID`);

            -- Indices de la tabla `users`
            ALTER TABLE `users`
                ADD PRIMARY KEY (`id`);

            -- AUTO_INCREMENT de las tablas volcadas
            --

            -- AUTO_INCREMENT de la tabla `categorias`
            ALTER TABLE `categorias`
                MODIFY `categoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

            -- AUTO_INCREMENT de la tabla `productos`
            ALTER TABLE `productos`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

            -- Restricciones para tablas volcadas
            --

            -- Filtros para la tabla `productos`
            ALTER TABLE `productos`
                ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoriaID`) REFERENCES `categorias` (`categoriaID`);

            COMMIT;
            END;
            $this->db->query($sql);
        }
    }
}
