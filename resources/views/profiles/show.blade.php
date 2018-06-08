@extends('layouts.main')

@section('content')
    <div class="col-md-6 col-sm-8 col-xs-12">
        <div class="main-content">
            <h3>
            {{$profileUser->name}}
            <small>{{$profileUser->created_at->diffForHumans()}}</small>
            </h3>
            <hr>
            @foreach($threads as $thread)


                <article>
                    <div class="post-img">
                        <a href="{{$thread->path()}}"><img class="img-responsive"
                                                           src="images/post-img-1.jpg" alt="Post"/></a>
                    </div>
                    <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category"
                       type="submit">business</a>
                    <a href="{{$thread->path()}}"><h2 class="post-title">{{ $thread->title }}</h2></a>
                    <div class="post-meta">
                        <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                        <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> {{$thread->replies_count}} {{str_plural('comment',$thread->replies_count)}} </a></span>
                        <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> {{$thread->created_at->diffForHumans()}} </a></span>
                    </div>
                    <div class="post-content">
                        <p>{{ $thread->body }}</p>
                    </div>
                </article>
            @endforeach
            <div class="pagination">
                {{$threads->links ()}}
            </div>

        </div><!-- main-content -->
    </div>

@endsection