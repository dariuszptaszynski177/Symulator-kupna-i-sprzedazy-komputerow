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
                    <div>
                    Twój stan konta: {{$cash}} zł
                    </div>
                    <div>
                    Zasoby
                        <table>
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Komputer</td>
                                    <td>Ilość</td>
                                    <td>Wartość</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 1;?>
                                @foreach($resources as $resource)
                                <tr>
                                    <td>
                                        <?php echo $counter; $counter++; ?>
                                    </td>
                                    <td>
                                    {{$resource->computer_id}}
                                    </td>
                                    <td>
                                    {{$resource->quantity}}
                                    </td>
                                    <td>
                                    Wartość
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
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
@endsection