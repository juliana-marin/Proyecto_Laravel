@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		 <!-- defiene los tamaños para los distintos dispositivos-->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Inventario</h3>
			@if (count($errors)>0)
			<div class="alert alert-warning">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			<!--creacion de formulario-->
			{!!Form::open(array('url'=>'inventarioProducto/inventario','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
    			<label>Producto</label>
    			<select name="idproducto" class="form-control">
    				@foreach ($productos as $pro)
    				<option value="{{$pro->idproducto}}">{{$pro->nombre}}</option>
    				@endforeach
    			</select>
    		</div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="cant_producto_ingreso">Productos ingresados</label>
            	<input type="text" name="cant_producto_ingreso" required value="{{old('cant_producto_ingreso')}}" class="form-control" placeholder="Cantidad...">
            </div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="cant_producto_vendido">Productos vendidos</label>
            	<input type="text" name="cant_producto_vendido" required value="{{old('cant_producto_vendido')}}" class="form-control" placeholder="Cantidad...">
            </div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="cant_producto_restante">Productos restantes</label>
            	<input type="text" name="cant_producto_restante" required value="{{old('cant_producto_restante')}}" class="form-control" placeholder="Cantidad...">
            </div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="precio">Precio</label>
            	<input type="text" name="precio" required value="{{old('precio')}}" class="form-control" placeholder="Precio...">
            </div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
		</div>
    </div>
     
			{!!Form::close()!!}		
@endsection