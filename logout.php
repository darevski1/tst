<?php session_start();

  require_once('./includes/db.php');
  require_once('./includes/config.php');


  ConnectToDatabase();

  unset($_SESSION['user_id']);
  
  setcookie("uud", "", time() - 3600, "/", ".mkoglasnik.mk");
  setcookie("uud", "", time() - 3600, "/", "ds.mkoglasnik.mk");

?>
      <script type="text/javascript">
        window.location.replace("./login");
      </script>       
      
      
