<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : '';

if(!isset($admin_id) && basename($_SERVER['PHP_SELF']) !== 'admin_login.php'){
   header('location:admin_login.php');
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
   <link rel="shortcut icon" href="images/icon-9.png">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>   
   <style>
   /* START STYLE FOR ABOUT-PIC */
      .about-pic .slide{
         padding:2rem;
         text-align: center;
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
         border:var(--border);
         margin-bottom: 5rem;
         user-select: none;
      }.about-pic .slide img{
         height: 20rem;
         width: 30rem;
         margin-bottom: .5rem;
      }.about-pic {
         margin-bottom: 0;
      }
   /* END STYLE FOR ABOUT-PIC */

   /* START STYLE FOR ABOUT-ANSQUES */
      .about-ansques .slide{
         padding:2rem;
         text-align: center;
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
         border:var(--border);
         margin-bottom: 5rem;
         user-select: none;
      }.about-ansques .slide h3, a{
         font-size: 2rem;
         color:var(--black);
      }.about-ansques-slider-controls {
         text-align: center;
         margin-top: 20px;
      }.prev-button, .next-button {
         background-color: royalblue; 
         color: #fff;
         border: 2px solid darkblue;
         border-radius: 8px;
         padding: 12px;
         font-size: 1.2rem;
         cursor: pointer;
         transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
      }.prev-button:hover, .next-button:hover {
         background-color: lightblue;
         color: black;
      }
   /* END STYLE FOR ABOUT-ANSQUES */

   /* START STYLE FOR ABOUT-RATE */
      .about-rate .slide{
         position: relative;
         padding:2rem;
         border-radius: .5rem;
         border:var(--border);
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         margin-bottom: 5rem;
         overflow: hidden;
         user-select: none;
         height: 420px; 
         overflow-y: auto;
      }.about-rate .fa-star {
         color: yellow;
      }.center-container {
         text-align: center;
      }.form-label-container {
         display: flex;
         flex-direction: column;
         align-items: center;
         text-align: center;
      }.form-label {
         font-size: 1.8rem;
         font-weight: bold;
         color: #663399; 
         margin-top: 4px;
      }.form-value {
         font-size: 1.8rem;
         font-weight: normal;
         color: #2E8B57; 
         margin-bottom: 5px; 
         height: auto; 
         overflow: visible; /
         display: -webkit-box;
         -webkit-line-clamp: initial; 
         -webkit-box-orient: vertical;
         cursor: pointer; 
      }.form-value.expandable {
         overflow: hidden;
         display: -webkit-box;
         -webkit-line-clamp: 1; 
         -webkit-box-orient: vertical;
         cursor: pointer;
      }.form-value.expanded {
         -webkit-line-clamp: initial;
      }.about-rate-slide {
         position: relative;
         overflow: hidden;
         border-radius: 15px; 
         box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
         transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
      }.about-rate-name-container, .about-rate-rate-container, .about-rate-feedback-container {
         position: absolute;
         bottom: 0;
         left: 0;
         right: 0;
         background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
         padding: 20px;
         color: #fff; 
         text-align: center;
      }duct-value {
         font-size: 18px;
         margin-bottom: 15px;
         color: #4B0082; 
      }
   /* END STYLE FOR ABOUT-RATE */
   </style>
</head>
<body style="background-image: url('images/home-bg.png'); background-size: cover;">
   
<?php include 'components/user_header.php'; ?>

<!-- START ABOUT-DESCRIPTION SECTION  -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ PENERANGAN PERNIAGAAN ]</h1>
           </div>
       </div>
   </section>

   <section class="about-description" style="margin-top: -3rem; margin-bottom: 4rem;">
      <div class="row justify-content-center">
         <div class="col-lg-7 text-center">
            <div style="border: 15px double coral; padding: 15px; text-align: center;">
               <p class="mb-4" style="color: white; font-family:sans-serif; font-size: 30px;">Pusat Komputer Chipsway bukan sahaja beroperasi dalam sektor komputer tetapi juga menyediakan perkakas elektrik seperti televisyen, kipas dan sebagainya. Juga menyediakan khidmat membaiki komputer yang rosak atau semacam dengannya. Laman web ini dicipta untuk memudahkan pelanggan mendapatkan maklumat tentang barangan terlebih dahulu dan mereka juga boleh memberi maklum balas terhadap Pusat Komputer Chipsway. </p>
            </div>
               <p><a href="" class=""></a><a href="#" class=""></a></p>
         </div>
      </div>
   </section>
