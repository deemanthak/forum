<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadsFilter;
use App\Thread;
use App\User;
use Illuminate\Http\Request;
use function redirect;
use function response;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @param ThreadsFilter $threadsFilter
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadsFilter $threadsFilter)
    {

        $threads = $this->getThreads($channel, $threadsFilter);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'title' => $request['title'],
            'channel_id' => $request['channel_id'],
            'body' => $request['body']
        ]);
        return redirect($thread->path())->with('flash', "your thread has been published");
    }

    /**
     * Display the specified resource.
     *
     * @param $channelId
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Thread $thread)
    {
//        return $thread->replies;
        $replies = $thread->replies()->paginate(25);
        return view('threads.show', compact('thread', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $channel
     * @param  \App\Thread $thread
     * @return void
     * @throws \Exception
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);
//        if($thread->user_id !=auth()->id()){
//            if(request()->wantsJson()){
//                return response(['status'=>'Permission Denied'],403);
//            }
//            return redirect('/login');
//        }
//        $thread->replies()->delete();
        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/threads')->with('flash', "Thread has been deleted");
    }

    /**
     * @param Channel $channel
     * @param ThreadsFilter $threadsFilter
     * @return mixed
     */
    protected function getThreads(Channel $channel, ThreadsFilter $threadsFilter)
    {

        $threads = Thread::latest()->filter($threadsFilter);
        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }
        $threads = $threads->get();
        return $threads;
    }


}
