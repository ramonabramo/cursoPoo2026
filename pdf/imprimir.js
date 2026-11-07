// Imprime un HTML a PDF con Chromium: node pdf/imprimir.js entrada.html salida.pdf
const { chromium } = require("playwright");

(async () => {
    const [entrada, salida] = process.argv.slice(2);
    const navegador = await chromium.launch();
    const pagina = await navegador.newPage();
    await pagina.goto("file://" + entrada, { waitUntil: "networkidle" });
    await pagina.evaluate(() => document.fonts.ready);
    await pagina.pdf({
        path: salida,
        format: "A4",
        printBackground: true,
        preferCSSPageSize: true,
        outline: true,
        tagged: true,
    });
    await navegador.close();
})();
