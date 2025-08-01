<!doctype html>
<html lang="en" data-bs-theme="auto">
    <head>
        <!--META IN EVERY TEMPLATES-->
        @include('templates.includes.meta.meta')
        <!--META IN HOME TEMPLATE ONLY-->
        @include('templates.includes.meta.meta')
        <!--TITLE-->
        @yield('title')
        <!--FONTS-->
        @include('templates.includes.fonts.font')
        <!--CSS SOURCES IN EVERY TEMPLATES-->
        @include('templates.includes.sources.css')
    </head>
    <body class="d-flex flex-column min-vh-100">
    {{-- PRELOADER --}}
    @include('templates.includes.components.spinner')
    <!--SVG ICONS-->
    @include('templates.includes.svgs.bootstrap-icon')
    <!--HEADER-->
    @include('templates.includes.layouts.header')
    <!--BODY / CONTENTS-->
    <main>
        @yield('contents')
    </main>
    <!--MODALS IN EVERY TEMPLATES-->
    @include('templates.includes.components.modal')
    <!--MODALS IN EACH PAGES-->
    @yield('modals')
    <!--TOASTS IN EVERY TEMPLATES-->
    @include('templates.includes.components.toasts')
    <!--TOASTS IN EACH PAGES-->
    @yield('toasts')
    <!--OFFCANVAS IN EVERY TEMPLATES-->
    @include('templates.includes.components.offcanvas')
    <!--OFFCANVAS IN EACH PAGES-->
    @yield('offcanvas')
    <!--FOOTER-->
    @include('templates.includes.layouts.footer')
    <!--SCRIPTS (JS) IN EVERY TEMPLATES-->
    @include('templates.includes.sources.js')
    <!--SCRIPTS (JS) IN EACH PAGES-->
    @stack('scripts')
    </body>
</html>
