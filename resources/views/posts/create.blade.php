@extends('layouts.app')

@section('scripts')
    <script src="/js/datepicker.js"></script>
    <script src="/js/redactor.min.js"></script>
    <script>
        $(function () {
            $('#publish_at').datetimepicker();
            $('#content').redactor({
                imageUpload: '/blog/upload'
            });
        });
    </script>
@stop

@section('styles')
    <link rel="stylesheet" href="/css/datepicker.css">
@stop

@section('content')
    <section class="container">
        <form action="" method="POST">
            {!! method_field('POST') !!}
            @include('posts._form')
        </form>
    </section>
@stop