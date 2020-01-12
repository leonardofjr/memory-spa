@extends('layouts.backend')
@section('content')
            <header class="page-title-header mb-5">
                <h2>{{\Request::route()->getName()}}<a class="btn-primary btn mx-4" href="{{route('Add Blog Post')}}">Add Post</a></h2>
            </header>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
            <tbody>
              @foreach($data as $item)
                <tr>
                    <td>{{$item['title']}}</td>
                    <td>{{$item['author']}}</td>
                    <td>{{$item['created_at']}}</td>
                    <td><a href="/admin/blog/edit/{{$item['id']}}" class="fas fa-edit"></a></td>
                    <td>
                        <form id="deleteWorkForm" class="d-inline-block" action="/api/delete-blog-entry/{{$item['id']}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                                <button type="submit" class="fas fa-trash"></button>
                        </form>
                    </td>
                </tr>
              @endforeach
            <tbody>
        </table>
@endsection