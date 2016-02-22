@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
@stop

@section('content')
    <section class="container-fluid">
        <table id="example" class="dt-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Id</th>
                <th>email</th>
                <th>name</th>
                <th>posts</th>
                <th>comments</th>
                <th>created</th>
                <th>actions</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>email</th>
                <th>name</th>
                <th>posts</th>
                <th>comments</th>
                <th>created</th>
                <th>actions</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->posts->count() }}</td>
                    <td>{{ $user->comments->count() }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td><a class="btn btn-lg btn-primary-outline">Does nothing</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@stop


@section('scripts')
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script>
        $('#example').DataTable({
            createdRow: function (row) {
                $('td', row).attr('tabindex', 0);
            }
        });
    </script>
@stop