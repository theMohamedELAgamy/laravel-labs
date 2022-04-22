@extends('layouts.app')

@section('title')Index @endsection

@section('content')


        <div class="text-center">
            <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>
        </div>
        <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>

            @foreach ( $posts as $post)
            {{ Form::open(array('route' => array('posts.delete','id'=>$post->id),'method' => 'DELETE')) }}


              <tr>
                <td >{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                @if($post->user)
                  <td>{{$post->user->name}}</td>
                @else
                  <td>Not Found</td>
                @endif
                {{-- <td>{{$post->user ? $post->user->name : 'Not Found'}}</td> --}}
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->slug }}</td>
                <td>
                    <a href="{{ route('posts.view', ['post' => $post->id]) }}" class="btn btn-info">View</a>
                    <a  href="{{ route('posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Edit</a>
                    <button  onclick="deletepost(event)"class="btn btn-danger" id="delete_btn" type="submit" class="btn btn-success">Delete</button>

                    {{ Form::close() }}

                </td>
              </tr>
              @endforeach

            </tbody>
          </table>

          <div id="pagination">
               {{ $posts->links() }}
          </div>
          <style>
            #pagination{
              display:inline;
              direction:row;
              width: 100px;
              height: 50px;
               scale: 2;
            }
          </style>
     <script>
       function deletepost(e){
            if( !confirm('are you sure')){
              event.preventDefault()
            }
      }
      
      
      
      
      
  </script>
@endsection
