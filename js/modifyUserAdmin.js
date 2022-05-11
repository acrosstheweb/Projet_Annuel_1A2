const modifyPasswordConfirm = document.getElementById("modify-passwordConfirm");
const modifyAdminPassword = document.getElementById("modify-adminPassword");
const modifyConfirm = document.getElementById("modify-confirm");


function jaaj() {
    modifyPasswordConfirm.style.display = "none";
    modifyAdminPassword.style.display = "block";
    modifyConfirm.style.display = "inline-block";
}

modifyPasswordConfirm.addEventListener("click", jaaj);
