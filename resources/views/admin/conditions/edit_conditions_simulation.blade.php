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
                        
                        <div>
                            Średnia inflacja z ostatnich okresów: <b>{{round($conditions->avg('inflation'), 2)}}</b>
                        </div>
                        <div>
                            Średni kurs euro z ostatnich okresów: <b>{{round($conditions->avg('euro_currency'), 2)}}</b>
                        </div>

                        <div>
                            Średni kurs dolara amerykańskiego z ostatnich okresów: <b>{{round($conditions->avg('dolar_currency'), 2)}}</b>
                        </div>

                        <div>
                            Średni kurs funta brytyjskiego z ostatnich okresów: <b>{{round($conditions->avg('funt_british_currency'), 2)}}</b>
                        </div>

                        <div>
                            <?php 
$sum =0;
$counter=0;
                            ?>
@foreach($conditions as $condition)
@if($condition->situation=="dobra")
<?php 
$situation=3; 
//$situation;
?>
@elseif($condition->situation=="umiarkowana")
<?php 
$situation=2; 
//$situation;
?>
@else
<?php 
$situation=1; 
//$situation;
?>
@endif

<?php 
$sum = $sum+$situation;
$counter++;
?>
@endforeach

<?php 
// echo $sum;
// echo $counter;
$avg = $sum/$counter;
// echo $avg;
if($avg==3)
{
    $situation_country = "Dobra";
}
elseif($avg>=2 && $avg<3)
{
    $situation_country = "Umiarkowana";
}
else 
{
    $situation_country = "Zła";    
}

echo "Sytuacja w kraju: <b>".$situation_country."</b>";
?>

</div>
                    </div>

                    <div>
                        <form method="POST" action="{{route('conditions-simulation-update')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" value="{{$conditions_simulation->id}}">
                            <div>
                                Inflacja<br />
                                <input class="form-control" type="number" name="inflation" step="0.1" value="{{$conditions_simulation->inflation}}">
                            </div>
                            <div>
                                Euro<br />
                                <input class="form-control" type="number" name="euro" step="0.01" min="0" value="{{$conditions_simulation->euro_currency}}">
                            </div>
                            <div>
                                Dolar amerykański<br />
                                <input class="form-control" type="number" name="dolar" step="0.01" min="0" value="{{$conditions_simulation->dolar_currency}}">
                            </div>
                            <div>
                                Funt brytujski<br />
                                <input class="form-control" type="number" name="funt" step="0.01" min="0" value="{{$conditions_simulation->funt_british_currency}}">
                            </div>
                            <div>
                                Sytuacja w kraju<br />
                                <select name="situation" class="form-control">
                                    @if($conditions_simulation->situation=="dobra")
                                    <option value="dobra" selected>Dobra</option>
                                    <option value="umiarkowana">Umiarkowana</option>
                                    <option value="zła">Zła</a>
                                    @elseif($conditions_simulation->situation=="umiarkowana")
                                    <option value="dobra">Dobra</option>
                                    <option value="umiarkowana" selected>Umiarkowana</option>
                                    <option value="zła">Zła</a>
                                    @else
                                    <option value="dobra">Dobra</option>
                                    <option value="umiarkowana">Umiarkowana</option>
                                    <option value="zła" selected>Zła</a>
                                    @endif
                                </select>
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