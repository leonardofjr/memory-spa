@extends('layouts.admin')
@section('content')
            <section class="container"> 
               <h2>Setup your website</h2>
                <form id="setupPageForm" method="POST" enctype="multipart/form-data" action="/api/post-user-settings">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" >
                    </div>
                    <div class="form-group">
                        <label for="title">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" >
                    </div>
                    <div class="form-group">
                        <label for="title">Facebook Url:</label>
                        <input type="text" class="form-control" id="facebook_url" name="facebook_url" >
                    </div>
                    <div class="form-group">
                        <label for="title">Instagram Url:</label>
                        <input type="text" class="form-control" id="instagram_url" name="instagram_url" >
                    </div>
                    <div class="form-group">
                        <label for="title">Twitter Url:</label>
                        <input type="text" class="form-control" id="twitter_url" name="twitter_url" >
                    </div>
                    <div class="form-group">
                        <label for="title">Github Url:</label>
                        <input type="text" class="form-control" id="github_url" name="github_url" >
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </section>
@endsection