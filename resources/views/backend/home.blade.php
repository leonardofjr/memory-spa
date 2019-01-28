@extends('layouts.admin')
@section('content')
<div class="row">
          <div class="offset-10">
           <a class="btn-primary btn" href="/portfolio/add">Add Portfolio Entry</a>
          </div>
          <div class="col-12">
              @foreach($data as $item)

                <div class="row">
                        @foreach($item['files'] as $file)
                        <div class="col-md-3">
                            <img src="{{asset('storage/' . $file['filename_1']) }}" class="img-fluid">
                        </div>
                        @endforeach

                        <div class="col-md-9">
                            <h2>{{$item['title']}}</h2>
                            <p>{{$item['description']}}</p>
                            <p><strong>Technologies:</strong>
                                @foreach(json_decode($item['technologies']) as $technoloogy)
                                    {{$technoloogy}}
                                @endforeach
                            </p>
                        </div>
                </div>

                <div class="offset-11">
                <a href="portfolio/edit/{{$item['id']}}">Edit</a>
                <form id="deleteWorkForm" action="api/delete-portfolio-entry/{{$item['id']}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
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