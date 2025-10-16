<?php
session_start();

// Inisialisasi session jika belum ada
if (!isset($_SESSION['biodata'])) {
    $_SESSION['biodata'] = [];
}
if (!isset($_SESSION['daftar_belanja'])) {
    $_SESSION['daftar_belanja'] = ['Beras', 'Gula', 'Telur', 'Minyak Goreng'];
}
if (!isset($_SESSION['kalkulator'])) {
    $_SESSION['kalkulator'] = [
        'angka1' => '',
        'angka2' => '',
        'operasi' => '+',
        'hasil' => ''
    ];
}

// ===== BAGIAN BIODATA =====
if (isset($_POST['submit_biodata'])) {
    $_SESSION['biodata'] = [
        'nama' => htmlspecialchars($_POST['nama']),
        'umur' => htmlspecialchars($_POST['umur']),
        'alamat' => htmlspecialchars($_POST['alamat'])
    ];
}

// ===== BAGIAN KALKULATOR =====
function kalkulator($angka1, $angka2, $operasi) {
    switch ($operasi) {
        case '+':
            return $angka1 + $angka2;
        case '-':
            return $angka1 - $angka2;
        case '*':
            return $angka1 * $angka2;
        case '/':
            return $angka2 != 0 ? $angka1 / $angka2 : "Error: Pembagian dengan nol!";
        default:
            return "Operasi tidak valid!";
    }
}

if (isset($_POST['submit_kalkulator'])) {
    $angka1 = floatval($_POST['angka1']);
    $angka2 = floatval($_POST['angka2']);
    $operasi = $_POST['operasi'];
    $hasil_kalkulator = kalkulator($angka1, $angka2, $operasi);
    
    // Simpan state kalkulator ke session
    $_SESSION['kalkulator'] = [
        'angka1' => $angka1,
        'angka2' => $angka2,
        'operasi' => $operasi,
        'hasil' => $hasil_kalkulator
    ];
} else {
    // Jika tidak ada submit, gunakan state dari session
    $hasil_kalkulator = $_SESSION['kalkulator']['hasil'];
}

// ===== BAGIAN DAFTAR BELANJA =====
if (isset($_POST['tambah_barang'])) {
    $belanja_baru = htmlspecialchars($_POST['barang_baru']);
    if (!empty($belanja_baru)) {
        $_SESSION['daftar_belanja'][] = $belanja_baru;
    }
}

// Hapus item belanja
if (isset($_POST['hapus_barang'])) {
    $index = intval($_POST['hapus_barang']);
    if (isset($_SESSION['daftar_belanja'][$index])) {
        array_splice($_SESSION['daftar_belanja'], $index, 1);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program PHP Modern</title>
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
        
        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }
        
        .btn-outline:hover {
            background: var(--primary);
            color: white;
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
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 15px;
            border-left: 4px solid #28a745;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background: white;
            border-radius: 8px;
            margin-bottom: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border-left: 3px solid var(--primary);
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
                <form method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="<?= isset($_SESSION['biodata']['nama']) ? $_SESSION['biodata']['nama'] : '' ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="umur">Umur</label>
                        <input type="number" id="umur" name="umur" value="<?= isset($_SESSION['biodata']['umur']) ? $_SESSION['biodata']['umur'] : '' ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="4" required><?= isset($_SESSION['biodata']['alamat']) ? $_SESSION['biodata']['alamat'] : '' ?></textarea>
                    </div>
                    
                    <button type="submit" name="submit_biodata" class="btn btn-block">
                        <i class="fas fa-save"></i> Simpan Biodata
                    </button>
                </form>

                <?php if (!empty($_SESSION['biodata'])): ?>
                    <div class="result-box">
                        <h3>Data Biodata Tersimpan:</h3>
                        <table>
                            <tr>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Alamat</th>
                            </tr>
                            <tr>
                                <td><?= $_SESSION['biodata']['nama'] ?></td>
                                <td><?= $_SESSION['biodata']['umur'] ?></td>
                                <td><?= $_SESSION['biodata']['alamat'] ?></td>
                            </tr>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- KALKULATOR -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-calculator"></i>
                <h2>Kalkulator Sederhana</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="calculator-inputs">
                        <input type="number" step="any" name="angka1" placeholder="Angka pertama" 
                               value="<?= $_SESSION['kalkulator']['angka1'] ?>" required>
                        <select name="operasi" required>
                            <option value="+" <?= $_SESSION['kalkulator']['operasi'] == '+' ? 'selected' : '' ?>>+</option>
                            <option value="-" <?= $_SESSION['kalkulator']['operasi'] == '-' ? 'selected' : '' ?>>-</option>
                            <option value="*" <?= $_SESSION['kalkulator']['operasi'] == '*' ? 'selected' : '' ?>>×</option>
                            <option value="/" <?= $_SESSION['kalkulator']['operasi'] == '/' ? 'selected' : '' ?>>÷</option>
                        </select>
                        <input type="number" step="any" name="angka2" placeholder="Angka kedua" 
                               value="<?= $_SESSION['kalkulator']['angka2'] ?>" required>
                    </div>
                    <button type="submit" name="submit_kalkulator" class="btn btn-block">
                        <i class="fas fa-equals"></i> Hitung
                    </button>
                </form>

                <?php if (!empty($_SESSION['kalkulator']['hasil'])): ?>
                    <div class="result-box">
                        <h3>Hasil Perhitungan:</h3>
                        <p style="font-size: 1.5rem; font-weight: bold; color: var(--primary);">
                            <?= $_SESSION['kalkulator']['angka1'] ?> 
                            <?= $_SESSION['kalkulator']['operasi'] ?> 
                            <?= $_SESSION['kalkulator']['angka2'] ?> 
                            = <?= $_SESSION['kalkulator']['hasil'] ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- DAFTAR BELANJA -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-shopping-cart"></i>
                <h2>Daftar Belanja</h2>
            </div>
            <div class="card-body">
                <form method="POST" class="form-group">
                    <div class="calculator-inputs">
                        <input type="text" name="barang_baru" placeholder="Tambahkan barang ke daftar belanja..." required>
                        <button type="submit" name="tambah_barang" class="btn">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </form>

                <h3>Daftar Barang:</h3>
                <?php if (!empty($_SESSION['daftar_belanja'])): ?>
                    <ul class="shopping-list">
                        <?php foreach ($_SESSION['daftar_belanja'] as $index => $barang): ?>
                            <li class="shopping-item">
                                <span><?= ($index + 1) . '. ' . $barang ?></span>
                                <div class="item-actions">
                                    <form method="POST" style="display: inline;">
                                        <button type="submit" name="hapus_barang" value="<?= $index ?>" class="delete-btn" title="Hapus barang">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-shopping-basket"></i>
                        <p>Daftar belanja masih kosong</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
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
        document.querySelector('select[name="operasi"]').addEventListener('change', function() {
            const operasi = this.value;
            const inputs = document.querySelectorAll('input[type="number"]');
            
            if (operasi === '/') {
                inputs[0].placeholder = "Pembilang";
                inputs[1].placeholder = "Penyebut";
            } else {
                inputs[0].placeholder = "Angka pertama";
                inputs[1].placeholder = "Angka kedua";
            }
        });
    </script>
</body>
</html>