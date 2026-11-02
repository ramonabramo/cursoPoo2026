# Curso de Programación Orientada a Objetos con PHP (2026)

¡Bienvenido/a! Este repositorio contiene todo el material del curso: apuntes, ejemplos y ejercicios que iremos construyendo clase a clase, desde los primeros pasos con PHP hasta crear aplicaciones web con **Laravel**.

## Presentación

Soy **Ramon Abramo**, ingeniero de telecomunicaciones y programador. Trabajo como docente y administrador de sistemas, y en este curso quiero enseñarte a programar en PHP de la forma en que se hace hoy en proyectos reales: con código limpio, organizado y orientado a objetos.

No hace falta experiencia previa en PHP. Empezaremos por lo más básico (qué es un servidor web, qué hace PHP cuando abres una página) y avanzaremos paso a paso, con ejemplos pequeños que puedes ejecutar y modificar tú mismo/a.

## Objetivo del curso

Al terminar el curso serás capaz de:

1. **Entender cómo funciona la web**: cliente, servidor, peticiones y respuestas HTTP, y el papel de PHP en todo ello.
2. **Dominar los fundamentos de PHP**: variables, tipos, estructuras de control, funciones, arrays, formularios, sesiones y ficheros.
3. **Programar con orientación a objetos**: clases, objetos, encapsulación, herencia, polimorfismo, interfaces, traits, enums, namespaces y excepciones.
4. **Aplicar buenas prácticas**: principios SOLID, estándares PSR, Composer, autoloading, pruebas y acceso a bases de datos con PDO.
5. **Construir nuestro propio framework MVC** en PHP para entender qué hay detrás de Laravel o de cualquier otro framework.
6. **Desarrollar aplicaciones completas con Laravel 13**: rutas, controladores, Blade, migraciones, Eloquent, validación, autenticación, APIs, pruebas y despliegue.

## Temario (previsto)

| Parte | Bloques | Contenido |
|-------|---------|-----------|
| 0. Preparación | 00 | Entorno: Laragon, versiones de PHP y MySQL |
| 1. PHP desde cero | 01 - 07 | Programación web, sintaxis, estructuras de control, funciones, arrays, formularios, sesiones, errores |
| 2. Programación orientada a objetos | 08 - 13 | Clases y objetos, herencia, interfaces, traits, namespaces, Composer, PDO, SOLID y patrones, PHPUnit |
| 3. Nuestro propio MVC | 14 - 18 | Front controller, router, controladores, vistas, modelos, contenedor DI, middleware y API REST |
| 4. Laravel 13 | 19 - 30 | Rutas, Blade, migraciones, Eloquent, validación, autenticación, arquitectura interna, API, pruebas, colas, proyecto final |

Consulta el **[temario detallado](TEMARIO.md)** con el contenido de cada bloque.

> El temario puede ajustarse según el ritmo del grupo.

## Estructura del repositorio

```
cursoPoo2026/
├── README.md
├── TEMARIO.md           <- Temario detallado del curso
├── 00-entorno/          <- Guía de instalación y configuración de Laragon
├── 01-introduccion/     <- Primera clase: cómo funciona PHP y la web
└── ...                  <- Se irán añadiendo carpetas con cada clase
```

Cada carpeta contiene su propio `README.md` con la explicación de la clase y cómo ejecutar los ejemplos.

## Requisitos

- **Laragon 6.0** (Windows): la última versión sin licencia de pago. Incluye Apache, MySQL y Composer.
- **PHP 8.3 o superior en versión NTS** (requisito de Laravel 13).
- [Node.js](https://nodejs.org/) (versión LTS) para el frontend de Laravel (Vite).
- Un editor de código: [Visual Studio Code](https://code.visualstudio.com/) con la extensión *PHP Intelephense*.
- [Git](https://git-scm.com/) para descargar el material.
- Un navegador moderno (Chrome, Firefox o Edge) con las herramientas de desarrollador.

## Cómo usar este repositorio

```bash
# Con Laragon, clona dentro de la carpeta www
cd C:\laragon\www
git clone https://github.com/ramonabramo/cursoPoo2026.git
```

Después abre en el navegador `http://localhost/cursoPoo2026/01-introduccion/` y sigue el índice.

Para actualizar el material en cada clase:

```bash
git pull
```

## Cómo trabajar durante el curso

- **Escribe el código tú mismo/a**, no copies y pegues: así se aprende.
- **Modifica los ejemplos**, rómpelos y arréglalos. Es la mejor forma de entenderlos.
- **Pregunta** cualquier duda, por básica que parezca.

¡Empezamos!
