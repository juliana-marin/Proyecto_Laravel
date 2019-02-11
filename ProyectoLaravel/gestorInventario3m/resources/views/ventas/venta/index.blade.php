@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Ventas<a href="venta/create"><button class="btn btn-success">Nuevo</button></a><a href="{{url('reporteventas')}}"target="black"><button class="btn btn-info">Informe</button></a></h3>
		@include('ventas.venta.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Cliente</th>
					<th>Inventario</th>
					<th>Fecha</th>
					<th>Valor total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ventas as $ven)
				<tr>
					<td>{{ $ven->idVenta}}</td>
					<td>{{ $ven->nombre}}</td>
					<td>{{ $ven->idinventario}}</td>
					<td>{{ $ven->fecha}}</td>
					<td>{{ $ven->valor_total}}</td>
					<td>{{ $ven->estado_venta}}</td>

					
					<td>
						<a href="{{URL::action('VentaController@show',$ven->idVenta)}}"><button class="btn btn-primary">Detalles</button></a>
						<a target="_blank" href="{{URL::action('VentaController@reportec',$ven->idVenta)}}"><button class="btn btn-info">Reporte</button></a>
                          <a href="" data-target="#modal-delete-{{$ven->idVenta}}" data-toggle="modal"><button class="btn btn-danger">Cancelar</button></a>
					</td>
				</tr>
				@include('ventas.venta.modal')
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}
	</div>
</div>

@endsection