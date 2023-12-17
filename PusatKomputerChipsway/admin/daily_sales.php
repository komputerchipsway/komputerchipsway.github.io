<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../components/connect.php';

$selected_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    $select_daily_sales = $conn->prepare("SELECT SUM(total_price) as total_daily_sales FROM sales WHERE date = :selected_date");
    $select_daily_sales->bindParam(':selected_date', $selected_date);
    $select_daily_sales->execute();
    $total_daily_sales = 0;

    if ($select_daily_sales->rowCount() > 0) {
        $fetch_daily_sales = $select_daily_sales->fetch(PDO::FETCH_ASSOC);
        $total_daily_sales = $fetch_daily_sales['total_daily_sales'];
    }

    $select_daily_sales_details = $conn->prepare("SELECT * FROM sales WHERE date = :selected_date");
    $select_daily_sales_details->bindParam(':selected_date', $selected_date);
    $select_daily_sales_details->execute();

    $daily_sales_data = $select_daily_sales_details->fetchAll(PDO::FETCH_ASSOC);

    $response = [
        'html' => '',
        'totalDailySales' => $total_daily_sales,
    ];

    ob_start();

    if (count($daily_sales_data) > 0) {
        ?>
        <br></br>
        <p><a style="font-size: 18px; color: black; font-weight: bold;">Jumlah Keseluruhan Tarikh ini: </a><br></br><span style="font-size: 18px; color: red; font-weight: bold;">[RM <?= $total_daily_sales ?>]</span></p>
        <table class="sales-table">
            <thead>
            <tr>
                <th>No.</th>
                <th>Nama produk</th>
                <th>Kuantiti</th>
                <th>Harga Jual</th>
                <th>Jumlah</th>
                <th>Tarikh</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $salesNumber = 1; // Initialize $salesNumber
            foreach ($daily_sales_data as $row):
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
        // No sales content with white background
        echo '<br></br><div style="background-color: white; padding: 20px; border: 3px solid black; text-align: center; font-size: 20px; font-weight: bold;">Tiada jualan pada tarikh ini!</div>';
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
        #datepicker {
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
            <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase; color: black;">[ SENARAI JUALAN HARIAN ]</h1>
        </div>
        <button id="printDirectlyBtn" style="padding: 10px; border: 3px solid black; background-color: white; color: black; cursor: pointer; border-radius: 5px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='white'" onmouseout="this.style.backgroundColor='white'"><i class="fa fa-print"></i></button>
    </div>
</section>
<!-- END HEADING SECTION -->
    <section class="show-sales" style="margin-top: -4rem; text-align: center;">
        <label for="datepicker" style="display: block; margin-top: 10px; color: black; font-size: 18px; font-weight: bold;">Tarikh Pilihan: </label>
        <input type="date" id="datepicker" name="datepicker" style="margin-top: 10px;" value="<?= $selected_date ?>" onchange="changeDate()">
        <div id="show-sales-content"></div>
    </section>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        function printSalesData() {
            console.log('Button clicked!'); // Add this line to check if the button is clicked
            var content = document.getElementById("show-sales-content").innerHTML;

            // Hide elements before printing
            hideElements(['menu-btn', 'user-btn', 'date-time-text']);

            var nw = window.open('', '_blank', 'width=900,height=600');
            nw.document.write('<html><head><title>Daily Sales Data</title></head><body>');
            nw.document.write('<h2>Daily Sales Data</h2>');
            nw.document.write(content);
            nw.document.write('</body></html>');
            nw.document.close();

            nw.onload = function () {
                nw.print();
                nw.onafterprint = function () {
                    nw.close();
                    // Show elements after printing
                    showElements(['menu-btn', 'user-btn', 'date-time-text']);
                };
            };
        }

        var showSalesContent = document.getElementById("show-sales-content");
        if (!showSalesContent) {
            console.error('Element with ID "show-sales-content" not found');
        }

        // Attach the new print functions to buttons
        document.getElementById("printDirectlyBtn").addEventListener("click", printDirectly);

        // Direct print function
        function printDirectly() {
            window.print(); // Try using window.print() directly
        }

        function openModal(message) {
            document.getElementById("messageModal").getElementsByClassName("modal-content")[0].innerHTML = message;
            document.getElementById("messageModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("messageModal").style.display = "none";
        }

        function openNoSalesModal() {
            var message = "No sales for the selected date";
            var modalContent = document.getElementById("messageModal").getElementsByClassName("modal-content")[0];
            modalContent.innerHTML = message;
            modalContent.style.backgroundColor = 'white'; // Set background color
            document.getElementById("messageModal").style.display = "block";
        }

        function loadSalesData(selectedDate) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        try {
                            var responseData = JSON.parse(xhr.responseText);

                            if (responseData.html.trim() === "no_sales") {
                                openNoSalesModal();
                                document.getElementById("show-sales-content").innerHTML = ''; // Clear the content
                            } else {
                                document.getElementById("show-sales-content").innerHTML = responseData.html;
                                closeModal();  // Close the modal if there are sales data
                            }
                        } catch (error) {
                            console.error("Error parsing JSON response:", error);
                            handleAjaxError();
                        }
                    } else {
                        handleAjaxError();
                    }
                }
            };

            xhr.open("GET", "daily_sales.php?ajax=true&date=" + selectedDate, true);
            xhr.send();
        }

        function changeDate() {
            var selectedDate = document.getElementById("datepicker").value;
            loadSalesData(selectedDate);
        }

        document.getElementById("datepicker").addEventListener("change", changeDate);

        var initialDate = document.getElementById("datepicker").value;
        loadSalesData(initialDate);

        // Function to hide multiple elements by their IDs
        function hideElements(ids) {
            ids.forEach(function (id) {
                var element = document.getElementById(id);
                if (element) {
                    element.style.display = 'none';
                }
            });
        }

        // Function to show multiple elements by their IDs
        function showElements(ids) {
            ids.forEach(function (id) {
                var element = document.getElementById(id);
                if (element) {
                    element.style.display = '';
                }
            });
        }

    });
</script>


</body>
</html>
