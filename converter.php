<?php

$conn = mysqli_connect("localhost", "", "", "");

if (mysqli_connect_errno())
  {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if (isset($_POST["import"])) {

    $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

    if(in_array($_FILES['file']['type'],$mimes)){

        $fileName = $_FILES["file"]["tmp_name"];    
        if ($_FILES["file"]["size"] > 0) {

            $file = fopen($fileName, "r");

            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                
                $sqlInsert = "INSERT INTO table_name (DNI,Nombre,Apellido,BLC_NRO) VALUES ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "')";

                $result = mysqli_query($conn, $sqlInsert);
                
            if (!empty($result)) {                
                    echo "<script type=\"text/javascript\">
                            alert(\"Archivo importado con éxito. ¡Gracias!. \");
                            window.location = \"subircsv.html\"
                        </script>";
            echo "MENSAJE: $message";
                } else {
                    $type = "error";
                    $message = "Hubo un problema importando el archivo.";
            echo "ERROR: $message";
                }
            };
            
        } else {
            echo "<script type=\"text/javascript\">
                            alert(\"El archivo está vacío. \");
                            window.location = \"subircsv.html\"
                        </script>";
        }
    } else {
        echo "<script type=\"text/javascript\">
                            alert(\"Selecciona un archivo .csv \");
                            window.location = \"subircsv.html\"
                        </script>";
    }
}

?>