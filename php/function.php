<?php

function uploadkontrol($value)
{
  if (file_exists($value)) {
    if (!is_dir($value)) {
      mkdir($value,0777);
    }
  }
  else{
    mkdir($value,0777);
  }
}

function urlyonlendirme($url)
{
  $domain = strstr($url, 'index.php');
  $soru=strstr($domain, '?');
  $bolu=strstr($domain, 'index.php/');
  $bolu2=strstr($domain, '?file=/');
  if (empty($domain)) 
  {
    header("location:index.php");
    if (empty($soru)) {
      header("location:index.php?file=");
    }
  }
  else
  {
    if (empty($bolu)) 
    {
      if (empty($soru)) 
      {
        header("location:?file=");
      } 
      else if(!empty($bolu2))
      {
        header("location:index.php?file=");
      }
    }
    else
    {
      header("location:../index.php?file=");
    }
  }
}

function folderdelete($dir)
{
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object)
    {
      if ($object != "." && $object != "..")
      {
        if (is_dir($dir. "/" . $object)) 
        {
          folderdelete($dir . "/" . $object);
        } 
        else 
        {
          unlink($dir . "/" . $object);
        }
      }
    }
    rmdir($dir);
  }
}

function filedelete($file)
{
  if (!is_dir($file)) 
  {
    unlink($file);
  }
}

function duzenle($value)
{
  $turkce=["Ç","Ğ","İ","Ü","Ö","Ş","ç","ğ","ı","ü","ö","ş"];
  $latin=["C","G","I","U","O","S","c","g","i","u","o","s"];
  $value = str_replace($turkce, $latin, $value);
  $value = preg_replace("@[^A-Za-z0-9.]@", " ", $value);
  $value = trim(preg_replace("@\s+@", " ", $value));
  $value = str_replace(" ", "_", $value);
  $value = mb_strtolower($value);
  return $value;
}

?>