@extends('layouts.appAdmin')
@section('content')
    <div class="container" style="margin-top: 2%;">
        <center>
        <h1> {{__('New Admin')}} </h1>
        <div class="w3-row-padding" style=" border-radius: 25px; margin-left: 17%; ">
            <div class="w3-half w3-margin-bottom" style=" border-radius: 25px;width: 700px;">
                <div class="w3-panel w3-padding-16 w3-white w3-card " style=" border-radius: 25px;">
                    {!! Form::open(['action' => 'AdminController@storeAdmin' , 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::text('username', '' , ['class' => 'form-control','id' => 'username', 'placeholder' => __('Username') ])}}
                        </div>
                        <div class="form-group">
                            {{Form::email('email', '' , ['class' => 'form-control','id' => 'username', 'placeholder' => __('E-mail')])}}
                        </div>

                    <!-- here we adding the roles to the created admin during creating operation which specify what options he will able to operate in his own page-->
                        <div class="form-group" id="items" >
                            <div id="item">
                                {{Form::label('create' , __('Create:'), ['id' => 'lables'])}}
                                {{Form::radio('create'), ['id' => 'radio']}}
                            </div>
                            <div id="item">
                                {{Form::label('edit' , __('Edit:'), ['id' => 'lables'])}}
                                {{Form::radio('edit'), ['id' => 'radio']}}
                            </div>
                            <div id="item">
                                {{Form::label('delete' , __('Delete:'), ['id' => 'lables'])}}
                                {{Form::radio('delete'), ['id' => 'radio']}}
                            </div>
                            <div id="item">
                                {{Form::label('close' , __('Close:'), ['id' => 'lables'])}}
                                {{Form::radio('close'), ['id' => 'radio']}}
                            </div>
                            <div id="item">
                                {{Form::label('open' , __('Open:'), ['id' => 'lables'])}}
                                {{Form::radio('open'), ['id' => 'radio']}}
                            </div>
                            <div id="item">
                                {{Form::label('reopen' , __('Reopen:'), ['id' => 'lables'])}}
                                {{Form::radio('reopen'), ['id' => 'radio']}}
                            </div>
                            <br>
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
            #lables {
                text-align: right;
                float: right;
            }
            #radio {
                float: right;
            }
            #item {
                float: right;
                margin-right: 14px;
            }
            #items {
                margin-right: 135px;
            }
        </style>
    @else
        <style>
            #username {
                text-align: left;
            }
            #lables {
                text-align: left;
                float: left;
            }
            #radio {
                float: left;
            }
            #item {
                float: left;
                margin-left: 14px;
            }
            #items {
                margin-left: 100px;
            }
        </style>
    @endif

@endsection
