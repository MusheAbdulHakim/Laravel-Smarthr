<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Ticket;
use App\Enums\UserType;
use App\Mail\NewTicket;
use App\Enums\TicketStatus;
use Illuminate\Http\Request;
use App\Enums\GeneralPriority;
use App\DataTables\TicketDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TicketDataTable $dataTable)
    {
        $pageTitle = __("Tickets");
        return $dataTable->render('pages.tickets.index',compact(
            'pageTitle'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('type', UserType::EMPLOYEE)->whereIsActive(true)->get();
        return view('pages.tickets.create',compact(
            'users'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'description' => 'required',
        ]);
        $creator = auth()->user()->id;
        $ticket = Ticket::create([
            'tk_id' => $request->tk_id ?? '#TKT-'.pad_zeros(Ticket::count()+1),
            'subject' => $request->subject,
            'created_by' => $creator,
            'user_id' => null,
            'description' => $request->description,
            'status' => $request->status ?? TicketStatus::NEW,
            'priority' => $request->priority ?? GeneralPriority::MEDIUM,
            'endDate' => $request->endDate
        ]);
        $ticketFiles = $request->ticketFiles ?? [];
        if(!empty($ticketFiles) && $request->hasFile('ticketFiles') && count($ticketFiles) > 0){
            foreach($ticketFiles as $file){
                $ticket->addMedia($file)->toMediaCollection('ticket-attachments');
            }
        }
        Mail::to(User::where('type',UserType::SUPERADMIN)->get())
            ->send(
            (new NewTicket($ticket))
                ->subject('You Have A New Ticket :' .$ticket->tk_id)
                ->from($ticket->createdBy->email, $ticket->createdBy->fullname)
            );
        $notification = notify(__('Ticket has been added'));
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::findOrFail(Crypt::decrypt($id));
        $pageTitle = __($ticket->subject);
        $ticketFiles = $ticket->getMedia('ticket-attachments');
        $users = User::where('type', UserType::EMPLOYEE)->whereIsActive(true)->get();
        return view('pages.tickets.show',compact(
            'ticket','pageTitle','ticketFiles','users'
        ));
    }

    public function assignedTickets(TicketDataTable $dataTable)
    {
        $pageTitle = __("My Tickets");
        return $dataTable->render('pages.tickets.index',compact(
            'pageTitle',
        ));
    }

    public function assignUser(Request $request){
        $request->validate([
            'ticket' => 'required',
            'user' => 'required',
        ]);
        $user = User::findOrFail($request->user);
        $ticket = Ticket::findOrFail($request->ticket)->first();
        $ticket->update([
            'user_id' => $user->id,
        ]);
        Mail::to($user)
            ->send(
                (new NewTicket($ticket))
                ->from($ticket->createdBy->email, $ticket->createdBy->fullname)
                ->subject(__('You Have Been Assigned A Ticket :') .$ticket->tk_id)
            );
        $notification = notify(__('Ticket has been assigned to user successfully'));
        return back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $users = User::where('type', UserType::EMPLOYEE)->whereIsActive(true)->get();
        return view('pages.tickets.edit',compact(
            'users','ticket'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'subject' => 'required',
            'description' => 'required',
        ]);
        $creator = auth()->user()->id;
        $ticket->update([
            'subject' => $request->subject,
            'created_by' => $creator,
            'user_id' => $request->user,
            'description' => $request->description,
            'status' => $request->status ?? TicketStatus::NEW,
            'priority' => $request->priority ?? GeneralPriority::MEDIUM,
            'endDate' => $request->endDate
        ]);
        $ticketFiles = $request->ticketFiles ?? [];
        if(!empty($ticketFiles) && $request->hasFile('ticketFiles') && count($ticketFiles) > 0){
            $ticket->getMedia('ticket-attachments')->delete();
            foreach($ticketFiles as $file){
                $ticket->addMedia($file)->toMediaCollection('ticket-attachments');
            }
        }
        $notification = notify(__('Ticket has been updated'));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        $notification = notify(__('Ticket has been deleted'));
        return back()->with($notification);
    }
}
