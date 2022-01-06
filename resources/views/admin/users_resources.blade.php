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
                        
                        <table>
                            <tr>
                                <th>Id</th>
                                <th>Nazwa użytkownika</th>
                                <th>Stan konta</th>
                                <th>Zasoby</th>
                            </tr>
                            @foreach($users_resources as $user_resources)
                                <tr>
                                    <td>
                                        {{$user_resources->id}}
                                    </td>
                                    <td>
                                        {{$user_resources->users->name}}
                                    </td>
                                    <td>
                                       {{$user_resources->cash}} zł
                                    </td>
                                    <td>
                                        <?php 
                                            $counter=0;
                                        ?>
                                        @foreach($user_resources->resources as $resource)
                                            <b>Zestaw <?php $counter++; echo $counter; ?></b> (szt.): {{$resource['quantity']}}
                                        @endforeach
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