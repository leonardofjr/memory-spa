@extends('layouts.backend')
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
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
            
            <!-- CKEDITOR SCRIPT -->
            <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
            <script text="type/javascript">
                CKEDITOR.replace( 'article-ckeditor' );
            </script>
@endsection
