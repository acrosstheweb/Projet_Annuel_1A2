const gymFilters = document.getElementsByClassName('__gym-filter');
const sportFilters = document.getElementsByClassName('__sport-filter');
const events = document.getElementsByClassName("__calendarEvent");

function filterGym(n) {

    for (let event of events) {
        classEvent = event.classList;

        arrayClass = [];

        for (let i = 0; i < classEvent.length; i++) {
            arrayClass.push(classEvent[i]);
        }

        if (n == "all") {
            if (arrayClass.includes("d-none")) {
                event.classList.remove("d-none");
            }
        } else if (!arrayClass.includes(`__event-${n}`)) {
            event.classList.add("d-none");
        } else {
            if (arrayClass.includes("d-none")) {
                event.classList.remove("d-none");
            }
        }
    }
}

function filterSport(n) {

    for (let event of events) {
        classEvent = event.classList;

        arrayClass = [];

        for (let i = 0; i < classEvent.length; i++) {
            arrayClass.push(classEvent[i]);
        }

        if (n == "all") {
            if (arrayClass.includes("d-none")) {
                event.classList.remove("d-none");
            }
        } else if (!arrayClass.includes(`__event-${n}`)) {
            event.classList.add("d-none");
        } else {
            if (arrayClass.includes("d-none")) {
                event.classList.remove("d-none");
            }
        }
    }
}

for (let gymFilter of gymFilters) {
    gymFilter.addEventListener("click", function() {
        filterGym(gymFilter.getAttribute("data-gym"));
    })
}

for (let sportFilter of sportFilters) {
    console.log(sportFilter.getAttribute("data-sport"));
    sportFilter.addEventListener("click", function() {
        filterSport(sportFilter.getAttribute("data-sport"));
    })
}