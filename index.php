<?php
    require "./Backend/db/database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="./Frontend/css/style.css">
    <title>todo-list html</title>
</head>
<body>
    <div class="wrapper">
        <div class="task-input">
            <img src="./Frontend/image/bars-sort-svgrepo-com.svg" alt="icon">
            <button class="add-btn" onclick="openForm()">Ajouter une tache</button>
        </div>
        <!-- Pop-up Form -->
        <div class="form-popup" id="myForm">
            <form action="./Backend/function/ajouter.php" method="POST" autocomplete="off"  class="form-container">
                <h2 class="type">Formulaire</h2> 
                <label><b>Titre de la tache</b></label>
                <input type="text" name="title" placeholder="Enter le titre" required>
                <label><b>Description de la tache</b></label>
                <textarea name="message" id="description" cols="30" rows="10" required placeholder="Enter the description of the task"></textarea>
                <button type="submit" class="btn">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>
        <?php
            $request = $connect->query("SELECT * FROM tache ORDER BY id DESC");
        ?>
        <div class="controls">
            <h3>tous vos tasches seronts affiches ci-dessous</h3>
        </div>
        <ul class="task-box">
            <?php while($requests = $request->fetch(PDO::FETCH_ASSOC)) : ?>
                <li class="task">
                    <label for="1">
                        <?php if($requests['completed']){?>
                            <input type="checkbox"  class="check-box" data-todo-id = "<?php echo $requests['id']; ?>" checked>
                            <h2 class="checked"> <?php echo $requests['title'] ?></h2>
                            <?php }else{ ?>
                                <input type="checkbox" data-todo-id = "<?php echo $requests['id']; ?>" class="check-box" >
                            <h2><?php echo $requests['title'] ?></h2>
                        <?php } ?>
                        <p><?php echo $requests['description'] ?></p><br>
                        <small> Create: <?php echo $requests['date'] ?> </small>     
                    </label>
                    <div class="settings">
                        <i class="uil uil-ellipsis-h"></i>
                        <ul class="task-menu">
                            <li id="<?php echo $requests['id']; ?>" class="update-tache"><i class="uil uil-pen"></i>Edit</li>
                            <li id="<?php echo $requests['id']; ?>" class="remove-tache"><i class="uil uil-trash"></i>Delete</li>
                        </ul>
                    </div>
                </li>
            <?php endwhile ?>
        </ul>
        <div id="contenu"></div>
    </div>
    <script src="./Frontend/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>

        //fonction js d'appel de page check.php pour mettre la tache completed
        $(document).ready(function(){
            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('./Backend/function/check.php', { id: id }, function(data) {
                    if(data != 'error'){
                        const h2 = $(this).next();
                        if(data === '1'){
                            h2.removeClass('checked');
                        } else {
                            h2.addClass('checked');
                        }
                    }
                    window.location.reload(true); // Recharger la page
                });
            });
        });

        //fonction js d'appel de page delete.php
        $(document).ready(function(){
            $(".remove-tache").click(function(){
                const id = $(this).attr("id");
                if(confirm("Voulez-vous vraiment supprimer cet élément?")){
                    $.ajax({
                        type: "POST",
                        url: "./Backend/function/delete.php",
                        data: {id: id},
                        success: function(response){
                            if(response == "success"){
                                window.location.reload(true); // Recharger la page
                            } else{
                                alert("Une erreur s'est produite lors de la suppression.");
                            }
                        }
                    });
                }
            });
        });

        //fonction de mofification de la tache
        $(document).ready(function(){
        $(".update-tache").click(function() {
            // Récupérer l'ID de la tâche
            var taskId = $(this).attr('id');
            // Utiliser fetch pour récupérer le contenu de la page de mise à jour
            fetch('./Backend/forms/updateForm.php?id=' + taskId)
                .then(response => response.text())
                .then(data => {
                    // Afficher le contenu récupéré dans un élément de la page actuelle
                    document.getElementById('contenu').innerHTML = data;
                })
                .catch(error => console.error('Erreur lors de la récupération des données:', error));
            });
        });

    </script>
</body>
</html>