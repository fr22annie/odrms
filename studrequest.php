<?php 

   session_start();
   require_once "../backend/UserClass.php";
   if(!isset($_SESSION['a_user_email'])){
     
     header("location:index.php");

  }else{
   
    $conn = new MyClass();
    $getsessionID = trim($_SESSION['a_user_id']);
    $admin = $conn->fetch_adminId($getsessionID);
    $allstudentrequest = $conn->allstudentrequest();


    include('includes/header.php');
    include('includes/navbar.php');

?>

<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<h1 class="h3 mb-0 text-gray-800">NEUST SAN ANTONIO OFF-CAMPUS</h1>

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

<div class="container-fluid">
<br>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Student's Request List</h6>
    </div>
    <div class="card-body">



<div class="table-responsive">
         

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Payment Photo</th>
            <th>Control No.</th>
            <th>Student No.</th>
            <th>Name</th>
            <th>Yr/Sec</th>
            <th>Course</th>
            <th>Document Name</th>
            <th>Semester</th>
            <th>Semester Year</th>
            <th>Other Concern</th>
            <th>Reason</th>
            <th>Date Request</th>
            <th>Date Release</th>
            <th>Processing Officer</th>
            <th>Status</th>
            <th>Processing</th>
            <th>Ready for Claim</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody>

     <?php foreach($allstudentrequest as $row) { ?>
      <tr>
          <td><a href="<?= htmlentities($row['receipt_photo']); ?>" title="Please click the image if you want to download or view" download><img src="<?= htmlentities($row['receipt_photo']); ?>" width="60" height="60"></a></td>
          <td><?= htmlentities($row['controlnum']); ?></td>
          <td><?= htmlentities($row['studnum']); ?></td>
          <td><?php echo ucwords(htmlentities($row['name'])); ?></td>
          <td><?php  echo htmlentities($row['year']) . ' - ' . htmlentities($row['section']); ?></td>
          <td><?php  echo htmlentities($row['course']); ?></td>
          <td><?= htmlentities($row['docname']); ?></td>
          <td><?= htmlentities($row['semester']); ?></td>
          <td><?= htmlentities($row['semester_year']); ?></td>
          <td><?= htmlentities($row['concern']); ?></td>
          <td><?= htmlentities($row['reason']); ?></td>
          <td><?php 
             echo htmlentities($row['datereq']);
           ?></td>
           <td>
           <?php 
             echo htmlentities($row['daterelease']);
           ?>
          </td>
          <td><?= htmlentities($row['officer']); ?></td>
          <td>
           <?php 
             if(htmlentities($row['status']) ==="Pending"){
                echo '<span class="badge bg-warning text-white">Pending</span>';
               } else if(htmlentities($row['status']) ==="Received"){
                echo '<span class="badge bg-info text-white">Received</span>';
               }else if(htmlentities($row['status']) ==="Paid"){
                 echo '<span class="badge bg-success text-white">Paid</span>';
              }
           ?> 
          </td>

          <td>
           <?php 
             if(htmlentities($row['processing_status']) ==="Yes"){
                echo '<span class="badge bg-success text-white">Yes</span>';
               } else if(htmlentities($row['processing_status']) ==="No"){
                echo '<span class="badge bg-danger text-white">No</span>';
               }else{
                 echo '<span class="badge bg-info text-white">Pending</span>';
               }
           ?> 
          </td>

          <td>
           <?php 
              if(htmlentities($row['claim_status']) ==="Yes"){
                echo '<span class="badge bg-success text-white">Yes</span>';
               } else if(htmlentities($row['claim_status']) ==="No"){
                echo '<span class="badge bg-danger text-white">No</span>';
               }else{
                echo '<span class="badge bg-info text-white">Pending</span>';
               }
           ?> 
          </td>
          <td class="align-right">
              <a href="javaScript:void(0)" class="text-secondary font-weight-bold text-xs edit-request" data-edit="<?= htmlentities($row['request_id']); ?>">
                <i class="fa fa-edit"></i>
              </a>

               |
              <a href="javascript:;" data-id="#" class="text-secondary font-weight-bold text-xs btn-delete" data-del="<?= htmlentities($row['request_id']); ?>">
                <i class="fa fa-trash-alt"></i>
              </a>
            </td>
                       
      </tr>
   <?php } ?>
          </tbody>
                </table>
                
            </div>
        </div>


    </div>

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
  
    ?>

  <?php } ?>

</div>


<?php include('modal/edit_verify.php');?>
<?php include('modal/delete_request.php');?>

 <script>
         $(document).ready(function() {   
             load_data();    
             var count = 1; 
             function load_data() {
                 $(document).on('click', '.edit-request', function() {
                      $('#editverify').modal('show');
                      var request_id = $(this).data("edit");
                        getID(request_id); //argument    
               
                 });
              }

               function getID(request_id) {
                    $.ajax({
                        type: 'POST',
                        url: '../backend/studentrequest_row.php',
                        data: {
                            request_id: request_id
                        },
                        dataType: 'json',
                     success: function(response) {

                        $('#edit_id_').val(response.request_id);
                        $('#edit_controlnum').val(response.controlnum);
                        $('#edit_studnum').val(response.studnum);
                        $('#edit_course').val(response.course);
                        $('#edit_year').val(response.year);
                        $('#edit_section').val(response.section);
                        $('#edit_semester').val(response.semester);
                        $('#edit_semester_year').val(response.semester_year);
                        $('#edit_concern').val(response.concern);
                        $('#edit_reason').val(response.reason);
                        $('#edit_receipt_photo').val(response.receipt_photo);
                        $('#edit_datereq').val(response.datereq);
                        $('#edit_daterelease').val(response.daterelease);
                        $('#edit_officer').val(response.officer);
                        $('#edit_status').val(response.status);
                        $('#edit_processing_status').val(response.processing_status);
                        $('#edit_claim_status').val(response.claim_status);
                        $('#edit_student_id').val(response.student_id);
                     

        
                     }
                  });
                }
         
         });
          
   </script>



      <script>
       $(document).ready(function() {   
           load_data();    
           var count = 1; 
           function load_data() {
               $(document).on('click', '.btn-delete', function() {
                  $('#deleteRequest').modal('show');
                    var request_id = $(this).data("del");
                      get_delId(request_id); //argument    
             
               });
            }

             function get_delId(request_id) {
                  $.ajax({
                      type: 'POST',
                       url: '../backend/studentrequest_row.php',
                      data: {
                          request_id: request_id
                      },
                      dataType: 'json',
                      success: function(response2) {
                      $('#delete_id').val(response2.request_id);
                   }
                });
             }
       
       });
        
  </script>

  <script>
    $(document).ready(function() {
        // When the 'View' button is clicked, toggle the hidden columns in the same row
        $(document).on('click', '.view-request', function() {
            var row = $(this).closest('tr'); // Get the row where the button was clicked
            row.find('.hidden').toggle(); // Toggle the visibility of the hidden columns in that row
        });
    });
</script>

</body>
</html>