const delete_account_button = document.getElementById("__profileDeleteAccount");
const export_data_button = document.getElementById("__profileExportDataRGPD");
const Submit_button = document.getElementById("__profileSecSubmit");
const Cancel_button = document.getElementById("__profileSecCancel");

const modify_email_trigger = document.getElementById("__profileSecModifyEmail");
const email_Value = document.getElementById("__profileSecMailValue");
const email_Input = document.getElementById("__profileSecMailInput");

const modify_password_trigger = document.getElementById("__profileSecModifyPassword");
const password_Value = document.getElementById("__profileSecPasswordValue");
const password_Input = document.getElementById("__profileSecPasswordInput");

function modifyEmail() {
    modify_email_trigger.style.display = "none";
    delete_account_button.style.display = "none";
    export_data_button.style.display = "none";
    email_Value.style.display = "none";

    Submit_button.style.display = "inline-block";
    Cancel_button.style.display = "inline-block";
    email_Input.style.display = "inline-block";
}

function modifyPassword() {
    modify_password_trigger.style.display = "none";
    delete_account_button.style.display = "none";
    export_data_button.style.display = "none";
    password_Value.style.display = "none";

    Submit_button.style.display = "inline-block";
    Cancel_button.style.display = "inline-block";
    password_Input.style.display = "inline-block";
}

modify_email_trigger.addEventListener("click", modifyEmail);
modify_password_trigger.addEventListener("click", modifyPassword);