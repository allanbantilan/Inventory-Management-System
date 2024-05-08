<?php
// Function to handle session timeout and force logout
function handleSessionTimeout($timeout = 60) { // Default timeout: 60 seconds (1 minute)
    try {
        // Start or resume the session
        session_start();

        // Check if last activity time is set and session is active
        if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $timeout) {
            // Log the user out due to inactivity
            // Unset all of the session variables
            $_SESSION = array();
            // Destroy the session
            if (!session_destroy()) {
                throw new Exception("Unable to destroy session");
            }
            // Redirect the user to the login page with a message indicating the reason for the logout
            header("Location: ../index.php?timeout=true");
            exit;
        } else {
            // Update last activity time
            $_SESSION['last_activity'] = time();
        }
    } catch (Exception $e) {
        // Handle any exceptions
        echo "Error: " . $e->getMessage();
        // Log the error to a file or perform other error handling tasks as needed
    }
}
?>
