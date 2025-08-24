<?php
// session_start(); // Assurez-vous que la session est démarrée
require('views/template/header.php');
require('views/template/navbar.php');

// Ces variables $H_executeEmployes, $items_json, $H_executeTypeEmployes
// doivent être définies par votre contrôleur avant d'inclure cette vue.
// Si $H_executeGetInfoEmploye et $H_executeGetPosteEmploye sont utilisés SEULEMENT
// pour pré-remplir cette modale lors d'un accès direct à H_updateEmploye.php,
// alors ils ne sont pas nécessaires ici pour la logique de pré-remplissage via JS.
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-primary-blue">Employés</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-primary bg-primary-green border-0" data-bs-toggle="modal" data-bs-target="#addEmployeModal"> <!-- Renommé pour clarté -->
                <i class="bi bi-person-plus me-2"></i>
                Nouvel Employé
            </button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Rechercher un employé..." id="searchInput">
            </div>
        </div>
        <div class="col-md-3">
            <select class="form-select" id="roleFilter">
                <option value="">Tous les rôles</option>
                <option value="Administrateur">Administrateur</option>
                <option value="Manager">Manager</option>
                <option value="Employé">Employé</option>
                <option value="Stagiaire">Stagiaire</option>
                <option value="Autre">Autre</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-secondary bg-secondary-blue border-0" id="exportCsvButton">
                <i class="bi bi-file-earmark-arrow-down me-2"></i>
                Exporter en CSV
            </button>
        </div>
    </div>

    <div class="row" id="employes-cards-container">
        <div id="no-items-message" class="col-12 text-center text-muted">
        </div>
    </div>

    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center" id="pagination-controls">
        </ul>
    </nav>

</main>

</div>
</div>

<!-- ==================== modal form pour l'ajout d'un employe ============================ -->
<div class="modal fade" id="addEmployeModal" tabindex="-1"> 
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary-green text-white">
                <h5 class="modal-title text-center font-bold">Nouvel Employé</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/FodjoManage/<?= encodeUrl(['page'=>'H_creerEmploye' , 'H_idEmploye'=>$_SESSION['H_idEmploye']])?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="add_nom" name="H_nomEmploye" placeholder="Nom" required>
                                <label for="add_nom">Nom *</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="add_prenom" name="H_prenomEmploye" placeholder="Prénom" required>
                                <label for="add_prenom">Prénom *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="add_pseudoEmploye" name="pseudoEmploye" placeholder="Pseudo" required>
                                <label for="add_pseudoEmploye">Pseudo *</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="add_dateNaisEmploye" name="H_dateNaisEmploye" placeholder="Date de Naissance" required>
                                <label for="add_dateNaisEmploye">Date de Naissance *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="add_telephoneEmploye" name="H_telephoneEmploye" placeholder="Téléphone">
                                <label for="add_telephoneEmploye">Téléphone</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="add_emailEmploye" name="H_emailEmploye" placeholder="Adresse e-mail" required>
                                <label for="add_emailEmploye">Email de l'Employé *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="add_adresseEmploye" name="H_adresseEmploye" placeholder="Adresse" required>
                                <label for="add_adresseEmploye">Adresse de l'Employé *</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="add_posteEmploye" name="H_posteEmploye" required>
                                    <?php foreach ($H_executeTypeEmployes as $poste) { ?>
                                        <option value="<?= $poste->idTypeEmploye ?>"><?= $poste->libelleFonction ?></option>
                                    <?php } ?>
                                </select>
                                <label for="add_posteEmploye">Poste de l'Employé *</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" name="Annuler">Annuler</button>
                        <button type="submit" class="btn btn-primary bg-primary-green border-0" name="Enregistrer" value="">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary bg-primary-green border-0 btn-floating d-md-none" data-bs-toggle="modal" data-bs-target="#addEmployeModal">
    <i class="bi bi-plus" style="font-size: 1.5rem;"></i>
</button>

