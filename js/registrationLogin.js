
//Paraméterben meg kapja, hogy a login formot, vagy a regisztrációs formot kell elrejteni
//ha a 'formLogin' szöveget kapja, akkor a login formot elrejti és megjeleníti a regisztrációsat
//ha a 'formRegistration' szöveget kapja akkor elrejti a regisztrációsat és megjeleníti a logint
function changeForm(whichFormToHide) {
    if(whichFormToHide == "formRegistration") {
        document.getElementById("formLogin").classList.remove("hidden");
        document.getElementById("formLogin").classList.add("form");
        document.getElementById(whichFormToHide).classList.add("hidden");
        document.getElementById(whichFormToHide).classList.remove("form");
    } else if(whichFormToHide == "formLogin") {
        document.getElementById("formRegistration").classList.remove("hidden");
        document.getElementById("formRegistration").classList.add("form");
        document.getElementById(whichFormToHide).classList.add("hidden");
        document.getElementById(whichFormToHide).classList.remove("form");
    }
}