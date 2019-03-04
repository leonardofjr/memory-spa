@extends('layouts.backend')
@section('content')
            <section class="container"> 
            <h2>{{\Request::route()->getName()}}</h2>
            <form id="addWorkForm" method="POST" enctype="multipart/form-data" action="/api/post-portfolio-entry">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" >
                   <div class="my-3 d-none alert alert-warning error error-title" role="alert">
                    </div>
                </div>
                 <input type="hidden" name="user_id" value="{{Auth::user()->id }}">

                <div class="form-group">
                    <label for="type">Type:</label>
                        <select class="form-control"  name="type" >
                            @foreach($type_dropdown as $type)
                                    <option value="{{strtolower($type->name)}}">{{$type->name}}</option>
                      
                            @endforeach
                        </select>
                   <div class="my-3 d-none alert alert-warning error error-type" role="alert">
                    </div>
                </div>
                <!-- File Selector -->
                <script type="text/javascript" src="/js/imagePreview.js"></script>
                <img id="imgPreview" class="img-fluid" src="https://via.placeholder.com/350x150" alt="image preview">

                <div class="form-group">
                    <label for="file_1">Image:</label>
                    <input type="file" class="form-control" id="file_1" name="file_1" onchange='previewImageToUpload("file_1", "imgPreview")'>
                   <div class="my-3 d-none alert alert-warning error error-file" role="alert">
                    </div>
                </div>
                <!-- File Selector END -->      
                                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea  id="article-ckeditor" type="text" class="form-control"  name="description" ></textarea>
                    <div class="my-3 d-none alert alert-warning error error-description" role="alert">
                    </div>
                </div>

                <div class="form-group">
                    <label for="website_url">Website Url:</label>
                    <input type="text" class="form-control" name="website_url" >
                   <div class="my-3 d-none alert alert-warning error error-website-url" role="alert">
                    </div>
                </div>     
                @if(!$skill_set == '[]')          

                @else 
                    <div>Project Technologies:</div>
                    @foreach ($skill_set as $skill_set_item )
                        <div class="form-group">
                            <label for="{{$skill_set_item->name}}">{{$skill_set_item->name}}</label>
                            <input type="checkbox" id="{{$skill_set_item->name}}" value="{{$skill_set_item->name}}" name="technologies[]">
                        </div>
                    @endforeach
                @endif
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </section>
@endsection

@section('after-body-scripts')
<script src="../../../dist/scripts/scripts.js"></script>
@endsection