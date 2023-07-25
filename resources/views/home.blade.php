@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(Session::has('post-update-message'))
                <div class="alert alert-success">  {{Session::get('post-update-message')}} </div>
                @endif
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                           
                        </div>
                    @endif
                   
                    {{ __('You are logged in!') }}
                    <div class="text-center mb-2"> <img height="200" src="{{$posts->image}}"/></div>
                    <div class="text-center mb-2">{!! $posts->description !!}</div>
                    
                </div>
            </div>
            @if (Auth::user()->role == 'admin')
            <div class="card">
                <div class="card-header">{{ __('Update Cat Information') }}</div>

                <div class="card-body">
                   
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                         <form name="add-blog-post-form" id="add-blog-post-form" enctype="multipart/form-data" method="Post" action="{{route('updatepost', 1)}}">

                            @csrf
                            @method('PATCH')
                            <div class="form-group mb-2">
                               
                                <img class="mb-2" height="100" src="{{$posts->image}}"/>
                             <input type="file" name="image" class="form-control" id="post-image">
                            </div>
                    <div class="form-group mb-2">
                            <textarea id="myeditorinstance" name="description">{{$posts->description}}</textarea>
                            
                    </div>
                    <div class="form-group">
                      
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
               
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
