<?php
// Protect Child-Pages, avoid direct access
defined('A') or die(header('HTTP/1.0 403 Forbidden'));
?>

<script>
    $(document).ready(function(){
      let canVibrate = false;
      if('vibrate' in navigator){
        canVibrate = true;
      }

      const available = document.getElementById("available");
      const later = document.getElementById("later");
      const absenct = document.getElementById("absenct");

      // Eventlistener for Available Button
      available.addEventListener("click", () => {
        document.getElementById("available").innerHTML = "";
        document.getElementById("available").setAttribute("aria-busy", "true");
        document.getElementById("later").setAttribute("class", "secondary");
        document.getElementById("absenct").setAttribute("class", "contrast");
        $.get("api/send.php?name=<?php echo $user_name; ?>&status=1", function(data, status){
          var json = jQuery.parseJSON(data);
          document.getElementById("available").innerHTML = "Komme";
          document.getElementById("available").setAttribute("class", "outline");
          document.getElementById("available").removeAttribute("aria-busy");
          if (canVibrate){
          navigator.vibrate(100);
          }
        });
      });

      // Eventlistener for later Button
      later.addEventListener("click", () => {
        document.getElementById("later").innerHTML = "";
        document.getElementById("later").setAttribute("aria-busy", "true")
        document.getElementById("available").removeAttribute("class");
        document.getElementById("absenct").setAttribute("class", "contrast");
        $.get("api/send.php?name=<?php echo $user_name; ?>&status=2", function(data, status){
          document.getElementById("later").innerHTML = "Sp&auml;ter";
          document.getElementById("later").setAttribute("class", "outline");
          document.getElementById("later").removeAttribute("aria-busy");
          if (canVibrate){
          navigator.vibrate(100);
          }
        });
      });

      // Eventlistener for Abscent
      absenct.addEventListener("click", () => {
        document.getElementById("absenct").innerHTML = "";
        document.getElementById("absenct").setAttribute("aria-busy", "true")
        document.getElementById("later").setAttribute("class", "secondary");
        document.getElementById("absenct").setAttribute("class", "outline contrast");
        document.getElementById("available").removeAttribute("class");
        $.get("api/send.php?name=<?php echo $user_name; ?>&status=3", function(data, status){
          document.getElementById("absenct").innerHTML = "Abwesend";
          document.getElementById("absenct").removeAttribute("aria-busy");
          if (canVibrate){
          navigator.vibrate(100);
          }
        });
      });
    });

    </script>

<hgroup>
  <h5>Moin</h5>
  <h1><?php echo $user_name; ?></h1>
  <h2></h2>
</hgroup>

<p>
  <div id="available" role="button" tabindex="0">Komme</div>
</p>
<p>
  <div id="later" role="button" tabindex="0" class="secondary">Sp&auml;ter</div>
</p>
<p>
  <div id="absenct" role="button" tabindex="0" class="contrast">Abwesend</div>
</p>
