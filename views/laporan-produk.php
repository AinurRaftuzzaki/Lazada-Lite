<?php

require_once '../config/database.php';
$produkTerlaris = mysqli_query($conn, "
    SELECT * FROM view_produk_terlaris
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Produk Terlaris</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] p-8">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-4xl font-bold text-[#0F0F1A]">
            Laporan Produk Terlaris
        </h1>

        <p class="text-gray-500 mt-2">
            Data produk paling laris berdasarkan VIEW database
        </p>

    </div>

    <!-- TABLE CARD -->
    <div class="bg-white rounded-2xl shadow-sm p-6">

        <!-- CARD HEADER -->
        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-semibold text-[#A855F7]">
                Top 5 Produk
            </h2>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <!-- TABLE HEAD -->
                <thead>

                    <tr class="border-b text-left">

                        <th class="py-4 text-gray-600">
                            Ranking
                        </th>

                        <th class="py-4 text-gray-600">
                            Nama Produk
                        </th>

                        <th class="py-4 text-gray-600">
                            Total Terjual
                        </th>

                        <th class="py-4 text-gray-600">
                            Total Pendapatan
                        </th>

                    </tr>

                </thead>

                <!-- TABLE BODY -->
                <tbody>

                    <?php
                    $ranking = 1;

                    while ($row = mysqli_fetch_assoc($produkTerlaris)) {
                    ?>

                    <tr class="border-b hover:bg-gray-50 transition duration-200">

                        <!-- RANKING -->
                        <td class="py-4 font-semibold text-[#A855F7]">
                            #<?php echo $ranking++; ?>
                        </td>

                        <!-- NAMA PRODUK -->
                        <td class="py-4 text-[#0F0F1A] font-medium">
                            <?php echo $row['nama_produk']; ?>
                        </td>

                        <!-- TOTAL TERJUAL -->
                        <td class="py-4 text-[#10B981] font-semibold">
                            <?php echo $row['total_terjual']; ?>
                        </td>

                        <!-- TOTAL PENDAPATAN -->
                        <td class="py-4 text-[#EF4444] font-semibold">
                            Rp <?php echo number_format($row['total_pendapatan']); ?>
                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</body>
</html>