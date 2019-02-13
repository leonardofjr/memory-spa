@extends('layouts.admin')
@section('content')
            <section class="container"> 
            <h2>{{\Request::route()->getName()}}</h2>
            <form id="profileSettingsForm" method="POST" action="/api/update-setup-skills/{{$data->id}}">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                    <label for="title">Skills & Offer:</label>
                    <textarea id="article-ckeditor" class="form-control" name="skills_and_offer">{{$data->skills_and_offer}}</textarea>
                </div>
              <!--  <div class="form-group">
                    <label for="title">HTML5</label>
                <input type="range" class="form-control" id="html5" name="html" value="{{$data->html}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">CSS3</label>
                <input type="range" class="form-control" id="css" name="css" value="{{$data->css}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">Javascript</label>
                <input type="range" class="form-control" id="javascript" name="javascript" value="{{$data->javascript}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">Bootstrap</label>
                <input type="range" class="form-control" id="bootstrap" name="bootstrap" value="{{$data->bootstrap}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">Angular</label>
                <input type="range" class="form-control" id="angular" name="angular" value="{{$data->angular}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">Vue.js</label>
                <input type="range" class="form-control" id="vuejs" name="vuejs" value="{{$data->vuejs}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">PHP</label>
                <input type="range" class="form-control" id="php" name="php" value="{{$data->php}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">Laravel</label>
                <input type="range" class="form-control" id="laravel" name="laravel" value="{{$data->laravel}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">Express.js</label>
                <input type="range" class="form-control" id="expressjs" name="expressjs" value="{{$data->expressjs}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">Git</label>
                <input type="range" class="form-control" id="git" name="git" value="{{$data->git}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">Windows</label>
                <input type="range" class="form-control" id="windows" name="windows" value="{{$data->windows}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">Mac</label>
                <input type="range" class="form-control" id="mac" name="mac" value="{{$data->mac}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div>
                <div class="form-group">
                    <label for="title">Linux</label>
                <input type="range" class="form-control" id="linux" name="linux" value="{{$data->linux}}" onchange='evalSlider(this.id)'>
                    <output></output>
                </div> -->
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </section>
@endsection