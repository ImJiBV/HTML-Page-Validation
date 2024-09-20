<?php
    require('model/dbconn.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <h2 class="title">Register</h2>
            <form action="#" class="form">

                <div class="input-group">
                    <label for="fullName" class="label">Name</label>
                    <input id="fullName" placeholder="Full Name" class="input is-success is-error" type="text">
                    <span class="error-message"></span>
                </div>

                <div class="input-group">
                    <label for="email" class="label">Email</label>
                    <input id="email" class="input is-success is-error" autocomplete placeholder="sample@gmail.com" type="email">
                    <span class="error-message"></span>
                </div>

                <div class="input-group">
                    <label for="mobileNumber" class="label">Mobile Number</label>
                    <input id="mobileNumber" placeholder="Mobile Number" class="input is-success is-error" type="text">
                    <span class="error-message"></span>
                </div>

                
                <div class="input-group">
                    <label for="birthDate" class="label">Date of Birth</label>
                    <input id="birthDate" class="input is-success is-error" max="" onchange="calculateAge()" type="date">
                    <span class="error-message"></span>
                </div>

                <div class="input-group">
                    <label for="age" class="label">Age</label>
                    <input id="age" class="input is-success is-error" type="number" readonly>
                    <span class="error-message"></span>
                </div>


                <div class="input-group">
                    <label for="gender" class="label">Gender</label>
                    <select id="gender" class="input is-success is-error">
                        <option value="select" disabled selected>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                        <option value="prefer-not-to-say">Prefer not to say</option>
                    </select>
                    <span class="error-message"></span>
                </div>

                <input type="submit" class="button" value="Submit" name="submit" id="submit">
            </form>
        </div>
    </div>
    
    <div id="snackbar" class="snackbar"></div> 

    <script src="script/max-date.js"></script>
    <script src="script/calculate-current-age.js"></script>
    <script src="schema/validate.js"></script>

    <script type="text/javascript">
        $("#submit").on("click", function() {
            if ($('#fullName').val() === ""
                || $('#email').val() == ""
                || $('#mobileNumber').val() == "" 
                || $('#birthDate').val() == ""
                || $('#age').val() == ""
                || $('#gender').val() == ""
            ){
                showSnackbar("Please fill all required fields!", "darkred");
            }
            else {
                $('#submit').prop('disabled', true);
                showSnackbar("Saving Information...", "green");

                var data = {
                    "fullName" : $('#fullName').val(),
                    "email" : $('#email').val(),
                    "mobileNumber" : $('#mobileNumber').val(),
                    "birthDate" : $('#birthDate').val(),
                    "age" : $('#age').val(),
                    "gender" : $('#gender').val(),

                    "submit" : "submit"
                };

                data = $(this).serialize() + "&" + $.param(data);       

                $.ajax({
                    type: 'POST',
                    url: 'model/user.php',
                    dataType : 'json',
                    data: data,

                    success: function (data) {
                        if(data == 'exist'){
                            // IF DATA VALIDATION EXIST ;;
                        }
                        else {
                            $('#submit').prop('disabled', true);
                            showSnackbar("Added Successfully...", "green");
                        }                       
                    }
                });
            }
        });

        function showSnackbar(message, color) {
            var snackbar = $("#snackbar");
               snackbar.text(message);
            snackbar.css("background-color", color);
            snackbar.addClass("show");
            snackbar.css("visibility", "visible");

            setTimeout(function() {
                snackbar.removeClass("show");
                snackbar.css("visibility", "hidden");
            }, 3000);
        }

    </script>



</body>
</html>
