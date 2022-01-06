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

                    <div>
                        <form method="POST" action="{{route('conditions-save')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div>
                                Inflacja<br />
                                <input class="form-control" type="number" name="inflation" step="0.1">
                            </div>
                            <div>
                                Euro<br />
                                <input class="form-control" type="number" name="euro" step="0.01" min="0">
                            </div>
                            <div>
                                Dolar amerykański<br />
                                <input class="form-control" type="number" name="dolar" step="0.01" min="0">
                            </div>
                            <div>
                                Funt brytujski<br />
                                <input class="form-control" type="number" name="funt" step="0.01" min="0">
                            </div>
                            <div>
                                Sytuacja w kraju<br />
                                <select name="situation" class="form-control">
                                    <option value="dobra">Dobra</option>
                                    <option value="umiarkowana">Umiarkowana</option>
                                    <option value="zła">Zła</a>
                                </select>
                            </div>
                            <div class="py-2">
                                <input class="btn btn-success" type="submit" value="Dodaj">
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