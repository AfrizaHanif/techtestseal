$(document).ready(function() {
    // Read the index route from the data attribute
    const homeRoute = $('body').data('index-route');

    /**
     * Sets the active class on the correct navigation link based on the current URL.
     * This function is robust and handles reloads and back/forward button presses.
     */
    function setActiveLink() {
        var currentPath = window.location.pathname;
        // Treat the root URL ('/') as the index page for highlighting purposes.
        if (currentPath === '/') {
            currentPath = '/index';
        }

        $('.dynamic-link').removeClass('active');

        $('.dynamic-link').each(function() {
            // 'this.href' gives the full URL of the link (e.g., http://.../index)
            // We parse it to get just the pathname for a reliable comparison.
            var linkPath = new URL(this.href).pathname;
            if (linkPath === currentPath) {
                $(this).addClass('active');
            }
        });
    }

    /**
     * Loads content into the #content-area div via AJAX.
     * @param {string} url - The URL to fetch content from.
     */
    function loadContent(url) {
        // $('#content-area').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
        $('#content-area').html('<div id="preloader" class="preloader"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json', // Expect a JSON response from the server
            success: function(response) {
                // Update the page content with the HTML from the response
                $('#content-area').html(response.html);
                $('#sub-header-area').html(response.sub_header_html);
                // Update the browser tab title
                document.title = response.title + ' | Berita Kini';
            },
            error: function(xhr) {
                $('#content-area').html('<div class="alert alert-danger">Could not load page.</div>');
                console.error(xhr.responseText);
            }
        });
    }

    // Handle navigation clicks for dynamic loading.
    $('.dynamic-link').on('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior.
        var ajaxUrl = $(this).attr('href');
        var linkPath = new URL(ajaxUrl, window.location.origin).pathname; // MOST IMPORTANT PART!!!

        // Determine the URL to display in the browser's address bar.
        var displayUrl = (linkPath === '/index') ? '/' : linkPath;

        // Don't do anything if we are clicking the link for the page we're already on.
        if (window.location.pathname === displayUrl) {
            return;
        }

        history.pushState(null, '', displayUrl);

        // Set active link immediately for better UX and then load content.
        $('.dynamic-link').removeClass('active');
        $(this).addClass('active');
        loadContent(ajaxUrl);
    });

    $(window).on('popstate', function() {
        var ajaxUrl = window.location.pathname;
        if (ajaxUrl === "/") {
            // Use the variable we defined at the top
            ajaxUrl = homeRoute;
        }
        loadContent(ajaxUrl);
        setActiveLink();
    });

    // Set the initial active link on page load.
    setActiveLink();
});
