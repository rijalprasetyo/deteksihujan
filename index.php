<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Weather Data</title>
    <link rel="stylesheet" href="style.css">
    <!-- Link ke CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Library Chart.js -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
    /* style.css */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom, #d7e9f7, #f0f4f8);
    margin: 0;
    padding: 0;
}

.container {
    margin: 0 auto;
    max-width: 1200px;
    padding: 20px;
}

header {
    background: linear-gradient(90deg, #007bff, #00c6ff);
    color: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
    font-family: 'Poppins', sans-serif;
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Agar konten di dalam header disusun ke kiri */
    position: relative;
    text-align: left; /* Sesuaikan teks ke kiri */
}

.logo {
    max-height: 150px; /* Ukuran logo yang lebih besar */
    margin-right: 20px; /* Memberi sedikit jarak antara logo dan teks */
    margin-left: 0; /* Menghilangkan margin kiri */
    padding-top: 0; /* Menghapus padding jika ada */
}

header div {
    margin-left: 20px; /* Memberi jarak antara logo dan teks */
}

header h1 {
    color: white;
    margin: 0;
    font-size: 2.8rem;
    letter-spacing: 1px;
    font-weight: bold;
}

header p {
    color: white;
    font-size: 1.2rem;
    margin-top: 2px;
}

.card {
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 20px; /* Add spacing between cards */
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
}

.card-header {
    background: linear-gradient(90deg, #007bff, #00c6ff);
    color: #fff;
    padding: 15px;
    font-size: 1.5rem;
    text-align: center;
    font-weight: bold;
}

.card-body {
    padding: 20px;
}

.visual-container {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 3px dashed #007bff;
    border-radius: 10px;
    padding: 20px;
    background: #e3f2fd;
    max-width: 300px;
    margin: 0 auto;
    transition: border-color 0.3s ease, background-color 0.3s ease;
}

.visual-container:hover {
    border-color: #00c6ff;
    background-color: #d0efff;
}

.text-data p {
    font-size: 1rem; /* Adjust font size for smaller screens */
    margin: 10px 0;
    line-height: 1.6;
}

.text-data p strong {
    color: #007bff;
}

button {
    font-size: 1rem;
    padding: 10px 20px; /* Reduce padding for smaller screens */
    border: none;
    border-radius: 50px;
    background: linear-gradient(90deg, #00c6ff, #007bff);
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
}

button:hover {
    background: #007bff;
    transform: translateY(-3px);
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
}

footer {
    margin-top: 30px;
    font-size: 1rem;
    color: #777;
    padding: 15px;
    background: linear-gradient(90deg, #e3f2fd, #ffffff);
    border-radius: 15px;
    box-shadow: 0px -3px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
}

footer p {
    margin: 0;
    font-style: italic;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .logo {
        max-height: 80px; /* Further reduce logo size */
        margin-right: 10px;
    }

    header {
        flex-direction: column; /* Stack content vertically */
        text-align: center;
    }

    header h1 {
        font-size: 2rem; /* Adjust font size for tablets */
    }

    header p {
        font-size: 0.9rem;
    }

    .card {
        margin-bottom: 15px;
    }

    .card-header {
        font-size: 1.2rem;
    }

    .text-data p {
        font-size: 0.9rem; /* Smaller font size */
    }
}

@media (max-width: 480px) {
    header h1 {
        font-size: 1.5rem; /* Smaller font size for mobile */
    }

    header p {
        font-size: 0.8rem;
    }

    button {
        padding: 8px 15px; /* Reduce button padding further */
    }
}
</style>

</head>
<body>
<div class="container">
    <header class="text-center my-4 d-flex align-items-center justify-content-center">
        <img src="polinema.png" alt="Logo" class="logo">
        <div>
            <h1>Realtime Pendeteksi Hujan</h1>
            <p>Monitoring Hujan dan Itensitas secara Realtime</p>
            <p>3C - KELOMPOK 5</p>
        </div>
    </header>
        <main>
            <div class="card shadow-sm">
                <h4 class="card-header">Data Sensor Hujan</h4>
                <div id="data-display" class="card-body row">
                    <!-- Kolom untuk Chart (kiri) -->
                    <div class="col-md-6 d-flex justify-content-center">
                        <div class="visual-container">
                            <canvas id="humidityChart" width="200" height="200"></canvas>
                        </div>
                    </div>

                    <!-- Kolom untuk Keterangan (kanan) -->
                    <div class="col-md-6">
                        <div class="text-data">
                            <p><strong>Intensitas Hujan:</strong> <span id="rainIntensity">Loading...</span></p>
                            <p><strong>Status Hujan:</strong> <span id="rainStatus">Loading...</span></p>
                            <p><strong>Itensitas Hujan:</strong> <span id="humidityPercentage">0%</span></p>
                            <p><span id="humidityStatus">Status Loading...</span></p>
                            <p><strong>Status Jemuran:</strong> <span id="dryingStatus">Loading...</span></p> <!-- Status Jemuran -->
                            <p><strong>Status Kipas:</strong> <span id="kipasStatus">Loading...</span></p> <!-- Status Kipas -->
                            <button id="toggleFanButton" class="btn btn-primary mt-3">Ubah Status Kipas</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="text-center my-4">
            <p>&copy; UAS Semester Ganjir / Rijal | Eka | Dea - Internet If Things (IoT) </p>
        </footer>
    </div>

    <script type="module">
        // Import Firebase modules
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.16.0/firebase-app.js";
        import { getDatabase, ref, onValue, get, set } from "https://www.gstatic.com/firebasejs/9.16.0/firebase-database.js";

        // Konfigurasi Firebase
        const firebaseConfig = {
            apiKey: "AIzaSyBtbV8v0e9Dh8tktrtZBEOfJ_TjO1B8dtw",
            authDomain: "mobile-projek-c5cac.firebaseapp.com",
            databaseURL: "https://mobile-projek-c5cac-default-rtdb.firebaseio.com",
            projectId: "mobile-projek-c5cac",
            storageBucket: "mobile-projek-c5cac.appspot.com",
            messagingSenderId: "993177595048",
            appId: "1:993177595048:web:dc7be12f78e3f2ae55669d"
        };

        // Inisialisasi Firebase
        const app = initializeApp(firebaseConfig);
        const database = getDatabase(app);

        // Referensi ke data kipas
        const kipasRef = ref(database, 'kipas/status');

        // Ambil status awal kipas
        const kipasStatusText = document.getElementById('kipasStatus');
        const toggleFanButton = document.getElementById('toggleFanButton');

        onValue(kipasRef, (snapshot) => {
            const status = snapshot.val();
            kipasStatusText.textContent = status;
            toggleFanButton.textContent = status === 'off' ? 'Hidupkan Kipas' : 'Matikan Kipas';
        });

        // Tambahkan event listener ke tombol
        toggleFanButton.addEventListener('click', async () => {
            try {
                const snapshot = await get(kipasRef);
                const currentStatus = snapshot.val();
                const newStatus = currentStatus === 'off' ? 'on' : 'off';
                await set(kipasRef, newStatus);
            } catch (error) {
                console.error("Error updating fan status:", error);
            }
        });

        // Fungsi lainnya tetap sama
        // Fungsi untuk menentukan status kelembapan
        function getHumidityStatus(value) {
            if (value === 0) return "Tidak Ada Hujan";
            else if (value < 1000) return "Hujan Tinggi";
            else if (value < 2000) return "Hujan Sedang";
            else if (value < 3000) return "Hujan Ringan";
            else return "Tidak Ada Hujan";
        }

        function getDryingStatus(humidityStatus) {
            return humidityStatus === "Tidak Ada Hujan" ? "Dibuka" : "Ditutup";
        }

        const humidityCtx = document.getElementById('humidityChart').getContext('2d');
        const humidityChart = new Chart(humidityCtx, {
            type: 'doughnut',
            data: {
                labels: ['Humidity', 'Remaining'],
                datasets: [{
                    data: [0, 100],
                    backgroundColor: ['#2A94D5', '#E0E0E0'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } },
                cutout: '70%',
            }
        });

        function updateChart(chart, value, type) {
            if (type === "humidity") {
                chart.data.datasets[0].data = [value, 100 - value];
            }
            chart.update();
        }

        async function fetchData() {
            try {
                const response = await fetch('fetch_data.php');
                const data = await response.json(); // Ambil data JSON dari fetch_data.php

                // Dapatkan data dari JSON
                const humidity = data.humidity;
                const rainIntensity = data.rain_intensity;
                const rainStatus = data.rain_status;

                // Tentukan status kelembapan dan visualisasi
                const humidityValue = (humidity === 4095) ? 0 : (100 - (humidity / 4095 * 100)).toFixed(2);
                const humidityStatus = getHumidityStatus(humidity);
                const dryingStatus = getDryingStatus(humidityStatus);

                // Update elemen HTML dengan data dari JSON
                document.getElementById('humidityPercentage').innerText = `${humidityValue}%`;
                document.getElementById('humidityStatus').innerText = humidityStatus;
                document.getElementById('rainIntensity').innerText = rainIntensity;
                document.getElementById('rainStatus').innerText = rainStatus;
                document.getElementById('dryingStatus').innerText = dryingStatus;

                // Update chart kelembapan
                updateChart(humidityChart, humidityValue, "humidity");

            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        fetchData();
        setInterval(fetchData, 5000);
    </script>
</body>
</html>
