let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}


let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}


window.onscroll = () => {
    profile.classList.remove('active');
    navbar.classList.remove('active');
}


document.querySelectorAll(".navbar a, .icons a").forEach(link => {
    if (link.pathname === window.location.pathname) {
        link.classList.add("active");
    }
});





// Save scroll position before reload (with page-specific key)
window.onbeforeunload = function() {
    let key = "scrollPosition-" + window.location.pathname;
    localStorage.setItem(key, window.scrollY);
};

// Restore scroll position only for this page
window.onload = function() {
    let key = "scrollPosition-" + window.location.pathname;
    let pos = localStorage.getItem(key);
    if (pos) {
        window.scrollTo(0, pos);
    }
};

