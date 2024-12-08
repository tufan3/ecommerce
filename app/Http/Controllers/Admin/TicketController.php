<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //--ticket index--//
    public function index(Request $request){
        if ($request->ajax()) {
            // $product = Product::all();

            $ticket = "";
            $sql = DB::table('tickets')->leftJoin('users','tickets.user_id','users.id');

            if($request->date){
                $sql->where('tickets.date',$request->date);
            }
            if($request->status == 1){
                $sql->where('tickets.status',1);
            }
            if($request->status == 0){
                $sql->where('tickets.status',0);
            }
            if($request->status == 2){
                $sql->where('tickets.status',2);
            }


            $ticket = $sql->select('tickets.*','users.name')->get();

            return DataTables::of($ticket)
                ->addIndexColumn()

                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge badge-success">Reply</span>';
                    } elseif ($row->status == 0) {
                        return '<span class="badge badge-warning">Pending</span>';
                    } elseif ($row->status == 2) {
                        return '<span class="badge badge-danger">Closed</span>';
                    } elseif ($row->status == 'all') {
                        return '<span class="badge badge-success">Reply</span>
                                <span class="badge badge-warning">Pending</span>
                                <span class="badge badge-danger">Closed</span>';
                    }
                })


                ->editColumn('date', function ($row) {
                   return date('d, F Y',strtotime($row->date));
                })

                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="' . route('admin.ticket.show', [$row->id]) . '" class="btn btn-info btn-sm edit" ><i class="fas fa-eye"></i></a>

                    <a href="' . route('admin.ticket.delete', [$row->id]) . '" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.ticket.index');
    }
    //--ticket index--//


    //--ticket show--//
    public function show($id){
        $ticket = DB::table('tickets')->leftJoin('users','tickets.user_id','users.id')->select('tickets.*','users.name')->where('tickets.id',$id)->first();
        return view('admin.ticket.view_ticket',compact('ticket'));
    }
    //--ticket show--//


    //--ticket store--//
    public function replyTicketStore(Request $request){
        $request->validate([
            'message' =>'required',
         ]);

         $reply = new Reply();
         $reply->user_id = 0;
         $reply->message = $request->message;
         $reply->ticket_id = $request->ticket_id;
         $reply->date = date('Y-m-d');
         $photo = $request->image;

         if ($photo) {
             $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
             Image::make($photo)->resize(600, 350)->save('public/files/ticket/reply/' . $photoname);
             $reply->image = 'public/files/ticket/reply/' . $photoname;
         }

         $reply->save();

         $ticket = Ticket::find($request->ticket_id);
         $ticket->status = 1;
         $ticket->save();

         $notification = array('message' => 'Reply successfully!', 'alert-type' => 'success');
         return redirect()->back()->with($notification);
    }
    //--ticket store--//


    //--ticket close--//
    public function closeTicket($id){
        $ticket = Ticket::find($id);
        $ticket->status = 2;
        $ticket->save();

        $notification = array('message' => 'Ticket closed successfully!', 'alert-type' =>'success');
        return redirect()->route('ticket.index')->with($notification);
    }
    //--ticket close--//


    //--ticket destroy--//
    public function destroyTicket($id){
        $ticket = Ticket::find($id);
        $ticket->delete();
        $notification = array('message' => 'Ticket deleted successfully!', 'alert-type' => 'success');
        return redirect()->route('ticket.index')->with($notification);
    }
    //--ticket destroy--//


}
