<?php
session_start();
session_destroy();

header('location:HTML/menu.php');
?>