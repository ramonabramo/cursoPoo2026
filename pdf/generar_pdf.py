#!/usr/bin/env python3
"""Genera el PDF de una clase del curso a partir de su README.md.

Uso:
    python3 pdf/generar_pdf.py clase-07-datos-y-operadores [clase-08-... ...]
    python3 pdf/generar_pdf.py --todas

Requisitos: pip install markdown pygments, fuente Noto Color Emoji y Playwright (Node) con Chromium.
"""

import html
import re
import subprocess
import sys
from pathlib import Path

import markdown
from pygments import highlight
from pygments.formatters import HtmlFormatter
from pygments.lexers import get_lexer_by_name
from pypdf import PdfWriter

RAIZ = Path(__file__).resolve().parent.parent
CARPETA_PDF = RAIZ / "pdf"
REPO_WEB = "https://github.com/ramonabramo/cursoPoo2026/blob/main/"

# Emoji que acompaña a cada avatar en los títulos y en el menú
EMOJI_AVATAR = {
    "hola": "👋", "ok": "👌", "bien": "👍", "genial": "🚀", "pensando": "🤔",
    "curioso": "🔍", "explica": "📘", "error": "🐞", "atencion": "⚠️", "sorpresa": "😮",
}

# Tipo de recuadro según el emoji con el que empieza una cita (>)
TIPOS_AVISO = [
    (("⚠️", "⚠", "😱", "😅", "😬"), "aviso", "atencion"),
    (("🚫", "🛡️", "🔐", "💥"), "peligro", "error"),
    (("💡",), "idea", "explica"),
    (("🎯",), "consejo", "ok"),
    (("🏆",), "reto", "genial"),
    (("📌", "🌱"), "nota", "curioso"),
]


def slug(texto: str) -> str:
    texto = re.sub(r"[^\w\s-]", "", texto.lower())
    return re.sub(r"\s+", "-", texto.strip())


def enlace_absoluto(url: str, carpeta: str) -> str:
    """Convierte los enlaces relativos del README en enlaces a GitHub."""
    if url.startswith(("http://", "https://", "mailto:", "#")):
        return url
    ruta = (Path(carpeta) / url).as_posix()
    partes = []
    for trozo in ruta.split("/"):
        if trozo == "..":
            if partes:
                partes.pop()
        elif trozo not in ("", "."):
            partes.append(trozo)
    return REPO_WEB + "/".join(partes)


def elegir_lexer(lenguaje: str, codigo: str):
    lenguaje = (lenguaje or "text").lower()
    if lenguaje == "php":
        tiene_html = re.search(r"^\s*<(?!\?)[a-zA-Z!/]", codigo, re.M) is not None
        if tiene_html or not codigo.lstrip().startswith("<?php"):
            if tiene_html:
                return get_lexer_by_name("html+php")
            return get_lexer_by_name("php", startinline=True)
        return get_lexer_by_name("php")
    try:
        return get_lexer_by_name(lenguaje)
    except Exception:
        return get_lexer_by_name("text")


def ventana_codigo(codigo: str, lenguaje: str, archivo: str, proyecto: str) -> str:
    """Bloque de código con aspecto de ventana de macOS (estilo CodeSnap)."""
    lenguaje = (lenguaje or "text").lower()
    resaltado = highlight(codigo, elegir_lexer(lenguaje, codigo), HtmlFormatter(nowrap=True))
    lineas = resaltado.rstrip("\n").split("\n")
    numeros = "\n".join(str(i) for i in range(1, len(lineas) + 1))
    if lenguaje in ("text", "txt", ""):
        titulo = "Esquema"
        pestana = ""
        clase = " esquema"
    else:
        icono = {"php": "🐘", "html": "🌐", "json": "🧾", "bash": "⌨️", "sql": "🐬"}.get(lenguaje, "📄")
        titulo = f"{html.escape(archivo)} — {html.escape(proyecto)} — Visual Studio Code"
        pestana = f'<div class="pestanas"><span class="pestana">{icono} {html.escape(archivo)}</span></div>'
        clase = ""
    return (
        f'<div class="ventana{clase}">'
        f'<div class="barra"><span class="punto p-rojo"></span><span class="punto p-amarillo"></span>'
        f'<span class="punto p-verde"></span><span class="titulo-ventana">{titulo}</span></div>'
        f"{pestana}"
        f'<div class="codigo"><pre class="numeros">{numeros}</pre>'
        f'<pre class="fuente">{chr(10).join(lineas)}</pre></div></div>'
    )


