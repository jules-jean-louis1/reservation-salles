<?php
session_start();
// Destroying All Sessions
if(session_destroy())
{
// Redirection vers la page d'acceuil
header("Location: index.php");
}
exit;
?>