@extends('layouts.app')

@section('title')view @endsection

@section('content')
<script>
  

        
</script>
        
<form method="POST" action="{{ route('posts.update')}}">
            
            <label for="exampleFormControlInput1" class="form-control" id="exampleFormControlInput1" class="form-label">{{ $post->id }}</label>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <label for="exampleFormControlInput1" class="form-control" id="exampleFormControlInput1" class="form-label">{{ $post->title }}</label>
                
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <label for="exampleFormControlTextarea1" class="form-control" id="exampleFormControlInput1" class="form-label">{{ $post->description }}</label>
                
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1"  class="form-label"> post creator</label>
               
            <label name="creator"   class="form-control">
                    
                {{ $post->user->name}}
             </label>
            </div>
            </form>
        
@endsection