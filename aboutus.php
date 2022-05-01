<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
	<!-- Stylesheets/CDN Area Start ============================================= -->
	<?php
	$page = 'about us';
	require_once('includes/cdn.php');
	?>
	<!-- Stylesheets/CDN Area End ============================================= -->
</head>

<body class="stretched">
	<!-- Document Wrapper ============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- On LOad Modal Area Start-->
		<?php
		require_once('includes/onloadmodal.php');
		?>
		<!-- On LOad Modal Area End-->

		<!-- Top Bar Area Start ============================================= -->
		<?php
		require_once('includes/topbar.php');
		?>
		<!-- Top Bar Area End ============================================= -->

		<!-- Navbar Area Start ============================================= -->
		<?php
		require_once('includes/navbar.php');
		?>
		<!-- Navbar Area end -->


		<!--Banner Slider area start ============================================= -->
		<?php
		require_once('includes/mainslider.php');
		?>
		<!-- Banner Slider area End -->


		<!-- Content ============================================= -->
		<section id="content">
			<div class="container">
				<div class="row mt-3">
					<div class="col-xs-2 px-2">
						<img style="width: 100%; height:100%" src="./cat/0download.jpg" alt="Mister Marbles head tilt">
					</div>
					<div class="col-xs-2 px-2">
						<img style="width: 100%; height:100%" src="./cat/0download.jpg" alt="Kermit the Dog">
					</div>
					<div class="col-xs-2 px-2">
						<img style="width: 100%; height:100%" src="./cat/0download.jpg" alt="Peach posing magestically">
					</div>
					<div class="col-xs-2 px-2">
						<img style="width: 100%; height:100%" src="./cat/0download.jpg" alt="Peach posing magestically">
					</div>
				</div>
			</div>


		</section>
		<!-- #content end -->

		<!-- Footer Section Start============================================= -->
		<?php
		require_once('includes/footer.php');
		?>
		<!-- Footer Section Start============================================= -->
	</div>
	<!-- #wrapper end -->

	<!-- Go To Top ============================================= -->
	<div id="gotoTop" class="icon-line-arrow-up"></div>
	<!-- Scripts Section Area Start============================================= -->
	<?php
	require_once('includes/scripts.php');
	?>
	<!--- sweet alert popup area --->
	<?php
	if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
	?>
		<?php
		$id = $_SESSION['id'];
		$username_fetch = "SELECT name FROM user WHERE id = '$id' ";
		$result_username = mysqli_query($con, $username_fetch);
		$particular_user = mysqli_num_rows($result_username);

		$username = "";
		if ($result_username != 0) {
			while ($result_u = mysqli_fetch_assoc($result_username)) {
				$username = $result_u['name'];
			}
		} else {
			"No Records Found!!!";
		}

		?>
		<script>
			swal.fire({
				title: "<?php echo $_SESSION['status'] . "&nbsp;" . "$username"; ?>",
				//text: "Category added successfully!",
				icon: "<?php echo $_SESSION['status_code']; ?>",
				button: "Ok!",
			});
		</script>
	<?php
		unset($_SESSION['status']);
	}
	?>
	<!--- sweet alert popup area end --->
	<!--- sweet alert popup area --->
	<?php
	if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
	?>
		<script>
			swal.fire({
				position: 'top-end',
				icon: "<?php echo $_SESSION['status_code']; ?>",
				title: "<?php echo $_SESSION['status']; ?>",
				showConfirmButton: false,
				timer: 4000
			});
		</script>
	<?php
		unset($_SESSION['status']);
	}
	?>
	<!--- sweet alert popup area end --->
	<!-- Scripts Section Area End============================================= -->
</body>

</html>