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
                        <h6 class="m-2 font-weight-bold text-primary">Site 2 - Sta. Ana Inventory</h6>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addItemModal">Add Items</button>
                    </div>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require 'db_connect.php';

                        // Fetch data from the inventory table
                        $sql = "SELECT * FROM inventorysta";
                        $result = $conn->query($sql);

                        // Check if there are any rows returned
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['inv_idSTA'] . "</td>";
                                echo "<td>" . $row['serialNumberSTA'] . "</td>";
                                echo "<td>" . $row['typeSTA'] . "</td>";
                                echo "<td>" . $row['statusSTA'] . "</td>";
                                echo "<td>" . $row['descriptionSTA'] . "</td>";
                                echo "<td>" . $row['dateAddedSTA'] . "</td>";
                                echo "<td class='text-center'>";
                                echo "<div>";
                                echo "<button type='button' class='btn btn-info btn-sm mr-2 edit-btn' data-id='" . $row['inv_idSTA'] . "'>Edit</button>";     
                                echo "<button type='button' class='btn btn-danger btn-sm delete-btn' data-toggle='modal' data-target='#deleteModal' data-id='" . $row['inv_idSTA'] . "'>Delete</button>";
                                echo "</div>";
                                echo "</td>";
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






<!-- Modal for print -->
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="printModalLabel">Print Inventory Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        <div class="form-group">
                    <label for="itemCondition">Item Status</label>
                    <select class="form-control" id="itemStatusPrint" name="itemStatusPrint">
                        <option value="" selected disabled>Select an option</option>
                        <option value="New">New</option>
                        <option value="Good">Good</option>
                        <option value="Damaged">Damaged</option>
                        <option value="Unclassified">Unclassified</option>
                    </select>
                    </div>   
          <div class="form-group">
            <label for="startDate">Start Date:</label>
            <input type="date" class="form-control datepicker" id="startDate" name="startDate">
          </div>
          <div class="form-group">
            <label for="endDate">End Date:</label>
            <input type="date" class="form-control datepicker" id="endDate" name="endDate">
          </div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="printBtn">Print</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Edit Modal -->
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


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
?>


<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true" data-backdrop="static" onsubmit="return validateAndSubmit()">
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
                    <form id="addItemForm" Action="includes/addItemsSTA.php" method="post">
                        <div class="form-group">
                            <label for="itemName">Serial Number</label>
                            <input type="text" class="form-control" id="itemNameSTA" name="serialNumberSTA" placeholder="Enter serial Number">
                        </div>
                        <div class="form-group">
                        <label for="itemCategory">Item Category</label>
                        <select class="form-control" id="itemCategorySTA" name="itemCategorySTA">
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
                    <label for="itemStatus">Item Status</label>
                    <select class="form-control" id="itemStatusSTA" name="itemStatusSTA">
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
                        <label for="itemDescription">Description</label>
                        <textarea class="form-control" id="itemDescriptionSTA" name="itemDescriptionSTA" rows="5" placeholder="Enter description"></textarea>
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


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</script>


<script>
$(document).ready(function() {
    $('.delete-btn').click(function() {
        console.log("Delete button clicked");
        var id = $(this).data('id');
        $.ajax({
            url: '/inventory/includes/fetch_record_deleteSTA.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                $('#deleteModalBody').html(response); // Target the edit modal's body
                $('#deleteModal').modal('show');
            }
        });
    });
});

</script>





<script>
$(document).ready(function() {
    $('.edit-btn').click(function() {
        console.log("Edit button clicked");
        var id = $(this).data('id');
        $.ajax({
            url: '/inventory/includes/fetch_record_STA.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                $('#editModalBody').html(response); // Target the edit modal's body
                $('#editModal').modal('show');
            }
        });
    });

    // Reset form fields when the add modal is shown
    $('#addItemModal').on('show.bs.modal', function (event) {
        $(this).find('form')[0].reset();
        $('#warningMessage').hide();
    });

    function validateAndSubmit() {
        if ($('#itemName').val() && $('#itemCategory').val() && $('#itemStatus').val() && $('#itemDescription').val()) {
            $('#addItemForm').submit();
        } else {
            $('#warningMessage').show();
        }
    }
});



</script>
<script>
    $(document).ready(function(){
        // Print Button Click Event
        $('#printBtn').click(function(){
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
                success: function(response){
                    // Redirect to the generated Excel file
                    window.location.href = response;
                }
            });
        });
    });
</script>
<script>
$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
});
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