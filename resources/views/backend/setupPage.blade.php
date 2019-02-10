@extends('layouts.admin')
@section('content')
            <section class="container"> 
            <h2>{{\Request::route()->getName()}}</h2>
                <form id="setupPageForm" method="POST" enctype="multipart/form-data" action="/api/post-user-settings">
                    <script type="text/javascript" src="/js/imagePreview.js"></script>
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{Auth::user()->id }}">
                      <img id="imgPreview" class="img-fluid" src="https://via.placeholder.com/150" alt="image preview">
                    <div class="form-group">
                        <label for="profile_image">Profile Image:</label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange='previewImageToUpload("profile_image")'>
                        <div class="my-3 d-none alert alert-warning error error-profile-image" role="alert"></div>
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio:</label>
                        <textarea id="article-ckeditor" class="form-control" name="bio" ></textarea>
                        <div class="my-3 d-none alert alert-warning error error-bio" role="alert"></div>

                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" >
                    </div>
                    <div class="form-group">
                        <label for="facebook_url">Facebook Url:</label>
                        <input type="text" class="form-control" id="facebook_url" name="facebook_url" >
                    </div>
                    <div class="form-group">
                        <label for="instagram_url">Instagram Url:</label>
                        <input type="text" class="form-control" id="instagram_url" name="instagram_url" >
                    </div>
                    <div class="form-group">
                        <label for="twitter_url">Twitter Url:</label>
                        <input type="text" class="form-control" id="twitter_url" name="twitter_url" >
                    </div>
                    <div class="form-group">
                        <label for="github_url">Github Url:</label>
                        <input type="text" class="form-control" id="github_url" name="github_url" >
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </section>
@endsection