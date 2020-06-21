<?php

namespace App\Http\Controllers;
use App\Ticket;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TicketController extends Controller
{
    //function to return to the create new ticket page
    public function createTicket()
    {
        return view('Pages.createTicket');
    }

    //function to store new ticket data in the database
    public function store(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        $ticket = new Ticket();
        $ticket->from_date = $request->input('from_date');
        $ticket->to_date = $request->input('to_date');
        $ticket->added_by = session('userData') ['username'];

        if(empty($request->input('assin_to')))
        {
            $ticket->assin_to = 'none';
        }
        else {
            //check if the username 'assigned to' is exists in the database
            $username = $request->input('assin_to');

            $check = Admin::checkForUsername($username);

            if ($check != '[]') {
                $ticket->assin_to = $request->input('assin_to');

                //get owner username
                $added_by = session('userData') ['username'];

                //get ticket assigned to  email to send email to him

                $getTicketOwnerEmail = Admin::getData($ticket->assin_to);
                $mail_to = $getTicketOwnerEmail->email;

                //email content
                $details = [
                    'title' => 'Mail from TicketsManager ',
                    'body' => $added_by . ' Assigned a ticket to you'
                ];

                //send email
                \Mail::to($mail_to)->send(new\App\Mail\sendMails($details));
            } else {
                return back()->with('error', __('Username not exists !'));
            }
        }
        $ticket->save();
        return redirect('/home')->with('success' , __('Ticket is successfully added!'));

    }

    //take all tickets data to the dashboard
    public function home()
    {
        $username = session('userData') ['username'];
        $tickets = Ticket::getBelongsToUser($username)->get();

        return view('Pages.Adminhome')->with('tickets' ,$tickets);
    }

    //return to edit page with ticket id
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        return view('Pages.edit', compact('ticket'));
    }

    //update ticket data
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
            'assin_to' => 'required',
        ]);

        $ticket = Ticket::find($id);
        $ticket->from_date = $request->from_date;
        $ticket->to_date = $request->to_date;

        //check if the username 'assigned to' is exists in the database
        $username = $request->assin_to;
        $check = Admin::checkForUsername($username);

        if($check != '[]')
        {
            $ticket->assin_to = $request->assin_to;

            //get ticket owner username

            $getTicketOwner = Ticket::find($id);
            $ticket_owner = $getTicketOwner->added_by;

            //get ticket owner email
            $getTicketOwnerEmail = Admin::getData($ticket_owner);
            $mail_to = $getTicketOwnerEmail->email;

            //email content
            $details = [
                'title' => 'Mail from TicketsManager ',
                'body' => 'We had to inform you that the statues of ticket :'.$ticket->id.' changed !'
            ];

            //send email
            \Mail::to($mail_to)->send(new\App\Mail\sendMails($details));
        }

        else {
            return back()->with('error' , __('Username not exists !'));
        }

        $ticket->save();
        return redirect('/home')->with('success', __('Your Ticket is Successfully Updated'));
    }

    //show a specific ticket in show page
    public function open($id)
    {
        $ticket = Ticket::find($id);
        return view('Pages.show')->with('ticket' ,$ticket);
    }

    //return to delete page with ticket id
    public function delete($id)
    {
        $ticket = Ticket::find($id);
        return view('Pages.goDelete')->with('ticket' ,$ticket);
    }

    //actual deleting fucntion
    public function deleteTicket($id)
    {
        $ticket = Ticket::find($id)->delete();;
        return redirect('/home')->with('success', __('Your Ticket is Successfully deleted'));
    }

    //filters function
    public function filter(Request $request)
    {

        $ticket = new Ticket();
        $ticket->from_date = $request->from_date;
        $ticket->to_date = $request->to_date;
        $ticket->assin_to = $request->assin_to;
        $ticket->added_by = $request->added_by;

        //check if the user enter 'you' in the field which mean 'his own username'
        if($request->assin_to == 'You' || $request->assin_to == 'you')
        {
            $ticket->assin_to = session('userData') ['username'];
        }

        //check if the user enter 'you' in the field which mean 'his own username'
        if($request->added_by == 'You' || $request->added_by == 'you')
        {
            $ticket->added_by = session('userData') ['username'];
        }

        $username = session('userData') ['username'];
        $from = $ticket->from_date;
        $to = $ticket->to_date;
        $assign =  $ticket->assin_to ;
        $added = $ticket->added_by;

        if(!empty($request->from_date))
        {
            if(!empty($request->to_date))
            {
                if(!empty($request->assin_to))
                {
                    if(!empty($request->added_by))
                    {
                        $tickets = DB::select("SELECT * FROM tickets WHERE ((assin_to ='$assign' AND from_date = '$from' AND to_date = '$to' AND added_by = '$added') AND (added_by = '$username' OR assin_to = '$username'))");
                        return view('Pages.filtered')->with('tickets' ,$tickets);
                    }
                    else{
                        $tickets = DB::select("SELECT * FROM tickets WHERE ((assin_to ='$assign' AND from_date = '$from' AND to_date = '$to') AND (added_by = '$username' OR assin_to = '$username'))");
                        return view('Pages.filtered')->with('tickets' ,$tickets);
                    }

                }
                else if(empty($request->assin_to ) && !empty($request->added_by )){
                    $tickets = DB::select("SELECT * FROM tickets WHERE (( from_date = '$from' AND to_date = '$to' AND added_by = '$added') AND (added_by = '$username' OR assin_to = '$username'))");
                    return view('Pages.filtered')->with('tickets' ,$tickets);
                }
                else{
                    $tickets = DB::select("SELECT * FROM tickets WHERE (( from_date = '$from' AND to_date = '$to' ) AND (added_by = '$username' OR assin_to = '$username'))");
                    return view('Pages.filtered')->with('tickets' ,$tickets);
                }
            }
            elseif (empty($request->to_date) && !empty($request->assin_to) && !empty($request->added_by ) ) {
                $tickets = DB::select("SELECT * FROM tickets WHERE ((assin_to ='$assign' AND from_date = '$from'  AND added_by = '$added') AND (added_by = '$username' OR assin_to = '$username'))");
                return view('Pages.filtered')->with('tickets' ,$tickets);
            }
            elseif (empty($request->to_date) && empty($request->assin_to) && !empty($request->added_by )){
                $tickets = DB::select("SELECT * FROM tickets WHERE (( from_date = '$from'  AND added_by = '$added') AND (added_by = '$username' OR assin_to = '$username'))");
                return view('Pages.filtered')->with('tickets' ,$tickets);
            }
            else{
                $tickets = DB::select("SELECT * FROM tickets WHERE (( from_date = '$from') AND (added_by = '$username' OR assin_to = '$username'))");
                return view('Pages.filtered')->with('tickets' ,$tickets);
            }
        }
        elseif (empty($request->from_date) && !empty($request->to_date) && !empty($request->assin_to) && !empty($request->added_by )){
            $tickets = DB::select("SELECT * FROM tickets WHERE ((assin_to ='$assign' AND to_date = '$to' AND added_by = '$added') AND (added_by = '$username' OR assin_to = '$username'))");
            return view('Pages.filtered')->with('tickets' ,$tickets);
        }
        elseif (empty($request->from_date) && empty($request->to_date) && !empty($request->assin_to) && !empty($request->added_by )){
            $tickets = DB::select("SELECT * FROM tickets WHERE ((assin_to ='$assign' AND added_by = '$added') AND (added_by = '$username' OR assin_to = '$username'))");
            return view('Pages.filtered')->with('tickets' ,$tickets);
        }
        elseif (empty($request->from_date) && empty($request->to_date) && empty($request->assin_to) && !empty($request->added_by )){
            $tickets = DB::select("SELECT * FROM tickets WHERE (( added_by = '$added') AND (added_by = '$username' OR assin_to = '$username'))");
            return view('Pages.filtered')->with('tickets' ,$tickets);
        }
        elseif (empty($request->from_date) && empty($request->to_date) && !empty($request->assin_to) && empty($request->added_by )){
            $tickets = DB::select("SELECT * FROM tickets WHERE (( assin_to = '$assign') AND (added_by = '$username' OR assin_to = '$username'))");
            return view('Pages.filtered')->with('tickets' ,$tickets);
        }
        elseif (empty($request->from_date) && !empty($request->to_date) && empty($request->assin_to) && empty($request->added_by )){
            $tickets = DB::select("SELECT * FROM tickets WHERE (( to_date = '$to') AND (added_by = '$username' OR assin_to = '$username'))");
            return view('Pages.filtered')->with('tickets' ,$tickets);
        }
        else{
            return redirect()->back();
        }


    }

}
