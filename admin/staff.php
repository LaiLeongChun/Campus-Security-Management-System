<?php
	session_start();
	include ('../connection.php');

	$query = "SELECT * FROM admin";
	$result = mysqli_query($condb, $query);
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Manage Staff</title>
	
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
		<h1><u>Manage Staff</u></h1>
		<table width="1000px" class="container">
			<tr style="font-family: 'Helvetica';">
				<th>ID</th>
				<th>Name</th>
				<th>Date Joined</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Username</th>
				<th>Password</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php
				$num = 0;
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr id='row-".$row['admin_id']."'>";
					echo "<td>".$row['admin_id']."</td>";
					echo "<td>".$row['admin_name']."</td>";
					echo "<td>".$row['date_joined']."</td>";
					echo "<td>".$row['admin_email']."</td>";
					echo "<td>".$row['phone_number']."</td>";
					echo "<td>".$row['admin_username']."</td>";
					echo "<td>".$row['admin_password']."</td>";
					echo "<td><i class='fa-solid fa-pen-to-square' onclick='editInfo(".$row['admin_id'].",".$num.")'></i></td>";
					echo "<td><i class='fa-solid fa-trash-can' onclick='deleteInfo(".$row['admin_id'].")'></i></td>";
					$num++;
					echo "</tr>";
				}
			?>
			<tr hidden id="last">
				<form id="add" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<input type="hidden" name="action" value="add">
					<td><input type="number" id="new-id" value="<?php echo $num + 1 ?>" style="width: 30px;" name="id"></td>
					<td><input type="text" id="new-name" name="name" required></td>
					<td><input type="date" id="new-joineddate" name="joineddate"></td>
					<td><input type="email" id="new-email" name="email"></td>
					<td><input type="text" id="new-phone" pattern="[0-9]{10,11}" name="phone"></td>
					<td><input type="text" id="new-username" name="username" required></td>
					<td><input type="password" id="new-pw" name="pw" required></td>
					<td><i class="fa-solid fa-floppy-disk" onclick="add()"></i></td>
					<td><i class='fa-solid fa-xmark' onclick='canceladd()'></i></td>
				</form>
			</tr>
			<tr>
				<td><i class="fa-solid fa-circle-plus" onclick="document.getElementById('last').hidden = false;"></i></td>
			</tr>
		</table>
		<button onclick="window.location.href = 'dashboard.php';" style="margin: 15px 0;">Back</button>
	</div>
	<?php 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$id = $_POST['id'];
			$name = $_POST['name'];
			$joineddate = $_POST['joineddate'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$username = $_POST['username'];
			$pw = $_POST['pw'];

			if ($_POST['action'] == "add") {
				$query = "INSERT INTO admin (admin_id, admin_name, date_joined, admin_email, phone_number, admin_username, admin_password)
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($condb, $query);
                mysqli_stmt_bind_param($stmt, "issssss", $id, $name, $joineddate, $email, $phone, $username, $pw);
				mysqli_stmt_execute($stmt);
            	mysqli_stmt_close($stmt);
			} else if ($_POST['action'] == "edit") {
				$query = "UPDATE admin SET admin_name = ?, date_joined = ?, admin_email = ?, phone_number = ?, admin_username = ?, admin_password = ?
                          WHERE admin_id = ?";
                $stmt = mysqli_prepare($condb, $query);
                mysqli_stmt_bind_param($stmt, "ssssssi", $name, $joineddate, $email, $phone, $username, $pw, $id);
				mysqli_stmt_execute($stmt);
            	mysqli_stmt_close($stmt);
			}
		  }
	?>
	<script>
		function add() {
			var form = document.getElementById('add');
			var formData = new FormData(form);
			var xhr = new XMLHttpRequest();

			// Prepare the request URL
			var url = '<?php echo $_SERVER["PHP_SELF"]; ?>';

			// Set up the AJAX request
			xhr.open('POST', url, true);

			// Define the callback function when the AJAX request completes
			xhr.onload = function() {
				if (xhr.status === 200) {
					alert("Record inserted successfully.");
					location.reload();
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
			
			// Create a new row with a form for editing
			var newRow = document.createElement('tr');
			newRow.id = 'edit-row-' + id;
			
			// Create form elements and set their values
			var idInput = createInput('number', 'id', id);
			idInput.style.width = '50px'; // Adjust the width of the ID input
			var nameInput = createInput('text', 'name', row.cells[1].textContent);
			var joinedDateInput = createInput('date', 'joineddate', row.cells[2].textContent);
			var emailInput = createInput('email', 'email', row.cells[3].textContent);
			var phoneInput = createInput('text', 'phone', row.cells[4].textContent);
			var usernameInput = createInput('text', 'username', row.cells[5].textContent);
			var passwordInput = createInput('password', 'pw', row.cells[6].textContent);
			
			// Create save and cancel icons
			var saveIcon = createIcon('fa-solid fa-check', saveInfo.bind(null, id, n));
			var cancelIcon = createIcon('fa-solid fa-times', cancelEdit.bind(null, id, n));
			
			// Create table cells and append form elements and icons
			var idCell = createCell(idInput);
			var nameCell = createCell(nameInput);
			var joinedDateCell = createCell(joinedDateInput);
			var emailCell = createCell(emailInput);
			var phoneCell = createCell(phoneInput);
			var usernameCell = createCell(usernameInput);
			var passwordCell = createCell(passwordInput);
			var saveCell = createCell(saveIcon);
			var cancelCell = createCell(cancelIcon);
			
			// Append cells to the new row
			newRow.appendChild(idCell);
			newRow.appendChild(nameCell);
			newRow.appendChild(joinedDateCell);
			newRow.appendChild(emailCell);
			newRow.appendChild(phoneCell);
			newRow.appendChild(usernameCell);
			newRow.appendChild(passwordCell);
			newRow.appendChild(saveCell);
			newRow.appendChild(cancelCell);
			
			// Replace the row with the new row
			row.parentNode.insertBefore(newRow, row.nextSibling);
			row.style.display = 'none';
		}

		function createIcon(iconClass, clickHandler) {
			var icon = document.createElement('i');
			icon.className = iconClass;
			icon.style.cursor = 'pointer';
			icon.addEventListener('click', clickHandler);
			return icon;
		}

		function createButton(iconClass, text) {
			var button = document.createElement('button');
			button.type = 'button';
			button.innerHTML = '<i class="' + iconClass + '"></i> ' + text;
			return button;
		}

		function createInput(type, name, value) {
			var input = document.createElement('input');
			input.type = type;
			input.name = name;
			input.value = value;
			return input;
		}

		function createCell(element) {
			var cell = document.createElement('td');
			cell.appendChild(element);
			return cell;
		}

		function saveInfo(id, n) {
			// Retrieve the form inputs
			var form = document.getElementById('edit-row-' + id);
			var idInput = form.querySelector('input[name="id"]');
			var nameInput = form.querySelector('input[name="name"]');
			var joinedDateInput = form.querySelector('input[name="joineddate"]');
			var emailInput = form.querySelector('input[name="email"]');
			var phoneInput = form.querySelector('input[name="phone"]');
			var usernameInput = form.querySelector('input[name="username"]');
			var passwordInput = form.querySelector('input[name="pw"]');

			// Perform validation on the form inputs
			if (!nameInput.value || !usernameInput.value || !passwordInput.value) {
				alert("Please fill in all required fields.");
				return;
			}

			var formData = new FormData();
			formData.append('id', idInput.value);
			formData.append('name', nameInput.value);
			formData.append('joineddate', joinedDateInput.value);
			formData.append('email', emailInput.value);
			formData.append('phone', phoneInput.value);
			formData.append('username', usernameInput.value);
			formData.append('pw', passwordInput.value);
			formData.append('action', 'edit');

			var xhr = new XMLHttpRequest();

			// Prepare the request URL with the ID as a query parameter
			var url = '<?php echo $_SERVER["PHP_SELF"]; ?>';


			// Set up the AJAX request
			xhr.open('POST', url, true);

			// Define the callback function when the AJAX request completes
			xhr.onload = function() {
				if (xhr.status === 200) {
					alert("Record updated successfully.");
					location.reload();
				} else {
					alert("Error updating record: " + xhr.responseText);
				}
			};

			// Send the AJAX request with form data
			xhr.send(formData);
		}


		function cancelEdit(id, n) {
			var row = document.getElementById('row-' + id);
			var editRow = document.getElementById('edit-row-' + id);
			
			// Show the original row and remove the edit row
			row.style.display = '';
			editRow.parentNode.removeChild(editRow);
		}

		function deleteInfo(id) {
		if (window.confirm("Are you sure you want to delete the information?")) {
			var xhr = new XMLHttpRequest();

			// Prepare the request URL
			var url = 'delete.php?type=admin&id=' + id;

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