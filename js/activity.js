document.addEventListener("DOMContentLoaded", function() {
    var inactiveTime = 0;
    var timerInterval = null;

    // Function to reset inactive time and start the logout timer
    function resetInactiveTime() {
        inactiveTime = 0;
        if (!timerInterval) {
            timerInterval = setInterval(function() {
                inactiveTime++;
                if (inactiveTime >= 10) { // 10 minutes of inactivity
                    // Perform AJAX request to update last activity time on server
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "/inventory/includes/logout.php", true);
                    xhr.send();
                    clearInterval(timerInterval); // Clear the interval once logout is initiated
                }
            }, 60000); // 1 minute
        }
    }

    // Track user activity
    document.addEventListener("mousemove", resetInactiveTime);
    document.addEventListener("keypress", resetInactiveTime);

    // Function to reset inactive time when the page receives focus
    window.addEventListener("focus", resetInactiveTime);
});
