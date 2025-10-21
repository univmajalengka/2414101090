<?php
// admin_pesanan.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Kasir - WarungKita</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: "Poppins", sans-serif;
      background: #f5f6fa;
      color: #2d3436;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      background: linear-gradient(90deg, #2c3e50, #34495e);
      color: #fff;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    header h1 { font-size: 1.4rem; font-weight: 600; }

    header .actions button {
      background: #27ae60;
      border: none;
      color: white;
      padding: 8px 14px;
      border-radius: 8px;
      cursor: pointer;
      margin-left: 8px;
      transition: 0.3s;
    }

    header .actions button:hover {
      transform: scale(1.05);
      opacity: 0.9;
    }

    header .logout { background: #e74c3c; }

    main {
      flex: 1;
      padding: 25px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    .dashboard {
      width: 100%;
      max-width: 1100px;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      padding: 30px;
      animation: fadeIn 0.5s ease;
    }

    .dashboard h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 1.5rem;
      color: #2c3e50;
      font-weight: 600;
    }

    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { padding: 12px 14px; border-bottom: 1px solid #e0e0e0; text-align: left; }
    th { background: #2c3e50; color: #fff; font-weight: 600; }
    tr:hover { background: #f8f9fa; transition: 0.2s; }

    .total { font-weight: 600; color: #27ae60; }

    .btn {
      padding: 6px 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      color: white;
      font-size: 0.85rem;
      transition: 0.3s;
    }
    .btn-edit { background: #3498db; }
    .btn-delete { background: #e74c3c; margin-left: 6px; }
    .btn:hover { opacity: 0.85; }

    .footer {
      text-align: center;
      padding: 15px;
      font-size: 0.9rem;
      background: #2c3e50;
      color: #ecf0f1;
    }

    .popup {
      position: fixed;
      top: 30px; right: 30px;
      background: #27ae60;
      color: #fff;
      padding: 16px 22px;
      border-radius: 12px;
      font-size: 1rem;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      animation: slideIn 0.6s ease, fadeOut 0.5s ease 3.5s forwards;
      z-index: 2000;
    }

    @keyframes slideIn { from { opacity: 0; transform: translateY(-15px);} to { opacity: 1; transform: translateY(0);} }
    @keyframes fadeOut { to { opacity: 0; transform: translateY(-10px);} }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px);} to { opacity: 1; transform: translateY(0);} }
  </style>
</head>
<body>

<header>
  <h1>💼 Dashboard Kasir - WarungKita</h1>
  <div class="actions">
    <button onclick="location.reload()">🔄 Refresh</button>
    <button class="logout" onclick="logout()">🚪 Logout</button>
  </div>
</header>

<main>
  <div class="dashboard">
    <h2>📋 Riwayat Pesanan Pelanggan</h2>
    <table id="tabelPesanan">
      <thead>
        <tr>
          <th>NO</th>
          <th>Nama</th>
          <th>Menu</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
          <th>Catatan</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="9" style="text-align:center; color:#888;">Memuat data...</td></tr>
      </tbody>
    </table>
  </div>
</main>

<div class="footer">
  &copy; <span id="year"></span> WarungKita. Dibuat dengan ❤️ dan rasa lapar.
</div>

<script>
document.getElementById("year").textContent = new Date().getFullYear();

// === LOAD DATA PESANAN ===
async function loadPesanan() {
  try {
    const res = await fetch('get_pesanan.php');
    const data = await res.json();
    const tbody = document.querySelector('#tabelPesanan tbody');
    tbody.innerHTML = '';

    if (data.length === 0) {
      tbody.innerHTML = `<tr><td colspan="9" style="text-align:center; color:#999;">Belum ada pesanan</td></tr>`;
      return;
    }

    data.forEach((p, i) => {
      const row = `
        <tr>
          <td data-label="#">${i + 1}</td>
          <td data-label="Nama">${p.nama}</td>
          <td data-label="Menu">${p.menu}</td>
          <td data-label="Jumlah">${p.jumlah}</td>
          <td data-label="Harga">Rp${parseInt(p.harga).toLocaleString()}</td>
          <td data-label="Total" class="total">Rp${parseInt(p.total).toLocaleString()}</td>
          <td data-label="Catatan">${p.catatan || '-'}</td>
          <td data-label="Tanggal">${p.tanggal}</td>
          <td data-label="Aksi">
            <button class="btn btn-edit" onclick="editPesanan(${p.id})">Edit</button>
            <button class="btn btn-delete" onclick="hapusPesanan(${p.id})">Hapus</button>
          </td>
        </tr>`;
      tbody.insertAdjacentHTML('beforeend', row);
    });
  } catch (e) {
    console.error("Gagal memuat data:", e);
  }
}

loadPesanan();

// === EDIT PESANAN ===
async function editPesanan(id, nama, menu, jumlah, harga, catatan) {
  const namaBaru = prompt("Nama:", nama);
  const menuBaru = prompt("Menu:", menu);
  const jumlahBaru = prompt("Jumlah:", jumlah);
  const hargaBaru = prompt("Harga per item:", harga);
  const catatanBaru = prompt("Catatan:", catatan);

  if (!namaBaru || !menuBaru || !jumlahBaru || !hargaBaru) return;

  const totalBaru = jumlahBaru * hargaBaru;

  const res = await fetch('edit_pesanan.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `id=${id}&nama=${encodeURIComponent(namaBaru)}&menu=${encodeURIComponent(menuBaru)}&jumlah=${jumlahBaru}&harga=${hargaBaru}&total=${totalBaru}&catatan=${encodeURIComponent(catatanBaru)}`
  });

  const result = await res.text();
  showPopup(result);
  loadPesanan();
}


// === HAPUS PESANAN ===
async function hapusPesanan(id) {
  if (!confirm("Yakin ingin menghapus pesanan ini?")) return;

  const res = await fetch('hapus_pesanan.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `id=${id}`
  });

  const result = await res.text();
  showPopup(result);
  loadPesanan();
}

// === LOGOUT ===
function logout() {
  if (confirm("Yakin ingin logout dari Dashboard Kasir?")) {
    localStorage.removeItem("isLoggedIn");
    alert("Anda telah logout. Sampai jumpa!");
    window.location.href = "../index.html";
  }
}


// === POPUP SELAMAT DATANG ===
window.addEventListener("DOMContentLoaded", () => {
  const justLoggedIn = localStorage.getItem("justLoggedIn");
  if (justLoggedIn === "true") {
    showPopup("✅ Login berhasil! Selamat datang di Dashboard Kasir 👋");
    localStorage.removeItem("justLoggedIn");
  }
});

function showPopup(msg) {
  const popup = document.createElement("div");
  popup.className = "popup";
  popup.textContent = msg;
  document.body.appendChild(popup);
  setTimeout(() => popup.remove(), 4000);
}
</script>

</body>
</html>
