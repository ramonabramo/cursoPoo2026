# Temario detallado

> Temario **previsto**: puede ajustarse según el ritmo del grupo. Cada bloque tendrá su carpeta con apuntes, ejemplos y ejercicios.

## Parte 0: Preparación

### 00. Entorno de desarrollo
- Instalación de Laragon 6, VS Code, Git y Composer
- Cambio de versión de PHP y MySQL en Laragon
- Primer proyecto y comprobación del entorno

## Parte 1: PHP desde cero

### 01. Introducción a PHP y a la programación web
- Cliente, servidor, HTTP: petición y respuesta
- Qué es PHP y cómo se ejecuta (`phpinfo`)
- Formularios GET y POST, `$_SERVER`
- Primera idea de seguridad: XSS y `htmlspecialchars`

### 02. Fundamentos del lenguaje
- Sintaxis, etiquetas, comentarios, `echo` y `print`
- Variables, constantes y tipos de datos
- Conversión de tipos, `null`, comparación estricta (`==` vs `===`)
- Operadores: aritméticos, comparación, lógicos, asignación, `??`, `?->`

### 03. Estructuras de control
- `if`, `else`, `elseif`, `switch` y `match`
- Bucles: `for`, `while`, `do while`, `foreach`
- `break`, `continue` y sintaxis alternativa para plantillas

### 04. Funciones
- Parámetros, valores por defecto y argumentos con nombre
- Tipado de parámetros y retorno, `declare(strict_types=1)`
- Ámbito de variables, paso por valor y por referencia
- Funciones anónimas, *closures* y *arrow functions*
- Funciones variádicas

### 05. Arrays y cadenas
- Arrays indexados, asociativos y multidimensionales
- Funciones de arrays: `array_map`, `array_filter`, `array_reduce`, ordenación…
- Desestructuración y operador *spread*
- Funciones de cadenas y expresiones regulares
- Fechas y horas con `DateTime`

### 06. Formularios, sesiones y archivos
- Validación y saneamiento de datos
- Subida de archivos
- Cookies y sesiones
- Lectura y escritura de ficheros (JSON, CSV)
- Redirecciones y patrón *Post/Redirect/Get*

### 07. Organización del código y errores
- `include`, `require` y reutilización de código
- Tipos de errores, `error_reporting` y registro de errores
- Depuración (`var_dump`, Xdebug)
- Introducción a las excepciones: `try`, `catch`, `finally`

## Parte 2: Programación orientada a objetos

### 08. Clases y objetos
- Conceptos: clase, objeto, propiedad, método
- Constructor y destructor, `$this`
- Visibilidad: `public`, `protected`, `private`
- Encapsulación: *getters* y *setters*
- Propiedades y métodos estáticos, constantes de clase
- Promoción de propiedades en el constructor y propiedades `readonly`

### 09. Herencia y polimorfismo
- Herencia, `extends`, `parent::`
- Clases y métodos abstractos, `final`
- Interfaces
- Polimorfismo
- Traits
- Enumeraciones (`enum`)

### 10. POO avanzada
- Métodos mágicos (`__toString`, `__get`, `__call`…)
- Clonación y comparación de objetos
- Enlace estático tardío (`static::`)
- Tipos *union*, *nullable* e *intersection*
- Excepciones personalizadas y jerarquía de excepciones

### 11. Namespaces, autoloading y Composer
- Namespaces y `use`
- Autoloading con `spl_autoload_register`
- Estándares PSR-1, PSR-4 y PSR-12
- Composer: `composer.json`, dependencias, `composer.lock`, scripts
- Uso de paquetes de terceros

### 12. Bases de datos con PDO
- Requisito: haber visto al menos los bloques S01 a S06 del itinerario de SQL
- Conexión con PDO y manejo de errores
- Consultas preparadas (evitar inyección SQL)
- CRUD completo
- Transacciones
- Patrones DAO y *Repository*

### 13. Buenas prácticas y patrones de diseño
- Principios SOLID, DRY y KISS
- Inyección de dependencias
- Patrones: *Singleton*, *Factory*, *Strategy*, *Observer*
- Pruebas unitarias con PHPUnit

## Itinerario paralelo: SQL con MySQL

> Se imparte a lo largo del curso, **antes de empezar PDO (bloque 12)**: lo ideal es empezar tras el bloque 03 o 04 e ir alternando con PHP. Va de lo más básico a consultas avanzadas, siempre con MySQL.

### S01. Introducción a las bases de datos
- Qué es una base de datos y modelo relacional: tablas, filas, columnas, claves
- Servidor y clientes MySQL (HeidiSQL, phpMyAdmin, línea de comandos)
- Crear y usar una base de datos, juegos de caracteres (`utf8mb4`)

### S02. Definición de datos (DDL)
- `CREATE`, `ALTER`, `DROP` y `TRUNCATE`
- Tipos de datos: numéricos, texto, fechas, `ENUM`, `JSON`
- Restricciones: `PRIMARY KEY`, `AUTO_INCREMENT`, `NOT NULL`, `UNIQUE`, `DEFAULT`, `CHECK`

### S03. Manipulación y consulta básica
- `INSERT`, `UPDATE` y `DELETE`
- `SELECT`: columnas, alias y `DISTINCT`
- Filtros con `WHERE`: operadores, `AND`/`OR`/`NOT`, `IN`, `BETWEEN`, `LIKE`, `IS NULL`
- `ORDER BY`, `LIMIT` y paginación

