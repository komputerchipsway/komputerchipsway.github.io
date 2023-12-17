<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'Anda telah masukkan nama pengguna ATAU kata laluan yang salah!';
   }

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
</head>
<body style="background-image: url('adminImages/home-bg.png'); background-size: cover;">

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<!-- START ADMIN-LOGIN-FORM SECTION -->
   <section>
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
         <div style="flex-grow: 1; text-align: center;">
            <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ UNTUK ADMIN SAHAJA! ]</h1>
         </div>
      </div>
   </section>

   <section class="form-container" style="margin-top: -16rem;">
      <form action="" method="post">
         <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 27rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h3 style="color: black;">LOG MASUK</h3>
            <input type="text" name="name" required placeholder="Masukkan nama pengguna" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="Masukkan kata laluan" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <div style="display: flex; justify-content: center; margin-top: 1.5rem;"> 
               <a href="../home.php" class="btn" style="text-align: center; padding: 10px; margin: 5px; border: 3px solid black; border-radius: 5px; width: 200px; font-size: 20px;">Pergi Ke Website</a>
               <input type="submit" value="Serah" class="btn" name="submit" style="text-align: center; padding: 10px; margin: 5px; border: 3px solid black; border-radius: 5px; width: 200px; font-size: 20px;">
            </div>
         </div> 
      </form>
   </section>
<!-- END ADMIN-LOGIN-FORM SECTION -->

</body>
</html>