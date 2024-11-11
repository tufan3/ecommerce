<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__page index
    public function index()
    {
        // $page = Page::latest();
        $page = DB::table('pages')->latest()->get();
        return view('admin.setting.page.index',compact('page'));
    }
    //__page index

    //__page create__//
    public function create()
    {
        return view('admin.setting.page.create');
    }
    //__page create__//


    //__page store__//
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        //     'image' => 'required',
        //     ]);
            $page = new Page();
            $page->page_title = $request->page_title;
            $page->page_name = $request->page_name;
            $page->page_description = $request->page_description;
            $page->page_position = $request->page_position;
            $page->page_slug = Str::slug($request->page_name);
            $page->save();
            $notification = array('message' => 'Page Setting Add Successfully', 'alert-type' => 'success');
            return redirect()->route('page.index')->with($notification);
        }
    //__page store__//


    //__page edit__//
    public function edit($id)
    {
        $page = Page::find($id);
        return view('admin.setting.page.edit', compact('page'));
    }
    //__page edit__//


    //__page update__//
    public function update(Request $request, $id)
    {
        $page = Page::find($id);
        $page->page_title = $request->page_title;
        $page->page_name = $request->page_name;
        $page->page_description = $request->page_description;
        $page->page_position = $request->page_position;
        $page->page_slug = Str::slug($request->page_name);
        $page->save();
        $notification = array('message' => 'Page Setting Update Successfully', 'alert-type' => 'success');
        return redirect()->route('page.index')->with($notification);
    }
    //__page update__//

    //__page destroy__//
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        $notification = array('message' => 'Page Setting Delete Successfully', 'alert-type' => 'success');
        return redirect()->route('page.index')->with($notification);
    }
    //__page destroy__//

}
