# Guía del entorno de desarrollo (Laragon)

Antes de la primera clase necesitas tener instalado el entorno de trabajo. En este curso usamos **Laragon** (Windows), que incluye Apache/Nginx, PHP, MySQL y Composer en un solo paquete.

## 1. Instalación

1. Descarga **Laragon Full** desde <https://laragon.org/download/> y ejecuta el instalador (ruta por defecto: `C:\laragon`).
2. Abre Laragon y pulsa **Iniciar todo**. Deben aparecer Apache y MySQL en marcha.
3. Abre el navegador en `http://localhost`: verás la página de bienvenida.
4. Instala [Visual Studio Code](https://code.visualstudio.com/) y la extensión **PHP Intelephense**.
5. Instala [Git](https://git-scm.com/).

Tus proyectos van en `C:\laragon\www`. Para este curso:

```bash
cd C:\laragon\www
git clone https://github.com/ramonabramo/cursoPoo2026.git
```

Y ábrelo en `http://localhost/cursoPoo2026/01-introduccion/`.

## 2. Comprobar qué versiones estás usando

En una terminal de Laragon (**Menú → Terminal**, o el botón *Terminal*):

```bash
php -v
mysql --version
composer --version
```

También puedes verlo en el navegador con el ejemplo de `phpinfo` de la clase 1 (la versión aparece arriba del todo).

## 3. Cambiar la versión de PHP

**Cambiar entre versiones ya instaladas**

1. Clic derecho sobre el icono de Laragon (o botón **Menu**).
2. **PHP → Versión** y elige la que quieras.
3. Laragon reinicia Apache automáticamente. Comprueba el cambio con `php -v` en una terminal **nueva** o con `phpinfo()`.

**Añadir una versión nueva de PHP**

1. Descarga la versión que necesites (zip, **Thread Safe**, x64) desde <https://windows.php.net/download/>.
2. Extrae el contenido en una carpeta nueva dentro de `C:\laragon\bin\php\`. Ejemplo: `C:\laragon\bin\php\php-8.3.12-Win32-vs16-x64\` (el `php.exe` debe quedar directamente dentro de esa carpeta).
3. Reinicia Laragon, o vuelve a abrir el menú.
4. Selecciona la nueva versión en **Menú → PHP → Versión**.

> Si cambias de versión y alguna extensión falla (por ejemplo `pdo_mysql` o `mbstring`), activa en **Menú → PHP → Extensiones** las que necesites. Cada versión de PHP tiene su propio `php.ini`: **Menú → PHP → php.ini**.

**¿Qué versión usaremos?** PHP 8.2 o superior. Laravel exige una versión mínima de PHP según su versión (consulta la documentación oficial de Laravel antes de empezar esa parte).

## 4. Cambiar la versión de MySQL

**Cambiar entre versiones ya instaladas**

1. **Menú → MySQL → Versión** y elige la que quieras.
2. Laragon detiene el servicio y arranca la versión elegida.

**Añadir una versión nueva de MySQL (o MariaDB)**

1. Descarga el zip de MySQL desde <https://dev.mysql.com/downloads/mysql/> (*Windows (x86, 64-bit), ZIP Archive*).
2. Extrae el contenido en una carpeta nueva dentro de `C:\laragon\bin\mysql\`. Ejemplo: `C:\laragon\bin\mysql\mysql-8.4.0-winx64\`.
3. Reinicia Laragon y selecciónala en **Menú → MySQL → Versión**.

> **Importante: los datos no se migran solos.** Cada versión usa su propia carpeta de datos (`C:\laragon\data\mysql-X`), así que al cambiar de versión **verás las bases de datos vacías**. Si quieres llevar tus bases de datos a otra versión:
>
> 1. Con la versión antigua activa, exporta: `mysqldump -u root -p --all-databases > copia.sql`
> 2. Cambia a la versión nueva.
> 3. Importa: `mysql -u root -p < copia.sql`

## 5. Problemas habituales

| Problema | Solución |
|----------|----------|
| `php -v` sigue mostrando la versión antigua | Cierra y abre de nuevo la terminal, o usa la de Laragon |
| El puerto 80 o 3306 está ocupado | Cierra Skype/IIS u otro MySQL instalado, o cambia el puerto en **Menú → Preferencias → Servicios y puertos** |
| Apache no arranca tras cambiar de PHP | Revisa que la carpeta de PHP sea *Thread Safe* y contenga `php.exe` directamente |
| Falta una extensión | **Menú → PHP → Extensiones** |
| Las bases de datos han desaparecido | Estás en otra versión de MySQL: vuelve a la anterior o importa un volcado |

## Lista de comprobación para el primer día

- [ ] Laragon arranca y `http://localhost` funciona
- [ ] `php -v` muestra PHP 8.2 o superior
- [ ] MySQL arranca correctamente
- [ ] VS Code abre la carpeta del curso
- [ ] `git clone` del repositorio hecho
