    <?php
    // Start a session
    session_start();
    require 'phpalert.php';
    $alert = new PHPAlert();

    // Check if the user is not logged in
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        // Redirect the user to the login page or display an alert
        $alert->info("You are logged out due to inactivity, Go back to log in page.");
        echo '<script>window.setTimeout(function(){window.location.href = "index.php";}, 3000);</script>';
        exit();

    }

    // Check if the user is trying to access a restricted page
    $restrictedPages = array("addCategory.php", "addUser.php", "register.php", "login_activity.php", "user_status.php");
    $currentFile = basename($_SERVER["SCRIPT_FILENAME"]);
    if (in_array($currentFile, $restrictedPages)) {
        // Check if the user is not an admin
        if ($_SESSION['type'] !== 'admin') {

            $alert->info("You are not allowed to access this page.");
            echo '<script>window.setTimeout(function(){window.location.href = "dashboard1.php";}, 3000);</script>';
            exit();
        }
    }

    // Check if the user is trying to access a restricted page for type == 'audit'
    $restrictedPagesAudit = array("history.php", "historySTA.php", "inventory.php", "inventorySTA.php", "activitylog.php", "dashboard1.php", "addUser.php", 
                                "addCategory.php", "issued_items_log.php", "acitivitylog.php");
    if (in_array($currentFile, $restrictedPagesAudit)) {
        // Check if the user is not an audit type
        if ($_SESSION['type'] == 'audit') {
            // Display an error message and redirect back to dashboard1.php
            $alert->info("You are not allowed to access this page.");
            echo '<script>window.setTimeout(function(){window.location.href = "audit_inventory.php";}, 3000);</script>';
            exit();

        }
    }

    

    ?>
