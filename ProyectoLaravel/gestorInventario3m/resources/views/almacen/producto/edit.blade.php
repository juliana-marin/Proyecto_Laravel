@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto: {{ $producto->nombre}}</h3>
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

			{!!Form::model($producto,['method'=>'PATCH','route'=>['almacen.producto.update',$producto->idproducto],'files'=>'true'])!!}
            {{Form::token()}}
           <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		 <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{$producto->nombre}}" class="form-control">
            </div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
    			<label>Categoria</label>
    			<select name="idcategoria" class="form-control">
    				@foreach ($categorias as $cat)
    					@if ($cat->idcategoria ==$producto->idcategoria)	
    				<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
    				@else
    					<option value="{{$cat->idcategoria}}" >{{$cat->nombre}}</option>
    				@endif
    				@endforeach
    			</select>
    		</div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Marca</label>
            	<input type="text" name="marca" required value="{{$producto->marca}}" class="form-control">
            </div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Precio</label>
            	<input type="text" name="precio" required value="{{$producto->precio}}" class="form-control">
            </div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"></div>
    		<div class="form-group">
            	<label for="imagen">Imagen</label>
            	<input type="file" name="imagen" class="form-control" >
            	@if (($producto->imagen)!="")
            		<img src="{{asset('imagenes/productos/'.$producto->imagen)}}" height="300px" width="300px">
            	@endif
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"></div>
    		<div class="form-group">
            	<label for="nombre">Descripcion</label>
            	<input type="text" name="descripcion" value="{{$producto->descripcion}}" class="form-control" placeholder="Descripcion del producto...">
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