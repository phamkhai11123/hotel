<?php
session_start();
if (!isset($_SESSION["user"])) {
	header("location:login.php");
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- Bootstrap Styles-->
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FontAwesome Styles-->
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<!-- Custom Styles-->
	<link href="assets/css/custom-styles.css" rel="stylesheet" />
	<!-- Google Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
	<div id="wrapper">
		<nav class="navbar navbar-default top-navbar" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="home.php">Menu chính </a>
			</div>

			<ul class="nav navbar-top-links navbar-right">

				<li class="dropdown">
				<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
				</li>
				</li>
			</ul>
		</nav>
		<!--/. NAV TOP  -->
		<nav class="navbar-default navbar-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav" id="main-menu">

					<!-- <li><a  class="active-menu" href="usersetting.php" ><i class="fa fa-pencil-square-o" autofocus></i>Tài khoản</a></li> -->
					<li>
						<a class="active-menu" href="settings.php" style="background-color: #225081"><i class="fa fa-dashboard"></i>Trạng thái phòng</a>
					</li>
					<li>
						<a href="room.php"><i class="fa fa-plus-circle"></i>Thêm phòng</a>
					</li>
					<li>
						<a href="roomdel.php"><i class="fa fa-pencil-square-o"></i> Xóa phòng</a>
					</li>
					<li><a href="home.php"><i class="fa fa-sign-out fa-fw"></i>Home</a></li>


			</div>

		</nav>
		<!-- /. NAV SIDE  -->

		<div id="page-wrapper">
			<div id="page-inner">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-header">
							Phòng còn trống <small></small>
						</h1>
					</div>
				</div>


				<?php
				include('db.php');
				$sql = "select * from room where cusid is null";
				$re = mysqli_query($con, $sql);


				
				?>
				<div class="row">
					<?php

					while ($row = mysqli_fetch_array($re)) {
						$id = $row['id'];
						$type = $row['type'];
						if ($type == "Phòng cao cấp") {
							echo "<div class='col-md-3 col-sm-12 col-xs-12'>
													<div class='panel panel-primary text-center no-boder bg-color-blue'>
														<div class='panel-body'>
															<i class='fa fa-users fa-5x'></i>
															<h3>" . $row['bedding'] . "</h3>
														</div>
														<div class='panel-footer back-footer-blue'>
															" . $row['type'] . "

															<br>
															<button  class='btn btn-primary btn' data-toggle='modal' data-target='#updateModal' data-id='" . $id . "'>
													Cập nhật
													</button>
														</div>
													</div>
												</div>";
						}  if ($type == "Phòng sang trọng") {
							echo "<div class='col-md-3 col-sm-12 col-xs-12'>
													<div class='panel panel-primary text-center no-boder bg-color-green'>
														<div class='panel-body'>
															<i class='fa fa-users fa-5x'></i>
															<h3>" . $row['bedding'] . "</h3>
														</div>
														<div class='panel-footer back-footer-green'>
															" . $row['type'] . "
															<br>
															<button  class='btn btn-primary btn-update' data-toggle='modal' data-target='#updateModal' data-id='" . $id . "'>
															Cập nhật
													</button>

														</div>
													</div>
												</div>";
						}  if ($type == "Phòng khách") {
							echo "<div class='col-md-3 col-sm-12 col-xs-12'>
													<div class='panel panel-primary text-center no-boder bg-color-brown'>
														<div class='panel-body'>
															<i class='fa fa-users fa-5x'></i>
															<h3>" . $row['bedding'] . "</h3>
														</div>
														<div class='panel-footer back-footer-brown'>
															" . $row['type'] . "

															<br>

															<button  class='btn btn-primary btn' data-toggle='modal' data-target='#updateModal' data-id='" . $id . "'>
															Cập nhật
															</button>
														</div>
													</div>
												</div>";
						}  if ($type == "Phòng đơn") {
							echo "<div class='col-md-3 col-sm-12 col-xs-12'>
													<div class='panel panel-primary text-center no-boder bg-color-red'>
														<div class='panel-body'>
															<i class='fa fa-users fa-5x'></i>
															<h3>" . $row['bedding'] . "</h3>
														</div>
														<div class='panel-footer back-footer-red'>
															" . $row['type'] . "
														<br>
															<button class='btn btn-primary btn' data-toggle='modal' data-target='#updateModal' data-id='" . $id . "'>
															Cập nhật
													</button>
														</div>
													</div>
												</div>";
						}
					}




					
					// ob_end_flush();
					?>
					

				</div>
				<!-- /. ROW  -->


				
				<!-- /. PAGE INNER  -->
			</div>
			<!-- /. PAGE WRAPPER  -->
		</div>
		<!-- /. WRAPPER  -->
		<!-- JS Scripts-->
		<!-- jQuery Js -->
		<script src="assets/js/jquery-1.10.2.js"></script>
		<!-- Bootstrap Js -->
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- Metis Menu Js -->
		<script src="assets/js/jquery.metisMenu.js"></script>
		<!-- Custom Js -->
		<script src="assets/js/custom-scripts.js"></script>
		<!-- <script>
        $(document).ready(function () {
            $('.btn-update').click(function () {
                var roomId = $(this).data('id');
                var bedding = $(this).data('bedding');
                var type = $(this).data('type');

                $('#roomId').val(roomId);
                $('#bedding').val(bedding);
                $('#type').val(type);

                $('#updateModal').modal('show');
            });

            $('#updateForm').submit(function (e) {
                e.preventDefault();
                var roomId = $('#roomId').val();
                var newBedding = $('#bedding').val();
                var newType = $('#type').val();
                // Add AJAX request here to submit the form data to process_update.php
                // After the update is successful, you may want to update the UI accordingly.
                // For example, you can update the room information in the current view without reloading the page.
                $('#updateModal').modal('hide');
            });
        });
    </script> -->



	
	<!-- <script>
    $(document).ready(function () {
        $('.btn-update').click(function () {
            var roomId = $(this).data('id');  // Retrieve room ID from the clicked button

            // You can use roomId in your update modal logic
            console.log("Room ID: " + roomId);

            // ... (rest of your JavaScript logic)
        });

        $('#updateForm').submit(function (e) {
            e.preventDefault();
            var roomId = $('#roomId').val();
            var newBedding = $('#bedding').val();
            var newType = $('#type').val();
            // Add AJAX request here to submit the form data to process_update.php
            // After the update is successful, you may want to update the UI accordingly.
            // For example, you can update the room information in the current view without reloading the page.
            $('#updateModal').modal('hide');
        });
    }); -->
</script>
<?php
            if (isset($_POST['up'])) {
                $type = $_POST['type'];
                $bedding = $_POST['bedding'];

                $upsql = "UPDATE `room` SET `type`='$type',`bedding`='$bedding' WHERE id = '$id'";
                if (mysqli_query($con, $upsql)) {
					echo '<script>
					setTimeout(function() {
						window.location.href = "settings.php";
					}, 1000);
					alert("Phòng đã được cập nhật");
				</script>';
                }

                header("Location: settings.php");
            }
            ob_end_flush();
            ?>
<!-- Modal Update -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="updateModalLabel">Cập nhật thông tin phòng</h4>
            </div>
            <div class="modal-body">
                <!-- Form update thông tin phòng -->

				<form id="updateForm" action="settings.php" method="post">
    <div class="form-group">
        <label for="bedding">Bedding:</label>
		<select class="form-control" id="bedding" name="bedding" required>
            <option value="Đơn">Đơn</option>
            <option value="Đôi">Đôi</option>
            <option value="Ba">Ba</option>
            <option value="Bốn">Bốn</option>
        </select>
    </div>
    <div class="form-group">
        <label for="type">Loại phòng:</label>
        <select class="form-control" id="type" name="type" required>
            <option value="Phòng cao cấp">Phòng cao cấp</option>
            <option value="Phòng sang trọng">Phòng sang trọng</option>
            <option value="Phòng khách">Phòng khách</option>
            <option value="Phòng đơn">Phòng đơn</option>
        </select>
    </div>
    <input type="hidden" id="roomId" name="roomId">
    <input type="hidden" name="up" value="1"> <!-- Add this line to submit the update action -->
    <input type="submit" value="Lưu" class="btn btn-primary">
</form>

            </div>
        </div>
    </div>
</div>

</body>

</html>