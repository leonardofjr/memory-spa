@extends('backend.layouts.backend')
@section('content')
            <header class="page-title-header mb-5">
                <h2>{{\Request::route()->getName()}}</h2>
            </header>
            
            <!-- Including Croppie Upload Modal -->
            @include('backend.components.croppieUploadModal')

            <form class="col-10" method="POST" enctype="multipart/form-data" action="/post-portfolio-entry">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" >
                   <div class="my-3 d-none alert alert-warning error error-title" role="alert">
                    </div>
                </div>

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
                <div class="logoPreviewContainer">
                    <img id="imageFilePreview" class="img-thumbnail" src='https://via.placeholder.com/300x300' style="display:none; max-width: 300px;" alt="preview" />
                </div>
              
                <div class="form-group">
                    <input type="file" id="uploadedImageFile" name="uploadedImageFile" accept="image/*">
                    <div class="my-3 d-none alert alert-warning error error-profile-image" role="alert"></div>
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
            
            <!-- CKEDITOR SCRIPT -->
            <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
            <script text="type/javascript">
                CKEDITOR.replace( 'article-ckeditor' );
            </script>
@endsection
