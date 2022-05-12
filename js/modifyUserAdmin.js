const modifyPasswordConfirm = document.getElementsByClassName("modify-passwordConfirm");
const modifyConfirm = document.getElementsByClassName("modify-confirm");
const modifyFormInfo = document.getElementsByClassName("modifyFormInfo");
const modifyAdminPassword = document.getElementsByClassName("modify-adminPassword");


function jaaj() {

    for(let i = 0; i < modifyPasswordConfirm.length; i++){
        modifyPasswordConfirm[i].style.display = "none";
        modifyConfirm[i].style.display = "inline-block";
        modifyFormInfo[i].style.display = "none";
        modifyAdminPassword[i].style.display = "block";
    }
}

for(let i = 0; i < modifyPasswordConfirm.length; i++){
    modifyPasswordConfirm[i].addEventListener("click", jaaj);
}
