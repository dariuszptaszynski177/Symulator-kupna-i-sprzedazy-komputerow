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
                    Twój stan konta: <span class="cash">{{$cash}}</span> zł
                    </div>
                    <div>
                    Dostępne komputery na sprzedaż
                        <table>
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Komputer</td>
                                    <td>Cena</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 1;?>
                                @foreach($computers as $computer)
                                <tr>
                                    <td>
                                        <?php echo $counter; $counter++; ?>
                                    </td>
                                    <td>
                                    {{$computer->name}}
                                    </td>
                                    <td>
                                    {{$computer->price}} zł
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="py-4">
<form method="post" action="{{route('user-computers-buy')}}">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <?php $id=1;?>
@foreach($computers as $computer)
<div>
<div>
{{$computer->name}} (<span class="prices">{{$computer->price}}</span> zł)<br/>
<input class="form-control computers" type="number" name="computer[]" data-id="<?php echo $id; ?>" placeholder="Ilość">
</div>
</div>
<?php $id++; ?>
@endforeach
<div class="py-2">
<input type="submit" class="btn btn-success" value="Kup komputery">
</div>
</form>
<h4>Wartość: <span class="value_computers"></span></h4>
<p class="alert text-danger"></p>
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

<script>
let prices = document.querySelectorAll('.prices');
let computers = document.querySelectorAll('.computers');
let value_computers = document.querySelector('.value_computers');
let cash = document.querySelector('.cash');
let alert = document.querySelector('.alert');
let sum = 0;
let arr = [];

var l = prices.length;
for (var i=0;i<l;i++) {
    
arr.push(parseInt(prices[i].textContent));
}

computers.forEach(function(computer)
{
    computer.addEventListener('keyup', function(){
        let temp = computer.getAttribute('data-id');
        let computer_id = parseInt(temp)-1;


        for(let i=0;i<arr.length;i++)
        {
            if(computer_id==i)
            {
                let temp2 = (computer.value)*(arr[i]);
                sum+=temp2
                console.log(sum)
                value_computers.innerHTML = sum;

                if(sum>parseInt(cash.textContent))
                {
                    alert.textContent = "Przekroczono kwotę";
                    let btn = document.querySelector('.btn');
                    btn.setAttribute('disabled', 'disabled')
                }
                
            }
        }
        
    })
})

</script>

@endsection