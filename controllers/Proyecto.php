<?php 
class Proyecto extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("proyecto_model");
	//	$this->load->library("encrypt");
    }
    
    public function gridProyecto(){
		
        $data['grid'] =  $this->proyecto_model->gridSolicitudProyecto();		 
        $data['sts_proyecto'] =  'RE';
		$data['titulotabla'] = 'Lista Planes de Proyectos';		
        $this->load->view("gridProyecto_view",$data);		
    }

    public function gridProyectoRechazado(){
		
        $data['grid'] =  $this->proyecto_model->gridProyectoRechazado();		 
        $data['sts_proyecto'] =  'RC';//Rechazado
		$data['titulotabla'] = 'Lista de Planes de Proyectos Rechazados';		
        $this->load->view("gridProyecto_view",$data);		
    }

    public function gridProyectoAsesoramiento(){
		$data['sts_proyecto'] =  'AS';
		
        $data['grid'] =  $this->proyecto_model->gridProyectoAsesoramiento();		 
		$data['titulotabla'] = 'Lista de Proyectos aprobados para asesoramiento';		
        $this->load->view("gridProyecto_view",$data);		
    }

    public function gridProyectoCulminado(){
		$data['sts_proyecto'] =  'CA';
        $data['grid'] =  $this->proyecto_model->gridProyectoCulminado();		 
		$data['titulotabla'] = 'Lista de Proyectos Culminados y Aprobados';		
        $this->load->view("gridProyecto_view",$data);		
    }

	
	public function mantCambiarEstado(){		 
		 $post['sts_proyecto'] = $this->input->post('sts_proyecto');
		 $x_post['id_proyecto'] = $this->input->post('id_proyecto');

		 if($post['sts_proyecto']=='RC'){
		 	$post['motivo_rechazo'] = $this->input->post('motivo_rechazo');
			$post['idusu_rechazo'] = $this->session->userdata('idusuario');
			$post['fch_regrc'] = date('Y-m-d H:i:s');
		 }

		 $mensaje = '';		 
		$this->proyecto_model->updateProducto($x_post['id_proyecto'],$post);
		 
		 echo "<script language='javascript'>  $.smallBox({
								title : '<i class=\'botClose fa fa-times\'></i> Aviso !',
								content :'Cambio de estado satisfactorio',
								color : '#739E73',
								timeout : 2000,
								icon : 'fa fa-check swing animated'
							}); </script>";
		if($post['sts_proyecto']=='AS'){
			$this->gridProyectoAsesoramiento();
		}else if($post['sts_proyecto']=='RC'){
			$this->gridProyectoRechazado();
		}else{
			$this->gridProyectoCulminado();
		}
	}

	public function mantAsignarAsesor(){		 
		 $post['id_asesor'] = $this->input->post('id_asesor');		
		 $x_post['id_proyecto'] = $this->input->post('id_proyecto');
		 $mensaje = '';		 
		$this->proyecto_model->updateProducto($x_post['id_proyecto'],$post);
		 
		 echo "<script language='javascript'>  $.smallBox({
								title : '<i class=\'botClose fa fa-times\'></i> Aviso !',
								content :'Asesor asignado',
								color : '#739E73',
								timeout : 2000,
								icon : 'fa fa-check swing animated'
							}); </script>";
		 
		$this->gridProyectoAsesoramiento();
	}



 	public function mantProyectoCulminadoForm($id = ''){	
		$data['proyecto'] = $this->proyecto_model->rowProyecto($id);
		$data['titulofrm'] = "Culminación de proyecto (Publicar en la web)";
        $this->load->view("form_MantProyectoCulminado_view",$data);
		
    }


	public function mantProyectoCulminado(){		 
		$post['descripcion'] = $this->input->post('descripcion');
		$post['rubro_investigacion'] = $this->input->post('rubro_investigacion');
		
		$x_post['id_proyecto'] = $this->input->post('id_proyecto');
		 
		$post['proyecto_doc'] = $this->input->post('f_proyecto_doc');
		$post['imagen'] = $this->input->post('f_imagen');
		$uploadFileDir = '../archivo/proyecto/';
		if (isset($_FILES['proyecto_doc']) && $_FILES['proyecto_doc']['error'] === UPLOAD_ERR_OK) {
			$fileTmpPath = $_FILES['proyecto_doc']['tmp_name'];
			$fileName = $_FILES['proyecto_doc']['name'];
			
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			$newFileName = 'Proyecto_'.rand(0,1000).date('YmdHis').'.'.$fileExtension;
			$allowedfileExtensions = array('pdf');

			if (in_array($fileExtension, $allowedfileExtensions)) {			
				$dest_path = $uploadFileDir . $newFileName;
				if(move_uploaded_file($fileTmpPath, $dest_path))
				{
					//subido correctamente 
					$post['proyecto_doc'] = $newFileName;
				}
				else
				{
					//error
				}
			}else{
				echo 'Error en formato';
			}
		}
		if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
			$fileTmpPath = $_FILES['imagen']['tmp_name'];
			$fileName = $_FILES['imagen']['name'];
			
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			$newFileName = 'Proyecto_'.rand(0,1000).date('YmdHis').'.'.$fileExtension;
			
			$dest_path = $uploadFileDir . $newFileName;
			if(move_uploaded_file($fileTmpPath, $dest_path))
			{
				//subido correctamente 
				$post['imagen'] = $newFileName;
			}
			else
			{
				//error
			}
		 
		}
		 
		$this->proyecto_model->updateProducto($x_post['id_proyecto'],$post);

		 echo "<script language='javascript'>  $.smallBox({
								title : '<i class=\'botClose fa fa-times\'></i> Aviso !',
								content :'Proyecto actualizado',
								color : '#739E73',
								timeout : 2000,
								icon : 'fa fa-check swing animated'
							}); </script>";
			$this->gridProyectoCulminado();
}
 
 
 function cargar_archivo() {
		
		$idregistro = $this->input->post('id_archivo');
		$nombrearchivo = $idregistro.'_'.date('d-m-Y').'_'.rand(5, 15);
		//$tempFile = $_FILES['file']['tmp_name']; 
		
        $mi_imagen = 'mi_imagen';//$_FILES['file'];
        $config['upload_path'] = "../imagenes/archivo/";
        $config['file_name'] = $nombrearchivo;
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

		$this->load->library('upload', $config);
		/*foreach ($_FILES as $key => $value) {
		 $this->upload->do_upload($key);
		}*/
        if (!$this->upload->do_upload($mi_imagen)) {
           // *** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

        $data['upload_data'] = $this->upload->data();
		$file_name = $data['upload_data']['file_name'];
		
		if($data['upload_data']){
			$post['Imagen'] = $file_name;
			$x_post['IdArchivo'] = $idregistro;
			$this->archivo_model->updateArchivo($x_post['IdArchivo'],$post);
		}
		//echo $data['uploadSuccess'];
		//$this->load->view("upload_success",$data);
		echo '<img width="100%" src="'.$this->config->item('web_url').'imagenes/archivo/'.$file_name.'" alt="">';
	}

	public function mantInvestigacionForm($id_proyecto = ''){	
		$data['proyecto'] = $this->proyecto_model->rowProyecto($id_proyecto);
		$data['asesor'] = $this->proyecto_model->gridAsesor();
		$data['investigador'] = $this->proyecto_model->gridInvestigador();
		$data['titulofrm'] = "Proyecto de Investigación";
        $this->load->view("form_MantInvestigacion_view",$data);
		
    }

	public function mantInvestigacion(){		 
		 $post['id_investigador'] = $this->input->post('id_investigador');
		 $post['url_archivo'] = '';//$this->input->post('url_archivo');
		 $post['titulo'] = $this->input->post('titulo');
		 $post['descripcion'] = $this->input->post('descripcion');
		 $post['id_proyecto'] = $this->input->post('id_proyecto');
		
		 $id_investigacion = $this->proyecto_model->insertInvestigacion($post);

		 $post_a['id_asesor'] = $this->input->post('id_asesor');
		 $post_a['id_investigacion'] = $id_investigacion;
		 $post_a['estado'] = '';
		 $post_a['avance'] = 0;
		 $this->proyecto_model->insertDetInvestigacion($post_a);

 
		 
		 echo "<script language='javascript'>  $.smallBox({
								title : '<i class=\'botClose fa fa-times\'></i> Aviso !',
								content :'Investigación registrada',
								color : '#739E73',
								timeout : 2000,
								icon : 'fa fa-check swing animated'
							}); </script>";
		$this->gridProyectoAsesoramiento();
	}	

}

?>