<!-- END ABOUT-DESCRIPTION SECTION  -->

<!-- START ABOUT-PIC SECTION  -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ GAMBAR PERNIAGAAN ]</h1>
           </div>
       </div>
   </section>

   <section class="about-pic" style="margin-top: -3rem;">  
      <div class="swiper about-pic-slider">
         <div class="swiper-wrapper">
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 24rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/ks1.png" alt="">
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 24rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/ks2.png" alt="">
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 24rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/ks3.png" alt="">
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 24rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/ks4.png" alt="">
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 24rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/ks5.png" alt="">
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 24rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <img src="images/ks6.png" alt="">
               </div>
            </div>
         </div>
      </div>
   </section>
<!-- END ABOUT-PIC SECTION  -->

<!-- START ABOUT-ANSQUES SECTION  -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ SOAL JAWAB ]</h1>
           </div>
       </div>
   </section>

   <section class="about-ansques" style="margin-top: -3rem; margin-bottom: 4rem;">
      <div class="swiper about-ansques-slider">
         <div class="swiper-wrapper">
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 28rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <h3>S1: Bilakah hari Pusat Komputer Chipsway beroperasi?</h3>
                  <a>J: Beroperasi pada hari Isnin–Sabtu dan Tutup pada hari Ahad.</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 28rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <h3>S2: Bilakah waktu Pusat Komputer Chipsway beroperasi?</h3>
                  <a>J: Beroperasi pada jam 9:30 PG–7:00 PTG.</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 28rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <h3>S3: Apakah yang perniagaan Pusat Komputer Chipsway lakukan?</h3>
                  <a>J: Menjual perkakas elektrik dan barangan komputer.</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 28rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <h3>S4: Apakah perkhidmatan lain yang dilakukan Pusat Komputer Chipsway?</h3>
                  <a>J: Perkhidmatan membaiki komputer rosak atau semacam dengannya.</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 28rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <h3>S5: Bagaimanakah cara kami mendapatkan maklumat berkaitan barangan yang dijual dan perkhidmatan yang disediakan?</h3>
                  <a>J: Dengan cara datang ke kedai kami ataupun menguhubungi kami.</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; height: 28rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <h3>S6: Apakah fungsi laman web ini?</h3>
                  <a>J: Untuk memudahkan pelanggan mengetahui produk apa yang dijual dan memudahkan pelanggan untuk memberi maklum balas terhadap perniagaan kami di ruang yang telah disediakan.</a>
               </div>
            </div>
         </div>
      </div>
      <div class="about-ansques-slider-controls" style="display: flex; justify-content: center; align-items: center;">
         <button class="prev-button" onclick="prevAnsquesSlide()"><i class="fas fa-arrow-left"></i></button>
         <button class="next-button" onclick="nextAnsquesSlide()"><i class="fas fa-arrow-right"></i></button>
      </div>
   </section>
<!-- END ABOUT-ANSQUES SECTION  -->

