<?php
require('../views/template/header.php');
require('../views/template/navbar.php');
?>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-primary-blue">Acheteurs</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-primary bg-primary-green border-0" data-bs-toggle="modal" data-bs-target="#addAcheteurModal">
                            <i class="bi bi-person-plus me-2"></i>
                            Nouvel acheteur
                        </button>
                    </div>
                </div>

                <!-- Search and Filter -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Rechercher un acheteur...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Tous les sites</option>
                            <option>Site A</option>
                            <option>Site B</option>
                            <option>Site C</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Tous les statuts</option>
                            <option>Actif</option>
                            <option>En attente</option>
                            <option>Finalisé</option>
                        </select>
                    </div>
                </div>

                <!-- Acheteurs Cards -->
                <div class="row">
                    <?php 
                        foreach ($Y_executeAcheteurs as $acheteur) {
                            
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-primary-green text-white d-flex justify-content-between align-items-center">
                                <h6 class="mb-0"><?= $acheteur->nomAcheteur ?></h6>
                                <span class="badge bg-light text-dark">Actif</span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>CNI:</strong></div>
                                    <div class="col-sm-8"><?= $acheteur->nomAcheteur ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Âge:</strong></div>
                                    <div class="col-sm-8"><?= F_calculerAge($acheteur->dateNaisAcheteur) ?> ans</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Site:</strong></div>
                                    <div class="col-sm-8"><?= $acheteur->numeroTitreFoncier ?> - <?= $acheteur->nomBloc ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Superficie:</strong></div>
                                    <div class="col-sm-8"><?= number_format($acheteur->superficieSelection, 0, '', ' ') ?> m²</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Prix/m²:</strong></div>
                                    <div class="col-sm-8"><?= number_format($acheteur->montantParMetre, 0, '', ' ') ?> FCFA</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Total:</strong></div>
                                    <div class="col-sm-8"><strong class="text-success"><?= number_format($acheteur->montantTotalSelection, 0, '', ' ') ?> FCFA</strong></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group w-100" role="group">
                                    <a href="Y_acheteurDetailController.php" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i> Voir
                                    </a>
                                    <button type="button" class="btn btn-outline-success btn-sm">
                                        <i class="bi bi-folder"></i> Dossier
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-pencil"></i> Modifier
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        } //Fin foreach
                    ?>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-primary-blue text-white d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Stephane Kemegne</h6>
                                <span class="badge bg-warning text-dark">En attente</span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Passeport:</strong></div>
                                    <div class="col-sm-8">AB1234567</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Âge:</strong></div>
                                    <div class="col-sm-8">42 ans</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Site:</strong></div>
                                    <div class="col-sm-8">Site B - Bloc 1</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Superficie:</strong></div>
                                    <div class="col-sm-8">750 m²</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Prix/m²:</strong></div>
                                    <div class="col-sm-8">30 000 FCFA</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Total:</strong></div>
                                    <div class="col-sm-8"><strong class="text-success">22 500 000 FCFA</strong></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group w-100" role="group">
                                    <button type="button" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i> Voir
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm">
                                        <i class="bi bi-folder"></i> Dossier
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-pencil"></i> Modifier
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Serge Augustin</h6>
                                <span class="badge bg-light text-dark">Finalisé</span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>CNI:</strong></div>
                                    <div class="col-sm-8">987654321</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Âge:</strong></div>
                                    <div class="col-sm-8">28 ans</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Site:</strong></div>
                                    <div class="col-sm-8">Site A - Bloc 3</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Superficie:</strong></div>
                                    <div class="col-sm-8">400 m²</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Prix/m²:</strong></div>
                                    <div class="col-sm-8">25 000 FCFA</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Total:</strong></div>
                                    <div class="col-sm-8"><strong class="text-success">10 000 000 FCFA</strong></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group w-100" role="group">
                                    <button type="button" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i> Voir
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm">
                                        <i class="bi bi-folder"></i> Dossier
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-pencil"></i> Modifier
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Précédent</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Suivant</a>
                        </li>
                    </ul>
                </nav>
            </main>
        </div>
    </div>

    <!-- Add Acheteur Modal -->
    <div class="modal fade" id="addAcheteurModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary-green text-white">
                    <h5 class="modal-title">Nouvel acheteur</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nom" placeholder="Nom">
                                    <label for="nom">Nom *</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="prenom" placeholder="Prénom">
                                    <label for="prenom">Prénom *</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="typeDocument">
                                        <option value="cni">CNI</option>
                                        <option value="passeport">Passeport</option>
                                    </select>
                                    <label for="typeDocument">Type de document *</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="numeroDocument" placeholder="Numéro">
                                    <label for="numeroDocument">Numéro de document *</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="age" placeholder="Âge">
                                    <label for="age">Âge *</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="telephone" placeholder="Téléphone">
                                    <label for="telephone">Téléphone</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="site">
                                        <option value="">Sélectionner un site</option>
                                        <option value="site-a">Site A</option>
                                        <option value="site-b">Site B</option>
                                        <option value="site-c">Site C</option>
                                    </select>
                                    <label for="site">Site *</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="bloc">
                                        <option value="">Sélectionner un bloc</option>
                                        <option value="bloc-1">Bloc 1</option>
                                        <option value="bloc-2">Bloc 2</option>
                                        <option value="bloc-3">Bloc 3</option>
                                    </select>
                                    <label for="bloc">Bloc *</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="superficie" placeholder="Superficie">
                                    <label for="superficie">Superficie (m²) *</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="prixMetre" placeholder="Prix par mètre">
                                    <label for="prixMetre">Prix par m² (FCFA) *</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" id="notes" style="height: 100px" placeholder="Notes"></textarea>
                                <label for="notes">Notes</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary bg-primary-green border-0">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <button class="btn btn-primary bg-primary-green border-0 btn-floating d-md-none" data-bs-toggle="modal" data-bs-target="#addAcheteurModal">
        <i class="bi bi-plus" style="font-size: 1.5rem;"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>