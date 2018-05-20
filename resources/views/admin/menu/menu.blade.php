<div class="card" id="">
    <div class="card-header">
        <i class="material-icons iconos">menu</i>
        Menú de opciones
    </div>

    <!--<div class="card-header">
        <a href="{{route('index')}}">
            <i class="material-icons iconos">home</i>
            Portada
        </a>
    </div>-->
    <div class="card-header">
        <a href="{{route('admin')}}">
            <i class="material-icons iconos">business_center</i>
            Panel Administración
        </a>
    </div>
    <div class="card-header">
        <a href="{{route('estacionamiento.index')}}">
            <i class="material-icons iconos">directions_car</i>
            Estacionamiento
        </a>
    </div>
    <div class="card-header">
        <a href="#">
            <i class="material-icons iconos">show_chart</i>
            Reportes
        </a>
    </div>
    <div class="card-header" id="accordion">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                <i class="material-icons iconos">add</i>
                Administración
            </a>
    </div>
    <div id="collapseOne" class="panel-collapse collapse {!! Request::is('admin/plazas') || Request::is('admin/tipos') ? 'show' : '' !!}">
        <table class="table">
            <tr>
                <td>
                    <a href="{{route('plazas.index')}}">Administrar plazas</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{ route('tipos.index' )}}">Tipos de plazas</a>
                </td>
            </tr>
        </table>
    </div>


</div>