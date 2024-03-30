<?php
require_once "../db/database.php";
$id = htmlspecialchars($_POST['id']);
$title = htmlspecialchars($_POST['title']);
$description =htmlspecialchars($_POST['message']);

if(isset($_POST['title'], $_POST['message'])) {

    // Mettre à jour les données de la tâche dans la base de données
    $stmt = $connect->prepare("UPDATE tache SET title = ?, description = ? WHERE id = ?");
    $result = $stmt->execute([$title, $description, $id]);

    if($result) {
        header("Location: ../../index.php"); // Redirection vers l'accueil si la mise à jour est reussie
    } else {
        echo "Une erreur s'est produite lors de la mise à jour de la tâche.";
    }
} else {
    header("Location: ../../index.php?msg=error");
}
?>
