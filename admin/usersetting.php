<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:login.php");
}

ob_start();
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
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                
              
                        <li><a style="background-color: #225081" href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                        </li>
        
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu" style="display: flex; flex-direction: column; margin-top: 60px;">
                        <li>
                            <a class="active-menu" style="background-color: #225081" href="usersetting.php"><i class="fa fa-pencil-square-o"></i>Tài khoản</a>
                        </li>
                        <li><a href="home.php"><i class="fa fa-sign-out fa-fw"></i>Home</a></li>
                    </ul>
                </div>

            </nav>
            <!--/. NAV TOP  -->
            <!-- <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" style="margin-top: 60px;
                        background-color:" href="settings.php'><i class="fa fa-dashboard"></i>Tổng quát</a>
                    </li>
					
					

                    
            </div>

        </nav> -->
            <!-- /. NAV SIDE  -->

            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">
                                Tài khoản<small>admin</small>
                            </h1>
                        </div>
                    </div>


                    <?php
                    include('db.php');
                    $sql = "SELECT * FROM `login`where role = 1 ";
                    $re = mysqli_query($con, $sql)
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>ID admin</th>
                                                    <th>Tên</th>
                                                    <th>Mật khẩu</th>

                                                    <th>Cập nhật</th>
                                                    <th>Xóa</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                while ($row = mysqli_fetch_array($re)) {

                                                    $id = $row['id'];
                                                    $us = $row['usname'];
                                                    $ps = $row['pass'];
                                                    if ($id % 2 == 0) {
                                                        echo "<tr class='gradeC'>
													<td>" . $id . "</td>
													<td>" . $us . "</td>
													<td>" . $ps . "</td>
													
													<td><button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'>
															 Update 
													</button></td>
													<td><button class='btn btn-danger delete-btn' data-toggle='modal' data-target='#deleteConfirmationModal' data-id='" . $id . "'><i class='fa fa-edit'></i> Delete</button>

                                                    </td>
												</tr>";
                                                    } else {
                                                        echo "<tr class='gradeU'>
													<td>" . $id . "</td>
													<td>" . $us . "</td>
													<td>" . $ps . "</td>
													
													<td><button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'>
                              Update 
                            </button></td>

                            <td><button class='btn btn-danger delete-btn' data-toggle='modal' data-target='#deleteConfirmationModal' data-id='" . $id . "'><i class='fa fa-edit'></i> Delete</button>
                            
                            </td>

												</tr>";
                                                    }
                                                }

                                                ?>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            
                            <!--End Advanced Tables -->
                            <div class="panel-body">
                                <button class="btn btn-primary btn" data-toggle="modal" data-target="#myModal1">
                                    Thêm admin mới
                                </button>

                                <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Thêm tên người dùng và mật khẩu</h4>
                                            </div>

                                            <form method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Thêm tên người dùng mới</label>
                                                        <input name="newus" class="form-control" placeholder="Nhập tên người dùng">
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Mật khẩu mới</label>
                                                        <input name="newps" class="form-control" placeholder="Nhập mật khẩu">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>

                                                    <input type="submit" name="in" value="Add" class="btn btn-primary">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>


                            </div>


                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Xác nhận xóa</h4>
                                    </div>

                                <form method="post">

                                    <div class="modal-body">
                                        <p>Bạn có chắc chắn muốn xóa?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>


                                        <input type="submit" name="delete" value="Xoá" class="btn btn-danger">
                                    </div>
                                </form>       

                                </div>
                            </div>
                        </div>


                        </div>
                        <?php
                       if (isset($_POST['delete'])) {
                        $deleteSql = "DELETE FROM `login` WHERE id = '$id'";
                        
                        if (mysqli_query($con, $deleteSql)) {
                            echo '<script language="javascript" type="text/javascript"> alert("Tài khoản đã được xóa") </script>';
                        } else {
                            echo '<script language="javascript" type="text/javascript"> alert("Xóa tài khoản không thành công") </script>';
                            echo 'MySQL Error: ' . mysqli_error($con);
                        }
                    
                        // Redirect to the user setting page after deletion
                        header("Location: usersetting.php");
                        exit; // Ensure script stops here to avoid further execution
                    }
                        ?>


                        <?php
                        if (isset($_POST['in'])) {
                            $newus = $_POST['newus'];
                            $newps = $_POST['newps'];

                            $newsql = "Insert into login (usname,pass, role) values ('$newus','$newps', '1')";
                            if (mysqli_query($con, $newsql)) {
                                echo ' <script language="javascript" type="text/javascript"> alert("Tài khoản và mật khẩu đã được thêm") </script>';
                            }
                            header("Location: usersetting.php");
                        }
                        ?>

                        <div class="panel-body">

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Thay đổi tên và mật khẩu</h4>
                                        </div>

                                        <form method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Thay đổi tên</label>
                                                    <input name="usname" value="<?php echo $us; ?>" class="form-control" placeholder="Nhập tên người dùng">
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Thay đổi mật khẩu</label>
                                                    <input name="pasd" value="<?php echo $ps; ?>" class="form-control" placeholder="Nhập mật khẩu">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>

                                                <input type="submit" name="up" value="Update" class="btn btn-primary">
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /. ROW  -->
            <?php
            if (isset($_POST['up'])) {
                $usname = $_POST['usname'];
                $passwr = $_POST['pasd'];

                $upsql = "UPDATE `login` SET `usname`='$usname',`pass`='$passwr' WHERE id = '$id'";
                if (mysqli_query($con, $upsql)) {
                    echo ' <script language="javascript" type="text/javascript"> alert("Tài khoản và mật khẩu được cập nhật") </script>';
                }

                header("Location: usersetting.php");
            }
            // ob_end_flush();
            ?>


            <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->



    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom-scripts.js"></script>

</body>

</html>