function changeRecipe(pizzaName){
    const path1 = "../receptek/" + pizzaName + "/" + pizzaName + "Hozzavalok.txt";
    const path2 =  "../receptek/" + pizzaName + "/" + pizzaName + "Elkeszites.txt";
    (async () => {
        var text1 = await (await fetch(path1)).text();   
        var text2 = await (await fetch(path2)).text(); 
        document.getElementById('recipe').innerHTML = text1;
        document.getElementById('recipe').innerHTML += text2;
        document.getElementById('recipe').scrollIntoView();
    })()

}