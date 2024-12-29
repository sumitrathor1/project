<?php
if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['session']) == 'false')
{
    session_start();
    session_destroy();
    header("Location: index.php");
}

if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}
?>