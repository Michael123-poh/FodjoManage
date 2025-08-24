<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']); 

// 1. Connexion à la BD (comme dans votre exemple)
require_once __DIR__ . '/../models/H_databaseConnection.php';
$H_dbConnect = F_databaseConnection("localhost", "fodjomanage2", "root", "");

//**********appel du fichier des fonctions creer ************ */
require_once __DIR__ . '/../models/H_functionsModels.php';

$Y_idEmployes = $Y_urlDecoder['H_idEmploye'];

// 2. Selection des dossiers relatives aux acheteurs
$Y_executeDossiers = F_executeRequeteSql("SELECT * FROM dossiers INNER JOIN acheteur ON dossiers.idAcheteur = acheteur.idAcheteur INNER JOIN selection ON acheteur.idAcheteur = selection.idAcheteur INNER JOIN blocs ON selection.idBloc = blocs.idBloc INNER JOIN sites ON blocs.numeroTitreFoncier = sites.numeroTitreFoncier");

$action = $_GET['action'] ?? ($Y_urlDecoder['action'] ?? null);
$idDossier = $_GET['id'] ?? ($Y_urlDecoder['id'] ?? null);

// Afficher les details des dossiers
if ($action === 'getDetails' && $idDossier) {

    $idDossier = $_GET['id'];

    $dossierDetails = F_executeRequeteSql(
        "SELECT * FROM dossiers 
        INNER JOIN acheteur ON dossiers.idAcheteur = acheteur.idAcheteur 
        INNER JOIN selection ON acheteur.idAcheteur = selection.idAcheteur 
        INNER JOIN blocs ON selection.idBloc = blocs.idBloc 
        INNER JOIN sites ON blocs.numeroTitreFoncier = sites.numeroTitreFoncier 
        WHERE dossiers.idDossier = ?", 
        [$idDossier]
    );

    // cas tableau ou objet
    $dossier = is_array($dossierDetails) ? $dossierDetails[0] : $dossierDetails;

    if (!$dossier) {
        echo "<div class='p-4 text-danger'>Aucun dossier trouvé.</div>";
        exit;
    }

    ob_start();
    ?>

    <div class="modal-header bg-primary-blue text-white">
        <h5 class="modal-title">Détails du Dossier #<?= substr($dossier->idDossier, -5) ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-primary-blue">Informations Client</h6>
                <table class="table table-sm">
                    <tr><td><strong>Nom:</strong></td><td><?= htmlspecialchars($dossier->nomAcheteur) ?></td></tr>
                    <tr><td><strong>CNI:</strong></td><td><?= htmlspecialchars($dossier->numeroCNI) ?></td></tr>
                    <tr><td><strong>Téléphone:</strong></td><td><?= htmlspecialchars($dossier->telephoneAcheteur) ?></td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-primary-green">Informations Terrain</h6>
                <table class="table table-sm">
                    <tr><td><strong>Site:</strong></td><td><?= htmlspecialchars($dossier->numeroTitreFoncier) ?> - <?= htmlspecialchars($dossier->nomBloc) ?></td></tr>
                    <tr><td><strong>Superficie:</strong></td><td><?= number_format($dossier->superficieSelection, 0, '', ' ') ?> m²</td></tr>
                    <tr><td><strong>Prix total:</strong></td><td><?= number_format($dossier->montantTotalSelection, 0, '', ' ') ?> FCFA</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
    </div>

    <?php
    echo ob_get_clean();
    exit;
}

if(isset($_POST['valider'])) {
    extract($_POST);

    // Recuperation des dossiers
    $Y_executeDossiers = F_executeRequeteSql("SELECT numeroProcesVerbal, numeroDossierTech, numeroDocAcquisition FROM dossiers WHERE idDossier = ? ", [$valider]);
    $processVerbal = $Y_executeDossiers->numeroProcesVerbal;
    $dossierTechnique = $Y_executeDossiers->numeroDossierTech;
    $aquisition = $Y_executeDossiers->numeroDocAcquisition;

    // si le numeroProcesVerbal est vide on le remplit ainsi que dateProcesVerbal
    if ($processVerbal == NULL){
        // Recupere le dernier numero de proces verbal
        $Y_executeDernierPV = F_executeRequeteSql("SELECT numeroProcesVerbal FROM dossiers ORDER BY numeroProcesVerbal DESC LIMIT 1");

        foreach($Y_executeDernierPV as $dernierPV) {
            $dernierNumeroPV = $dernierPV->numeroProcesVerbal;
        }

        // Generer le nouveau numero de proces verbal
        $nouveauNumeroPV = F_genereMatricule($dernierNumeroPV, 'PV00001');

        // Insertion du nouveau numero de proces verbal
        $Y_insertPV = "UPDATE dossiers SET numeroProcesVerbal = ?, dateProcesVerbal = NOW(), dateMiseAJour = NOW() WHERE idDossier = ?";
        $tableauValeursPV = [$nouveauNumeroPV, $valider];
        $Y_executeInsertPV = F_executeRequeteSql($Y_insertPV, $tableauValeursPV);
    }

    // si le numeroProcessVerbal n'est pas vide on remplit seulement numeroDossierTech
    elseif ($dossierTechnique == NULL) {
        // Recupere le dernier numero de dossier technique
        $Y_executeDernierDT = F_executeRequeteSql("SELECT numeroDossierTech FROM dossiers ORDER BY numeroDossierTech DESC LIMIT 1");

        foreach($Y_executeDernierDT as $dernierDT) {
            $dernierNumeroDT = $dernierDT->numeroDossierTech;
        }

        // Generer le nouveau numero de dossier technique
        $nouveauNumeroDT = F_genereMatricule($dernierNumeroDT, 'DT00001');

        // Insertion du nouveau numero de dossier technique
        $Y_insertDT = "UPDATE dossiers SET numeroDossierTech = ?, 	dateDossierTech = NOW(), dateMiseAJour = NOW() WHERE idDossier = ?";
        $tableauValeursDT = [$nouveauNumeroDT, $valider];
        $Y_executeInsertDT = F_executeRequeteSql($Y_insertDT, $tableauValeursDT);
    }
    // si le numeroDocAcquisition est vide on le remplit
    elseif ($aquisition == NULL) {
        // Recupere le dernier numero de document d'acquisition
        $Y_executeDernierDocAcquisition = F_executeRequeteSql("SELECT numeroDocAcquisition FROM dossiers ORDER BY numeroDocAcquisition DESC LIMIT 1");

        foreach($Y_executeDernierDocAcquisition as $dernierDocAcquisition) {
            $dernierNumeroDocAcquisition = $dernierDocAcquisition->numeroDocAcquisition;
        }

        // Generer le nouveau numero de document d'acquisition
        $nouveauNumeroDocAcquisition = F_genereMatricule($dernierNumeroDocAcquisition, 'DA00001');

        // Insertion du nouveau numero de document d'acquisition
        $Y_insertDocAcquisition = "UPDATE dossiers SET numeroDocAcquisition = ?, dateDocAcquisition = NOW(), dateMiseAJour = NOW() WHERE idDossier = ?";
        $tableauValeursDocAcquisition = [$nouveauNumeroDocAcquisition, $valider];
        $Y_executeInsertDocAcquisition = F_executeRequeteSql($Y_insertDocAcquisition, $tableauValeursDocAcquisition);
    }

    header('Location:'.contructUrl('Y_dossier' , ['H_idEmploye'=>$_SESSION['H_idEmploye']]));
}


// Affichage de la vue des dossiers
require('views/dossier/dossierView.php');
?>