@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		 <!-- defiene los tamaños para los distintos dispositivos-->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Ingreso</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
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
			{!!Form::open(array('url'=>'compras/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    <div class="row">
        <div class="col-lg-2 col-sm-2 col-md-2  col-xs-2">
            <div class="form-group">
            	<label for="inventario">Inventario</label>
            	<select name="idinventario" id="idinventario" class="form-control selectpicker" data-live-search="true">
            		@foreach ($inventarios as $inventario)
            		<option value="{{$inventario->idinventario}}">{{$inventario->idinventario}}</option>
            		@endforeach
               	</select>
            </div>	
        </div>
        <div class="col-lg-2 col-sm-2 col-md-2  col-xs-2">
            <div class="form-group">
            	<label>Tipo Comprobante</label>
            	<select name="tipo_comprobante" class="form-control selectpicker" data-live-search="true">
            		<option value="factura">Factura</option>
            		<option value="boleta">Boleta de venta</option>
            		<option value="ticket">Ticket de registradora</option>
            	</select>
            </div>
        </div>	
         <div class="col-lg-2 col-sm-2 col-md-2  col-xs-2">
            <div class="form-group">
            	<label for="num_comprobante">N° comprobate</label>
            	<input type="number" name="num_comprobante" required value="{{old('num_comprobante')}}"
            	class="form-control" placeholder="N. comprobate">
            </div>
        </div>
         <div class="col-lg-2 col-sm-2 col-md-2  col-xs-2">
            <div class="form-group">
            	<label for="fecha">Fecha de ingreso</label>
            	<input type="text" name="fecha" required value="{{old('fecha')}}" class="form-control" placeholder="yyyy-mm-dd">
            </div>
        </div>
         <div class="col-lg-2 col-sm-2 col-md-2  col-xs-2">
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" name="estado" value="Aceptado"  readonly="readonly" class="form-control" placeholder="Aceptado">
            </div>
        </div>
    </div>
    <div class="row">   
    	<div class="panel panel-default">
    		<div class="panel-body">
    			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
    				<div class="form-group">
    				   <label>Producto</label>
    				    <select name="pidproducto" id="pidproducto" class="form-control selectpicker" data-live-search="true">
    					   @foreach ($productos as $producto)
    					   <option value="{{$producto->idproducto}}">{{$producto->producto}}</option>
    					   @endforeach
    				    </select>
    				</div>
    			</div>
    		
    		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
    			<div class="form-group">
    				<label for="cantidad">Cantidad</label>
    				<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
    			</div>
    		</div>
    		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
    			<div class="form-group">
    				<label for="precio_compra">Precio compra</label>	
    				<input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="P. compra">
    			</div>
    		</div>
    		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
    			<div class="form-group">
    				<label for="precio_venta">Precio venta</label>
    				<input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="P. venta">
    			</div>
    		</div>
    		<div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">
                <label></label>
    			<div class="form-group">
    				<button  class="btn btn-primary" type="button" id="bt_add">Agregar</button>
    			</div>
    		</div>
    		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
    				<thead style="background-color: #A4A4A4">
    					<th>Opciones</th>
					 	<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio Compra</th>
						<th>Precio Venta</th>
						<th>Subtotal</th>
    				</thead>
                    <tfoot>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><h4 id="total">$ 0.00</h4></th>
                    </tfoot>
    				<tbody>

    				</tbody>	
    			</table>
    	    </div>
        </div>
    </div>  
</div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
        <div class="form-group">
        	<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
      
        </div> 
    </div>    
</div>    
			{!!Form::close()!!}		           
@push ('scripts')
<script>
	
	    $(document).ready(function(){
        $('#bt_add').click(function(){
            agregar();
        });
    });

	var cont=0;
    total=0;
    subtotal=[];
    $("#guardar").hide();

	
	function agregar(){
		idproducto=$("#pidproducto").val();
        producto=$("#pidproducto option:selected").text();
        cantidad=$("#pcantidad").val();
        precio_compra=$("#pprecio_compra").val();
        precio_venta=$("#pprecio_venta").val();

		if(idproducto!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_venta!="")
        {
            subtotal[cont]=(cantidad*precio_compra);
            total=total+subtotal[cont]; 

 var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idproducto[]" value="'+idproducto+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';
            cont++;
            limpiar();
            $('#total').html("$ "+ total);
            evaluar();
            $('#detalles').append(fila);
        }
        else
        {
            alert ("Error al ingresar el detalle del ingreso, revise los datos del articulo");
        }
    }

    function limpiar(){
        $("#pcantidad").val("");
        $("#pprecio_compra").val("");
        $("#pprecio_venta").val(""); 
    } 

    function evaluar(){
        if (total>0){
            $("#guardar").show()
        }
        else {
            $("#guardar").hide(); 
        }
    }
    function elimiar (index){
        total=total-subtotal[index];
        $("#total").html("$  " + total);
        $("#fila"+ index).remove("#fila"+ index);
        evaluar();
    }
	
</script>
@endpush
@endsection