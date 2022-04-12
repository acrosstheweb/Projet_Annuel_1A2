const login_trigger = document.getElementById("__login-trigger");
const close_login_modal = document.getElementById("__close-login-modal");

const register_trigger = document.getElementById("__register-trigger");
const close_register_modal = document.getElementById("__close-register-modal");

const login_modal = document.getElementById("__login-modal");
const register_modal = document.getElementById("__register-modal");

login_trigger.addEventListener("click", function () {
    if (login_modal.style.display === "none") {
        login_modal.style.display = "block";
    } else {
        login_modal.style.display = "none";
    }
});


close_login_modal.addEventListener("click", function () {
    login_modal.style.display = "none";
});

register_trigger.addEventListener("click", function () {
    if (register_modal.style.display === "none") {
        register_modal.style.display = "block";
    } else {
        register_modal.style.display = "none";
    }
});

close_register_modal.addEventListener("click", function () {
    register_modal.style.display = "none";
});