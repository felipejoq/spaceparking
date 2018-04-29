@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4">
                <div class="card">
                    @include('admin.menu.menu')
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Administración - Añadir nueva plaza</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                @if(!empty($nodemcu))
                                    <div class="form-group">
                                        <label for="nodemcu_id">Id para el nuevo nodemcu</label>
                                        <input class="form-control" name="nodemcu_id" type="text" width="10" readonly value="{{$nodemcu->id}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nodemcu_id">Clave para el nuevo nodemcu</label>
                                        <input class="form-control" name="nodemcu_clave" type="text" width="10" readonly value="{{ $nodemcu->nodemcu_clave }}">
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('nodemcu.store') }}">
                                    {{ csrf_field() }}
                                    <button class="" type="submit">Generar un nodemcu</button>
                                </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection