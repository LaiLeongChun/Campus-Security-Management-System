<?php
	session_start();
	include ('../connection.php');
	$query = "SELECT trailer FROM product WHERE product_id = ".$_GET['id'];
	$result = mysqli_query($condb, $query);
	if ($row = mysqli_fetch_array($result)) {
		$trailer = $row['trailer'];
	} else {
		$trailer = null;
	}

	$showcase_execute = "SELECT * FROM showcase WHERE product_id = ".$_GET['id']."";
	$showcase = mysqli_query($condb, $showcase_execute);
	$record = mysqli_fetch_array($showcase);
?>

<!DOCTYPE html>
<html>
<head>	
	<title>Manage Slideshow</title>
	<link rel="stylesheet" href="../css/fontawesome.css">
	<link rel="stylesheet" href="../css/solid.css">
	<link rel="stylesheet" href="../css/gallery.css">
	<style>
		body {
			background-image: linear-gradient(to right, #74F2CE, #8dd699);
		}

		i {
			cursor: pointer;
		}

		h1 {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 35px;
			text-align: center;
			margin-top: 50px;
		}

		div.container {
			margin: 0 100px;
			float: left;
		}

		.play-icon {
			position: absolute;
			transform: translate(-450%, 120%);
			z-index: 1;
			color: white;
			pointer-events: none;
		}
	</style>
</head>
<body>
	<div>
		<h1><u>Manage Slideshow</u></h1>
		<div class='container'>
			<?php if ($record) { ?>
				<div class='mySlides'>
					<iframe width='560' height='315' src='<?php echo $trailer ?>'
							title='YouTube video player' frameborder='0'
							allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
							allowfullscreen>
					</iframe>
				</div>

				<div class='mySlides'>
					<img src='<?php echo $record['showcase1'] ?>'
							style='width:100%'>
				</div>

				<div class='mySlides'>
					<img src='<?php echo $record['showcase2'] ?>'
							style='width:100%'>
				</div>

				<div class='mySlides'>
					<img src='<?php echo $record['showcase3'] ?>'
							style='width:100%'>
				</div>

				<div class='mySlides'>
					<img src='<?php echo $record['showcase4'] ?>'
							style='width:100%'>
				</div>

				<div class='mySlides'>
					<img src='<?php echo $record['showcase5'] ?>'
							style='width:100%'>
				</div>

				<!-- Next and previous buttons -->
				<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
				<a class='next' onclick='plusSlides(1)'>&#10095;</a>

				<!-- Thumbnail images -->
				<div class='row'>
					<div class='column'>
						<img class='demo cursor'
								src='<?php echo $record['trailer_thumbnail'] ?>'
								style='width:100%' onclick='currentSlide(1)'>
						<i class='fa-solid fa-play play-icon'></i>
					</div>
					<div class='column'>
						<img class='demo cursor'
								src='<?php echo $record['showcase1'] ?>'
								style='width:100%' onclick='currentSlide(2)'>
					</div>
					<div class='column'>
						<img class='demo cursor'
								src='<?php echo $record['showcase2'] ?>'
								style='width:100%' onclick='currentSlide(3)'>
					</div>
					<div class='column'>
						<img class='demo cursor'
								src='<?php echo $record['showcase3'] ?>'
								style='width:100%' onclick='currentSlide(4)'>
					</div>
					<div class='column'>
						<img class='demo cursor'
								src='<?php echo $record['showcase4'] ?>'
								style='width:100%' onclick='currentSlide(5)'>
					</div>
					<div class='column'>
						<img class='demo cursor'
								src='<?php echo $record['showcase5'] ?>'
								style='width:100%' onclick='currentSlide(6)'>
					</div>
				</div>
			<?php } else { ?>
				<p>No slideshow available.</p>
			<?php } ?>
		</div>
		<p>Modify the slideshow as desired in the form below. (Only accepts image links)</p>
		<form action="<?php echo $_SERVER['PHP_SELF']."?id=".$_GET['id']."&cache=".time(); ?>" method="post">
			<table>
				<input type="hidden" name="product" value="<?php echo $_GET['id']; ?>">
				<?php if ($record) { ?>
					<input type="hidden" name="action" value="edit">
                    <tr>
						<td>
							<label for="img1">Image 1</label><br>
							<input type="text" id="img1" name="img1" value="<?php echo $record['showcase1']; ?>">
						</td>
						<td>
							<label for="img2">Image 2</label><br>
							<input type="text" id="img2" name="img2" value="<?php echo $record['showcase2']; ?>">
						</td>
						<td>
							<label for="img3">Image 3</label><br>
							<input type="text" id="img3" name="img3" value="<?php echo $record['showcase3']; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label for="img4">Image 4</label><br>
							<input type="text" id="img4" name="img4" value="<?php echo $record['showcase4']; ?>">
						</td>
						<td>
							<label for="img5">Image 5</label><br>
							<input type="text" id="img5" name="img5" value="<?php echo $record['showcase5']; ?>">
						</td>
					</tr>
					<tr>
						<td style="padding-top:20px;">
							<label for="trailer">Trailer thumbnail</label><br>
							<input type="text" id="trailer" name="trailer" value="<?php echo $record['trailer_thumbnail']; ?>">
						</td>
					</tr>
				<?php } else { ?>
					<input type="hidden" name="action" value="add">
                    <tr>
						<td>
							<label for="img1">Image 1</label><br>
							<input type="text" id="img1" name="img1">
						</td>
						<td>
							<label for="img2">Image 2</label><br>
							<input type="text" id="img2" name="img2">
						</td>
						<td>
							<label for="img3">Image 3</label><br>
							<input type="text" id="img3" name="img3">
						</td>
					</tr>
					<tr>
						<td>
							<label for="img4">Image 4</label><br>
							<input type="text" id="img4" name="img4">
						</td>
						<td>
							<label for="img5">Image 5</label><br>
							<input type="text" id="img5" name="img5">
						</td>
					</tr>
					<tr>
						<td style="padding-top:20px;">
							<label for="trailer">Trailer thumbnail</label><br>
							<input type="text" id="trailer" name="trailer">
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<input type="submit" value="Save">
						<button type="button" onclick="window.location.href = 'product.php';" style="margin: 15px 0;">Back</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<?php 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$product = $_POST['product'];
			$img1 = $_POST['img1'];
			$img2 = $_POST['img2'];
			$img3 = $_POST['img3'];
			$img4 = $_POST['img4'];
			$img5 = $_POST['img5'];
			$trailer = $_POST['trailer'];

			if ($_POST['action'] == "edit") {
                $query = "UPDATE showcase SET showcase1 = ?, showcase2 = ?, showcase3 = ?, showcase4 = ?, showcase5 = ?, trailer_thumbnail = ?
                          WHERE product_id = ?";
                $stmt = mysqli_prepare($condb, $query);
                mysqli_stmt_bind_param($stmt, "ssssssi", $img1, $img2, $img3, $img4, $img5, $trailer, $product);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else if ($_POST['action'] == "add") {
                $query = "SELECT count(*) AS count FROM showcase WHERE product_id = ".$product;
                $result = mysqli_query($condb, $query);
                if (mysqli_fetch_array($result)['count'] == 0) {      
                    $query = "INSERT INTO showcase (showcase_id, product_id, showcase1, showcase2, showcase3, showcase4, showcase5, trailer_thumbnail)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($condb, $query);
                    mysqli_stmt_bind_param($stmt, "iissssss", $product, $product, $img1, $img2, $img3, $img4, $img5, $trailer);    
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
            }
			echo "Your changes have been saved. Refresh the page again to see the change here.";
		}
	?>
	<script>
		let slideIndex = 1;
		showSlides(slideIndex);

		// Next/previous controls
		function plusSlides(n) {
			showSlides(slideIndex += n);
		}

		// Thumbnail image controls
		function currentSlide(n) {
			showSlides(slideIndex = n);
		}

		function showSlides(n) {
			let i;
			let slides = document.getElementsByClassName("mySlides");
			let dots = document.getElementsByClassName("demo");
			let captionText = document.getElementById("caption");
			if (n > slides.length) { slideIndex = 1 }
			if (n < 1) { slideIndex = slides.length }
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex - 1].style.display = "block";
			dots[slideIndex - 1].className += " active";
			captionText.innerHTML = dots[slideIndex - 1].alt;
		}
	</script>
</body>
</html>
