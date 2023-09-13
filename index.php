<?php
include 'config.php';
auth_check();
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="light" data-body-image="img-1" data-preloader="disable">

<head>
    <?php include('layouts/head.php'); ?>
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

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">PH Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card overflow-hidden">
                                <div class="card-body bg-marketplace d-flex">
                                    <div class="flex-grow-1">
                                        <?php
                                        $stmt = $pdo->prepare("SELECT * FROM projects ORDER BY id DESC limit 1");
                                        $stmt->execute();
                                        $latest_project = $stmt->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                        <h4 class="fs-18 lh-base mb-0">Latest Project (<?= $latest_project['project_name'] ?>)</h4>
                                        <p class="mb-0 mt-2 pt-1 text-muted">Project Supervisor: <br> <?= $latest_project['project_supervisor'] ?></p>
                                        <div class="d-flex gap-3 mt-4">
                                            <a href="project-view.php?id=<?= $project['id'] ?>" class="btn btn-primary">View</a>
                                            <a href="#" class="btn btn-soft-primary">Create Your Own</a>
                                        </div>
                                    </div>
                                    <img src="assets/images/bg-d.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded fs-3">
                                                <i class="bx bx-wallet text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ps-3">
                                            <h5 class="text-muted text-uppercase fs-13 mb-0">Total Project</h5>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-1">
                                        <?php
                                        $stmt = $pdo->prepare("SELECT COUNT(*) AS project_count FROM projects");
                                        $stmt->execute();
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $projectCount = $result['project_count'];
                                        ?>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-0"><i class="bx bx-wallet text-primary"></i><span class="counter-value" data-target="<?= $projectCount ?>">0</span> </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded fs-3">
                                                <i class="bx bx-dollar-circle text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ps-3">
                                            <h5 class="text-muted text-uppercase fs-13 mb-0">Total Student</h5>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-1">
                                        <?php
                                        $stmt = $pdo->prepare("SELECT COUNT(*) AS student_count FROM project_student");
                                        $stmt->execute();
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $projectStudents = $result['student_count'];
                                        ?>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-0">$<span class="counter-value" data-target="<?= $projectStudents ?>">0</span> </h4>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-primary btn-icon" id="back-to-top">
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

    <!-- <div class="customizer-setting d-none d-md-block">
        <div class="btn-primary btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div> -->

    <!-- Theme Settings -->


    <!-- JAVASCRIPT -->
    <?php include('layouts/script.php'); ?>
</body>

</html>