@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Inventarios <a href="inventario/create"><button class="btn btn-success">Nuevo</button></a><a href="{{url('reporteinventarios')}}"target="black"><button class="btn btn-info">Reporte</button></a></h3>
		@include('inventarioProducto.inventario.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Producto</th>
					<th>Productos ingresados</th>
					<th>Productos vendidos</th>
					<th>Productos restantes</th>
					<th>Precio</th>
					<th>Opciones</th>
				</thead>
               @foreach ($inventarios as $inv)
				<tr>
					<td>{{ $inv->idinventario}}</td>
					<td>{{ $inv->producto}}</td>
					<td>{{ $inv->cant_producto_ingreso}}</td>
					<td>{{ $inv->cant_producto_vendido}}</td>
					<td>{{ $inv->cant_producto_restante}}</td>
					<td>{{ $inv->precio}}</td>
					<td>
						<a href="{{URL::action('InventarioController@edit',$inv->idinventario)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$inv->idinventario}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('inventarioProducto.inventario.modal')
				@endforeach
			</table>
		</div>
		{{$inventarios->render()}}
	</div>
</div>

@endsection