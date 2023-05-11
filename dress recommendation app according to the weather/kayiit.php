<?php
include("baglantii.php");

$username_err=$email_err=$parola_err=$parolatkr_err="";

if(isset($_POST["kaydet"]))
{

//kullanıcı adı doğrulama
if(empty($_POST["kullaniciadi"]))
{
$username_err="kullanıcı adı boş geçilemez.";
}
else if(strlen($_POST["kullaniciadi"])<6)
{
    $username_err="kullanıcı adı en az 6 karakter olmalıdır!";
}

else if (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["kullaniciadi"]))
 
{
    $username_err="kullanıcı adı büyük küçük harf ve rakamlardan oluşmalıdır!";
    }
    else{
        $username=$_POST["kullaniciadi"];
    }

//email doğrulama
if(empty($_POST["email"]))
{
    $email_err="email boş geçilemez!";
}
else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $email_err = "geçerli email giriniz! ";
  }
  else{
    $email=$_POST["email"];
  }

  //parola doğrulama
if(empty($_POST["parola"]))
{
    $parola_err="şifre boş olamaz";
}
else{
    $parola=password_hash($_POST["parola"],PASSWORD_DEFAULT);
}
 
//parolatekrar doğrulama
if(empty($_POST["parolatkr"]))
{
    $parolatkr_err="şifre tekrarı boş olamaz!";
}
else if($_POST["parola"]!=$_POST["parolatkr"])
{
    $parolatkr_err="şifreler uyuşmuyor!";
}
else{
    $parolatkr=$_POST["parolatkr"];
}



    
    
    $cinsiyet=$_POST["cinsiyeet"]; 

  
if(isset($username)&& isset($email)&& isset($parola))
{
   
   
    $ekle="INSERT INTO kullaniciilar (kullanici_adi, email, parola, cinsiyet) VALUES('$username','$email','$parola', '$cinsiyet')";

  $calistirekle =mysqli_query($baglantii, $ekle);

if($calistirekle){

    echo '<div class="alert alert-success" role="alert">
     kayıt başarılı
    </div>';
}

    else{ 
    echo '<div class="alert alert-danger" role="alert">
  bir yanlışlık var!
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

    <title>üye kayıt işlemi</title>
  </head>
  <body>
    <div class="container p-5">
<div class="card p-5">
<form action="kayiit.php" method="POST">
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
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="text" class="form-control 
    <?php
   if(!empty($email_err)) 
   {
    echo "is-invalid";
}
    ?>
    
    " id="exampleInputEmail1" name="email">
    <div class="invalid-feedback">
    <?php
    
    echo $email_err;
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

    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">şifre</label>
    <input type="password" class="form-control 
    
    <?php
    if(!empty($parolatkr_err)) 
   {
    echo "is-invalid";
}
    ?> 
    " id="exampleInputPassword1" name="parolatkr">
    <div class="invalid-feedback">
      <?php
      echo $parolatkr_err;
      ?>
    </div> 

</div>

  <div class="mb-3">
  <input type="radio" id="woman" name="cinsiyeet" value="k">
  <label for="woman">kadın</label>
  <input type="radio" id="man" name="cinsiyeet" value="e">
  <label for="man">erkek</label><br>
</div>

 


  
  <button type="submit" class="btn btn-primary" name="kaydet">kaydet</button>
  <a href="http://localhost/uyelik2/loginn.php" <button type="submit" class="btn btn-primary" name="kaydet">girişe git</button></a>
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