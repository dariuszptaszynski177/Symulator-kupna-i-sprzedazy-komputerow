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

                    <ul>
                        <li><a href="{{route('admin-users')}}">Użytkownicy</a></li>
                        <li><a href="{{route('computers')}}">Komputery</a></li>
                        <li><a href="{{route('admin-simulations')}}">Symulacje</a></li>
                        <li><a href="{{route('conditions')}}">Warunki do sumulacji</a></li>
                    </ul>

                    <div>
                        <div>
                            Oferty spełniające kryteria
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Użytkownik</th>
                                        <th>Komputer</th>
                                        <th>Ilość</th>
                                        <th>Cena</th>
                                        <th colspan="2">Akcje</th>

                                    </tr>
                                </thead>
                                <tbody class="offers_list">
                                    @include('admin.simulations.offers_list')
                                </tbody>
                            </table>

                        </div>

                        <div class="py-4">
                            <p class="text-danger">Oferty, które nie spełaniają kryteriów</p>
                            <table>
                                <tr>
                                <th>Id</th>
                                    <th>Użytkownik</th>
                                    <th>Komputer</th>
                                    <th>Ilość</th>
                                    <th>Cena</th>
                                    <!-- <th colspan="2">Akcje</th> -->
                                </tr>
                                @foreach($other_offers as $other_offer)
                                    <tr>
                                        <td>
                                            {{$other_offer->id}}
                                        </td>
                                        <td>
                                            {{$other_offer->user_id}}
                                        </td>
                                        <td>
                                            {{$other_offer->computer_id}}
                                        </td>
                                        <td>
                                            {{$other_offer->quantity}}
                                        </td>
                                        <td>
                                            {{$other_offer->price}}
                                        </td>
                                        <!-- <td>
                                            <button class="btn btn-success">Kup</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger">Odrzuć</button>
                                        </td> -->
                                    </tr>
                                @endforeach
                            </table>
                            <p class="confirm"></p>

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
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    let confirm = document.querySelector('.confirm');

    function accept_offer(offer_id, user_id, computer_id, quantity, price)
    {
        $(document).ready(function(){
        var url = "{{route('simulation-accept-offer')}}";
        var token = "{{ csrf_token()}}";
        var offersList = document.querySelector('.offers_list');
        $.ajax({
        type: "POST",
        url: url,
        data: {offer_id:offer_id, user_id:user_id, computer_id:computer_id, quantity:quantity, price:price ,_token:token},
        dataType: 'json',
        success: function(data)
        {
        // console.log(data);
        offersList.innerHTML = data.offers;
        let confirm = document.querySelector('.confirm');
        confirm.innerHTML = "Zakupiono komputer";

        setTimeout(function(){
        confirm.innerHTML = " "
        }, 2000);
        
        },
        error:function(){
        alert("error");
        }
        })

    });
    };


    function decline_offer(offer_id, user_id, computer_id, quantity, price)
    {
        $(document).ready(function(){
        var url = "{{route('simulation-decline-offer')}}";
        var token = "{{ csrf_token()}}";
        var offersList = document.querySelector('.offers_list');
        $.ajax({
        type: "POST",
        url: url,
        data: {offer_id:offer_id, user_id:user_id, computer_id:computer_id, quantity:quantity, price:price ,_token:token},
        dataType: 'json',
        success: function(data)
        {
        // console.log(data);
        offersList.innerHTML = data.offers;
        let confirm = document.querySelector('.confirm');
        confirm.innerHTML = "Odrzucono ofertę kupna";

        setTimeout(function(){
        confirm.innerHTML = " "
        }, 2000);
        
        },
        error:function(){
        alert("error");
        }
        })

    });
    }
</script>

@endsection