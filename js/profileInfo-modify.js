const profileInfoModify_trigger = document.getElementById("__profileInfoModify--trigger");
const profileInfoSubmit = document.getElementById("__profileInfoSubmit");
const profileInfoCancel = document.getElementById("__profileInfoCancel");


const profileInfoValue = document.getElementsByClassName("__profileInfoValue");
const profileInfoInput = document.getElementsByClassName("__profileInfoInput");


function jaaj() {
    for(let i = 0; i < profileInfoValue.length; i++){
        console.log(profileInfoValue[i]);
        profileInfoValue[i].style.display = "none";
        profileInfoInput[i].style.display = "inline-block";
    }
    profileInfoModify_trigger.style.display = "none";
    profileInfoSubmit.style.display = "inline-block";
    profileInfoCancel.style.display = "inline-block";
}

profileInfoModify_trigger.addEventListener("click", jaaj);
