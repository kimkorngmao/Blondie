<?php
              $conn = new mysqli ('localhost' , 'root' , '' ,'php_project');
              if ($conn -> connect_error)
                  die("Connection Error:" . $conn-> connect_error);
?>