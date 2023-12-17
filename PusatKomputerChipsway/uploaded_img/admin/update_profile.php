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

   $update_profile_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
   $update_profile_name->execute([$name, $admin_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'Sila masukkan kata laluan yang lama!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'Kata laluan yang lama salah!';   
   }elseif($new_pass != $confirm_pass){
      $message[] = 'Pengesahan kata laluan salah!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$confirm_pass, $admin_id]);
         $message[] = 'Akaun admin ini telah berjaya dikemaskini!';
      }else{
         $message[] = 'Sila masukkan kata laluan yang baru!';
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

<!-- START ADMIN-UPDATE-FORM SECTION -->
   <section>
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
         <div>
            <a id="out" href="dashboard.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fa fa-arrow-left"></i></a>
         </div>
         <div style="flex-grow: 1; text-align: center;">
            <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ MENGEMASKINI AKAUN ADMIN ]</h1>
         </div>
         <a id="add" href="admin_accounts.php" style="padding: 10px; border: 3px solid darkblue; background-color: royalblue; font-size: 18px; color: black; font-weight:bold; cursor: pointer; border-radius: 3px; transition: background-color 0.3s; margin-left: auto;" onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='royalblue'"><i class="fas fa-eye"></i></a>
      </div>
   </section>

   <section class="form-container" style="margin-top: -12rem;">
      <form action="" method="post">
         <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 38rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h3 style="color: black;">KEMASKINI AKAUN</h3>
            <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
            <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required placeholder="Masukkan nama pengguna baru" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 360px; font-size: 16px;" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="old_pass" placeholder="Masukkan kata laluan lama" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 360px; font-size: 16px;" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="new_pass" placeholder="Masukkan kata laluan baru" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 360px; font-size: 16px;" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="confirm_pass" placeholder="Mengesahkan kata laluan" style="text-align: center; padding: 10px; margin: 5px; border: 1px solid black; border-radius: 5px; width: 360px; font-size: 16px;" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <div style="margin-top: 1.5rem;">
               <input type="submit" value="Kemaskini" class="btn" name="submit" style="display: inline-block; text-align: center; padding: 10px; margin: 5px; border: 3px solid black; border-radius: 5px; width: 200px; font-size: 20px; color: white; font-weight:bold;">
            </div>
         </div>
      </form>
   </section>
<!-- END ADMIN-UPDATE-FORM SECTION -->

</body>
</html>

