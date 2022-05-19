// ----- barre de recherche -----
const search_trigger = document.getElementById("__search-trigger");
const searchbar = document.getElementById("__searchbar");


search_trigger.addEventListener("click", function(){
    search_trigger.style.display = "none";
    searchbar.style.display = "block";
});


// function showSearchbar(){
//     search_trigger.style.display = "none";
//     searchbar.style.display = "block";
// };