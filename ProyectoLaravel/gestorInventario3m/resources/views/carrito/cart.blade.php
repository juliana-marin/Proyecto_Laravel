@extends ('layouts.admin')
@section ('contenido')

<div class="container text-center" >
		<div class="page-header">
		       <h3><i class="fa fa-shopping-cart"></i>Carrito de compras </h3>
        </div>
		

	<div class="table-cart">
		@if (count($cart))
		<p>
		  <a href="{{ route('cart-trash') }}" class="btn btn-danger">Vaciar carrito <i class="fa fa-trash"></i></a>
		</p>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
				    <thead>
						<th>Imagen</th>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Cantidad</th>
						<th>Subtotal</th>
						<th>Quitar</th>
				    </thead>
				    <tbody>
							<tr> 
								<td><img src="{{asset('imagenes/productos/poker.jpg')}}"></td>
								<td>Poker</td>
								<td>4000</td>
								<td>1</td>
								<td>4000</td>
								<td>
									<a href="" class="btn btn-danger">
										<i class="fa fa-remove"></i>
									</a>
								</td>
							</tr>
							<tr> 
								<td><img src="{{asset('imagenes/productos/corona.jpg')}}"></td>
								<td>Corona</td>
								<td>8000</td>
								<td>1</td>
								<td>8000</td>
								<td>
									<a href="" class="btn btn-danger">
										<i class="fa fa-remove"></i>
									</a>
								</td>
							</tr>
							<tr> 
								<td><img src="{{asset('imagenes/productos/reds.jpg')}}"></td>
								<td>Reds</td>
								<td>4500</td>
								<td>1</td>
								<td>4500</td>
								<td>
									<a href="" class="btn btn-danger">
										<i class="fa fa-remove"></i>
									</a>
								</td>
							</tr>
					</tbody>
			   </table>
		   </div>
		</div>
	   @else
			<h3><span class="label label-warning">No hay productos en el carrito !!</span></h3>
	   @endif
	   <hr>
		  <p>
			<a href="{{url('menuProductos/menu')}}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i>    Seguir comprando</a>
			<a href="inicio/show" class="btn btn-primary">Continuar    <i class="fa fa-chevron-circle-right"></i></a>
		</p>
	</div>
</div>

@endsection