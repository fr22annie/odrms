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

<head>
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 25px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="file"], input[type="checkbox"], select {
            width: calc(100% - 10px); 
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box; 
        }
        input[type="submit"], .btn {
            background-color: darkblue;
            color: white;
            border: none;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 5px;
            width: auto;
            margin-left: 5px;
            font-size: 14px;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .flex-container {
            display: flex;
            justify-content: space-between;
        }
        .flex-container > div {
            flex: 1;
            margin-right: 10px;
        }
        .flex-container > div:last-child {
            margin-right: 0;
        }
    </style>
</head>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <h1 class="h3 mb-0 text-gray-800">REQUEST OF DOCUMENTS</h1>
     <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="nav-link" data-toggle="dropdown">
        <span class="text-dark">Welcome!, <span class="text-dark text-bold" style="font-weight: bold;"><?php foreach ($student as $row){echo ''. ucfirst($row['fname']) .' '.ucfirst($row['sname']);}; ?></span></span>
        </div>
      </li>

    </ul>
        </nav>

        <div class="container-fluid">
            <body>
    
       <form id="multiStepForm" class="needs-validation" enctype="multipart/form-data">
           <div class="step" id="step-1">
                <div class="container" id="container1">
                    <img src="./../images/neust_logo.png" style="margin-top: 20px; float: left; margin-right: 20px; margin-left: 100px; width: 80px; height: 80px;"> 
                    <p style="font-style: Times New Roman; font-size: 15px; color: darkorange;"><br><br>
                        <b>NUEVA ECIJA UNIVERSITY OF SCIENCE AND TECHNOLOGY</b> <br>
                        <span style="color: darkblue;">SAN ANTONIO OFF - CAMPUS</span>
                    </p>
               <?php foreach ($student as  $row){ ?>
                        
                        <label for="name" style="display: inline-block; width: auto;">FULL NAME:</label>
                        <input type="text" id="name" name="name" class="required" value="<?php echo htmlentities($row['fname']).' '.htmlentities($row['mname']).' '.htmlentities($row['sname']); ?>" required readonly>

                        <label for="student_number">STUDENT NUMBER:</label>
                        <input type="text" id="studnum" name="studnum" class="required" value="<?php echo $row['studnum']; ?>" required readonly>

                        <label for="course">COURSE:</label>
                        <select name="course" id="course" value="<?php echo htmlentities($row['course']); ?>" disabled>
                            <option value="" disabled selected>Select a course</option>
                            <option <?php if(htmlentities($row['course']) == "BSE"){echo"selected";}?> >BS in Entrepreneurship</option>
                            <option <?php if(htmlentities($row['course']) == "BEED"){echo"selected";}?> >Bachelor in Elementary Education</option>
                            <option <?php if(htmlentities($row['course']) == "BSIT"){echo"selected";}?> >BS in Information Technology</option>                            
                        </select>

                         <p>YEAR:
                        <select name="year" id="year" value="<?php echo htmlentities($row['year']); ?>" required style="width: 290px; margin-right: 30px;" disabled>
                            <option value="">Year level</option>
                            <option <?php if(htmlentities($row['year']) == "1st"){echo"selected";}?> >1st Year</option>
                            <option <?php if(htmlentities($row['year']) == "2nd"){echo"selected";}?> >2nd Year</option>
                            <option <?php if(htmlentities($row['year']) == "3rd"){echo"selected";}?> >3rd Year</option>
                            <option <?php if(htmlentities($row['year']) == "4th"){echo"selected";}?> >4th Year</option>

                        </select>

                        SECTION:
                        <select name="section" id="section" value="<?php echo htmlentities($row['section']); ?>" required style="width: 300px;margin-top:2%" disabled>
                            <option <?php if(htmlentities($row['section']) == "A"){echo"selected";}?> >A</option>
                            <option <?php if(htmlentities($row['section']) == "B"){echo"selected";}?> >B</option>
                            <option <?php if(htmlentities($row['section']) == "C"){echo"selected";}?> >C</option>
                            <option <?php if(htmlentities($row['section']) == "D"){echo"selected";}?> >D</option>


                        </select></p>

                       <div class="btn-container">
                            <button type="button" class="btn next-btn" id="nextBtn">Next</button>
                        </div>
                 
                </div>
            </div>

           
           <div class="step d-none" id="step-2">
                      <div id="message"></div>
                <div class="container" id="container2">
                    <img src="./../images/neust_logo.png" style="margin-top: 5px; float: left; margin-right: 20px; margin-left: 100px; width: 80px; height: 80px;"> 
                    <p style="font-style: Times New Roman; font-size: 15px; color: darkorange;"><br><br>
                        <b>NUEVA ECIJA UNIVERSITY OF SCIENCE AND TECHNOLOGY</b> <br>
                        <span style="color: darkblue;">SAN ANTONIO OFF - CAMPUS</span>
                    </p>

<!--                         <input type="hidden" id="hiddenName" name="name">
                        <input type="hidden" id="hiddenStudentNumber" name="student_number">
                        <input type="hidden" id="hiddenCourse" name="course">
                        <input type="hidden" id="hiddenYear" name="year">
                        <input type="hidden" id="hiddenSection" name="section">
 -->
                        <label for="choose">CHOOSE:</label>
                        <select name="choose" id="docname" class="required" required>
                            <option value="" disabled selected>REQUEST HERE</option>
                            <option value="Certificate of Grades">Certificate of Grades (10 php)</option>
                            <option value="Certificate of Registration">Certificate of Registration (free)</option>
                            <option value="Certificate of Enrollment">Certificate of Enrollment (free)</option>
                            <option value="Transcript of Records">Transcript of Records (for students who stop)</option>
                            <option value="Other Concern">Other Concern</option>
                        </select>

                        <div class="flex-container">
                            <div>
                                <label for="semester">Choose Semester you want to Request:</label>
                                <select name="semester" class="required" id="semester" style="width: 100%;" required>
                                    <option value="" disabled selected>Select Semester</option>
                                    <option value="First Semester">First Semester</option>
                                    <option value="Second Semester">Second Semester</option>
                                    <option value="Second Semester">Both Semester</option>

                                </select>
                            </div>
                            <div>
                                <label for="semesteryear">Semester Year:</label>
                                <input type="text" id="semester_year" class="required" name="semesteryear" placeholder="Enter the Academic Year (e.g., 2021-2022)" style="width: 100%;" required>
                            </div>
                        </div>

                        <label for="concern">If other Concern please specify:</label>
                        <input type="text" id="concern" name="concern">

                        <label for="reason">Reason for Request:</label>
                        <input type="text" id="reason" class="required" name="reason"> 

                        <label for="payment_photo">RECEIPT: (JPG, JPEG, PNG only, max 5MB)</label>
                        <input type="file" id="receipt_photo" class="required" name="payment_photo" accept=".jpg, .jpeg, .png" required>

                        <div class="btn-container">
                              <input type="hidden" id="student_id" name="" value="<?php echo $row['id']; ?>">
                              <button type="button" class="btn btn-light btn-user  prev-btn">Previous</button>
                              <button type="submit" name="registerbtn" class="btn submit-btn" id="submitbtn">Submit</button>
                    <!--         <button type="button" class="btn" onclick="showContainer(1)">Back</button>
                            <input type="submit" value="Submit" class="btn"> -->
                        </div>
                   

              
                </div>
            </div>
         <?php } ?>
           </form>
           <div id="result" style="color:red"></div>
         
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
         <script>
                  $(document).ready(function () {
                     const steps = $(".step");
                    let currentStep = 0;

                    // Show the current step
                    function showStep(index) {
                        steps.addClass("d-none");
                        steps.eq(index).removeClass("d-none");
                    }

                    // Go to the next step
                    $(".next-btn").click(function () {
                        const currentForm = steps.eq(currentStep).find(".needs-validation")[0];
                        // if (!currentForm.checkValidity()) {
                        //     currentForm.classList.add("was-validated");
                        //     return;
                        // }

                        if (currentStep === 1) { // On step 2, validate data
                            const formData = $("#multiStepForm").serialize();
                            $.post("../backend/student_login.php", formData, function (response) {
                                const res = JSON.parse(response);
                                if (res.status === "error") {
                                    alert(res.message);
                                    return;
                                } else if (res.status === "success") {
                                    // Show confirmation
                                    // $("#confirmation").html(`
                                    //     <p><strong>Name:</strong> ${res.data.name}</p>
                                    //     <p><strong>Email:</strong> ${res.data.email}</p>
                                    //     <p><strong>Username:</strong> ${res.data.username}</p>
                                    // `);
                                }
                                currentStep++;
                                showStep(currentStep);
                            });
                        } else {
                            currentStep++;
                            showStep(currentStep);
                        }
                    });

                    // Go to the previous step
                    $(".prev-btn").click(function () {
                        currentStep--;
                        showStep(currentStep);
                    });

                    // Handle form submission
                    $("#multiStepForm").submit(function (e) {
                        e.preventDefault();
                        const formData = $(this).serialize();
                        $.post("../backend/student_login.php", formData, function (response) {
                            const res = JSON.parse(response);
                            alert(res.message);
                            if (res.status === "success") {
                                location.reload(); // Reset the form
                            }
                        });
                    });

                    // Initialize the first step
                    showStep(currentStep);
                });


                   //disable button register if not fill up all field in whole form
                 $(document).ready(function () {
                  // Hide submit buttons initially
                  // $(".submit-btn").hide();
                  $('.submit-btn').attr('disabled','disabled');

                  // Function to check if all required fields are filled
                  function checkFormCompletion(form) {
                    let allFilled = true;
                    $(form).find(".required").each(function () {
                      if ($(this).val().trim() === "") {
                        allFilled = false;
                        return false; // Break loop if any field is empty
                      }
                    });
                    return allFilled;
                  }

                  // Attach event listeners for input fields
                  $(".required").on("input", function () {
                    let form = $(this).closest("form");
                    let button = form.find(".submit-btn");

                    if (checkFormCompletion(form)) {
                      button.removeAttr('disabled');
                    } else {
                      button.attr('disabled','disabled');
                    }
                  });
                });

              //end disable button register if not fill up all field in whole form


                //submit data ajax
                 $('#submitbtn').on('click', function (e) {
                    e.preventDefault();

                   const studnum = document.querySelector('input[id=studnum]').value;
                    console.log(studnum);

                    const name = document.querySelector('input[id=name]').value;
                    console.log(name);

                    const course = $('#course option:selected').val();
                    console.log(course);

                    const year = $('#year option:selected').val();
                    console.log(year);

                    const section = $('#section option:selected').val();
                    console.log(section);

                    const docname = $('#docname option:selected').val();
                    console.log(docname);

                    const semester = $('#semester option:selected').val();
                    console.log(semester);

                     const semester_year =  document.querySelector('input[id=semester_year]').value;
                    console.log(semester_year);

                    const concern = document.querySelector('input[id=concern]').value;
                    console.log(concern);

                    const reason = document.querySelector('input[id=reason]').value;
                    console.log(reason);

                    var receipt_photo = document.getElementById('receipt_photo').files[0];
                    console.log(receipt_photo);

                    const student_id = document.querySelector('input[id=student_id]').value;
                    console.log(student_id);

                       var form_data = new FormData();
             
                        form_data.append("studnum", studnum);
                        form_data.append("name", name);
                        form_data.append("course", course);
                        form_data.append("year", year);
                        form_data.append("section", section);
                        form_data.append("docname", docname);
                        form_data.append("semester", semester);
                        form_data.append("semester_year", semester_year);
                        form_data.append("concern", concern);
                        form_data.append("reason", reason);
                        form_data.append('receipt_photo', $('#receipt_photo')[0].files[0]);
                        form_data.append("student_id", student_id);

                    $.ajax({
                        url: '../backend/process_requeststudent.php',
                        type: 'POST',
                        data: form_data,
                        contentType: false, // To prevent jQuery from setting contentType
                        processData: false, // To prevent jQuery from processing the data
                        dataType: 'json',
                    success: function (response__) {
                        if (response__.success) {
                             setTimeout(function() {
                                    window.location = 'process_request.php?requestID='+response__.lastInsertId+'&studnum='+response__.studnum;
                                }, 1000);
                        }else if (response__.limit) {
                             setTimeout(function() {
                                    $("#message").html('<div class="alert alert-danger">There is one record, it is limited to one request</div>');
                                }, 1000);
                        } else {
                            console.log('Error: ' + response__.error);
                        }
                    },
                    error: function () {
                               console.log('Error: ' + response__.error);
                     }
                   });
                  
                });

           //submit data ajax


              </script>

            </body>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
?>
 <?php } ?>