@extends ('layouts.admin')
@section ('contenido')
	<div class="row ">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Crear nuevo correo</h3>
			@if (count($errors)>0)
			<div class="alert alert-warning">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
	{!!Form::open(array('url'=>'correo/correo','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
             <div class="box box-secondary">
                    <div class="box-body">
                    
                      <div class="form-group">
                        <input class="form-control" placeholder="Para:" id="destinatario" name="destinatario">
                      </div>
                      <div class="form-group">
                        <input class="form-control" placeholder="Asunto:" id="asunto" name="asunto">
                      </div>
                      <div class="form-group">
                        <textarea id="contenido_mail" name="contenido_mail" class="form-control" style="height: 200px" placeholder="Escriba aquí...">
                         
                        </textarea>
                      </div>
                      <div class="form-group">
                        <div class="btn btn-default btn-file">
                          <i class="fa fa-paperclip"></i> Adjuntar Archivo
                          <input type="file"  id="file" name="file" class="email_archivo" >
                        </div>
                        <p class="help-block"  >Max. 20MB</p>
                        <div id="texto_notificacion">
                        
                        </div>
                      </div>

                

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <div class="pull-right">
                     
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                      </div>
                   <br/>
                    </div><!-- /.box-footer -->
                  </div><!-- /. box -->

              {!!Form::close()!!}	
            </div><!-- /.col -->
          </div><!-- /.row -->
    

    <script>
     
      function activareditor(){   
        $("#contenido_mail").wysihtml5();
      };

      activareditor();
    </script>	
            
		

@endsection
	