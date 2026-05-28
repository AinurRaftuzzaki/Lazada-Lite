<?php

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<aside class="w-64 bg-[#A855F7] text-white p-6">

    <h1 class="text-2xl font-bold mb-10">
        Lazada-Lite
    </h1>

    <ul class="space-y-4">

        <!-- DASHBOARD -->
        <li>

            <a href="../dashboard.php"
            class="block px-4 py-3 rounded-xl transition duration-300 <?php echo ($currentPage == 'dashboard.php') ? 'bg-[#C084FC]' : 'hover:bg-[#C084FC]'; ?>">

                Dashboard

            </a>

        </li>

        <!-- LAPORAN PRODUK -->
        <li>

            <a href="../views/laporan-produk.php"
            class="block px-4 py-3 rounded-xl transition duration-300 <?php echo ($currentPage == 'laporan-produk.php') ? 'bg-[#C084FC]' : 'hover:bg-[#C084FC]'; ?>">

                Laporan Produk

            </a>

        </li>

        <!-- LAPORAN OMSET -->
        <li>

            <a href="../views/laporan-omset.php"
            class="block px-4 py-3 rounded-xl transition duration-300 <?php echo ($currentPage == 'laporan-omset.php') ? 'bg-[#C084FC]' : 'hover:bg-[#C084FC]'; ?>">

                Laporan Omset

            </a>

        </li>

        <!-- REKAP CURSOR -->
        <li>

            <a href="../cursor/rekap-cursor.php"
            class="block px-4 py-3 rounded-xl transition duration-300 <?php echo ($currentPage == 'rekap-cursor.php') ? 'bg-[#C084FC]' : 'hover:bg-[#C084FC]'; ?>">

                Rekap Cursor

            </a>

        </li>

    </ul>

</aside>    