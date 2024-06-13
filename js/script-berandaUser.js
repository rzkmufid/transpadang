// Toggle navigation menu
const toggleMenu = document.querySelector('nav .toggle-menu');
const navMenu = document.querySelector('nav .nav-menu');

toggleMenu.addEventListener('click', function () {
    navMenu.classList.toggle('show');
    
    if (navMenu.classList.contains('show')) {
        this.classList.replace('bx-menu', 'bx-x');
    } else {
        this.classList.replace('bx-x', 'bx-menu');
    }
});

// Highlight active section in navigation
const allSections = document.querySelectorAll('section, header');

window.addEventListener('scroll', function () {
    allSections.forEach(item => {
        const sectionTop = item.offsetTop - 50;
        const sectionBottom = sectionTop + item.offsetHeight - 50;
        const scrollPosition = this.scrollY;
        
        if (scrollPosition >= sectionTop && scrollPosition <= sectionBottom) {
            const activeLink = navMenu.querySelector('a.active');
            if (activeLink) activeLink.classList.remove('active');
            
            const targetLink = navMenu.querySelector(`a[href="#${item.id}"]`);
            if (targetLink) targetLink.classList.add('active');
        }
    });
});
