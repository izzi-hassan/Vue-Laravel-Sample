<?php

namespace App\Http\Controllers\Content;

use App\Models\ContentPost;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    private $averageWPM = 200;

    public function __construct() {

    }

    public function save(Request $request) {
        // TODO: Validate $request->all()
        $contentPost = ContentPost::updateOrCreate($request->all());

        return response()->json(['success' => true, 'content' => $contentPost]);
    }

    public function delete(Request $request, $content_id) {
        ContentPost::destroy($content_id);

        return response()->json(['success' => true]);
    }

    public function get(Request $request, $slug) {
        try {
            if (is_numeric($slug)) {
                $content = ContentPost::where('id', $slug)->with(['type', 'channel', 'author.user', 'commentPosts', 'favoritedBy', 'bookmarkedBy', 'sharedBy'])->firstOrFail();
            } else {
                $content = ContentPost::where('slug', $slug)->with(['type', 'channel', 'author.user', 'commentPosts', 'favoritedBy', 'bookmarkedBy', 'sharedBy'])->firstOrFail();
            }

            return response()->json(['success' => true, 'contentPost' => $content]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Content does not exist']);
        }
    }

    public function favorite(Request $request, $id) {
        try {
            $content = ContentPost::where('id', $id)->firstOrFail();
            $content->favorite();

            return response()->json(['success' => true]);

        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Content does not exist']);
        }
    }

    public function unFavorite(Request $request, $id) {
        try {
            $content = ContentPost::where('id', $id)->firstOrFail();
            $content->unFavorite();

            return response()->json(['success' => true]);

        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Content does not exist']);
        }
    }

    public function bookmark(Request $request, $id) {
        try {
            $content = ContentPost::where('id', $id)->firstOrFail();
            $content->bookmark();

            return response()->json(['success' => true]);

        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Content does not exist']);
        }
    }

    public function unBookmark(Request $request, $id) {
        try {
            $content = ContentPost::where('id', $id)->firstOrFail();
            $content->unBookmark();

            return response()->json(['success' => true]);

        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Content does not exist']);
        }
    }

    public function share(Request $request, $id) {
        try {
            $content = ContentPost::where('id', $id)->firstOrFail();
            $content->share();

            return response()->json(['success' => true]);

        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Content does not exist']);
        }
    }

    public function unShare(Request $request, $id) {
        try {
            $content = ContentPost::where('id', $id)->firstOrFail();
            $content->unShare();

            return response()->json(['success' => true]);

        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Content does not exist']);
        }
    }
}
