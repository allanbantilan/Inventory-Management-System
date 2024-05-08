
<?php
// Assuming you have established a database connection already
require "db_connect.php";
// Check if the ID is provided in the URL
if(isset($_GET['id'])) {
    $inv_id = $_GET['id'];

    $query = "SELECT * FROM inventory WHERE inv_id = $inv_id";
$result = $conn->query($query);

// Check if the query execution was successful
if (!$result) {
    die("Error executing the query: " . $conn->error);
}

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Fetch the first row from the result set
    $row = $result->fetch_assoc();
    // Populate your form fields using the data from $row
    $serialNumber = $row['serialNumber'];
    $type = $row['type'];
    $status = $row['status'];
    $description = $row['description'];
} else {
    echo "No data found for the provided ID";
}
}

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data
    $serialNumber = $_POST['serialNumber'];
    $type = $_POST['itemCategory'];
    $status = $_POST['itemStatus'];
    $description = $_POST['itemDescription'];

    // Update the database with the new values
    $updateQuery = "UPDATE inventory SET serialNumber = '$serialNumber', type = '$type', status = '$status', description ='$description' WHERE inv_id = $inv_id";
    $updateResult = $conn->query($updateQuery);

    if($updateResult) {
        // Redirect back to inventory.php with a success message
        echo "<script>alert('Data updated successfully');</script>";
        echo "<script>window.location.href='inventory.php';</script>";
        exit; // Stop further execution
    } else {
        echo "Error updating data: " . $conn->error;
    }
    }

?>


<?php require 'nav_bar.php' ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card shadow border-0" style="width: 600px">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
        </div>
        <div class="card-body p-5">
            <form method="post" action="">
                <div class="form-group">
                    <label for="itemName">Serial Number</label>
                    <input type="text" class="form-control" id="itemName" name="serialNumber" placeholder="Enter serial Number" value="<?php echo $serialNumber; ?>">
                </div>
                            <div class="form-group">
                <label for="itemCategory">Item Category</label>
                <select class="form-control" id="itemCategory" name="itemCategory">
                    <?php
                    $categories = array("Mouse", "Keyboard", "Headset", "Monitor", "NUC", "USB Hub", "Power Plug", "Chair", "Type C to HDMI Cable", "VGA to HDMI Cable");

                    // Loop through the categories array
                    foreach ($categories as $category) {
                        // Check if the current category matches the value fetched from the database
                        $selected = ($type == $category) ? "selected" : "";
                        // Output the option with the current category
                        echo "<option value=\"$category\" $selected>$category</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="itemCondition">Item Status</label>
                <select class="form-control" id="itemStatus" name="itemStatus">
                    <?php
                    $statuses = array("New", "Good", "Damaged", "Unclassified");

                    // Loop through the statuses array
                    foreach ($statuses as $stat) {
                        // Check if the current status matches the value fetched from the database
                        $selected = ($status == $stat) ? "selected" : "";
                        // Output the option with the current status
                        echo "<option value=\"$stat\" $selected>$stat</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="itemDescription">Description</label>
                <textarea class="form-control" id="itemDescription" name="itemDescription" rows="5" placeholder="Enter description"><?php echo $description; ?></textarea>
            </div>



                <!-- Add other form fields if needed -->
                <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='inventory.php'">Back</button>

            </form>
        </div>
    </div>
</div>


               

</div>








<!-- Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to add items -->
                <form id="addItemForm" Action="includes/addItems.php" method="post">
                    <div class="form-group">
                        <label for="itemName">Serial Number</label>
                        <input type="text" class="form-control" id="itemName" name="serialNumber" placeholder="Enter serial Number">
                    </div>
                    <div class="form-group">
                        <label for="itemCategory">Item Category</label>
                        <select class="form-control" id="itemCategory" name="itemCategory">
                            <option value="" selected disabled>Select an option</option>
                            <option value="Mouse">Mouse</option>
                            <option value="Keyboard">Keyboard</option>
                            <option value="Headset">Headset</option>
                            <option value="Monitor">Monitor</option>
                            <option value="NUC">NUC</option>
                            <option value="USB Hub">USB Hub</option>
                            <option value="Power Plug">Power Plug</option>
                            <option value="Chair">Chair</option>
                            <option value="Type C to HDMI Cable">Type C to HDMI Cable</option>
                            <option value="VGA to HDMI Cable">VGA to HDMI Cable</option>
                        </select>
                    </div>
                     <div class="form-group">
                    <label for="itemCondition">Item Status</label>
                    <select class="form-control" id="itemStatus" name="itemStatus">
                        <option value="" selected disabled>Select an option</option>
                        <option value="New">New</option>
                        <option value="Good">Good</option>
                        <option value="Damaged">Damaged</option>
                        <option value="Unclassified">Unclassified</option>
                    </select>
                </div>

                   <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="validateAndSubmit()">Add Item</button>
            </div>
                </form>
                <div class="alert alert-danger" id="warningMessage" style="display: none;">Please fill in all fields before proceeding.</div>
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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="includes/logout.php" method="post">
                    <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- JavaScript code -->
<script>
$(document).ready(function() {
    $('.edit-btn').click(function() {
        // Get the data attributes from the clicked button
        var serialNumber = $(this).data('serial');
        var type = $(this).data('type');
        var status = $(this).data('status');
        
        // Set the input values in the modal
        $('#editSerialNumber').val(serialNumber);
        $('#editType').val(type);
        $('#editStatus').val(status);
    });
});

</script>

   

