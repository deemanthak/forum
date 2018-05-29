<div class="comment">
    <div class="author-img">
        <img class="img-responsive img-circle" src="images/author.jpg" alt="author"/>
    </div>
    <div class="author-post like-section">
        <h4>{{$reply->owner->name}}</h4>
        <div class="post-meta comment">
            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> {{$reply->created_at->diffForHumans()}} </a></span>
        </div>
        <p>{{$reply->body}} </p>
        <li><a href="#"><i class="fa fa-thumbs-up"></i></a></li>
        <li><a href="#"><i class="fa fa-thumbs-down"></i></a></li>
        <li><a class="pull-right" href="#">Reply</a></li>
    </div>
</div>
