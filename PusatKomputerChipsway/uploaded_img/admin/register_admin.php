<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
   $select_admin->execute([$name]);

   if($select_admin->rowCount() > 0){
      $message[] = 'Nama pengguna sudah wujud!';
   }else{
      if($pass != $cpass){
         $message[] = 'Pengesahan kata laluan salah!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admins`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $message[] = 'Admin baru telah berjaya mendaftar!';
      }
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

<?php include '../components/admin_header.php'; ?>

<!-- START ADMIN-REGISTER-FORM SECTION -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div>
               <a id="out" href="dashboard.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fa fa-arrow-left"></i></a>
           </div>
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ MENDAFTAR AKAUN ADMIN ]</h1>
           </div>
           <a id="add" href="admin_accounts.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s; margin-left: auto;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fas fa-eye"></i></a>
       </div>
   </section>

   <section class="form-container" style="margin-top: -13rem;">
      <form action="" method="post">
         <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 33rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h3 style="color: black;">DAFTAR AKAUN</h3>
            <input type="text" name="name" required placeholder="Masukkan nama pengguna (max20)" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="Masukkan kata laluan (max10)" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;" maxlength="10"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="cpass" required placeholder="Mengesahkan kata laluan" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <div style="margin-top: 1.5rem;">
               <input type="submit" value="Daftar" class="btn" name="submit" style="display: inline-block; text-align: center; padding: 10px; margin: 5px; border: 3px solid black; border-radius: 5px; width: 200px; font-size: 20px; font-weight: bold;">
            </div>
         </div>
      </form>
   </section>
<!-- END ADMIN-REGISTER-FORM SECTION -->
   
</body>
</html>