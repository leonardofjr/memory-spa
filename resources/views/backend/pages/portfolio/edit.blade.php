@extends('backend.layouts.backend')
@section('content')
            <header class="page-title-header mb-5">
                <h2>{{\Request::route()->getName()}}</h2>
            </header>
            
            <!-- Including Croppie Upload Modal -->
            @include('backend.components.croppieUploadModal')

            <form class="col-10" id="editWorkForm" method="POST" enctype="multipart/form-data"  action="/update-portfolio-entry/{{$data->id}}">
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
                <div class="logoPreviewContainer">
                    <img id="imageFilePreview" class="img-thumbnail" src='{{asset("storage/imgs/" . $data->image)}}' style='max-width: 300px;{{$data->image ? "" : "display:none;"}}' max-width: 300px;" alt="preview" />
                </div>
              
                <div class="form-group">
                    <input type="file" id="uploadedImageFile" name="uploadedImageFile" accept="image/*">
                    <div class="my-3 d-none alert alert-warning error error-profile-image" role="alert"></div>
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
    </form>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script text="type/javascript">
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection