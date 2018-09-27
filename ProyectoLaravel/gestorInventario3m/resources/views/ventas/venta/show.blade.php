@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<h3>  &nbsp; Detalle de venta: {{ $venta->idVenta}}</h3>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="cliente">Cliente</label>
				<p>{{$venta->nombre}}</p>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="inventario">Inventario</label>
				<p>{{$venta->idinventario}}</p>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<p>{{$venta->fecha}}</p>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="valor_total">Valor total</label>
				<p>{{$venta->valor_total}}</p>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="estado_venta">Estado</label>
				<p>{{$venta->estado_venta}}</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="pane panel-primary">
			<div class="panel-body">

	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			       <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
				      	<thead style="background-color: #A4A4A4">
					 		<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>IVA</th>
                        	<th>Dcto</th>
							<th>Descripcion</th>
                        	<th>Subtotal</th>
    				 	</thead>
                    	<tfoot>
                        	<th></th>
                        	<th></th>
                        	<th></th>
                        	<th></th>
                           	<th></th>
                        	<th></th>
                        	<th><h4 id="total">{{$venta->valor_total}}</h4><input type="hidden" name="valor_total" id="valor_total"></th>
                        </tfoot>
    				<tbody>
    					@foreach($detalles as $det)
    					<tr>
    						<td>{{$det->producto}}</td>
    						<td>{{$det->cantidad}}</td>
    						<td>{{$det->precio}}</td>
    						<td>{{$det->impuesto}}</td>
    						<td>{{$det->descuento}}</td>
    						<td>{{$det->descripcion}}</td>
    					</tr>
    					@endforeach

    				</tbody>
    				
    			    </table>
    	        </div>
            </div>
        </div>  
    </div>	
@endsection