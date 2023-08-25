<?php 

session_start();
$USERID = $_SESSION["USERID"];

if($USERID == '')
{
    session_destroy();

    header('location:index.php');
}

// Fetch User All data using USERID

include('config.php');

$query = "SELECT USERNAME,EMAIL,PASSWORD,AGE,GENDER,DOB,CONTACT FROM users WHERE USER_ID = '$USERID'";

$result = mysqli_query($conn,$query);

if($result)
{

   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

   $USERNAME = $row["USERNAME"];
   $EMAIL = $row["EMAIL"];
   $PASSWORD = $row["PASSWORD"];
   $AGE = $row["AGE"];
   $GENDER = $row["GENDER"];
   $DOB = $row["DOB"];
   $CONTACT = $row["CONTACT"];
//    $ADDRESS = $row["ADDRESS"];
}
else
{
    echo "<script> alert('Unexpected Error'); </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"href="profile1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body class="profile_body">
    <div class="Nav_all">
    <p class="welcome-message" style="color:white;">Welcome <?php echo $USERNAME ?></p>
    <div class="navi_1" id="navibar">
    <!-- <button type="button" class="btn btn-link"><a href="Home.php">Home</a></button>
    <button type="button" class="btn btn-link"><a href="profile.php">Profile</a></button> -->
    <!-- <button type="button" class="btn btn-link"><a href="logout.php">Logout</a></button> -->
    <!-- <button type="button" class="btn btn-link">Logout</button> -->
    </div>
    </div>
    <div class="Nav_2">
    <button type="button" class="btn btn-link"><a href="logout.php">Logout</a></button>
</div>
    <br>
    <div class="profile_image">
    <img src="images.png" id="profile-im" width="5%">
            <div class="profile_div"><h2 id="subtitle" style="color:black;">Profile</h2>
    </div>
    <div class="profile_name">            
    <div class="update_form">

    <div class="part1">
        
        <div class="mb-3">
            <label for="FullName" class="form-label">Full Name</label>
            <input type="text" class="form-control" value="<?php echo $USERNAME ?>" id="exampleFormControlInput1" name="FullName" placeholder="Ex: Raja">
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" class="form-control" value="<?php echo $EMAIL ?>" id="exampleFormControlInput1" name="Email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" value="<?php echo $PASSWORD ?>" id="exampleFormControlInput1" name="Password" placeholder="password">
        </div>
        <div class="mb-3">
            <label for="Age" class="form-label">Age</label>
            <input type="number" class="form-control" value="<?php echo $AGE ?>" id="exampleFormControlInput1" name="Age" placeholder="Age">
        </div>

        </div>
        <div class="part1">
        <div class="mb-3">
            <label for="Dob" class="form-label">Date Of birth</label>
            <input type="date" class="form-control" value="<?php echo $DOB ?>" id="exampleFormControlInput1" name="Dob" >
        </div>

    <div class="part1">
        <div class="mb-3">
            <label for="Gender" class="form-label">Gender</label>
            <input type="text" class="form-control"  value="<?php echo $GENDER ?>" id="exampleFormControlInput1" name="Gender" placeholder="Gender">
        </div>
        <div class="mb-3">
            <label for="Contact" class="form-label">Contact</label>
            <input type="number" class="form-control" value="<?php echo $CONTACT ?>" id="exampleFormControlInput1" name="Contact" placeholder="Mobile Number">
        </div>
        <!-- <div class="mb-3">
            <label for="Address" class="form-label">Address</label>
            <input type="text" class="form-control" value="<?php echo $ADDRESS ?>" id="exampleFormControlInput1" name="Address" placeholder="Enter Address">
        </div> -->
        <button class="btn" onclick="Update()">Update</button>
        </div>
    
    </div>
    </div>
</div>
<script>
    function Update(){

        var FullName = $("input[name=FullName]").val();
        var Email = $("input[name=Email]").val();
        var Password = $("input[name=Password]").val();
        var Age = $("input[name=Age]").val();
        var Dob = $("input[name=Dob]").val();
        var Gender = $("input[name=Gender]").val();
        var Contact = $("input[name=Contact]").val();
        // var Address = $("input[name=Address]").val();

        var user_info = {
            FullName : FullName,
            Email:Email,
            Password:Password,
            Age:Age,
            Dob:Dob,
            Gender:Gender,
            Contact:Contact,
            // Address:Address,
            UserId:<?php echo  $USERID; ?>
        }

        $.ajax({
                type: "POST",
                url: 'update.php',
                data: user_info,
                success: function(response)
                {
                    var response = JSON.parse(response);
                    if(response)
                    {
                        console.log(response.status);

                        if(response.status == 'success')
                        {
                                alert('The Record has been Updated.....');
                                location.reload();
                        }
                        else if(response.status == 'failed')
                        {
                                alert(response.error);
                        }
                    }
                    else
                    {
                        console.log('Error');
                    }
                }
        });
    }
</script>
</body>
</html>