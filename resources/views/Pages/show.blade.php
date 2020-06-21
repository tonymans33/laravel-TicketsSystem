@extends('layouts.appAdmin')
@section('content')
        <div class="w3-row-padding" style=" border-radius: 25px;margin-left: 350px;text-align: center ;margin-top: 2%">
            <div class="w3-half w3-margin-bottom" style=" border-radius: 25px;width: 800px;">
                <div class="w3-panel w3-padding-16 w3-white w3-card " style=" border-radius: 25px;">
                    <div class="form-control">
                        <span id="title" >{{__('Added by:')}}</span> <span id="value" >
                            @if($ticket->added_by == session('userData')['username'] ) <!--if add by the user -->
                            {{__('You')}}
                            @else <!--if add by another user -->
                                {{$ticket->added_by}}
                                @endif
                        </span>
                    </div><br>
                    <div class="form-control">
                        <span id="title">{{__('Assigned to:')}} </span> <span id="value">
                            @if($ticket->assin_to == session('userData')['username'] ) <!--if assigned to the user -->
                            {{__('You')}}
                            @else <!--if assigned to another user -->
                                {{$ticket->assin_to}}
                                @endif
                        </span>
                    </div><br>
                    <div class="form-control">
                        <span id="title">{{__('From:')}} </span> <span id="value"> {{$ticket->from_date}}</span>
                    </div><br>
                    <div class="form-control">
                        <span id="title">{{__('To:')}} </span> <span id="value">{{$ticket->to_date}}</span>
                    </div><br>
                    <a href="{{url('/home')}}" class="btn btn-outline-danger" style="width: 150px;">{{__('Close')}}</a>

                </div>

            </div>
        </div>
        <!-- handling the style when language changes-->
        @if(app()->getLocale() == 'arabic')
            <style>
                #title {
                    float: right;
                }
                #value {
                    float: left;
                }
            </style>
        @else
            <style>
                #title {
                    float: left;
                }
                #value {
                    float: right;
                }
            </style>

    @endif
@endsection
