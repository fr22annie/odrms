<?php 

   session_start();
   require_once "../backend/UserClass.php";
   if(!isset($_SESSION['a_user_email'])){
     
     header("location:index.php");

  }else{
   
    $conn = new MyClass();
    $getsessionID = trim($_SESSION['a_user_id']);
    $admin = $conn->fetch_adminId($getsessionID);

    $FetchallStudent = $conn->FetchallStudent();
    $FetchallAlumni = $conn->FetchallAlumni();
    $FetchallAllRequest = $conn->FetchallAllRequest();
    $FetchPendingRequestAdmin = $conn->FetchPendingRequestAdmin();
    $FetchCompletedRequestAdmin = $conn->FetchCompletedRequestAdmin();
    $ReleaseDocumentAdmin = $conn->ReleaseDocumentAdmin();

    include('includes/header.php');
    include('includes/navbar.php');

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<h1 class="h3 mb-0 text-gray-800">NEUST SAN ANTONIO OFF-CAMPUS</h1>


<!-- Nav Item - Logout -->
<!-- <li class="nav-item ml-auto">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        <span>LOGOUT</span>
    </a>
</li>
 -->

 <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="nav-link" data-toggle="dropdown">
         <span class="text-dark">Hello!, <span class="text-dark text-bold" style="font-weight: bold;"><?php foreach ($admin as $row){echo ''. ucfirst($row['username']);}; ?></span></span>
        </div>
      </li>

      <li class="nav-item ml-auto">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        <span>LOGOUT</span>
    </a>
</li>

    </ul>

</nav>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

<!-- No. of Students -->
<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    No. of Students</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                
                 <?php
                  foreach ($FetchallStudent as $row) { ?>
                    <?php echo htmlentities($row['studentcount']); ?>
                 <?php } ?>


                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>
</div>

<!-- No. of Alumni -->
<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    No. of Alumni</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    
                 <?php
                  foreach ($FetchallAlumni as $row) { ?>
                    <?php echo htmlentities($row['alumnicount']); ?>
                 <?php } ?>


                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Total Request -->
<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-info shadow h-100 py-2">
<div class="card-body">
    <div class="row no-gutters align-items-center">
<div class="col mr-2">
    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Request
    </div>
    <div class="row no-gutters align-items-center">
        <div class="col-auto">
            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                
              <?php
                  foreach ($FetchallAllRequest as $row) { ?>
                    <?php echo htmlentities($row['countallrequest']); ?>
                 <?php } ?>


            </div>
        </div>

    </div>
</div>
        <div class="col-auto">
            <i class="fas fa-envelope fa-2x text-gray-300"></i>
        </div>
    </div>
</div>
</div>
</div>

<!-- Pending Requests-->
<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    Pending Requests</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    
                 <?php
                  foreach ($FetchPendingRequestAdmin as $row) { ?>
                    <?php echo htmlentities($row['pendingcount']); ?>
                 <?php } ?>


                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Completed Requests -->
<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                    Completed Requests</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
      
                 <?php
                  foreach ($FetchCompletedRequestAdmin as $row) { ?>
                    <?php echo htmlentities($row['completedcount']); ?>
                 <?php } ?>


                </div>
            </div>
        <div class="col-auto">
            <i class="fas fa-check fa-2x text-gray-300"></i>
        </div>
    </div>
</div>
</div>
</div>

<!-- Claim -->
<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    No. of Claim Documents</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
            
                 <?php
                  foreach ($ReleaseDocumentAdmin as $row) { ?>
                    <?php echo htmlentities($row['releasecount']); ?>
                 <?php } ?>


                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-search fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>
</div>


</div>

<!-- Content Row -->

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

<?php } ?>