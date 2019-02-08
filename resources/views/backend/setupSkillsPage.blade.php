@extends('layouts.admin')
@section('content')
            <section class="container"> 
            <h2>{{\Request::route()->getName()}}</h2>
                <form id="setupSkillsForm" method="POST" enctype="multipart/form-data" action="/api/post-setup-skills">
                    {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{Auth::user()->id }}">
                        <div class="form-group">
                            <label for="title">Skills & Offer:</label>
                            <textarea id="article-ckeditor" class="form-control" name="skills_and_offer" ></textarea>
                        </div>
                    @foreach($skills as $skill)
                        <div class="form-group">
                            <label for="title">{{$skill['name']}}</label>
                        <input type="range" class="form-control" id="{{$skill['value']}}}" name="{{$skill['value']}}" value="0" onchange='evalSlider(this.id)'>
                        <output></output>
                    </div>
                    @endforeach
               
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </section>
@endsection