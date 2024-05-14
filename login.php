<?PHP
#Start session as global variable
session_start();
?>

<html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro&family=Poppins:wght@700&family=Roboto&display=swap');

    body {
        background: linear-gradient(to right, #16cece, #4d3c61);
    }

    input[type=submit],
    input[type=button] {
        background-color: lime;
        padding: 0 20px;
        height: 35px;
        border-radius: 5px;
        transition: all 0.2s;
    }

    input[type=submit]:hover,
    input[type=button]:hover {
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

    label {
        font-family: 'Roboto', sans-serif;
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
        left: 81.5%;
        top: 170%;
        width: 100px;
    }

    #signin {
        position: relative;
    }

    #admin {
        color: black;
        text-decoration: none;
    }

    #admin:hover {
        color: darkgray;
        text-decoration: underline;
    }
</style>

<head>
    <title>Sign In</title>
</head>

<body>
    <div class="registration">
        <div id="signin">
            <h2 style="font-family: 'Poppins', sans-serif;">Sign In</h2>
        </div>
        <div class="userfrm">
            <form method="POST" action="">
                <label for="user_id">Enter User ID :</label>
                <br><input type="text" id="user_id" name="User_id" />
                <br><br><label for="password">Enter Password :</label>
                <br><input type="password" id="password" name="Password" />
                <br>
                <br><input type="submit" name="Submit_Btn" value="Sign In" />
                <input type="button" name="new_account_btn" value="Create New Account"
                    onclick="window.location='register.php'" />
                <br><i><a href="admin/login.php" id="admin">Login as Administrator</a></i>
        </div>
        </form>
    </div>
</body>


<?PHP
if (!empty($_POST)) {
    include ('connection.php');

    $user_id = $_POST['User_id'];
    $password = $_POST['Password'];

    #code searching for user's record
    $user_record_search = "select*
    from user
    where user_id='$user_id' and
    password='$password'
    limit 1 ";

    #executing the code above
    $execute_user_record = mysqli_query($condb, $user_record_search);

    # if one record is found
    if (mysqli_num_rows($execute_user_record) == 1) {
        # Login Successfully
        # $record records everything on the table in array
        $record = mysqli_fetch_array($execute_user_record);

        # Recoding into session
        $_SESSION['user_id'] = $record['user_id'];
        $_SESSION['full_name'] = $record['full_name'];
        $_SESSION['user_password'] = $record['user_password'];

        # mengarahkan fail index.php dibuka
        echo "<script>window.location.href='store.php';</script>";
    } else {
        echo "<script>alert('Login Failed');
        window.history.back();</script>";
    }
}
?>