
@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		 <!-- defiene los tamaños para los distintos dispositivos-->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Venta</h3>
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
			{!!Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12  col-xs-12">
            <div class="form-group">
            	<label for="cliente">Cliente</label>
            	<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
            		@foreach ($clientes as $cliente)
            		<option value="{{$cliente->nombre}}"> {{$cliente->nombre}}</option>
            		@endforeach
               	</select>
            </div>	
        </div>
         <div class="col-lg-3 col-sm-3 col-md-3  col-xs-3">
            <div class="form-group">
                <label for="inventario">Inventario</label>
                <select name="idinventario" id="idinventario" class="form-control selectpicker" data-live-search="true">
                    @foreach ($inventarios as $inventario)
                    <option value="{{$inventario->idinventario}}"> {{$inventario->idinventario}}</option>

                    @endforeach
                </select>
            </div>  
        </div>
        <div class="col-lg-3 col-sm-3 col-md-3  col-xs-3">
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="text" name="fecha" required value="{{old('fecha')}}"
                class="form-control" placeholder="yyyy-mm-dd">
            </div>
        </div>
         <div class="col-lg-3 col-sm-3 col-md-3  col-xs-3">
            <div class="form-group">
                <label for="valor_total">Valor total</label>
                <input type="text" name="valor_total" required value="{{old('valor_total')}}" class="form-control" placeholder="Total">
            </div>
        </div>

          <div class="col-lg-3 col-sm-3 col-md-3  col-xs-3">
            <div class="form-group">
                <label for="estado_venta">Estado de la venta</label>
                <input type="text" name="estado_venta" value="Aceptado" readonly="readonly" class="form-control" placeholder="Aceptado">
                </select>
            </div>
        </div>
    </div>
    
    <div class="row">   
        <div class="panel panel-danger">
            <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                       <label>Producto</label>
                        <select name="pidproducto" class="form-control selectpicker" id="pidproducto" data-live-search="true">
                           @foreach ($productos as $producto)
                           <option value="{{$producto->idproducto}}">{{$producto->producto}}</option>
                           @endforeach
                        </select>
                    </div>
                </div>
            
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="cantidad">
                </div>
            </div>
            
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                       <label>Precio</label>
                        <input type="number" name="pprecio" id="pprecio" class="form-control" placeholder="Precio"></input>
                    </div>
                </div>

             <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="pimpuesto">Impuesto</label>
                    <input type="number" name="pimpuesto" id="pimpuesto" class="form-control" placeholder="Impuesto">
                </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="descuento">Descuento</label>
                    <input type="number" name="pdescuento" id="pdescuento" class="form-control" placeholder="Descuento">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="pdescripcion">Descripcion</label>
                    <input type="text" name="pdescripcion" id="pdescripcion" class="form-control" placeholder="Descripcion">
                </div>
            </div>   		
    		
    		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <label></label>
    			<div class="form-group">
    				<button class="btn btn-primary" id="bt_add" type="button">Agregar</button>
    			</div>
    		</div>

    		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
    				<thead style="background-color: #A4A4A4">
    					<th>Opciones</th>
					 	<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio</th>
                        <th>Dcto</th>
						<th>IVA</th>
                        <th>Subtotal</th>
    				</thead>
                    <tfoot>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><h4 id="total">$ 0.00</h4><input type="hidden" name="valor_total" id="valor_total"></th>
                    </tfoot>
    				<tbody>

    				</tbody>
    				
    			</table>
    	    </div>
        </div>
    </div>  
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
        <div class="form-group">
        	<input name"_token" value="{{ csrf_token() }}" type="hidden"></input>
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
        /*informacion del detalle de venta*/
		idproducto=$("#pidproducto").val();
        producto=$("#pidproducto option:selected").text();
        cantidad=$("#pcantidad").val();
        precio=$("#pprecio").val();
        impuesto=$("#pimpuesto").val();
        descuento=$("#pdescuento").val();
        descripcion=$("#pdescripcion").val();

        /*se valida que los campos anteriores no esten vacios*/
        if(idproducto!="" && cantidad!="" && cantidad>0 && precio!="" && impuesto!="" && descuento!="")
        {

            subtotal[cont]=(cantidad*precio-descuento);
            total=total+subtotal[cont]; 

 var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idproducto[]" value="'+idproducto+'">'+idproducto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio[]" value="'+precio+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td><input type="number" name="impuesto[]" value="'+impuesto+'"></td><td>'+subtotal[cont]+'</td></tr>';
            cont++;
            limpiar();
            $('#total').html("$ "+ total);
            $('#valor_total').val(total); 
            evaluar();
            $('#detalles').append(fila);
        }
        else
        {
            alert ("Error al ingresar el detalle de la venta, revise los datos del producto");
        }
    }
    function limpiar(){
        $("#pcantidad").val("");
        $("#pprecio").val("");
        $("#pimpuesto").val(""); 
        $("#pdescuento").val("");
        $("#pdescripcion").val("");
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
        $("total").html("$ " + total);
        $("valor_total").val(total);
        $("#fila" + index).remove();
        evaluar();
    }
	
</script>
@endpush
@endsection