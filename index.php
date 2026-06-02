<?php

require_once 'config/database.php';

$status_message = "";
$status_type = ""; 

// --- PROSES EKSEKUSI STORED PROCEDURE SAAT TOMBOL DIKLIK ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['proses_beli'])) {
    $id_pembeli = intval($_POST['id_pembeli']);
    $id_produk  = intval($_POST['id_produk']);
    $jumlah     = intval($_POST['jumlah']);

    if ($jumlah <= 0) {
        $status_message = "Jumlah pembelian minimal harus 1 item!";
        $status_type = "error";
    } else {
        // Memanggil Stored Procedure buatanmu
        $query_call = "CALL proses_transaksi_belanja($id_pembeli, $id_produk, $jumlah, @status_out)";
        
        if (mysqli_query($conn, $query_call)) {
            // Mengambil parameter OUT @status_out
            $result_status = mysqli_query($conn, "SELECT @status_out AS pesan");
            $row_status = mysqli_fetch_assoc($result_status);
            $status_message = $row_status['pesan'];

            if (strpos($status_message, 'Ditolak') !== false) {
                $status_type = "error";
            } else {
                $status_type = "success";
            }
        } else {
            $status_message = "Gagal memproses pembelian: " . mysqli_error($conn);
            $status_type = "error";
        }
    }
}

// Ambil data produk untuk ditampilkan di halaman utama
$produkQuery = mysqli_query($conn, "SELECT * FROM produk LIMIT 12");

