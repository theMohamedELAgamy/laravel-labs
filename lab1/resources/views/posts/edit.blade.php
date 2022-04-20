@extends('layouts.app')

@section('title')view @endsection

@section('content')
<style>
    #post_id{
        display:none;
    }
    </style>
  
  <h1>Create Post</h1>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            {{ Form::open(array('route' => 'posts.update','method' => 'put','enctype'=>"multipart/form-data")) }}
      
            @csrf
            @if($post->image_path)
          <center><img src='/images/{{ $post->image_path }}' width=300 /></center>
          @endif
            <input type="text" id="post_id" name="id"  value={{ $post->id }} class="form-control" id="exampleFormControlInput1" > 
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title"  value="{{ $post->title }}" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control"  name="description" id="exampleFormControlTextarea1" rows="3">{{ $post->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1"  class="form-label">Post Creator</label>
               
                <select  name="creator" class="form-control">
                @foreach ($users as $user)
                        <option    value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Change image</label>
                <input type="file" rows="3" id="exampleFormControlTextarea1"  class="form-control" name="select_file"/>
            </div>

          <button type="submit" class="btn btn-success">update</button>
          {{ Form::close() }}
        
      
@endsection