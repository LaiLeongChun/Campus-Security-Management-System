<?php
	session_start();
	include ('../connection.php');

	$query = "SELECT * FROM customer";
	$result = mysqli_query($condb, $query);
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Manage Customer</title>
	
	<link rel="stylesheet" href="../css/fontawesome.css">
	<link rel="stylesheet" href="../css/solid.css">
	<style>
		body {
            background-image: linear-gradient(to right, #74F2CE, #8dd699);
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
			box-sizing: border-box;
        }
        .main table {
            text-align: center;
            border-radius: 10px;
            padding: 15px;
            max-width: 1000px;
            width: 100%;
			margin: 0 auto;
			box-sizing: border-box;
        }
		.main th,.main td {
			padding: 8px;
		}
		.main th {
			font-family: 'Ubuntu', sans-serif;
		}
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
		}
		i {
			cursor: pointer;
		}

		button {
			display:inline-block;
			padding:0.55em 1.4em;
			border:0.1em solid #FFFFFF;
			margin:0 0.3em 0.3em 0;
			border-radius:0.12em;
			box-sizing: border-box;
			text-decoration:none;
			font-family:'Roboto',sans-serif;
			font-weight:300;
			color:#240c3f;
			text-align:center;
			transition: all 0.3s;
			cursor: pointer;
		}

		button:hover {
			color:#fff9f9;
			background-color:#251212;
		}

		@media all and (max-width:30em){
			button {
				display:block;
				margin:0.4em auto;
			}
		}

		h1 {
			font-family: 'Belanosima', sans-serif;
			font-size: 40px;
		}

		div.main {
			text-align: center;
			padding:80px 50px 80px 50px;
			width:1000px;
			height: 400px;
			margin:0 auto 0 auto;
		}
	</style>
</head>
<body>
	<?php include 'sidenav.php'?>
	<div class="main">
		<h1><u>Manage Customer</u></h1>
		<table width="1000px" class="container">
			<tr style="font-family: 'Helvetica';">
				<th>ID</th>
				<th>Name</th>
				<th>Password</th>
				<th>Profile Picture</th>
				<th>Description</th>
				<th>Display Name</th>
				<th>Email</th>
                <th>Customer Token</th>
				<th>Product Owned</th>
				<th>Delete</th>
			</tr>
			<?php
				$num = 0;
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr id='row-".$row['customer_id']."'>";
					echo "<td>".$row['customer_id']."</td>";
					echo "<td>".$row['customer_username']."</td>";
					echo "<td>".$row['customer_password']."</td>";
                    if ($row['user_profile'] == null) {
                        echo "<td> </td>";
                    } else {
                        echo "<td><img src='data:image/png;charset=utf8;base64,".base64_encode($row['user_profile'])."'width='140'></td>";
                    }
					echo "<td>".$row['customer_description']."</td>";
					echo "<td>".$row['display_name']."</td>";
					echo "<td>".$row['customer_email']."</td>";
                    echo "<td>".$row['customer_token']."</td>";
					echo "<td>".$row['product_owned']."</td>";
					echo "<td><i class='fa-solid fa-trash-can' onclick='deleteInfo(".$row['customer_id'].")'></i></td>";
					$num++;
					echo "</tr>";
				}
			?>
		</table>
		<button onclick="window.location.href = 'dashboard.php';" style="margin: 15px 0;">Back</button>
	</div>
	<script>
		function deleteInfo(id) {
		if (window.confirm("Are you sure you want to delete the information?")) {
			var xhr = new XMLHttpRequest();

			// Prepare the request URL
			var url = 'delete.php?type=customer&id=' + id;

			// Set up the AJAX request
			xhr.open('GET', url, true);

			// Define the callback function when the AJAX request completes
			xhr.onload = function() {
				if (xhr.status === 200) {
					alert("Information has been deleted.");
					location.reload();
				} else {
					alert("Error deleting record: " + xhr.responseText);
				}
			};

			// Send the AJAX request
			xhr.send();
		}
	}
	</script>
	</body>
</html>