def leer_readme(carpeta: str):
    texto = (RAIZ / carpeta / "README.md").read_text(encoding="utf-8")
    titulo = re.search(r"^# (.+)$", texto, re.M).group(1).strip()
    return texto, titulo


def preparar(carpeta: str):
    texto, titulo = leer_readme(carpeta)
    numero = re.search(r"Clases? (\d+)", titulo)
    numero = int(numero.group(1)) if numero else 0
    titulo_corto = re.sub(r"^Clases? [\d a-z]+ · ", "", titulo)
    proyecto = f"php-paso-a-paso/clase{numero:02d}"

    # Fuera: título, imagen inicial, índice, navegación y separadores
    texto = re.sub(r"^# .+\n", "", texto, count=1)
    texto = re.sub(r'<p align="center">.*?</p>\n', "", texto, flags=re.S)
    texto = re.sub(r"^> 📕 \*\*Apuntes en PDF.*\n", "", texto, flags=re.M)
    texto = re.sub(r"## Índice\n.*?\n---\n", "", texto, count=1, flags=re.S)
    texto = re.sub(r"^\*\*(Clase anterior|Clase siguiente|Siguiente bloque|Bloque siguiente):\*\*.*$", "", texto, flags=re.M)
    texto = re.sub(r"^---\s*$", "", texto, flags=re.M)

    # Presentación: lo que hay antes del primer punto
    corte = re.search(r"^(## |# )", texto, re.M)
    presentacion = texto[: corte.start()].strip() if corte else ""
    cuerpo = texto[corte.start():] if corte else texto

    # Fuentes, al final y aparte
    fuentes = ""
    m = re.search(r"^### Fuentes y Documentación Oficial\n(.*)$", cuerpo, re.M | re.S)
    if m:
        fuentes = m.group(1).strip()
        cuerpo = cuerpo[: m.start()]

    bloques = {}

    def guardar(html_bloque: str) -> str:
        clave = f"BLOQUE{len(bloques):04d}X"
        bloques[clave] = html_bloque
        return f"\n\n{clave}\n\n"

    # Bloques de código: buscamos el archivo de ejemplo más cercano por debajo
    def sustituir_codigo(m):
        lenguaje, codigo = m.group(1), m.group(2)
        resto = cuerpo_actual[m.end(): m.end() + 2500]
        siguiente_seccion = re.search(r"^## ", resto, re.M)
        if siguiente_seccion:
            resto = resto[: siguiente_seccion.start()]
        archivo = re.search(r"📄 [^\[]*\[`([^`]+)`\]", resto)
        archivo = archivo.group(1).split("/")[-1] if archivo else ("plantilla.php" if "<" in codigo.split("\n")[0] and "<?php" not in codigo.split("\n")[0] else "ejemplo.php")
        if lenguaje in ("html",):
            archivo = archivo if archivo.endswith((".html", ".php")) else "pagina.html"
        if lenguaje == "json":
            archivo = "datos.json"
        if lenguaje == "bash":
            archivo = "terminal"
        if lenguaje == "sql":
            archivo = "consulta.sql"
        return guardar(ventana_codigo(codigo.rstrip("\n"), lenguaje, archivo, proyecto))

    cuerpo_actual = cuerpo
    cuerpo = re.sub(r"^```(\w*)\n(.*?)^```\s*$", sustituir_codigo, cuerpo, flags=re.M | re.S)

    # Partes (# 🗂️ Arrays) y puntos (## <img ...> 3. Título)
    secciones = []

    def sustituir_parte(m):
        return guardar(f'<div class="parte"><h1 class="titulo-parte">{html.escape(m.group(1).strip())}</h1></div>')

    cuerpo = re.sub(r"^# (.+)$", sustituir_parte, cuerpo, flags=re.M)

    def sustituir_punto(m):
        avatar = m.group(1) or "explica"
        titulo_punto = m.group(2).strip()
        num = re.match(r"(\d+)\.\s*(.*)", titulo_punto)
        numero_punto, nombre = (num.group(1), num.group(2)) if num else ("", titulo_punto)
        ident = f"punto-{len(secciones) + 1}"
        emoji = EMOJI_AVATAR.get(avatar, "📘")
        secciones.append({"id": ident, "num": numero_punto, "titulo": nombre, "avatar": avatar, "emoji": emoji})
        etiqueta = f"CLASE {numero:02d} · PUNTO {numero_punto}" if numero_punto else f"CLASE {numero:02d}"
        return guardar(
            f'<section class="banner" id="{ident}">'
            f'<img class="avatar-banner" src="recursos/avatares/{avatar}.webp" alt="">'
            f'<div class="texto-banner"><div class="etiqueta">{etiqueta}</div>'
            f'<h2>{emoji} {html.escape(nombre)}</h2></div></section>'
        )

    cuerpo = re.sub(r'^## (?:<img src="[^"]*/emojis/(\w+)\.webp"[^>]*>\s*)?(.+)$', sustituir_punto, cuerpo, flags=re.M)

    # Listas de tareas
    cuerpo = re.sub(r"^- \[ \] ", "- ☐ ", cuerpo, flags=re.M)

    # Dos citas seguidas separadas por una línea en blanco son dos avisos distintos
    cuerpo = re.sub(r"(^>.*\n)\n(?=>)", r"\1\n<!-- -->\n\n", cuerpo, flags=re.M)

    return {
        "numero": numero,
        "titulo": titulo_corto,
        "presentacion": presentacion,
        "cuerpo": cuerpo,
        "bloques": bloques,
        "secciones": secciones,
        "fuentes": fuentes,
    }


