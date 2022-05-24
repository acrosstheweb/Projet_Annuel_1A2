// ----- barre de recherche -----
const search_trigger = document.getElementById("__search-trigger");
const searchbar = document.getElementById("__searchbar");

search_trigger.addEventListener("click", function(){
    const searchbar_state = searchbar.style.display;
    if(searchbar_state === "block"){
        searchbar.style.display = "none";
        search_trigger.innerHTML = "<a class='nav-link __navIcon' href='#'><i class='fa-solid fa-magnifying-glass'></i></a>";
    }else{
        /*search_trigger.style.display = "none";*/
        search_trigger.innerHTML = "<a class='nav-link __navIcon' href='#'><i class='fa-solid fa-xmark'></i></a>";
        searchbar.style.display = "block";
    }
});