<?php

require_once '../config/database.php';
$success = false;
$resetSuccess = false;

if (isset($_POST['generate_bonus'])) {

    mysqli_query($conn, "CALL rekap_bonus_penjual()");

    $success = true;
}

if (isset($_POST['reset_bonus'])) {

    mysqli_query($conn, "TRUNCATE TABLE bonus_penjual");

    $resetSuccess = true;
}
$dataBonus = mysqli_query($conn, "
    SELECT * FROM bonus_penjual
    ORDER BY id_bonus DESC
");

$totalSellerQuery = mysqli_query($conn, "
    SELECT COUNT(*) AS total_seller
    FROM bonus_penjual
");

$totalSeller = mysqli_fetch_assoc($totalSellerQuery);

$totalBonusQuery = mysqli_query($conn, "
    SELECT SUM(total_bonus) AS total_bonus
    FROM bonus_penjual
");

$totalBonus = mysqli_fetch_assoc($totalBonusQuery);

$bonusTertinggiQuery = mysqli_query($conn, "
    SELECT MAX(total_bonus) AS bonus_tertinggi
    FROM bonus_penjual
");

$bonusTertinggi = mysqli_fetch_assoc($bonusTertinggiQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rekap Bonus Penjual</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA]">

    <div class="flex min-h-screen">
        <?php include '../components/sidebar.php'; ?>
        <main class="flex-1 p-8">
            <div class="mb-8">

            <h1 class="text-4xl font-bold text-[#0F0F1A]">
                Rekap Bonus Penjual
            </h1>

            <p class="text-gray-500 mt-2">
                Implementasi Cursor untuk proses bonus seller otomatis
            </p>

    </div>

    <?php if ($success) { ?>

    <div class="bg-[#DCFCE7] border border-[#10B981] text-[#166534] px-6 py-4 rounded-2xl mb-6 shadow-sm">

        Rekap bonus seller berhasil digenerate!

    </div>

    <?php if ($resetSuccess) { ?>

    <div class="bg-[#FEE2E2] border border-[#EF4444] text-[#991B1B] px-6 py-4 rounded-2xl mb-6 shadow-sm">

        Data bonus seller berhasil direset!

    </div>

    <?php } ?>

    <?php } ?>

    <div class="flex gap-4 mb-8">

    <form method="POST">

        <button
            type="submit"
            name="generate_bonus"
            class="bg-[#A855F7] hover:bg-[#9333EA] text-white px-6 py-3 rounded-xl shadow-sm transition duration-300"
        >
            Generate Rekap Cursor
        </button>

    </form>

    <form method="POST">

        <button
            type="submit"
            name="reset_bonus"
            class="bg-[#EF4444] hover:bg-[#DC2626] text-white px-6 py-3 rounded-xl shadow-sm transition duration-300"
        >
            Reset Rekap
        </button>

    </form>

    </div>

    <div class="grid grid-cols-3 gap-6 mb-8">

    <!-- TOTAL SELLER -->
    <div class="bg-white p-6 rounded-2xl shadow-sm">

        <p class="text-gray-500 text-sm">
            Total Seller
        </p>

        <h2 class="text-3xl font-bold text-[#A855F7] mt-2">
            <?php echo $totalSeller['total_seller']; ?>
        </h2>

    </div>

    <!-- TOTAL BONUS -->
    <div class="bg-white p-6 rounded-2xl shadow-sm">

        <p class="text-gray-500 text-sm">
            Total Bonus Dibagikan
        </p>

        <h2 class="text-3xl font-bold text-[#10B981] mt-2">
            Rp <?php echo number_format($totalBonus['total_bonus'] ?? 0); ?>
        </h2>

    </div>

    <!-- BONUS TERTINGGI -->
    <div class="bg-white p-6 rounded-2xl shadow-sm">

        <p class="text-gray-500 text-sm">
            Bonus Tertinggi
        </p>

        <h2 class="text-3xl font-bold text-[#EF4444] mt-2">
            Rp <?php echo number_format($bonusTertinggi['bonus_tertinggi'] ?? 0); ?>
        </h2>

    </div>

</div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <h2 class="text-2xl font-semibold text-[#A855F7] mb-6">
        Hasil Rekap Bonus Seller
        </h2>
    <div class="overflow-x-auto">

    <table class="w-full">
        <thead>

            <tr class="border-b text-left">

            <th class="py-4 text-gray-600">
                Nama Penjual
            </th>

            <th class="py-4 text-gray-600">
                Total Penjualan
            </th>

            <th class="py-4 text-gray-600">
                Total Bonus
            </th>

            <th class="py-4 text-gray-600">
                Tanggal Rekap
            </th>

            </tr>

        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_assoc($dataBonus)) { ?>

            <tr class="border-b hover:bg-gray-50 transition duration-200">
                <td class="py-4 font-medium text-[#0F0F1A]">
                <?php echo $row['nama_penjual']; ?>
                </td>
                <td class="py-4 text-[#10B981] font-semibold">
                <?php echo $row['total_penjualan']; ?>
                </td>
                <td class="py-4 text-[#A855F7] font-bold">
                Rp <?php echo number_format($row['total_bonus']); ?>
                </td>
                <td class="py-4 text-gray-500">
                <?php echo $row['tanggal_rekap']; ?>
                </td>
            </tr>
            <?php } ?>  
        
        </tbody>

    </table>

    </div>

    </div>

    </main>

    </div>

</body>
</html>