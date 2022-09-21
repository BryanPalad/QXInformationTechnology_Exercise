<?php
include_once './app/config.php';

$fetchedId = $_GET['id'];

$select = "Select * from applicant_table where id=$fetchedId";

$res = mysqli_query($conn, $select);

$applicantsRow = mysqli_fetch_array($res);

$error = '';
if(isset($_POST['update'])){
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
        $update = "UPDATE applicant_table SET first_name='$fname', middle_name='$mname', last_name='$lname', birthdate='$bdate', gender='$gender', cellphone_no='$phone', address='$address' WHERE id=$fetchedId";
        mysqli_query($conn, $update);
        header('location:index.php');
    } else {
        $error = 'Invalid Date format, Please try again';
    }
}
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
    @include('./components/navbar.php');
    ?>

    <div class="container-sm" style="width:30%; margin:auto; margin-top:50px;">
    <div class="card text-center">
        <div class="card-header">
            <h3>Edit Applicant Info</h3>
            <span class='text-center bg-warning'><?php echo $error?></span>
        </div>
        <div class="card-body">
        <div class="form-outline">
            <!-- INPUT FIELDS -->
            <div class='form-container'>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <input type="text" name="firstname" value="<?php echo $applicantsRow['first_name'];?>" required placeholder='Enter your firstname'>
            <input type="text" name="middlename" value="<?php echo $applicantsRow['middle_name'];?>" required placeholder='Enter your middlename'>
            <input type="text" name="lastname" value="<?php echo $applicantsRow['last_name'];?>"  required placeholder='Enter your lastname'>
            <input type="text" name="birthdate" value="<?php echo $applicantsRow['birthdate'];?>"  requiredplaceholder='Enter birthdate format: yyyy-mm-dd'>
            <select name='gender'>
                <option><?php echo $applicantsRow['gender']?></option>
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
            </select>
            <input type="text" name="number" value="<?php echo $applicantsRow['cellphone_no'];?>" required placeholder='Enter your phone no.'>
            <input type="text" name="address" value="<?php echo $applicantsRow['address'];?>" required placeholder='Enter your address'>
           
            <input type='submit' name='update' value='Update' class='form-btn'>
            <a href='./index.php' name='submit'>Back to List</a>
            </form>
            </div>

        </div>
        </div>
    </div>
    </div>
</body>
</html>