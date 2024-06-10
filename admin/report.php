<?php
	session_start();
	include ('../connection.php');
?>

<!DOCTYPE html>
<html>
<head>	
    <title>Sales Report</title>
	<link rel="stylesheet" href="../css/fontawesome.css">
	<link rel="stylesheet" href="../css/solid.css">
	<style>
		canvas {
            padding: 0;
            margin: auto;
            display: block;  
        }

        body {
            background-image: linear-gradient(to right, #74F2CE,#8dd699);
        }

        h1 {
			font-family: 'Belanosima', sans-serif;
			font-size: 40px;
            text-align: center;
            margin-top: 70px;
		}

        button.back {
            display: inline-block;
            padding: 0.55em 1.4em;
            border: 0.1em solid #FFFFFF;
            margin: 20px 0 0 90vh;
            border-radius: 0.12em;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            color: #240c3f;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;      
        }

        button:hover {
            color: #fff9f9;
            background-color: #251212;
            
        }

        @media all and (max-width:30em) {
            button {
                display: block;
                margin: 0.4em auto;
            }
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            margin: 0 500px 0 350px;
            width: 135px;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 10px 16px;
            transition: 0.3s;
            font-family: 'Ubuntu', sans-serif;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

	</style>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.js"></script>
<body>
    <?php include 'sidenav.php' ?>
    <h1><u>Sales Report</u></h1>
    <div class="tab">
        <button id="defaultOpen" class="tablinks" onclick="openTab(event, 'Sales')">Sales</button>
        <button class="tablinks" onclick="openTab(event, 'Rating')">Rating</button>
    </div>
    <div id="Sales" class="tabcontent">
        <canvas id="myChartSales" style="width: 100%; max-width: 900px;"></canvas>
    </div>
    <div id="Rating" class="tabcontent">
        <canvas id="myChartRating" style="width: 100%; max-width: 900px;"></canvas>
    </div>
    <?php
        // Create data for sales chart
        $query = "SELECT product_id, product_name FROM product";
        $result = mysqli_query($condb, $query);

        // Create empty arrays to store the retrieved data
        $xValuesSales = [];
        $yValuesSales = [];

        // Fetch the data and populate the arrays
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            
            // Query to retrieve sales count for each product
            $sales_query = "SELECT COUNT(*) AS count FROM purchased WHERE product_id = ".$product_id;
            $sales_result = mysqli_query($condb, $sales_query);
            $sales_row = mysqli_fetch_assoc($sales_result);
            $sales_count = $sales_row['count'];
        
            $xValuesSales[] = $row['product_name'];
            $yValuesSales[] = $sales_count;
        }

        // Create data for rating chart
        $query = "SELECT product_id, product_name FROM product";
        $result = mysqli_query($condb, $query);

        // Create empty arrays to store the retrieved data
        $xValuesRating = [];
        $yValuesRating = [];

        // Fetch the data and populate the arrays
        while ($row = mysqli_fetch_assoc($result)) {
            #Calculating Reviews Mark 
            $total_score = 0;
            $no_rating = 0;
            $review_score_sql = "SELECT * from rating WHERE product_id = ".$row['product_id'];
            $review_score_query = mysqli_query($condb, $review_score_sql);
            if (mysqli_num_rows($review_score_query) != 0)
            {
                while ($review_score_record = mysqli_fetch_array($review_score_query))
                {
                    $total_score = $total_score + $review_score_record['rate_level'];
                }
                $no_rating = mysqli_num_rows($review_score_query);
                $total_score = $total_score / $no_rating;
                $total_score = round($total_score, 2);
            } else {
                $total_score = 0;
            }
            
            $xValuesRating[] = $row['product_name'];
            $yValuesRating[] = $total_score;
        }
    ?>
    <script>
        // Initialize the chart when the Sales tab is opened
        function openSalesTab() {
            var xValues = <?php echo json_encode($xValuesSales); ?>;
            var yValues = <?php echo json_encode($yValuesSales); ?>;
            
            var salesChart = new Chart("myChartSales", {
                type: "bar",
                data: {
                labels: xValues,
                datasets: [{
                    data: yValues
                }]
                },
                options: {
                    scales: {
                        y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // Set the desired step size for y-axis ticks
                            precision: 0 // Set the number of decimal places to 0
                        }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        title: {
                        display: true,
                        text: "Sales Chart"
                        }
                    },
                    minBarLength: 4
                }
            });

            return salesChart;
        }

        // Initialize the chart when the Rating tab is opened
        function openRatingTab() {
            var xValues = <?php echo json_encode($xValuesRating); ?>;
            var yValues = <?php echo json_encode($yValuesRating); ?>;
            
            var ratingChart = new Chart("myChartRating", {
                type: "bar",
                data: {
                labels: xValues,
                datasets: [{
                    data: yValues
                }]
                },
                options: {
                plugins: {
                    legend: { display: false },
                    title: {
                    display: true,
                    text: "Rating Chart"
                    }
                },
                minBarLength: 4
                }
            });

            return ratingChart;
        }

        document.getElementById("defaultOpen").click();
        var salesChart; // Global variable to store the Sales chart instance
        var ratingChart; // Global variable to store the Rating chart instance

        function openTab(evt, tabName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";

            if (salesChart) {
                salesChart.destroy();
            }
            if (ratingChart) {
                ratingChart.destroy();
            }

            // Initialize the chart based on the opened tab
            if (tabName === "Sales") {
                salesChart = openSalesTab();
            } else if (tabName === "Rating") {
                ratingChart = openRatingTab();
            }
        }

    </script>
    <button class="back" onclick="history.back()">Back</button>
  </body>
</html>
