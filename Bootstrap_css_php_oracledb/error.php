<?php
session_start();
$error=$_SESSION["error"];

if( !is_null($error));
 echo"$error";



?>