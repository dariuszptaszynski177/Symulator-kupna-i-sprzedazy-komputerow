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

                    <div>
                        <form method="POST" action="{{route('computer-update')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" value="{{$computer->id}}">
                            <div>
                                Nazwa<br />
                                <input class="form-control" type="text" name="name" value="{{$computer->name}}">
                            </div>
                            <div>
                                Cena<br />
                                <input class="form-control" type="number" step="0.01" name="price" value="{{$computer->price}}">
                            </div>
                            <div class="py-2">
                                <input class="btn btn-success" type="submit" value="Aktualizuj">
                            </div>
                        </form>
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