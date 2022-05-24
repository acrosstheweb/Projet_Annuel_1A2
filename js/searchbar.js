// ----- barre de recherche -----
const search_trigger = document.getElementById("__search-trigger");
const searchbar = document.getElementById("__searchbar");

search_trigger.addEventListener("click", function(){
    const searchbar_state = searchbar.style.display;
    if(searchbar_state === "block"){
        searchbar.style.display = "none";
    }else{
        /*search_trigger.style.display = "none";*/
        searchbar.style.display = "block";
    }
});