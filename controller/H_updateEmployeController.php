<?php
    session_start(); //demarrer la session
    //************* appel du fichier de connexion a la base de donnée***** */
    require_once("models/H_databaseConnection.php");
    $H_dbConnect = F_databaseConnection("localhost", "fodjomanage2", "root", "");

    // Recuperer l'URL décodée
    // $idEmployeToUpdate = $Y_urlDecoder['H_idEmployeUpdate'];
    $H_idEmployeConnected = $Y_urlDecoder['H_idEmploye']; 
     // declaration des variables et attributs
    $H_tableauErreurs = [];
    $H_regexTelephone = "/^(6[2]|6[5-9])([0-9]{7})/";

   
    if(($_SESSION['H_employeConnecte']==='connected'))
    {

        if(isset($H_idEmployeConnected) && $H_idEmployeConnected === $_SESSION['H_idEmploye'] )

        {
            echo "Vous etes connecte en tant que ".$_SESSION['H_employeConnecte'];  
            if(isset($_POST['Sauvegarder'])) //si le user clique sur le btn enregistrer
            {   
                $idEmployeToUpdate = isset($_POST['H_idEmployeUpdate']) ? $_POST['H_idEmployeUpdate'] : null;
                echo $idEmployeToUpdate;
                // $_SESSION['H_idEmployeUpdate'] = $idEmployeToUpdate; //on stock l'id de l'employé a mettre a jour dans la session
                // extract($_POST); //extraction du contenu du tableau $_POST
                // $H_tableauValeurs = array($H_nomEmploye, $H_pseudoEmploye, $H_dateNaisEmploye, $H_emailEmploye, $H_telephoneEmploye, $H_adresseEmploye, $H_idPosteEmploye);
                // $H_notesEmploye;
                // //var_dump($_POST);
        
                //     if(F_exclureChampsVide($H_tableauValeurs) == true) //verifie si tous les champs sont remplis
                //     {
                //         if(mb_strlen($H_nomEmploye) >= 2)
                //         {
                //                 if(preg_match($H_regexTelephone, $H_telephoneEmploye)) // mb_strlen($H_telephoneEmploye) >= 9 && mb_strlen($H_telephoneEmploye) <= 18
                //                 {
                //                  if(filter_var($H_emailEmploye, FILTER_VALIDATE_EMAIL)) //verifie si l'email est valide
                //                  {
                                               
                                                         
                //                                             // ---------------------------------------------------- Dans la table Employe ------------------------------------------

                //                                             // var_dump(array($Y_idEmploye, $H_idEmploye, strtoupper($H_nomEmploye)." ".strtoupper($H_prenomEmploye), $H_adresseEmploye, $H_telephoneEmploye, , $H_dateNaisEmploye, $, $H_notesEmploye));
                //                                             // exit;
                //                                             $H_updateEmploye = 'UPDATE employe  SET idTypeEmploye = ?, nomEmploye = ?, pseudoEmploye = ?, emailEmploye = ?, adresseEmploye = ?, dateNaisEmploye = ?, telephoneEmploye = ?, dateCreateEmploye = NOW() WHERE idEmploye = ?';
                //                                             $H_tableauParametres = [$H_idPosteEmploye, strtoupper($H_nomEmploye), $H_pseudoEmploye, $H_emailEmploye, $H_adresseEmploye, $H_dateNaisEmploye, $H_telephoneEmploye, $_SESSION['H_idEmployeUpdate']];
                //                                             $H_executeUpdateEmploye = F_executeRequeteSql($H_updateEmploye, $H_tableauParametres); //ajoute le nouveau Employe pour la descente
                //                                             $H_tableauErreurs[] = 'Cet Employe a été modifié avec success!!!';

                //                                             // Redirection vers la page de TOUS les Employe
                //                                             header('Location:'.contructUrl('H_employes' , ['H_idEmploye'=>$_SESSION['H_idEmploye']]));
                //                                             exit;
                //                  }
                //                  else
                //                  {
                //                     $H_tableauErreurs[] = 'L\'email est incorrect!';
                //                  }
                //                 }
                //                 else
                //                 {
                //                     $H_tableauErreurs[] = 'Le numero de telephone est incorrect!';
                //                 }
                //         }
                //         else
                //         {
                //             $H_tableauErreurs[] = 'Le nom est trop court!';
                //         }
                //     }
                //     else
                //     {
                //         $H_tableauErreurs[] = 'Veuillez remplir tous les champs!';
                //     }
                    $H_afficheErreur = F_flashErrors($H_tableauErreurs);
                }
        }
    }
    else
        //var_dump($_SESSION['H_employeConnecte']);
        header('Location:index.php');
  
?>