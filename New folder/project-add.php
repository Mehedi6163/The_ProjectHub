<?php
include 'config.php';
auth_check();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $validationMessages = array(); // Store validation messages

    // Validate and sanitize the input data
    $project_name = isset($_POST["project_name"]) ? validate_input($_POST["project_name"]) : "";
    $batch = isset($_POST["batch"]) ? (int) validate_input($_POST["batch"]) : "";

    $project_link = isset($_POST["project_link"]) ? validate_input($_POST["project_link"]) : "";
    $project_supervisor = isset($_POST["project_supervisor"]) ? validate_input($_POST["project_supervisor"]) : "";
    $project_book = 'test';
    $created_at = date('Y-m-d H:i:s');

    $students = isset($_POST["student_name"]) ? $_POST["student_name"] : array();
    $reg_no = isset($_POST["reg_no"]) ? $_POST["reg_no"] : array();
    $roll_no = isset($_POST["roll_no"]) ? $_POST["roll_no"] : array();

    // Validate each input field and store validation messages
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($project_name)) {
            $validationMessages[] = "Project Name is required.";
        }
        if (empty($batch)) {
            $validationMessages[] = "Batch is required.";
        }
        if (empty($students)) {
            $validationMessages[] = "At least one Student Name is required.";
        }
        if (empty($reg_no)) {
            $validationMessages[] = "Registration No is required.";
        }
        if (empty($roll_no)) {
            $validationMessages[] = "Roll No is required.";
        }
        if (empty($project_link)) {
            $validationMessages[] = "Project Link is required.";
        }
        if (empty($project_supervisor)) {
            $validationMessages[] = "Project Supervisor is required.";
        }

        if (empty($validationMessages)) {
            try {
                // Insert data into the MySQL database using prepared statements
                $stmt = $pdo->prepare("INSERT INTO projects (project_name, batch, project_link, project_supervisor, project_book, created_at) VALUES (:project_name, :batch, :project_link, :project_supervisor, :project_book, :created_at)");
                $stmt->bindParam(':project_name', $project_name);
                $stmt->bindParam(':batch', $batch);
                $stmt->bindParam(':project_link', $project_link);
                $stmt->bindParam(':project_supervisor', $project_supervisor);
                $stmt->bindParam(':project_book', $project_book);
                $stmt->bindParam(':created_at', $created_at);
                $stmt->execute();

                $project_id = $pdo->lastInsertId(); // Get the inserted project ID

                // Insert student names into a separate table, assuming you have a table named 'project_student'
                for ($i = 0; $i <= count($students) - 1; $i++) {
                    $student_name = validate_input($students[$i]);
                    $student_roll = (int) validate_input($roll_no[$i]);
                    $student_reg = (int) validate_input($reg_no[$i]);

                    $stmt = $pdo->prepare("INSERT INTO project_student (project_id, batch, reg_no, roll_no, student_name, created_at) VALUES (:project_id, :batch, :reg_no, :roll_no, :student_name, :created_at)");
                    $stmt->bindParam(':project_id', $project_id);
                    $stmt->bindParam(':student_name', $student_name);
                    $stmt->bindParam(':batch', $batch);
                    $stmt->bindParam(':reg_no', $student_reg);
                    $stmt->bindParam(':roll_no', $student_roll);
                    $stmt->bindParam(':created_at', $created_at);
                    $stmt->execute();
                }

                $data_insert = 'success';
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="light" data-body-image="img-1" data-preloader="disable">

<head>
    <?php include('layouts/head.php'); ?>
    <link rel="stylesheet" href="assets/libs/dropzone/dropzone.css" type="text/css" />
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add Project Details</h4>
                                </div>
                                <div class="card-body">
                                    <form action="project-add.php" method="post" enctype="multipart/form-data">
                                        <div class="live-preview">
                                            <?php
                                            // Display validation messages at the bottom
                                            if (!empty($validationMessages)) {
                                                echo "<div class='error-messages'>";
                                                echo "<ul>";
                                                foreach ($validationMessages as $message) {
                                                    echo "<li>$message</li>";
                                                }
                                                echo "</ul>";
                                                echo "</div>";
                                            }
                                            ?>
                                            <div class="row align-items-center g-3 pb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Enter project Name">
                                                        <label for="project_name">Project Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" id="batch" name="batch" placeholder="Enter batch">
                                                        <label for="batch">Batch</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center g-3 pb-3 mt-3">
                                                <div class="row student_row mb-2">
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="student_name" name="student_name[]" placeholder="Enter student name">
                                                            <label for="student_name">Student Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="reg_no" name="reg_no[]" placeholder="Enter registration no">
                                                            <label for="reg_no">Registration No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="roll_no" name="roll_no[]" placeholder="Enter roll no">
                                                            <label for="roll_no">Roll No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <div class="form-floating">
                                                            <button type="button" class="btn btn-danger remove-section">-</button>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-success add-section">+</button>
                                                </div>
                                            </div>
                                            <div class="row align-items-center g-3 pb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="project_link" name="project_link" placeholder="Enter project Link">
                                                        <label for="project_link">Project Link</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="project_supervisor" name="project_supervisor" placeholder="Enter project supervisor">
                                                        <label for="project_supervisor">Project supervisor</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center g-3 mb-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="dropzone">
                                                        <label for="project_file">Project Book</label>
                                                        <div class="fallback">
                                                            <input name="project_book" type="file" multiple="multiple">
                                                        </div>
                                                        <div class="dz-message needsclick">
                                                            <div class="mb-3">
                                                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                            </div>

                                                            <h4>Drop files here or click to upload.</h4>
                                                        </div>
                                                    </div>
                                                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                        <li class="mt-2" id="dropzone-preview-list">
                                                            <!-- This is used as the file preview template -->
                                                            <div class="border rounded">
                                                                <div class="d-flex p-2">
                                                                    <div class="flex-shrink-0 me-3">
                                                                        <div class="avatar-sm bg-light rounded">
                                                                            <img data-dz-thumbnail class="img-fluid rounded d-block" src="assets/images/new-document.png" alt="Dropzone-Image" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <div class="pt-1">
                                                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-3">
                                                                        <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Submit form</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
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
    <script src="assets/js/jquery.js"></script>
    <script src="assets/libs/dropzone/dropzone-min.js"></script>
    <script src="assets/js/pages/form-file-upload.init.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add Section
            $(".add-section").click(function() {
                var sectionClone = $(".row.student_row").first().clone();
                sectionClone.find("input").val(""); // Clear input values
                $(".row.student_row").last().after(sectionClone);
            });

            // Remove Section
            $(document).on("click", ".remove-section", function() {
                if ($(".row.student_row").length > 1) {
                    $(this).closest(".row.student_row").remove();
                }
            });
            <?php
            if (isset($data_insert)) { ?>
                Swal.fire({
                    html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">Project has been listed to database.</p></div></div>',
                    showCancelButton: !0,
                    showConfirmButton: !1,
                    cancelButtonClass: "btn btn-primary w-xs mb-1",
                    cancelButtonText: "Back",
                    buttonsStyling: !1,
                    showCloseButton: !0
                })
            <?php } ?>
        });
    </script>

</body>

</html>