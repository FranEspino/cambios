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
<form id="frm_mant" class="" name="frm_proyecto" action="<?php  echo base_url() ?>proyecto/mantInvestigacion" method="post"enctype="multipart/form-data">
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
                            <label class="label col col-3">Nombres</label>
                            <div class="col col-9" id=""><?php echo $proyecto->razonsocial; ?>
                            </div>
                        </div>
                    </section>    
                    <section>
                        <div class="row">
                            <label class="label col col-3">Plan de Proyecto</label>
                            <div class="col col-9" id=""><?php echo $proyecto->plan_proyecto; ?>
                            </div>
                        </div>
                    </section>
<hr>
<br>
                    <section>
                        <div class="row">
                            <label class="label col col-3">Título de investigación</label>
                            <div class="col col-9" id=""><input type="text" name="titulo" value="" class="form-control">
                            </div>
                        </div>
                    </section>    
                    <section>
                        <div class="row">
                            <label class="label col col-3">Descripción</label>
                            <div class="col col-9" id=""><textarea name="descripcion" type="text" class="form-control"  ></textarea>
                            </div>
                        </div>
                    </section>     
                               
                    <section>
                        <div class="row">
                            <label class="label col col-3">Usuario Investigador</label>
                            <div class="col col-9">
                                <?php 
                                    $opciones_i[''] ='-- Seleccione investigador --'; 
                                    if(isset($investigador)){
                                        if($investigador){
                                            foreach ($investigador as $fila_i) {
                                                 $opciones_i[$fila_i->id_investigador] = $fila_i->dni.' - '.$fila_i->nombre.' '.$fila_i->apellido;
                                            }
                                        }                        
                                        echo form_dropdown("id_investigador", $opciones_i, '', 'class="form-control select2" required');  
                                    }
                                ?>                  
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <label class="label col col-3">Usuario Asesor</label>
                            <div class="col col-9">
                                <?php 
                                    $opciones_a[''] ='-- Seleccione Asesor --'; 
                                    if(isset($asesor)){
                                        if($asesor){
                                            foreach ($asesor as $fila_a) {
                                                $opciones_a[$fila_a->id_asesor] = $fila_a->dni.' - '.$fila_a->nombre.' '.$fila_a->apellido;
                                            }
                                        }                        
                                        echo form_dropdown("id_asesor", $opciones_a, '', 'class="form-control  select2" required');  
                                    }
                                ?>                  
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