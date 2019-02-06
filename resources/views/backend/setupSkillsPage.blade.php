@extends('layouts.admin')
@section('content')
            <section class="container"> 
               <h2>Set your skills</h2>
                <form id="setupSkillsForm" method="POST" enctype="multipart/form-data" action="/api/post-setup-skills">
                    {{ csrf_field() }}
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