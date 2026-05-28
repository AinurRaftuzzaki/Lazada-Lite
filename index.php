<?php

require_once 'config/database.php';

$produkQuery = mysqli_query($conn, "
    SELECT * FROM produk
    LIMIT 12
");

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

<!-- NAVBAR -->
<nav class="bg-gradient-to-r from-[#A855F7] to-[#9333EA] px-8 py-5 shadow-lg">

    <div class="flex items-center justify-between">

        <!-- LOGO -->
        <div>

            <h1 class="text-3xl font-extrabold text-white">
                Lazada-Lite
            </h1>

        </div>

        <!-- SEARCH -->
        <div class="w-[45%]">

            <input
                type="text"
                placeholder="Cari produk impianmu..."
                class="w-full px-5 py-3 rounded-2xl outline-none shadow-sm"
            >

        </div>

        <!-- MENU -->
        <div class="flex items-center gap-4 text-white font-medium">

            <a href="#" class="hover:text-purple-200 transition">
                Keranjang
            </a>

            <a href="#" class="hover:text-purple-200 transition">
                Wishlist
            </a>
            <a
                href="dashboard.php"
                class="bg-white text-[#9333EA] px-5 py-2 rounded-xl font-semibold hover:scale-105 hover:bg-purple-100 transition duration-300 shadow-sm"
            >
                Admin Dashboard
            </a>

        </div>

    </div>

</nav>

<!-- HERO -->
<section class="px-8 mt-8">

    <div class="bg-gradient-to-r from-[#A855F7] to-[#C084FC] rounded-3xl p-10 text-white shadow-xl">

        <div class="max-w-xl">

            <h2 class="text-5xl font-extrabold leading-tight">
                Lazada-Lite
            </h2>

            <p class="mt-4 text-purple-100 text-lg">
                Aplikasi belanja Modern
            </p>

            <button class="mt-6 bg-white text-[#9333EA] px-6 py-3 rounded-2xl font-semibold hover:scale-105 transition duration-300">
                Belanja Sekarang
            </button>

        </div>

    </div>

</section>

<!-- KATEGORI -->
<section class="px-8 mt-10">

    <div class="flex gap-4 flex-wrap">

        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm hover:-translate-y-1 transition duration-300 cursor-pointer">
             Elektronik
        </div>

        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm hover:-translate-y-1 transition duration-300 cursor-pointer">
             Fashion
        </div>

        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm hover:-translate-y-1 transition duration-300 cursor-pointer">
             Rumah Tangga
        </div>

        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm hover:-translate-y-1 transition duration-300 cursor-pointer">
             Beauty
        </div>

        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm hover:-translate-y-1 transition duration-300 cursor-pointer">
             Mainan
        </div>

    </div>

</section>

<!-- PRODUK -->
<section class="px-8 mt-12 mb-12">

    <div class="flex items-center justify-between mb-6">

        <h2 class="text-3xl font-bold text-[#0F0F1A]">
            Produk Pilihan
        </h2>

        <p class="text-gray-500">
            Top produk marketplace
        </p>

    </div>

    <div class="grid grid-cols-4 gap-6">

        <?php while ($produk = mysqli_fetch_assoc($produkQuery)) { ?>

        <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-1 transition duration-300">
            <!-- IMAGE -->
            <div class="h-52 overflow-hidden bg-white flex items-center justify-center">

                <img
                    src="assets/images/<?php echo $produk['gambar']; ?>"
                    alt=""
                    class="w-full h-full object-contain p-4 hover:scale-105 transition duration-500"
                >

            </div>

            <!-- CONTENT -->
            <div class="p-5">

                <h3 class="font-bold text-lg text-[#0F0F1A]">
                    <?php echo $produk['nama_produk']; ?>
                </h3>

                <p class="text-[#EF4444] text-2xl font-extrabold mt-3">
                    Rp <?php echo number_format($produk['harga']); ?>
                </p>

                <div class="flex items-center justify-between mt-4">

                    <span class="text-sm text-gray-500">
                        Stok: <?php echo $produk['stok']; ?>
                    </span>

                    <button class="bg-[#A855F7] hover:bg-[#9333EA] text-white px-4 py-2 rounded-xl text-sm transition duration-300">
                        Beli
                    </button>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</section>

</body>
</html>