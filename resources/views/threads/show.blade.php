@extends('layouts.main')

@section('content')
    <div class="col-md-6 col-sm-8 col-xs-12">
        <div class="main-content">
            <article>
                <div class="post-img">
                    <a href="#"><img class="img-responsive" src="{{asset('images/Details-img-1.jpg')}}" alt="Post"/></a>
                </div>
                <a href="#" class="btn btn-default btn-sm btn-category" type="submit">business</a>
                <a href="#"><h2 class="post-title">{{$thread->title}}</h2></a>
                <div class="post-meta">
                    <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                    <span><a href="#"><i
                                    class="fa fa-comments post-meta-icon"></i> {{$thread->replies_count}} {{str_plural('comment',$thread->replies_count)}} </a></span>
                    <span><a href="#"><i
                                    class="fa fa-calendar-check-o post-meta-icon"></i> {{$thread->created_at->diffForHumans()}} </a></span>

                    @can('update',$thread)
                        <span><form id="delete-thread" method="post"
                                    action="{{$thread->path()}}">{{csrf_field()}}{{method_field('DELETE')}}<a href="#"
                                                                                                              onclick="document.getElementById('delete-thread').submit();"><i
                                            class="fa fa-trash post-meta-icon"
                                            style="color:red"></i> Delete Post </a></form></span>
                    @endcan
                </div>
                <div class="post-content">
                    {{$thread->body}}</p>
                </div>
            </article>
            <div class="author">
                <div class="author-img">
                    <img class="img-responsive img-circle" src="images/author.jpg" alt="author"/>
                </div>
                <div class="author-post">
                    <h4><a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a></h4>

                </div>
            </div>
            {{--<div class="row related-post">--}}
            {{--<h4>related posts</h4>--}}
            {{--<div class="col-md-6 col-sm-6">--}}
            {{--<a href="#">--}}
            {{--<img class="img-responsive" src="images/post-img-9.jpg" alt=""/>--}}
            {{--<p class="post-title">fixing rwd issues canbe quite easy once you understand</p>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-md-6 col-sm-6">--}}
            {{--<a href="#">--}}
            {{--<img class="img-responsive" src="images/post-img-4.jpg" alt=""/>--}}
            {{--<p class="post-title">fixing rwd issues canbe quite easy once you understand</p>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-md-6 col-sm-6">--}}
            {{--<a href="#">--}}
            {{--<img class="img-responsive" src="images/post-img-8.jpg" alt=""/>--}}
            {{--<p class="post-title">fixing rwd issues canbe quite easy once you understand</p>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-md-6 col-sm-6">--}}
            {{--<a href="#">--}}
            {{--<img class="img-responsive" src="images/post-img-10.jpg" alt=""/>--}}
            {{--<p class="post-title">fixing rwd issues canbe quite easy once you understand</p>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="comment-post">
                <h3>{{$thread->replies_count}} {{str_plural('comment',$thread->replies_count)}}</h3>

                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach
                {{ $replies->links() }}
            </div>

            @if(auth()->check())
                <div class="form-body">
                    <h3>leave a reply</h3>
                    <form method="post" action="{{$thread->path().'/replies'}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Message*</label>
                            <textarea class="form-control" rows="3" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success form-btn">Submit</button>
                        <div class="checkbox details-page">
                            <input id="option2" type="checkbox" name="field" value="option2">
                            <label for="option2"><span><span></span></span>Notify me of followup comments via
                                e-mail</label>
                        </div>
                    </form>
                </div>
            @else
                <p>Please sign in to participate this discussion</p>
            @endif
        </div><!-- main-content -->
    </div>
@endsection
