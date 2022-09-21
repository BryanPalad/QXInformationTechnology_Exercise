<?php 

@include './app/config.php';

$select = "Select * from applicant_table";

$res = mysqli_query($conn, $select);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QXIT-EXERCISE</title>     <!-- Font Awesome -->
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

<div class='container-sm' style='margin-top: 20px;'>

<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Full Name</th>
      <th>BirthDate</th>
      <th>Gender</th>
      <th>Cellphone No</th>
      <th>Address</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

<?php
while ($applicantsRow=mysqli_fetch_array($res)) {
    if($applicantsRow['gender'] == 'Male'){
      $status='info';
    } else {
      $status='success';
    }
?>
    <tr>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="https://mdbootstrap.com/img/new/avatars/8.jpg"
              alt=""    
              style="width: 45px; height: 45px"
              class="rounded-circle"
              />
          <div class="ms-3">
            <p class="fw-bold mb-1"><?php echo $applicantsRow['first_name'] . " ". $applicantsRow['middle_name'] . " ". $applicantsRow['last_name'];?></p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1"><?php echo $applicantsRow['birthdate'];?></p>
      </td>
      <td>
        <span class="badge badge-<?php echo $status?> rounded-pill d-inline"><?php echo $applicantsRow['gender'];?></span>
      </td>
      <td><?php echo $applicantsRow['cellphone_no'];?></td>
      <td><?php echo $applicantsRow['address'];?></td>
      <td>
        <a href='./editApplicants.php?id=<?php echo $applicantsRow['id'];?>' class="btn btn-warning">
          Edit
        </a>
        <a name="delete" id="<?php echo $applicantsRow['id'];?>" class="delete btn btn-danger ">
          Delete 
        </a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>
    <a style='margin-top: 20px; float:right' href='./addApplicants.php' class="btn btn-primary">
     Add Applicant
    </a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var appId = element.attr("id");
var info = 'id=' + appId;
if(confirm("Are you sure you want to delete this record?"))
{
 $.ajax({
   type: "POST",
   url: "deleteRecord.php",
   data: info,
   success: function(){
 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
 }
return false;
});
});
</script>

</body>
</html>
