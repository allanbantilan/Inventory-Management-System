<style>
    /* Hide the Id column */
    #dataTable th:first-child,
    #dataTable td:first-child {
        display: none;
    }
</style>



<?php require 'nav_bar.php' ?>

            <?php require 'profileLogout.php' ?>



                <!-- Begin Page Content -->
                <div class="container-fluid">
    <div class="card shadow mb-4">
                <div class="card-header py-3">
                <div class="row">
                    <div class="col">
                        <h6 class="m-2 font-weight-bold text-primary">History - Sta. Ana</h6>
                    </div>
                    <!-- <div class="col">
                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addItemModal">Add Items</button>
                    </div> -->
                </div>
            </div>

        <div class="card-body">
        <div class="row mb-3 px-0">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-3">
                                            <!-- Search input -->
                                           
                                           
                                            
                                       
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
            <div class="table-responsive" >
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="display: none;">Id</th>
                            <th>Serial Number</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Date Added</th>
                            <th>Date Deleted</th>
                            <th>Remarks</th>
                            <th>Removed By</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require 'db_connect.php';

                        // Fetch data from the inventory table
                        $sql = "SELECT * FROM historysta";
                        $result = $conn->query($sql);

                        // Check if there are any rows returned
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['historyIDSTA'] . "</td>";
                                echo "<td>" . $row['serialNumberHisSTA'] . "</td>";
                                echo "<td>" . $row['typeHisSTA'] . "</td>";
                                echo "<td>" . $row['statusHisSTA'] . "</td>";
                                echo "<td>" . $row['descriptionHisSTA'] . "</td>";
                                echo "<td>" . $row['dateAddedHisSTA'] . "</td>";
                                echo "<td>" . $row['dateDeletedHisSTA'] . "</td>";
                                echo "<td>" . $row['remarksSTA'] . "</td>";
                                echo "<td>" . $row['deletedBySTA'] . "</td>";
                           
                            }
                        } else {
                            echo "<tr><td colspan='5'>No data found</td></tr>";
                        }

                        // Close the database connection
                        $conn->close();
                        ?>
                       
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-left mb-3 mr-5 ml-3"> <!-- Added ml-3 for additional left margin -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#printModal">Print</button>
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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="includes/logout.php" method="post">
                    <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Custom styles for this template -->
     <link href="css/sb-admin-2.min.css" rel="stylesheet">

<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

 <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</script>
<script>
$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
});
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