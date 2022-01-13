<script> 
$(function(){        
    var options = {
        target:        '#div_capa_pagina', 
        beforeSubmit:  showRequest,  
        success:       showResponse  
    };
        $('#frm_mantEstado').ajaxForm(options); 
        $('#frm_mantAsesor').ajaxForm(options); 
    }); 
function showRequest(formData, jqForm){     
        $('.btnguardar').html('Grabando...');
        $(".btnguardar").attr("disabled","disabled"); 
    };
function showResponse(responseText, statusText){
    $('#ModalEstado').modal('hide');
    if ($('.modal-backdrop').is(':visible')){
      $('body').removeClass('modal-open'); 
      $('.modal-backdrop').remove(); 
    };
};
</script>
<div id="content">			
    <div class="row ">     
        <div class="col-md-8">
            <h1>
                <i class="fa fa-edit fa-fw "></i> Proyectos
            </h1>   
        </div>        
        <div class="col-md-4 ">   
         <div class="padding-7 hidden-print">      
           <!-- <a href='javascript:window.print(); void 0;' rel="tooltip" data-original-title="Imprimir" class="btn btn-default btn-md pull-right " ><i class="glyphicon glyphicon-print"></i> Imprimir</a> 
            <a href="#" rel="tooltip" disabled data-original-title="Descargar" class="btn btn-warning btn-md pull-right "><i class="glyphicon glyphicon-download-alt"></i> Descargar</a> 
            <a rel="tooltip" data-original-title="Crear contenido de página" class="btn btn-success btn-md pull-right" id="btnnuevo"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>-->
         </div>
        </div>	 
    </div>

    <!-- Cambiar estado -->
        <div class="modal container fade" id="ModalEstado" role="dialog" data-backdrop="static" data-keyboard="false"> 
<form id="frm_mantEstado" class="" name="frm_" action="<?php  echo base_url() ?>proyecto/mantCambiarEstado" method="post">
<div class="modal-dialog ui-front">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="alert-heading" id="myModalLabel"><i class="fa fa-edit"></i> Cambiar estado</h4>
            </div>
            <div class="modal-body padding-7">
            <div class="smart-form">             
                <div class="panel panel-default ">
                <fieldset >    
                
                <section>
                    <div class="row">
                        <label class="label col col-3">Nombres</label>
                        <div class="col col-9" id="txt_nombre">
                        </div>
                    </div>
                </section>    
                <section>
                    <div class="row">
                        <label class="label col col-3">Plan de Proyecto</label>
                        <div class="col col-9" id="txt_plan">
                        </div>
                    </div>
                </section>           
                           
                <section>
                    <div class="row">
                        <label class="label col col-3">Estado</label>
                        <div class="col col-9">
                            <select name="sts_proyecto" id="sts_proyecto" class="form-control">
                                <?php if($sts_proyecto=='RE'){ ?>
                                    <option value="AS">Aprobado para asesoramiento</option>
                                    <option value="RC">Rechazado</option>
                                <?php }else if($sts_proyecto=='CA'){ ?>
                                    <option value="AS">Aprobado para asesoramiento</option>
                                <?php }else if($sts_proyecto=='AS'){ ?>
                                    <option value="CA">Culminado y Aprobado</option>
                                <?php } ?>
                            </select>                      
                        </div>
                    </div>
                </section>  

                <section id="div_rechazado" style="display: none">
                    <div class="row">
                        <label class="label col col-3">Motivo rechazo</label>
                        <div class="col col-9" >
                            <textarea name="motivo_rechazo" class="form-control"></textarea>
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
                <button title="Guardar" type="submit" class="btn btn-primary btnguardar"  name="btnguardar" >
                   <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
                </button>
                <!--Campos ocultos-->
                <input type="hidden"  name="id_proyecto" value="" id="txt_id_proyecto">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   </form> 
</div><!-- /.modal -->
    <!-- .Cambiar estado -->

    <!-- Cambiar asesor -->
        <div class="modal container fade" id="ModalAsesor" role="dialog" data-backdrop="static" data-keyboard="false"> 