<!-- ====================== modal form pour la modification d'un employe ================ -->
<div class="modal fade" id="updateEmployeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary-green text-white">
                <h5 class="modal-title text-center font-bold">Modifier un Employé</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Ajout d'un ID au formulaire de modification -->
                <form id="updateEmployeForm" method="POST" action="/FodjoManage/<?= encodeUrl(['page'=>'H_updateEmploye', 'H_idEmploye'=>$_SESSION['H_idEmploye']])?>">
                    <!-- Champ caché pour l'ID de l'employé à modifier -->
                    <input type="hidden" id="update_idEmploye" name="H_idEmployeUpdate">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="update_nom" name="H_nomEmploye" placeholder="Nom" required>
                                <label for="update_nom">Nom et Prénom *</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="update_pseudoEmploye" name="H_pseudoEmploye" placeholder="Pseudo" required>
                                <label for="update_pseudoEmploye">Pseudo *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="update_dateNaisEmploye" name="H_dateNaisEmploye" placeholder="Date de Naissance" required>
                                <label for="update_dateNaisEmploye">Date de Naissance *</label>
                            </div>
                        </div>
                         <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="update_emailEmploye" name="H_emailEmploye" placeholder="Adresse e-mail" required>
                                <label for="update_emailEmploye">Email de l'Employé *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="update_telephoneEmploye" name="H_telephoneEmploye" placeholder="Téléphone">
                                <label for="update_telephoneEmploye">Téléphone</label>
                            </div>
                        </div>
                       <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="update_adresseEmploye" name="H_adresseEmploye" placeholder="Adresse" required>
                                <label for="update_adresseEmploye">Adresse de l'Employé *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select" id="update_posteEmploye" name="H_idPosteEmploye" required>
                                    <?php foreach ($H_executeTypeEmployes as $poste) { ?>
                                        <option value="<?= $poste->idTypeEmploye ?>"><?= $poste->libelleFonction ?></option>
                                    <?php } ?>
                                </select>
                                <label for="update_posteEmploye">Poste de l'Employé *</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" name="Annuler">Annuler</button>
                        <button type="submit" class="btn btn-primary bg-primary-green border-0" name="Sauvegarder">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary bg-primary-green border-0 btn-floating d-md-none" data-bs-toggle="modal" data-bs-target="#updateEmployeModal">
    <i class="bi bi-plus" style="font-size: 1.5rem;"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const allItems = <?= $items_json; ?>;
    // La variable PHP pour l'ID de session, utilisée par JavaScript
    const H_idEmployeFromSession = "<?php echo isset($_SESSION['H_idEmploye']) ? $_SESSION['H_idEmploye'] : ''; ?>";
</script>

<script src="views/assets/js/paginationEmployes.js"></script>

</body>
</html>
<?php
// session_start(); // Assurez-vous que la session est démarrée
require('views/template/header.php');
require('views/template/navbar.php');

// Ces variables $H_executeEmployes, $items_json, $H_executeTypeEmployes
// doivent être définies par votre contrôleur avant d'inclure cette vue.
// Si $H_executeGetInfoEmploye et $H_executeGetPosteEmploye sont utilisés SEULEMENT
// pour pré-remplir cette modale lors d'un accès direct à H_updateEmploye.php,
// alors ils ne sont pas nécessaires ici pour la logique de pré-remplissage via JS.
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-primary-blue">Employés</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-primary bg-primary-green border-0" data-bs-toggle="modal" data-bs-target="#addEmployeModal"> <!-- Renommé pour clarté -->
                <i class="bi bi-person-plus me-2"></i>
                Nouvel Employé
            </button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Rechercher un employé..." id="searchInput">
            </div>
        </div>
        <div class="col-md-3">
            <select class="form-select" id="roleFilter">
                <option value="">Tous les rôles</option>
                <option value="Administrateur">Administrateur</option>
                <option value="Manager">Manager</option>
                <option value="Employé">Employé</option>
                <option value="Stagiaire">Stagiaire</option>
                <option value="Autre">Autre</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-secondary bg-secondary-blue border-0" id="exportCsvButton">
                <i class="bi bi-file-earmark-arrow-down me-2"></i>
                Exporter en CSV
            </button>
        </div>
    </div>

    <div class="row" id="employes-cards-container">
        <div id="no-items-message" class="col-12 text-center text-muted">
        </div>
    </div>

    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center" id="pagination-controls">
        </ul>
    </nav>

</main>

</div>
</div>

