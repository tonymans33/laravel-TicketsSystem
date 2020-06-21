@extends('layouts.appAdmin')
@section('content')
    <div class="container" style="margin-top: 2%;">
        <center>
            <h1> {{__('Update Data')}} </h1>
            <div class="w3-row-padding" style=" border-radius: 25px; margin-left: 17%; ">
                <div class="w3-half w3-margin-bottom" style=" border-radius: 25px;width: 700px;">
                    <div class="w3-panel w3-padding-16 w3-white w3-card " style=" border-radius: 25px;">
                        {!! Form::open(['action' => 'AdminController@update' , 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::text('username', $admin->username , ['class' => 'form-control','id' => 'username', 'placeholder' => __('Username') ])}}
                        </div>
                        <div class="form-group">
                            {{Form::email('email', $admin->email , ['class' => 'form-control','id' => 'username', 'placeholder' => __('E-mail')])}}
                        </div>
                        <div class="form-group">
                            {{Form::text('password' , $admin->password , ['class' => 'form-control','id' => 'username', 'placeholder' => __('Password')])}}
                        </div>

                        {{Form::submit(__('Update') , ['class' => 'btn btn-success' , 'style' => "width: 150px"])}}
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
    @else
        <style>
            #username {
                text-align: left;
            }

        </style>
    @endif

@endsection
