/* EXPANDER MENU */
const showMenu = (navbarId, toggleId) => {
    const navbar = document.getElementById(navbarId),
          toggle = document.getElementById(toggleId)
    if( toggle && navbar ) {
        toggle.addEventListener('click', ()=>{
            navbar.classList.toggle('expander');
        })
    }
}
showMenu('navbar', 'nav-toggle')
showMenu('navbar', 'nav-close')
showMenu('navbar', 'itemEl')

function showMenu_popup(){
    const navbar = document.getElementById('navbar');
    navbar.classList.toggle('expander');
}

function showinfo(){
    const info = document.getElementById('info');
    info.classList.toggle('info_visible');
    info.classList.toggle('info');
}

const showpopup_new = (searchId) => {
    const search = document.getElementById(searchId);
    if (search){
        search.addEventListener('click', ()=>{
            showpopup_new();
            removeMarker();
            removeAllChildNods(listEl);
        })
    }
}
showpopup_new('modal-open')

function zero(){
    var keyword = document.getElementById('keyword').value;
    keyword = "";
    ps.keywordSearch(keyword, placesSearchCB);
}

/* LINK ACTIVE */
const linkColor = document.querySelectorAll('.nav__link')
function colorLink() {
    linkColor.forEach(l=> l.classList.remove('active'))
    this.classList.add('active')
}
linkColor.forEach(l=> l.addEventListener('click', colorLink))

/* COLLAPSE MENU */
const linkCollapse = document.getElementsByClassName('collapse__link')
var i

for(i=0;i<linkCollapse.length;i++) {
    linkCollapse[i].addEventListener('click', function(){
        const collapseMenu = this.nextElementSibling
        collapseMenu.classList.toggle('showCollapse')

        const rotate = collapseMenu.previousElementSibling
        rotate.classList.toggle('rotate')
    });
}

