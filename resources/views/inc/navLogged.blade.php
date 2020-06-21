<!--Nav bar when logged out-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand btn btn-secondary" href="{{url('/home')}}" style=" font-size: 18px;">{{__('Tickets Manager')}}</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
                <a class="btn btn-danger" style="width: 80px;"   href="{{url('/home')}}">{{session('userData')['username']}}</a>
            </li>

            <li class="nav-item  ">
                <a class=" btn btn-outline-secondary" id="d"  style="width: 110px;margin-left: 5px;" href="{{url('/createAdmin')}}">{{__('New Admin')}}</a>
            </li>
            <li class="nav-item  ">
                <a class=" btn btn-outline-secondary"  style="width: 120px;margin-left: 5px;" href="{{url('/updateData')}}">{{__('Update data')}}</a>
            </li>
            @if(session('userData')['create'] == 'yes')
                <li class="nav-item " >
                    <a class="btn btn-outline-secondary " style="width: 110px; margin-left: 5px;"  href="{{url('/createTicket')}}">{{__('New Ticket')}}</a>
                </li>


                @if(app()->getLocale() == 'arabic')
                        <li class="nav-item active" style="margin-left: 770px;">
                            <a class="btn btn-secondary" href="{{url('locale/en')}}" style="width: 110px; text-align: left;">English<img style="width: 30px;position: absolute; margin-left: 6px; margin-top: 4px;" src="{{asset('img/en_flag.png')}}"></a>
                        </li>
                    @else
                        <li class="nav-item active" style="margin-left: 703px;">
                            <a class="btn btn-success" href="{{url('locale/arabic')}}" style="width: 100px; text-align: left;">Arabic<img style="width: 25px;position: absolute; margin-left: 6px; margin-top: 3.5px;" src="{{asset('img/arabic_flag.png')}}"></a>
                        </li>
                @endif

                <li class="nav-item ">
                    <a class="btn btn-outline-danger " style="width: 80px; margin-left: 5px;"  href="{{url('/logout')}}">{{__('Logout')}}</a>
                </li>


            @else
                    @if(app()->getLocale() == 'arabic')
                        <li class="nav-item active" style="margin-left: 890px;">
                            <a class="btn btn-secondary" href="{{url('locale/en')}}" style="width: 110px; text-align: left;">English<img style="width: 30px;position: absolute; margin-left: 6px; margin-top: 4px;" src="{{asset('img/en_flag.png')}}"></a>
                        </li>
                    @else
                        <li class="nav-item active" style="margin-left: 823px;">
                            <a class="btn btn-success" href="{{url('locale/arabic')}}" style="width: 100px; text-align: left;">Arabic<img style="width: 25px;position: absolute; margin-left: 6px; margin-top: 3.5px;" src="{{asset('img/arabic_flag.png')}}"></a>
                        </li>
                    @endif


                <li class="nav-item ">
                    <a class="btn btn-outline-danger " style="width: 80px; margin-left: 5px;"  href="{{url('/logout')}}">{{__('Logout')}}</a>
                </li>

            @endif

        </ul>
    </div>
</nav>
