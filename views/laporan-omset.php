<?php

require_once '../config/database.php';

$omsetQuery = mysqli_query($conn, "
    SELECT * FROM view_ringkasan_omset
");

$dataOmset = mysqli_fetch_assoc($omsetQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Omset</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA]">

    <div class="flex min-h-screen">

    <?php include '../components/sidebar.php'; ?>

    <main class="flex-1 p-8">
        <div class="mb-8">

        <h1 class="text-4xl font-bold text-[#0F0F1A]">
            Laporan Omset
        </h1>

        <p class="text-gray-500 mt-2">
            Ringkasan omset toko menggunakan VIEW database
        </p>

        </div>

        <div class="grid grid-cols-3 gap-6">
            <div class="bg-white p-8 rounded-2xl shadow-sm">

            <p class="text-gray-500 text-sm">
                Total Transaksi
            </p>

            <h2 class="text-3xl font-bold text-[#A855F7] mt-2">
                <?php echo $dataOmset['total_transaksi']; ?>
            </h2>

            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm">

            <p class="text-gray-500 text-sm">
                Total Omset
            </p>

            <h2 class="text-3xl font-bold text-[#10B981] mt-2">
                Rp <?php echo number_format($dataOmset['total_omset']); ?>
            </h2>

            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm">

            <p class="text-gray-500 text-sm">
                Rata-rata Transaksi
            </p>

            <h2 class="text-3xl font-bold text-[#EF4444] mt-2">
                Rp <?php echo number_format($dataOmset['rata_rata_transaksi']); ?>
            </h2>

            </div>
        </div>

    </main>

    </div>

</body>
</html>