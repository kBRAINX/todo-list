<?php

if(isset($_POST['id'])) {
    require "../db/database.php";
    
    // suppression du champ selectionne 
    if(empty($id)) {
        echo 0;
    } else{
        $req = $connect->prepare("DELETE FROM tache");
        $reponse = $req->execute();

        if($reponse){
            echo "success";
        } else{
            echo "error";
        }
        $connect = null;
        exit();
    }
} else{
    header("Location: ../../index.php?msg=error");
}