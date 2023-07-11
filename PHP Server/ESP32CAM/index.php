<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ESP32-CAM Captured Photo Gallery</title>
  </head>
  <body style="background-color:#202125;" id="myESP32CAMPhotos">
    <script>
    var totalphotos = 0;
    var last_totalphotos = 0;
    
    loadPhotos();
    
    var timer_1 = setInterval(myTimer_1, 2000);
    
    function myTimer_1() {
      getTotalPhotos();
      if(last_totalphotos != totalphotos) {
        last_totalphotos = totalphotos;
        
        loadPhotos();
      }
    }
    
    function getTotalPhotos() {
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          totalphotos = this.responseText;
        }
      };
      xmlhttp.open("POST","CountImageFile.php",true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("cmd=GTP");
    }
    
    function loadPhotos() {
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("myESP32CAMPhotos").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","loadPhotos.php",true);
      xmlhttp.send();
    }
    </script>
  </body>
</html>