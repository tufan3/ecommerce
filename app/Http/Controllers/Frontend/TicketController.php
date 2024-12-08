<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Ticket;
use App\Models\Reply;

use Intervention\Image\Facades\Image;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //------------support ticket-----------------------------------------//

    //---open ticket---//
    public function openTicket() {
        $ticket = Ticket::where('user_id', Auth::id())->latest()->take(10)->get();
        return view('user.ticket.ticket',compact('ticket'));
    }
    //---open ticket---//

    //---store ticket---//
    public function storeTicker(Request $request) {
        $request->validate([
           'subject' =>'required',
           'message' =>'required',
        ]);

        $ticket = new Ticket();
        $ticket->user_id = Auth::id();
        $ticket->subject = $request->subject;
        $ticket->priority = $request->priority;
        $ticket->service = $request->service;
        $ticket->message = $request->message;
        $ticket->status = 0;
        $ticket->date = date('Y-m-d');
        $photo = $request->image;

        if ($photo) {
            $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(600, 350)->save('public/files/ticket/' . $photoname);
            $ticket->image = 'public/files/ticket/' . $photoname;
        }

        $ticket->save();
        $notification = array('message' => 'Ticket created successfully!', 'alert-type' => 'success');
        return redirect()->route('open.ticket')->with($notification);
    }
    //---store ticket---//


    //---show ticket---//
    public function showTicker($id) {
        $ticket = Ticket::find($id);
        return view('user.ticket.show_ticket',compact('ticket'));
    }
    //---show ticket---//


    //---reply ticket---//
    public function replyTicker(Request $request) {
        $request->validate([
            'message' =>'required',
         ]);

         $reply = new Reply();
         $reply->user_id = Auth::id();
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
    //---reply ticket---//


    //-------------support ticket---------------------------------------//
}
