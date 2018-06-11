@extends('layouts.main')

@section('content')
    <div class="col-md-6 col-sm-8 col-xs-12">
        <h2>Latest Threads</h2>
        <div class="main-content">
            <div class="form-body">
                <h3>Create a new thread</h3>
                <form method="post" action="/threads">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Channel</label>
                        <select class="form-control" name="channel_id" required>
                            <option value="">Choose one..</option>
                            @foreach($channels as $channel)
                                <option value="{{$channel->id}}"{{old('channel_id')==$channel->id ? 'selected' : ''}}>{{$channel->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Title</label>
                        <input class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Body</label>
                        <textarea required class="form-control" rows="3" name="body">{{ old('body') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success form-btn">Submit</button>

                </form>
                @if(count($errors))
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div><!-- main-content -->

    </div>
@endsection
