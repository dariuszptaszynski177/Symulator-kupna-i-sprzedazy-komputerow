@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Warunki do symulacji</div>

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
                            
                                <div>
                                Warunki do symulacji
                                <div>
                            <table>
                                <tr>
                                    <th>Id</th>
                                    <th>Inflacja</th>
                                    <th>Euro</th>
                                    <th>Dolar</th>
                                    <th>Funt brytyjski</th>
                                    <th>Sytuacja ogólna</th>
                                    <th>Akcja</th>
                                </tr>
                            
                                <tr>
                                    <td>
                                        {{$conditions_simulation->id}}
                                    </td>
                                    <td>
                                        {{$conditions_simulation->inflation}} %
                                    </td>
                                    <td>
                                        {{$conditions_simulation->euro_currency}}
                                    </td>
                                    <td>
                                        {{$conditions_simulation->dolar_currency}}
                                    </td>
                                    <td>
                                        {{$conditions_simulation->funt_british_currency}}
                                    </td>
                                    <td>
                                        {{$conditions_simulation->situation}}
                                    </td>
                                    
                                    <td>
                                    <a href="{{route('conditions-edit-simulation',['id'=>$conditions_simulation->id])}}">Edytuj warunki do symulacji</a>
                                    </td>
                                </tr>
                           
                            </table>
                                
                        </div>

                        <div class="py-4">
                            Dane do przygotowania warunków symulacji
                            <div>
                                    <a href="{{route('conditions-create')}}">Dodaj</a>
                                </div>
                            <table>
                                <tr>
                                    <th>Id</th>
                                    <th>Inflacja</th>
                                    <th>Euro</th>
                                    <th>Dolar</th>
                                    <th>Funt brytyjski</th>
                                    <th>Sytuacja ogólna</th>
                                    <th>Akcja</th>
                                </tr>
                                @foreach($conditions as $condition)
                                    <tr>
                                        <td>
                                            {{$condition->id}}
                                        </td>
                                        <td>
                                            {{$condition->inflation}} %
                                        </td>
                                        <td>
                                            {{$condition->euro_currency}}
                                        </td>
                                        <td>
                                            {{$condition->dolar_currency}}
                                        </td>
                                        <td>
                                            {{$condition->funt_british_currency}}
                                        </td>
                                        <td>
                                            {{$condition->situation}}
                                        </td>
                                        
                                        <td>
                                            <a href="">Edytuj</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
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