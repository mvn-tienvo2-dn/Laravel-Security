@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post List') }}</div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-success">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="btnCreate">
                        <a href="{{asset('posts/create')}}">
                            <button class="btn btn-primary">Create</button>
                        </a>
                    </div>
                   <table class="table">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>Title</th>
                               <th>Content</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @foreach($listPost as $post)
                           <tr>
                               <td>{{$post->id}}</td>
                               <td><a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a></td>
                               <td>{{$post->content}}</td>
                               <td>
                                   <div class="row">
                                       <form action="{{route('posts.edit',['post'=>$post->id])}}" method="POST">
                                        @csrf
                                        @method('GET')
                                           <button class="btn btn-warning" onclick="confirm('Do you want edit ?');">Edit</button>
                                       </form>
                                       <form 
                                       action="{{route('posts.destroy',['post'=>$post->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                           <button class="btn btn-danger" onclick="confirm('Do you want delete ?');">Delete</button>
                                       </form>
                                   </div>
                               </td>
                           </tr>
                        @endforeach
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
