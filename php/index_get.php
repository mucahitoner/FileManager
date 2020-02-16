<?php
setcookie("songt","");
setcookie("filenone","");

if ($_GET) {
  if (isset($_GET["file"]) and $_GET["file"]!="") {
    $dizin_adi = "upload/".$_GET["file"]."/";
    if (file_exists($dizin_adi)) {
      $gt=$_GET["file"]."/";
      setcookie("songt",$gt);
    }
    else {
      $f=trim($_COOKIE['songt'],"/");
      setcookie("filenone",$f);
      header("location:index.php?file={$f}");
    }
  }
  else if (isset($_GET["filedelete"]) and $_GET["filedelete"]!="") {
    filedelete($_GET["filedelete"]);     
    $f=trim($_COOKIE['songt'],"/");
    header("location:index.php?file={$f}");
  }
  else if (isset($_GET["folderdelete"]) and $_GET["folderdelete"]!="") {
    folderdelete($_GET["folderdelete"]);
    $f=trim($_COOKIE['songt'],"/");
    header("location:index.php?file={$f}");
  }
  else {
    $dizin_adi = "upload/";
    $gt="";
  }
}
else {
  setcookie("songt","");
  $dizin_adi = "upload/";
  $gt="";
}
?>