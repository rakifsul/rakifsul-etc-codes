# cara penggunaan

## Pastikan

- dijalankan hanya di Ubuntu 24.04.3
- llama-cli bisa dijalankan dari folder manapun
    - jika belum, masukkan folder binary folder llama.cpp ke PATH dan LD_LIBRARY_PATH
- model.gguf sudah ada dan koleksinya dimasukkan dalam satu folder yang tetap

## Pemakaian

```
# install dulu fzf
sudo apt install fzf
```

```
# masuk ke folder rf-llm-runner-fuzzy-src
cd rf-llm-runner-fuzzy-src
```

```
# beri izin
chmod +x ./rf-llm-runner-fuzzy
```

```
# jalankan
./rf-llm-runner-fuzzy /folder/ke/daftar/model-files
```

nanti daftar model akan muncul

gunakan panah atas dan bawah untuk memilih

kemudian enter

kunjungi URL yang ada di output
