<?php
// Start the session
session_start();

// Destroy all session data
session_destroy();

// Redirect to the desired page after logout
header("Location: ../index.html");
exit;
?>
