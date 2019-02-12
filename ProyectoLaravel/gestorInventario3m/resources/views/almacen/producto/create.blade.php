@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		 <!-- defiene los tamaños para los distintos dispositivos-->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3 type="text" name="title">Nuevo Producto</h3>
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
			{!!Form::open(array('url'=>'almacen/producto','method'=>'POST','autocomplete'=>'off', 'files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		 <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre del producto...">
            </div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
    			<label>Categoria</label>
    			<select name="idcategoria" class="form-control">
    				@foreach ($categorias as $cat)
    				<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
    				@endforeach
    			</select>
    		</div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="marca">Marca</label>
            	<input type="text" name="marca" required value="{{old('marca')}}" class="form-control" placeholder="Marca del producto...">
            </div>
    	</div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="precio">Precio</label>
            	<input type="text" name="precio" required value="{{old('precio')}}" class="form-control" placeholder="Precio del producto...">
            </div>
    	</div>


    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="imagen">Imagen</label>
            	<input type="file" name="imagen" class="form-control" >
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="descripcion">Descripcion</label>
            	<input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripcion del producto...">
            </div>
        </div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
            	<button class="btn btn-primary" name="guardar" type="submit">Guardar</button>
            	<button class="btn btn-danger" name="cancelar" type="reset">Cancelar</button>
            </div>
		</div>
    </div>

           
            

			{!!Form::close()!!}		
@endsection