<form id="frm_mantAsesor" class="" name="frm_" action="<?php  echo base_url() ?>proyecto/mantAsignarAsesor" method="post">
<div class="modal-dialog ui-front">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="alert-heading" id="myModalLabel"><i class="fa fa-edit"></i> Asignar asesor</h4>
            </div>
            <div class="modal-body padding-7">
            <div class="smart-form">             
                <div class="panel panel-default ">
                <fieldset >    
                
                <section>
                    <div class="row">
                        <label class="label col col-3">Nombres</label>
                        <div class="col col-9" id="as_nombre">
                        </div>
                    </div>
                </section>    
                <section>
                    <div class="row">
                        <label class="label col col-3">Plan de Proyecto</label>
                        <div class="col col-9" id="as_plan">
                        </div>
                    </div>
                </section>           
                           
                <section>
                    <div class="row">
                        <label class="label col col-3">Asesor</label>
                        <div class="col col-9">
                            <?php 
                                $opciones_a[''] ='-- Seleccione Asesor --'; 
                                if(isset($asesor)){
                                    if($asesor){
                                        foreach ($asesor as $fila_a) {
                                            $opciones_a[$fila_a->id_razonsocial] = $fila_a->numdocumento.' - '.$fila_a->razonsocial;
                                        }
                                    }                        
                                    echo form_dropdown("id_asesor", $opciones_a, '', 'class="select2" required');  
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
                <button title="Guardar" type="submit" class="btn btn-primary btnguardar"  name="btnguardar" >
                   <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
                </button>
                <!--Campos ocultos-->
                <input type="hidden"  name="id_proyecto" value="" id="as_id_proyecto">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   </form> 
</div><!-- /.modal -->
    <!-- .Cambiar asesor -->
     

    <!-- widget grid -->
    <section id="widget-grid" class="">        
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" >	
                    <header>
                        <span class="padding-gutter titulo-jarvis">
                        	<i class="fa fa-table"></i> <?php  echo $titulotabla ; ?> 
                        </span>	
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget content -->
                        <div class="widget-body no-padding ">
                        <div class="table-responsive">
                            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            	<thead>			                
                                    <tr>
                                        <th style="width:1%">N.</th>
                                        <th >NOMBRES</th>
                                        
                                        <th >CEL/CORREO</th>
                                        <th >CARRERA PROFESIONAL</th>
                                        <?php if($sts_proyecto!='CA'){ ?>
                                            <th >PLAN DE PROYECTO</th>
                                        <?php } ?>
                                        
                                        <?php if($sts_proyecto!='RC'){ ?>

                                        <?php if($sts_proyecto!='RE'){ ?>
                                            <th >ASESOR</th>
                                        <?php } ?>
                                        <?php if($sts_proyecto!='RE'){ ?>
                                            <th >TITULO DE INV.</th>
                                        <?php } ?>
                                        <?php if($sts_proyecto=='CA'){ ?>
                                            <th >PROYECTO</th>
                                        <?php } ?>

                                        <?php } ?>
                                        <th style=" width:27px !important">PDF</th>
                                    <?php if($sts_proyecto!='RC'){ ?>
                                        <th style=" width:42px; min-width:42px !important" class="hidden-print"><i class="fa fa-fw fa-cog txt-color-blue"></i></th>
                                    <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
								<?php  if ($grid) {
										$i=1;
										foreach ($grid as $fila) { ?>
                                     <tr id="p_<?php echo $fila->id_proyecto; ?>">
                                        <td><?php  echo $i; ?></td>
                                        <td>
                                            <?php if($fila->investigador==''){ ?>
                                                <strong class="text-primary"><?php  echo $fila->razonsocial; ?></strong>
                                                <br><strong class=""><?php  echo $fila->numdocumento; ?></strong>
                                            <?php }else{ ?>
                                                <strong class="text-primary"><?php  echo $fila->investigador; ?></strong>
                                                <br><strong class=""><?php  echo $fila->dni_investigador; ?></strong>
                                            <?php } ?>



                                            <br />
                                            <small class="text-muted"><i><?php  echo $fila->direccion; ?><i></i></i></small>

                                        </td>
                                       
                                        <td><?php  echo $fila->celular; ?><br><?php  echo $fila->email; ?></td>
                                        <td><?php  echo $fila->carrera_profesional; ?></td>


                                        <?php if($sts_proyecto!='CA'){ ?>
                                            <td><?php  echo nl2br($fila->plan_proyecto); ?></td>
                                        <?php } ?>

                                        <?php if($sts_proyecto!='RC'){ ?>

                                        <?php if($sts_proyecto!='RE'){ ?>
                                            <td><strong class=""><?php  echo $fila->asesor; ?></strong>
                                                <br><span class=""><?php  echo $fila->doc_asesor; ?></span>
                                            </td>
                                        <?php } ?>
                                        <?php if($sts_proyecto!='RE'){ ?>
                                            <td><?php  echo $fila->titulo; ?>
                                            <br>
                                            <span class="badge bg-color-blue txt-color-white"><?php  echo $fila->avance; ?>% avance</span>

                                            <?php 
                                                $nombre_fichero = $this->config->item('web_url').'apis/documents/'. $fila->url_archivo; 
                                                if($fila->url_archivo!=''){
                                            ?>
                                                <a href="<?php  echo $nombre_fichero ;?>" class="font-md" target="_blank" title="Ver proyecto " style="colosr: green"><i class="fa fa-file"></i></a>
                                            <?php } ?>


                                            </td>
                                        <?php } ?>

                                        
                                        <?php if($sts_proyecto=='CA'){ ?>
                                            <td><span class=""><?php  echo $fila->rubro_investigacion; ?></span>
                                                <br><small class="text-muted"><em><?php  echo nl2br($fila->descripcion); ?></em></small>
                                            </td>
                                        <?php } ?>
                                        <?php } ?>

                                        <td>
                                            <?php 
                                                $nombre_fichero = $this->config->item('web_url').'archivo/plan_proyecto/'. $fila->plan_proyecto_doc; 
                                            ?><a href="<?php  echo $nombre_fichero ;?>" class="font-md" target="_blank" title="Ver plan de proyecto " style=""><i class="fa fa-file"></i></a>
                                            <?php 
                                                $nombre_fichero = $this->config->item('web_url').'archivo/proyecto/'. $fila->proyecto_doc; 
                                                if($fila->proyecto_doc!=''){
                                            ?>
                                                <a href="<?php  echo $nombre_fichero ;?>" class="font-md" target="_blank" title="Ver proyecto " style="color: green"><i class="fa fa-file"></i></a>
                                            <?php } ?>
                                            <?php 
                                                $nombre_fichero = $this->config->item('web_url').'archivo/proyecto/'. $fila->imagen; 
                                                if($fila->imagen!=''){
                                            ?>
                                                <a href="<?php  echo $nombre_fichero ;?>" class="font-md" target="_blank" title="Ver imagen " style="color: orange"><i class="fa fa-image"></i></a>
                                            <?php } ?>
                                        </td>
                                    <?php if($sts_proyecto!='RC'){ ?>
                                        <td class="pull-right opciones hidden-print">

                                            <?php if($fila->id_asesor>0 or $sts_proyecto=='RE'){ ?>
                                                <button class="btn btn-warning btn-circle estado" val="<?php echo $fila->id_proyecto; ?>" nombre="<?php echo $fila->razonsocial; ?>" data-toggle="modal" data-target="#ModalEstado"> 
                                                    <i class="glyphicon glyphicon-refresh"></i> 
                                                </button>
                                            <?php } ?>

                                            <?php if($fila->id_asesor=='' and $sts_proyecto=='AS'){ ?>
                                                <button class="btn btn-primary btn-circle asesor"  value="<?php echo $fila->id_proyecto; ?>" id_asesor="<?php echo $fila->id_asesor; ?>" nombre="<?php echo $fila->razonsocial; ?>" > 
                                                    <i class="glyphicon glyphicon-user"></i> 
                                                </button>
                                            <?php } ?>

                                            <?php if($sts_proyecto=='CA'){ ?>
                                                <button  value="<?php  echo $fila->id_proyecto ; ?>" class="proyecto btn btn-primary btn-circle"  data-placement="left" rel="tooltip" data-original-title="Proyecto"><i class="glyphicon glyphicon-check"></i></button>
                                            <?php } ?>

                                            <button  id="btn_editardato_<?php  echo $fila->id_proyecto ; ?>" name="editardato_<?php  echo $fila->id_proyecto ; ?>" value="<?php  echo $fila->id_proyecto ; ?>" class="editardato btn btn-primary btn-circle hidden"  data-placement="left" rel="tooltip" data-original-title="Editar"><i class="glyphicon glyphicon-edit"></i></button>
                                       
                                        </td>
                                    <?php } ?>
                                    </tr> 
                                   <?php
								   $i++; 
								   }
								 } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->		
            </article>
            <!-- WIDGET END -->
        </div>				
        <!-- end row -->   
        
    </section>
    <!-- end widget grid -->
    
<!-- Modal -->
<div id="div_ModalMant">
</div><!-- /.modal -->                    
    
</div> 

<!--================================================== -->	
 
<script>
pageSetUp();


$(".estado").click(function(event){
    id = $(this).attr("val");
    nombre = $(this).attr("nombre");
    //var nombre  = $("#p_"+id).find("td")[1].innerHTML.trim();
    var plan  = $("#p_"+id).find("td")[4].innerHTML.trim();  
    $("#txt_nombre").html(nombre);
    $("#txt_plan").html(plan);
    $("#txt_id_proyecto").val(id);

});

$(".asesor").click(function(event){


    event.preventDefault();     
    var idtablas = $(this).val();
    var url = "<?php  echo base_url() ?>proyecto/mantInvestigacionForm/"+idtablas;
    $( "#div_ModalMant" ).load(url);

    return;


    id = $(this).attr("val");
    nombre = $(this).attr("nombre");
    id_asesor = $(this).attr("id_asesor");
 //   console.log(id_asesor);
    //var nombre  = $("#p_"+id).find("td")[1].innerHTML.trim();
    var plan  = $("#p_"+id).find("td")[4].innerHTML.trim();  
    $("#as_nombre").html(nombre);
    $("#as_plan").html(plan); 
    $("#as_id_proyecto").val(id);

   /// $("#id_asesor").select2("val", id_asesor);

   // $("#id_asesor").val(id_asesor);
   // $("#id_asesor").select2().trigger('change');
   // $('#id_asesor').select2("val", id_asesor).trigger('change');

   // $("#id_asesor").select2().val(id_asesor).trigger("change");


});

$(".proyecto").click(function(event){
    event.preventDefault();     
    var idtablas = $(this).val();
    var url = "<?php  echo base_url() ?>proyecto/mantProyectoCulminadoForm/"+idtablas;
    $( "#div_ModalMant" ).load(url);
});  


$("#sts_proyecto").change(function(){
    var sts_proyecto = $(this).val();
    if(sts_proyecto=='RC'){
        $("#div_rechazado").show();
    }else{
        $("#div_rechazado").hide();
    }
})


  
function elim_reg(id){	
	var idtabla = id;
	if(idtabla.length<1){  
		//event.preventDefault(); 
		$.smallBox({
			title : '<i class="botClose fa fa-times"></i> Aviso !',
			content : "No hay registro para anular.<br>*Si el problema continua, comuníquese con el programador",
			color : "#C46A69",
			timeout : 3000,
			icon : "fa fa-exclamation-triangle swing animated"
		});
	}else{		
		$('#btn_si_eliminar').html('Eliminan...');
		$("#btn_si_eliminar").attr("disabled","disabled"); 
		$.ajax({ 
			type: "post",
			url: "<?php  echo base_url() ?>archivo/eliminarArchivo", cache: false, 
			data:'idtabla='+idtabla, 
			success: function(response){	
									
					var obj_mensaje = JSON.parse(response);	
									
					if(obj_mensaje.length>0){ 
						
						if(obj_mensaje.substr(0, 9) == 'Eliminado')
						{	
							var index = idtabla;							
							$("#" + index).remove();	
														
							//event.preventDefault();
							$.smallBox({
								title : '<i class="botClose fa fa-times"></i> Aviso !',
								content :'Se ha eliminado el registro de forma satisfactoria',
								color : "#739E73",
								timeout : 2500,
								icon : "fa fa-trash-o swing animated"
							});			
						}else{
							event.preventDefault(); 
							$.smallBox({
								title : '<i class="botClose fa fa-times"></i> Aviso !',
								content : obj_mensaje,
								color : "#C46A69",
								timeout : 2500,
								icon : "fa fa-exclamation-triangle swing animated"
							});
						}												
					}		
			 }
		}); 
	}		 
}

$(".editardato").click(function(event){
	event.preventDefault();     
	var idtablas = $(this).val();
	var url = "<?php  echo base_url() ?>archivo/mantArchivoForm/"+idtablas;
	$( "#div_ModalMant" ).load(url);
});  

$("#btnnuevo").click(function(event){ 
	event.preventDefault();        
	var urlnuevo = "<?php  echo base_url() ?>archivo/mantArchivoForm/";
	$( "#div_ModalMant" ).load(urlnuevo );
}); 

 

function subirimagen(idtabla, nomimagen){     
	var url = "<?php  echo base_url() ?>archivo/mantSubirImagen/"+idtabla+"/"+nomimagen;
	$( "#div_imagen_"+idtabla ).load(url);
};  	
</script>

<script type="text/javascript" language="javascript" class="init">
 $(document).ready(function() {
  $('#dt_basic').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
			        "oLanguage": {
					    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
					}
	});   
 });
</script>
 