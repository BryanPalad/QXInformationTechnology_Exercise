<?php

@include('./app/config.php');

$success = " ";
$error = " ";
if(isset($_POST['submit'])){
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $mname = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lname =  mysqli_real_escape_string($conn, $_POST['lastname']);
    $bdate =  mysqli_real_escape_string($conn, $_POST['birthdate']);
    $gender =  $_POST['gender'];
    $phone = mysqli_real_escape_string($conn, $_POST['number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    
    function validateDate($bdate, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $bdate);
        return $d && $d->format($format) === $bdate;
    }

    if((validateDate($bdate))){
            $insert = "INSERT into applicant_table (first_name, middle_name, last_name, birthdate, gender, cellphone_no, address) values ('$fname', '$mname', '$lname', '$bdate', '$gender','$phone', '$address')";
            mysqli_query($conn, $insert);
            $success = 'Successfully Added Applicant';
            $error='';
    } else {
        $error = 'Invalid Date format, Please try again';
    }
       
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QXIT-EXERCISE</title>
     <!-- Font Awesome -->
     <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css"
    rel="stylesheet"
    />
    <link rel='stylesheet' href="./styles/style.css">
</head>
<body>
    <?php
    include('./components/navbar.php')
    ?>

<div className='container-sm' style='width:30%; margin:auto; margin-top:50px;'>
    <div class="card text-center">
        <div class="card-header">
            <h3>Add New Applicant</h3>
            <span class='bg-success text-center' style='width:100%;'><?php echo $success?></span>
            <span class='bg-warning text-center' style='width:100%; height: 100%;'><?php echo $error?></span>
        </div>
        <div class="card-body">
        <div class="form-outline">
            <!-- INPUT FIELDS -->
            <div class='form-container'>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <input type="text" name="firstname" required placeholder='Enter your firstname'>
            <input type="text" name="middlename" required placeholder='Enter your middlename'>
            <input type="text" name="lastname" required placeholder='Enter your lastname'>
            <input type="text" name="birthdate" required placeholder='Enter birthdate format: yyyy-mm-dd'>
            <select name='gender'>
                <option value=''>Select Gender</option>
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
            </select>
            <input type="text" name="number" required placeholder='Enter your phone no.'>
            <input type="text" name="address" required placeholder='Enter your address'>
           
            <input type='submit' name='submit' value='SUBMIT' class='form-btn'>
            <a href='./index.php' name='submit'>Back to List</a>
            </form>
            </div>

        </div>
        </div>
    </div>
</div>
</body>
</html>