<?php

if(isset($_POST['title']) && isset($_POST['message'])) {
    require "../db/database.php";
    $titre = htmlspecialchars($_POST['title']);
    $contenu = htmlspecialchars($_POST['message']);
    
    // On vérifie que les champs ne sont pas vides
    if(empty($titre) && empty($contenu)) {
        header("Location: ../../index.php?msg=error");
    } else{
        $req = $connect->prepare("INSERT INTO tache (title, description) VALUES (?, ?)");
        $reponse = $req->execute([$titre, $contenu]);

        if($reponse){
            header('Location: ../../index.php');
        } else{
            header('Location: ../../index.php');
        }
        $connect = null;
        exit();
    }
} else{
    header("Location: ../../index.php?msg=error");
}