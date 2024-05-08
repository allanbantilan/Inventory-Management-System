<style>
    /* Hide the Id column */
    #dataTableInv th:first-child,
    #dataTableInv td:first-child {
        display: none;
    }
</style>

<?php
error_reporting(1);
ini_set('display_errors', 1); ?>

<?php require 'nav_bar.php' ?>
<?php require 'db_connect.php' ?>
<!-- Page Wrapper -->



<?php require 'profileLogout.php' ?>




<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-2 font-weight-bold text-primary">Inventory </h6>
                </div>
                <div class="col">
                    <button class="btn btn-primary float-right" id="addItemButton" data-toggle="modal"
                        data-target="#addItemModal">

                        <i class="fas fa-plus"></i> Add Items
                    </button>

                  
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-3 px-0">
                <div class="col">
                    <div class="row">
                        <div class="col-3">
                            <label for="category"><strong>Category:</strong></label>
                            <select class="form-control" id="category">
                                <option value="" selected disabled>Select category</option>
                                <?php
                                $query_categories = "SELECT * FROM categories";
                                $result_categories = mysqli_query($conn, $query_categories);
                                // Loop through fetched categories to populate the dropdown
                                while ($category_row = mysqli_fetch_assoc($result_categories)) {
                                    echo '<option value="' . $category_row['category'] . '">' . $category_row['category'] . '</option>';
                                }
                                ?>
                                <option value="all">Show All</option>
                            </select>
                        </div>

                        <div class="col-3">
                            <label for="status"><strong>Sub Category:</strong></label>
                            <select class="form-control" id="sub_category">
                                <option value="" selected disabled>Select Sub Category</option>
                                <?php
                                $query_sub_category = "SELECT * FROM sub_category";
                                $result_sub_category = mysqli_query($conn, $query_sub_category);
                                // Loop through fetched sites to populate the dropdown
                                while ($sub_category_row = mysqli_fetch_assoc($result_sub_category)) {
                                    echo '<option value="' . $sub_category_row['sub_category_name'] . '">' . $sub_category_row['sub_category_name'] . '</option>';
                                }
                                ?>
                                <option value="all">Show All</option>
                            </select>
                        </div>

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

                        <div class="col-3">
                            <label for="status"><strong>Status:</strong></label>
                            <select class="form-control" id="status">
                                <option value="" selected disabled>Select status</option>
                                <?php
                                $query_status = "SELECT * FROM status";
                                $result_status = mysqli_query($conn, $query_status);
                                // Loop through fetched sites to populate the dropdown
                                while ($status_row = mysqli_fetch_assoc($result_status)) {
                                    echo '<option value="' . $status_row['status'] . '">' . $status_row['status'] . '</option>';
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
                <table class="table table-bordered" id="dataTableInv" width="100%" cellspacing="0">
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
                            <th>Date Added</th>
                            <th>Site</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require 'db_connect.php';

                        // Fetch data from the inventory table
                        $sql = "SELECT * FROM inventory ORDER BY inv_id asc";
                        $result = $conn->query($sql);

                        // Check if there are any rows returned
                        if ($result->num_rows > 0) {
                            // Get the current date and time
                            $currentDate = new DateTime();

                            // Iterate through each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['inv_id'] . "</td>";
                                echo "<td>" . $row['asset_tag'] . "</td>";
                                echo "<td>" . $row['serialNumber'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>" . $row['sub_category'] . "</td>";
                                echo "<td>" . $row['inv_mode'] . "</td>";
                                // $dateAdded = new DateTime($row['dateAdded']);
                        

                                // $interval = $dateAdded->diff($currentDate);
                                // $daysDifference = $interval->days;
                        
                                // if ($row['status'] == "New" && $daysDifference > 5) {
                        
                                //     $updateStatusSql = "UPDATE inventory SET status = 'Good' WHERE inv_id = " . $row['inv_id'];
                                //     if ($conn->query($updateStatusSql) === TRUE) {
                        
                                //         $row['status'] = "Good"; 
                                //     } else {
                        
                                //         echo "<td>Error updating status: " . $conn->error . "</td>";
                                //     }
                                // }
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . $row['dateAdded'] . "</td>";
                                echo "<td>" . $row['site'] . "</td>";
                                echo "<td class='text-center'>";
                                echo "<div>";
                                // Edit button with icon
                                echo "<button type='button' class='btn btn-info btn-sm mr-2 edit-btn' data-id='" . $row['inv_id'] . "' title='Edit'>";
                                echo "<i class='fas fa-edit'></i>";
                                echo "</button>";

                                // Delete button with icon
                                echo "<button type='button' class='btn btn-danger btn-sm mr-2 delete-btn' data-toggle='modal' data-target='#deleteModal' data-id='" . $row['inv_id'] . "' title='Delete'>";
                                echo "<i class='fas fa-trash'></i>";
                                echo "</button>";
                                // Send button with icon
                                // Conditionally display the send button
                        
                                echo "<button type='button' class='btn btn-primary btn-sm send-btn' data-id='" . $row['inv_id'] . "' data-toggle='modal' data-target='#myModal' title='Issue'>";
                                echo "<i class='fas fa-paper-plane'></i>";
                                echo "</button>";

                                echo "</div>";
                                echo "</td>";
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
        <div class="text-left mb-3 mr-5 ml-3"> <!-- Added ml-3 for additional left margin -->

        </div>
    </div>


    <!-- Modal for issue items -->
    <div class='modal fade' id='sendModal' tabindex='-1' role='dialog' aria-labelledby='sendModalLabel'
        aria-hidden='true' data-backdrop='static'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='myModalLabel'>Issue Item</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="sendModalBody">

                </div>


            </div>
        </div>
    </div>



    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
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


    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Delete Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deleteModalBody">
                    <!-- Edit form fields will be populated here -->
                </div>
            </div>
        </div>
    </div>




    <!-- Add Modal -->
    <?php
    require 'db_connect.php';

    // Fetch item categories from the database
    $query_categories = "SELECT * FROM categories";
    $result_categories = mysqli_query($conn, $query_categories);

    // Fetch item statuses from the database
    $query_statuses = "SELECT * FROM status";
    $result_statuses = mysqli_query($conn, $query_statuses);

    $query_site = "SELECT * FROM site";
    $result_site = mysqli_query($conn, $query_site);

    $query_sub_category = "SELECT * FROM sub_category";
    $result_sub = mysqli_query($conn, $query_sub_category);

    $query_mode = "SELECT * FROM modes_bp";
    $result_mode = mysqli_query($conn, $query_mode);

    // Fetch the selected category from the form
    $selectedCategory = $_POST['itemCategory']; // Adjust this according to your form
    

    ?>


    <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel"
        aria-hidden="true" data-backdrop="static" onsubmit="return validateAndSubmit()">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="addItemModalBody">
                    <!-- Form to add items -->
                    <form id="addItemForm" Action="includes/addItems.php" method="post">
                        <div class="form-group">
                            <label for="itemName">Asset Tag</label>
                            <input type="text" class="form-control" id="assetTag" name="assetTag"
                                placeholder="Enter Asset Tag">
                        </div>
                        <div class="form-group">
                            <label for="itemName">Serial Number</label>
                            <input type="text" class="form-control" id="itemName" name="serialNumber"
                                placeholder="Enter serial Number">
                        </div>
                        <div class="form-group">
                            <label for="itemCategory">Item Category</label>
                            <select class="form-control" id="itemCategory" name="itemCategory">
                                <option value="" selected disabled>Select an option</option>
                                <?php
                                // Populate item categories dropdown
                                while ($row = mysqli_fetch_assoc($result_categories)) {
                                    echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="itemSubCategory">Item Sub Category</label>
                            <select class="form-control" id="itemSubCategory" name="itemSubCategory">
                                <option value="" selected disabled>Select N/A if not applicable</option>

                            </select>
                        </div>



                        <div class="form-group">
                            <label for="itemitemMode">Item Mode</label>
                            <select class="form-control" id="itemMode" name="itemMode">
                                <option value="" selected disabled>Select N/A if not applicable</option>
                                <?php
                                // Populate item sub-categories dropdown
                                while ($row = mysqli_fetch_assoc($result_mode)) {
                                    echo "<option value='" . $row['modes_borrow_purchase'] . "'>" . $row['modes_borrow_purchase'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>




                        <div class="form-group">
                            <label for="itemStatus">Item Status</label>
                            <select class="form-control" id="itemStatus" name="itemStatus">
                                <option value="" selected disabled>Select an option</option>
                                <?php
                                // Populate item statuses dropdown
                                while ($row = mysqli_fetch_assoc($result_statuses)) {
                                    echo "<option value='" . $row['status'] . "'>" . $row['status'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>




                        <div class="form-group">
                            <label for="site">Site</label>
                            <select class="form-control" id="site" name="site">
                                <option value="" selected disabled>Select an option</option>
                                <?php
                                // Populate item statuses dropdown
                                while ($row = mysqli_fetch_assoc($result_site)) {
                                    echo "<option value='" . $row['site_name'] . "'>" . $row['site_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="itemDescription">Description</label>
                            <textarea class="form-control" id="itemDescription" name="itemDescription" rows="5"
                                placeholder="Enter description"></textarea>
                        </div>

                        <div class="alert alert-danger" id="errorAlert" style="display: none;">
                            Please fill out all fields.
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Item</button>
                        </div>

                    </form>


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
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</script>




<script>
    $(document).ready(function () {
        $('.delete-btn').click(function () {
            console.log("Delete button clicked");
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/fetch_record_delete.php',
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    $('#deleteModalBody').html(response); // Target the edit modal's body
                    $('#deleteModal').modal('show');
                }
            });
        });
    });

</script>





<script>
    $(document).ready(function () {
        $('.edit-btn').click(function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/fetch_record.php',
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    $('#editModalBody').html(response); // Target the edit modal's body
                    $('#editModal').modal('show');
                }
            });
        });



        // Reset form fields when the add modal is shown
        // $('#addItemModal').on('show.bs.modal', function (event) {
        //     $(this).find('form')[0].reset();
        //     $('#warningMessage').hide();
        // });

        // function validateAndSubmit() {
        //     if ($('#itemName').val() && $('#itemCategory').val() && $('#itemStatus').val() && $('#itemDescription').val() && $('#site').val()) {
        //         $('#addItemForm').submit();
        //     } else {
        //         $('#warningMessage').show();
        //     }
        // }
    });



</script>


<script>
    $(document).ready(function () {
        $('.send-btn').click(function () {
            console.log("send button clicked");
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/issue_items.php',
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    $('#sendModalBody').html(response); // Target the edit modal's body
                    $('#sendModal').modal('show');
                }
            });
        })
    });
