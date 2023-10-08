<?php
// Protect Child-Pages, avoid direct access
defined('A') or die(header('HTTP/1.0 403 Forbidden'));
?>

<script>
    $(document).ready(function () {
      refreshTable();
    });

    function refreshTable(){
        $.get("api/fetch.php", function(data, status){
          var json = jQuery.parseJSON(data);
          document.getElementById("time").innerHTML = json.time;
          document.getElementById("ammount_1").innerHTML = json.ammount_1;
          document.getElementById("ammount_2").innerHTML = json.ammount_2;
          document.getElementById("ammount_3").innerHTML = json.ammount_3;

          var ammount_1_userarray = "";
          for (var key in json.ammount_1_user){
            ammount_1_userarray = json.ammount_1_user[key] +"<br>"+ ammount_1_userarray;
          }

          var ammount_2_userarray = "";
          for (var key in json.ammount_2_user){
            ammount_2_userarray = json.ammount_2_user[key] +"<br>"+ ammount_2_userarray;
          }
          var ammount_3_userarray = "";
          for (var key in json.ammount_3_user){
            ammount_3_userarray = json.ammount_3_user[key] +"<br>"+ ammount_3_userarray;
          }

          document.getElementById("ammount_1_user").innerHTML = ammount_1_userarray;
          document.getElementById("ammount_2_user").innerHTML = ammount_2_userarray;
          document.getElementById("ammount_3_user").innerHTML = ammount_3_userarray;
          setTimeout(refreshTable, 5000);
        });


    };


</script>


<hgroup>
  <h5>myStatus</h5>
  <h1>Dashboard</h1>
  <h2></h2>
</hgroup>
<p aria-busy="true"></p>
<p id="time">?</p>

<div class="grid">
  <div><h5>Komme<br><p id="ammount_1">?</p></h5>
  <p id="ammount_1_user">?</p>
  </div>
  <div><h5>Sp&auml;ter<br><p id="ammount_2">?</p></h5>
  <p id="ammount_2_user">?</p>
  </div>
  <div><h5>Abwesend<br><p id="ammount_3">?</p></h5>
  <p id="ammount_3_user">?</p></div>
</div>