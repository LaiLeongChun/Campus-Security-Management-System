<?php
	session_start();
	include ('../connection.php');
?>

<!DOCTYPE html>
<html>
<head>	
    <title>Manage Review</title>
	<link rel="stylesheet" href="../css/fontawesome.css">
	<link rel="stylesheet" href="../css/solid.css">
	<style>
		body {
			background-image: linear-gradient(to right, #74F2CE, #8dd699);
        }
        #container {
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 10px;
            padding: 15px;
			margin: auto;
        }
		#container th, #container td {
			padding: 8px;
		}
		#container th {
			font-family: 'Ubuntu', sans-serif;
		}
        img {
            width: 200px;
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

		div.page {
			text-align: center;
			padding:80px 50px 80px 50px;
			height: 400px;
			margin:0 auto 0 auto;
		}

	</style>
	<script>
        function filterTable(category) {
            var table = document.getElementById("container");
            var rows = table.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var categoryCell = row.getElementsByTagName("td")[2];

                if (category === "all" || categoryCell.innerHTML === category) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        }

		function deleteInfo(id) {
			if (window.confirm("Are you sure you want to delete the information?")) {
				var xhr = new XMLHttpRequest();

				// Prepare the request URL
				var url = 'delete.php?type=rating&id=' + id;

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
</head>
<body>
	<?php include 'sidenav.php'?>
	<div class="page">
		<h1><u>Manage Review</u></h1>
		<div class="filter">
			<label for="category">Select Title:</label>
			<select id="category" onchange="filterTable(this.value)">
				<option value="all">All</option>
				<?php
					$query = "SELECT product_name FROM product";
					$result = mysqli_query($condb, $query);
					while ($row = $result->fetch_assoc()) {
						echo "<option value='".$row['product_name']."'>".$row['product_name']."</option>";
					}
				?>
			</select>
    	</div>
		<table id="container">
			<tr style="font-family: 'Helvetica';">
				<th>Review</th>
                <th>Rate level</th>
				<th>Product Name</th>
                <th>Customer Username</th>
				<th>Delete</th>
			</tr>
			<?php
				$query = "SELECT r.rating_id, r.review, r.rate_level, p.product_name, c.customer_username 
						  FROM rating r 
						  JOIN product p ON r.product_id = p.product_id
						  JOIN customer c ON r.customer_id = c.customer_id";
				$result = mysqli_query($condb, $query);
				$num = 0;
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr id='row-".$row['rating_id']."'>";
					echo "<td>".$row['review']."</td>";
					echo "<td>".$row['rate_level']."</td>";
					echo "<td>".$row['product_name']."</td>";
					echo "<td>".$row['customer_username']."</td>";
					echo "<td><i class='fa-solid fa-trash-can' onclick='deleteInfo(".$row['rating_id'].")'></i></td>";
					$num++;
					echo "</tr>";
				}
			?>
		</table>
		
		<div hidden id="last">
			<form id="add" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<input type="hidden" name="action" id="action" value="add">	
				<b>Product ID: </b><input type="number" value="<?php echo $num + 1 ?>" style="width: 10px;" name="id" id="id" readOnly><br/>
				<b>Poster: </b><input type="file" accept="image/*" name="poster" id="poster"><br/>
				<b>Banner: </b><input type="file" accept="image/*" name="banner" id="banner"><br/>
				<b>Title: </b><input type="text" name="title" id="title"><br/>
				<b>Trailer: </b><input type="text" name="trailer" id="trailer"> <i>*Insert video embed link here.</i><br/>
				<b>Developer: </b><input type="text" name="developer" id="developer"><br/>
				<b>Publisher: </b><input type="text" name="publisher" id="publisher"><br/>
				<b>Description: </b><input type="file" accept=".txt" name="description" id="description"> <i>*Insert a .txt file with description.</i><br/>
				<b>Release date: </b><input type="date" name="releasedate" id="releasedate"><br/>
				<b>Category: </b><select name="category" id="category">
					<option value="Open World">Open World</option>
					<option value="Survival">Survival</option>
					<option value="Role-Playing">Role-Playing</option>
					<option value="Horror">Horror</option>
					<option value="Fighting">Fighting</option>
				</select><br/>
				<b>Price: </b><input type="text" pattern="[0-9]+(\.[0-9]{1,2})?" inputmode="numeric" name="price" id="price"><br/>
				<i class="fa-solid fa-floppy-disk" onclick="add()"></i>&nbsp;
				<i class='fa-solid fa-xmark' onclick='canceladd()'></i>
			</form>
		</div>
		<button onclick="window.location.href = 'dashboard.php';" style="margin: 15px 0;">Back</button>
	</div>