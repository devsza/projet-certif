// MENU BURGER

const header = document.querySelector('header');
const hero = document.querySelector('.hero-section');

const options = {
   rootMargin: '-70px'
}
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
             header.classList.remove('changeColor')
        } else {
            header.classList.add('changeColor')
        }
    })
}, options)


observer.observe(hero)

function toggleMenu () {
    const navbar = document.querySelector('.navbar');
    const burger = document.querySelector('.burger');
    burger.addEventListener('click', () => {
        navbar.classList.toggle('show-nav');
    })
}
toggleMenu();



let dialog; 

if(document.getElementById('dialogDelete') != null)  { 
    dialog = document.getElementById('dialogDelete'); 
    dialog.addEventListener('close', (e) => {
        fetchIdArticle(e);
    });
}


// Button delete
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".js_article_button_deleted").forEach((element) => {
        element.addEventListener("click", (e) => fetchIdArticle(e));
    });
});

const fetchIdArticle = (e) => {
    let sheet_id = e.currentTarget.dataset.sheet_id;
    document.getElementById("js_sheet_id").value = sheet_id;
    console.log(sheet_id);
};