// Ambil data pembeli untuk opsi akun di modal simulasi
$pembeliQuery = mysqli_query($conn, "SELECT id_pembeli, nama_pembeli FROM pembeli ORDER BY id_pembeli ASC LIMIT 20");
$pembeli_options = [];
while ($row = mysqli_fetch_assoc($pembeliQuery)) {
    $pembeli_options[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lazada-Lite Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F9FA]">

<nav class="bg-gradient-to-r from-[#A855F7] to-[#9333EA] px-8 py-5 shadow-lg">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-white">Lazada-Lite</h1>
        </div>

        <div class="w-[45%]">
            <input type="text" placeholder="Cari produk impianmu..." class="w-full px-5 py-3 rounded-2xl outline-none shadow-sm">
        </div>

        <div class="flex items-center gap-4 text-white font-medium">
            <a href="#" class="hover:text-purple-200 transition">Keranjang</a>
            <a href="#" class="hover:text-purple-200 transition">Wishlist</a>
            <a href="dashboard.php" class="bg-white text-[#9333EA] px-5 py-2 rounded-xl font-semibold hover:scale-105 hover:bg-purple-100 transition duration-300 shadow-sm">
                Admin Dashboard
            </a>
        </div>
    </div>
</nav>

<?php if (!empty($status_message)): ?>
    <div class="mx-8 mt-6 p-4 rounded-2xl border text-sm <?php echo $status_type === 'success' ? 'bg-emerald-50 border-emerald-200 text-emerald-800' : 'bg-red-50 border-red-200 text-red-800'; ?>">
        <div class="flex items-center gap-2">
            <span><?php echo $status_type === 'success' ? '✅' : '❌'; ?></span>
            <span class="font-bold"><?php echo $status_message; ?></span>
        </div>
    </div>
<?php endif; ?>

<section class="px-8 mt-8">
    <div class="bg-gradient-to-r from-[#A855F7] to-[#C084FC] rounded-3xl p-10 text-white shadow-xl">
        <div class="max-w-xl">
            <h2 class="text-5xl font-extrabold leading-tight">Lazada-Lite</h2>
            <p class="mt-4 text-purple-100 text-lg">Aplikasi belanja Modern</p>
            <button class="mt-6 bg-white text-[#9333EA] px-6 py-3 rounded-2xl font-semibold hover:scale-105 transition duration-300">
                Belanja Sekarang
            </button>
        </div>
    </div>
</section>

<section class="px-8 mt-10">
    <div class="flex gap-4 flex-wrap">
        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm hover:-translate-y-1 transition duration-300 cursor-pointer">Elektronik</div>
        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm hover:-translate-y-1 transition duration-300 cursor-pointer">Fashion</div>
        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm hover:-translate-y-1 transition duration-300 cursor-pointer">Rumah Tangga</div>
        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm hover:-translate-y-1 transition duration-300 cursor-pointer">Beauty</div>
        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm hover:-translate-y-1 transition duration-300 cursor-pointer">Mainan</div>
    </div>
</section>

<section class="px-8 mt-12 mb-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-bold text-[#0F0F1A]">Produk Pilihan</h2>
        <p class="text-gray-500">Top produk marketplace</p>
    </div>

    <div class="grid grid-cols-4 gap-6">
        <?php while ($produk = mysqli_fetch_assoc($produkQuery)) { ?>
        <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between">
            <div>
                <div class="h-52 overflow-hidden bg-white flex items-center justify-center">
                    <img src="assets/images/<?php echo $produk['gambar']; ?>" alt="" class="w-full h-full object-contain p-4 hover:scale-105 transition duration-500">
                </div>

                <div class="p-5 pb-0">
                    <h3 class="font-bold text-lg text-[#0F0F1A] line-clamp-2"><?php echo $produk['nama_produk']; ?></h3>
                    <p class="text-[#EF4444] text-2xl font-extrabold mt-3">Rp <?php echo number_format($produk['harga']); ?></p>
                </div>
            </div>

            <div class="p-5 pt-0">
                <div class="flex items-center justify-between mt-4">
                    <span class="text-sm text-gray-500">Stok: <?php echo $produk['stok']; ?></span>
                    <button onclick="bukaModal(<?php echo $produk['id_produk']; ?>, '<?php echo htmlspecialchars($produk['nama_produk']); ?>', <?php echo $produk['stok']; ?>)" class="bg-[#A855F7] hover:bg-[#9333EA] text-white px-4 py-2 rounded-xl text-sm transition duration-300 font-medium">
                        Beli
                    </button>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<div id="modalBelanja" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-3xl shadow-2xl max-w-md w-full border border-gray-100 mx-4">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="font-bold text-xl text-gray-900">Konfirmasi Pembelian</h3>
                <p id="modalNamaProduk" class="text-sm text-purple-600 font-semibold mt-1"></p>
            </div>
            <button onclick="tutupModal()" class="text-gray-400 hover:text-gray-600 font-bold text-lg">&times;</button>
        </div>

        <form action="" method="POST" class="space-y-4">
            <input type="hidden" id="modalIdProduk" name="id_produk">

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Gunakan Akun Pembeli</label>
                <select name="id_pembeli" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-xs focus:ring-2 focus:ring-[#A855F7] outline-none" required>
                    <?php foreach ($pembeli_options as $pembeli): ?>
                        <option value="<?php echo $pembeli['id_pembeli']; ?>">ID: <?php echo $pembeli['id_pembeli']; ?> - <?php echo htmlspecialchars($pembeli['nama_pembeli']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jumlah Item</label>
                <input type="number" id="modalJumlah" name="jumlah" value="1" min="1" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-xs focus:ring-2 focus:ring-[#A855F7] outline-none" required>
                <p id="modalStokInfo" class="text-[11px] text-gray-400 mt-1"></p>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" onclick="tutupModal()" class="w-1/2 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2.5 rounded-xl text-xs transition">Batal</button>
                <button type="submit" name="proses_beli" class="w-1/2 bg-[#A855F7] hover:bg-[#9333EA] text-white font-bold py-2.5 rounded-xl text-xs transition shadow-md shadow-purple-100">Beli</button>
            </div>
        </form>
    </div>
</div>

<script>
function bukaModal(id, nama, stok) {
    document.getElementById('modalIdProduk').value = id;
    document.getElementById('modalNamaProduk').innerText = nama;
    document.getElementById('modalStokInfo').innerText = "Stok Gudang Tersedia: " + stok;
    document.getElementById('modalJumlah').max = stok + 5;
    document.getElementById('modalBelanja').classList.remove('hidden');
}

function tutupModal() {
    document.getElementById('modalBelanja').classList.add('hidden');
}
</script>

</body>
</html>