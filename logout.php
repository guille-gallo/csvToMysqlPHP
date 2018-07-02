<?php
   session_start();
   unset($_SESSION["valid"]);
   unset($_SESSION["farmaciaID"]);  

   header('Location: farmaciaLogin.html');
?>