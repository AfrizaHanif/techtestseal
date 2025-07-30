<!--TEMPLATE-->
@extends('templates.template')

<!--TITLE-->
@section('title')
<title>{{ ucfirst($selected_category) }} ({{ ucfirst($selected_source) }}) | Berita Kini</title>
@endsection

<!--CONTENTS-->
@section('contents')
@include('pages.includes.contents.source')
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
