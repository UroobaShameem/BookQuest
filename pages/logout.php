<?php
session_start();

// Destroy all session data
session_destroy();

//redirect to index page
header("Location: ../index.html");
exit;
?>
