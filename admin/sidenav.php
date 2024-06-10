<html>
    <head>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Belanosima&family=Poppins&family=Ubuntu&display=swap');
            /* The side navigation menu */
            .sidenav {
                height: 100%; /* 100% Full-height */
                width: 70px;
                position: fixed; /* Stay in place */
                z-index: 1; /* Stay on top */
                top: 0; /* Stay at the top */
                left: 0;
                font-family: 'Poppins', sans-serif;
                background-color: LimeGreen;
                overflow-x: hidden; /* Disable horizontal scroll */
                padding-top: 60px; /* Place content 60px from the top */
                transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
            }

            /* The navigation menu links */
            .sidenav a:not(a.logout) {
                padding: 8px 8px 8px 23px;
                text-decoration: none;
                font-size: 22px;
                color: black;
                display: flex;
                transition: 0.3s;
                white-space: nowrap;
            }

            .sidenav a.logout {
                transition: 0.3s;
                text-decoration: none;
                color: black;
            }

            .fa-solid:not(.sidenav .fa-solid) {
                transition: all 0.2s;
            }
            .fa-solid:not(.sidenav .fa-solid):hover {
                color: #737373;
            }
        </style>
    </head>
    <body>
        <div id="mySidenav" class="sidenav">
            <table>
            <tr>
                    <td><a href="customer.php" class="fa-solid fa-user-group" style="padding-left:17px;"></a></td>
                    <td><a href="customer.php">Manage customer</a></td>
                </tr>
                <tr>
                    <td><a href="staff.php" class="fa-solid fa-clipboard-user"></a></td>
                    <td><a href="staff.php">Manage staff</a></td>
                </tr>
                <tr>
                    <td><a href="product.php" class="fa-solid fa-gamepad" style="padding-left:17px;"></a></td>
                    <td><a href="product.php">Manage product</a></td>
                </tr>
                <tr>
                    <td><a href="review.php" class="fa-solid fa-star" style="padding-left:18px;"></a></td>
                    <td><a href="review.php">Manage review</a></td>
                </tr>
                <tr>
                    <td><a href="report.php" class="fa-solid fa-file-invoice"></a></td>
                    <td><a href="report.php">View sales report</a></td>
                </tr>
            </table>
            <table style="position:absolute;bottom:60px;left:0;margin:7px;white-space: nowrap;">
                </tr>
                    <td><img src="../image/logo.png" style="width:50px;"></td>
                    <td style="padding-left:10px;">Welcome, <?php echo $_SESSION['admin_name']?><br>
                    <a href="logout.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Log out?</a></td>
                </tr>
            </table>
        </div>
        <script>
            /* Set the width of the side navigation to 250px and keep it open */
            function openNav() {
                document.getElementById("mySidenav").style.width = "350px";
            }

            /* Set the width of the side navigation to 0 and close it */
            function closeNav() {
                document.getElementById("mySidenav").style.width = "70px";
            }

            /* Add event listener for mouseover to trigger openNav() */
            document.getElementById("mySidenav").addEventListener('mouseover', openNav);

            /* Add event listener for mouseout to trigger closeNav() */
            document.getElementById("mySidenav").addEventListener('mouseout', closeNav);

            const rows = document.querySelectorAll('tr');

            rows.forEach(function(row) {
            const links = row.querySelectorAll('.sidenav a');

            row.addEventListener('mouseover', function() {
                links.forEach(function(link) {
                link.style.color = '#f1f1f1';
                });
            });

            row.addEventListener('mouseout', function() {
                links.forEach(function(link) {
                link.style.color = 'black';
                });
            });
		    });	
	    </script>
    </body>
</html>