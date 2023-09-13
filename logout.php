<?php
session_start();
if (isset($_SESSION['is_auth'])) {
    unset($_SESSION['is_auth']);
    header('location: login.php');
}
