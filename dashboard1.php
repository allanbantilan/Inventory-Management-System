<?php include 'includes/session_check.php'; ?>
<?php include 'includes/session_handler.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .square-container {
            width: 200px;
            /* Set the width of the container */
            height: 200px;
            /* Set the height equal to the width */
            overflow: hidden;
            /* Hide overflow to keep it square */
        }
    </style>

<script src="js/activity.js"></script>


</head>

<body>

    <?php require 'includes/dashboard.php'; ?>

    <script>
        // Check if the timeout parameter is present in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const timeoutParam = urlParams.get('timeout');
        if (timeoutParam === 'true') {
            // Display an alert indicating the user is logged out due to inactivity
            alert('You have been logged out due to inactivity.');
        }
    </script>

</body>


</html>