<?php
include 'config.php';
auth_check();
$stmt = $pdo->prepare("SELECT batch from projects group by batch");
$stmt->execute();
$batch = $stmt->fetchAll(PDO::FETCH_ASSOC);

$project_query = 'SELECT projects.*,COUNT(project_student.project_id) as total_student from projects join project_student on projects.id = project_student.project_id';
if (isset($_GET['search_text']) && !empty($_GET['search_text'])) {
    $search_text = $_GET['search_text'];
    $project_query .= " AND projects.project_name like '%$search_text%'";
}
if (isset($_GET['batch']) && !empty($_GET['batch'])) {
    $project_batch = $_GET['batch'];
    $project_query .= " AND projects.batch = '$project_batch'";
}

$project_query .= " GROUP by project_student.project_id";

$stmt = $pdo->prepare($project_query);
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="light" data-body-image="img-1" data-preloader="disable">

<head>
    <?php include('layouts/head.php'); ?>
    <style>
        .pr-3 {
            margin-right: 15px;
        }
    </style>
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
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Project List's</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">

                                        <div class="table-responsive table-card">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" style="width: 46px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                                                                <label class="form-check-label" for="cardtableCheck"></label>
                                                            </div>
                                                        </th>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Batch</th>
                                                        <th scope="col">Project Supervisor</th>
                                                        <th scope="col">Created at</th>
                                                        <th scope="col" style="width: 150px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="7">
                                                            <form action="project-list.php" method="get">
                                                                <div class="row">
                                                                    <div class="col-12 d-sm-flex">
                                                                        <div class="form-group pr-3">
                                                                            <input type="text" class="form-controll h-100 form-controll-lg" name="search_text" 
                                                                            value="<?php (isset($_GET['search_text'])) ? print($_GET['search_text']) : '' ;?>"
                                                                            placeholder="Enter Search key">
                                                                        </div>
                                                                        <div class="form-group pr-3">
                                                                            <select name="batch" id="batch" class="foro-controll h-100">
                                                                                <option value="">select batch</option>
                                                                                <?php foreach ($batch as $key => $value) { ?>
                                                                                    <option value="<?= $value['batch']; ?>" <?php (isset($_GET['batch']) && $_GET['batch'] == $value['batch']) ? print('selected'): '';?>><?= $value['batch']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            <i class=" las la-search"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php if (count($projects) > 0) {
                                                        foreach ($projects as $key => $value) { ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" name="delete_id" id="delete_id" value="<?= $value['id'] ?>">
                                                                </td>
                                                                <td><?= $value['id'] ?></td>
                                                                <td><?= $value['project_name'] ?></td>
                                                                <td><?= $value['batch'] ?></td>
                                                                <td><?= $value['project_supervisor'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    $originalDate = $value['created_at'];
                                                                    $formattedDate = date('d F, Y', strtotime($originalDate));
                                                                    echo $formattedDate;
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <a href="project-view.php?id=<?= $value['id'] ?>" class="btn btn-sm btn-light">Details</a>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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


        <!-- JAVASCRIPT -->
        <?php include('layouts/script.php'); ?>

</body>

</html>