def md_a_html(texto: str, carpeta: str) -> str:
    resultado = markdown.markdown(texto, extensions=["tables", "sane_lists"])
    resultado = resultado.replace("\\|", "|")   # barras escapadas dentro de las tablas
    # Las imágenes del README, con su ruta completa en disco
    resultado = re.sub(
        r'src="(?!https?:|recursos/)([^"]+)"',
        lambda m: f'src="{(RAIZ / carpeta / html.unescape(m.group(1))).resolve().as_uri()}"',
        resultado,
    )
    resultado = re.sub(
        r'href="([^"]+)"',
        lambda m: f'href="{html.escape(enlace_absoluto(html.unescape(m.group(1)), carpeta))}"',
        resultado,
    )
    return resultado


def decorar(resultado: str, bloques: dict) -> str:
    # Avisos: citas que empiezan por un emoji conocido
    def sustituir_cita(m):
        contenido = m.group(1)
        texto_plano = re.sub(r"<[^>]+>", "", contenido).strip()
        tipo, avatar = "nota", "curioso"
        for emojis, t, a in TIPOS_AVISO:
            if texto_plano.startswith(emojis):
                tipo, avatar = t, a
                break
        return (f'<div class="aviso {tipo}"><img class="avatar-aviso" src="recursos/avatares/{avatar}.webp" alt="">'
                f'<div class="texto-aviso">{contenido}</div></div>')

    resultado = re.sub(r"<blockquote>\s*(.*?)\s*</blockquote>", sustituir_cita, resultado, flags=re.S)

    # Líneas «📄 Ejemplo: …» como etiqueta de archivo
    resultado = re.sub(r"<p>📄 (.*?)</p>", r'<p class="archivo-ejemplo">📄 \1</p>', resultado, flags=re.S)

    # Tablas dentro de un contenedor para darles estilo
    resultado = resultado.replace("<table>", '<div class="tabla"><table>').replace("</table>", "</table></div>")

    # Bloques guardados (código y banners)
    for clave, valor in bloques.items():
        resultado = resultado.replace(f"<p>{clave}</p>", valor).replace(clave, valor)
    return resultado


