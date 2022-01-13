<script> 
$(function(){        
	var optionsx = {
		target:        '#div_capa_pagina', 
		beforeSubmit:  showRequestx,  
		success:       showResponsex  
	};
		$('#frm_mant').ajaxForm(optionsx);  
		$('#ModalMante').modal('show');
		$('#comentario').focus();		
	});	
function showRequestx(formData, jqForm){		
		$('#btnguardar').html('Grabando...');
		$("#btnguardar").attr("disabled","disabled"); 
	};
function showResponsex(responseText, statusText){
	$('#ModalMante').modal('hide');
	if ($('.modal-backdrop').is(':visible')){
	  $('body').removeClass('modal-open'); 
	  $('.modal-backdrop').remove(); 
	};
};
</script>
      

<div class="modal container fade" id="ModalMante" role="dialog" data-backdrop="static" data-keyboard="false"> 
<form id="frm_mant" class="" name="frm_proyecto" action="<?php  echo base_url() ?>proyecto/mantProyectoCulminado" method="post"enctype="multipart/form-data">
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
				if(isset($proyecto))
				{	if($proyecto){ 							 
					$editar = 'SI';
					}
				}
				?>				
                <div class="panel panel-default ">
                <fieldset >    
                
                <section>
                    <div class="row">
                        <label class=" col col-3">Investigador:</label>
                        <div class="col col-9">
                            <?php  echo ($editar == 'SI')? $proyecto->razonsocial:'';  ?>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class=" col col-3">Plan de proyecto:</label>
                        <div class="col col-9">
                            <?php  echo ($editar == 'SI')? $proyecto->plan_proyecto:'';  ?>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class=" col col-3">Asesor:</label>
                        <div class="col col-9">
                            <?php  echo ($editar == 'SI')? $proyecto->asesor:'';  ?>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="row">
                        <label class="label col col-3">Proyecto final:</label>
                        <div class="col col-9">
                                <input type="file"  class="form-control" name="proyecto_doc" accept=".pdf">
                            <?php 
                                if($proyecto->proyecto_doc!=''){
                                ?><a href="<?php echo $this->config->item('web_url') ?>archivo/proyecto/<?php echo $proyecto->proyecto_doc; ?>" class="f_proyecto_doc text-info" target="_blank" title="Ver"><?php  echo $proyecto->proyecto_doc; ?></a>
                                <input type="hidden" name="f_proyecto_doc" id="f_proyecto_doc" value="<?php echo $proyecto->proyecto_doc; ?>">
                                <i onclick="elimfile('f_proyecto_doc');" class="f_proyecto_doc fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
                            <?php }?>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class="label col col-3">Rubro de investigación:</label>
                        <div class="col col-9">
                                <input type="text"  required="required" class="form-control" name="rubro_investigacion" value="<?php echo  $proyecto->rubro_investigacion; ?>">
                            
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class="label col col-3">Imagen:</label>
                        <div class="col col-9">
                                <input type="file"   class="form-control" name="imagen" accept="image/*">
                            <?php 
                                if($proyecto->imagen!=''){
                                ?><a href="<?php echo $this->config->item('web_url') ?>archivo/proyecto/<?php echo $proyecto->imagen; ?>" class="f_imagen text-info" target="_blank" title="Ver"><?php  echo $proyecto->imagen; ?></a>
                                <input type="hidden" name="f_imagen" id="f_imagen" value="<?php echo $proyecto->imagen; ?>">
                                <i onclick="elimfile('f_imagen');" class="f_imagen fa fa-lg fa-times-circle  txt-color-red" style="cursor: pointer;"></i>
                            <?php }?>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class="label col col-3">Descripción:</label>
                        <div class="col col-9">
                            
                                <textarea autofocus required name="descripcion" type="text" class="form-control"    required ><?php  echo ($editar == 'SI')? $proyecto->descripcion:'';  ?></textarea>
                            
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
                <input type="hidden"  name="id_proyecto" value="<?php  echo ($editar == 'SI')? $proyecto->id_proyecto :'';  ?>">  
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   </form> 
</div><!-- /.modal -->
