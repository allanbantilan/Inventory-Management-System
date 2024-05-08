<style>
    /* Hide the first column containing the ID for both tables */
    #categoryTable th:first-child,
    #categoryTable td:first-child,
    #statusTable th:first-child,
    #statusTable td:first-child,
    #siteTable th:first-child,
    #siteTable td:first-child,
    #SubCategoryTable td:first-child,
    #SubCategoryTable td:first-child,
    #modeTable td:first-child,
    #modeTable td:first-child {
        display: none;
    }
</style>



<?php require 'db_connect.php'; ?>

<?php require 'nav_bar.php' ?>

<?php require 'profileLogout.php' ?>
<!-- End of Topbar -->
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="category-tab" data-bs-toggle="tab" href="#category" role="tab"
                aria-controls="category" aria-selected="true">Manage Category</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="status-tab" data-bs-toggle="tab" href="#status" role="tab" aria-controls="status"
                aria-selected="false">Manage Status</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="site-tab" data-bs-toggle="tab" href="#site" role="tab" aria-controls="site"
                aria-selected="false">Manage Sites</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sub-category-tab" data-bs-toggle="tab" href="#sub-category" role="tab"
                aria-controls="sub-category" aria-selected="false">Manage Sub Category</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="mode-tab" data-bs-toggle="tab" href="#mode" role="tab" aria-controls="mode"
                aria-selected="false">Manage Item Mode</a>
        </li>
    </ul>
    <br>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="category-tab">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Manage Category</h6>
                        <button class="btn btn-primary" id="addCategoryBtnModal">
                            <i class="fas fa-plus"></i> Add Category
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="display: none;">Category ID</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require 'db_connect.php';
                                    // Fetch data from the categories table in the database
                                    $categories_query = "SELECT * FROM categories";
                                    $categories_result = mysqli_query($conn, $categories_query);

                                    // Loop through fetched categories and populate the table rows
                                    while ($category_row = mysqli_fetch_assoc($categories_result)) {
                                        echo '<tr>';
                                        echo '<td>' . $category_row['categoryID'] . '</td>';
                                        echo '<td>' . $category_row['category'] . '</td>';

                                        echo '<td class="d-flex justify-content-center">';
                                        echo '<form id="deleteForm' . $category_row['categoryID'] . '" action="includes/delete_category.php" method="post">';
                                        echo '<input type="hidden" name="categoryID" value="' . $category_row['categoryID'] . '">';
                                        echo '<button type="button" class="btn btn-danger delete-btn" data-categoryid="' . $category_row['categoryID'] . '">Delete</button>';
                                        echo '</form>';

                                        echo '&nbsp;';
                                        echo '&nbsp;';
                                        echo '<form action="">';
                                        echo '<button type="button" class="btn btn-info edit-btn-category" data-id="' . $category_row['categoryID'] . '">Edit</button>';
                                        echo '</form>';

                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Manage Status</h6>
                        <button class="btn btn-primary" id="addStatusBtnModal">
                            <i class="fas fa-plus"></i> Add Status
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="statusTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="display: none;">Id</th>
                                        <th>Status Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require 'db_connect.php';
                                    // Fetch data from the status table in the database
                                    $status_query = "SELECT * FROM status";
                                    $status_result = mysqli_query($conn, $status_query);

                                    // Loop through fetched statuses and populate the table rows
                                    while ($status_row = mysqli_fetch_assoc($status_result)) {
                                        echo '<tr>';
                                        echo '<td>' . $status_row['statusID'] . '</td>';
                                        echo '<td>' . $status_row['status'] . '</td>';


                                        echo '<td class="d-flex justify-content-center">';
                                        echo '<form id="deleteFormStatus' . $status_row['statusID'] . '" action="includes/delete_status.php" method="post">';
                                        echo '<input type="hidden" name="statusID" value="' . $status_row['statusID'] . '">';
                                        echo '<button type="button" class="btn btn-danger delete-btn" data-statusid="' . $status_row['statusID'] . '">Delete</button>';
                                        echo '</form>';

                                        echo '&nbsp;';
                                        echo '&nbsp;';

                                        echo '<form action="">';
                                        echo '<button type="button" class="btn btn-info edit-btn-status" data-id="' . $status_row['statusID'] . '">Edit</button>';
                                        echo '</form>';
                                        echo '</td>';
                                        echo '</tr>';

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="site" role="tabpanel" aria-labelledby="site-tab">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Manage Sites</h6>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSiteModal">
                            <i class="fas fa-plus"></i> Add Site
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="siteTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th>Site Name</th>
                                        <th>Action</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require 'db_connect.php';
                                    // Fetch data from the status table in the database
                                    $site_query = "SELECT * FROM site";
                                    $site_result = mysqli_query($conn, $site_query);

                                    // Loop through fetched statuses and populate the table rows
                                    while ($site_row = mysqli_fetch_assoc($site_result)) {

                                        echo '<tr>';
                                        echo '<td>' . $site_row['site_id'] . '</td>';
                                        echo '<td>' . $site_row['site_name'] . '</td>';



                                        echo '<td class="d-flex justify-content-center">';
                                        echo '<form id="deleteFormSite' . $site_row['site_id'] . '" action="includes/delete_site.php" method="post">';
                                        echo '<input type="hidden" name="siteID"  value="' . $site_row['site_id'] . '">';
                                        echo '<button type="button" class="btn btn-danger delete-btn-site" data-siteid="' . $site_row['site_id'] . '">Delete</button>';
                                        echo '</form>';

                                        echo '&nbsp;';
                                        echo '&nbsp;';

                                        echo '<form action="">';
                                        echo '<button type="button" class="btn btn-info edit-btn-site" data-id="' . $site_row['site_id'] . '">Edit</button>';
                                        echo '</form>';

                                        echo '</td>';
                                        echo '</tr>';

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="sub-category" role="tabpanel" aria-labelledby="sub-category-tab">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Manage Sub Category</h6>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#addSubCategoryModal">
                            <i class="fas fa-plus"></i> Add Sub Category
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="SubCategoryTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th>Sub Category Name</th>
                                        <th>Sub Category For</th>
                                        <th>Action</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require 'db_connect.php';
                                    // Fetch data from the status table in the database
                                    $sub_category_query = "SELECT * FROM sub_category";
                                    $sub_category_result = mysqli_query($conn, $sub_category_query);

                                    // Loop through fetched statuses and populate the table rows
                                    while ($sub_category_query = mysqli_fetch_assoc($sub_category_result)) {

                                        echo '<tr>';
                                        echo '<td>' . $sub_category_query['sub_id'] . '</td>';
                                        echo '<td>' . $sub_category_query['sub_category_name'] . '</td>';
                                        echo '<td>' . $sub_category_query['sub_category_for'] . '</td>';
                                        echo '<td class="d-flex justify-content-center">';
                                        echo '<form id="deleteFormSub' . $sub_category_query['sub_id'] . '" action="includes/delete_sub_category.php" method="post">';
                                        echo '<input type="hidden" name="sub_id"  value="' . $sub_category_query['sub_id'] . '">';
                                        echo '<button type="button" class="btn btn-danger delete-btn-sub-category" data-subid="' . $sub_category_query['sub_id'] . '">Delete</button>';
                                        echo '</form>';

                                        echo '&nbsp;';
                                        echo '&nbsp;';
                                        echo '<form action="">';
                                        echo '<button type="button" class="btn btn-info edit-btn-sub-category" data-id="' . $sub_category_query['sub_id'] . '">Edit</button>';
                                        echo '</form>';
                                        echo '</td>';
                                        echo '</tr>';

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="mode" role="tabpanel" aria-labelledby="mode-tab">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Manage Item Mode</h6>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modeTableModal">
                            <i class="fas fa-plus"></i> Add Mode
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="modeTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th>Mode Name</th>
                                        <th>Action</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require 'db_connect.php';
                                    // Fetch data from the status table in the database
                                    $modes_query = "SELECT * FROM modes_bp";
                                    $modes_result = mysqli_query($conn, $modes_query);

                                    // Loop through fetched statuses and populate the table rows
                                    while ($modes_query = mysqli_fetch_assoc($modes_result)) {

                                        echo '<tr>';
                                        echo '<td>' . $modes_query['mode_id'] . '</td>';
                                        echo '<td>' . $modes_query['modes_borrow_purchase'] . '</td>';
                                        echo '<td class="d-flex justify-content-center">';
                                        echo '<form id="deleteFormMode' . $modes_query['mode_id'] . '" action="includes/delete_mode.php" method="post">';
                                        echo '<input type="hidden" name="mode_id"  value="' . $modes_query['mode_id'] . '">';
                                        echo '<button type="button" class="btn btn-danger delete-btn-mode" data-modeid="' . $modes_query['mode_id'] . '">Delete</button>';
                                        echo '</form>';

                                        echo '&nbsp;';
                                        echo '&nbsp;';
                                        echo '<form action="">';
                                        echo '<button type="button" class="btn btn-info edit-btn-mode" data-id="' . $modes_query['mode_id'] . '">Edit</button>';
                                        echo '</form>';

                                        echo '</td>';
                                        echo '</tr>';

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Delete confirmation message goes here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle delete button click to populate delete modal
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var categoryID = button.data('categoryid');
            // Display confirmation message
            $('.modal-body').html('Are you sure you want to delete category with ID ' + categoryID + '?');

        });
    </script>







    <!-- adding category modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true" data-backdrop="static" onsubmit="return validateForm()">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding category -->
                    <form id="addCategoryForm" action="includes/add_category.php" method="POST">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName">
                            <div id="categoryNameError" class="text-danger"></div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addCategoryBtn">Add
                        Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- adding status modal -->


    <div class="modal fade" id="addStatusModal" tabindex="-1" role="dialog" aria-labelledby="addStatusModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStatusModalLabel">Add Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="addStatusForm" action="includes/add_status.php" method="POST">
                        <div class="form-group">
                            <label for="statusName">Status Name</label>
                            <input type="text" class="form-control" id="statusName" name="statusName">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="addStatusBtn">Add
                                Status</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <?php
    require 'db_connect.php';

    // Fetch item categories from the database
    $query_categories = "SELECT * FROM categories";
    $result_categories = mysqli_query($conn, $query_categories);


    ?>

    <!-- adding sub category modal -->
    <div class="modal fade" id="addSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addSubCategoryLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubCategoryLabel">Add Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addSubCategoryForm" action="includes/add_sub_category.php" method="POST">
                        <div class="form-group">
                            <label for="subCategoryName">Sub Category Name</label>
                            <input type="text" class="form-control" id="subCategoryName" name="subCategoryName">
                            <!-- Adjust width as needed -->
                        </div>
                        <div class="form-group">
                            <label for="itemCategory">Sub Category For</label>
                            <select class="form-control" id="subCategoryFor" name="subCategoryFor">
                                <option value="" selected disabled>Select an option</option>
                                <?php
                                // Populate item categories dropdown
                                while ($row = mysqli_fetch_assoc($result_categories)) {
                                    echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="addSubCategoryBtn">Add Sub
                                Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- adding mode modal-->
    <div class="modal fade" id="modeTableModal" tabindex="-1" role="dialog" aria-labelledby="modeTableModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modeTableModalLabel">Add Mode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modeTableModalForm" action="includes/add_mode.php" method="POST">
                        <div class="form-group">
                            <label for="modeTableModalName">Sub Category Name</label>
                            <input type="text" class="form-control" id="modeName" name="modeName">
                            <!-- Adjust width as needed -->
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="modeTableModalBtn">Add Sub
                                Category</button>
                        </div>
                    </form>
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


<!-- Modal -->
<div class="modal fade" id="addSiteModal" tabindex="-1" role="dialog" aria-labelledby="addSiteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSiteModalLabel">Add Site</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addSiteForm" action="includes/add_site.php" method="POST">
                    <div class="form-group">
                        <label for="siteName">Site Name:</label>
                        <input type="text" class="form-control" id="siteName" name="siteName" required>
                    </div>
                    <!-- Add more input fields as needed -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveSiteBtn">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- edit category modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editCategoryModalBody">
                <!-- Edit form fields will be populated here -->
            </div>
        </div>
    </div>
</div>

<!-- edit status modal -->
<div class="modal fade" id="editStatusModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editStatusModalBody">
                <!-- Edit form fields will be populated here -->
            </div>
        </div>
    </div>
</div>

<!-- edit site modal -->
<div class="modal fade" id="editSiteModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Site</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editSiteModalBody">
                <!-- Edit form fields will be populated here -->
            </div>
        </div>
    </div>
</div>

<!-- edit sub category modal -->
<div class="modal fade" id="editSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit SubCategory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editSubCategoryModalBody">
                <!-- Edit form fields will be populated here -->
            </div>
        </div>
    </div>
</div>

<!-- edit manage item modal -->
<div class="modal fade" id="editManageItemModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Manage Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editManageItemModalBody">
                <!-- Edit form fields will be populated here -->
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


<script>
    $(document).ready(function () {
        $('.edit-btn-category').click(function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/fetch_manage_category.php',
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    $('#editCategoryModalBody').html(response); // Target the edit modal's body
                    $('#editCategoryModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.edit-btn-status').click(function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/fetch_manage_status.php',
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    $('#editStatusModalBody').html(response); // Target the edit modal's body
                    $('#editStatusModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.edit-btn-sub-category').click(function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/fetch_manage_sub_category.php',
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    $('#editSubCategoryModalBody').html(response); // Target the edit modal's body
                    $('#editSubCategoryModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.edit-btn-site').click(function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/fetch_manage_site.php',
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    $('#editSiteModalBody').html(response); // Target the edit modal's body
                    $('#editSiteModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.edit-btn-mode').click(function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/inventory/includes/fetch_manage_item_mode.php',
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    $('#editManageItemModalBody').html(response); // Target the edit modal's body
                    $('#editManageItemModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>




<script>
    $(document).ready(function () {
        $('.delete-btn').click(function () {
            // Check if the button is for deleting a category or a status
            var categoryID = $(this).data('categoryid');
            var statusID = $(this).data('statusid');


            // Confirm deletion based on the type (category or status)
            var confirmMessage = '';
            var formID = '';
            if (categoryID !== undefined) {
                confirmMessage = 'Are you sure you want to delete this category?';
                formID = '#deleteForm' + categoryID;
            } else if (statusID !== undefined) {
                confirmMessage = 'Are you sure you want to delete this status?';
                formID = '#deleteFormStatus' + statusID;
            }
            if (confirm(confirmMessage)) {
                // Submit the corresponding form
                $(formID).submit();
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.delete-btn-site').click(function () {
            var siteID = $(this).data('siteid'); // Get the site ID from the button's data attribute

            // Confirm deletion
            var confirmMessage = 'Are you sure you want to delete this site?';
            if (confirm(confirmMessage)) {
                // Submit the form for deletion
                $('#deleteFormSite' + siteID).submit();
            }
        })
        $('.delete-btn-sub-category').click(function () {
            var subID = $(this).data('subid'); // Get the site ID from the button's data attribute

            // Confirm deletion
            var confirmMessage = 'Are you sure you want to delete this sub category?';
            if (confirm(confirmMessage)) {
                // Submit the form for deletion
                $('#deleteFormSub' + subID).submit();
            }
        })
        $('.delete-btn-mode').click(function () {
            var modeID = $(this).data('modeid'); // Get the mode ID from the button's data attribute

            // Confirm deletion
            var confirmMessage = 'Are you sure you want to delete this mode?';
            if (confirm(confirmMessage)) {
                // Submit the form for deletion
                $('#deleteFormMode' + modeID).submit();
            }
        });


        ;
    });
</script>






<!-- Initialize DataTables -->
<script>
    $(document).ready(function () {
        // Initialize DataTable for categoryTable
        $('#categoryTable').DataTable({
            "paging": true,
            "lengthMenu": [5, 10, 25, 50], // Set the number of records per page options
            "pageLength": 10 // Show 5 records per page initially

        });

        // Initialize DataTable for statusTable
        $('#statusTable').DataTable({
            "paging": true,
            "lengthMenu": [5, 10, 25, 50], // Set the number of records per page options
            "pageLength": 10 // Show 5 records per page initially
        });
        // Initialize DataTable for statusTable
        $('#siteTable').DataTable({
            "paging": true,
            "lengthMenu": [5, 10, 25, 50], // Set the number of records per page options
            "pageLength": 10 // Show 5 records per page initially
        });
        $('#SubCategoryTable').DataTable({
            "paging": true,
            "lengthMenu": [5, 10, 25, 50], // Set the number of records per page options
            "pageLength": 10 // Show 5 records per page initially
        });
        $('#modeTable').DataTable({
            "paging": true,
            "lengthMenu": [5, 10, 25, 50], // Set the number of records per page options
            "pageLength": 10 // Show 5 records per page initially
        });

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
    function validateForm() {
        var categoryName = document.getElementById('categoryName').value.trim(); // Trim any leading/trailing whitespace
        var categoryNameError = document.getElementById('categoryNameError');

        // Check if category name is empty
        if (categoryName === '') {
            categoryNameError.innerHTML = 'Category name cannot be empty.';
            return false; // Prevent form submission
        }

        // Clear any previous error message
        categoryNameError.innerHTML = '';

        // Allow form submission
        return true;
    }
</script>




<script>
    $(document).ready(function () {
        // Handle click event for opening "Add Category" modal
        $("#addCategoryBtnModal").click(function () {
            // Show the modal for adding category
            $('#addCategoryModal').modal('show');
        });

        // Handle click event for opening "Add Status" modal
        $("#addStatusBtnModal").click(function () {
            // Show the modal for adding status
            $('#addStatusModal').modal('show');
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
    // Get all tab links
    var tabLinks = document.querySelectorAll('.nav-tabs .nav-link');

    // Attach click event listeners to tab links
    tabLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default anchor behavior
            var targetTabId = this.getAttribute('href'); // Get target tab id
            var targetTab = document.querySelector(targetTabId); // Get target tab element

            // Hide all tab content
            var tabContents = document.querySelectorAll('.tab-content .tab-pane');
            tabContents.forEach(function (tab) {
                tab.classList.remove('show', 'active');
            });

            // Show the target tab content
            targetTab.classList.add('show', 'active');
        });
    });
</script>