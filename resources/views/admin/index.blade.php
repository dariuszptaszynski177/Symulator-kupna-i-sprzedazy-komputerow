@extends('./layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin panel</div>

                <div class="card-body">
                @include('admin.admin_menu')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection