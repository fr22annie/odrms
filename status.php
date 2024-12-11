<?php 

 session_start();
   require_once "../backend/UserClass.php";
   if(!isset($_SESSION['s_user_email'])){
     
    header("location:../index.php");

  }else{
   
    $conn = new MyClass();
    $getsessionID = trim($_SESSION['s_user_id']);
    $student = $conn->fetch_alumniId($getsessionID);
    $myrequeststatus = $conn->myrequeststatus($getsessionID);
    // $FetchPendingRequest = $conn->FetchPendingRequest();
    // $FetchCompletedRequests = $conn->FetchCompletedRequests();
    // $ReleaseDocuments = $conn->ReleaseDocuments();

include('includes/header.php');
include('includes/navbar.php');
?>
<head>
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h4 {
            text-align: center;
            margin-bottom: 5px;
        }
        .info {
            margin-bottom: 15px;
        }
        .info label {
            font-weight: bold;
            width: 150px;
            display: inline-block;
        }
        .info span {
            display: inline-block;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
        }
        .inline-info {
            display: inline-block;
            margin-right: 25px;
        }

        .stepper-wrapper {
  margin-top: auto;
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.stepper-item {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;

  @media (max-width: 768px) {
    font-size: 12px;
  }
}

.stepper-item::before {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 20px;
  left: -50%;
  z-index: 2;
}

.stepper-item::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 2;
}

.stepper-item .step-counter {
  position: relative;
  z-index: 5;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #ccc;
  margin-bottom: 6px;
}

.stepper-item.active {
  font-weight: bold;
}

.stepper-item.completed .step-counter {
  background-color: #4bb543;
}

.stepper-item.completed::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #4bb543;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 3;
}

.stepper-item:first-child::before {
  content: none;
}
.stepper-item:last-child::after {
  content: none;
}
    </style>
</head>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <h1 class="h3 mb-0 text-gray-800">CHECK THE UPDATE OF YOUR DOCUMENTS</h1>
        <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="nav-link" data-toggle="dropdown">
   <span class="text-dark">Welcome!, <span class="text-dark text-bold" style="font-weight: bold;"><?php foreach ($student as $row){echo ''. ucfirst($row['fname']) .' '.ucfirst($row['sname']);}; ?></span></span>
        </div>
      </li>

    </ul>
    </nav>
    <!-- End of Topbar -->

  <div class="row g-1">
     <?php foreach($myrequeststatus as $row) { ?>
      <div class="col-md-3" style="margin-top:10%">
          <span class="mx-3" style="font-weight:bold;"><i class="fa fa-file-alt"></i> <?php echo htmlentities($row['docname']);?><br>&nbsp&nbsp&nbsp&nbsp <?php echo htmlentities($row['semester']); ?> <?php echo htmlentities($row['semester_year']); ?><br></span>
      </div>
      <div class="col-md-9">
             <!-- Begin Page Content -->
        <div class="">     
            <div class="stepper-wrapper" style="margin-top:10%">
              <?php if($row['status'] === 'Received'){ ?>
              <div class="stepper-item completed">
                <div class="step-counter">1</div>
                <div class="step-name">accepted</div>
              </div>
            <?php }else{ ?>
              <div class="stepper-item active">
                <div class="step-counter">1</div>
                <div class="step-name">accepted</div>
              </div>

            <?php } ?>

            <?php if($row['processing_status'] === 'Yes'){ ?>
              <div class="stepper-item completed">
                <div class="step-counter">2</div>
                <div class="step-name">processing</div>
              </div>
            <?php }else{ ?>
              <div class="stepper-item active">
                <div class="step-counter">2</div>
                <div class="step-name">processing</div>
              </div>

            <?php } ?>


           <?php if($row['claim_status'] === 'Yes'){ ?>
               <div class="stepper-item completed">
                <div class="step-counter">3</div>
                <div class="step-name">ready for claim</div>
              </div>
            <?php }else{ ?>
              <div class="stepper-item active">
                <div class="step-counter">3</div>
                <div class="step-name">ready for claim</div>
              </div>

            <?php } ?>


            </div>

        </div>
 
      </div>
      <?php } ?>
  </div>


    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php
include('includes/scripts.php');
?>
 <?php } ?>