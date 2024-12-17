<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //---campaign index---//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $campaign = Campaign::all();
            return DataTables::of($campaign)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                <a href="' . route('campaign.delete', [$row->id]) . '" id="delete_campaign" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>

                <a href="' . route('campaign.product', [$row->id]) . '" id="" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>';
                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.offer.campaign.index');
    }
    //---campaign index---//


    //---campaign store---//
    public function store(Request $request)
    {
        // return response()->json($request);
        $request->validate([
            'title' => 'required|unique:campaigns|max:200',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount' => 'required',
        ]);
        $slug = Str::slug($request->title);
        $campaign = new Campaign();
        $campaign->title = $request->title;
        $campaign->status = $request->status;
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;
        $campaign->discount = $request->discount;
        $campaign->month = date('F');
        $campaign->year = date('Y');

        $campaign_photo = $request->image;
        // dd($campaign_photo);

        $campaign_name = $slug . '.' . $campaign_photo->getClientOriginalExtension();
        Image::make($campaign_photo)->resize(340, 120)->save('public/files/campaign/' . $campaign_name);
        $campaign->image = 'public/files/campaign/' .$campaign_name;


        $campaign->save();
        return response()->json('Created successfully.');
        // $notification = array('message' => 'Added Successfully', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);
    }
    //---campaign store---//


    //---campaign edit---//
    public function edit($id)
    {
        $campaign = Campaign::find($id);
        return view('admin.offer.campaign.edit', compact('campaign'));
    }
    //---campaign edit---//


    //---campaign update---//
    public function update(Request $request)
    {
    $request->validate([
        'title' => 'required|unique:campaigns,title,'.$request->id.'max:200',
        'start_date' => 'required',
        'end_date' => 'required',
        'discount' => 'required',
        ]);

        $newSlug = Str::slug($request->title);

        $campaign = Campaign::find($request->id);

        if ($campaign->title != $request->title) {
            if ($campaign->image && file_exists($campaign->image)) {
                $oldImagePath = $campaign->image;
                $newImagePath = ('public/files/campaign/' . $newSlug . '.' . pathinfo($oldImagePath, PATHINFO_EXTENSION));

                rename($oldImagePath, $newImagePath);

                $campaign->image = 'public/files/campaign/' . $newSlug . '.' . pathinfo($oldImagePath, PATHINFO_EXTENSION);
            }
        }

        $campaign->title = $request->title;
        $campaign->status = $request->status;
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;
        $campaign->discount = $request->discount;

        $photo = $request->file('image');
        if ($photo) {
            if ($campaign->image && file_exists($campaign->image)) {
                unlink($campaign->image);
            }
            $photoname = $newSlug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(340, 120)->save('public/files/campaign/' . $photoname);
            $campaign->image = 'public/files/campaign/' . $photoname;
        }
        $campaign->save();
        // $notification = array('message' => 'updated successfully', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);
        return response()->json('Updated successfully.');
    }
    //---campaign update---//


    //---campaign destroy---//
    public function destroy($id)
    {
        $campaign = Campaign::find($id);
        $image = $campaign->image;
        if ($image && file_exists($image)) {
            unlink($image);
        }
        $campaign->delete();
        // $notification = array('message' => 'Deleted Successfully', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);
        return response()->json('Campaign Deleted!.');
    }
    //---campaign destroy---//

}