<!-- ==================== modal form pour l'ajout d'un employe ============================ -->
<div class="modal fade" id="addEmployeModal" tabindex="-1"> 
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary-green text-white">
                <h5 class="modal-title text-center font-bold">Nouvel Employé</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/FodjoManage/<?= encodeUrl(['page'=>'H_creerEmploye' , 'H_idEmploye'=>$_SESSION['H_idEmploye']])?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="add_nom" name="H_nomEmploye" placeholder="Nom" required>
                                <label for="add_nom">Nom *</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="add_prenom" name="H_prenomEmploye" placeholder="Prénom" required>
                                <label for="add_prenom">Prénom *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="add_pseudoEmploye" name="pseudoEmploye" placeholder="Pseudo" required>
                                <label for="add_pseudoEmploye">Pseudo *</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="add_dateNaisEmploye" name="H_dateNaisEmploye" placeholder="Date de Naissance" required>
                                <label for="add_dateNaisEmploye">Date de Naissance *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="add_telephoneEmploye" name="H_telephoneEmploye" placeholder="Téléphone">
                                <label for="add_telephoneEmploye">Téléphone</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="add_emailEmploye" name="H_emailEmploye" placeholder="Adresse e-mail" required>
                                <label for="add_emailEmploye">Email de l'Employé *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="add_adresseEmploye" name="H_adresseEmploye" placeholder="Adresse" required>
                                <label for="add_adresseEmploye">Adresse de l'Employé *</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="add_posteEmploye" name="H_posteEmploye" required>
                                    <?php foreach ($H_executeTypeEmployes as $poste) { ?>
                                        <option value="<?= $poste->idTypeEmploye ?>"><?= $poste->libelleFonction ?></option>
                                    <?php } ?>
                                </select>
                                <label for="add_posteEmploye">Poste de l'Employé *</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" name="Annuler">Annuler</button>
                        <button type="submit" class="btn btn-primary bg-primary-green border-0" name="Enregistrer" value="">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary bg-primary-green border-0 btn-floating d-md-none" data-bs-toggle="modal" data-bs-target="#addEmployeModal">
    <i class="bi bi-plus" style="font-size: 1.5rem;"></i>
</button>

<!-- ====================== modal form pour la modification d'un employe ================ -->
<div class="modal fade" id="updateEmployeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary-green text-white">
                <h5 class="modal-title text-center font-bold">Modifier un Employé</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Ajout d'un ID au formulaire de modification -->
                <form id="updateEmployeForm" method="POST" action="/FodjoManage/<?= encodeUrl(['page'=>'H_updateEmploye', 'H_idEmploye'=>$_SESSION['H_idEmploye']])?>">
                    <!-- Champ caché pour l'ID de l'employé à modifier -->
                    <input type="hidden" id="update_idEmploye" name="H_idEmployeUpdate">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="update_nom" name="H_nomEmploye" placeholder="Nom" required>
                                <label for="update_nom">Nom et Prénom *</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="update_pseudoEmploye" name="H_pseudoEmploye" placeholder="Pseudo" required>
                                <label for="update_pseudoEmploye">Pseudo *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="update_dateNaisEmploye" name="H_dateNaisEmploye" placeholder="Date de Naissance" required>
                                <label for="update_dateNaisEmploye">Date de Naissance *</label>
                            </div>
                        </div>
                         <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="update_emailEmploye" name="H_emailEmploye" placeholder="Adresse e-mail" required>
                                <label for="update_emailEmploye">Email de l'Employé *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="update_telephoneEmploye" name="H_telephoneEmploye" placeholder="Téléphone">
                                <label for="update_telephoneEmploye">Téléphone</label>
                            </div>
                        </div>
                       <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="update_adresseEmploye" name="H_adresseEmploye" placeholder="Adresse" required>
                                <label for="update_adresseEmploye">Adresse de l'Employé *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select" id="update_posteEmploye" name="H_idPosteEmploye" required>
                                    <?php foreach ($H_executeTypeEmployes as $poste) { ?>
                                        <option value="<?= $poste->idTypeEmploye ?>"><?= $poste->libelleFonction ?></option>
                                    <?php } ?>
                                </select>
                                <label for="update_posteEmploye">Poste de l'Employé *</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" name="Annuler">Annuler</button>
                        <button type="submit" class="btn btn-primary bg-primary-green border-0" name="Sauvegarder">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary bg-primary-green border-0 btn-floating d-md-none" data-bs-toggle="modal" data-bs-target="#updateEmployeModal">
    <i class="bi bi-plus" style="font-size: 1.5rem;"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const allItems = <?= $items_json; ?>;
    // La variable PHP pour l'ID de session, utilisée par JavaScript
    const H_idEmployeFromSession = "<?php echo isset($_SESSION['H_idEmploye']) ? $_SESSION['H_idEmploye'] : ''; ?>";
