document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger-menu');
    const navMenu = document.querySelector('.nav-menu');
    const searchForm = document.querySelector('.search-submit');
    const loader = document.getElementById('loader');

    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
    });
    document.querySelectorAll('.nav-menu a').forEach(link => {
        link.addEventListener('click', () => {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
        });
    });
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            loader.style.display = 'block';
            
            const tableContainer = document.querySelector('.product-table-container');
            if (tableContainer) {
                tableContainer.style.opacity = '0.5';
            }
        });
    }
}); 