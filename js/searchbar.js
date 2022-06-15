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

// prototypage ajax
function search(text){
    let searchBarResult = document.getElementById("__searchbar-results");
    if(text.length != 0){
        let XML = new XMLHttpRequest();
        XML.onreadystatechange = function(){
            if(XML.readyState == 4 && XML.status == 200){
                searchBarResult.innerHTML = XML.responseText;
            }
        };

        XML.open('GET', `searchBar.php?q=${text}`, true);
        XML.send();
    }else{
        searchBarResult.innerHTML = '';
    }
}