@extends('layouts.admin')
@section('content')
            <section class="container"> 
            <h2>Skills</h2>
            <form id="profileSettingsForm" method="POST" action="/api/post-user-settings/1">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                    <label for="title">HTML5</label>
                <input type="range" class="form-control" id="html5" name="html" value="{{$data->html}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">CSS3</label>
                <input type="range" class="form-control" id="css3" name="css" value="{{$data->css}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </section>
@endsection