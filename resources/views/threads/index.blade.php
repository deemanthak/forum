@extends('layouts.main')

@section('content')
    <div class="col-md-6 col-sm-8 col-xs-12">
        <h2>Latest Threads</h2>
        <div class="main-content">


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
                    <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                    <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                </div>
                <div class="post-content">
                    <p>{{ $thread->body }}</p>
                </div>
            </article>
            @endforeach

        </div><!-- main-content -->
        <div class="pagination">
            <nav>
                <ul class="pagination">
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
