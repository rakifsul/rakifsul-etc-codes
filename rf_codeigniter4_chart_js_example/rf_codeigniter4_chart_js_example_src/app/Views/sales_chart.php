<!DOCTYPE html>
<html>
<head>
    <title>Chart.js Demo - CodeIgniter 4</title>
    <!-- Load Chart.js dari folder public/js -->
    <script src="<?= base_url('/assets/vendor/chart/chart.umd.js') ?>"></script>
</head>
<body>
    <h2>Grafik Penjualan Harian</h2>
    <!-- Canvas untuk Line Chart -->
    <canvas id="salesChart" width="400" height="200"></canvas>

    <h2>Grafik Penjualan per Kategori</h2>
    <!-- Canvas untuk Bar Chart -->
    <canvas id="categoryChart" width="400" height="200"></canvas>

    <script>
        // -----------------------------
        // LINE CHART PENJUALAN HARIAN
        // -----------------------------
        async function loadSalesChart() {
            // Panggil endpoint /sales/data untuk ambil JSON
            const response = await fetch("<?= base_url('/sales/data') ?>");
            const data = await response.json();

            // Ambil canvas dengan id 'salesChart'
            const ctx = document.getElementById('salesChart').getContext('2d');

            // Inisialisasi Chart.js
            new Chart(ctx, {
                type: 'line', // jenis chart: line
                data: {
                    labels: data.labels, // tanggal penjualan
                    datasets: [{
                        label: 'Total Penjualan Harian', // teks legend chart
                        data: data.values,               // jumlah per hari
                        borderWidth: 2,                  // ketebalan garis
                        borderColor: 'rgba(75, 192, 192, 1)',   // warna garis
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // area di bawah garis
                        fill: true,                      // isi area di bawah garis
                        tension: 0.3                     // lengkungan garis
                    }]
                },
                options: {
                    responsive: true, // chart mengikuti ukuran layar
                    scales: {
                        y: { beginAtZero: true } // sumbu Y mulai dari 0
                    }
                }
            });
        }

        // -----------------------------
        // BAR CHART PENJUALAN KATEGORI
        // -----------------------------
        async function loadCategoryChart() {
            // Panggil endpoint /sales/categoryData untuk ambil JSON
            const response = await fetch("<?= base_url('/sales/categoryData') ?>");
            const data = await response.json();

            // Ambil canvas dengan id 'categoryChart'
            const ctx = document.getElementById('categoryChart').getContext('2d');

            // Inisialisasi Chart.js
            new Chart(ctx, {
                type: 'bar', // jenis chart: bar
                data: {
                    labels: data.labels, // daftar kategori
                    datasets: [{
                        label: 'Total per Kategori', // teks legend chart
                        data: data.values,           // total penjualan kategori
                        borderWidth: 1,
                        // Warna-warna batang (bisa lebih dari jumlah kategori, Chart.js akan looping)
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true } // sumbu Y mulai dari 0
                    }
                }
            });
        }

        // Jalankan kedua chart saat halaman load
        loadSalesChart();
        loadCategoryChart();
    </script>
</body>
</html>
