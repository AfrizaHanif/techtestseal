<!--TEMPLATE-->
@extends('templates.template')

<!--TITLE-->
@section('title')
<title>{{ $jsonData['title'] }} | Berita Kini</title>
@endsection

<!--CONTENTS-->
@section('contents')
@include('pages.includes.contents.post')
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
