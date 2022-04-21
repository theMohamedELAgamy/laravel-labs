@extends('layouts.app')

@section('title')view @endsection

@section('content')
<script>
  

        
</script>
        @if($post->image_path)
          <center><img src='/images/{{ $post->image_path }}' width=300 /></center>
          @endif
          <label for="exampleFormControlInput1" id="exampleFormControlInput1" class="form-label">ID:</label>
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
                 <label for="exampleFormControlTextarea1" class="form-label">comment</label>
                 <input type="text" id="comment_content" class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"/>
                <button type="submit" id="comment_btn" class="btn btn-success">comment</button>

           
           
           
                    <label for="exampleFormControlTextarea1" class="form-label">comments</label>
            <div id="comments_section">
            @foreach ( $comments as $comment)
                    <label for="exampleFormControlTextarea1" class="form-control" id="exampleFormControlInput1" class="form-label"> {{$comment->comment}}</label>
                    @endforeach
                </div>
              
               
                <script>
                 
                  comment_btn.addEventListener("click",function(){
                    let  comment_btn=document.getElementById("comment_btn")
                  let comment_content=document.getElementById("comment_content").value
                      req_comment= new XMLHttpRequest();
                      req_comment.open('GET',"/req_comment/{{$post->id}}/{{ Auth::user()->name}}"+comment_content)
                      req_comment.send()
                      req_comment.onreadystatechange=function(){
                          if(req_comment.readyState==4 &&req_comment.status==200){
                          let response=JSON.parse(req_comment.responseText)
                            console.log(response)
                            appendcomment(comment_content)
                          }
                      }
                  })

                  function  appendcomment(comment_content){
                    document.getElementById("comment_content").value=""
                      let comments_section=document.getElementById("comments_section");
                      let comment=document.createElement('label')
                      comment.classList.add('form-control')
                      comment.classList.add('form-label')
                      comment.innerHTML=comment_content;
                      comments_section.appendChild(comment)
                  }

                </script>
        
@endsection