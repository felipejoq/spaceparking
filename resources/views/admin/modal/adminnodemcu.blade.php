<!-- Modal -->
<div class="modal fade" id="adminnodemcu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lista de Nodemcu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @if(session()->has('flash4'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('flash4') }}
                    </div>
                @endif

                    @if(session()->has('flash5'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('flash5') }}
                        </div>
                    @endif

                <form class="text-left" method="POST" action="{{route('nodemcu.store')}}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-sm btn-primary btn-block">
                        <i class="material-icons tiny" style="vertical-align: middle;">add</i>
                        Agregar un Nodemcu
                    </button>
                </form>

                    <p></p>

                <table class="table table-hover">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Clave</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($nodemculista as $node)
                        <tr>
                            <th scope="row" class="text-center">{{ $node->id }}</th>
                            <td class="text-center">{{ $node->nodemcu_clave }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <form action="{{ route('nodemcu.destroy',$node) }}" method="POST">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button id="" type="submit" class="btn btn-sm btn-secondary">
                                            <i class="material-icons tiny">delete</i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@push('scripts')



@endpush