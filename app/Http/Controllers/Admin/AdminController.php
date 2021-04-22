<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index(Request $request) {
        $data = array(
            'pages' => Page::all()
        );
        return view('admin.pages.index', $data);
    }

    public function showEditPage(Request $request, $uri) {
        try {
            $page = Page::where('uri', $uri)->firstOrFail();

            $data = array(
                'subnav' => null,
                'pageData' => $page,
                'publishButtonClass' => 'publish-page',
                'editable' => 'medium-editable',
                'showEditorBar' => true
            );
            return view('pages.page', $data);
        } catch (ModelNotFoundException $e) {
            return view('misc.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatePage(Request $request, $pageId)
    {
        $validation = Validator::make($request->input(), [
            'title' => 'required|max:400',
            'uri' => 'required|max:100',
            'heading' => 'required|max:200',
            'subheading' => 'max:200',
            'content' => 'required'
        ]);

        if ($validation->passes())
        {
            $page = Page::where('id', $pageId)->first();

            $page->parent_id = $request->input('parent_id', 0);
            $page->title = trim($request->input('title'));
            $page->uri = ltrim($request->input('uri'), '/');
            $page->heading = $request->input('heading');
            $page->subheading = $request->input('subheading');
            $page->content = $request->input('content');
            $page->meta = $request->input('meta', '');
            $page->notes = $request->input('notes', '');
            $page->save();

            return response()->json(array('success' => true, 'errors' => '', 'message' => 'Page updated successfully.'));
        }

        return response()->json(array('success' => false, 'errors' => $validation, 'message' => 'Validation Error'));
    }

    public function showCreatePage(Request $request) {
        $data = array(
            'subnav' => null,
            'publishButtonClass' => 'publish-page',
            'editable' => 'medium-editable',
            'create' => true,
            'contentType' => 'create-page',
            'showEditorBar' => true
        );

        return view('admin.pages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function savePage(Request $request)
    {
        $validation = Validator::make($request->input(), [
            'title' => 'required|max:400',
            'uri' => 'required|max:100',
            'heading' => 'required|max:200',
            'subheading' => 'max:200',
            'content' => 'required'
        ]);

        if ($validation->passes())
        {
            $page = new Page;
            $page->parent_id = $request->input('parent_id', 0);
            $page->title = trim($request->input('title'));
            $page->uri = ltrim($request->input('uri'), '/');
            $page->heading = $request->input('heading');
            $page->subheading = $request->input('subheading');
            $page->content = $request->input('content');
            $page->meta = $request->input('meta', '');
            $page->notes = $request->input('notes', '');
            $page->save();

            return response()->json(array('success' => true, 'errors' => '', 'message' => 'Page created successfully.'));
        }
        return response()->json(array('success' => false, 'errors' => $validation, 'message' => 'Validation Error'));
    }

    public function showDeletePage(Request $request, $pageId) {
        $data = array(
            'pageData' => Page::where('id', $pageId)->first()
        );

        return view('admin.pages.delete', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($pageId)
    {
        $page = Page::where('id', $pageId)->first();
        $page->delete();

        return redirect('/admin/pages');
    }

    public function upload()
    {
        $file = Input::file('file');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails()) {
            return response()->json(array('success' => false, 'errors' => $validator->getMessageBag()->toArray()));
        }

        $fileName = time() . '-' . $file->getClientOriginalName();
        $destination = public_path() . '/uploads/';
        $file->move($destination, $fileName);

        echo url('/uploads/'. $fileName);
    }
}
