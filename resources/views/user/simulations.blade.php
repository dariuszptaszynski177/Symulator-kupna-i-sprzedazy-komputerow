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
                                <!-- <th>User</th> -->
                                <th>Komputer</th>
                                <th>Ilość</th>
                                <th>Cena</th>
                                <th>Wartość</th>
                                </tr>
                                @foreach($simulations as $simulation)
                                <tr>
                                    <td>{{$simulation->id}}</td>
                                    <!-- <td>{{$simulation->user_id}}</td> -->
                                    <td>{{$simulation->computers->name}}</td>
                                    <td>{{$simulation->quantity}}</td>
                                    <td>{{$simulation->price}} zł</td>
                                    <td><?php echo ($simulation->quantity)*($simulation->price); ?> zł</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                    
                    <div class="py-4">
                        Historia symulacji
                        <table>
                            <tr>
                                <th>Id</th>
                                <th>Id symulacji</th>
                                <th>Status</th>
                                <th>Dodatkowe informacje</th>
                            </tr>
                            @foreach($simulation_logs as $simulation_log)
                                <tr>
                                    <td>
                                    {{$simulation_log->id}}
                                    </td>
                                    <td>
                                    {{$simulation_log->offer_id}}
                                    </td>
                                    <td>
                                    {{$simulation_log->status}}
                                    </td>
                                    <td>
                                    {{$simulation_log->information}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    

                </div>

                
                <div class="card-body">
                    <div class="panel-body">
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
table, td, th {
  border: 1px solid black;
  padding: 5px;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>
@endsection