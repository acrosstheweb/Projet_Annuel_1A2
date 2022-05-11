const deletePasswordConfirm = document.getElementById("delete-passwordConfirm");
const deleteAdminPassword = document.getElementById("delete-adminPassword");
const deleteConfirm = document.getElementById("delete-confirm");
const deletePasswordConfirmDescription = document.getElementById("delete-passwordConfirmDescription");


function jaaj() {
    deletePasswordConfirmDescription.innerHTML = "Afin d'enregistrer ces modifications, veuillez saisir votre mot de passe :"

    deletePasswordConfirm.style.display = "none";
    deleteAdminPassword.style.display = "block";
    deleteConfirm.style.display = "inline-block";
}

deletePasswordConfirm.addEventListener("click", jaaj);
