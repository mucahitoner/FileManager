<script type="text/javascript">
	var deger;
    var saniye=4;
          function saniyeBaslat()
          {
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
  $turkce=["Ç","Ğ","İ","Ü","Ö","Ş","ç","ğ","ı","ü","ö","ş"];
  $latin=["C","G","I","U","O","S","c","g","i","u","o","s"];
  $value = str_replace($turkce, $latin, $value);
  $value = preg_replace("@[^A-Za-z0-9.]@", " ", $value);
  $value = trim(preg_replace("@\s+@", " ", $value));
  $value = str_replace(" ", "_", $value);
  $value = mb_strtolower($value);
  return $value;
}
if ($_POST) {
	if ($_FILES) {
		$yukleme_yeri="upload/".$_POST["gt"];
		$dosya_adi=$_FILES["fileupload"]["name"];
		$parcala=pathinfo($dosya_adi);
		$dosya_adi=duzenle($parcala["filename"]).".".$parcala["extension"];
		if (file_exists($yukleme_yeri.$dosya_adi)) {
			$parcala=pathinfo($dosya_adi);
			$yeni_dosya_adi=duzenle($parcala["filename"])."_".uniqid().".".$parcala["extension"];
		}
		else{
			$parcala=pathinfo($dosya_adi);
			$yeni_dosya_adi=duzenle($parcala["filename"]).".".$parcala["extension"];
		}
		$dosya_turu=$_FILES["fileupload"]["type"];
		$yuklencek_yer=$_FILES["fileupload"]["tmp_name"];
		$dosya_hatasi=$_FILES["fileupload"]["error"];
		$dosya_turleri = ["image/gif","image/jpeg","image/png","image/svg+xml","image/x-icon","image/webp","text/html","text/css","application/x-javascript","application/x-php","text/plain"];
		if ($dosya_hatasi==0) {
			if (in_array($dosya_turu, $dosya_turleri)) {
				$link=$yukleme_yeri.$yeni_dosya_adi;
				$upload=move_uploaded_file($yuklencek_yer, $link);
				if ($upload==true) {
					header("location:view.php?view={$link}");
				}
				else{
				?>
					
					<div class="kapsam">
        				<div id="saniye"></div>
          				<div id="uyari">Dosya yüklenemedi. Yönlediriliyorsunuz...</div>          
        			</div>

				<?php
				die(header("refresh:5;url=index.php?file={$_POST["gt"]}"));
				}
			}
			else{
			?>
				
				<div class="kapsam">
          			<div id="saniye"></div>
          			<div id="uyari">Dosya uygun uzantıya sahip değil. Yönlediriliyorsunuz...</div>          
        		</div>

			<?php
			die(header("refresh:5;url=index.php?file={$_POST["gt"]}"));
			}
		}
		else{
		?>

			<div class="kapsam">
          		<div id="saniye"></div>
          		<div id="uyari">Dosya da bir hata oluştu. Yönlediriliyorsunuz...</div>          
        	</div>

		<?php
		die(header("refresh:5;url=index.php?file={$_POST["gt"]}"));
		}
	}
	else{
	?>

		<div class="kapsam">
          <div id="saniye"></div>
          <div id="uyari">Error Files! Yönlediriliyorsunuz...</div>          
        </div>

	<?php
	die(header("refresh:5;url=index.php?file="));
	}
}
else{
?>

<div class="kapsam">
	<div id="saniye"></div>
	<div id="uyari">Error Post! Yönlediriliyorsunuz...</div>          
</div>

<?php
die(header("refresh:5;url=index.php?file="));
}
?>