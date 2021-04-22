<?php

namespace App\Http\Controllers\Feed;

use App\Models\ContentPost;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function __construct() {
    }

    public function userFeed(Request $request) {
        $channels = array();
        $c = Auth::user()->profile->channels;

        foreach ($c as $channel) {
            $channels[] = $channel->id;
        }

        $feed = ContentPost::whereIn('channel_id', $channels)->with(['type', 'author.user.profile', 'channel'])->get()->sortByDesc('score');

        return response()->json(['success' => true, 'feed' => $feed]);
    }

    public function channelFeed(Request $request, $slug) {
        $feed = Channel::where('slug', $slug)->with(['posts.author.user', 'posts.type', 'posts.channel'])->first();

        return response()->json(['success' => true, 'feed' => $feed['posts']]);
    }

    public function profileFeed(Request $request, $profileId) {
        $feed = ContentPost::where('profile_id', $profileId)->with(['author.user.profile', 'type', 'channel'])->get()->sortByDesc('created_at');

        return response()->json(['success' => true, 'feed' => $feed]);
    }
}
