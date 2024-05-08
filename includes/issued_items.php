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
                    <h6 class="m-2 font-weight-bold text-primary">Issued Items</h6>
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
                            <label for="site"><strong>Site:</strong></label>
                            <select class="form-control" id="siteDrop">
                                <option value="" selected disabled>Select site</option>
                                <?php
                                $query_site = "SELECT * FROM site";
                                $result_site = mysqli_query($conn, $query_site);
                                // Loop through fetched sites to populate the dropdown
                                while ($site_row = mysqli_fetch_assoc($result_site)) {
                                    echo '<option value="' . $site_row['site_name'] . '">' . $site_row['site_name'] . '</option>';
                                }
                                ?>
                                <option value="all">Show All</option>
                            </select>
                        </div>


                    </div>
                </div>
            </div>


            <hr class="my-6">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableHis" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="display: none;">Id</th>
                            <th>Asset Tag</th>
                            <th>Serial Number</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Item Mode</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Date Issued</th>
                            <th>Site</th>
                            <th>Issued To</th>
                            <th>Action</th>

                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require 'db_connect.php';

                        // Fetch data from the inventory table
                        $sql = "SELECT * FROM issued_items";
                        $result = $conn->query($sql);

                        // Check if there are any rows returned
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['items_id'] . "</td>";
                                echo "<td>" . $row['asset_tag_issue'] . "</td>";
                                echo "<td>" . $row['item_serial_number'] . "</td>";
                                echo "<td>" . $row['item_type'] . "</td>";
                                echo "<td>" . $row['sub_category_issue'] . "</td>";
                                echo "<td>" . $row['item_mode_issue'] . "</td>";
                                echo "<td>" . $row['item_status'] . "</td>";
                                echo "<td>" . $row['item_description'] . "</td>";
                                echo "<td>" . $row['item_dateissued'] . "</td>";
                                echo "<td>" . $row['item_site'] . "</td>";
                                echo "<td>" . $row['item_issued_to'] . "</td>";
                                echo "<td class='text-center'>";
                                echo "<div>";
                                // Send back button with icon
                                echo "<button type='button' class='btn btn-primary btn-sm mr-2 send-btn' data-toggle='modal' data-target='#sendModal' data-id='" . $row['items_id'] . "' title='Send Back'>";
                                echo "<i class='fas fa-paper-plane'></i>";
                                echo "</button>";

                                // Edit button with icon
                                echo "<button type='button' class='btn btn-info btn-sm mr-2 edit-btn' data-id='" . $row['items_id'] . "' title='Edit'>";
                                echo "<i class='fas fa-edit'></i>";
                                echo "</button>";



                                // Edit button with icon
                        

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
<!-- Modal for issue items -->
<div class='modal fade' id='sendModal' tabindex='-1' role='dialog' aria-labelledby='sendModalLabel' aria-hidden='true'
    data-backdrop='static'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='myModalLabel'>Return Item to Inventory</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="sendModalBody">

            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editModalBody">
                <!-- Edit form fields will be populated here -->
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
    $(document).ready(function () {
        $('.send-btn').click(function () {
            console.log("send button clicked");
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/send_back.php',
                type: 'GET',
                data: { items_id: id }, // Change 'id' to 'items_id'
                success: function (response) {
                    $('#sendModalBody').html(response); // Target the edit modal's body
                    $('#sendModal').modal('show');
                }
            });
        });
    });

    $(document).ready(function () {
        $('.edit-btn').click(function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/send_back_edit.php',
                type: 'GET',
                data: {items_id: id  },
                success: function (response) {
                    $('#editModalBody').html(response); // Target the edit modal's body
                    $('#editModal').modal('show');
                }
            });
        });


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
        var table = $('#dataTableHis').DataTable({
            "order": [[0, "asc"]],
            "columnDefs": [
                { "width": "9%", "targets": 10 }, // Adjust width as needed
                { "width": "6%", "targets": 9 }, // Adjust width as needed
                { "width": "8%", "targets": 8 }, // Adjust width as needed
                { "width": "15%", "targets": 7 }, // Adjust width as needed
                { "width": "7%", "targets": 5 }, // Adjust width as needed
                { "width": "8%", "targets": 4 }, // Adjust width as needed
                { "width": "9%", "targets": 3 }, // Adjust width as needed
                { "width": "8%", "targets": 2 }, // Adjust width as needed
                { "width": "6%", "targets": 1 }, // Adjust width as needed
            ]
        });



        // Handle change event on the site dropdown
        $('#siteDrop').on('change', function () {
            var site = $(this).val();
            if (site === 'all') {
                table.column(9).search('').draw(); // Clear the search
            } else {
                table.column(9).search(site).draw();
            }
        });

    });

</script>