<?php
include("baglantii.php");

$username_err=$parola_err="";

if(isset($_POST["giris"]))
{

//kullanıcı adı doğrulama
if(empty($_POST["kullaniciadi"]))
{
$username_err="kullanıcı adı boş geçilemez.";
}
   else{
        $username=$_POST["kullaniciadi"];
    }



  //parola doğrulama
if(empty($_POST["parola"]))
{
    $parola_err="şifre boş olamaz";
}
else{
    $parola=$_POST["parola"];
}
    
   
if(isset($username) &&  isset($parola))
{
   
   
$secim = "SELECT * FROM kullaniciilar WHERE kullanici_adi='$username'";
$calistir = mysqli_query($baglantii, $secim);
$kayitsayisi=mysqli_num_rows($calistir);
if($kayitsayisi>0)
{
$ilgilikayit = mysqli_fetch_assoc($calistir);
$hashlisifre=$ilgilikayit["parola"];

if(password_verify($parola, $hashlisifre))
{
  session_start();
  $_SESSION["kullanici_adi"]=$ilgilikayit["kullanici_adi"];
  $_SESSION["email"]=$ilgilikayit["email"];
  header("location:profilee.php");
}

}
else{
  echo '<div class="alert alert-danger" role="alert">
 kullanıcı ad yanlış!
</div>';
}

 mysqli_close($baglantii);

  }
}
?>

<!doctype html>
<html lang="en" >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">

    <title>üye giriş işlemi</title>
  </head>
  <body>
    <div class="container p-5">
<div class="card p-5">
<form action="loginn.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">kullanıcı adı</label>
    <input type="text" class="form-control 
    
    <?php
    if(!empty($username_err))
    {
    echo "is-invalid";
}
    ?>
    
    
    " id="exampleInputEmail1" name="kullaniciadi">
    <div class="invalid-feedback">
      <?php
      echo $username_err;
      ?>
    </div>
  </div>


  

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">şifre</label>
    <input type="password" class="form-control 
   <?php
    if(!empty($parola_err)) 
   {
    echo "is-invalid";
}
    ?> 
    
    " id="exampleInputPassword1" name="parola">
    <div class="invalid-feedback">
     <?php
     echo $parola_err;
     ?> 
    </div> 

</div>


 


  
  <button type="submit" class="btn btn-primary" name="giris">giriş</button>
  
</form>
</div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    -->
  </body>
</html>