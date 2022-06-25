<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'tickets';
        $tickets = Ticket::get();
        return view('backend.tickets.index',compact(
            'title','tickets'
        ));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required',
            'staff' => 'required',
            "client" => "required",
            "priority" => "required",
            "cc" => 'required',
            'followers' => 'required',
            "description" => 'required',
            "files" => 'nullable',
            'status' => 'required'
        ]);
        $files = null;
        if($request->hasFile('files')){
            $files = array();
            foreach($request->files as $file){
                $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('storage/tickets/'.$request->subject), $fileName);
                array_push($files,$fileName);
            }
        }
        $uuid = IdGenerator::generate(['table' => 'tickets','field'=>'tk_id', 'length' => 9, 'prefix' =>'#TKT-']);
        Ticket::create([
            'subject'=> $request->subject,
            'tk_id' => $request->ticket_id ?? $uuid,
            'employee_id' => $request->staff,
            'client_id' => $request->client,
            'priority' => $request->priority,
            'cc' => $request->cc,
            'followers' => $request->followers,
            'files' => $files,
            'status' => $request->status,
            'description' => $request->description,
        ]);
        $notification = notify('ticket has been added');
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($ticket)
    {
        $title = 'view ticket';        
        $ticket = Ticket::where('subject','=',$ticket)->firstOrFail();
        return view('backend.tickets.show',compact(
            'title','ticket'
        ));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required',
            'ticket_id' => 'required',
            'staff' => 'required',
            "client" => "required",
            "priority" => "required",
            "cc" => 'required',
            'followers' => 'required',
            "description" => 'required',
            "files" => 'nullable',
            'status' => 'required'
        ]);
        $ticket = Ticket::findOrFail($request->id);
        $files = $ticket->files;
        if(!empty($request->files)){
            $files = array();
            $index = 0;
            foreach($request->files as $file){
                $fileName = time().$index.'.'.$file[$index]->getClientOriginalExtension();
                $file[$index]->move(public_path('storage/tickets/'.$request->subject), $fileName);
                array_push($files,$fileName);
                $index++;
            }
        }
        $ticket->update([
            'subject'=> $request->subject,
            'tk_id' => $request->ticket_id,
            'employee_id' => $request->staff,
            'client_id' => $request->client,
            'priority' => $request->priority,
            'cc' => $request->cc,
            'followers' => $request->followers,
            'files' => $files,
            'status' => $request->status,
            'description' => $request->description,
        ]);
        $notification = notify('ticket has been updated');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Ticket::findOrFail($request->id)->delete();
        $notification = notify('ticket has been deleted');
        return back()->with($notification);
    }
}
