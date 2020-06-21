@extends('layouts.app')

@section('content')
    <div class="container" style="text-align: center;margin-top: 15%">
        <h1>{{__('Welcome to Tickets Manager')}}</h1><br>
        <a class="btn btn-outline-success " style="width: 230px; " href="{{url('/getIn')}}" tabindex="-1" aria-disabled="true">{{__('Get Started')}}</a>
    </div>
@endsection
