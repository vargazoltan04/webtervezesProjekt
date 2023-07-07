function getAr(element) {
    return parseInt(element.getElementsByTagName('span')[0].textContent);
}

var webshopItems
function sort(method) {
    webshopItems = document.getElementsByClassName('webshop-container-item');
    console.log(webshopItems[0]);
    for(var i = 0; i < webshopItems.length - 1; i++) {
        for(var j = 0; j < webshopItems.length - i - 1; j++) {
            if(getAr(webshopItems[j]) < getAr(webshopItems[j + 1])) {
                var temp = webshopItems[j];
                webshopItems[j] = webshopItems[j+1];
                webshopItems[j+1] = temp;
            }
        }
    }

    //var webshop = document.getElementById('webshop-container');
    /*
    for(var i = 0; i < webshopItems.length; i++) {
        webshop.append(webshopItems[i]);
    }
    */
}