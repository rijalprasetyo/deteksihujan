import { initializeApp } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js";
import { getDatabase, ref, onValue } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-database.js";
// Firebase Configuration
const firebaseConfig = {
    apiKey: "AIzaSyBtbV8v0e9Dh8tktrtZBEOfJ_TjO1B8dtw",
    authDomain: "mobile-projek-c5cac.firebaseapp.com",
    databaseURL: "https://mobile-projek-c5cac-default-rtdb.firebaseio.com",
    projectId: "mobile-projek-c5cac",
    storageBucket: "mobile-projek-c5cac.appspot.com",
    messagingSenderId: "993177595048",
    appId: "1:993177595048:web:dc7be12f78e3f2ae55669d"
};
  

const app = initializeApp(firebaseConfig);
const database = getDatabase(app);

// Referensi ke data di Firebase Realtime Database
const dataRef = ref(database, 'hujan_data');

// Fungsi untuk membaca data secara realtime
onValue(dataRef, (snapshot) => {
    const data = snapshot.val();

    // Update nilai di halaman
    document.getElementById('humidity').innerText = data.humidity;
    document.getElementById('rain_intensity').innerText = data.rain_intensity;
    document.getElementById('rain_status').innerText = data.rain_status;
});
