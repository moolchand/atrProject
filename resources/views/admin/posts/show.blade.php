@extends('layouts.admin')
@section('title') | Blog-post | {{$post->title}} @endsection
@section('content')

<section class="content-header">
  <h1>
    Posted Blog
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin.posts.index')}}"><i class="fa fa-dashboard"></i> Blogs</a></li>
    <li class="active">View</li>
  </ol>
</section>
<hr style="border: 1px solid #00a65a;">

<div class="container">

<div class="row">
<div class="col-md-10">
<div class="panel panel-default">
  <div class="panel-body">


    <div class="row">
     <div class="col-md-1" style="border-right:2px solid silver">
       <center>
       @if(isset($post->user->basicDetail->image))
       <img src="{{ asset('images/' .$post->user->basicDetail->image) }}" class="img-circle" style="width:50px">
       @else
       <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:50px">
       @endif
       <center>
     </div>
     <div class="col-md-4">
       <strong>by : {{ $post->user->basicDetail->firstname }} {{ $post->user->basicDetail->lastname }}</strong> <br>
       <small>{{ date('jS M Y, h:i A', strtotime($post->created_at)) }}</small>
     </div>
     <div class="col-md-7">
       <p>Category : {{ $post->category->name }} | Sub-category : </p>
     </div>
    </div>

   <div class="row">
     <div class="col-md-12">
       <hr>
       <p>@foreach($post->tags as $tag)
       <span class="label label-default">{{ $tag->name}}</span>
       @endforeach</p>

       <h4><strong>{{ $post->title }}</strong></h4>
       <p>{!! $post->body !!}</p>
       @if(isset($post->featured_image))
       <center><img src="{{ asset('posts/' .$post->featured_image) }}" style="width:100%"></center>
       @endif
     </div>
   </div>

   <div class="row mt20">
     <div class="col-md-10">
         <span class="col-md-2">
            <i class="fa fa-heart fa-lg" aria-hidden="true"></i> {{$post->likes()->count()}}
         </span>
         <span class="col-md-2">
             <i class="fa fa-comments fa-lg"></i>
             <span>{{ $post->comments->count() }}</span>
         </span>
         <span class="col-md-2">
             <i class="fa fa-eye fa-lg"></i>
             <span>1234</span>
         </span>
     </div>
        <div class="col-md-2 pull-right" data-toggle="tooltip" data-placement="left" title="{{$post->comments->count()}} comment">
            <i class="fa fa-angle-down fa-2x" style="cursor:pointer;color:grey" aria-hidden="true" onclick="document.getElementById('cmt{{$post->id}}').style.display='block'"></i>
            <i class="fa fa-angle-up fa-2x" style="cursor:pointer;color:grey" aria-hidden="true" onclick="document.getElementById('cmt{{$post->id}}').style.display='none'"></i>
        </div>
   </div>
   <hr>


  <div class="row" id="cmt{{$post->id}}" style="display:none">
   <div class="col-md-12">
    <div class="col-md-12">
      @foreach($post->comments as $comment)
      <div class="row">
        <div class="col-md-1">
          @if(isset($comment->user->basicDetail->image))
          <img src="{{ asset('images/' .$comment->user->basicDetail->image) }}" class="img-circle" style="width:34px">
          @else
          <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:34px">
          @endif

          <p><i class="fa fa-heart"></i> {{$comment->clikes()->count()}}</p>
        </div>
        <div class="col-md-9">
          <span style="font-size:12px"><a>{{ $comment->user->basicDetail->firstname }} {{ $comment->user->basicDetail->lastname }}</a> on {{ date('j M Y' ,strtotime($comment->created_at)) }}</span>
          <p>{{ $comment->comment }}</p>
          <div class="row" id="{{$comment->id}}" style="display:none">

          @foreach($comment->replies as $reply)
          <div class="col-md-12">
            <div class="col-md-1" style="border-right:1px solid silver">
              @if(isset($reply->user->basicDetail->image))
              <img src="{{ asset('images/' .$reply->user->basicDetail->image) }}" class="img-circle" style="width:20px">
              @else
              <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:20px">
              @endif
            </div>

            <div class="col-md-8">
              <p style="font-size:12px"><a>{{$reply->user->basicDetail->firstname}} {{$reply->user->basicDetail->lastname}}</a> {{ $reply->reply }}</p>
            </div>

            <div class="col-md-2">
                <i class="fa fa-heart"></i> {{$reply->rlikes()->count()}}
            </div>

            <div class="col-md-1 pull-right">
            <div class="dropdown">
            <i class="fa fa-ellipsis-h fa-lg dropdown-toggle" data-toggle="dropdown" aria-hidden="true" style="color:grey;cursor:pointer"></i>
            <ul class="dropdown-menu">
              <li>
                  <a href="#" data-target="#add{{$reply->id}}" data-toggle="modal">Edit</a>
              </li>
              <li>
                  {{ Form::open(['route' => ['reply.destroy', $reply->id], 'method' => 'DELETE', 'id' => 'dr'.$reply->id]) }}
                  {{ Form::close() }}
                  <a onclick="
                     if(confirm('Are you sure, You Want to delete this?'))
                         {
                           event.preventDefault();
                           document.getElementById('dr{{ $reply->id }}').submit();
                         }
                         else{
                           event.preventDefault();
                         }" style="cursor:pointer">
                      Delete
                  </a>
              </li>
            </ul>
          </div>
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="add{{$reply->id}}" tabindex="-1">
                  <div class="modal-dialog modal-md">
                      <div class="modal-content">
                       {!! Form::model($reply, ['route' => ['reply.update', $reply->id], 'method' => 'PUT']) !!}
                      <div class="modal-body">
                       {{ Form::text('reply', null, ['class' => 'form-control', 'required'=>'']) }} <br>
                       {{ Form::submit('save reply', ['class' => 'btn btn-success btn-sm']) }}
                       <button class="btn btn-default btn-sm" data-dismiss="modal">cancel</button>
                      </div>
                      {!! Form::close() !!}
                      </div>
                  </div>
                </div>
        </div>

          </div>
          @endforeach


         </div>
         </div>

        <div class="col-md-1" data-toggle="tooltip" data-placement="left" title="{{$comment->replies->count()}} reply">
            <i class="fa fa-angle-down" style="cursor:pointer" aria-hidden="true" onclick="document.getElementById('{{$comment->id}}').style.display='block'"></i>
            <i class="fa fa-angle-up" style="cursor:pointer" aria-hidden="true" onclick="document.getElementById('{{$comment->id}}').style.display='none'"></i>
        </div>

        <div class="col-md-1 pull-right">
            <div class="dropdown">
            <i class="fa fa-ellipsis-h fa-lg dropdown-toggle" data-toggle="dropdown" aria-hidden="true" style="color:grey;cursor:pointer"></i>
            <ul class="dropdown-menu">
              <li>
                  <a href="#" data-target="#addpop{{$comment->id}}" data-toggle="modal">Edit</a>
              </li>
              <li>
                  {{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE', 'id' => 'dc'.$comment->id]) }}
                  {{ Form::close() }}
                  <a onclick="
                     if(confirm('Are you sure, You Want to delete this?'))
                         {
                           event.preventDefault();
                           document.getElementById('dc{{ $comment->id }}').submit();
                         }
                         else{
                           event.preventDefault();
                         }" style="cursor:pointer">
                      Delete
                  </a>
              </li>
            </ul>
          </div>
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop{{$comment->id}}" tabindex="-1">
                  <div class="modal-dialog modal-md">
                      <div class="modal-content">
                       {!! Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) !!}
                      <div class="modal-body">
                       {{ Form::text('comment', null, ['class' => 'form-control', 'required'=>'']) }} <br>
                       {{ Form::submit('save comment', ['class' => 'btn btn-success btn-sm']) }}
                       <button class="btn btn-default btn-sm" data-dismiss="modal">cancel</button>
                      </div>
                      {!! Form::close() !!}
                      </div>
                  </div>
                </div>
        </div>


      </div>
      <hr>
      @endforeach
    </div>
   </div>

   </div>


 </div>

</div>
</div>
</div>

</div>


@endsection