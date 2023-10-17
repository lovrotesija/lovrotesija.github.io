<!DOCTYPE html>
<!-- comment -->

<html>
  <head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="onlineStore_CSS_.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dongle:wght@300&family=Roboto:wght@300&display=swap" >
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://kit.fontawesome.com/ab0283a189.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="javascript_OnlineStore.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
  </head>
  <body >
  <?php session_start();  include 'databaseConnection_PHP_.php'; $_SESSION['vratiNaPocetnu'] = "false";?>

  <?php 
if(isset($_POST['password']) && isset($_POST['kname']) && !isset($_POST['odjava'])){
  $kime=htmlspecialchars($_POST["kname"]);
  $zaporka=htmlspecialchars($_POST["password"]);
  $result = $con->query("SELECT * FROM korisnik");
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($row["korisnicko_ime"]==$kime && $row["password_korisnika"]==$zaporka){   
        $Ime=$row["ime_korisnika"];
        $_SESSION['imeKorisnika'] = $Ime;
        $_SESSION['korisnickoIme'] = $row["korisnicko_ime"];
        
        break;
      }
      
    }
    if($row["korisnicko_ime"]!=$kime || $row["password_korisnika"]!=$zaporka){
        echo "<script>alert('Ne postoji korisnički račun sa tim imenom i passwordom, ako nemate račun kreirajte novi');</script>";
        
      }
    
  }   
}

if(isset($_POST['odjava'])) {
  $_SESSION['imeKorisnika'] = null;
  $_POST['kname']=null;
  echo "<script >alert('odjava');";
  header('Location: http://localhost:84/online_store/pocetna_HTML_.php');
  
}

  
  if(isset($_SESSION['imeKorisnika'])){
    $kime=$_SESSION['korisnickoIme'];
    $trazi_sliku = $con->query('SELECT * FROM korisnik');
    while($row = $trazi_sliku->fetch_assoc()) {
       if($row["korisnicko_ime"]==$kime){
         $slika=$row['profilna_slika'];
         $_SESSION['korisnicka_slika']=$slika;
        }
     }

     if($slika==null){
       $_SESSION['korisnicka_slika']="standardneSlike/bpp2.png";
     }
    }
    

   
  ?>
  <script>
  function openSidebar() { 
  document.getElementById("sidebar").style.width='270px';
  document.getElementById("sidebar").style.padding='50px';
  document.getElementById("sidebar").style.opacity='100%';
  }
  function closeSidebar(){ 
  document.getElementById("sidebar").style.width='0px'; 
  document.getElementById("sidebar").style.padding='0px';
  document.getElementById("sidebar").style.opacity='0';
  }
  
  </script> 

  <!--<div id="loadingScreen"></div>-->

 
  
<div class="loader">

<div class="loader1"></div>
<div class="loader2"></div>
<div class="loader3"></div>
<div class="loader4"></div>

</div>






  <div class="navbar">
    <div class="navbar-border">
      <a href="http://localhost:84/online_store/pocetna_HTML_.php"><i class="fa fa-fw fa-home"></i>Home</a> 
      <a href="http://localhost:84/online_store/superSport.php"><i class="fa-solid fa-motorcycle"></i>Motocikli</a> 
      <a href="http://localhost:84/online_store/kosarica.php"><i class="fa-solid fa-basket-shopping"></i>Košarica</a>
      <a onclick="openSidebar()"><i class="fa-solid fa-bars"></i></a>
    </div>
  </div>

  <div id="sidebar" style="background-color:rgba(0, 0, 0, 0.9);">
    <a onclick="closeSidebar()"><i id="sidebar_text" class="fa-solid fa-x"></i></a>
    <br><br>
    <img id="sidebar_img" src="<?php if(isset($_SESSION['imeKorisnika'])){echo $_SESSION['korisnicka_slika'];} if(!isset($_SESSION['imeKorisnika'])){echo 'standardneSlike/bpp2.png';}?> ">
  
    <?php 
      if(isset($_SESSION['imeKorisnika'])){
        $ok=$_SESSION['korisnickoIme'];
        echo"<form name='logInForm'  method='post' autocomplete='off'>
            Korisničko ime: <input style='border: 2px white solid; border-radius: 7px;' type='text' name='#' maxlength='9' size='10' value='$ok' readonly><br>
            Password: <input style='border: 2px white solid; border-radius: 7px;' type='text' name='#' maxlength='9' size='10' value='****' readonly><br><br>
            </form>
   
            <br><br>
            <form method='post'>
            <input id='kreiraj_racun' type='submit' name='odjava' value='odjava'/>
            </form>";
       }

      if(!isset($_SESSION['imeKorisnika'])){
         echo"<form name='logInForm'  method='post'  id='form' autocomplete='off'>
            Korisničko ime: <input type='text' name='kname' maxlength='90' size='10'><br>
            Password: <input type='text' name='password' maxlength='9' size='10'><br><br>
            <input type='submit' value='Submit'/>
           </form>
   
           <br><br><br><br>
           <p style='font-size: 75%;'>Ako nemate korisnički račun kreirajte ga ovdje</p>
           <form action='http://localhost:84/online_store/createAccount_HTML(php)_.php'>
           <input id='kreiraj_racun' type='submit' value='kreiraj racun'/>
           </form>";
          
       }
