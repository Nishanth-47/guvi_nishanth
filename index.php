<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Registration form</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body background="login.jpg">
<div class="body">
<div class="Nav">
    <h1 style="font-size: 50px">Welcome to Guvi</h1>
    <br>
    <!-- <h1 style="font-size: 40px">Login / Signup</h1> -->
</div>
<!-- <h1 style="font-size: 40px; align-items: center;">Login / Signup</h1> -->
<div class="Register_form" style ="margin-top: 10%;">
    <div class="mb-3">
        <label for="FullName" class="form-label"><strong>Full Name</strong></label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="FullName" placeholder="Ex: Raja" style="width: 400px;">
    </div>
    <div class="mb-3">
        <label for="Email" class="form-label" ><strong>Email</strong></label>
        <input type="email" class="form-control" id="exampleFormControlInput1" name="Email" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="Password" class="form-label"><strong>Password</strong></label>
        <input type="password" class="form-control" id="exampleFormControlInput1" name="Password" placeholder="password">
    </div>
    <button type="submit" class="btn btn-primary" onclick="Registration()">Registration</button>
    <button type="button" class="btn btn-link" onclick="toggleTOLoginForm()"><strong>Login</strong></button>
</div>



<div class="Login_form">
    <div class="mb-3">
        <label for="Email" class="form-label" ><strong>Email</strong></label>
        <input type="email" class="form-control" id="exampleFormControlInput1" name="Login_Email" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="Password" class="form-label"><strong>Password</strong></label>
        <input type="password" class="form-control" id="exampleFormControlInput1" name="Login_Password" placeholder="password">
    </div>
    <button type="submit" class="btn btn-primary" onclick="Login()">Login</button>
    <button type="button" class="btn btn-link" onclick="toggleToRegistrationForm()"><strong>Registration</strong></button>
</div>
</div>
<script>


// function Registration(){

//     var FullName = $("input[name=FullName]").val();
//     var Email = $("input[name=Email]").val();
//     var Password = $("input[name=Password]").val();


//     if(FullName == '' || Email == '' || Password == '')
//     {
//         alert('Please fill all the input box..');
//     }
//     else
//     {

//         var user_info = {
//             FullName : FullName,
//             Email:Email,
//             Password:Password
//         }

//         $.ajax({
//                 type: "POST",
//                 url: 'register.php',
//                 data: user_info,
//                 success: function(response)
//                 {
//                     var response = JSON.parse(response);
//                     if(response)
//                     {
//                         console.log(response.status);

//                         if(response.status == 'success')
//                         {
//                         // redirect to profiles
//                             alert('USER ADD SUCCESS');
//                             window.location.href = 'profile.php';
//                         }
//                         else if(response.status == 'failed' && response.error == 'Email_already_taken')
//                         {
//                             alert('Email Id is already taken. Try another one...');
//                         }
//                         else
//                         {
//                             alert(response.error);
//                         }  
//                     }
//                     else
//                     {
//                         console.log('Error');
//                     }
//                 }
//         });

//     }

// }

function Registration() {
    var FullName = $("input[name=FullName]").val();
    var Email = $("input[name=Email]").val();
    var Password = $("input[name=Password]").val();

    if (FullName == '' || Email == '' || Password == '') {
        Swal.fire('Error', 'Please fill all the input boxes.', 'error');
    } else {
        var user_info = {
            FullName: FullName,
            Email: Email,
            Password: Password
        };

        $.ajax({
            type: "POST",
            url: 'register.php',
            data: user_info,
            success: function (response) {
                var response = JSON.parse(response);
                if (response) {
                    console.log(response.status);

                    if (response.status == 'success') {
                        Swal.fire('Success', 'User added successfully!', 'success')
                            .then(() => {
                                window.location.href = 'profile.php';
                            });
                    } else if (response.status == 'failed' && response.error == 'Email_already_taken') {
                        Swal.fire('Error', 'Email ID is already taken. Try another one...', 'error');
                    } else {
                        Swal.fire('Error', response.error, 'error');
                    }
                } else {
                    console.log('Error');
                }
            }
        });
    }
}


// function Login(){

// var Email = $("input[name=Login_Email]").val();
// var Password = $("input[name=Login_Password]").val();

// var user_login_info = {

//     Email:Email,
//     Password:Password
// }

// $.ajax({
//         type: "POST",
//         url: 'validation.php',
//         data: user_login_info,
//         success: function(response)
//         {
//             var response = JSON.parse(response);
//             if(response)
//             {
//                 console.log(response.status);

//                 if(response.status == 'success')
//                 {
//                     // redirect to profiles
//                     alert('Login Successfully');
//                     window.location.href = 'profile.php';
//                 }
//                 else if(response.status == 'Invalid')
//                 {
//                     alert('Invalid Email Id and Password..');
//                 }
//                 else if(response.status == 'Error')
//                 {
//                     alert(response.Error);
//                 }
//             }
//             else
//             {
//                 console.log('Error');
//             }
//        }
//    });

// }
function Login() {
    var Email = $("input[name=Login_Email]").val();
    var Password = $("input[name=Login_Password]").val();

    var user_login_info = {
        Email: Email,
        Password: Password
    }

    $.ajax({
        type: "POST",
        url: 'validation.php',
        data: user_login_info,
        success: function (response) {
            var response = JSON.parse(response);
            if (response) {
                if (response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        window.location.href = 'profile.php';
                    });
                } else if (response.status == 'Invalid') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Email and Password',
                        text: 'Please check your credentials and try again.'
                    });
                } else if (response.status == 'Error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.Error
                    });
                }
            } else {
                console.log('Error');
            }
        }
    });
}



function toggleTOLoginForm() {

    $(".Login_form").css("display","block");
    $(".Register_form").css("display","none");

}

function toggleToRegistrationForm(){

    $(".Login_form").css("display","none");
    $(".Register_form").css("display","block");

}

</script>




</body>
</html>