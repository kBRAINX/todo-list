<?php

if(isset($_POST['id'])){
    require '../db/database.php';

    $id = $_POST['id'];
    
    if(empty($id)){
        echo 'error';
    } else {
        $todos = $connect->prepare("SELECT id, completed FROM tache WHERE id = ?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $checked = $todo['completed'];

        $newChecked = $checked ? 0 : 1;

        $update = $connect->prepare("UPDATE tache SET completed = ? WHERE id = ?");
        $res = $update->execute([$newChecked, $id]);

        if($res){
            echo $newChecked;
        } else {
            echo 'error';
        }

        $connect = null;
        exit();
    }
} else {
    header("Location: ../../index.php?mess=error");
}
?>
