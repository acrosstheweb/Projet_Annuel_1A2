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

// Reset modal state on open
const modifyModalTrigger = document.getElementsByClassName("modifyModal--trigger");

function unjaaj() {

    for(let i = 0; i < modifyModalTrigger.length; i++){
        modifyPasswordConfirm[i].style.display = "inline-block";
        modifyConfirm[i].style.display = "none";
        modifyFormInfo[i].style.display = "inline-block";
        modifyAdminPassword[i].style.display = "none";
    }
}

for(let j = 0; j < modifyModalTrigger.length; j++){
    modifyModalTrigger[j].addEventListener("click", unjaaj);
}