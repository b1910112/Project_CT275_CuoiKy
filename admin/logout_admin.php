<?php
    session_start();
    //remove all session varibles
    session_unset();

    //destroy the session
    session_destroy();
    header("location: login_admin.php");
?>