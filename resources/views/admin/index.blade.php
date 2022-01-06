@extends('./layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin panel</div>

                <div class="card-body">
                    <ul>
                        <li><a href="{{route('admin-users')}}">Użytkownicy</a></li>
                        <li><a href="{{route('computers')}}">Komputery</a></li>
                        <li><a href="{{route('admin-simulations')}}">Symulacje</a></li>
                        <li><a href="{{route('conditions')}}">Warunki do sumulacji</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection