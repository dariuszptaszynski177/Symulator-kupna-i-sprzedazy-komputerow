@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Historia symulacji</div>

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

                    @include('admin.admin_menu')

                    <div>
                        <div>
                            
                        <table>
                            <tr>
                                <th>Id</th>
                                <th>Użytkownik</th>
                                <th>Nr oferty</th>
                                <th>Status</th>
                                <th>Informacja</th>
                                <th>Data</th>
                            </tr>
                            @foreach($simulation_logs as $simulation_log)
                                <tr>
                                    <td>
                                        {{$simulation_log->id}}
                                    </td>
                                    <td>
                                        {{$simulation_log->users->name}}
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
                                    <td>
                                        {{$simulation_log->created_at}}
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
</table>
@endsection