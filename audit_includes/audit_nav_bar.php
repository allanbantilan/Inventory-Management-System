
<style>
.custom-dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff; /* Set your desired background color */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow for dropdown */
    border-radius: 4px; /* Add some border radius */
    padding: 8px 0; /* Add some padding */
    z-index: 1000;
    transition: opacity 0.3s, transform 0.3s;
}

.custom-dropdown-menu.show {
    display: block;
    opacity: 1;
    transform: translateY(10px);
}

.custom-dropdown-item {
    color: #333; /* Set text color */
    text-decoration: none; /* Remove default link underline */
    display: block;
    padding: 8px 16px; /* Add padding to dropdown items */
    transition: background-color 0.3s;
}

.custom-dropdown-item:hover {
    background-color: #f0f0f0; /* Set hover background color */
}


</style>



<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard1.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Splace<sup>Inventory</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item active">
        <a class="nav-link" href="auditDashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Audit Dashboard</span>
        </a>  
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Sites</div>

    <!-- Site 1 Dropdown -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-list"></i>
            <span>Inventories</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Components</h6>
                <a class="dropdown-item" href="audit_inventory.php">Inventory</a>
             
            </div>
        </div>
    </li>
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="false" aria-controls="collapseThree">
            <i class="fas fa-fw fa-list"></i>
            <span>Issued Items</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Components</h6>
                <a class="dropdown-item" href="audit_issued_item.php">Issued Items List</a>
        
            </div>
        </div>
    </li>

    <!-- Site 2 Dropdown -->
    <!-- <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="false" aria-controls="collapseThree">
            <i class="fas fa-fw fa-sitemap"></i>
            <span>Site 2 - Sta. Ana</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Components</h6>
                <a class="dropdown-item" href="audit_inventorySTA.php">Inventory</a>
                <a class="dropdown-item" href="audit_historySTA.php">History</a>
            </div>
        </div>
    </li> -->
    <hr class="sidebar-divider">
    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->
  <!-- Heading -->
  <div class="sidebar-heading">Functions</div>

    <!-- Generate Report -->
    <li class="nav-item active">
        <a class="nav-link" href="generate_report_audit.php">
            <i class="fas fa-print"></i>
            <span>Generate Report</span>
        </a>
    </li>

    <!-- <hr class="sidebar-divider"> -->
    
    <!-- Activity Log -->
   
   
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>


 <!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Create User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Your form inputs go here -->
        <form id="addUserForm">
          <div class="form-group" action="add_user.php" method="post">
            <label for="username">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required>
          </div>
          <div class="form-group">
            <label for="username">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required>
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="email">User Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="form-group">
            <label for="email">User Type</label>
            <select name="type" id="type" class="form-control">
                <option value="w" disabled selected>Select Here</option>
                <option value="audit">Audit Team</option>
                <option value="user">User</option>
            </select>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="saveUser">Save User</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- End of Sidebar -->

<script>
  // JavaScript to handle form submission
  document.getElementById('saveUser').addEventListener('click', function() {
    // Get form data
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    
    // Here, you can perform validation, AJAX submission, etc.
    // For demonstration, let's just log the values to the console
    console.log('Username:', username);
    console.log('Email:', email);
    
    // Close the modal
    $('#addUserModal').modal('hide');
  });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var siteDropdown = document.getElementById("siteDropdown");
    var siteDropdownMenu = document.getElementById("siteDropdownMenu");

    siteDropdown.addEventListener("click", function() {
        if (siteDropdownMenu.style.display === "block") {
            siteDropdownMenu.style.display = "none";
        } else {
            siteDropdownMenu.style.display = "block";
        }
    });
});


</script>