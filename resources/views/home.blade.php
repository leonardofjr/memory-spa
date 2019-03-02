@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @extends('layouts.admin')
@section('content')
<div class="row">
          <div class="offset-11">
           <a class="btn-primary btn" href="/admin/work/add">Add Work</a>
          </div>
          <div class="col-12">
              @foreach($data as $item)
                <h2>{{$item['title']}}</h2>
                <p>{{$item['description']}}</p>
                <p><strong>Images:</strong>
                        @foreach($item['files'] as $file)
                        <img src="/assets/uploads/{{$file['filename_1']}}" class="img-fluid">
                        @endforeach
                </p>
                <p><strong>Technologies:</strong>
                    @foreach(json_decode($item['technologies']) as $technoloogy)
                        {{$technoloogy}}
                    @endforeach
                </p>
                <div class="offset-11">
                <a href="work/edit/{{$item['id']}}">Edit</a>
                <form id="deleteWorkForm" action="work/delete/{{$item['id']}}" method="DELETE">
                      {{ csrf_field() }}
                     <input type="hidden" name="_method" value="DELETE">
                      <button type="submit">Delete</button>
                </form>
                   
                </div>
              @endforeach
          </div>

</div>
@endsection

@section('after-body-scripts')
<script src="../../../dist/scripts/scripts.js"></script>
@endsection
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
