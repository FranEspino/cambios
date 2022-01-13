<script> 
$(function(){        
	var options = {
		target:        '#div_capa_pagina', 
		beforeSubmit:  showRequest,  
		success:       showResponse  
	};
		$('#frm_mant').ajaxForm(options);  
		$('#ModalMante').modal('show');
		$('#comentario').focus();		
	});	
function showRequest(formData, jqForm){		
		$('#btnguardar').html('Grabando...');
		$("#btnguardar").attr("disabled","disabled"); 
	};
function showResponse(responseText, statusText){
	$('#ModalMante').modal('hide');
	if ($('.modal-backdrop').is(':visible')){
	  $('body').removeClass('modal-open'); 
	  $('.modal-backdrop').remove(); 
	};
};
</script>
      

<div class="modal container fade" id="ModalMante" role="dialog" data-backdrop="static" data-keyboard="false"> 
<form id="frm_mant" class="" name="frm_archivo" action="<?php  echo base_url() ?>archivo/mantArchivo" method="post"enctype="multipart/form-data">
<div class="modal-dialog ui-front">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="alert-heading" id="myModalLabel"><i class="fa fa-edit"></i> <?php  echo $titulofrm; ?></h4>
            </div>
            <div class="modal-body padding-7">
            <div class="smart-form">
				<?php 			
				$editar = '';
				if(isset($archivo))
				{	if($archivo){ 							 
					$editar = 'SI';
					}
				}
				?>				
                <div class="panel panel-default ">
                <fieldset >    
                
                <section>
                    <div class="row">
                        <label class="label col col-3">Comentario</label>
                        <div class="col col-9">
                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                <textarea autofocus required name="comentario" type="text" class="form-control"    required ><?php  echo ($editar == 'SI')? $archivo->comentario:'';  ?></textarea>
                            </label>
                        </div>
                    </div>
                </section>               
                           
                <section>
                    <div class="row">
                        <label class="label col col-3">¿A que área pertenece el archivo?</label>
                        <div class="col col-9">  
                    	<?php   
                    if(isset($personalArea)){
						if($personalArea){
							foreach ($personalArea as $fila_pa) {
								$opciones_pa[$fila_pa->id_area] =$fila_pa->area;
							}	
						}else{
							$opciones_pa[''] ='No perteneces a ninguna área';
						}
                        if($editar == 'SI'){ 
                            echo form_dropdown("id_area", $opciones_pa, $archivo->id_area, 'class="select2" ');
                        }else{
                            echo form_dropdown("id_area", $opciones_pa, '', 'class="select2" ');
                        } 
                         
                    } 
                    ?> 
                   </div>
                    </div>
                </section>               
                   <?php  if($editar != 'SI'){  ?>         
                 <section>
                    <div class="row">
                        <label class="label col col-3">Archivo</label>
                        <div class="col col-9">
                                <input type="file"  required="required" name="archivo">
                            
                        </div>
                    </div>
                </section>
                <?php  } ?>
               <section class=" smart-form">
                	<div class="row">
                        <label class="label col col-3">Estado:</label>
                        <div class="col col-9">
                        <?php  
                            $estado = ($editar == 'SI')? $archivo->estadoarchivo:'1'; 
                        ?>
                        <label class="checkbox">
                        <input type="checkbox" id="estadoarchivo" name="estadoarchivo" <?php if ($estado=='1'){echo 'checked';} ?>>
                        <i></i>Publicado
                        </label>  
                        </div>
                    </div>                       
                </section>
                 
                </fieldset>                

            </div>
            </div>
            </div>
            <div class="modal-footer">
                <button title="Cancelar" type="button" class="btn btn-default" data-dismiss="modal">
                   Cancelar
                </button>
                <button title="Guardar" type="submit" class="btn btn-primary" id="btnguardar" name="btnguardar" >
                   <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
                </button>
                <!--Campos ocultos-->
                <input type="hidden"  name="id_archivo" value="<?php  echo ($editar == 'SI')? $archivo->id_archivo :'';  ?>">  
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   </form> 
</div><!-- /.modal -->