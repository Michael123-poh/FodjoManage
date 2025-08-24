<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']); 

// 1. Connexion à la BD (comme dans votre exemple)
require_once('models/H_databaseConnection.php');
$H_dbConnect = F_databaseConnection("localhost", "fodjomanage2", "root", "");

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
        // Tableau complet
            $params = ['page'=>'Y_site', 'H_idEmploye'=>$_SESSION['H_idEmploye']];

            // Extraire la page
            $page = $params['page'];
            unset($params['page']); // enlève la page des params à encoder

            // Encoder les autres params
            $encodedParams = encodeUrl($params);

            // Construire l'URL
            $url = "/FodjoManage/$page/$encodedParams";

            header('Location:'. $url);
            exit;
        // else
        //     header('Location:http://localhost/FodjoManage/controllers/H_dashboardClassicController.php?H_idEmploye='.$_SESSION['H_idEmploye'].'');
    }
}

// Affichage de la vue de connexion
require('views/loginView.php');
?>