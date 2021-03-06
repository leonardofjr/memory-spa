@extends('backend.layouts.backend')
@section('content')

            <!-- Including Croppie Upload Modal -->
            @include('backend.components.croppieUploadModal')

            <header class="page-title-header mb-5">
                <h2>{{\Request::route()->getName()}}</h2>
            </header>


        
                <form id="setupPageForm" class="col-10" method="POST" enctype="multipart/form-data" action="/update-user-settings/{{$id}}">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" id="fname" name="fname" value="{{$data->fname}}" >
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="{{$data->lname}}" >
                    </div>

                    <div class="logoPreviewContainer">
                        <img id="imageFilePreview" class="img-thumbnail" src='{{$data->profile_image ? asset("storage/logo/logo.png") : asset("imgs/logo.png") }}' style="max-width: 300px;" alt="preview" />
                     </div>
              
                    <div class="form-group">
                        <input type="file" id="uploadedImageFile" name="uploadedImageFile" accept="image/*">
                        <div class="my-3 d-none alert alert-warning error error-profile-image" role="alert"></div>
                    </div>

                    <div class="my-3 d-none alert alert-warning error error-image" role="alert">
                    </div>
                    <div class="form-group">
                        <label for="bio-ckeditor">Bio:</label>
                        <textarea id="bio-ckeditor" class="form-control" name="bio">{{$data->bio}}</textarea>
                        <div class="my-3 d-none alert alert-warning error error-bio" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="skills-and-offer-ckeditor">Skills & Offer:</label>
                        <textarea id="skills-and-offer-ckeditor" class="form-control" name="skills_and_offer">{{$data->skills_and_offer}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{$data->phone}}" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" >
                    </div>

                    <div class="form-group">
                        <label for="facebook_url">Facebook Url:</label>
                        <input type="text" class="form-control" id="facebook_url" name="facebook_url" value="{{$data->facebook_url}}" >
                    </div>
                    <div class="form-group">
                        <label for="linkedin_url">Linkedin Url:</label>
                        <input type="text" class="form-control" id="linkedin_url" name="linkedin_url" value="{{$data->linkedin_url}}" >
                    </div>
                    <div class="form-group">
                        <label for="twitter_url">Twitter Url:</label>
                        <input type="text" class="form-control" id="twitter_url" name="twitter_url" value="{{$data->twitter_url}}" >
                    </div>
                    <div class="form-group">
                        <label for="github_url">Github Url:</label>
                        <input type="text" class="form-control" id="github_url" name="github_url" value="{{$data->github_url}}" >
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <!-- CKEDITOR SCRIPT -->
                <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                <script text="type/javascript">
                    CKEDITOR.replace( 'bio-ckeditor' );
                    CKEDITOR.replace( 'skills-and-offer-ckeditor' );
                </script>
@endsection