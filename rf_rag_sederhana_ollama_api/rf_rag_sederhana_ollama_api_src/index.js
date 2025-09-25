// untuk membaca file
import fs from "fs";

// untuk parsing file PDF.
// cara ini dilakukan karena import pdfParse from "pdf-parse"; gagal mengimpor modul.
import * as pdfParse from "pdf-parse/lib/pdf-parse.js";

// ollama API URL.
// sesuaikan dengan milik Anda.
const OLLAMA_URL = "http://192.168.1.2:11434/api";

// embedding model. 
// pastikan sudah di-pull.
// ollama pull nomic-embed-text
const EMBEDDING_MODEL = "nomic-embed-text";

// model. 
// pastikan sudah di-pull.
// ollama pull gemma3:4b
const MODEL = "gemma3:4b";

// path dari PDF yang diberikan.
// sebaiknya Anda baca dulu.
const PDF_PATH = "./contoh.pdf";

// cosine similarity makin mendekati 1.0 makin bagus. karena makin sejajar (cos 0 derajat = 1).
function cosineSimilarity(vecA, vecB) {
    const dot = vecA.reduce((sum, a, i) => sum + a * vecB[i], 0);
    const normA = Math.sqrt(vecA.reduce((sum, a) => sum + a * a, 0));
    const normB = Math.sqrt(vecB.reduce((sum, b) => sum + b * b, 0));
    return dot / (normA * normB);
}

// fetch ollama endpoint untuk mendapatkan embedding.
// jika URL Ollama API adalah http://192.168.2.2:11434/api, 
// maka endpoint embedding adalah:
// http://192.168.2.2:11434/api/embeddings
async function getEmbedding(text) {
    const res = await fetch(`${OLLAMA_URL}/embeddings`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            model: EMBEDDING_MODEL,
            prompt: text
        })
    });
    const data = await res.json();
    return data.embedding;
}

// fetch ollama endpoint untuk melakukan chat (beda dengan generate).
// jika URL Ollama API adalah http://192.168.2.2:11434/api, 
// maka endpoint embedding adalah:
// http://192.168.2.2:11434/api/chat
async function llmAnalyze(systemPrompt, userPrompt) {
    const res = await fetch(`${OLLAMA_URL}/chat`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            model: MODEL,
            messages: [
                { role: "system", content: systemPrompt },
                { role: "user", content: userPrompt }
            ],
            stream: false
        })
    });
    const data = await res.json();
    return data.message.content;
}

// jalankan
(async () => {
    // baca file PDF dan dapatkan teksnya.
    const dataBuffer = fs.readFileSync(PDF_PATH);
    const pdfData = await pdfParse.default(dataBuffer);
    const text = pdfData.text.replace(/\s+/g, " ").trim();

    // pecah teks tadi menjadi potongan-potongan (chunk) dengan ukuran 500 karakter.
    const chunkSize = 500;
    const chunks = [];
    for (let i = 0; i < text.length; i += chunkSize) {
        chunks.push(text.slice(i, i + chunkSize));
    }

    // ada berapa potongan?
    console.log(`Total chunk: ${chunks.length}`);

    // buat embedding untuk tiap chunk.
    const chunkEmbeddings = [];
    for (const chunk of chunks) {
        const emb = await getEmbedding(chunk);
        chunkEmbeddings.push({ text: chunk, embedding: emb });
    }

    // saya memberikan query yang jawabannya bersumber dari contoh.pdf
    // agar yakin bahwa model mengambil info dari file pdf tersebut.
    // silakan Anda baca contoh.pdf untuk memverifikasinya.
    const query = "apa saja ciri-ciri PWA?";

    // query juga perlu didapatkan embeddingnya
    // agar bisa menjadi pembanding untuk cosine similarity.
    const queryEmbedding = await getEmbedding(query);

    // ambil 3 chunk terbaik berdasarkan nilai cosine similarity-nya.
    // makin mendekati 1.0 makin bagus.
    const ranked = chunkEmbeddings
        .map(c => ({
            text: c.text,
            score: cosineSimilarity(queryEmbedding, c.embedding)
        }))
        .sort((a, b) => b.score - a.score)
        .slice(0, 3);

    console.log("");   
    console.log("3 chunk terbaik:");
    console.log("");
    console.log(ranked);

    // buat prompt untuk LLM.
    const systemPrompt = "Anda adalah asisten yang menjawab hanya berdasarkan referensi yang diberikan.";
    const references = ranked.map((c, i) => `${i + 1}. ${c.text}`).join("\n");
    const userPrompt = `Pertanyaan: ${query}\n\nReferensi:\n${references}\n\nJawab pertanyaan hanya berdasarkan referensi di atas.`;

    // kirimkan prompt ke LLM.
    const answer = await llmAnalyze(systemPrompt, userPrompt);

    // print hasilnya.
    console.log("");
    console.log("----------------------------------------------");
    console.log("!!! jawaban dari LLM !!!"); 
    console.log("");
    console.log(answer);
    console.log("----------------------------------------------");
})();
