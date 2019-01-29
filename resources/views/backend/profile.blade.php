@extends('layouts.admin')
@section('content')
            <section class="container"> 
            <h2>Profile</h2>
            <form id="profileSettingsForm" method="POST" enctype="multipart/form-data" action="/api/post-profile-settings">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">HTML5</label>
                    <input type="range" class="form-control" id="html5" name="html" value="0" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">CSS3</label>
                    <input type="range" class="form-control" id="css3" name="html" value="0" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </section>
@endsection