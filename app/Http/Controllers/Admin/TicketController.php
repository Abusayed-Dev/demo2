<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use DB;
use DataTables;
use Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('tickets')->leftJoin('users', 'users.id', 'tickets.user_id');

            if ($request->date) {
                $query->where('tickets.date', date('d-m-Y', strtotime($request->date)));
            }

            if ($request->service == 'Technical') {
                $query->where('tickets.service', 'Technical');
            } elseif ($request->service == 'Payment') {
                $query->where('tickets.service', 'Payment');
            } elseif ($request->service == 'Affiliate') {
                $query->where('tickets.service', 'Affiliate');
            } elseif ($request->service == 'Return') {
                $query->where('tickets.service', 'Return');
            } elseif ($request->service == 'Refund') {
                $query->where('tickets.service', 'Refund');
            }

            if ($request->status == 0) {
                $query->where('tickets.status', 0);
            } elseif ($request->status == 1) {
                $query->where('tickets.status', 1);
            } elseif ($request->status == 2) {
                $query->where('tickets.status', 2);
            }

            $data = $query->select('users.name', 'tickets.*')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('date', function ($row)
                    {
                        return date('d F , Y', strtotime($row->date));
                    })
                    ->editColumn('status', function ($row)
                    {
                        if ($row->status == 1) {
                            return '<span class="badge badge-success">Replied</span>';
                        } elseif ($row->status == 2) {
                            return '<span class="badge badge-warning">Close</span>';
                        } else {
                            return '<span class="badge badge-danger">Pending</span>';
                        }
                    })
                    ->addColumn('action', function ($row){
                       $actionBtn = '<a href="'. route('view.ticket', [$row->id]) .'" class="btn btn-sm btn-info mr-2"><i class="fa fa-edit"></i></a>
                            <a href="'. route('admin.delete.ticket', [$row->id]) .'" id="delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                            </a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'status', 'date'])
                    ->make(true);
        }

        return view('admin.ticket.index');
    }



    //__show ticket
    public function show($id)
    {
        $ticket = DB::table('tickets')->leftJoin('users', 'users.id', 'tickets.user_id')->select('users.name', 'tickets.*')->where('tickets.id', $id)->first();

        return view('admin.ticket.show_ticket', compact('ticket'));
        
    }

    //__reply admin ticket
    public function replyTicket(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => 'required',
        ]);

        $reply = [];
        $reply['user_id']  = 0;
        $reply['ticket_id']= $id;
        $reply['message']  = $request->message;
        $reply['date']     = date('d-m-Y');
        
        if ($request->image) {
            $image = $request->image;
            $photoname = uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(350, 160)->save('public/files/tickets/'. $photoname);
            $reply['image'] = 'public/files/tickets/'. $photoname;
        }
        
        DB::table('replies')->insert($reply);
        DB::table('tickets')->where('id', $id)->update(['status' => 1]);

        $notification = array('messege' => 'Ticket Reply Successfully.', 'alert-type'=> 'success',);
        return redirect()->back()->with($notification);
    }



    public function closeTicket($id)
    {
        DB::table('tickets')->where('id', $id)->update(['status' => 2]);
        $notification = array('messege' => 'Ticket Closed.', 'alert-type'=> 'success',);
        return redirect()->route('index.ticket')->with($notification);
    }

    //__delete Ticket
    public function deleteTicket($id)
    {
        DB::table('tickets')->where('id', $id)->delete();
        $notification = array('messege' => 'Ticket Deleted Successfull.', 'alert-type'=> 'success',);
        return redirect()->back()->with($notification);
    }
}
