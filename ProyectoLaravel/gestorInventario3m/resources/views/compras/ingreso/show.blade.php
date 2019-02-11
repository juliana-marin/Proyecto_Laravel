@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<h3> &nbsp; Detalle de ingreso: {{ $ingreso->idingreso}}</h3>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="Inventario">Inventario</label>
				<p>{{$ingreso->idinventario}}</p>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="comprobante">N° comprobante</label>
				<p>{{$ingreso->num_comprobante}}</p>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="comprobante">Comprobante</label>
				<p>{{$ingreso->comprobante}}</p>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<p>{{$ingreso->fecha}}</p>
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
							<th>Precio compra</th>
							<th>Precio venta</th>
    				 	</thead>
                    	<tfoot>
                        	<th></th>
                        	<th></th>
                        	<th></th>
                        	<th></th>            
                        </tfoot>
    				<tbody>
    					@foreach($detalles as $det)
    					<tr>
    						<td>{{$det->producto}}</td>
    						<td>{{$det->cantidad}}</td>
    						<td>{{$det->precio_compra}}</td>
    						<td>{{$det->precion_venta}}</td>
    					</tr>
    					@endforeach

    				</tbody>
    				
    			    </table>
    	        </div>
            </div>
        </div>  
    </div>	
@endsection