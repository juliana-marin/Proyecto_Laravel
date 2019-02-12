@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		 <!-- defiene los tamaños para los distintos dispositivos-->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cliente</h3>
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
			{!!Form::open(array('url'=>'ventas/cliente','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    		 <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
            </div>
    	</div>


    	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
    		 <div class="form-group">
            	<label for="fecha_nacimiento">Fecha nacimiento</label>
            	<input type="text" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" class="form-control" placeholder="yyyy-mm-dd">
            </div>
    	</div>


    	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
    		<div class="form-group">
    			<label for="telefono">Teléfono</label>
    			<input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Telefono...">
    		</div>
    	</div>

    	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
    		<div class="form-group">
            	<label for="email">Email</label>
            	<input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email...">
            </div>
    	</div>

    	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
    		<div class="form-group">
            	<label for="cedula">Cedula</label>
            	<input type="text" name="cedula" value="{{old('cedula')}}" class="form-control" placeholder="Numero de cedula...">
            </div>
    	</div>


		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
            	<input class="btn btn-primary" name="guardar" type="submit" value="guardar"/>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
		</div>
    </div>
			{!!Form::close()!!}		
@endsection