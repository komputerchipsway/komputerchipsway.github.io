<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $rating = $_POST['rating'];
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND rating = ? AND message = ?");
   $select_message->execute([$name, $email, $rating, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'Maklum balas anda telah dihantar!';
   } else {
      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, rating, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $rating, $msg]);

      $_SESSION['message_sent'] = true;
      $message[] = 'Maklum balas berjaya dihantar! Terima kasih untuk maklum balas tersebut!';
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
   <link rel="shortcut icon" href="images/icon-9.png">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
   <style>
   /* START STYLE FOR CONTACT */
      input[type="radio"] {
         width: 30px;
         height: 30px;
      }
      .box textarea {
         max-height: 1000px;
         overflow-y: auto;
      }
   /* END STYLE FOR CONTACT */
   </style>
</head>
<body style="background-image: url('images/home-bg.png'); background-size: cover;">
   
<?php include 'components/user_header.php'; ?>

<!-- START CONTACT SECTION -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ SILA BERIKAN PENILAIN KEPADA KAMI! ]</h1>
           </div>
       </div>
   </section>

   <section class="contact" style="margin-top: -3rem;">
      <form action="" method="post">
         <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 56rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h2>Nama:</h2>
            <input type="text" name="name" placeholder="Masukkan Nama Anda" style="text-align: center; padding: 10px; background-color: white; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;" required maxlength="1000" class="box" cols="1000" rows="1000">
            <br><br>
            <h2>Email:</h2>
            <input type="email" name="email" placeholder="Masukkan Email Anda" style="text-align: center; padding: 10px; background-color: white; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;" required maxlength="1000" class="box" cols="1000" rows="1000">
            <br><br>
            <div class="rating">
               <h2>Penilaian:</h2>
               <input type="radio" id="star5" name="rating" value="5" />
               <label for="star5"><span>5</span><i class="fas fa-star"></i></label>
               <input type="radio" id="star4" name="rating" value="4" />
               <label for="star4"><span>4</span><i class="fas fa-star"></i></label>
               <input type="radio" id="star3" name="rating" value="3" />
               <label for="star3"><span>3</span><i class="fas fa-star"></i></label>
               <input type="radio" id="star2" name="rating" value="2" />
               <label for="star2"><span>2</span><i class="fas fa-star"></i></label>
               <input type="radio" id="star1" name="rating" value="1" />
               <label for="star1"><span>1</span><i class="fas fa-star"></i></label>
            </div>
            <br><br>
            <h2>Maklum Balas:</h2>
            <textarea name="msg" class="box" placeholder="Berikan Maklum Balas" style="text-align: center; padding: 10px; background-color: white; margin: 5px; border: 1px solid black; border-radius: 5px; width: 400px; font-size: 16px;" cols="1000" rows="1000"></textarea>
            <div style="margin-top: 1.5rem;">
               <input type="submit" value="Serah" class="btn" name="send" style="display: inline-block; text-align: center; padding: 10px; margin: 5px; border: 3px solid black; border-radius: 5px; width: 200px; font-size: 20px; font-weight: bold;">
            </div>
         </div>
      </form>
   </section>
<!-- END CONTACT SECTION -->

<?php include 'components/footer.php'; ?>

<script>
// START JS FOR POPUP
   function showPopup(message) {
      document.getElementById('popupText').innerText = message;
      document.getElementById('popup').style.display = 'block';
   }

   function closePopup() {
      document.getElementById('popup').style.display = 'none';
   }

   <?php
      if (isset($_SESSION['message_sent'])) {
         echo "showPopup('Maklum Balas sudah dihantar!');";
         unset($_SESSION['message_sent']);
      }
   ?>
// END JS FOR POPUP
</script>

</body>
</html>
