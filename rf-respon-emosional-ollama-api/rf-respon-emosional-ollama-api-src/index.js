import puppeteer from "puppeteer";

// ollama endpoint
// sesuaikan dengan milik Anda
const ollamaAPIEndpoint = "http://192.168.1.2:11434/api/generate";

// ollama model
// ollama pull gemma3:4b
const ollamaModel = "gemma3:4b";

// system prompt ini akan membaca emosi artikel
const systemPrompt = `
Anda adalah asisten yang bisa menganalisis emosi pada teks yang diberikan.
Tugas Anda: nyatakan emosi dari artikel yang diberikan.
emosi yang bisa anda tentukan hanya senang, sedih, marah, takut, kaget, kagum.
Jawaban hanya berisi emosi-emosi tersebut. tidak ada yang lain dan tanpa format apapun.
`;

// halaman web target
const webPages = [
    "https://rakifsul.github.io/tutorial-llamacpp-seri-4-mencoba-temperature-dan-top-k.html",
    "https://rakifsul.github.io/cara-build-ollama-dari-source-code-dan-mencoba-menjalankannya.html",
    "https://rakifsul.github.io/cara-build-dan-install-metube-aplikasi-video-downloader.html",
]

// melakukan analisis
async function llmAnalyze(prompt) {
    const finalPrompt = `${prompt}`
    // request ke ollama API
    const rawResponse = await fetch(ollamaAPIEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            model: ollamaModel,
            prompt: finalPrompt,
            system: systemPrompt,
            stream: false
        })
    });

    // cleanup response
    const jsonResponse = await rawResponse.json();
    let response = jsonResponse.response;
    // console.log(response);
    return response;
}

// scrape alamat target
async function scrapeArticle(url) {
    // Luncurkan browser
    const browser = await puppeteer.launch({ args: ['--no-sandbox'], headless: true });
    const page = await browser.newPage();

    // Buka halaman
    await page.goto(url, { waitUntil: "domcontentloaded" });

    // Ambil teks bersih dari <article>
    const articleText = await page.evaluate(() => {
        const article = document.querySelector("article");
        if (!article) return null;

        // Ambil semua teks dari dalam article
        let text = article.innerText || "";

        // Bersihkan spasi berlebih
        text = text.replace(/\s+/g, " ").trim();

        return text;
    });

    await browser.close();

    if (!articleText) {
        console.log("Tidak ada tag <article> ditemukan.");
        return "tidak ada artikel";
    }

    //console.log("=== Konten Artikel Bersih ===\n");
    //console.log(articleText);
    return articleText;
}

// jalankan ------------------------------------------------
async function main() {
    webPages.forEach(async (urlItem) => {
        const articleText = await scrapeArticle(urlItem);

        const emotion = await llmAnalyze(articleText);

        console.log(emotion);
    })
}

//
await main();
// -------------------------------------------------------
