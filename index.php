<?php
session_start();               // Start Session for Sessionmanagement
include("mysql.php");          // Include MySQL Access and Functions
define('A',true);              // Protect Child-Pages, avoid direct access

if (!empty($_GET['name'])){
  $user_name = strval($_GET['name']);
}

?>

<!doctype html>
<html lang="en" manifest="mystatus.manifest">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>myStatus</title>
    <link rel="icon" type="image/x-icon" href="css/favicon.png">
    <!-- Google font: Calistoga -->
    <link rel="stylesheet" href="css/fonts.css">

    <!-- Pico.css custom build inlined for Google AMP -->
    <link rel="stylesheet" href="css/pico.min.css">

    <!-- jQuery & AJAX -->
    <script src="css\jquery-3.7.1.min.js"></script>
  </head>

  <body>
    <!-- Main Page -->
    <main class="container" style="text-align:center;">

        <?php
          if (!empty($_GET['name'])){
            // Include Child Pages
            if (isset($_GET['page'])){
              if (file_exists("".$_GET['page'].".php")){
                  include("".$_GET['page'].".php");
                }else{
                  echo "<article><h1>Fehler</h1>
                  <p>Seite existiert nicht</p></article>";
                }
            }else{
              include("status.php");
            }
        }else{
          echo "<hgroup>
          <h5>Moin</h5>
          <h1>myStatus</h1>
          <h2></h2>
        </hgroup><br><br>";
          echo "<p><form role=\"group\" action=\"index.php\" method=\"GET\">
            <input type=\"text\" name=\"name\" placeholder=\"Name\" aria-label= \"Text\"/>
            <input type=\"submit\" value=\">>\"/>
            </form></p>";
        }
        ?>
    </main>
    
    <!-- Footer -->
    <footer style="text-align:center;">
      <p><a href="index.php?page=status&name=<?php echo $user_name; ?>">Status</a><br>
      <a href="index.php?page=dashboard&name=<?php echo $user_name; ?>">Dashboard</a><br>
      <a href="index.php">Abmelden</a></p>
      <small>myStatus</small><br>
      <small>2023 &#128293; Wolf</small>
    </footer>
  </body>
</html>