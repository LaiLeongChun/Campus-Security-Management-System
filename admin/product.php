<?php
	session_start();
	include ('../connection.php');

	$query = "SELECT * FROM product";
	$result = mysqli_query($condb, $query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Product</title>
	<link rel="stylesheet" href="../css/fontawesome.css">
	<link rel="stylesheet" href="../css/solid.css">
	<style>
		body {
            background-image: linear-gradient(to right, #74F2CE, #8dd699);
        }
        .container {
            justify-content: center;
            align-items: center;
			box-sizing: border-box;
            text-align: center;
            border-radius: 10px;
            padding: 15px;
        }
		.main th {
			font-family: 'Ubuntu', sans-serif;
		}
		.container th, .container td {
			padding: 8px;
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
			font-size: 35px;
		}

		div.main {
			text-align: center;
			padding:80px 0 80px 50px;
			margin:0 auto 0 auto;
		}
		div.main #last {
			text-align: left;
			line-height: 2;
			padding-left: 50px;
		}

	</style>
	<script>
		var edit = false;
		function openadd(num) {
			if (edit == true) {
				document.getElementById("action").value = "add";
				document.getElementById("id").value = num;
				document.getElementById("title").value = null;
				document.getElementById("developer").value = null;
				document.getElementById("publisher").value = null;
				document.getElementById("releasedate").value = null;
				document.getElementById("category").options[0].selected = true;
				document.getElementById("price").value = null;
				edit = false;
			}
			document.getElementById('last').hidden = false; 
		}

		function add() {
			var form = document.getElementById('add');
			var formData = new FormData(form);

			// Validate the form data
			if (formData.get('title') === '' || formData.get('price') === '' || formData.get('category') === '') {
				alert('Please fill in all required fields.');
				return;
			}

			var xhr = new XMLHttpRequest();

			// Prepare the request URL
			var url = '<?php echo $_SERVER["PHP_SELF"]; ?>';

			// Set up the AJAX request
			xhr.open('POST', url, true);

			// Define the callback function when the AJAX request completes
			xhr.onload = function() {
				if (xhr.status === 200) {
					alert("Record inserted successfully.");
					location.reload(true);
				} else {
					alert("Error inserting record: " + xhr.responseText);
				}
			};

			// Send the AJAX request with form data
			xhr.send(formData);
		}

		function canceladd() {
			document.getElementById("last").hidden = true;
		}

		function editInfo(id, n) {
			var row = document.getElementById('row-' + id);

			document.getElementById("action").value = "edit";
			document.getElementById("id").value = id;
			document.getElementById("title").value = row.cells[2].textContent;
			document.getElementById("trailer").value = row.cells[3].querySelector('iframe').src;
			document.getElementById("developer").value = row.cells[4].textContent;
			document.getElementById("publisher").value = row.cells[5].textContent;
			document.getElementById("releasedate").value = row.cells[6].textContent;
			dropdown = document.getElementById("category");
			for (var i = 0; i < dropdown.options.length; i++) {
				if (dropdown.options[i].value === row.cells[7].textContent) {
					dropdown.options[i].selected = true;
					break;
				}
			}
			document.getElementById("price").value = row.cells[8].textContent;

			document.getElementById("last").hidden = false;
			window.scrollTo(0, document.body.scrollHeight);
			edit = true;
		}

		function deleteInfo(id) {
		if (window.confirm("Are you sure you want to delete the information?")) {
			var xhr = new XMLHttpRequest();

			// Prepare the request URL
			var url = 'delete.php?type=product&id=' + id;

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
	<div class="main">
		<h1><u>Manage Product</u></h1>
		<table class="container">
			<tr style="font-family: 'Helvetica';">
                <th>ID</th>
				<th>Poster</th>
                <th>Banner/Name</th>
				<th>Trailer</th>
                <th>Developer</th>
                <th>Publisher</th>
                <th>Release Date</th>
                <th>Category</th>
				<th>Price</th>
				<th>Manage Slideshow</th>
                <th>Edit</th>
                <th>Delete</th>
			</tr>
			<?php
				$num = 0;
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr id='row-".$row['product_id']."'>";
					echo "<td>".$row['product_id']."</td>";
					echo "<td><img src='../image/".$row['poster']."' style='width:10em;'></td>";
					echo "<td><img src='../image/".$row['banner']."'><br/>";
					echo $row['product_name']."</td>";
					echo "<td><iframe src='".$row['trailer']."' width='260'></iframe></td>";
					echo "<td>".$row['developer']."</td>";
					echo "<td>".$row['publisher']."</td>";
					echo "<td>".$row['release_date']."</td>";
					echo "<td>".$row['category']."</td>";
					echo "<td>".$row['price']."</td>";
					echo "<td><a style='color:black;' href='showcase.php?id=".$row['product_id']."'><i class='fa-solid fa-arrow-up-right-from-square'></i></a></td>";
					echo "<td><i class='fa-solid fa-pen-to-square' onclick='editInfo(".$row['product_id'].",".$num.")'></i></td>";
					echo "<td><i class='fa-solid fa-trash-can' onclick='deleteInfo(".$row['product_id'].")'></i></td>";
					$num++;
					echo "</tr>";
				}
			?>
			<tr>
				<td><i class="fa-solid fa-circle-plus" onclick="openadd(<?php echo $num+1; ?>);"></i></td>
			</tr>
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
		<button onclick="window.location.href = 'dashboard.php';" style="margin: 15px 0 0 80px;">Back</button>
	</div>
	<?PHP
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$image = '../image/';
        	$text = '../description/';
			$id = $_POST['id'];
			if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
				$poster = "game".$id.".".pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);
				move_uploaded_file($_FILES['poster']['tmp_name'], $image.$poster);
			} else {
				$query = "SELECT poster FROM product WHERE product_id = ".$id;
				$result = mysqli_query($condb, $query);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$poster = $row['poster'];
				}
			}
			if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
				$banner = "banner".$id.".".pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['banner']['tmp_name'], $image.$banner);
			} else {
				$query = "SELECT banner FROM product WHERE product_id = ".$id;
				$result = mysqli_query($condb, $query);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$banner = $row['banner'];
				}
			}
			$title = $_POST['title'];
			$trailer = $_POST['trailer'];
            $developer = $_POST['developer'];
            $publisher = $_POST['publisher'];
			if (isset($_FILES['description']) && $_FILES['description']['error'] === UPLOAD_ERR_OK) {
				$description = $title.".".pathinfo($_FILES['description']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['description']['tmp_name'], $text.$description);
			} else {
				$query = "SELECT product_description FROM product WHERE product_id = ".$id;
				$result = mysqli_query($condb, $query);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$description = $row['product_description'];
				}
			}
            $date = $_POST['releasedate'];
            $category = $_POST['category'];
            $price = $_POST['price'];

			if ($_POST['action'] == "add") { 
				$query = "INSERT INTO product (product_id, poster, banner, product_name, trailer, developer, publisher, product_description, release_date, category, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($condb, $query);
                mysqli_stmt_bind_param($stmt, "isssssssssd", $id, $poster, $banner, $title, $trailer, $developer, $publisher, $description, $date, $category, $price);
				mysqli_stmt_execute($stmt);
            	mysqli_stmt_close($stmt);
			} else if ($_POST['action'] == "edit") {
				$query = "UPDATE product SET poster = ?, banner = ?, product_name = ?, trailer = ?, developer = ?, publisher = ?, product_description = ?, release_date = ?, category = ?, price = ? WHERE product_id = ?";
                $stmt = mysqli_prepare($condb, $query);
                mysqli_stmt_bind_param($stmt, "sssssssssid", $poster, $banner, $title, $trailer, $developer, $publisher, $description, $date, $category, $price, $id);
				mysqli_stmt_execute($stmt);
            	mysqli_stmt_close($stmt);
			} 
		} 
	?>
	<script>
	</body>
</html>