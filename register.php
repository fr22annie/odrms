<?php 

   session_start();
   require_once "../backend/UserClass.php";
   if(!isset($_SESSION['a_user_email'])){
     
     header("location:index.php");

  }else{
   
    $conn = new MyClass();
    $getsessionID = trim($_SESSION['a_user_id']);
    $admin = $conn->fetch_adminId($getsessionID);
    $alladmin = $conn->fetchalladmin();

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
<br>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
           <div class="row">
               <div class="col-md-9">
                  <h6 class="m-0 font-weight-bold text-primary">Admin Profile</h6> 
               </div>   
                    <div class="col-md-3">
                   <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addadminprofile">
                    Add Admin Profile 
                    </button>
                    <?php include('modal/add_adminModal.php');?>
               </div>      
           </div>
    </div><hr>
    <div class="card-body">

    <div class="table-responsive">
             
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Username </th>
                            <th>Email </th>
                            <th>Password</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($alladmin as $row) { ?>
     
                            <tr>
                                <td><?php  echo htmlentities($row['id']); ?></td>
                                <td><?php  echo htmlentities($row['username']); ?></td>
                                <td><?php  echo htmlentities($row['email']); ?></td>
                                <td><?php  echo htmlentities($row['password']); ?></td>
                                <td>
                                    <button class="btn btn-success btn-editadmin"  data-edit="<?= htmlentities($row['id']); ?>"> EDIT</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-del" data-del="<?= htmlentities($row['id']); ?>"> DELETE</button>
                                </td>
                            </tr>
                        <?php
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

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');

    ?>

<?php } ?>



</div>

<?php include('modal/edit_adminModal.php');?>
<?php include('modal/delete_adminModal.php');?>
 <script>
         $(document).ready(function() {   
             load_data();    
             var count = 1; 
             function load_data() {
                 $(document).on('click', '.btn-editadmin', function() {
                      $('#editadminModal').modal('show');
                      var id = $(this).data("edit");
                       // console.log(department_id);
                        getID(id); //argument    
               
                 });
              }

               function getID(id) {
                    $.ajax({
                        type: 'POST',
                         url: '../backend/admin_row.php',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                     success: function(response) {

                        $('#edit_id').val(response.id);
                        $('#edit_username').val(response.username);
                        $('#edit_email').val(response.email);
                        $('#edit_password').val(response.password);
        
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
               $(document).on('click', '.btn-del', function() {
                  $('#deleteAdmin').modal('show');
                    var id = $(this).data("del");
                      get_delId(id); //argument    
             
               });
            }

             function get_delId(id) {
                  $.ajax({
                      type: 'POST',
                      url: '../backend/admin_row.php',
                      data: {
                          id: id
                      },
                      dataType: 'json',
                      success: function(response2) {
                      $('#delete_id').val(response2.id);
                   }
                });
             }
       
       });
        
  </script>

</body>
</html>
