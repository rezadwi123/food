<?php
// logout.php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the loginpetugas page after logout
header("Location: loginpetugas.php");
exit();
