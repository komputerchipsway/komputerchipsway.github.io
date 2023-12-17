<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../components/connect.php';

$selected_month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    $select_monthly_sales = $conn->prepare("SELECT SUM(total_price) as total_monthly_sales FROM sales WHERE DATE_FORMAT(date, '%Y-%m') = :selected_month");
    $select_monthly_sales->bindParam(':selected_month', $selected_month);
    $select_monthly_sales->execute();
    $total_monthly_sales = 0;

    if ($select_monthly_sales->rowCount() > 0) {
        $fetch_monthly_sales = $select_monthly_sales->fetch(PDO::FETCH_ASSOC);
        $total_monthly_sales = $fetch_monthly_sales['total_monthly_sales'];
    }

    $select_monthly_sales_details = $conn->prepare("SELECT * FROM sales WHERE DATE_FORMAT(date, '%Y-%m') = :selected_month");
    $select_monthly_sales_details->bindParam(':selected_month', $selected_month);
    $select_monthly_sales_details->execute();

    $monthly_sales_data = $select_monthly_sales_details->fetchAll(PDO::FETCH_ASSOC);

    $response = [
        'html' => '',
        'totalMonthlySales' => $total_monthly_sales,
    ];

    ob_start();

    if (count($monthly_sales_data) > 0) {
        ?>
        <br></br>
        <p><a style="font-size: 18px; color: black; font-weight: bold;">Jumlah Keseluruhan Bulan ini: </a><br></br><span style="font-size: 18px; color: red; font-weight: bold;">[RM <?= $total_monthly_sales ?>]</span></p>
        <table class="sales-table">
            <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Kuantiti</th>
                <th>Harga Jual</th>
                <th>Jumlah</th>
                <th>Tarikh</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $salesNumber = 1; // Initialize $salesNumber
            foreach ($monthly_sales_data as $row):
                ?>
                <tr style="font-size: 13px; font-weight: bold;">
                    <td><?= $salesNumber++; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['quantity']; ?></td>
                    <td>RM <?= $row['sale_price']; ?></td>
                    <td>RM <?= $row['total_price']; ?></td>
                    <td><?= $row['date']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    } else {
        echo '<br></br><div style="background-color: white; padding: 20px; border: 3px solid black; text-align: center; font-size: 20px; font-weight: bold;">Tiada jualan pada bulan ini!</div>';
    }

    $response['html'] = ob_get_clean();

    header('Content-Type: application/json');
    echo json_encode($response);

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Komputer Chipsway</title>
    <link rel="shortcut icon" href="adminImages/icon-9.png">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    <style>
        #monthpicker {
            padding: 8px;
            font-size: 14px;
            background-color: white;
            color: black;
            border: 3px solid black;
            border-radius: 5px;
        }.sales-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-x: auto;
        }.sales-table th, .sales-table td {
            border: 3px solid black;
            padding: 12px;
            text-align: center;
            font-size: 14px;
            color: black;
        }.sales-table th {
            background-color: white;
            font-weight: bold;
            color: black;
            font-size: 18px;
        }.sales-table tbody tr:hover {
            background-color: lightgrey;
        }
    </style>
</head>
<body style="background-color: white;">

<!-- START HEADING SECTION -->
<section>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <div>
            <a id="out" href="dashboard.php" style="padding: 10px; border: 3px solid black; background-color: white; font-size: 14px; color: black; cursor: pointer; border-radius: 5px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='white'"><i class="fa fa-arrow-left"></i></a>
        </div>
        <div style="flex-grow: 1; text-align: center;">
            <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase; color: black;">[ SENARAI JUALAN BULANAN ]</h1>
        </div>
        <button id="printDirectlyBtn" style="padding: 10px; border: 3px solid black; background-color: white; color: black; cursor: pointer; border-radius: 5px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='white'" onmouseout="this.style.backgroundColor='white'"><i class="fa fa-print"></i></button>
    </div>
</section>
<!-- END HEADING SECTION -->
<section class="show-sales" style="margin-top: -4rem; text-align: center;">
    <label for="monthpicker" style="display: block; margin-top: 10px; color: black; font-size: 18px; font-weight: bold;">Bulan Pilihan: </label>
    <input type="month" id="monthpicker" name="monthpicker" style="margin-top: 10px;" onchange="changeMonth()" value="<?= $selected_month ?>">
    <div id="show-sales-content"></div>
</section>

<script>
    function generatePDF() {
        console.log("Button clicked!");
        var selectedMonth = document.getElementById("monthpicker").value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById("show-sales-content").innerHTML = response.html;
                    if (response.pdfLink) {
                        var link = document.createElement('a');
                        link.href = response.pdfLink;
                        link.target = '_blank';
                        link.download = 'monthly_sales_report.pdf';
                        link.click();
                    }
                } else {
                    console.log("Error fetching data. Status: " + xhr.status);
                }
            }
        };
        xhr.open("GET", "monthly_sales.php?ajax=true&month=" + selectedMonth + "&output=pdf", true);
        xhr.send();
    }

    function changeMonth() {
        var selectedMonth = document.getElementById("monthpicker").value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById("show-sales-content").innerHTML = response.html;
                } else {
                    console.log("Error fetching data");
                }
            }
        };
        xhr.open("GET", "monthly_sales.php?ajax=true&month=" + selectedMonth, true);
        xhr.send();
    }

    document.getElementById("printDirectlyBtn").addEventListener("click", printDirectly);

    function printDirectly() {
        window.print();
    }

    changeMonth();
</script>

</body>
</html>
