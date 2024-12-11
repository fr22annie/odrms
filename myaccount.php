<?php 
 session_start();
   require_once "../backend/UserClass.php";
   if(!isset($_SESSION['s_user_email'])){
     
     header("location:../index.php");

  }else{
   
    $conn = new MyClass();
    $getsessionID = trim($_SESSION['s_user_id']);
    $student = $conn->fetch_studentiId($getsessionID);
    // $FetchPendingRequest = $conn->FetchPendingRequest();
    // $FetchCompletedRequests = $conn->FetchCompletedRequests();
    // $ReleaseDocuments = $conn->ReleaseDocuments();
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content" style="height: 100vh; overflow: hidden;">
       
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <h1 class="h3 mb-0 text-gray-800">STUDENT PROFILE</h1>
              <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="nav-link" data-toggle="dropdown">
   <span class="text-dark">Welcome!, <span class="text-dark text-bold" style="font-weight: bold;"><?php foreach ($student as $row){echo ''. ucfirst($row['fname']) .' '.ucfirst($row['sname']);}; ?></span></span>
        </div>
      </li>

    </ul>
    </nav>

    <div class="container-fluid" style="height: calc(100vh - 60px); overflow: auto;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow mb-4" style="border-radius: 12px; border: none; background-color: #f4f5f7;">
                    <div class="card-header py-3" style="background-color: darkblue; color: white; border-radius: 12px 12px 0 0;">
                        <h6 class="m-0 font-weight-bold">Profile Details</h6>
                    </div>

                    <div class="card-body" style="background-color: #ffffff; border-radius: 12px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
                          <?php foreach ($student as  $row){ ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div id="msg"></div>
                            <div class="form-group">
                                <div class="card p-4" style="border: 2px solid #003366; background: #ffffff; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); border-radius: 8px;">
    
                                      <h6 class="font-weight-bold text-primary">Complete Name:</h6>
                                    <div class="row mb-3">
                             
                                     <div class="col-md-4">
                                        <div class="form-group">
            
                                            <input type="text" id="edit_alumfname" name="alumfname" value="<?php echo htmlentities($row['fname']); ?>" class="form-control form-control-user" required readonly>
                                        </div>
                                     </div>

                                        <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="edit_alummname" name="alummname" value="<?php echo htmlentities($row['mname']); ?>" class="form-control form-control-user" required readonly>
                                        </div>
                                     </div>

                                        <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="edit_alumsname" name="alumsname" value="<?php echo htmlentities($row['sname']); ?>" class="form-control form-control-user" required readonly>
                                        </div>
                                     </div>

                                    </div>

                                    <div class="row mb-3">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                           <h6 class="font-weight-bold text-primary">Student Number:</h6>
                                            <input type="text" id="edit_alumstudnum" name="alumstudnum" value="<?php echo htmlentities($row['studnum']); ?>" class="form-control form-control-user" required readonly>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                           <h6 class="font-weight-bold text-primary">Course:</h6>
                                            <input type="text" id="edit_alumcourse" name="alumcourse" value="<?php echo htmlentities($row['course']); ?>" class="form-control form-control-user" required readonly>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                           <h6 class="font-weight-bold text-primary">Year:</h6>
                                            <input type="text" id="edit_year" name="year" value="<?php echo htmlentities($row['year']); ?>" class="form-control form-control-user" required readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                         <div class="form-group">
                                           <h6 class="font-weight-bold text-primary">Section:</h6>
                                            <input type="text" id="edit_section" name="section" value="<?php echo htmlentities($row['section']); ?>" class="form-control form-control-user" required readonly>
                                        </div>
                                    </div>

                                  </div>

                                </div>
                            </div>
                            <input type="hidden" id="edit_id" name="id" value="<?php echo htmlentities($row['id']); ?>">
                        </form>

                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/scripts.php'); ?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
          $(document).ready(function () {
       
                //submit data ajax
                 $('.edit-profile').on('click', function (e) {
                    e.preventDefault();

                   const alumstudnum = document.querySelector('input[id=edit_alumstudnum]').value;
                    console.log(alumstudnum);
            
                    const alumfname = document.querySelector('input[id=edit_alumfname]').value;
                    console.log(alumfname);

                    const alummname = document.querySelector('input[id=edit_alummname]').value;
                    console.log(alummname);

                    const alumsname = document.querySelector('input[id=edit_alumsname]').value;
                    console.log(alumsname);

                    const alumcourse = document.querySelector('input[id=edit_alumcourse]').value;
                    console.log(alumcourse);

                    const yrgrad = document.querySelector('input[id=edit_yrgrad]').value;
                    console.log(yrgrad);

                    const id = document.querySelector('input[id=edit_id]').value;
                    console.log(id);

                    $.ajax({
                        url: '../backend/update_profilestudent.php',
                        type: 'POST',
                        data: {
                            alumstudnum: alumstudnum,
                            alumfname: alumfname,
                            alummname: alummname,
                            alumsname: alumsname,
                            alumcourse: alumcourse,
                            yrgrad: yrgrad,
                            id: id,

                        },
                        success: function (response) {
            
                             const res = JSON.parse(response);
                            $('#msg').html('<div id="loginMessage" class="alert alert-success">'+res.message+'</div>');

                            if (res.status === "success") {
                             setTimeout(function() {
                                        window.location = 'myaccount.php';
                             }, 1000);
                            }
                        }
                    });
                  
                });

           //submit data ajax
       });
     </script>

</body>
</html>
<?php } ?>