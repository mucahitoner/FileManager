function myFunction() {
  var input, filter, icerik, item, h5, i, txtValue;
  var deger="";
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  icerik=document.getElementById("icerik");
  item=icerik.getElementsByTagName("div");
  document.getElementById("sonuc").innerHTML="";
    for (i = 0; i < item.length; i++) {
      h5 = item[i].getElementsByTagName("h5")[0];
      txtValue = h5.textContent || h5.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        deger=deger+txtValue.toUpperCase().indexOf(filter);
        item[i].style.display="";
      } else {
        item[i].style.display="none";
      }
  }
  if (deger=="") {
    document.getElementById("sonuc").style.display = "block";
    document.getElementById("sonuc").innerHTML = "Aradığınız klasör veya dosya yok!";
  }
  else{
    document.getElementById("sonuc").style.display = "none";
  }

}
function filerename(){
  document.getElementById("filerenametext").style.display = "block";
  document.getElementById("filerenamelabel").style.display = "none";
}
function filerenameexit(){
  document.getElementById("filerenametext").style.display = "none";
  document.getElementById("filerenamelabel").style.display = "block";
}
function desteklenmeyen(){
  document.getElementById("desteklenmeyen").style.display = "block";
}
function newfolder() {
  document.getElementById("newfile").style.display = "none";
  document.getElementById("upload").style.display = "none";
  document.getElementById("newfolder").style.display = "block";
}
function newfile() {
  document.getElementById("newfolder").style.display = "none";
  document.getElementById("upload").style.display = "none";
  document.getElementById("newfile").style.display = "block";
}
function upload() {
  document.getElementById("newfolder").style.display = "none";
  document.getElementById("newfile").style.display = "none";
  document.getElementById("upload").style.display = "block";
}
function exit() {
  document.getElementById("newfolder").style.display = "none";
  document.getElementById("newfile").style.display = "none";
  document.getElementById("upload").style.display = "none";
}
function exiterror() {
  document.getElementById("desteklenmeyen").style.display = "none";
  document.getElementById("error").style.display = "none";
}