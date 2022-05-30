const modify_email_trigger = document.getElementById("__profileModifyEmail");
const modify_password_trigger = document.getElementById("__profileModifyPassword");

const delete_account_button = document.getElementById("__profileDeleteAccount");
const export_data_button = document.getElementById("__profileExportDataRGPD");
const profileInfoSubmit = document.getElementById("__profileInfoSubmit");
const profileInfoCancel = document.getElementById("__profileInfoCancel");


const profileInfoValue = document.getElementsByClassName("__profileInfoValue");
const profileInfoInput = document.getElementsByClassName("__profileInfoInput");


function jaaj() {
    for(let i = 0; i < profileInfoValue.length; i++){
        profileInfoValue[i].style.display = "none";
        profileInfoInput[i].style.display = "inline-block";
    }
    profileInfoModify_trigger.style.display = "none";
    profileInfoSubmit.style.display = "inline-block";
    profileInfoCancel.style.display = "inline-block";
}

profileInfoModify_trigger.addEventListener("click", jaaj);