<!-- START ABOUT-RATE SECTION  -->
   <section>
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
           <div style="flex-grow: 1; text-align: center;">
               <h1 class="heading" style="font-size: 4rem; color: grey; margin: 0; text-transform: uppercase;">[ PENILAIN PELANGGAN ]</h1>
           </div>
       </div>
   </section>

   <section class="about-rate" style="margin-top: -3rem;">
      <div class="swiper about-rate-slider">
         <div class="swiper-wrapper">
            <?php
               $select_messages = $conn->prepare("SELECT * FROM `messages`");
               $select_messages->execute();
               if($select_messages->rowCount() > 0){
                  while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
            ?>
               <form action="" method="post" class="swiper-slide slide about-rate-slide">
                  <div class="flex" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px; background-color: wheat; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                     <div class="name">
                        <div class="form-label-container" style="margin-bottom: 20px;">
                           <span class="form-label" style="font-size: 28px; color: #333; font-weight: bold;">Nama Pelanggan: </span>
                           <span class="form-value expandable" style="font-size: 24px; color: #555;"><?= $fetch_message['name']; ?></span>
                        </div>
                     </div>
                     <div class="rate">
                        <div class="form-label-container" style="margin-bottom: 20px;">
                           <span class="form-label" style="font-size: 28px; color: #333; font-weight: bold;">Penilaian yang Diberikan: </span>
                           <span class="form-value expandable" style="font-size: 24px; color: #555;"><?= $fetch_message['rating']; ?><i class="fas fa-star"></i>/5<i class="fas fa-star"></i></span>
                        </div>
                     </div>
                     <div class="feedback">
                        <div class="form-label-container" style="margin-bottom: 20px;">
                           <span class="form-label" style="font-size: 28px; color: #333; font-weight: bold;">Maklum Balas: </span>
                           <span class="form-value expandable" style="font-size: 24px; color: #555;"><?= $fetch_message['message']; ?></span>
                        </div>
                     </div>
                  </div>
               </form>
            <?php
                  }
               } else {
                  echo '<p class="empty">you have no messages</p>';
               }
            ?>
         </div>
      </div>
   </section>
<!-- END ABOUT-RATE SECTION  -->

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
// START JS FOR ABOUT-BACKGROUND
   var backgroundSlider = new Swiper(".about-background-slider", {
      loop: true,
      autoplay: {
         delay: 3000,
      },
   });
// END JS FOR ABOUT-BACKGROUND

// START JS FOR ABOUT-PIC
   document.addEventListener('DOMContentLoaded', function () {
      var swiper = new Swiper(".about-pic-slider", {
         loop: true,
         spaceBetween: 20,
         autoplay: {
            delay: 2000,
            disableOnInteraction: false,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            768: {
               slidesPerView: 2,
            },
            991: {
               slidesPerView: 3,
            },
         },
      });
   });
// END JS FOR ABOUT-PIC

// START JS FOR ABOUT-ANSQUES
   var ansquesSlider = new Swiper('.about-ansques-slider', {
      loop: true,
      spaceBetween: 20,
      navigation: {
         nextEl: '.next-button',
         prevEl: '.prev-button',
      },
      breakpoints: {
         550: {
           slidesPerView: 2,
         },
         768: {
           slidesPerView: 2,
         },
         1024: {
           slidesPerView: 3,
         },
      },
   });

   function nextAnsquesSlide() {
      ansquesSlider.slideNext();
   }

   function prevAnsquesSlide() {
      ansquesSlider.slidePrev();
   }
// END JS FOR ABOUT-ANSQUES
   
// START JS FOR ABOUT-RATE
   document.addEventListener('DOMContentLoaded', function () {
      var swiper = new Swiper(".about-rate-slider", {
         loop: true,
         spaceBetween: 20,
         autoplay: {
            delay: 4000, 
            disableOnInteraction: false,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            768: {
               slidesPerView: 2,
            },
            991: {
               slidesPerView: 3,
            },
         },
      });

      var rateBoxes = document.querySelectorAll('.swiper-slide.about-rate-slide');
      var maxHeight = 0;
      rateBoxes.forEach(function(box) {
         maxHeight = Math.max(maxHeight, box.offsetHeight);
      });

      rateBoxes.forEach(function(box) {
         box.style.height = maxHeight + 'px';
         box.style.overflowY = 'auto';
      });

      const formValues = document.querySelectorAll('.form-value');
      formValues.forEach(formValue => {
          formValue.addEventListener('click', function() {
              formValue.classList.toggle('expanded');
          });
      });

      const expandableElements = document.querySelectorAll('.expandable');
      expandableElements.forEach(element => {
         element.addEventListener('click', function() {
            element.classList.toggle('expanded');
         });
      });

      rateBoxes.forEach(function(box) {
         box.addEventListener('click', function() {
            var formValues = box.querySelectorAll('.form-value');
            formValues.forEach(function(formValue) {
               formValue.classList.toggle('expanded');
            });
         });
      });

   });
// END JS FOR ABOUT-RATE
</script>

</body>
</html>