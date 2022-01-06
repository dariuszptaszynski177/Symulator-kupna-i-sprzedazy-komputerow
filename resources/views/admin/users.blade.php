@extends('./layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin panel</div>

                <div class="card-body">
                <ul>
                        <li><a href="{{route('admin-users')}}">Użytkownicy</a></li>
                        <li><a href="{{route('computers')}}">Komputery</a></li>
                        <li><a href="{{route('admin-simulations')}}">Symulacje</a></li>
                        <li><a href="{{route('conditions')}}">Warunki do sumulacji</a></li>
                    </ul>
                </div>

                <div>
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nazwa użytkownika</th>
                                <th>E-mail</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="users_list">
                            @include('admin.users_list')
                        <tbody>
                    </table>
                </div>

                <div class="col-12 d-flex justify-content-center">
                    <div class="confirm"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
function update_status(id, value)
{
   
    $(document).ready(function(){
    var url = "{{route('admin-change-status')}}";
    var token = "{{ csrf_token()}}";
    var usersList = document.querySelector('.users_list');
    $.ajax({
    type: "POST",
    url: url,
    data: {id:id, value:value,_token:token},
    dataType: 'json',
    success: function(data)
    {
    // console.log(data);
    usersList.innerHTML = data.users;
    let confirm = document.querySelector('.confirm');
    confirm.innerHTML = "Zmieniono status";

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

<style>
table, td, th {
  border: 1px solid black;
}

table {
  width: 100%;
  border-collapse: collapse;
}

/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection