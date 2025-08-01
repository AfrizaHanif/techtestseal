// Get the preloader element
const preloader = document.getElementById('preloader');

/**
 * Hides the preloader with a fade-out effect.
 */
const hidePreloader = () => {
    if (preloader) {
        preloader.classList.add('hidden');
    }
};

/**
 * Shows the preloader.
 */
const showPreloader = () => {
    if (preloader) {
        preloader.classList.remove('hidden');
    }
};

// --- EVENT LISTENERS ---

// 1. Hide preloader when the page is fully loaded
window.addEventListener('load', () => {
    // Use a small timeout to prevent the preloader from disappearing too quickly
    // if the page loads instantaneously.
    setTimeout(hidePreloader, 500);
});

// 2. Show preloader when a link with the 'show-preloader' class is clicked
document.addEventListener('DOMContentLoaded', () => {
    const preloaderLinks = document.querySelectorAll('.show-preloader');
    preloaderLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            // Prevent immediate navigation
            event.preventDefault();

            // Show the preloader
            showPreloader();

            // Get the fully resolved URL. This is the fix.
            // link.href returns the full URL (e.g., http://.../?page=home)
            const href = link.href;

            // Navigate to the new page after a short delay to allow the preloader to be seen
            setTimeout(() => {
                if (href) {
                    window.location.href = href;
                }
            }, 500); // 500ms delay
        });
    });
});
