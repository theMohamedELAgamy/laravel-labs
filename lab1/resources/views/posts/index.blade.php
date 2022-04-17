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
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ( $posts as $post)
              <tr>
                <td>{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                @if($post->user)
                  <td>{{$post->user->name}}</td>
                @else
                  <td>Not Found</td>
                @endif
                {{-- <td>{{$post->user ? $post->user->name : 'Not Found'}}</td> --}}
                <td>{{ $post->created_at }}</td>
                <td>
                    <a href="{{ route('posts.view', ['post' => $post->id]) }}" class="btn btn-info">View</a>
                    <a  href="{{ route('posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Edit</a>
                    <!-- <form method="POST" action="{{ route('posts.delete', ['post' => $post['id']]) }}"> -->
                        <!-- @method('DELETE')
                        @csrf -->
                         <a   id="delete_btn"  href="{{ route('posts.delete', ['post' => $post['id']]) }}"class="btn btn-danger">Delete</a>
                          <!-- <input type="submit" id="delete_btn" class="btn btn-danger" value="Delete"  /> -->
                  <!-- </form> -->
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


      
      let delete_ancur=document.getElementsByClassName("btn btn-danger")[0];

      delete_ancur.addEventListener('click',function(event){

       if( confirm('are you sure')){
        // event.preventDefault()
        // const xhttp = new XMLHttpRequest();
       
        // xhttp.open("GET", "/posts/create/", true);
        // xhttp.send();

       }else{
        event.preventDefault()
       }
      })
      
      
      
      
  </script>
@endsection
