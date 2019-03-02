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
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </section>
@endsection