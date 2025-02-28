<?php

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "ows";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

$Search = $_POST["Select"];




?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   <!-- Google Font -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dongle:wght@700&family=Nunito:wght@700&family=PT+Serif&family=Playfair+Display&family=Poltawski+Nowy:wght@600&family=Poppins:wght@400;500;600&display=swap">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style2.css">
   <link rel="stylesheet" href="css/style3.css">
   <link rel="stylesheet" href="css/style4.css">

</head>

<body>

   <!-- header section starts -->

   <header class="header">

      <a href="#" class="logo"> <i class="fas fa-user"></i> OWS </a>

      <nav class="navbar">
         <a href="#home">Home</a>
         <a href="#Workers">Workers</a>
         <a href="U_about.html">About Us</a>
         <a href="#feedback">Feedback</a>

      </nav>
      <!-- <button class="btn">Login</button>  -->


   </header>
   <!-- header section ends -->

   <!-- home section starts -->
   <section class="home" id="home">
      <a href="U_homefirst.php" class="back"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i> Back</a>
      <h1 class="heading"><span id="W_name"><?php echo " $Search "; ?></span></h1>
      <a href="Demo.php" class="back"><i class="fa-solid fa-user" style="color: #ffffff;"></i> Add Card</a>
   </section>
   <!-- home section ends -->






   <section class="card">

      <?php


      $sql = "SELECT * FROM worker WHERE worker = '$Search';";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
      ?>
            <div class="profile-card">
               <div class="profile-image">
                  <img src="uploads/user.png" alt='Profile Photo' width='150' height='150'>
               </div>

               <h2 class="profile-name"><?php echo $row["name"] ?></h2>

               <div class="profile-info">
                  <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                     <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                  </svg>
                  <span class="detail"><?php echo $row["p_no"] ?></span>
               </div>

               <div class="profile-info">
                  <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                     <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                     <circle cx="12" cy="10" r="3" />
                  </svg>
                  <span class="detail"><?php echo $row["state"] ?> , <?php echo $row["city"] ?></span>
               </div>

               <div class="profile-info">
                  <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                     <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                     <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                  </svg>
                  <span class="detail"><?php echo $row["experience"] ?> experience</span>
               </div>


               <button class="contact-button">Contact Me</button>
            </div>
      <?php
         }
      } else {
         echo "0 results";
      }


      $conn->close();
      ?>
   </section>






</body>

</html>