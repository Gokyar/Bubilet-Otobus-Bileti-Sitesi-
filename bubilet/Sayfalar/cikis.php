<?php
session_start();

//session'daki verileri temizleyip sonlandırıyoruz.
session_unset(); 
session_destroy(); 

header("Location: index.php");
exit;
?>