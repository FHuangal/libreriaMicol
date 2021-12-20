@extends('layout.plantilla')

@section('styles')
    <link href="/ampleadmin/plugins/bower_components/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')

    <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Venta</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="/inicio">Dashboard</a></li>
                            <li class="active">Venta</li>
                        </ol>
                    </div>
    </div>

@endsection

@section('contenido')

				<div class="col-sm-offset-3 col-sm-9 text-right">
                    <a href="{{route('ventas.create')}}" class="btn btn-success waves-effect waves-light m-t-10" ><i class="ti-plus"></i> Nuevo</a>
                </div>
                    
				<div class="row">
                    <div class="col-sm-12">     
                        <div class="white-box">                                          
                            <div class="table-responsive">              
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                        	<th>Id</th>
                                            <th>Cliente</th>
                                            <th>Nombre Usuario</th>
                                            <th>Fecha de venta</th>
                                            <th>Descuento</th>
                                            <th>Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ventas as $venta)
                                        <tr>
                                            <td>{{$venta->id}}</td>
                                            <td>{{$venta->cliente->nombre}}</td>
                                            <td>{{$venta->user->name}}</td>
                                            <td>{{$venta->venta_date}}</td>
                                            <td>{{$venta->tax}}</td>
                                            <td>{{$venta->total}}</td>
                                            <td>
                                                <form method="POST" action="">
                                                    @csrf
                                                    <a href="" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> 
                                                    <a href="" class="text-inverse p-r-10" data-toggle="tooltip" title="Imprimir"><i class="ti-printer"></i></a> 

                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

@section('scripts')

    <script src="/ampleadmin/plugins/bower_components/datatables/datatables.min.js"></script>
    <script src="/ampleadmin/plugins/bower_components/peity/jquery.peity.min.js"></script>
    <script src="/ampleadmin/plugins/bower_components/peity/jquery.peity.init.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
    $(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
        });
    });
    </script>
@endsection
               
@endsection