?>
</div>

    <div id="slikaItekst1">
      <video autoplay muted loop poster style="width: 100%; min-height: 845px;" >
      <source src="slikeMotora/yamaha_mt10_2_.mp4" type="video/mp4">
      </video>
      <div class="tekstNaSlici1">The all new MT-10</div>
      <div class="drugitekstNaSlici1">This act was made by professionals in closed enviroment. Ride safe at all times.</div>
    </div>
<br>
    <div id="slikaItekst2">
      <img src="slikeMotora/yamaha_MT-10.jpg" style="width: 100%;">
      <div class="tekstNaSlici2">
      Konstruiran za stvaranje još boljeg osjećaja <br> okretnog momenta za najuzbudljivije iskustvo,<br>
      novi MT-10 najnapredniji je motocikl linije Hyper <br> Naked koji je Yamaha ikada proizvela. <br>
      Proizveden s pomoću najsuvremenije tehnologije <br> agregata i podvozja primijenjene na modelu R1, <br>
      najnoviji MT-10 daje više snage, okretnosti i osjećaja.
      </div>
    </div>
<br>
    <div id="slikaItekst3">
      <img src="slikeMotora/yamaha_MT-10_2.jpg" style="width: 100%;">
      <div class="tekstNaSlici3">
      <p>Specifikacije:</p>
      TFT mjerač od 4,2 " s odabirom Načina vožnje <br>
      Radijalni glavni cilindar marke Brembo <br>
      Tempomat <br>
      Agregat CP4 zapremnine 998 ccm koji udovoljava standardu EU5 <br>
      Najnoviji dizajn razvoja modela MT uključuje potpunu LED rasvjetu <br>
      Sustav gasa APSG s mogućnošću odabira načina rada PWR-a <br>
      Ispušni sustav od titana <br>
      Sustav brzog mijenjanja (Quick Shift System) u više i niže brzine <br>
      IMU sa 6 osi s potpunim kompletom pomoći za vozača <br>
      Guma Bridgestone S22 <br>
      Zračni ventili na kotačima postavljeni pod 90° <br>
      </div>
    </div>
<br>
  <p style=" position:absolute; left:18%; top:325%;font-size: 1.4vw;
  white-space: nowrap;">Broj mobitela: 097 761 3292 &emsp;&emsp;&emsp; E-mail: tesijalovro5@gmail.com &emsp;&emsp;&emsp; Adresa poslovnice: Horvaćanska 23</p>

    


 <script>//vraćanje na vrh stranice kako bi korisnik vidio loading screen
   setTimeout(function() {
   $(window).scrollTop(0,0);
   disableScroll();
   

   }, 100);

   setTimeout(function() {
   $(window).scrollTop(0,0);
   enableScroll();
   }, 4000);
 
  
      function disableScroll() {
       // Get the current page scroll position in the vertical direction
      scrollTop = window.pageYOffset || document.documentElement.scrollTop;     
      // Get the current page scroll position in the horizontal direction 
      scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

     // if any scroll is attempted,
     // set this to the previous value
       window.onscroll = function() {
       window.scrollTo(scrollLeft, scrollTop);
       };
     }
   
     function enableScroll() {
        window.onscroll = function() {};
      }

 </script>



<?php


if(isset($_POST['odjava'])) {
    $_SESSION['imeKorisnika'] = null;
    $_POST['kname']=null;
    echo "<script>alert('odjava');";
    header('Location: http://localhost:84/online_store/pocetna_HTML_.php');
    
 }

 if(isset($_POST['password']) && isset($_POST['kname']) && !isset($_POST['odjava'])){
    $kime=$_POST["kname"];
    $zaporka=$_POST["password"];
    $result = $con->query("SELECT * FROM korisnik");
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        if($row["korisnicko_ime"]==$kime && $row["password_korisnika"]==$zaporka){   
          $Ime=$row["ime_korisnika"];
          $_SESSION['imeKorisnika'] = $Ime;
          $_SESSION['korisnickoIme'] = $row["korisnicko_ime"];
          break;
        }/*
        if($row["korisnicko_ime"]!=$kime || $row["password_korisnika"]!=$zaporka){
           echo "<script>alert('Ne postoji korisnički račun sa tim imenom i passwordom, ako nemate račun kreirajte novi');</script>";
           break;
        }*/
      }
    
    }   
 }
  ?>

  </body>
</html>
