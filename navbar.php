<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">FodjoManage</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'Y_dashboardController.php' ? 'active' : '' ?>" href="Y_dashboardController.php">
                                <i class="bi bi-house-door me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="prospection.html">
                                <i class="bi bi-search me-2"></i>
                                Prospection
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'Y_acheteurController.php' ? 'active' : '' ?>" href="Y_acheteurController.php">
                                <i class="bi bi-people me-2"></i>
                                Acheteurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'Y_dossierController.php' ? 'active' : '' ?>" href="Y_dossierController.php">
                                <i class="bi bi-folder me-2"></i>
                                Dossiers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'Y_siteController.php' ? 'active' : '' ?>" href="Y_siteController.php">
                                <i class="bi bi-geo-alt me-2"></i>
                                Sites & Blocs
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>