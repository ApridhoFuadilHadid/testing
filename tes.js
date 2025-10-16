<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Aplikasi Modern</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --danger: #e63946;
            --card-shadow: 0 10px 20px rgba(0,0,0,0.1);
            --hover-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
            color: var(--dark);
        }
        
        .container {
            max-width: 1200px;
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }
        
        .card-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .card-header i {
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 25px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }
        
        input, select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5ee;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            text-align: center;
        }
        
        .btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }
        
        .btn-block {
            display: block;
            width: 100%;
        }
        
        .btn-danger {
            background: var(--danger);
        }
        
        .btn-danger:hover {
            background: #c1121f;
        }
        
        .result-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            border-left: 4px solid var(--success);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e1e5ee;
        }
        
        th {
            background: var(--primary);
            color: white;
            font-weight: 600;
        }
        
        tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .calculator-inputs {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .calculator-inputs input, .calculator-inputs select {
            flex: 1;
        }
        
        .shopping-list {
            list-style: none;
            margin-top: 20px;
        }
        
        .shopping-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            background: white;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-left: 4px solid var(--success);
            transition: transform 0.2s;
        }
        
        .shopping-item:hover {
            transform: translateX(5px);
        }
        
        .item-actions {
            display: flex;
            gap: 10px;
        }
        
        .delete-btn {
            background: none;
            border: none;
            color: var(--danger);
            cursor: pointer;
            font-size: 1.1rem;
            transition: transform 0.2s;
        }
        
        .delete-btn:hover {
            transform: scale(1.2);
        }
        
        .empty-state {
            text-align: center;
            padding: 30px;
            color: var(--gray);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }
        
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .calculator-inputs {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- BIODATA -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-user"></i>
                <h2>Form Biodata</h2>
            </div>
            <div class="card-body">
                <form id="biodata-form">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="umur">Umur</label>
                        <input type="number" id="umur" name="umur" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="4" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-block">
                        <i class="fas fa-save"></i> Simpan Biodata
                    </button>
                </form>

                <div id="biodata-result" class="result-box" style="display: none;">
                    <h3>Data Biodata Tersimpan:</h3>
                    <table>
                        <tr>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Alamat</th>
                        </tr>
                        <tr>
                            <td id="display-nama"></td>
                            <td id="display-umur"></td>
                            <td id="display-alamat"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- KALKULATOR -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-calculator"></i>
                <h2>Kalkulator Sederhana</h2>
            </div>
            <div class="card-body">
                <form id="calculator-form">
                    <div class="calculator-inputs">
                        <input type="number" step="any" id="angka1" placeholder="Angka pertama" required>
                        <select id="operasi" required>
                            <option value="+">+</option>
                            <option value="-">-</option>
                            <option value="*">×</option>
                            <option value="/">÷</option>
                        </select>
                        <input type="number" step="any" id="angka2" placeholder="Angka kedua" required>
                    </div>
                    <button type="submit" class="btn btn-block">
                        <i class="fas fa-equals"></i> Hitung
                    </button>
                </form>

                <div id="calculator-result" class="result-box" style="display: none;">
                    <h3>Hasil Perhitungan:</h3>
                    <p id="hasil-kalkulator" style="font-size: 1.5rem; font-weight: bold; color: var(--primary);"></p>
                </div>
            </div>
        </div>

        <!-- DAFTAR BELANJA -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-shopping-cart"></i>
                <h2>Daftar Belanja</h2>
            </div>
            <div class="card-body">
                <form id="shopping-form">
                    <div class="calculator-inputs">
                        <input type="text" id="barang-baru" placeholder="Tambahkan barang ke daftar belanja..." required>
                        <button type="submit" class="btn">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </form>

                <h3>Daftar Barang:</h3>
                <div id="shopping-list-container">
                    <ul id="shopping-list" class="shopping-list">
                        <!-- Items will be added here by JavaScript -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi data dari localStorage
        let biodata = JSON.parse(localStorage.getItem('biodata')) || {};
        let shoppingList = JSON.parse(localStorage.getItem('shoppingList')) || ['Beras', 'Gula', 'Telur', 'Minyak Goreng'];
        
        // Fungsi untuk menyimpan ke localStorage
        function saveToLocalStorage() {
            localStorage.setItem('biodata', JSON.stringify(biodata));
            localStorage.setItem('shoppingList', JSON.stringify(shoppingList));
        }
        
        // Fungsi untuk memuat data saat halaman dimuat
        function loadData() {
            // Memuat biodata jika ada
            if (biodata.nama) {
                document.getElementById('nama').value = biodata.nama;
                document.getElementById('umur').value = biodata.umur;
                document.getElementById('alamat').value = biodata.alamat;
                displayBiodata();
            }
            
            // Memuat daftar belanja
            renderShoppingList();
        }
        
        // ===== BAGIAN BIODATA =====
        document.getElementById('biodata-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            biodata = {
                nama: document.getElementById('nama').value,
                umur: document.getElementById('umur').value,
                alamat: document.getElementById('alamat').value
            };
            
            saveToLocalStorage();
            displayBiodata();
            
            // Reset form
            document.getElementById('biodata-form').reset();
        });
        
        function displayBiodata() {
            document.getElementById('display-nama').textContent = biodata.nama;
            document.getElementById('display-umur').textContent = biodata.umur;
            document.getElementById('display-alamat').textContent = biodata.alamat;
            document.getElementById('biodata-result').style.display = 'block';
        }
        
        // ===== BAGIAN KALKULATOR =====
        document.getElementById('calculator-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const angka1 = parseFloat(document.getElementById('angka1').value);
            const angka2 = parseFloat(document.getElementById('angka2').value);
            const operasi = document.getElementById('operasi').value;
            
            let hasil;
            switch (operasi) {
                case '+':
                    hasil = angka1 + angka2;
                    break;
                case '-':
                    hasil = angka1 - angka2;
                    break;
                case '*':
                    hasil = angka1 * angka2;
                    break;
                case '/':
                    hasil = angka2 !== 0 ? angka1 / angka2 : "Error: Pembagian dengan nol!";
                    break;
                default:
                    hasil = "Operasi tidak valid!";
            }
            
            document.getElementById('hasil-kalkulator').textContent = 
                `${angka1} ${operasi} ${angka2} = ${hasil}`;
            document.getElementById('calculator-result').style.display = 'block';
            
            // Reset form
            document.getElementById('calculator-form').reset();
        });
        
        // ===== BAGIAN DAFTAR BELANJA =====
        document.getElementById('shopping-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const barangBaru = document.getElementById('barang-baru').value.trim();
            if (barangBaru) {
                shoppingList.push(barangBaru);
                saveToLocalStorage();
                renderShoppingList();
            }
            
            // Reset form
            document.getElementById('shopping-form').reset();
        });
        
        function renderShoppingList() {
            const shoppingListElement = document.getElementById('shopping-list');
            shoppingListElement.innerHTML = '';
            
            if (shoppingList.length === 0) {
                shoppingListElement.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-shopping-basket"></i>
                        <p>Daftar belanja masih kosong</p>
                    </div>
                `;
                return;
            }
            
            shoppingList.forEach((barang, index) => {
                const li = document.createElement('li');
                li.className = 'shopping-item';
                li.innerHTML = `
                    <span>${index + 1}. ${barang}</span>
                    <div class="item-actions">
                        <button class="delete-btn" data-index="${index}" title="Hapus barang">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                shoppingListElement.appendChild(li);
            });
            
            // Tambahkan event listener untuk tombol hapus
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    shoppingList.splice(index, 1);
                    saveToLocalStorage();
                    renderShoppingList();
                });
            });
        }
        
        // Animasi untuk tombol
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            });
        });
        
        // Menambahkan placeholder untuk kalkulator berdasarkan operasi
        document.getElementById('operasi').addEventListener('change', function() {
            const operasi = this.value;
            const angka1 = document.getElementById('angka1');
            const angka2 = document.getElementById('angka2');
            
            if (operasi === '/') {
                angka1.placeholder = "Pembilang";
                angka2.placeholder = "Penyebut";
            } else {
                angka1.placeholder = "Angka pertama";
                angka2.placeholder = "Angka kedua";
            }
        });
        
        // Memuat data saat halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>
</html>
