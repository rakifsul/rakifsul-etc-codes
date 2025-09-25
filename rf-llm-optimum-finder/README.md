# Cara Penggunaan

## Persiapan

- pastikan dijalankan di Ubuntu 24.04.3
- llama.cpp sudah terinstall dan:
    - bisa menjalankan llama-cli dan llama-bench dari folder manapun.
- sudah tahu absolute path dari model yang ingin diuji
- model dalam format .gguf

## Pengujian

Masuk ke folder "rf-llm-optimum-finder-src":

```
cd  rf-llm-optimum-finder-src
```

Beri permission untuk dijalankan:

```
chmod +x ./rf-llm-optimum-finder
```

Jalankan:

```
# model harus sudah ada dulu
# bisa cari .gguf di HunggingFace

./rf-llm-optimum-finder /path/to/model.gguf
```