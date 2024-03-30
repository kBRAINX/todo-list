<?php
require "../db/database.php";

if(isset($_GET['id'])) {
    $id =htmlspecialchars($_GET['id']);

    // Récupérer les données de la tâche à partir de son ID
    $stmt = $connect->prepare("SELECT * FROM tache WHERE id = ?");
    $stmt->execute([$id]);
    $reponse = $stmt->fetch(PDO::FETCH_ASSOC);

} else {
    echo "ID de la tâche non spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Frontend/css/style.css">
    <title>Update Task</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <!-- Pop-up updateForm -->
    <div class="form-popup2" id="updateForm">
        <form action="./Backend/function/modifier.php" method="POST" autocomplete="off"  class="form-container">
            <h2>Modification</h2> 
            <label><b>Titre de la tache</b></label>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input type="text" name="title" placeholder="Enter le titre" value="<?php echo $reponse['title']; ?>" required>
            <label><b>Description de la tache</b></label>
            <textarea name="message" id="description" cols="30" rows="10" placeholder="Enter the description of the task" required><?php echo $reponse['description']; ?></textarea>
            <button id="<?php echo $reponse['id'];?>" type="submit" class="btn">Modifier</button>
            <button type="button" class="btn cancel" onclick="closeUpdateForm()">Close</button>
        </form>
    </div>
    <script src="../../Frontend/js/script.js"></script>
</body>
</html>
