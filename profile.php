<?php
include 'config.php';

auth_check();
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'])) {
        $password = md5($_POST['password']);
        $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, password=?,phone=?, image=? WHERE id=?");
        $stmt->execute([
            $user['name'], $user['email'], $password, $user['phone'], $user['image'], $user['id']
        ]);
        $update = 'Password Update Successfull!!!';
    } else {
        $file_name = $user['image'];
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $file_name = upload($_FILES['image'], 'uploads/avater');
            $file_name = $file_name['filename'];
        }

        $inputData = array(
            "email" => validate_input($_POST['email']),
            "name" => validate_input($_POST['name']),
            "image" => validate_input($file_name),
            "phone" => validate_input($_POST['phone'])
        );

        $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, phone=?, image=? WHERE id=?");
        $stmt->execute([
            $inputData['name'], $inputData['email'], $inputData['phone'], $inputData['image'], $user['id']
        ]);

        $update = 'profile update successfull !!';
    }
}
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <?php include('layouts/head.php'); ?>
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php include('layouts/top-bar.php'); ?>
        <!-- ========== App Menu ========== -->
        <?php include('layouts/left-bar.php'); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row mt-5">
                        <div class="col-xxl-3">
                            <div class="card mt-n5">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            <img src="<?php (!is_null($user['image'])) ? print('uploads/avater/' . $user['image']) : print('assets/images/users/avatar-1.jpg') ?>" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                            </div>
                                        </div>
                                        <h5 class="fs-16 mb-1"><?= $user['name'] ?></h5>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                                <i class="fas fa-home"></i> Personal Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                <i class="far fa-user"></i> Change Password
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <form action="profile.php" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="name" placeholder="Enter your firstname" value="<?= $user['name'] ?>">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <!-- <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="lastnameInput" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="lastnameInput" placeholder="Enter your lastname" value="Adame">
                                                        </div>
                                                    </div> -->
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                            <input type="text" class="form-control" id="phonenumberInput" placeholder="Enter your phone number" name="phone" value="<?= @$user['phone'] ?>">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" name="email" value="<?= $user['email'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="imageInput" class="form-label">Image</label>
                                                            <input type="file" class="form-control" id="image" name="image">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Updates</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="changePassword" role="tabpanel">
                                            <form action="profile.php" method="post">
                                                <div class="row g-2">
                                                    <div class="col-lg-12">
                                                        <div>
                                                            <label for="newpasswordInput" class="form-label">New Password*</label>
                                                            <input type="password" class="form-control" id="newpasswordInput" name="password" placeholder="Enter new password">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12 mt-3">
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-success">Change Password</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <?php include('layouts/script.php'); ?>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/libs/dropzone/dropzone-min.js"></script>
    <script src="assets/js/pages/form-file-upload.init.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- profile-setting init js -->
    <script src="assets/js/pages/profile-setting.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            <?php
            if (isset($update)) { ?>
                Swal.fire({
                    html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0"><?php echo $update; ?></p></div></div>',
                    showCancelButton: !0,
                    showConfirmButton: !1,
                    cancelButtonClass: "btn btn-primary w-xs mb-1",
                    cancelButtonText: "Back",
                    buttonsStyling: !1,
                    showCloseButton: !0
                })
            <?php } ?>
        })
    </script>
</body>



</html>