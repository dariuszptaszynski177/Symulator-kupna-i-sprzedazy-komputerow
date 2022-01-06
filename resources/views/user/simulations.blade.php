@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                      {{ session('error') }}
                    </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Aktualne symulacje

                    <div>
                        <table>
                            <tr>
<th>Id</th>
<th>User</th>
<th>Komputer</th>
<th>Ilość</th>
<th>Cena</th>
<th>Wartość</th>
</tr>
                    @foreach($simulations as $simulation)
                    <tr>
                        <td>{{$simulation->id}}</td>
                        <td>{{$simulation->user_id}}</td>
                        <td>{{$simulation->computer_id}}<td>
                        <td>{{$simulation->quantity}}</td>
                        <td>{{$simulation->price}}<td>
                        <td><?php echo ($simulation->quantity)*($simulation->price); ?> zł</td>
</tr>
                    @endforeach
</table>
</div>
                    
                    

                </div>

                <div>
Historia symulacji
</div>
                <div class="card-body">
                    <div class="panel-body">
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection