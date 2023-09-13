<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/PHPMailer-master/src/Exception.php';
require 'lib/PHPMailer-master/src/PHPMailer.php';
require 'lib/PHPMailer-master/src/SMTP.php';
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $rand_passowrd = rand(0, 99999999);

        $password = md5($rand_passowrd);
        $user_id = $user['id'];
        $stmt = $pdo->prepare("UPDATE users SET password=:password WHERE id=:id");
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bijoykarmokar71@gmail.com';
        $mail->Password   = 'kmgcudjpzuhukprs';
        $mail->SMTPSecure = 'tls';

        $mail->Port       = 587;
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom('bijoykarmokar71@gmail.com', 'The project Hub');
        $mail->addAddress($_POST['email']);
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Password Reset Request';
        $mail->Body    = 'We have generated new password for your request your new password is ' . $rand_passowrd;
        $mail->send();
        $success = true;
    }
}

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="light" data-body-image="img-1" data-preloader="disable">

<head>
    <?php include('layouts/head.php'); ?>
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div class="auth-page-wrapper pt-5">

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 card-bg-fill">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Forgot Password?</h5>
                                    <p class="text-muted">Reset password with velzon</p>

                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#8c68cd" class="avatar-xl"></lord-icon>

                                </div>

                                <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                    Enter your email and instructions will be sent to you!
                                </div>
                                <div class="p-2">
                                    <form action="" method="post">
                                        <div class="mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Send Reset Link</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Wait, I remember my password... <a href="login.php" class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
    </div>
    <!-- JAVASCRIPT -->
    <?php include('layouts/script.php'); ?>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script>
        <?php
        if (isset($success)) { ?>
            Swal.fire({
                html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon> <div class = "mt-4 pt-2 fs-15" ><h4 > Well done! </h4> <p class="text-muted mx-4 mb-0">We send a new password to your mail. </p> </div> </div>',
                showCancelButton: !0,
                showConfirmButton: !1,
                cancelButtonClass: "btn btn-primary w-xs mb-1",
                cancelButtonText: "Back",
                buttonsStyling: !1,
                showCloseButton: !0
            })
        <?php } ?>
    </script>
</body>

</html>