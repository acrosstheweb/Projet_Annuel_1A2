// ---- DEBUT de la partie modifyUserAdmin ----
const modifyPasswordConfirm = document.getElementsByClassName("modify-passwordConfirm"),
    modifyConfirm = document.getElementsByClassName("modify-confirm"),
    modifyFormInfo = document.getElementsByClassName("modifyFormInfo"),
    modifyAdminPassword = document.getElementsByClassName("modify-adminPassword");

function openModifyConfirm() {
    for(let i = 0; i < modifyPasswordConfirm.length; i++){
        modifyPasswordConfirm[i].style.display = "none";
        modifyConfirm[i].style.display = "inline-block";
        modifyFormInfo[i].style.display = "none";
        modifyAdminPassword[i].style.display = "block";
    }
}

for(let i = 0; i < modifyPasswordConfirm.length; i++){
    modifyPasswordConfirm[i].addEventListener("click", openModifyConfirm);
}

// ---- FIN de la partie modifyUserAdmin ----

// ---- DEBUT de la partie deleteUserAdmin ----
const deletePasswordConfirm = document.getElementsByClassName("delete-passwordConfirm"),
    deleteConfirm = document.getElementsByClassName("delete-confirm"),
    deletePasswordConfirmDescription = document.getElementsByClassName("delete-passwordConfirmDescription"),
    deleteAdminPassword = document.getElementsByClassName("delete-adminPassword"), // Champ mot de passe de l'admin
    deleteFormInfo = document.getElementsByClassName("deleteFormInfo");

function openDeleteConfirm() {
    for(let i = 0; i < deletePasswordConfirm.length; i++) {
        deletePasswordConfirmDescription[i].innerHTML = "Afin d'enregistrer ces modifications, veuillez saisir votre mot de passe :"
        deletePasswordConfirm[i].style.display = "none";
        deleteAdminPassword[i].style.display = "block";
        deleteConfirm[i].style.display = "inline-block";
    }
}

for(let i = 0; i < deletePasswordConfirm.length; i++){
    deletePasswordConfirm[i].addEventListener("click", openDeleteConfirm);
}

// ---- FIN de la partie deleteUserAdmin ----


function sortColumn(n,tableId) {
    let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(tableId);
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}


// Reset modal state on open
const modifyModalTrigger = document.getElementsByClassName("modifyModal--trigger");

function resetModifyModalState() {
    for(let i = 0; i < modifyModalTrigger.length; i++){
        modifyPasswordConfirm[i].style.display = "inline-block";
        modifyConfirm[i].style.display = "none";
        modifyFormInfo[i].style.display = "inline-block";
        modifyAdminPassword[i].style.display = "none";
    }
}

for(let j = 0; j < modifyModalTrigger.length; j++){
    modifyModalTrigger[j].addEventListener("click", resetModifyModalState);
}

const deleteModalTrigger = document.getElementsByClassName("deleteModal--trigger");

function resetDeleteModalState() {
    for(let i = 0; i < modifyModalTrigger.length; i++){
        deletePasswordConfirmDescription[i].innerHTML = "Êtes-vous sûr de vouloir le supprimer?"
        deletePasswordConfirm[i].style.display = "inline-block";
        deleteConfirm[i].style.display = "none";
        deleteFormInfo[i].style.display = "inline-block";
        deleteAdminPassword[i].style.display = "none";
    }
}

for(let j = 0; j < deleteModalTrigger.length; j++){
    deleteModalTrigger[j].addEventListener("click", resetDeleteModalState);
}
