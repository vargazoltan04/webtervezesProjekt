
function centerScroll (id){
    const viewportHeight = window.innerHeight;
    const div = document.getElementById(id);

    const elementTop = div.offsetTop;
    window.scrollTo(0, elementTop - viewportHeight/3);
}