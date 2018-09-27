{!! Form::open(array('url'=>'almacen/producto','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<!--La busqueda se puede realizar por categoria o idproducto-->
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar producto..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}