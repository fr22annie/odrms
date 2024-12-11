<?php 

 session_start();
   require_once "../backend/UserClass.php";
   if(!isset($_SESSION['s_user_email'])){
     
     header("location:../index.php");

  }else{
   
    $conn = new MyClass();
    $getsessionID = trim($_SESSION['s_user_id']);
    $student = $conn->fetch_studentiId($getsessionID);
    $getID = intval($_GET['requestID']);
    $FetchgetRequestId = $conn->getRequestIdstudent($getID);
    // $FetchPendingRequest = $conn->FetchPendingRequest();
    // $FetchCompletedRequests = $conn->FetchCompletedRequests();
    // $ReleaseDocuments = $conn->ReleaseDocuments();

    include('includes/header.php');
    include('includes/navbar.php');
    $transaction_number = uniqid('TRANS-', true);
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
    </style>
</head>

<body>
    <div class="container">
       <div class="alert alert-info"><h4><i class="fa fa-check"></i>  Thank you, your request is being processed.</h4></div>
     <?php foreach($FetchgetRequestId as $row){ ?>

        <div class="info">
            <label>Name:</label>
            <span><?php echo htmlentities(ucwords($row['name'])); ?></span>
        </div>

        <div class="info">
            <label>Student Number:</label>
            <span><?php echo htmlentities($row['studnum']); ?></span>
        </div>

        <div class="info">
            <label>Course:</label>
            <span><?php echo htmlentities($row['course']); ?></span>
        </div>

       
        <div class="info">
            <div class="inline-info">
                <label>Year:</label>
                <span><?php echo htmlentities($row['semester_year']); ?></span>
            </div>
        <!--     <div class="inline-info">
                <label>Section:</label>
                <span><?php echo htmlentities($row['semester']); ?></span>
            </div> -->
        </div>

        <div class="info">
            <label>Request for:</label>
            <span><?php echo htmlentities($row['docname']); ?></span>
        </div>

        <div class="info">
            <label>Semester:</label>
            <span><?php echo htmlentities($row['semester']); ?></span>

            <label style="margin-left: 25px;">Semester Year:</label>
            <span><?php echo htmlentities($row['semester_year']); ?></span>
        </div>

        <div class="info">
            <label>Other Concern:</label>
            <span><?php echo htmlentities($row['concern']); ?></span>
        </div>

       
        <div class="info">
            <div class="inline-info">
                <label>Transaction No.:</label>
                <span><?php echo htmlentities($row['controlnum']); ?></span>
            </div>
        <!--     <div class="inline-info">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_FILES["payment_photo"]) && $_FILES["payment_photo"]["error"] == 0) {
                        $target_file = basename($_FILES["payment_photo"]["name"]);

                        if (move_uploaded_file($_FILES["payment_photo"]["tmp_name"], $target_file)) {
                            echo "<label>Payment Photo:</label>";
                            echo "<span><a href='$target_file' target='_blank'>View Receipt</a></span>";
                        } else {
                            echo "<label>Payment Photo:</label>";
                            echo "<span>Sorry, there was an error uploading your file.</span>";
                        }
                    } else {
                        echo "<label>Payment Photo:</label>";
                        echo "<span>No file uploaded or error occurred.</span>";
                    }
                }
                ?>
            </div> -->
        </div>

        <p style="text-align: center; font-style: Times New Roman;"><b>You may check the progress of your document in your account</b></p>
        <p style="text-align: center; font-style: Times New Roman;"><b>Date of available pick-up: Mon-Fri 6:00-9:00 PM</b></p>
    </div>

<?php } ?>
</body>

<?php
include('includes/scripts.php');
?>
<?php } ?>