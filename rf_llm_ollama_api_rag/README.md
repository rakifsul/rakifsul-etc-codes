# Cara Penggunaan

Masuk folder rf_rag_sederhana_ollama_api_src, lalu jalankan:

```
npm install
```

Pull model yang digunakan:

```
# tergantung apa model yang Anda gunakan di index.js
ollama pull gemma3:4b

# model ini wajib di-install/di-pull
ollama pull nomic-embed-text
```

Sesuaikan ip endpoint seperti arahan di komentar index.js

Kemudian jalankan:

```
node index.js
```