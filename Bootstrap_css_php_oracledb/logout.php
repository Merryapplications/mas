<?php

session_start();
unset($_SESSION["islogon"]);
unset($_SESSION["CUS_ID"]);
unset($_SESSION["id"]);
unset($_SESSION["logintype"]);
echo("<script> parent.location.reload(); </script>");
?>