@extends ('layouts.admin')
@section ('contenido')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Menu de Productos<a href="menu/edit">

		</div>
	</div>

	<div id="products" class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			@foreach ($productos as $producto)
				<div class="producto white-panel" class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<img src="{{asset('imagenes/productos/'.$producto->imagen)}}" height="100px" width="100px" class="img-thumbnail">
					<h4><b>{{ $producto->nombre }}</b></h4><hr>
					<div class="producto-info panel">
						<p>{{ $producto->marca }}</p>
					 	<p> Precio: <big style="color:blue">  $ {{ $producto->precio }}</big></span></p>
					 	<p>Cantidad: <input type="number" name="cantidad" value="0" min="1" max="20"></input>
		           					</p>
					 	<button class="btn">
		         					<i class="fa fa-cart-plus"></i> Agregar al pedido
		         		</button>
					</div>		
		 	   </div>
			@endforeach
	</div>	
</div>



@endsection