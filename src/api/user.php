<?php

session_start();


//check if user is logged in
if(!isset($_SESSION["id"])) {
    $userLoggedIn = false;
    header('location:../../index.php');
    exit();
}

//login flag
$userLoggedIn = true;

//get the username from session
$userName = $_SESSION['userName'];

?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" type="image/png" href="/icon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin="" />
    <script src="https://kit.fontawesome.com/cf32b5773d.js" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
      integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
      crossorigin=""></script>
    <link rel="stylesheet" href="../../dist/output.css" />
    <script defer type="module" src="../js/app.js"></script>
    <script defer type="module" src="../js/ui.js"></script>
    <title>Pintzy - Pin aware your people.</title>
  </head>

  <body class="flex relative">
    <!-- sidebar -->
    <!-- w-14 -->
    <aside
      class="absolute sidebar transition-all  backdrop-blur-sm border-2 border-zinc-400 bg-zinc-600/80  duration-500 z-30 tablet:w-80   ">
      <!-- opacity-0  -->
      <div class="sidebar-content-wrapper transition-all duration-[400ms] h-screen  ">

        <!-- nav -->
        <nav class="border-b border-zinc-400 py-4 px-4 drop-shadow-sm bg-zinc-400/60">
          <ul class="flex justify-around">
            <li
              class=" border-r border-r-1 border-r-gray-300 w-4/5 text-center text-zinc-100 opacity-40 text-base hover:font-semibold hover:opacity-100 ">
              <a href="../html/pins.html">Pins</a>
            </li>
            <li class="font-semibold w-4/5 text-center nav-active text-base">
              Profile
            </li>
          </ul>
        </nav>

        <!-- user info -->
        <div class="signed-user-profile_container flex w-full my-4 py-4 px-5 items-center justify-between">
          <!-- placeholder -->
          <div
            class="user-profile_header-user-image border border-slate-300 w-16 h-16 rounded-full p-2 bg-white flex justify-center items-center">
            <img src="../assets/user-icon-large.svg" alt="user profile" />
          </div>
          <span class="user-profile-header_user-name ml-2 inline-block font-semibold text-zinc-100 text-2xl">
            <?php
            echo $userLoggedIn? $userName: 'Someting_wong';
?>
          </span>

          <div
            class="user-profile-user__pin-count border border-slate-300 bg-zinc-300 rounded-sm px-1 py-1 text-center">
            <span class="user-profile-user__pin-count_number font-semibold tablet:text-sm max-w-[2rem]">
              
            </span>
              <i class="fa-solid fa-location-dot text-slate-500"></i>
          </div>
        </div>

        <!-- pins -->
        <ul class="user-pin-container pin-container px-4 py-2 mt-6 flex justify-center items-center flex-col">
          <!-- placeholder -->
        </ul>


      </div>
      <!-- actions -->
      <div class="user-profile-footer   w-full flex justify-between absolute bottom-16 left-0 px-4 ">
        <form action="./inc/logout.inc.php" method="post">

          <button class="btn-user-input  w-60 h-10 rounded-full font-semibold text-m  border-4 " type="submit"
            name="user-logout">
            Logout
          </button>
        </form>

        <i
          class="btn-sidebar fa-flip-horizontal fa-solid fa-chevron-left btn-sidebar  rounded-sm  ring-4 ring-zinc-400 text-zinc-400 p-3   hover:ring-zinc-200 hover:text-zinc-100 cursor-pointer transition-transform"></i>
      </div>
    </aside>
    <section class="map-content w-full">
      <!-- main content -->

      <div class="ml-4 bg-slate-500">
        <span
          class="font-semibold desktop:ml-6 fixed top-2 right-4 z-20 bg-zinc-400/30 backdrop-blur-sm p-3 rounded-sm">Pintzy</span>
      </div>

      <!-- pop up for input-->
      <section
        class="hidden user-input-bg flex flex-col justify-center left-0 items-center h-screen bg-gradient-to-r from-zinc-700/50 to-zinc-800/60 absolute w-full z-30"
        aria-modal="true">
        <span class="btn-close__user-input absolute bottom-16 tablet-md:top-6 tablet-md:right-8 cursor-pointer"
          aria-label="Close">
          <i
            class="fa-sharp fa-regular fa-circle-xmark fa-2xl text-slate-100 laptop:text-zinc-400 hover:text-zinc-300"></i>
        </span>

        <form action="#"
          class="user-input-form p-4 rounded-sm pb-8 relative border border-gray-300 bg-zinc-300 w-4/5 mt-4 flex justify-center flex-col items-center android-md/2:w-80 tablet-md:w-[26rem] tablet-md:rounded tablet-md:px-6 laptop:h-96"
          id="form-user-input">
          <div class="flex flex-col my-4 w-full">
            <label class="text-gray-600 text-xs mb-1">Pin type</label>
            <select name="eventType" id="eventType" class="p-1 cursor-pointer border border-zinc-300">
              <option value="none">---</option>
              <option value="emergency">Emergency 🚨</option>
              <option value="alert">Alert &#9888;</option>
              <option value="event">Event &#9733;</option>
              <option value="review">Review 🤔</option>
              <option value="touristAttraction">Tourist Attraction 🌐</option>
              <option value="reacreational">Recreational 😎</option>
            </select>
          </div>
          <div class="flex flex-col w-full">
            <label class="text-gray-600 text-xs mb-1">Message</label>

            <textarea class="rounded-sm border border-zinc-300 p-2 resize-none" name="message" id="message" cols="30"
              rows="4"></textarea>
          </div>
          <button
            class="btn-user-input w-full mt-10 mb-3 h-10 rounded font-semibold text-m text-gray-700 android-md/2:w-52 android-md:rounded-2xl android-md:bg-transparent border-4 border-green-500 android-md:border-4 laptop:hover:bg-green-500 laptop:hover:text-zinc-100 transition-colors active:text-zinc-100 disabled:border-zinc-400 disabled:text-zinc-400 disabled:hover:bg-transparent disabled:hover:text-zinc-400"
            type="submit" name="user-submit" disabled>
            Pin
          </button>
        </form>
        ;
      </section>
      <!-- map -->
      <div id="map" class="h-screen z-10"></div>
    </section>
  </body>

</html>
