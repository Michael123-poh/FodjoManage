<?php
require('../views/template/header.php');
require('../views/template/navbar.php');
?>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-primary-blue">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-calendar3"></i>
                            Cette semaine
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card border-0 shadow-sm card-hover" style="border-left-color: var(--primary-blue);">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary-blue text-uppercase mb-1">
                                            Prospects
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">142</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-search text-primary-blue" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card border-0 shadow-sm card-hover" style="border-left-color: var(--primary-green);">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary-green text-uppercase mb-1">
                                            Acheteurs
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">89</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-people text-primary-green" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card border-0 shadow-sm card-hover" style="border-left-color: #f59e0b;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Dossiers en cours
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">34</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-folder text-warning" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card border-0 shadow-sm card-hover" style="border-left-color: #dc2626;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Terrains vendus
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">67</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-geo-alt text-danger" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary-blue text-white">
                                <h6 class="m-0 font-weight-bold">Activités récentes</h6>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Nouveau prospect ajouté</h6>
                                            <p class="mb-1">Jean Dupont - Téléphone: 123456789</p>
                                            <small class="text-muted">Il y a 2 heures</small>
                                        </div>
                                        <span class="badge bg-primary-blue rounded-pill">Nouveau</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Dossier signé</h6>
                                            <p class="mb-1">Marie Martin - PV signé</p>
                                            <small class="text-muted">Il y a 4 heures</small>
                                        </div>
                                        <span class="badge bg-primary-green rounded-pill">Signé</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Terrain vendu</h6>
                                            <p class="mb-1">Site A - Bloc 3 - 500m²</p>
                                            <small class="text-muted">Hier</small>
                                        </div>
                                        <span class="badge bg-success rounded-pill">Vendu</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary-green text-white">
                                <h6 class="m-0 font-weight-bold">Actions rapides</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-primary" onclick="window.location.href='prospection.html'">
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Ajouter un prospect
                                    </button>
                                    <button class="btn btn-outline-success" onclick="window.location.href='acheteurs.html'">
                                        <i class="bi bi-person-plus me-2"></i>
                                        Nouveau client
                                    </button>
                                    <button class="btn btn-outline-info" onclick="window.location.href='sites.html'">
                                        <i class="bi bi-geo-alt-fill me-2"></i>
                                        Gérer les sites
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>