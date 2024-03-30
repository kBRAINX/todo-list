<?php

if(isset($_POST['id'])) {
    require "../db/database.php";
    $id = $_POST['id'];
    
    // suppression du champ selectionne 
    if(empty($id)) {
        echo 0;
    } else{
        $req = $connect->prepare("DELETE FROM tache WHERE id = ?");
        $reponse = $req->execute([$id]);

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