### S04. Funciones y expresiones
- Funciones de cadenas, numéricas y de fecha
- `CASE`, `IF`, `IFNULL` y `COALESCE`
- Conversión de tipos

### S05. Agregación y agrupación
- `COUNT`, `SUM`, `AVG`, `MIN`, `MAX`
- `GROUP BY` y `HAVING`
- Diferencia entre `WHERE` y `HAVING`

### S06. Diseño relacional y JOINs
- Diagramas entidad-relación y relaciones 1:1, 1:N y N:M
- Claves foráneas e integridad referencial
- Normalización (1FN, 2FN, 3FN)
- `INNER JOIN`, `LEFT JOIN`, `RIGHT JOIN`, `CROSS JOIN` y *self join*

### S07. Consultas avanzadas
- Subconsultas y subconsultas correlacionadas, `EXISTS`
- `UNION` y operaciones de conjuntos
- Expresiones de tabla comunes (`WITH`) y recursivas
- Funciones de ventana: `ROW_NUMBER`, `RANK`, `LAG`, `LEAD`, `SUM() OVER`
- Vistas

### S08. Transacciones, índices y rendimiento
- Transacciones y propiedades ACID, niveles de aislamiento
- Índices y análisis de consultas con `EXPLAIN`
- Optimización de consultas
- Motores de almacenamiento (InnoDB)

### S09. Programación en MySQL y administración
- Procedimientos almacenados y funciones
- *Triggers* y eventos
- Trabajo con `JSON` en MySQL
- Usuarios y privilegios
- Copias de seguridad y restauración (`mysqldump`), importación y exportación

## Parte 3: Construimos nuestro propio MVC

> Objetivo: construir paso a paso un pequeño *framework* MVC para entender cómo funcionan Laravel y cualquier otro framework por dentro.

### 14. Arquitectura MVC y *front controller*
- Qué es MVC y por qué se usa
- Estructura de carpetas del proyecto
- Punto de entrada único (`public/index.php`) y reescritura de URLs (`.htaccess`)

### 15. Router, peticiones y respuestas
- Clases `Request` y `Response`
- Router: rutas, métodos HTTP y parámetros dinámicos
- Gestión de errores 404 y 500

### 16. Controladores, vistas y modelos
- Controlador base
- Motor de vistas y *layouts*
- Modelo base con PDO (mini ORM)
- Configuración y variables de entorno (`.env`)

### 17. Servicios del framework
- Contenedor de inyección de dependencias
- Middleware
- Validación, sesiones y mensajes *flash*
- Autenticación sencilla
- Comparativa: qué parte de nuestro MVC equivale a cada pieza de Laravel

### 18. APIs REST con PHP puro
- JSON, códigos de estado HTTP y verbos REST
- API de ejemplo con nuestro MVC
- Probar la API con herramientas como Postman o `curl`

## Parte 4: Laravel 13

### 19. Primeros pasos con Laravel
- Instalación y estructura del proyecto
- Ciclo de vida de una petición
- Configuración y archivo `.env`
- Artisan y comandos básicos
- Frontend con Vite

### 20. Rutas y controladores
- Rutas básicas, con parámetros, nombradas y agrupadas
- Controladores y controladores de recurso
- *Route model binding*
- Rutas de la API y de la consola

### 21. Vistas con Blade
- Sintaxis y directivas de Blade
- *Layouts*, secciones y componentes
- Paso de datos a las vistas
- Recursos estáticos y Vite

### 22. Base de datos: migraciones, seeders y factories
- Configuración de la base de datos
- Migraciones y modificación de tablas
- *Seeders* y *factories*
- Query Builder

### 23. Eloquent ORM
- Modelos y convenciones
- CRUD con Eloquent
- Relaciones: uno a uno, uno a muchos, muchos a muchos
- Carga ansiosa (*eager loading*) y problema N+1
- *Scopes*, *accessors*, *mutators* y *casts*
- Borrado lógico (*soft deletes*)
- Paginación

### 24. Formularios y validación
- Peticiones (`Request`) y validación
- *Form Requests*
- Mensajes de error personalizados
- Protección CSRF
- Subida y almacenamiento de archivos

### 25. Autenticación y autorización
- Sesiones y autenticación
- *Starter kits* oficiales
- *Gates* y *policies*
- Roles y permisos

### 26. Arquitectura interna de Laravel
- Contenedor de servicios (*service container*)
- *Service providers*
- *Facades* y contratos
- Middleware
- Comparación con nuestro MVC

### 27. API REST con Laravel
- *API Resources*
- Autenticación de APIs (tokens)
- Versionado, paginación y gestión de errores
- Documentación de la API

### 28. Pruebas
- Pruebas unitarias y de funcionalidad (*feature tests*)
- Base de datos de pruebas
- *Factories* en los tests

### 29. Funcionalidades avanzadas
- Eventos y *listeners*
- Colas (*queues*) y *jobs*
- Correo electrónico y notificaciones
- Caché
- Tareas programadas (*scheduler*)
- Registros (*logs*) y manejo de excepciones

### 30. Proyecto final y despliegue
- Desarrollo de un proyecto completo en grupo o individual
- Buenas prácticas y revisión de código
- Preparación y despliegue en un servidor
