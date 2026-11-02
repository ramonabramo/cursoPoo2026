# Curso de Programación Orientada a Objetos con PHP (2026)

¡Bienvenido/a! Este repositorio contiene todo el material del curso: apuntes, ejemplos y ejercicios que iremos construyendo clase a clase, desde los primeros pasos con PHP hasta crear aplicaciones web con **Laravel**.

## Presentación

Soy **Ramon Abramo**, ingeniero de telecomunicaciones y programador. Trabajo como docente y administrador de sistemas, y en este curso quiero enseñarte a programar en PHP de la forma en que se hace hoy en proyectos reales: con código limpio, organizado y orientado a objetos.

No hace falta experiencia previa en PHP. Empezaremos por lo más básico (qué es un servidor web, qué hace PHP cuando abres una página) y avanzaremos paso a paso, con ejemplos pequeños que puedes ejecutar y modificar tú mismo/a.

## Objetivo del curso

Al terminar el curso serás capaz de:

1. **Entender cómo funciona la web**: cliente, servidor, peticiones y respuestas HTTP, y el papel de PHP en todo ello.
2. **Dominar los fundamentos de PHP**: variables, tipos, estructuras de control, funciones, arrays, formularios y sesiones.
3. **Programar con orientación a objetos**: clases, objetos, encapsulación, herencia, polimorfismo, interfaces, traits, namespaces y excepciones.
4. **Aplicar buenas prácticas**: principios SOLID, PSR, Composer y autoloading, y trabajo con bases de datos mediante PDO.
5. **Construir aplicaciones con Laravel**: rutas, controladores, modelos (Eloquent), vistas con Blade, migraciones y autenticación.

## Temario (previsto)

| Bloque | Contenido |
|--------|-----------|
| 01 | Introducción a PHP y a la programación web (`phpinfo`, formularios GET/POST) |
| 02 | Fundamentos de PHP: variables, tipos, operadores, control de flujo |
| 03 | Funciones y arrays |
| 04 | Formularios, validación y sesiones |
| 05 | Programación orientada a objetos: clases y objetos |
| 06 | Herencia, polimorfismo, interfaces y traits |
| 07 | Namespaces, Composer y autoloading |
| 08 | Bases de datos con PDO |
| 09 | Introducción a Laravel |
| 10 | Laravel: Eloquent, Blade, migraciones y autenticación |

> El temario puede ajustarse según el ritmo del grupo.

## Estructura del repositorio

```
cursoPoo2026/
├── README.md
├── 01-introduccion/     <- Primera clase: cómo funciona PHP y la web
└── ...                  <- Se irán añadiendo carpetas con cada clase
```

Cada carpeta contiene su propio `README.md` con la explicación de la clase y cómo ejecutar los ejemplos.

## Requisitos

- Un servidor local con PHP 8.1 o superior. Recomendado: [Laragon](https://laragon.org/) (Windows), o XAMPP / MAMP.
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
