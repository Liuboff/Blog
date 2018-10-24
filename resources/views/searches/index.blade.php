@extends('layout')

@section('content')
    <div class="blog-header">
        <h1 class="blog-title">Searching for "{{ $s }}"</h1>
        <p>We've found {{ $posts->count() }} results for your search term in all blog entries</p>
    </div>

    <div class="row">
        <div class="col-sm-8 blog-main">
            @if( $posts->count() )
                @foreach( $posts as $post )

                    <div class="blog-post">
                        <h2 class="entry-title">
                            <a href="/article/{{ $post->slug }}">{{ $post->title }}</a>
                        </h2>
                        <p class="blog-post-meta">{{$post->getDate()}} by <a href="#">{{$post->author->name}}</a></p>

                        <div class="blog-content">
                            {{--If post content is > 200 in characters display 200 only or else display the whole content--}}
                            {!! strlen( $post->content ) > 200 ? substr( $post->content, 0, 200) . ' ...' : $post->content !!}
                        </div>
                    </div>

                @endforeach
            @else

                <p>No post match on your term <strong>{{ $s }}</strong></p>

            @endif

            {{-- Display pagination only if more than the required pagination --}}
            @if( $posts->total() > 6 )
                <nav>
                    <ul class="pager">
                        @if( $posts->firstItem() > 1 )
                            <li><a href="{{ $posts->getPrevious() }}">Previous</a></li>
                        @endif

                        @if( $posts->lastItem() < $posts->total() )
                            <li><a href="{{ $posts->getNext() }}">Next</a></li>
                        @endif
                    </ul>
                </nav>
            @endif

        </div>
        @include('pages._sidebar')
    </div>
@endsection