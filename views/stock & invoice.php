<?php

require_once '../config/database.php';

$query_logs = "SELECT p.kode_invoice, b.nama_pembeli, pr.nama_produk, dp.jumlah, p.total_harga, pr.stok AS sisa_stok_sekarang
               FROM detail_pesanan dp
               JOIN pesanan p ON dp.id_pesanan = p.id_pesanan
               JOIN pembeli b ON p.id_pembeli = b.id_pembeli
               JOIN produk pr ON dp.id_produk = pr.id_produk
               ORDER BY p.id_pesanan DESC LIMIT 10";

$riwayat_transaksi = mysqli_query($conn, $query_logs);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lazada-Lite - Monitoring Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA]">
<div class="flex min-h-screen">
    
    <?php include '../components/sidebar.php'; ?>

    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#0F0F1A]">Monitoring Transaksi</h1>
            </div>
            <div class="bg-white px-4 py-2 rounded-xl shadow-sm">
                <span class="text-sm text-[#10B981] font-bold">Role: Admin Utama</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="mb-4">
                <h3 class="text-base font-bold text-gray-800">Invoice Masuk & Log Kontrol Stok</h3>
                <p class="text-xs text-gray-400 mt-0.5">Kolom <span class="text-purple-600 font-bold">Total Bayar</span> dikalkulasi otomatis oleh SP, sedangkan <span class="text-purple-600 font-bold">Stok Real</span> dipotong otomatis oleh Trigger.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 uppercase font-bold border-b border-gray-100">
                            <th class="py-3 px-4">Kode Invoice</th>
                            <th class="py-3 px-4">Nama Pembeli</th>
                            <th class="py-3 px-4">Nama Produk</th>
                            <th class="py-3 px-4 text-center">QTY</th>
                            <th class="py-3 px-4 text-right">Total Bayar (Diskon)</th>
                            <th class="py-3 px-4 bg-purple-50 text-purple-700 text-center font-bold">Stok Gudang Real-Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-600">
                        <?php if (mysqli_num_rows($riwayat_transaksi) == 0): ?>
                            <tr><td colspan="6" class="py-6 text-center italic text-gray-400">Belum ada transaksi log retail yang tercatat.</td></tr>
                        <?php else: ?>
                            <?php while ($tx = mysqli_fetch_assoc($riwayat_transaksi)): ?>
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-3 px-4 font-mono font-bold text-gray-700"><?php echo $tx['kode_invoice']; ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($tx['nama_pembeli']); ?></td>
                                    <td class="py-3 px-4 font-bold text-gray-800"><?php echo htmlspecialchars($tx['nama_produk']); ?></td>
                                    <td class="py-3 px-4 text-center font-mono"><?php echo $tx['jumlah']; ?></td>
                                    <td class="py-3 px-4 text-right font-mono font-bold text-slate-900">Rp <?php echo number_format($tx['total_harga']); ?></td>
                                    <td class="py-3 px-4 text-center font-mono font-black text-purple-700 bg-purple-50/40 rounded-lg"><?php echo $tx['sisa_stok_sekarang']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
</html>