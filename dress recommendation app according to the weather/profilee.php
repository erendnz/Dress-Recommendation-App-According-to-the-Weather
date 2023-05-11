<?php
session_start();
if(isset($_SESSION["kullanici_adi"]))
{
    
    header("location:what2wear/wardrobe.html");
  
}
else{
    echo "bu sayfayı görüntüleme yetkiniz yok";
 
}
?>

