<!--Nav bar when logged out-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand btn btn-outline-secondary" href="{{url('/')}}" style=" font-size: 18px;">{{__('Tickets Manager')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @if(app()->getLocale() == 'arabic')
                <li class="nav-item active" style="margin-left: 1285px;">
                    <a class="btn btn-success" href="{{url('locale/en')}}" style="width: 115px; text-align: left;">English<img style="width: 30px;position: absolute; margin-left: 10px; margin-top: 4px;" src="{{asset('img/en_flag.png')}}"></a>
                </li>
            @endif
            <li class="nav-item active" style="margin-left: 1217px;">
                <a class="btn btn-success" href="{{url('locale/arabic')}}" style="width: 105px; text-align: left;">Arabic<img style="width: 25px;position: absolute; margin-left: 10px; margin-top: 3.5px;" src="{{asset('img/arabic_flag.png')}}"></a>
            </li>
        </ul>
    </div>
</nav>

