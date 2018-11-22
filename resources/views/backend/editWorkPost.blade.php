@extends('layouts.admin')
@section('content')
            <section class="container"> 
            <h2>Edit Work</h2>
            <form id="editWorkForm" method="POST" action="/api/update-portfolio-entry/{{$id}}">
                {{ csrf_field() }}
                 <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{$data->title}}">
                    <div class="flash-message-title d-none">
                        <span></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="type">Type:</label>
                        <select class="form-control" id="type" name="type" >
                            @foreach($type_dropdown as $type)
                                @if(strtolower($type) == $data->type)
                                    <option selected value="{{strtolower($type)}}">{{$type}}</option>
                                @else
                                    <option value="{{strtolower($type)}}">{{$type}}</option>
                                @endif
                            @endforeach
                        </select>
                    <div class="flash-message-type d-none">
                        <span></span>
                    </div>
                </div>

           
                                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea type="text" class="form-control" id="description" name="description">{{$data->description}} </textarea>
                    <div class="flash-message-description d-none">
                        <span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="technologies_used">Technologies used:</label>
                    <!-- Looping through $languages passed by controller -->
                    @foreach($programming_languages as $language)
                        <div class="form-check">
                                @if(in_array(strtolower($language), json_decode($data->technologies)))
                                    <input type="checkbox" class="form-check-input" checked id= {{strtolower($language)}} name="{{strtolower($language)}}" value= "{{strtolower($language)}}">
                                @else
                                    <input type="checkbox" class="form-check-input" id= "{{strtolower($language)}}" name="{{strtolower($language)}}" value= "{{strtolower($language)}}">
                                @endif
                                 <label class="form-check-label" for={{strtolower($language)}}>{{$language}}</label>
                        </div>
                     @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </section>
    </form>
@endsection

@section('after-body-scripts')
<script src="../../../dist/scripts/scripts.js"></script>
@endsection