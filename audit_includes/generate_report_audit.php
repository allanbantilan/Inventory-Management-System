<style>
    /* Hide the first column containing the ID for both tables */
    #categoryTable th:first-child,
    #categoryTable td:first-child,
    #statusTable th:first-child,
    #statusTable td:first-child {
        display: none;
    }
</style>



<?php require 'db_connect.php'; ?>

<?php require 'audit_nav_bar.php' ?>

<?php require 'profilelogout_audit.php' ?>

      
<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-6">
            <!-- First Card TOP RIGHT -->
            <div class="card shadow square-card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Generate Report Inventory</h6>
                </div>
                <div class="card-body">
                    <form id="reportForm" action="includes/generate_report_PI.php" method="post">

                        <div class="form-group row">
                            <label for="dateStartPI" class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="dateStartPI" id="dateStartPI" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dateEndPI" class="col-sm-3 col-form-label">End Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="dateEndPI" id="dateEndPI" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="statusPI" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select name="statusPI" id="statusPI" class="form-control">
                                    <option value="" selected disabled>Select status</option>
                                    <?php
                                    $query_site = "SELECT * FROM status";
                                    $result_site = mysqli_query($conn, $query_site);
                                    // Loop through fetched sites to populate the dropdown
                                    while ($site_row = mysqli_fetch_assoc($result_site)) {
                                        echo '<option value="' . $site_row['status'] . '">' . $site_row['status'] . '</option>';
                                    }
                                    ?>
                                    <option value="all">Show All</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="siteDrop" class="col-sm-3 col-form-label">Site</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="siteDropInv" name="siteDropInv">
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

                        <div class="form-group row">
                            <label for="category" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="categoryInv" name="categoryInv">
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
                        </div>


                        <div id="errorMessage" class="alert alert-danger text-center d-none" role="alert">Please fill in
                            all fields.</div>
                        <div class="form-group row">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <button type="button" class="btn btn-primary" id="previewReportBtn"
                                    onclick="return validateAndSubmit()">Preview Detailed Report</button>
                            </div>
                           
                        </div>
                        <div class="col-sm-12 d-flex justify-content-center">
                                <button type="button" class="btn btn-primary" id="summaryReportBtn"
                                    onclick="return validateAndSubmit()">Preview Summary Report</button>
                            </div>
                    </form>


                </div>
            </div>

        </div>

        <!-- Modal for displaying the preview -->
        <div class="modal fade" id="reportPreviewModal" tabindex="-1" role="dialog"
            aria-labelledby="reportPreviewModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportPreviewModalLabel">Report Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="reportPreviewContent"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="summarryPreviewModal" tabindex="-1" role="dialog"
            aria-labelledby="summarryPreviewModalLabel" aria-hidden="true" data-backdrop="static"   >
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="summarryPreviewModalLabel">Summary Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="summarryPreviewContent"></div>
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
                <form action="includes/logout.php" method="post">
                    <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Include DataTables JavaScript -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Other scripts and styles -->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to handle form submission and preview
        $("#previewReportBtn").click(function () {
            $.ajax({
                url: "/inventory/includes/generate_report_preview.php",
                type: "POST",
                data: $("#reportForm").serialize(),
                success: function (response) {
                    // Display the preview content in the modal
                    $("#reportPreviewContent").html(response);
                    $("#reportPreviewModal").modal("show");
                }
            });
        });
    });
    $(document).ready(function () {
        // Function to handle form submission and preview
        $("#summaryReportBtn").click(function () {
            $.ajax({
                url: "/inventory/includes/generate_summary_report.php",
                type: "POST",
                data: $("#reportForm").serialize(),
                success: function (response) {
                    // Display the preview content in the modal
                    $("#summarryPreviewContent").html(response);
                    $("#summarryPreviewModal").modal("show");
                }
            });
        });
    });
</script>




<script>
    // Fetch status options
    fetch('includes/fetchStatus.php')
        .then(response => response.json())
        .then(data => {
            // Populate status dropdown with fetched options
            var statusDropdown = document.getElementById('statusSTH');
            data.forEach(function (status) {
                var option = document.createElement('option');
                option.value = status;
                option.textContent = status;
                statusDropdown.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching status options:', error);
        });

</script>
<script>
    // Fetch status options
    fetch('includes/fetchStatus.php')
        .then(response => response.json())
        .then(data => {
            // Populate status dropdown with fetched options
            var statusDropdown = document.getElementById('statusSTA');
            data.forEach(function (status) {
                var option = document.createElement('option');
                option.value = status;
                option.textContent = status;
                statusDropdown.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching status options:', error);
        });

</script>
<script>
    // Fetch status options
    fetch('includes/fetchStatus.php')
        .then(response => response.json())
        .then(data => {
            // Populate status dropdown with fetched options
            var statusDropdown = document.getElementById('statusPH');
            data.forEach(function (status) {
                var option = document.createElement('option');
                option.value = status;
                option.textContent = status;
                statusDropdown.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching status options:', error);
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
    document.getElementById('reportForm').addEventListener('submit', function(event) {
        // Get values of input fields, select, and textarea
        var serialNumber = document.getElementById('dateStartPI').value.trim();
        var itemCategory = document.getElementById('dateEndPI').value.trim();
        var itemStatus = document.getElementById('statusPI').value.trim();
        var site = document.getElementById('siteDropInv').value.trim();
        var itemDescription = document.getElementById('categoryInv').value.trim();

        // Check if any field is empty
        if (serialNumber === '' || itemCategory === '' || itemStatus === '' || site === '' || itemDescription === '') {
            event.preventDefault(); // Prevent form submission
            document.getElementById('errorMessage').style.display = 'block';
        } else {
            document.getElementById('errorMessage').style.display = 'none';
        }
    });

    function validateAndSubmit() {
        // Get values of input fields, select, and textarea
        var serialNumber = document.getElementById('dateStartPI').value.trim();
        var itemCategory = document.getElementById('dateEndPI').value.trim();
        var itemStatus = document.getElementById('statusPI').value.trim();
        var site = document.getElementById('siteDropInv').value.trim();
        var itemDescription = document.getElementById('categoryInv').value.trim();

        // Check if any field is empty
        if (serialNumber === '' || itemCategory === '' || itemStatus === '' || site === '' || itemDescription === '') {
            document.getElementById('errorMessage').style.display = 'block';
            return false; // Prevent form submission
        } else {
            document.getElementById('errorMessage').style.display = 'none';
            return true; // Allow form submission
        }
    }
</script>
