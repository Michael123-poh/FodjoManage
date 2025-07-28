<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']); 

// 1. Connexion à la BD (comme dans votre exemple)
require_once('models/H_databaseConnection.php');
$H_dbConnect = F_databaseConnection("localhost", "fodjomanage", "root", "");

//**********appel du fichier des fonctions creer ************ */
require("models/H_functionsModels.php");

// RECUPERER LES INFO DU FORMULAIRE ET FAIRE LA COMPARAISON
if(isset($_POST['connecter'])){
    extract($_POST);
    var_dump($_POST);
    $Y_tableauParametre = [$noms, $mdp];
    // VERIFIER SI LES IDENTIFIANT ENTREE EXISTE
    $T_requetteUser="SELECT * FROM employe WHERE pseudoEmploye = ? AND mdpEmploye = ? ";
    $T_executeT_requetteUser=F_executeRequeteSql($T_requetteUser, $Y_tableauParametre);
    var_dump($T_executeT_requetteUser);
    //MD5($T_password)
    if (!empty($T_executeT_requetteUser))
    { 
        $_SESSION['H_idEmploye'] = $T_executeT_requetteUser->idEmploye;
        $_SESSION['H_idTypeEmploye'] = $T_executeT_requetteUser->idTypeEmploye;
        $H_session_idEmploye[] = $_SESSION['H_idEmploye'];
        $_SESSION['H_session_idEmploye'] = $H_session_idEmploye;
        $_SESSION['login'] = $T_email;
        $_SESSION['password'] = $T_password;                
        $_SESSION['H_employeConnecte']='connected';
                
        // $H_ifPrivilege = F_gestionPrivilege($_SESSION['H_idEmploye'], 'PRI00005');
        // if($H_ifPrivilege)
            header('Location:http://localhost/FodjoManage/controller/Y_siteController.php?H_idEmploye='.$_SESSION['H_idEmploye'].'');
        // else
        //     header('Location:http://localhost/FodjoManage/controllers/H_dashboardClassicController.php?H_idEmploye='.$_SESSION['H_idEmploye'].'');
    }
}

require('views/loginView.php');
?>