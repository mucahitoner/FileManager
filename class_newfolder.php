<script type="text/javascript">
          var deger;
          var saniye=4;
          function saniyeBaslat()
          {

          document.getElementById('uyari').innerHTML="Aynı ada sahip klasör var! Yönlediriliyorsunuz...";
            saniye --;
            if(saniye >0){
              document.getElementById('saniye').innerHTML=saniye;
            }else{
              window.clearInterval(deger);
            }
          }
        var deger=window.setInterval('saniyeBaslat()',1000);
  </script>
  <style>
    .kapsam {
      border: 1px solid green;
      border-radius: 10px;
      background-color: green;
      width: 500px;
      margin: 0px auto;
      height:350px;
      color:white;
      position: absolute;
      left:50%;
      top:50%;
      margin-left: -250px;
      margin-top:-150px;
      text-align: center;
    }
    #saniye{
      font-size: 200px;
    }
    #uyari{
      font-size: 29px;
    }

  </style>
<?php
function duzenle($value)
{
  $turkce = ["Ç","Ğ","İ","Ü","Ö","Ş","ç","ğ","ı","ü","ö","ş"];
  $latin = ["C","G","I","U","O","S","c","g","i","u","o","s"];
  $value = str_replace($turkce, $latin, $value);
  $value = preg_replace("@[^A-Za-z0-9]@", " ", $value);
  $value = trim(preg_replace("@\s+@", " ", $value));
  $value = str_replace(" ", "_", $value);
  $value = mb_strtolower($value);
  return $value;
}
if ($_POST) {
  if (isset($_POST["newfolder"]) and $_POST["newfolder"]!="") {
     $link=$_POST["gt"].duzenle($_POST["newfolder"]);
    if (file_exists("upload/".$_POST["gt"].duzenle($_POST["newfolder"]))) {
      ?>
        <div class="kapsam">
          <div id="saniye"></div>
          <div id="uyari"></div>          
        </div>
        <?php
        die(header("refresh:5;url=index.php?file={$link}"));
    }
    else{
      try {
        mkdir("upload/".$_POST["gt"].duzenle($_POST["newfolder"]),0777);
        header("location:index.php?file={$link}");
      } catch (Exception $e) {
        echo "Warning!!! Oluşturma hatası.";  
      }
    }
  }
}
else{
  header("location:index.php");
}

?>

