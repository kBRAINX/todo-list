// Fonction d'ouverture du formulaire
function openForm() {
  document.getElementById("myForm").style.display = "block";
}
  
// fonction de fermeture du formulaire
function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function openUpdateForm(id) {
  // Appeler updateForm.php avec l'identifiant de la tâche
  $.get('./Backend/forms/updateForm.php?id=' + id, function(data) {
    // Afficher le contenu de updateForm.php dans la popup
    $('#updateForm .form-container').html(data);
    // Ouvrir la popup uniquement si l'élément avec l'ID updateForm existe
    var updateFormElement = document.getElementById("updateForm");
    if (updateFormElement) {
      updateFormElement.style.display = "block";
    }
  });
}


// Fermer le formulaire de mise à jour
function closeUpdateForm() {
  document.getElementById("updateForm").style.display = "none";
}