def construir_html(carpeta: str) -> str:
    datos = preparar(carpeta)
    numero, titulo = datos["numero"], datos["titulo"]
    cuerpo = decorar(md_a_html(datos["cuerpo"], carpeta), datos["bloques"])
    presentacion = md_a_html(datos["presentacion"], carpeta)
    fuentes = md_a_html(datos["fuentes"], carpeta)

    tarjetas = "\n".join(
        f'<a class="tarjeta" href="#{s["id"]}">'
        f'<img src="recursos/avatares/{s["avatar"]}.webp" alt="">'
        f'<span class="num">{s["num"] or "•"}</span>'
        f'<span class="tit">{s["emoji"]} {html.escape(s["titulo"])}</span></a>'
        for s in datos["secciones"]
    )
    chips = "".join(
        f'<span class="chip">{html.escape(s["titulo"])}</span>'
        for s in datos["secciones"] if s["num"] and not s["titulo"].lower().startswith(("ejercicios", "lo que"))
    )
    css = (CARPETA_PDF / "estilos.css").read_text(encoding="utf-8")
    css += HtmlFormatter(style="one-dark").get_style_defs(".fuente")
    cabecera = f"CLASE {numero:02d} · {titulo.upper()}"
    css = css.replace("__CABECERA__", cabecera.replace('"', "'"))

    return f"""<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Clase {numero} · {html.escape(titulo)}</title>
<style>{css}</style>
</head>
<body>

<section class="portada">
    <div class="portada-arriba">
        <span class="pastilla">ALPE FORMACIÓN · SANTANDER</span>
        <span class="edicion">Edición 2026 · PHP 8.x</span>
    </div>
    <div class="portada-centro">
        <div class="kicker">CURSO DE PHP · CLASE {numero:02d}</div>
        <h1 class="titulo-portada">{html.escape(titulo)}</h1>
        <div class="chips">{chips}</div>
    </div>
    <img class="avatar-portada" src="recursos/avatares/hola.webp" alt="">
    <div class="portada-abajo">
        <div><strong>Ramón Abramo</strong><br><span class="verde">+25 años de experiencia docente</span> · Santander, Cantabria</div>
        <div class="marca">ALPE<br><span>FORMACIÓN PROFESIONAL</span></div>
    </div>
</section>

<section class="menu">
    <h2 class="titulo-menu">🧭 Contenido de la clase</h2>
    <div class="presentacion">{presentacion}</div>
    <div class="rejilla">{tarjetas}</div>
</section>

<main>
{cuerpo}
</main>

<section class="fuentes">
    <h2 class="titulo-fuentes">📚 Fuentes y documentación oficial</h2>
    {fuentes}
</section>

</body>
</html>"""


def generar(carpeta: str) -> Path:
    carpeta = carpeta.strip("/")
    contenido = construir_html(carpeta)
    html_tmp = CARPETA_PDF / f".{carpeta}.html"
    html_tmp.write_text(contenido, encoding="utf-8")
    destino = RAIZ / carpeta / f"{carpeta}.pdf"
    subprocess.run(["node", str(CARPETA_PDF / "imprimir.js"), str(html_tmp), str(destino)], check=True)
    html_tmp.unlink()
    reducir(destino)
    return destino


def reducir(destino: Path) -> None:
    """Chromium repite cada avatar en cada página: dejamos una sola copia de cada imagen."""
    escritor = PdfWriter(clone_from=str(destino))
    escritor.compress_identical_objects(remove_duplicates=True, remove_unreferenced=True)
    for pagina in escritor.pages:
        pagina.compress_content_streams()
    with open(destino, "wb") as fichero:
        escritor.write(fichero)


if __name__ == "__main__":
    argumentos = sys.argv[1:]
    if argumentos == ["--todas"]:
        argumentos = sorted(p.name for p in RAIZ.glob("clase-*") if (p / "README.md").exists())
    if not argumentos:
        print(__doc__)
        sys.exit(1)
    for carpeta in argumentos:
        print("✅", generar(carpeta).relative_to(RAIZ))