</script>
<script>
    $(document).ready(function () {
        // Print Button Click Event
        $('#printBtn').click(function () {
            var itemStatus = $('#itemStatus').val();
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            // AJAX request to PHP script
            $.ajax({
                url: '/inventory/includes/generate_excel.php',
                type: 'POST',
                data: {
                    itemStatus: itemStatus,
                    startDate: startDate,
                    endDate: endDate
                },
                success: function (response) {
                    // Redirect to the generated Excel file
                    window.location.href = response;
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
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
        $('#dataTableInv').DataTable({
            "order": [[0, "desc"]], // Sort by the first column (index 0) in descending order
            "columnDefs": [
                { "width": "10%", "targets": 10 }, // Adjust width as needed
                { "width": "6%", "targets": 9 }, // Adjust width as needed
                { "width": "8%", "targets": 8 }, // Adjust width as needed
                { "width": "5%", "targets": 6 }, // Adjust width as needed
                { "width": "15%", "targets": 7 }, // Adjust width as needed
                { "width": "7%", "targets": 5 }, // Adjust width as needed
                { "width": "8%", "targets": 4 }, // Adjust width as needed
                { "width": "5%", "targets": 3 }, // Adjust width as needed
                { "width": "5%", "targets": 2 }, // Adjust width as needed
                { "width": "6%", "targets": 1 }, // Adjust width as needed
            ]
        });
    });
</script>


<script>
    $(document).ready(function () {
        var table = $('#dataTableInv').DataTable();

        // Handle change event on the category dropdown
        $('#category').on('change', function () {
            var category = $(this).val();
            if (category === 'all') {
                table.column(3).search('').draw(); // Clear the search
            } else {
                table.column(3).search(category).draw();
            }
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
        $('#status').on('change', function () {
            var status = $(this).val();
            if (status === 'all') {
                table.column(6).search('').draw(); // Clear the search
            } else {
                table.column(6).search(status).draw();
            }
        });
        $('#sub_category').on('change', function () {
            var sub_category = $(this).val();
            if (sub_category === 'all') {
                table.column(4).search('').draw(); // Clear the search
            } else {
                table.column(4).search(sub_category).draw();
            }
        });
    });
</script>

<script>
    document.getElementById('addItemForm').addEventListener('submit', function (event) {
        // Get values of input fields, select, and textarea
        var serialNumber = document.getElementById('itemName').value.trim();
        var itemCategory = document.getElementById('itemCategory').value.trim();
        var itemStatus = document.getElementById('itemStatus').value.trim();
        var site = document.getElementById('site').value.trim();
        var itemDescription = document.getElementById('itemDescription').value.trim();
        var ItemMode = document.getElementById('itemMode').value.trim();
        var subCategory = document.getElementById('itemSubCategory').value.trim();

        // Check if any field is empty
        if (serialNumber === '' || itemCategory === '' || itemStatus === '' || site === '' || itemDescription === '' || ItemMode === '' || subCategory === '') {
            event.preventDefault(); // Prevent form submission
            document.getElementById('errorAlert').style.display = 'block';
        } else {
            document.getElementById('errorAlert').style.display = 'none';
        }
    });
</script>


<script>
    document.addEventListener('keydown', function (event) {
        // Check if Ctrl key and 1 key are pressed
        if (event.ctrlKey && event.key === '1') {
            // Trigger click event on the button
            document.getElementById('addItemButton').click();
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#itemCategory').change(function () {
            var selectedCategory = $(this).val();
            $.ajax({
                url: '/inventory/includes/fetch_sub_categories.php', // Adjust the URL to your PHP script
                type: 'POST',
                data: { category: selectedCategory },
                success: function (response) {
                    $('#itemSubCategory').html(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

