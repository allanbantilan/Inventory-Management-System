<style>
    /* Hide the Id column */
    #dataTableHis th:first-child,
    #dataTableHis td:first-child {
        display: none;
    }
</style>



<?php require 'nav_bar.php' ?>
<?php require 'db_connect.php' ?>


<?php require 'profileLogout.php' ?>

<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-2 font-weight-bold text-primary">List of Users</h6>
                </div>
                <!-- <div class="col">
                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addItemModal">Add Items</button>
                    </div> -->
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3 px-0">

            </div>



            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableHis" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="display: none;">Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>User Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require 'db_connect.php';

                        // Fetch data from the users table
                        $sql = "SELECT * FROM users";
                        $result = $conn->query($sql);

                        // Check if there are any rows returned
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='display: none;'>" . $row['userId'] . "</td>";
                                echo "<td>" . $row['firstName'] . "</td>";
                                echo "<td>" . $row['lastName'] . "</td>";

                                echo "<td>" . $row['email'] . "</td>";

                                // Check if the user is online
                                if ($row['online_status'] == 1) {
                                    // Online status
                                    echo "<td><span style='color: green;'><i class='fas fa-circle'></i></span> Online</td>";
                                } else {
                                    // Offline status
                                    echo "<td><span style='color: red;'><i class='fas fa-circle'></i></span> Offline</td>";
                                }
                                echo "<td>" . $row['type'] . "</td>";

                                echo "<td class='text-center'>";
                                echo "<div>";
                                // Edit button with icon
                                echo "<button type='button' class='btn btn-info btn-sm mr-2 edit-btn' data-toggle='modal' data-target='#editModal' data-id='" . $row['userId'] . "' title='Edit'>";
                                echo "<i class='fas fa-edit'></i>";
                                echo "</button>";

                                echo "<button type='button' class='btn btn-danger btn-sm mr-2 delete-btn' data-toggle='modal' data-target='#deleteModal' data-id='" . $row['userId'] . "' title='Delete'>";
                                echo "<i class='fas fa-trash'></i>";
                                echo "</button>";



                                echo "</tr>";

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

    </div>



    <!-- End Example Table -->
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editModalBody">

            </div>
           
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
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
    // Function to fetch user data and populate modal inputs
    // Function to fetch user data and populate modal inputs
    function populateProfileModal() {
        // AJAX request to fetch user data
        $.ajax({
            url: '/inventory/includes/fetchUserData.php',
            method: 'GET',
            success: function (response) {
                // Parse the JSON response
                var userData = JSON.parse(response);
                console.log('User Data:', userData); // Log user data for debugging

                // Populate form fields with user data
                $('#firstNameChange').val(userData.firstName);
                $('#lastNameChange').val(userData.lastName);
                $('#emailChange').val(userData.email);
                // Populate other form fields as needed
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error('Error fetching user data:', error);
            }
        });
    }


    // When the Profile link is clicked, populate the modal with user data
    $('#profileLink').click(function (e) {
        e.preventDefault();
        populateProfileModal();
        $('#passwordChangeModal').modal('show');
    });

    // Function to handle form submission for changing password
    $('#passwordChangeForm').submit(function (e) {
        e.preventDefault();
        // Add code here to handle form submission and password change
        // You can use AJAX to send the form data to a PHP script for processing
    });

</script>
<script>
    $(document).ready(function () {
        // Initialize DataTable
        var dataTable = $('#dataTableHis').DataTable({
            "order": [[0, 'desc']] // Sort the first column (index 0) in descending order
        });

        // Handle change event for the dateCreated input
        $('#dateCreated').on('change', function () {
            var dateCreated = $(this).val();
            if (dateCreated !== '') {
                dataTable.columns(5).search(dateCreated).draw();
            } else {
                dataTable.columns(5).search('').draw();
            }
        });

        // Handle change event for the dateDeleted input
        $('#dateDeleted').on('change', function () {
            var dateDeleted = $(this).val();
            if (dateDeleted !== '') {
                dataTable.columns(6).search(dateDeleted).draw();
            } else {
                dataTable.columns(6).search('').draw();
            }
        });
    });
</script>


<script>
    // JavaScript code to handle edit button click
    $(document).ready(function () {
        $('.edit-btn').click(function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/fetch_user.php',
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    $('#editModalBody').html(response); // Target the edit modal's body
                    $('#editModal').modal('show');
                }
            });
        });
    });

    // JavaScript code to handle delete button click
    $(document).on("click", ".delete-btn", function () {
        var userId = $(this).data('id');
        console.log("Delete button clicked for user ID: " + userId);
        // Here you can write code to delete the user with the provided userId
    });
</script>