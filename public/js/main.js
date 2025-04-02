// Navigation menu functionality
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu-item');
    const submenuItems = document.querySelectorAll('.submenu-item');
    const contentSections = document.querySelectorAll('.content-section');
    const pageTitle = document.querySelector('.page-title');

    // Toggle submenu when clicking on a menu item with submenu
    menuItems.forEach(item => {
        if (item.classList.contains('has-submenu')) {
            item.addEventListener('click', function() {
                const submenu = this.nextElementSibling;
                const arrow = this.querySelector('.menu-arrow');

                submenu.classList.toggle('open');
                arrow.classList.toggle('open');

                // If opening a submenu, also make the menu item active
                if (submenu.classList.contains('open')) {
                    menuItems.forEach(menuItem => {
                        menuItem.classList.remove('active');
                    });
                    this.classList.add('active');
                }
            });
        } else {
            item.addEventListener('click', function() {
                // Update active menu item
                menuItems.forEach(menuItem => {
                    menuItem.classList.remove('active');
                });
                this.classList.add('active');

                // Close any open submenus when clicking other menu items
                document.querySelectorAll('.submenu').forEach(sub => {
                    sub.classList.remove('open');
                });
                document.querySelectorAll('.menu-arrow').forEach(arrow => {
                    arrow.classList.remove('open');
                });

                // Show corresponding content section
                const sectionId = this.getAttribute('data-section');
                contentSections.forEach(section => {
                    section.classList.remove('active');
                });
                document.getElementById(sectionId).classList.add('active');

                // Update page title
                pageTitle.textContent = this.textContent.trim();
            });
        }
    });

    // Handle submenu item clicks
    submenuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent triggering parent click

            // Update active submenu item
            submenuItems.forEach(subItem => {
                subItem.classList.remove('active');
            });
            this.classList.add('active');

            // Show corresponding content section
            const sectionId = this.getAttribute('data-section');
            contentSections.forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');

            // Update page title
            pageTitle.textContent = this.textContent.trim();
        });
    });

    // Add event listeners for buttons (demo functionality)
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.classList.contains('btn-edit')) {
                alert('Editar item (Funcionalidade de demonstração)');
            } else if (this.classList.contains('btn-delete')) {
                alert('Excluir item (Funcionalidade de demonstração)');
            } else if (this.classList.contains('add-button')) {
                alert('Adicionar novo item (Funcionalidade de demonstração)');
            }
        });
    });
});