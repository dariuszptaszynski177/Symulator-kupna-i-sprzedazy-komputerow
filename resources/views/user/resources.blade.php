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
                                    <td>Cena jednostkowa</td>
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
                                    {{$resource->computers->name}}
                                    </td>
                                    <td>
                                    {{$resource->computers->price}} zł
                                    </td>
                                    <td>
                                    {{$resource->quantity}}
                                    </td>
                                    <td>
                                    <?php echo ($resource->computers->price)*($resource->quantity);?> zł
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="py-4">
                        Wystaw zasoby do symulacji
                        <div>
                            <form method="POST" action="{{route('create-offer-simulation')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                @foreach($resources as $resource)
                                    <fieldset class="bg-light p-2" style="border: 1px solid black">
                                    <legend>Komputer:  {{$resource->computers->name}}</legend>

                                    <div>
                                    Twoja cena za jeden zestaw (cena zakupu {{$resource->computers->price}})
                                    <input class="form-control" type="number" step="0.01" name="price[]" value="0.00">
                                    </div>
                                    <div>
                                    Ilość zestawów, które chcesz wystawić do symulacji
                                    <input class="form-control" name="quantity[]" type="number" min="0" max="{{$resource->quantity}}" value="0">
                                    </div>
                                    </fieldset>
                                @endforeach
                                <div class="py-4">
                                <input class="btn btn-success" type="submit" value="Wystaw ofertę do symulacji">
                                </div>
                            </form>
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
  
  border-collapse: collapse;
}
</style>
@endsection