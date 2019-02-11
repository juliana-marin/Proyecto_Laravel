@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<h3>&nbsp; Editar estado de la Venta: {{ $venta->idVenta}}</h3>
		@if (count($errors)>0)
			<div class="alert alert-warning">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<div class="form-group">
				<label for="comprobante">Inventario</label>
				<p>{{$venta->idinventario}}</p>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<div class="form-group">
				<label for="comprobante">Fecha</label>
				<p>{{$venta->fecha}}</p>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<div class="form-group">
				<label for="fecha">Valor Total</label>
				<p>{{$venta->valor_total}}</p>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<div class="form-group">
				<label for="fecha">Estado</label>
				<p>{{$venta->estado_venta}}</p>
			</div>
		</div>
	</div>
	
			{!!Form::model($venta,['method'=>'PATCH','route'=>['ventas.venta.update',$venta->idVenta]])!!}
            {{Form::token()}}
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="form-group">
            	<label>Cambiar estado de la venta</label>
            	<select name="estado_venta" class="form-control selectpicker" data-live-search="true">
            		<option value="activo">Activo</option>
            		<option value="anulado">Anulado</option>
            		<option value="cancelado">Cancelado</option>
            		<option value="finalizado">Finalizado</option>
            	</select>
            </div>
            <div class="form-group">
            	<label></label>
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>    
        

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection