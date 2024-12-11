

<?php 

   session_start();
   require_once "../backend/UserClass.php";
   if(!isset($_SESSION['s_user_email'])){
     
     header("location:../index.php");

  }else{
   
    $conn = new MyClass();
    $getsessionID = trim($_SESSION['s_user_id']);
    $student = $conn->fetch_studentiId($getsessionID);
    $FetchPendingRequest = $conn->FetchPendingRequestStudent($getsessionID);
    $AcceptedRequests = $conn->AcceptedRequests($getsessionID);
    $ProcessingRequests = $conn->ProcessingRequests($getsessionID);
    $Readyforclaim = $conn->Readyforclaim($getsessionID);

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
 <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="nav-link" data-toggle="dropdown">
         <span class="text-dark">Welcome!, <span class="text-dark text-bold" style="font-weight: bold;"><?php foreach ($student as $row){echo ''. ucfirst($row['fname']) .' '.ucfirst($row['sname']);}; ?></span></span>
        </div>
      </li>

    </ul>
</nav>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Student Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

<!-- No. of Pending Req (Student) -->
<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Pending Requests</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                
                     <?php
                  foreach ($FetchPendingRequest as $row) { ?>
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

<!-- No. of Completed Req (Student) -->
<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Accepted Requests</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    
                     <?php
                  foreach ($AcceptedRequests as $row) { ?>
                    <?php echo htmlentities($row['acceptedcount']); ?>
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

<!-- No. of Release Docs of Students -->
<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    Processing Requests</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    
                    <?php
                  foreach ($ProcessingRequests as $row) { ?>
                    <?php echo htmlentities($row['processingcount']); ?>
                 <?php } ?>
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-envelope fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>
</div>

<!-- No. of Release Docs of Students -->
<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                   Ready for Claim</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    
                    <?php
                  foreach ($Readyforclaim as $row) { ?>
                    <?php echo htmlentities($row['claimcount']); ?>
                 <?php } ?>
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-envelope fa-2x text-gray-300"></i>
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