</script>

<script src="../views/assets/js/paginationEmployes.js"></script>

</body>
</html>
<?php

require('views/template/header.php');

require('views/template/navbar.php');

?>



    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-primary-blue">Employés</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-primary bg-primary-green border-0" data-bs-toggle="modal" data-bs-target="#addEmployeModal">
                    <i class="bi bi-person-plus me-2"></i>
                    Nouvel Employé
                </button>
            </div>
        </div>



        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" placeholder="Rechercher un employé...">
                </div>
            </div>

            <div class="col-md-3">
                <select class="form-select">
                    <option>Tous les rôles</option>
                    <option>Administrateur</option>
                    <option>Manager</option>
                    <option>Employé</option>
                    <option>Stagiaire</option>
                    <option>Autre</option>
                </select>
            </div>

            <!-- <div class="col-md-3">
                <select class="form-select">
                    <option>Tous les statuts</option>
                    <option>Actif</option>
                    <option>En attente</option>
                    <option>Finalisé</option>
                </select>
            </div> -->
             <div class="col-md-3">
                <button class="btn btn-secondary bg-secondary-blue border-0" id="exportCsvButton">
                    <i class="bi bi-file-earmark-arrow-down me-2"></i>
                    Exporter en CSV     
              </button>
            </div>
        </div>
           
        <div class="row" id="employes-cards-container">
            <div id="no-items-message" class="col-12 text-center text-muted">
            </div>
        </div>

        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center" id="pagination-controls">
            </ul>
        </nav>

    </main>

    </div>
    </div>

    <div class="modal fade" id="addEmployeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary-green text-white">
                    <h5 class="modal-title">Nouvel Employe</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/FodjoManage/<?= encodeUrl(['page'=>'H_creerEmploye' , 'H_idEmploye'=>$_SESSION['H_idEmploye']])?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nom" name="H_nomEmploye" placeholder="Nom">
                                    <label for="nom">Nom *</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="prenom" name="H_prenomEmploye" placeholder="Prénom">
                                    <label for="prenom">Prénom *</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="pseudoEmploye" name="pseudoEmploye" placeholder="Pseudo">
                                    <label for="pseudoEmploye">Pseudo *</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="age" name="H_dateNaisEmploye" placeholder="Âge">
                                    <label for="age">Date de Naissance *</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="telephone" name="H_telephoneEmploye" placeholder="Téléphone">
                                    <label for="telephone">Téléphone</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="H_emailEmploye" name="H_emailEmploye" placeholder="Adresse">
                                    <label for="H_emailEmploye">Email de l'Employe *</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="H_adresseEmploye" name="H_adresseEmploye" placeholder="Adresse">
                                    <label for="H_adresseEmploye">Adresse de l'Employe *</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="H_posteEmploye" name="H_posteEmploye">
                                        <?php foreach ($H_executeTypeEmployes as $poste) { ?>
                                            <option value="<?= $poste->idTypeEmploye ?>"><?= $poste->libelleFonction ?></option>
                                            <?php } ?>
                                    </select>
                                    <label for="H_posteEmploye">Poste de l'Employe *</label> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" name="Annuler">Annuler</button>
                            <button type="submit" class="btn btn-primary bg-primary-green border-0" name="Enregistrer" value="">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary bg-primary-green border-0 btn-floating d-md-none" data-bs-toggle="modal" data-bs-target="#addEmployeModal">
            <i class="bi bi-plus" style="font-size: 1.5rem;"></i>
    </button>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const allItems = <?= $items_json; ?>;
    </script>

    <script src="views/assets/js/paginationEmployes.js"></script>

    </body>

</html>