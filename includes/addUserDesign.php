<?php require 'nav_bar.php' ?>


<?php require 'profileLogout.php' ?>
    <!-- End of Topbar -->
    <div class="container-fluid">
    <div class="row justify-content-center"> <!-- Centering the content horizontally -->
        <div class="col-lg-5">
            <!-- Basic Card Example -->
            <div class="card shadow mb-6 mt-5">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
                </div>
                <div class="card-body">
                    <form id="addUserForm" action="includes/add_user.php" method="post">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">User Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="type">User Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="w" disabled selected>Select Here</option>
                                <option value="admin">Super User</option>
                                <option value="user">User</option>
                                <option value="audit">Audit</option>
                              
                            </select>
                        </div>
                        <div class=" d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" id="saveUser">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

  




 

<!-- End Example Table -->
</div>
      
                
                    </div>
                </div> 

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
    <form action="includes/logout.php" method="post">
                    <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                </form>
    </div>
</div>
</div>
</div>

<!-- Include jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Include DataTables JavaScript -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


<!-- Initialize DataTables -->
<script>
$(document).ready(function() {
// Initialize DataTable for each table
$('#categoryTable').DataTable();
$('#statusTable').DataTable();
});
</script>

<!-- Include Bootstrap CSS -->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<!-- Include DataTables CSS -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Other scripts and styles -->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/sb-admin-2.min.js"></script>


</script>


<script>
// Function to fetch user data and populate modal inputs
// Function to fetch user data and populate modal inputs
function populateProfileModal() {
    // AJAX request to fetch user data
    $.ajax({
        url: '/inventory/includes/fetchUserData.php',
        method: 'GET',
        success: function(response) {
            // Parse the JSON response
            var userData = JSON.parse(response);
            console.log('User Data:', userData); // Log user data for debugging
            
            // Populate form fields with user data
            $('#firstNameChange').val(userData.firstName);
            $('#lastNameChange').val(userData.lastName);
            $('#emailChange').val(userData.email);
            // Populate other form fields as needed
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error('Error fetching user data:', error);
        }
    });
}


// When the Profile link is clicked, populate the modal with user data
$('#profileLink').click(function(e) {
    e.preventDefault();
    populateProfileModal();
    $('#passwordChangeModal').modal('show');
});

// Function to handle form submission for changing password
$('#passwordChangeForm').submit(function(e) {
    e.preventDefault();
    // Add code here to handle form submission and password change
    // You can use AJAX to send the form data to a PHP script for processing
});

</script>