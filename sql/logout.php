<?php
// Logout Session
        session_start();
        session_destroy();
        header("Location: ../login.php");
?>