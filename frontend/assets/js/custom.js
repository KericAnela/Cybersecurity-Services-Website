$(document).ready(function() {

    var app = $.spapp({
        defaultView: "main",
        templateDir: "./views/"
    });

    app.route({ view: 'main', load: 'main.html' });
    app.route({ view: 'about', load: 'about.html' });
    app.route({ view: 'contact', load: 'contact.html' });
    app.route({ view: 'services', load: 'services.html' });

    app.run();

    function updateActiveNav() {
        var currentHash = window.location.hash || '#main';

        $('.navbar-nav .nav-link').removeClass('active').removeAttr('aria-current');
        $('.navbar-nav .nav-link[href="' + currentHash + '"]').addClass('active').attr('aria-current', 'page');
    }

    updateActiveNav();

    $(window).on('hashchange', function() {
        updateActiveNav();
    });
});