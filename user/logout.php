<?php
session_destroy();
session_start();
header('location:../index.php');
$_SESSION['pesan'] = 'Anda Telah Logout';
