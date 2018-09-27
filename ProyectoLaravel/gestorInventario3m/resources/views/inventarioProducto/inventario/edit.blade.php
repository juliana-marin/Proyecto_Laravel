@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Inventario: {{ $inventario->idinventario}}</h3>
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
            {!!Form::model($inventario,['method'=>'PATCH','route'=>['inventarioProducto.inventario.update',$inventario->idinventario,'files'=>'true']])!!}
            {{Form::token()}}
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Producto</label>
                <select name="idproducto" class="form-control">
                    @foreach ($productos as $p)
                        @if ($p->idproducto ==$inventario->idproducto)    
                    <option value="{{$p->idproducto}}" selected>{{$p->nombre}}</option>
                    @else
                        <option value="{{$p->idproducto}}" >{{$p->nombre}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="cant_producto_ingreso">Producto Ingresado</label>
                <input type="text" name="cant_producto_ingreso" required value="{{$inventario->cant_producto_ingreso}}" class="form-control">
            </div>
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="cant_producto_vendido">Producto Vendido</label>
                <input type="text" name="cant_producto_vendido" required value="{{$inventario->cant_producto_vendido}}" class="form-control">
            </div>
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="cant_producto_ingreso">Producto Restante</label>
                <input type="text" name="cant_producto_restante" required value="{{$inventario->cant_producto_restante}}" class="form-control">
            </div>
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="nombre">Precio</label>
                <input type="text" name="precio" required value="{{$inventario->precio}}" class="form-control">
            </div>
        </div>  
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

        </div>
    </div>

         {!!Form::close()!!}     
@endsection