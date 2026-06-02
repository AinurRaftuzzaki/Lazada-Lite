<?php

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<aside class="w-72 min-h-screen bg-gradient-to-b from-[#A855F7] to-[#9333EA] text-white px-6 py-8 shadow-2xl">

    <!-- LOGO -->
    <div class="mb-12">

        <h1 class="text-4xl font-extrabold tracking-wide">
            Lazada-Lite
        </h1>

        <p class="text-purple-200 text-sm mt-2">
            Analytics Dashboard
        </p>

    </div>

    <!-- MENU -->
    <ul class="space-y-3">

        <!-- DASHBOARD -->
        <li>

            <a href="../dashboard.php"
            class="flex items-center gap-3 px-5 py-4 rounded-2xl transition duration-300 font-medium
            <?php echo ($currentPage == 'dashboard.php') ? 'bg-white/20 shadow-lg backdrop-blur-sm' : 'hover:bg-white/10'; ?>">

                 Dashboard

            </a>

        </li>

        <!-- LAPORAN PRODUK -->
        <li>

            <a href="../views/laporan-produk.php"
            class="flex items-center gap-3 px-5 py-4 rounded-2xl transition duration-300 font-medium
            <?php echo ($currentPage == 'laporan-produk.php') ? 'bg-white/20 shadow-lg backdrop-blur-sm' : 'hover:bg-white/10'; ?>">

                 Laporan Produk

            </a>

        </li>

        <!-- LAPORAN OMSET -->
        <li>

            <a href="../views/laporan-omset.php"
            class="flex items-center gap-3 px-5 py-4 rounded-2xl transition duration-300 font-medium
            <?php echo ($currentPage == 'laporan-omset.php') ? 'bg-white/20 shadow-lg backdrop-blur-sm' : 'hover:bg-white/10'; ?>">

                 Laporan Omset

            </a>

        </li>

        <!-- CURSOR -->
        <li>

            <a href="../cursor/rekap-cursor.php"
            class="flex items-center gap-3 px-5 py-4 rounded-2xl transition duration-300 font-medium
            <?php echo ($currentPage == 'rekap-cursor.php') ? 'bg-white/20 shadow-lg backdrop-blur-sm' : 'hover:bg-white/10'; ?>">

                 Rekap Cursor

            </a>

        </li>

        <li>

            <a href="../views/stock & invoice.php"
            class="flex items-center gap-3 px-5 py-4 rounded-2xl transition duration-300 font-medium
            <?php echo ($currentPage == 'stock & invoice.php') ? 'bg-white/20 shadow-lg backdrop-blur-sm' : 'hover:bg-white/10'; ?>">

                 Stock & Invoice

            </a>

        </li>

    </ul>

</aside>