<div class="app-menu navbar-menu border-end">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <h2 class="text-light">The PROJECT HUB</h2>
            </span>
            <span class="logo-lg">
                <h2 class="text-light">The PROJECT HUB</h2>
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <h2 class="text-light">The PROJECT HUB</h2>
            </span>
            <span class="logo-lg">
                <h2 class="text-light">The PROJECT HUB</h2>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="add-project.php">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Add Project</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#project" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="project">
                        <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Projects</span>
                    </a>
                    <div class="collapse menu-dropdown" id="project">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="project-add.php" class="nav-link" data-key="t-sweet-alerts">Add Project</a>
                            </li>
                            <li class="nav-item">
                                <a href="project-list.php" class="nav-link" data-key="t-nestable-list">List Project</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>