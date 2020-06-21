@extends('layouts.appAdmin')
@section('content')
    <div class="container" style="margin-top: 2%;">
        <center>
            <h1> {{__('New Ticket')}} </h1>
            <div class="w3-row-padding" style=" border-radius: 25px; margin-left: 17%; ">
                <div class="w3-half w3-margin-bottom" style=" border-radius: 25px;width: 700px;">
                    <div class="w3-panel w3-padding-16 w3-white w3-card " style=" border-radius: 25px;">
                        {!! Form::open(['action' => 'TicketController@store' , 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::label('from_date' , __('From:') , ['id' => 'right'])}}
                            {{Form::date('from_date', '' , ['class' => 'form-control','id' => 'username'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('to_date' , __('To:') , ['id' => 'right']) }}
                            {{Form::date('to_date', '' , ['class' => 'form-control','id' => 'username'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('assin_to' , __('Assigned to:') , ['id' => 'right']) }}
                            {{Form::text('assin_to', '' , ['class' => 'form-control','id' => 'username'])}}
                        </div>

                        {{Form::submit(__('Add') , ['class' => 'btn btn-success' , 'style' => "width: 150px"])}}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </center>
    </div>
    <!-- handling the style when language changes-->
    @if(app()->getLocale() == 'arabic')
        <style>
            #username {
                text-align: right;
            }
            #right {
                float: right;
            }
        </style>
    @else
        <style>
            #right {
                float: left;
            }
        </style>
    @endif

@endsection

