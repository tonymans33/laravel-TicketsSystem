@extends('layouts.appAdmin')

@section('content')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <div class="container" style="margin-top: 3%; margin-left: 160px;">

        <table class="display" style="width: 1200px; text-align: center;" id="myTable" >
            <thead>

            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('Added by')}}</th>
                <th scope="col">{{__('Assigned to')}}</th>
                <th scope="col">{{__('From')}}</th>
                <th scope="col">{{__('To')}}</th>
                <th scope="col">{{__('Action')}}</th>
            </tr>
            </thead>
            <tbody>
            {{csrf_field()}}
            @if(count($tickets) > 0)
                @foreach($tickets as $ticket)
                    <tr>
                        <th scope="row">{{ $ticket->id}}</th>
                        <td>

                        @if($ticket->added_by == session('userData')['username'] ) <!--if added by the user -->
                        {{__('You')}}
                        @else <!--if add by another user -->
                            {{$ticket->added_by}}
                            @endif
                        </td>
                        <td>
                        @if($ticket->assin_to == session('userData')['username'] ) <!--if assigned to the user -->
                        {{__('You')}}
                        @else <!--if assigned to another user -->
                            {{$ticket->assin_to}}
                            @endif
                        </td>

                        <!--specify what options the user will be able to operate on the tickets-->
                        <td>{{$ticket->from_date}}</td>
                        <td>{{$ticket->to_date}}</td>
                        <td>@if(session('userData')['edit'] == 'yes')
                                <a href="{{route('edit', $ticket->id)}}" style="text-decoration: none">{{__('Edit |')}}</a>
                            @endif
                            @if(session('userData')['open'] == 'yes')
                                <a href="{{route('open', $ticket->id)}}" style="text-decoration: none">{{__('Open |')}}</a>
                            @endif
                            @if(session('userData')['delete'] == 'yes')
                                <a  href="{{route('delete', $ticket->id)}}" style="text-decoration: none">{{__('Delete')}}</a>
                            @endif
                            @if(session('userData')['edit'] == 'no' && session('userData')['open'] == 'no' && session('userData')['delete'] == 'no')
                                {{__('No Actions ')}}
                            @endif

                        </td>
                    </tr>
                @endforeach
            @else
                <p>{{__('No Tickets ')}}</p>
            @endif

            </tbody>
        </table>
        <center>
        <a href="{{url('/home')}}" class="btn btn-secondary" style="width: 350px">{{__('Back')}}</a>
        </center>
    </div>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>


@endsection
