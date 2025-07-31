/*!
 * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
 * Copyright 2011-2025 The Bootstrap Authors
 * Licensed under the Creative Commons Attribution 3.0 Unported License.
 */

(() => {
    'use strict'

    // Function to get the stored theme from localStorage
    const getStoredTheme = () => localStorage.getItem('theme')
    // Function to store the theme in localStorage
    const setStoredTheme = theme => localStorage.setItem('theme', theme)

    // Function to determine the preferred theme
    const getPreferredTheme = () => {
        const storedTheme = getStoredTheme()
        if (storedTheme) {
            return storedTheme
        }

        // If no theme is stored, use 'auto' as the default
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
    }

    // Function to set the theme on the <html> element
    const setTheme = theme => {
        if (theme === 'auto') {
            document.documentElement.setAttribute('data-bs-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'))
            } else {
            document.documentElement.setAttribute('data-bs-theme', theme)
        }
    }

    // Set the initial theme when the script loads
    setTheme(getPreferredTheme())

    // (MODIFIED) Function to update the active state and icon for the theme switcher
    // WEB VERSION
    // const showActiveTheme = (theme, focus = false) => {
    //     const themeSwitcher = document.querySelector('#bd-theme')

    //     if (!themeSwitcher) {
    //         return
    //     }

    //     const themeSwitcherText = document.querySelector('#bd-theme-text')
    //     const activeThemeIcon = document.querySelector('.theme-icon-active use')
    //     const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
    //     const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

    //     document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
    //         element.classList.remove('active')
    //         element.setAttribute('aria-pressed', 'false')
    //     })

    //     btnToActive.classList.add('active')
    //     btnToActive.setAttribute('aria-pressed', 'true')
    //     activeThemeIcon.setAttribute('href', svgOfActiveBtn)
    //     const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
    //     themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

    //     if (focus) {
    //         themeSwitcher.focus()
    //     }
    // }
    // GEMINI VERSION
    const showActiveTheme = (theme) => {
        const themeSwitcher = document.querySelector('#themeDropdown')
        if (!themeSwitcher) {
            return
        }

        const themeSwitcherIcon = themeSwitcher.querySelector('.theme-icon-active')
        const activeThemeBtn = document.querySelector(`[data-bs-theme-value="${theme}"]`)

        // Update the main dropdown button's icon
        if (theme === 'light') {
            themeSwitcherIcon.className = 'bi bi-sun-fill theme-icon-active';
        } else if (theme === 'dark') {
            themeSwitcherIcon.className = 'bi bi-moon-stars-fill theme-icon-active';
        } else {
            themeSwitcherIcon.className = 'bi bi-circle-half theme-icon-active';
        }

        // Remove active class from all buttons
        document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
            element.classList.remove('active')
        })

        // Add active class to the currently selected button
        if (activeThemeBtn) {
            activeThemeBtn.classList.add('active')
        }
    }

    // Add an event listener for changes in the OS color scheme
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        const storedTheme = getStoredTheme()
        if (storedTheme !== 'light' && storedTheme !== 'dark') {
            setTheme(getPreferredTheme())
        }
    })

    // When the DOM is fully loaded, set up event listeners
    window.addEventListener('DOMContentLoaded', () => {
        showActiveTheme(getPreferredTheme())

        // (MODIFIED) Add click event listeners to all theme buttons
        document.querySelectorAll('[data-bs-theme-value]')
            .forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const theme = toggle.getAttribute('data-bs-theme-value')
                    setStoredTheme(theme)
                    setTheme(theme)
                    // showActiveTheme(theme, true)
                    showActiveTheme(theme)
                })
            })
    })
})()
