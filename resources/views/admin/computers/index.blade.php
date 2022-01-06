@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Komputery</div>

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
<a href="{{route('computer-create')}}">Dodaj</a>
</div>
                        </div>
                        <table>
                            <tr>
                                <th>Id</th>
                                <th>Nazwa</th>
                                <th>Cena</th>
                                <th>Akcja</th>
                            </tr>
                            @foreach($computers as $computer)
                                <tr>
                                    <td>
                                        {{$computer->id}}
                                    </td>
                                    <td>
                                        {{$computer->name}}
                                    </td>
                                    <td>
                                        {{$computer->price}}
                                    </td>
                                    <td>
                                        <a href="{{route('computer-edit', ['id'=>$computer->id])}}">Edytuj</a>
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