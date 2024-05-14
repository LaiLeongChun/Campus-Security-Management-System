<?PHP
#Start session as global variable
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <style>
        div {
            text-align: center;
            border: 2px solid white;
            padding: 80px 50px 80px 50px;
            width: 400px;
            height: 400px;
            margin: 100px auto 0 auto;
        }

        body {
            background-color: aquamarine;
        }

        h2 {
            font-family: 'Verdana';
        }

        label {
            font-family: 'Helvetica';
        }

        input[type=submit] {
            display: inline-block;
            padding: 0.35em 1.2em;
            border: 0.1em solid #FFFFFF;
            margin: 0 0.3em 0.3em 0;
            border-radius: 0.12em;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            color: #240c3f;
            text-align: center;
            transition: all 0.2s;
            cursor: pointer;
        }

        input[type=submit]:hover {
            color: #fff9f9;
            background-color: #251212;

        }

        @media all and (max-width:30em) {
            input[type=submit] {
                display: block;
                margin: 0.4em auto;
            }
        }
    </style>
</head>

<body>
    <div>
        <h2>Administrator Login</h2>
        <form action='' method='POST'>
            <label for="name">Username: </label>
            <input type="text" name="admin_name" id="name"><br><br>
            <label for="ps">Password: </label>
            <input type="password" name="admin_ps" id="admin_ps"><br><br>
            <input type="submit" value="Log In">
        </form>
    </div>
</body>

<?PHP
if (!empty($_POST)) {
    include ('../connection.php');

    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_ps'];

    #code searching for admin's record
    $admin_record_search = "select*
    from admin
    where admin_username='$admin_name' and
    admin_password='$admin_password'
    limit 1 ";

    #executing the code above
    $execute_admin_record = mysqli_query($condb, $admin_record_search);

    # if one record is found
    if (mysqli_num_rows($execute_admin_record) == 1) {
        # Login Successfully
        # $record records everything on the table in array
        $record = mysqli_fetch_array($execute_admin_record);

        # Recoding into session
        $_SESSION['admin_username'] = $record['admin_username'];


        # mengarahkan fail index.php dibuka
        echo "<script>window.location.href='dashboard.html';</script>";
    } else {
        echo "<script>alert('Login Failed');
        window.history.back();</script>";
    }
}
?>