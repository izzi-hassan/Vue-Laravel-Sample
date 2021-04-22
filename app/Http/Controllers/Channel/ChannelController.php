<?php

namespace App\Http\Controllers\Channel;

use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    //

    public function subscribe(Request $request, $channel_id) {
        $channel = Channel::where('id', $channel_id)->first();

        $channel->subscribe();

        return response()->json(['success' => true]);
    }

    public function unSubscribe(Request $request, $channel_id) {
        $channel = Channel::where('id', $channel_id)->first();

        $channel->unSubscribe();

        return response()->json(['success' => true]);
    }

    public function getList(Request $request) {
        return response()->json(Channel::all());
    }
}
