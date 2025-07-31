<!--TEMPLATE-->
@extends('templates.template')

<!--TITLE-->
@section('title')
    @if (strlen(ucfirst($selected_source)) > 4)
    <title>{{ ucfirst($selected_source) }} | Berita Kini</title>
    @else
    <title>{{ strtoupper($selected_source) }} | Berita Kini</title>
    @endif
@endsection

<!--CONTENTS-->
@section('contents')
@include('pages.includes.contents.redirect')
@endsection

<!--MODALS-->
@section('modals')
@endsection

<!--TOASTS-->
@section('toasts')
@endsection

<!--OFFCANVAS-->
@section('offcanvas')
@endsection

<!--SCRIPTS-->
@push('scripts')
@endpush
