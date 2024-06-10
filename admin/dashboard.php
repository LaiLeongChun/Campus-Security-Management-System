<?php
session_start();
include ('../connection.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/fontawesome.css">
    <link rel="stylesheet" href="../css/solid.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Belanosima&family=Dosis:wght@700&family=Raleway:wght@500&display=swap');

        body {
            background-image: linear-gradient(to right, #74F2CE, #82c28d);
        }

        ul {
            list-style-type: none;
            background-color: none;
            border-radius: 10px;
            padding: 5px;
            width: 100%;
        }

        ul li a {
            display: block;
            border-radius: 20px;
            padding: 20px 20px;
            margin: 15px 0px;
            background-image: linear-gradient(to right, #3CA55C 0%, #B5AC49 51%, #3CA55C 100%);
            color: #ffffff;
            font-size: 22px;
            text-decoration: none;
            font-family: 'Belanosima', sans-serif;
            transition: 0.5s;
            background-size: 200% auto;
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
        }

        ul li a:hover {
            background-position: right center;
            /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
        }

        h1 {
            font-family: 'Dosis', sans-serif;
            font-size: 40px;
            text-align: center;
            text-transform: uppercase;
        }

        h3 {
            font-family: 'Raleway', sans-serif;
        }

        div.container {
            text-align: center;
            border-radius: 10px;
            border: 2px solid green;
            padding: 70px 50px 60px 50px;
            width: 1000px;
            height: auto;
            margin: 0 auto 0 auto;
        }

        div.title {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title" style="padding-left:340px;">
            <h1>Admin Dashboard</h1>
        </div>
        <?PHP
        echo "<h3>Welcome, " . $_SESSION['admin_name'] . "!</h3>";
        ?>
        <h3>What would you like to do today?</h3>
        <ul>
            <li><a href="customer.php"><i class="fa-solid fa-user-group"></i>&nbsp;&nbsp;User Record&nbsp;&nbsp;<i
                        class="fa-solid fa-user-group"></i></a></li>
            <li><a href="staff.php"><i class="fa-solid fa-clipboard-user"></i>&nbsp;&nbsp;Admin Management&nbsp;&nbsp;<i
                        class="fa-solid fa-clipboard-user"></i></a></li>
            <li><a href="product.php"><i class="fa-solid fa-person-falling-burst"></i>&nbsp;&nbsp;Incident
                    Report&nbsp;&nbsp;<i class="fa-solid fa-person-falling-burst"></i></a></li>
            <li><a href="review.php"><i class="fa-solid fa-shield-halved"></i>&nbsp;&nbsp;Security
                    Management&nbsp;&nbsp;<i class="fa-solid fa-shield-halved"></i></a></li>
            <li><a href="report.php"><i class="fa-solid fa-map"></i>&nbsp;&nbsp;Map Record&nbsp;&nbsp;<i
                        class="fa-solid fa-map"></i></a></li>
            <li><a href="report.php"><i class="fa-solid fa-file-invoice"></i>&nbsp;&nbsp;Visitor Record&nbsp;&nbsp;<i
                        class="fa-solid fa-file-invoice"></i></a></li>
            <li><a href="report.php"><i class="fa-solid fa-star"></i>&nbsp;&nbsp;Feedback Review&nbsp;&nbsp;<i
                        class="fa-solid fa-star"></i></a></li>
            <li><a href="logout.php"><i class="fa-solid fa-circle-xmark"></i>&nbsp;&nbsp;Log Out&nbsp;&nbsp;<i
                        class="fa-solid fa-circle-xmark"></i></a></li>
        </ul>
    </div>

    <script>
        // Get all <li> elements
        const liElements = document.querySelectorAll('li');

        // Loop through each <li> element and add the event listener
        liElements.forEach(function (element) {
            // Add event listener for hover
            element.addEventListener('mouseover', function () {
                // Find all <i> elements within the <li>
                const iconElements = this.querySelectorAll('i');

                // Add the "fa-bounce" class to all <i> elements
                iconElements.forEach(function (iconElement) {
                    iconElement.classList.add('fa-bounce');
                });
            });

            // Add event listener for mouseout (to remove the class)
            element.addEventListener('mouseout', function () {
                // Find all <i> elements within the <li>
                const iconElements = this.querySelectorAll('i');

                // Remove the "fa-bounce" class from all <i> elements
                iconElements.forEach(function (iconElement) {
                    iconElement.classList.remove('fa-bounce');
                });
            });
        });
    </script>
</body>

</html>