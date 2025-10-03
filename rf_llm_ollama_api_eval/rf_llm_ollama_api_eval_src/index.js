// ollama endpoint
// ganti ip dengan ip Anda yang terinstall Ollama
const ollamaAPIEndpoint = "http://192.168.2.2:11434/api/generate";

// ollama model
// download dengan: ollama pull nama_model
// const ollamaModel = "gemma3:1b"; // model ini gagal remove backtick via prompt.
const ollamaModel = "gemma3:4b"; // coba yang ini.

// system prompt ini gagal menghilangkan backtick untuk snippet pada model gemma3:1b. 
// barangkali Anda tahu solusinya selain dengan algoritma biasa?
const systemPrompt = `
jawab dengan kode html, css, dan javascript.
jawaban tadi harus tanpa format markdown sama sekali
dan tanpa format markdown snippet
dan tanpa karakter backtick snippet
harus seperti itu.
`;

// on load
window.addEventListener("load", async function () {
    // dapatkan elemen button
    const btnExec = document.getElementById("btn-exec")

    // saat elemen button diklik
    btnExec.addEventListener("click", async function (evt) {
        const prompt = document.getElementById("txa-prompt").value;
        console.log(prompt)
        await llmEval(prompt)
    })
})

// melakukan reply
async function llmEval(prompt) {
    // request ke ollama API
    const rawResponse = await fetch(ollamaAPIEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            model: ollamaModel,
            prompt: prompt,
            // system prompt digunakan untuk meyakinkan bahwa output dari model tidak berformat 
            // dan hanya terdiri dari 3 hingga 5 kalimat saja.
            system: systemPrompt,
            stream: false
        })
    });

    // cleanup response
    const jsonResponse = await rawResponse.json();
    let response = jsonResponse.response;
    response = removeMarkdownSnippet(response)
    console.log(response);

    // replace main window
    let mainWindow = document.getElementsByTagName('html')[0];
    mainWindow.innerHTML = response;

    // reload dan restore setelah 3 seconds
    setTimeout(function () {
        location.reload();
    }, 3000)
}

function removeMarkdownSnippet(text) {
    // RegEx untuk menangkap dan menghapus kode dalam tiga backtick + jenis bahasa
    return text.replace(/```[a-zA-Z0-9]*\s*(.*?)```/gs, '$1');
}