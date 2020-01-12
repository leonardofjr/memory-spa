@extends('layouts.backend')
@section('content')
            <header class="page-title-header mb-5">
                <h2>{{\Request::route()->getName()}}</h2>
            </header>
            
            <!-- Including Croppie Upload Modal -->
            @include('backend.components.croppieUploadModal')

            <form class="col-10" id="editWorkForm" method="POST" enctype="multipart/form-data"  action="/api/update-portfolio-entry/{{$data->id}}">
                {{ csrf_field() }}
                 <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" value="{{$data->title}}">
                   <div class="my-3 d-none alert alert-warning error error-title" role="alert">
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
                    <label for="content">Content:</label>
                    <textarea  id="article-ckeditor" type="text" id="summernote" class="form-control" id="content" name="content">{{$data->content}} </textarea>
                    <div class="my-3 d-none alert alert-warning error error-content" role="alert">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
    </form>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script text="type/javascript">
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection