@extends('layouts.layout')

@section('content')

        <h1>Ma liste d'articles</h1>

        @if(\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('articleCreate')}}" class="btn btn-primary">Create a Post</a>
        @endif


        <div>

            @foreach($posts as $post)

                <div class="col-md-4">
                    <div class="card">
                        <a href="{{ route('articleDetail', $post -> id )}}">
                            <img src="{{ asset("storage/$post->picture") }}" style="object-fit: cover; height: 200px;" class="card-img-top">
                        </a>

                        <div class="card-body">
                            {{-- <a href="articles/{{$post -> id}}"> --}}
                            <a href="{{ route('articleDetail', $post -> id )}}">
                                <h4 class="card-title">{{$post -> title}}</h4>
                            </a>

                            <p>{{$post -> extrait}}</p>

                            {{-- <p>{{sizeof($post -> comments)}} comment (s)</p> --}}

                            <p>{{($post->countComments())}} comment (s)</p>

                            @if($post->user)
                            <p> written by : {{$post->user->firstname}}</p>
                            @endif

                            <div>
                                @foreach($post->categories as $category)
                                    <span>{{$category->name}}</span>
                                @endforeach
                            </div>

                            <div class="d-flex">
                                {{-- if the route is get , but that's not safe --}}
                                {{-- <a href="{{ route('articleDelete', $post->id)}}" class="btn btn-danger">Remove</a> --}}

                                @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->id === $post->user_id)

                                <form method="post" action="{{ route('articleDelete', $post->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Remove</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

@endsection

@section('javascript')

@endsection
