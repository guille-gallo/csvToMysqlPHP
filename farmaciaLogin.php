<?php

session_start();

if (isset($_GET["submit"])) {  
            
  if (isset($_GET['submit']) && !empty($_GET['farmaciaID']) && !empty($_GET['clave'])) {

      if ($_GET['farmaciaID'] == '' && $_GET['clave'] == '') {
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['farmaciaID'] = '';
        header("Location: action_page.php");        
      } else {
        echo "<script type=\"text/javascript\">
						alert(\"Usuario y/o contraseña incorrecto. \");
						window.location = \"farmaciaLogin.html\"
					</script>";
      }
  } else {
    echo "<script type=\"text/javascript\">
						alert(\"Complete los campos para ingresar. \");
						window.location = \"farmaciaLogin.html\"
					</script>";
  }
}

?>