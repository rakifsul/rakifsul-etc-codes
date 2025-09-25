import * as fs from 'fs';

// ollama endpoint
// sesuaikan dengan milik Anda
const ollamaAPIEndpoint = "http://192.168.1.2:11434/api/generate";

// ollama model
// ollama pull gemma3:4b
const ollamaModel = "gemma3:4b";

// system prompt ini akan merangkum menjadi 15 kalimat
const systemPrompt = `
Anda adalah asisten yang merangkum teks.
Tugas Anda: buat ringkasan dari teks yang diberikan dengan panjang tidak lebih dari 15 kalimat.
Gunakan kalimat dan susunan kata yang berbeda dari teks asli, tetapi pertahankan makna dan informasi penting.
Jangan menyalin langsung frasa panjang dari teks sumber.
Gunakan bahasa yang jelas, ringkas, dan mudah dipahami.
Hindari opini atau informasi tambahan yang tidak ada di teks sumber.
Jawaban hanya berisi ringkasan, tanpa pembukaan atau penutup.
`;

// folder target
const inputFolder = "./input/"
const outputFolder = "./output/"

// melakukan summarize
async function llmSummarize(prompt) {
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

// baca dari file
async function myReadFile(path) {
    const ret = await fs.readFileSync(path, "utf-8");

    return ret;
}

// tulis ke file
async function myWriteFile(path, data) {
    await fs.writeFileSync(path, data, "utf-8");
}

// jalankan ------------------------------------------------
async function main() {
    await fs.readdirSync(inputFolder).forEach(async file => {
        // will also include directory names
    
        const relPath = `${inputFolder}${file}`;
    
        console.log(relPath);
    
        const input = await myReadFile(relPath)
    
        const output = await llmSummarize(input);
    
        console.log(output)
    
        await myWriteFile(`${outputFolder}${file}`, output)
    
    });
}

//
await main();
// -------------------------------------------------------
