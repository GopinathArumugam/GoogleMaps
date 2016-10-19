<?php
ob_start();
session_start();
?>

<?
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
?>

<html lang = "en">

    <head>
        <title>Google Maps</title>
        <link href = "/GoogleMaps/src/bootstrap.min.css" rel = "stylesheet">

        <style>
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #ADABAB;
            }

            .form-signin {
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
                color: #017572;
            }

            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }

            .form-signin .checkbox {
                font-weight: normal;
            }

            .form-signin .form-control {
                position: relative;
                height: auto;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding: 10px;
                font-size: 16px;
            }

            .form-signin .form-control:focus {
                z-index: 2;
            }

            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
                border-color:#017572;
            }

            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                border-color:#017572;
            }

            h2{
                text-align: center;
                color: #017572;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $("#frmLogin").on("submit", function(event) {
                    var data = $(this).serialize();
                    data = data + "&action_name=validateCredentials";
                    event.preventDefault();
                    $.ajax({
                        url: "/GoogleMaps/External/googleMapsController.php",
                        type: "post",
                        data: data,
                        success: function(response) {
                            if (response == "invalid_login") {
                                window.location.href = "index.php";
                            } else {
                                window.location.href = response;
                            }
                        }
                    });
                });
            });
        </script>
    </head>

    <body>

        <h2>Enter Username and Password</h2> 
        <div class = "container form-signin">
        </div>
        <div class = "container">
            <form class ="form-signin" id="frmLogin" method="post">
                <h4 class = "form-signin-heading"> <?php if ((!isset($_SESSION['username']))) echo "Invalid login"; ?> </h4>
                <input type = "text" class = "form-control" name = "username" placeholder = "username = admin" required autofocus></br>
                <input type = "password" class = "form-control" name = "password" placeholder = "password = admin" required>
                <button class = "btn btn-lg btn-primary btn-block" onclick="validateCredintials()" name = "login" type="submit">Login</button>
            </form>           
        </div> 

    </body>
</html>