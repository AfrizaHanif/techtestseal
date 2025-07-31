<!--TEMPLATE-->
@extends('templates.template')

<!--TITLE-->
@section('title')
    @if (strlen(ucfirst($selected_source)) > 4)
    <title>{{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $selected_category)) }} ({{ ucfirst($selected_source) }}) | Berita Kini</title>
    @else
    <title>{{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $selected_category)) }} ({{ strtoupper($selected_source) }}) | Berita Kini</title>
    @endif
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
