<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:admin_accounts.php');
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
         table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
         }th, td {
            border: 1px solid white;
            padding: 10px;
            text-align: center;
            color: white;
            font-size: 18px;
         }th {
            background-color: #333;
            color: white;
         }td img {
            max-width: 100px;
            max-height: 100px;
         }.button-container {
            display: flex;
            justify-content: center;
            align-items: center;
         }.option-btn, .delete-btn {
            margin: 2px;
            text-decoration: none;
            color: white;
            border: 1px solid white;
            border-radius: 5px;
            padding: 10px;
            transition: background-color 0.3s;
         }.delete-btn {
            background-color: #FF0000 !important; /* Specify the color and use !important */
         }.option-btn:hover {
            background-color: #555;
         }.delete-btn:hover {
            background-color: #555 !important;
         }.empty {
            text-align: center;
         }
   </style>
</head>
<body style="background-image: url('adminImages/home-bg.png'); background-size: cover;">

<?php include '../components/admin_header.php'; ?>

<!-- START ACCOUNT SECTION -->
   <section>
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
         <div>
            <a id="out" href="dashboard.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fa fa-arrow-left"></i></a>
         </div>
         <div style="flex-grow: 1; text-align: center;">
            <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ SENARAI AKAUN ADMIN ]</h1>
         </div>
         <a id="add" href="register_admin.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s; margin-left: auto;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fas fa-plus"></i></a>
      </div>
   </section>

   <section class="accounts" style="text-align: center; margin: auto; max-width: 50%; margin-top: -5rem;">
      <div class="table-container">
         <table>
            <thead>
               <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Tindakan</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $select_accounts = $conn->prepare("SELECT * FROM `admins`");
                  $select_accounts->execute();
                  if($select_accounts->rowCount() > 0){
                     $adminNumber = 1; // Initialize the admin number
                     while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){
               ?>
               <tr>
                  <td><?= $adminNumber++; ?></td>
                  <td><?= $fetch_accounts['name']; ?></td>
                  <td class="button-container">
                     <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('Delete this account?')" class="delete-btn">Padam</a>
                     <?php
                        if($fetch_accounts['id'] == $admin_id){
                           echo '<a href="update_profile.php" class="option-btn">Kemaskini</a>';
                        }
                     ?>
                  </td>
               </tr>
               <?php
                     }
                  }else{
                     echo '<tr><td colspan="4" class="empty">Tiada akaun admin yang tersedia!</td></tr>';
                  }
               ?>
            </tbody>
         </table>
      </div>
   </section>
<!-- END ACCOUNT SECTION -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    // Iterate through each row in the table
    $('table tbody tr').each(function() {
        // Find the maximum height among all cells in the current row
        var maxHeight = 0;
        $(this).find('td').each(function() {
            var cellHeight = $(this).outerHeight();
            if (cellHeight > maxHeight) {
                maxHeight = cellHeight;
            }
        });

        // Set the height of the button container to match the maximum height
        $(this).find('.button-container').css('height', maxHeight);
    });
});
</script>
   
</body>
</html>
