<?php
if (is_file("php/function.php")) {
  require 'php/function.php';
}
else{
  die("Dosya eksik!!!");
}

urlyonlendirme($_SERVER['REQUEST_URI']);
uploadkontrol("upload/");

if (is_file("php/index_get.php")) {
  require 'php/index_get.php';
}
else{
  die("Dosya eksik!!!");
}
?>

<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>

  <?php
  if ("php/head.php") {
    require 'php/head.php';
  }
  else{
    die("Dosya eksik!!!");
  }
  ?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="vie" content="">
  
  <title><?php echo $site_adi." - ".$index; ?></title>
  <meta name="description" content="<?php echo $description; ?>"/>
  <meta name="keywords" content="<?php echo $keywords; ?>"/>
  <link rel="icon" href="css/<?php echo $ikon; ?>">
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="fontawesome-free-5.0.7/web-fonts-with-css/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- Başlık başlangıç -->
  <div class="container-fluid text-center p-1 bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>
            <?php echo $index; ?>
          </h1>
        </div>
      </div>
    </div>
  </div>
  <!-- Başlık bitiş -->

  <!-- içerik haritası başlangıç -->
  <div class="container-fluid breadcrumb m-0">
    <div class="row">
      <div class="col-md-12 clearfix">
        <div class="d-none d-sm-none d-md-block m-1 float-left" style="font-size: 40px;">
          <i class="far fa-folder-open text-primary"></i>
        </div>
        <nav aria-label="breadcrumb" class="mt-2 float-left">
          <h3>
            <ol class="breadcrumb">

              <?php
              if ($_GET)
              {
                if (isset($_GET["file"]) and $_GET["file"]!="") {
              ?>

              <li class="breadcrumb-item">
                <a href="index.php">
                  Upload
                </a>
              </li>

              <?php
              $dizin=explode("/",trim($_GET["file"],"/"));
              $toplam=0;
              $link="";
              foreach ($dizin as $key => $value) {
                $yol=trim($value);
                $link=$link.$yol."/";
                $toplam++;
                if ($toplam==count($dizin))
                {
              ?>

              <li class="breadcrumb-item active" aria-current="page">
                <form action="" method="post" class="btn-group" role="group">
                  <div id="filerenamelabel" class="w-100" onclick="filerename()">
                    <i class="fas fa-edit"></i>
                    <input type="text" class="filerenameview text-truncate" name="ilkdeger" value="<?php echo $yol;?>" readonly>
                  </div>
                  <div id="filerenametext">
                    <div class="input-group">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="filerenameexit()">
                          <i class="fas fa-times-circle"></i>
                        </button>
                      </div>
                      <input type="text" class="form-control" name="sondeger" placeholder="Klasör Adı Değiştir!" aria-label="Klasör Adı Değiştir!" aria-describedby="basic-addon2" value="<?php echo $yol;?>" required>
                      <div class="input-group-append">
                        <input class="btn btn-outline-secondary" type="submit" value="Güncelle" onclick="return confirm(' <?php echo $yol; ?> klasörünü güncellemek istiyor musunuz? ')">
                      </div>
                    </div>
                  </div>
                </form>

                <?php
                
                if ($_POST) {
                  $updateyol="upload";
                $location="";
                $variable=explode("/",trim($link,"/"));
                foreach ($variable as $key => $value) {
                  if ($key!=count($variable)-1) {
                    $updateyol=$updateyol."/".$value;
                    $location=$location."/".$value;
                  }
                }
                $location=trim($location,"/");
                  $updatefirst=$updateyol."/".$_POST["ilkdeger"];
                  $updatesecond=$updateyol."/".duzenle($_POST["sondeger"]);
                  if (is_dir($updatesecond)) {
                    echo $updatesecond." klasör var.";
                  }
                  else{
                    try {
                      rename($updatefirst, $updatesecond);
                      header("location:index.php?file={$location}");
                    } catch (Exception $e) {
                      echo "Güncellenemedi!!!";
                    }
                  }
                }
                ?>

              </li>

              <?php
            }
            else
            {
              ?>

              <li class="breadcrumb-item">
                <a href="?file=<?php echo trim($link,"/"); ?>">
                  <?php echo $yol;?>
                </a>
              </li>

              <?php
            }
          }
        }
        else {
          ?>

            <li class="breadcrumb-item active" aria-current="page">
              Upload
            </li>

          <?php
        }
      }
      else {
        ?>

            <li class="breadcrumb-item active" aria-current="page">
              Upload
            </li>

        <?php
      }
      ?>

          </ol>
        </h3>
      </nav>
    </div>

    <?php
    if(isset($_COOKIE['filenone']))
    {
    ?>

    <div id="error">
      <div class="col-md-12">
        <div class="alert alert-danger p-0" role="alert">
          <i class="fas fa-exclamation-circle m-2"></i>

          <?php echo "upload/".$_COOKIE['filenone']." klasörünün altında aradığınız klasörler yok!"; ?>

          <button class="btn btn-danger m-3" onclick="exiterror()">
            <i class="fas fa-times-circle"></i>
          </button>
        </div>
      </div>
    </div>

    <?php
  }
    ?>

          <div id="desteklenmeyen">
            <div class="col-md-12">
              <div class="alert alert-danger p-0" role="alert">
                <i class="fas fa-exclamation-circle m-2"></i>
                Desteklenmeyen dosya!!!
                <button class="btn btn-danger m-3" onclick="exiterror()">
                  <i class="fas fa-times-circle"></i>
                </button>
              </div>
            </div>
          </div>
      </div>
    </div>
    <!-- İçerik haritası bitiş -->

    <div class="container-fluid">
      <div class="row">
        <input type="text" class="w-100" id="myInput" onkeyup="myFunction()" placeholder="Bu dizin içerisinde ara...">
      </div>
    </div>

    <!-- İçerik Başlangıç -->
    <div class="container-fluid icerik mt-0 text-center"> 
      <div class="row">
        <div class="col-md-12 text-center">
          <p id="sonuc"></p>
        </div>
      </div>
      <div class="row" id="icerik">
        <!--klasör çektik-->
        <?php
        if (file_exists($dizin_adi)) {
          $dizin = opendir($dizin_adi);//dizin oku
          while ($file=readdir($dizin)) {//dizin içeriği
            if ($file=="." or $file=="..") continue;
            if (!is_file($dizin_adi."".$file)) {
              ?>

              <div class="col-6 col-sm-2 col-md-1">
                <a href="<?php echo "?file=".$gt.$file;?>" class="text-white m-0">
                  <div class="mt-1 py-3 bg-info border rounded">
                    <i class="far fa-folder"></i>
                    <h5 class="mt-2 text-truncate" style="font-size:15px;"><?php echo $file; ?></h5>
                  </div>
                </a>
                <a href="<?php echo "?folderdelete=upload/".$gt.$file; ?> " class="w-100 m-0 btn btn-danger" onclick="return confirm('<?php echo $file; ?> klasörü silinsin mi?')"><i class="fas fa-trash-alt"></i></a>
              </div>

              <?php
            }
          }
        }
        else {
          echo "Warning! Dizin bulunamadı!";
        }
        ?>
        <!--klasör çektik-->

        <!--Dosya çektik-->
        <?php
        if (file_exists($dizin_adi)) {
          $dizin = opendir($dizin_adi);//dizin oku
          while ($file=readdir($dizin)) {//dizin içeriği
            if ($file=="." or $file=="..") continue;
            if (is_file($dizin_adi."".$file)) {
              

              $image=explode(".", $file);
              $uzanti=end($image);
              if(in_array($uzanti, $dosya_uzantilari)){
                ?>
                  <div class="col-6 col-sm-2 col-md-1">
                    <a href="<?php echo "view.php?view=upload/".$gt.$file;?>" class="text-white" target="_blank">      
                      <div class="mt-1 py-3 bg-dark border rounded">
                        <i class="far fa-file"></i>
                        <h5 class="mt-2 text-truncate" style="font-size:15px;"><?php echo $file; ?></h5>
                      </div>
                    </a>
                    <a href="<?php echo "?filedelete=upload/".$gt.$file; ?> " class="w-100 m-0 btn btn-danger" onclick="return confirm('<?php echo $file; ?> dosyası silinsin mi?')"><i class="fas fa-trash-alt"></i></a>
                  </div>
                <?php
              }
              else if(!in_array($uzanti, $dosya_uzantilari) and !in_array($uzanti, $image_uzantilari)){
              ?>
                  <div class="col-6 col-sm-2 col-md-1 text-white" onclick="desteklenmeyen()">
                      <div class="mt-1 py-3 bg-secondary border rounded">
                        <i class="far fa-file"></i>
                        <h5 class="mt-2 text-truncate" style="font-size:15px;"><?php echo $file; ?></h5>
                      </div>
                      <a href="<?php echo "?filedelete=upload/".$gt.$file; ?> " class="w-100 m-0 btn btn-danger" onclick="return confirm('<?php echo $file; ?> desteklenmeyen dosya silinsin mi?')"><i class="fas fa-trash-alt"></i></a>
                  </div>

              <?php
              }

            }
          }
        }
        else {
          echo "Warning! Dizin bulunamadı!";
        }
        ?>
        <!--Dosya çektik-->

        <!--image çektik-->
        <?php
        if (file_exists($dizin_adi)) {
          $dizin = opendir($dizin_adi);//dizin oku
          while ($file=readdir($dizin)) {//dizin içeriği
            if ($file=="." or $file=="..") continue;
            if (is_file($dizin_adi."".$file)) {
              

              $image=explode(".", $file);
              $uzanti=end($image);
              if (in_array($uzanti, $image_uzantilari)) {
                ?>
                  <div class="col-6 col-sm-2 col-md-1">
                <a href="<?php echo "view.php?view=upload/".$gt.$file;?>" class="text-white" target="_blank">
                  <div class="mt-1 bg-success border rounded">
                    <img src="<?php echo "upload/".$gt.$file; ?>" alt="<?php echo "filemanager_".$file; ?>" class="fluid">
                    <h5 class="mt-2 text-truncate" style="font-size:15px;"><?php echo $file; ?></h5>
                  </div>
                </a>
                <a href="<?php echo "?filedelete=upload/".$gt.$file; ?> " class="w-100 m-0 btn btn-danger" onclick="return confirm('<?php echo $file; ?> resmi silinsin mi?')"><i class="fas fa-trash-alt"></i></a>
              </div>
                <?php
              }
            }
          }
        }
        else {
          echo "Warning! Dizin bulunamadı!";
        }
        ?>
        <!--image çektik-->
      </div>
    </div>
    <!-- İçerik bitiş -->

    <!-- İşlem Alanı Başlangıç -->
    <div class="container-fluid fixed-bottom">
      <div class="row d-none d-md-none d-lg-block">
        <div class="col-md-4 bg-secondary height float-left">
          <button class="btn w-100 h-100 pt-1 text-light text-uppercase" onclick="newfolder()">New Folder</button>
        </div>
        <div class="col-md-4 bg-dark height float-left">
          <button class="btn w-100 h-100 pt-1 text-light text-uppercase" onclick="newfile()">New Fıle</button>
        </div>
        <div class="col-md-4 bg-info height float-left">
          <button class="btn w-100 h-100 pt-1 text-white text-uppercase" onclick="upload()">Fıle Upload</button>
        </div>
      </div>
    </div>
    <!-- İşlem alanı bitiş -->

    <!-- mobil İşlem Alanı Başlangıç -->
    <div class="container-fluid fixed-bottom bg-light">
      <div class="row d-block d-md-block d-lg-none">
        <div class="col-4 float-left">
          <button class="btn w-100 h-100" onclick="newfolder()">
            <img src="./img/folder-plus-solid.svg" alt="" width="43px">
          </button>
        </div>
        <div class="col-4 float-left">
          <button class="btn w-100 h-100" onclick="newfile()">
            <img src="./img/file-medical-solid.svg" alt="" width="30px">
          </button>
        </div>
        <div class="col-4 float-left">
          <button class="btn w-100 h-100" onclick="upload()">
            <img src="./img/file-upload-solid.svg" alt="" width="30px">
          </button>
        </div>
      </div>
    </div>
    <!-- mobil İşlem alanı bitiş -->

    <!-- </div> -->
    <div id="newfolder">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12 pr-0 clearfix bg-primary">
            <h4 class="float-left m-1 text-white">New Folder</h4>
            <button class="btn float-right btn-danger" onclick="exit()">
              <i class="fas fa-times-circle"></i>
            </button>
          </div>

        </div>
      </div>
      <div class="container-fluid mt-4">
    <form action="class_newfolder.php" method="post">
      <div class="form-row">

        <div class="form-group col-6">

          <input type="text" class="form-control" name="gt" placeholder="upload/" value="<?php echo $gt; ?>" readonly>

        </div>
        <div class="form-group col-6">

          <input type="text" class="form-control" name="newfolder" placeholder="New Folder Name" value="" required>

        </div>

      </div>

      <div class="form-row">

        <button type="submit" class="btn btn-primary mt-2 col-12" onclick="return confirm('Klasör oluşturulsun mu?')">Create</button>

      </div>
    </form>
  </div>
    </div>

    <div id="newfile">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 pr-0 clearfix bg-primary">
            <h4 class="float-left m-1 text-white">New File</h4>
            <button class="btn float-right btn-danger" onclick="exit()">
              <i class="fas fa-times-circle"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="container-fluid mt-4">
  <form class="" action="class_newfile.php" method="post">
    <div class="form-row">

      <div class="form-group col-5">

        <input type="text" class="form-control" name="gt" placeholder="upload/" value="<?php echo $gt; ?>" readonly>

      </div>

      <div class="form-group col-5">

        <input type="text" class="form-control" name="newfile" placeholder="New File Name" required>

      </div>

      <div class="form-group col-2">

        <select name="fileextention" class="w-100 h-100">
          <option value=".html">.html</option>
          <option value=".css">.css</option>
          <option value=".js">.js</option>
          <option value=".php">.php</option>
          <option value=".txt">.txt</option>
        </select>
      </div>

    </div>

    <div class="form-row">

      <button type="submit" class="btn btn-primary mt-2 col-12" onclick="return confirm('Dosya oluşturulsun mu?')">Create</button>

    </div>
  </form>
</div>
    </div>
    <div id="upload">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 pr-0 clearfix bg-primary">
            <h4 class="float-left m-1 text-white">File Upload</h4>
            <button class="btn float-right btn-danger" onclick="exit()">
              <i class="fas fa-times-circle"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="container-fluid mt-4">
  <form action="class_fileupload.php" method="post" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group col-6">

        <input type="text" class="form-control" name="gt" placeholder="upload/" value="<?php echo $gt; ?>" readonly>

      </div>

      <div class="form-group col-6">

        <input type="file" class="form-control p-1" name="fileupload" required>

      </div>

    </div>

    <div class="form-row">
      <input type="submit" name="Submit" class="btn btn-primary mt-2 col-12" value="upload"  onclick="return confirm(' <?php echo "upload/".$gt; ?> dizinine yüklensin mi?')">

    </div>
  </form>
</div>
    </div>


    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
  </html>
