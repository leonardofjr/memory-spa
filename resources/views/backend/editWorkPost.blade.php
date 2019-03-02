@extends('layouts.backend')
@section('content')
            <section class="container"> 
            <h2>{{\Request::route()->getName()}}</h2>
            <form id="editWorkForm" method="POST" action="/api/update-portfolio-entry/{{$data->id}}">
                {{ csrf_field() }}
                 <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" value="{{$data->title}}">
                   <div class="my-3 d-none alert alert-warning error error-title" role="alert">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="type">Type:</label>
                        <select class="form-control" id="type" name="type" >
                            @foreach($type_dropdown as $type)
                                @if(strtolower($type) == $data->type)
                                    <option selected value="{{strtolower($type->name)}}">{{$type->name}}</option>
                                @else
                                    <option value="{{strtolower($type->name)}}">{{$type->name}}</option>
                                @endif
                            @endforeach
                        </select>
                   <div class="my-3 d-none alert alert-warning error error-type" role="alert">
                    </div>
                </div>
                <!-- File Selector -->
                <script type="text/javascript" src="/js/imagePreview.js"></script>
                <img id="imgPreview" class="img-fluid" src="/storage/{{$data->portfolio_entries->filename_1}}" alt="image preview">

                <div class="form-group">
                    <label for="file_1">Image:</label>
                    <input type="file" class="form-control" id="file_1" name="file_1" onchange='previewImageToUpload("file_1")'>
                   <div class="my-3 d-none alert alert-warning error error-file" role="alert">
                    </div>
                </div>
                <!-- File Selector END -->           
                                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea  id="article-ckeditor" type="text" id="summernote" class="form-control" id="description" name="description">{{$data->description}} </textarea>
                    <div class="my-3 d-none alert alert-warning error error-description" role="alert">
                    </div>
                </div>
                <div class="form-group">
                    <label for="website_url">Website Url:</label>
                    <input type="text" class="form-control" name="website_url" value="{{$data->website_url}} ">
                   <div class="my-3 d-none alert alert-warning error error-website-url" role="alert">
                    </div>
                </div>
                @if($skill_set !== null)
                <div>Project Technologies:</div>

                    @if (!json_decode($data->technologies))
                        @foreach ($skill_set as $skill_set_item )


                                <div class="form-group">
                                    <label for="{{$skill_set_item->name}}">{{$skill_set_item->name}}</label>
                                    <input type="checkbox" id="{{$skill_set_item->name}}" value="{{$skill_set_item->name}}" name="technologies[]{{$skill_set_item->name}}">
                                </div>
                            @endforeach

                    @else
                        @foreach ($skill_set as $skill_set_item )
                            @foreach (json_decode($data->technologies) as $technology_item)
                                @if($skill_set_item->name === $technology_item  )
                                    <div class="form-group">
                                        <label for="{{$skill_set_item->name}}">{{$skill_set_item->name}}</label>
                                        <input type="checkbox" checked id="{{$skill_set_item->name}}" value="{{$skill_set_item->name}}" name="technologies[]{{$skill_set_item->name}}">
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="{{$skill_set_item->name}}">{{$skill_set_item->name}}</label>
                                        <input type="checkbox" id="{{$skill_set_item->name}}" value="{{$skill_set_item->name}}" name="technologies[]{{$skill_set_item->name}}">
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                @endif
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </section>
    </form>
@endsection

@section('after-body-scripts')
<script src="../../../dist/scripts/scripts.js"></script>
@endsection