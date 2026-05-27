<?php

require_once 'config/database.php';
$totalProdukQuery = mysqli_query($conn, "SELECT COUNT(*) AS total_produk FROM produk");
$totalProduk = mysqli_fetch_assoc($totalProdukQuery);
$totalPembeliQuery = mysqli_query($conn, "SELECT COUNT(*) AS total_pembeli FROM pembeli");

$totalPembeli = mysqli_fetch_assoc($totalPembeliQuery);
$totalTransaksiQuery = mysqli_query($conn, "SELECT COUNT(*) AS total_transaksi FROM pesanan");

$totalTransaksi = mysqli_fetch_assoc($totalTransaksiQuery);
$totalOmsetQuery = mysqli_query($conn, "SELECT SUM(total_harga) AS total_omset FROM pesanan");

$totalOmset = mysqli_fetch_assoc($totalOmsetQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lazada-Lite Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-[#F8F9FA]">
<div class="flex min-h-screen">
    <?php include 'components/sidebar.php'; ?>
<main class="flex-1 p-8">
<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold text-[#0F0F1A]">
            Dashboard
        </h1>

        <p class="text-gray-500 mt-1">
            Selamat datang di Lazada-Lite Admin Panel
        </p>
    </div>

    <div class="bg-white px-4 py-2 rounded-xl shadow-sm">
        <span class="text-sm text-gray-600">
            Admin Retail
        </span>
    </div>

</div>
<!-- STATISTICS CARDS -->
<div class="grid grid-cols-4 gap-6 mt-8">

    <!-- CARD TOTAL PRODUK -->
    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition duration-300">

        <p class="text-gray-500 text-sm">
            Total Produk
        </p>

        <h2 class="text-3xl font-bold text-[#A855F7] mt-2">
            <?php echo $totalProduk['total_produk']; ?>
        </h2>

    </div>

    <!-- CARD TOTAL PEMBELI -->
    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition duration-300">

        <p class="text-gray-500 text-sm">
            Total Pembeli
        </p>

        <h2 class="text-3xl font-bold text-[#10B981] mt-2">
            <?php echo $totalPembeli['total_pembeli']; ?>
        </h2>

    </div>

    <!-- CARD TOTAL TRANSAKSI -->
    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition duration-300">

        <p class="text-gray-500 text-sm">
            Total Transaksi
        </p>

        <h2 class="text-3xl font-bold text-[#F59E0B] mt-2">
            <?php echo $totalTransaksi['total_transaksi']; ?>
        </h2>

    </div>

    <!-- CARD TOTAL OMSET -->
    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition duration-300">

        <p class="text-gray-500 text-sm">
            Total Omset
        </p>

        <h2 class="text-3xl font-bold text-[#EF4444] mt-2">
            Rp <?php echo number_format($totalOmset['total_omset']); ?>
        </h2>

    </div>

</div>
</div>
</main>
</div>
</body>
</html>