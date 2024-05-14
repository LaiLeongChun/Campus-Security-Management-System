<html>
<style>
    body {
        background: linear-gradient(to right, #16cece, #4d3c61);
    }

    input[type=submit] {
        background-color: lime;
        width: 80px;
        height: 30px;
        border-radius: 5px;
    }

    input[type=submit]:hover {
        background-color: rgb(20, 228, 20);
        cursor: pointer;
    }

    .registration {
        padding: 0px 25px;
        border: 3px solid black;
        border-radius: 10px;
        height: auto;
        width: 50%;
        display: block;
        margin: auto;
        margin-top: 12%;
        margin-bottom: 12%;
    }

    .userfrm {
        padding: 0px 80px;
    }

    input[type=text],
    input[type=password],
    input[type=email] {
        width: 80%;
        padding: 6px 12px;
        margin: 2px 0;
        box-sizing: border-box;
        border-radius: 5px;
    }

    #logo img {
        position: absolute;
        left: 80%;
        top: 15%;
        width: 100px;
    }

    #signup {
        position: relative;
    }
</style>

<head>
    <title>Join us Now</title>
</head>

<body>
    <div class="registration">
        <div id="signup">
            <h2 style="font-family: 'Verdana';">Sign Up</h2>
        </div>
        <div class="userfrm">
            <form method="POST" action=''>
                <label for="username" style="font-family: 'Verdana';">Enter Name :</label>
                <br><input type="text" id="username" name="Username" />
                <br><br><label for="password" style="font-family: 'Verdana';">Enter Password :</label>
                <br><input type="password" id="password" name="Password" />
                <br><br><label for="email" style="font-family: 'Verdana';">Enter Email Address :</label>
                <br><input type="email" id="email" name="Email" />
                <br>
                <br><input type="submit" name="Submit_Btn" value="Send" />
        </div>
        </form>
    </div>
</body>

<?PHP
if (!empty($_POST)) {
    include ('connection.php');

    $user_name = $_POST['Username'];
    $user_password = $_POST['Password'];
    $user_email = $_POST['Email'];


    # -- data validation --
    if (empty($user_name) or empty($user_password) or empty($user_email)) {
        die("<script>alert('Please fill up all the informations.');
        window.history.back();</script>");
    }

    # Checking if register username is duplicated
    $customer_record_search = "select*
    from customer
    where customer_username='$user_name'";

    #executing the code above
    $execute_customer_record = mysqli_query($condb, $customer_record_search);

    # if one record is found
    if (mysqli_num_rows($execute_customer_record) == 1) {
        echo "<script>alert('Username have been used. Please try again.');
        window.history.back();</script>";
    } else {

        # pre-excecuting
        $storing_registration_data = "insert into customer
    (customer_username, customer_password, customer_email)
    values
    ('$user_name','$user_password','$user_email')";

        # excecuting
        if (mysqli_query($condb, $storing_registration_data)) {
            # Shows that user have successfully making their account
            echo "<script>alert('Welcome new user!');
        window.location.href='index.php';</script>";
        } else {
            # Shows that User have failed to create their account
            echo "<script>alert('Registration failed. Please try again.');
        window.history.back();</script>";
        }

    }

}
?>