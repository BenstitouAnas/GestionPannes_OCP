<?php
session_start();

unset($_SESSION['typeUser']);
unset($_SESSION['idUser']);
unset($_SESSION['prenomUser']);
unset($_SESSION['emailUser']);
if(isset($_SESSION['nomUser']))
	unset($_SESSION['nomUser']);
if(isset($_SESSION['nomUserAgent']))
	unset($_SESSION['nomUserAgent']);

echo "<meta http-equiv='refresh' content='0; url=index.php'>";

exit;

?>