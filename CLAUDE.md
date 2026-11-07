# Normas del curso cursoPoo2026

Curso de PHP y POO de Ramón Abramo (Alpe Formación, Santander) para alumnado con pocos conocimientos de programación. Los materiales se escriben en español de España, con la voz docente de Ramón (primera persona del singular y trato de «vosotros»).

## Estilo del código de los ejemplos y soluciones

- **Sangrado** de 4 espacios en todo el código PHP y en el HTML de las plantillas.
- **camelCase** para variables, funciones, métodos, propiedades y claves que inventemos (`$precioTotal`, `calcularMedia()`).
  - Excepciones: las **clases**, interfaces, traits y enums empiezan por mayúscula (`PascalCase`: `Producto`, `CarritoCompra`); las **constantes** van en mayúsculas (`IVA`, `MAX_INTENTOS`), que es la convención de PHP.
- `declare(strict_types=1);` como primera instrucción desde la clase 9.
- En **SQL**, tablas y columnas en minúsculas con guion bajo (`curso_id`, `fecha_alta`), que es la convención de MySQL y de Laravel; en PHP se siguen nombrando en camelCase (`$cursoId`). Siempre consultas preparadas con marcadores con nombre (`:id`).
- **Estructura de un programa**, siempre que el ejemplo lo permita (en los ejemplos muy sencillos no hace falta):
  1. Clases (si están en el mismo fichero), o su carga con `require_once` al principio. Más adelante, en el bloque de Composer, se explica la autocarga.
  2. Funciones.
  3. Inicialización de variables globales.
  4. Entradas (`$_GET`, `$_POST`, `$_FILES`, `$_SESSION`, ficheros…).
  5. Procesamiento.
  6. Salidas (HTML o `echo`).
- **No** se ponen comentarios con los nombres de esas secciones: simplemente se sigue el orden. Los comentarios explican lo que pueda costar entender.
- `header()` y `exit` van en el procesamiento, antes de cualquier salida.

## Materiales de cada clase

Cada clase vive en `clase-NN-nombre/` con:

- `README.md`: apuntes de la clase. Termina con `### Fuentes y Documentación Oficial`.
- `ejemplos/`: los ejemplos de la explicación, numerados.
- `soluciones/`: una solución de cada ejercicio.
- En las clases de proyecto (como la 15), una carpeta `proyecto/` con la aplicación completa en lugar de `ejemplos/`.
- `clase-NN-nombre.pdf`: los apuntes en PDF, generados a partir del `README.md`.

## Generar los PDF

Los PDF se generan desde los README con el script de la carpeta `pdf/`:

```bash
python3 pdf/generar_pdf.py clase-07-datos-y-operadores
```

- Portada (título de la clase, Alpe Formación y Ramón Abramo), menú en cuadrícula con enlaces a cada punto y marcadores del PDF.
- Títulos con emojis y avatares del profesor; el código se muestra en ventanas al estilo macOS (tipo CodeSnap).
- Requisitos: `pip install markdown pygments`, la fuente Noto Color Emoji y Playwright con Chromium.
- Tras modificar un `README.md`, hay que volver a generar su PDF.

## Commits y pull requests

- Los mensajes de commit se redactan como si los escribiera el autor del curso: describen el cambio, sin mencionar instrucciones recibidas ni añadir líneas de coautoría o de sesión.
- Los pull requests igual: título y descripción del cambio, sin pie de «Generated with Claude Code» ni enlaces a la sesión.
