<script type="text/javascript">
          var deger;
          var saniye=4;
          function saniyeBaslat()
          {

          document.getElementById('uyari').innerHTML="Hatalı Giriş! Yönlendiriliyorsunuz";
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
      height:300px;
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

  if ($_GET) {
    if (isset($_GET["view"])) {
      $view=$_GET["view"];
      if (!is_file($view)) {
        ?>
        <div class="kapsam">
          <div id="saniye"></div>
          <div id="uyari"></div>          
        </div>
        <?php
        die(header("refresh:5;url=index.php"));
      }
      else{        
        $deneme=explode(".", $view);
      }
    }
    else
    {
      ?>
        <div class="kapsam">
          <div id="saniye"></div>
          <div id="uyari"></div>          
        </div>
        <?php
      die(header("refresh:3;url=index.php"));
    }
  }
  else{
    ?>
        <div class="kapsam">
          <div id="saniye"></div>
          <div id="uyari"></div>          
        </div>
        <?php
    die(header("refresh:3;url=index.php"));
  }
  ?>
  <?php 

  $baslik=explode("/", $view);
  $dosyaadi=end($baslik);
  //echo $dosyaadi."<br>";

  $dizinyolu=rtrim($view,$dosyaadi);
  //echo $dizinyolu."<br>";

  function duzenle($value)
  {
    $turkce=["Ç","Ğ","İ","Ü","Ö","Ş","ç","ğ","ı","ü","ö","ş"];
    $latin=["C","G","I","U","O","S","c","g","i","u","o","s"];
    $value = str_replace($turkce, $latin, $value);
    $value = preg_replace("@[^A-Za-z0-9.]@", " ", $value);
    $value = trim(preg_replace("@\s+@", " ", $value));
    $value = str_replace(" ", "_", $value);
    return $value;
  }
  ?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
  <?php
  $description="description,filemanager,view";
  $keywords="keywords,filemanager,view";
  $ikon="filemanager.ico";
  $image_uzantilari = ["gif","jpeg","jpg","png","svg","ico","icon","webp"];
  $dosya_uzantilari = ["html","css","js","php","txt"];
  $view_link = ["html","php"];
  $alt="FileManager";
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="vie" content="">
  <title>FileManager - View</title>
  <meta name="description" content="<?php echo $description; ?>"/>
  <meta name="keywords" content="<?php echo $keywords; ?>"/>

  <link rel="icon" href="css/<?php echo $ikon; ?>">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="fontawesome-free-5.0.7/web-fonts-with-css/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/prettify.css">
  
</head>
<body>
  <form action="" method="post">

  <!-- Başlık başlangıç -->
  <div class="container-fluid p-1 bg-dark text-white">
    <div class="container text-center">

      <div class="row">
        <div class="col-md-12">
          <h1>
            <?php
            $explode=explode("/", $view);
            $a="";
            foreach ($explode as $key => $value) {
              if ($key!=0 and $key!=count($explode)-1) {
                $a=$a.$value."/";
              }
            }
            ?>
          <a href="<?php echo "index.php?file=".rtrim($a,"/"); ?>" class="btn btn-primary">
            <i class="fas fa-backward" style="font-size: 30px;"></i>
          </a>
            FileManager
            <span class="text-muted" style="font-size: 30px;">View</span>
          </h1>
        </div>
      </div>

    </div>

      <div class="row m-0">
        <div class="col-md-12">
          
          <?php
        if (in_array(end($deneme), $dosya_uzantilari)) {
          if ($_POST) {
            $uzanti=pathinfo($_POST["baslik"]);
            if (isset($uzanti["extension"]) and in_array($uzanti["extension"], $dosya_uzantilari)) {
              $yenibaslik=$dizinyolu.duzenle($_POST["baslik"]);
            if (file_exists($yenibaslik)) {
              if ($yenibaslik == $view) {
                $kaydet=fopen($view, "w");
                try {
                fwrite($kaydet, $_POST["icerik"]);
                echo "Kayıt edildi.";        
                } catch (Exception $e) {
                echo "Kayıt edilmedi.";
                }
                fclose($kaydet);
              }
              else{
                echo duzenle($_POST["baslik"])." adında dosya var!";
              }
            }
            else{
                unlink($view);
                $kaydet=fopen($yenibaslik, "w");
                try {
                fwrite($kaydet, $_POST["icerik"]);
                echo "Kayıt edildi.";        
                } catch (Exception $e) {
                echo "Kayıt edilmedi.";
                }
                fclose($kaydet);
                header("location:view.php?view={$yenibaslik}");
            }
            }
            else{$top=0;
            foreach ($dosya_uzantilari as $key => $value) {
              $top++;
              echo ".".$value;
              if ($top!=count($dosya_uzantilari)) {
                echo " / ";
              }
              else{
                echo " => ";
              }
            }
            echo "uzantılarından birini giriniz.";
            }
          

            }
          }
          ?>

          <?php
        if (in_array(end($deneme), $image_uzantilari)) { 
          if ($_POST) {
            $uzanti=pathinfo($_POST["baslik"]);
            if (isset($uzanti["extension"]) and in_array($uzanti["extension"], $image_uzantilari)) {

            $yenibaslik=$dizinyolu.duzenle($_POST["baslik"]);
            if (file_exists($yenibaslik)) {
              if ($yenibaslik == $view) {
                echo "Ad değişmedi!";
              }
              else{
                echo duzenle($_POST["baslik"])." adında dosya var!";
              }
            }
            else{
              try {
                rename($view, $yenibaslik);
                echo "Güncellendi";
              } catch (Exception $e) {
                
              }
              header("location:view.php?view={$yenibaslik}");
            }
          }
          else{
            $top=0;
            foreach ($image_uzantilari as $key => $value) {
              $top++;
              echo ".".$value;
              if ($top!=count($image_uzantilari)) {
                echo " / ";
              }
              else{
                echo " => ";
              }
            }
            echo "uzantılarından birini giriniz.";
          }

            }
          }
          ?>
        </div>
      </div>

  </div>

  <!-- Başlık bitiş -->
  

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 p-0 m-0">

        <div class="input-group">
          <?php 
            if (in_array(end($deneme), $view_link)) {
          ?>

          <div class="input-group-append">

            <a href="<?php echo $view; ?>" class="btn btn-info" target="_blank" style="font-size: 23px;">
              <i class="fas fa-eye"></i>
            </a>

          </div>
          
          <?php
            }
          ?>
                    
        <input type="text" name="baslik" value="<?php echo $dosyaadi; ?>" class="form-control w-100 m-0 text-primary" required>

          <div class="input-group-append">

            <input type="submit" name="kaydet" value="Güncelle" class="btn btn-info" onclick="return confirm('Güncellensin mi?')">

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 p-0 m-0">
        <?php
        if (in_array(end($deneme), $dosya_uzantilari)) {
          ?>
        
          <textarea name="icerik" style="background-color: whitesmoke; width:100%; height:839px;margin: 0;">
            <?php
          if (file_exists($view)) {
            try {
              $variable=file($view);
              foreach ($variable as $key => $value) {
                  $value=str_replace("<", "&lt;", $value);
                  $value=str_replace(">", "&gt;", $value);
                if ($key==0) {
                 echo trim($value)."\n";
                }
                else{
                  echo $value;
                }
              }              
            } catch (Exception $e) {
              echo "Yazdırma Hatası";
            }
          }
          else{
            echo "Warning!!!";
          }
          
        ?>
       </textarea>
        


          <?php
        }
        else if (in_array(end($deneme), $image_uzantilari)) {
          if (file_exists($view)) {
            try {
          ?>

          <img src="<?php echo $view; ?>" alt="<?php echo $alt; ?>" class="img-fluid">
          <?php
        } catch (Exception $e) {              
              echo "Yazdırma Hatası";
            }
        }
        else{
          echo "Warning!!!";
        }
        }
        else
        {
          header("location:index.php");
        }
        ?>
      </div>
    </div>
  </div>
  
  </form>
  <script>
             document.addEventListener("DOMContentLoaded", function() {
            prettyPrint();
         });
  </script>
  <script type="text/javascript" src="js/prettify.js"></script>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
