@extends('layouts.admin')
@section('content')
            <section class="container"> 
               <h2>Settings</h2>        
                <form id="setupPageForm" method="POST" enctype="multipart/form-data" action="/api/update-user-settings/{{$id}}">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Bio:</label>
                        <textarea id="article-ckeditor" class="form-control" id="bio" name="bio" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{$data->phone}}" >
                    </div>
                    <div class="form-group">
                        <label for="title">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" >
                    </div>
                    <div class="form-group">
                        <label for="title">Facebook Url:</label>
                        <input type="text" class="form-control" id="facebook_url" name="facebook_url" value="{{$data->facebook_url}}" >
                    </div>
                    <div class="form-group">
                        <label for="title">Instagram Url:</label>
                        <input type="text" class="form-control" id="instagram_url" name="instagram_url" value="{{$data->instagram_url}}" >
                    </div>
                    <div class="form-group">
                        <label for="title">Twitter Url:</label>
                        <input type="text" class="form-control" id="twitter_url" name="twitter_url" value="{{$data->twitter_url}}" >
                    </div>
                    <div class="form-group">
                        <label for="title">Github Url:</label>
                        <input type="text" class="form-control" id="github_url" name="github_url" value="{{$data->github_url}}" >
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </section>
@endsection