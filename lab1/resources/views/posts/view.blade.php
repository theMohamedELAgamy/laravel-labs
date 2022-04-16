@extends('layouts.app')

@section('title')view @endsection

@section('content')
<script>
  

        
</script>
        
<form method="POST" action="{{ route('posts.update')}}">
            <input type="text" name="id"  value={{ $post['id'] }} style="{
                display:none;
            }" class="form-control" id="exampleFormControlInput1" placeholder="">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title"  value={{ $post['title'] }} class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control"  name="description" id="exampleFormControlTextarea1" rows="3">{{ $post['description'] }}</textarea>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1"  class="form-label">Post Creator</label>
               
                <select name="creator"  value={{ $post['post_creator'] }}class="form-control">
                    <option value="Ahmed">Ahmed</option>
                    <option value="Mohamed">Mohamed</option>

                </select>
            </div>
            </form>
        
@endsection