@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 2%;">
        <center>
            <h1> {{__('Login')}} </h1>
            <div class="w3-row-padding" style=" border-radius: 25px; margin-left: 26%; ">
                <div class="w3-half w3-margin-bottom" style=" border-radius: 25px;width: 500px; ">
                    <div class="w3-panel w3-padding-16 w3-white w3-card " style=" border-radius: 25px;height: 220px;">
                        {!! Form::open(['action' => 'AdminController@login' , 'method' => 'POST' , 'style' => 'margin-top : 5%']) !!}
                        {{csrf_field()}}
                        <div class="form-group">
                            {{Form::email('email', '' , ['class' => 'form-control','id' => 'username' , 'placeholder' => __('E-mail')])}}
                        </div>
                        <div class="form-group">
                            {{Form::password('password', ['class' => 'form-control','id' => 'username' , 'placeholder' => __('Password')])}}
                        </div>
                        {{Form::submit(__('Login') , ['class' => 'btn btn-success' , 'style' => "width: 150px"])}}
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
        </style>
    @endif
@endsection



