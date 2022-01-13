<?php 

class Proyecto_model extends CI_Model {

    private $dbadmin = "";
	

    public function __construct() {
        parent::__construct();
		
        $this->dbadmin = $this->load->database("default", true);
    }

	public function gridSolicitudProyecto( ) {
		$sql1 = "SELECT r.*,p.*,'' as investigador FROM tb_proyecto p INNER JOIN `tb_razonsocial` r ON 
p.`id_investigador` = r.`id_razonsocial` where sts_proyecto ='RE' ORDER BY p.id_proyecto DESC";            
		$query = $this->dbadmin->query($sql1); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data[] = $fila;
            }
        } else {
            $data = "";
        }
        return $data;
        $query->free_result();
    }

    public function gridProyectoRechazado( ) {
        $sql1 = "SELECT r.*,p.*,'' as investigador FROM tb_proyecto p INNER JOIN `tb_razonsocial` r ON 
p.`id_investigador` = r.`id_razonsocial` where sts_proyecto ='RC' ORDER BY p.id_proyecto DESC";            
        $query = $this->dbadmin->query($sql1); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data[] = $fila;
            }
        } else {
            $data = "";
        }
        return $data;
        $query->free_result();
    }

    public function gridProyectoAsesoramiento( ) {
        $sql1 = "SELECT p.*, r.razonsocial, r.numdocumento,r.direccion, r.celular, r.email,r.carrera_profesional, CONCAT( pa.`nombre`,' ', pa.`apellido`) AS asesor, pa.dni AS doc_asesor,CONCAT( pai.`nombre`,' ', pai.`apellido`) AS investigador, pai.dni AS dni_investigador, di.`id_asesor`, i.titulo, di.avance, i.url_archivo

FROM tb_proyecto p INNER JOIN `tb_razonsocial` r ON 
p.`id_investigador` = r.`id_razonsocial`
LEFT JOIN `investigacion` i ON i.`id_proyecto` = p.`id_proyecto`
LEFT JOIN `detalle_investigacion` di ON di.`id_investigacion` = i.`id_investigacion`
LEFT JOIN `asesor` a ON di.`id_asesor` = a.`id_asesor`
LEFT JOIN `persona` pa ON pa.`id_persona` = a.`id_asesor`

LEFT JOIN `investigador` ii ON i.`id_investigador` = ii.`id_investigador`
LEFT JOIN `persona` pai ON pai.`id_persona` = ii.`id_persona`

 WHERE sts_proyecto ='AS' ORDER BY p.id_proyecto DESC
";            
        $query = $this->dbadmin->query($sql1); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data[] = $fila;
            }
        } else {
            $data = "";
        }
        return $data;
        $query->free_result();
    }

    public function gridProyectoCulminado( ) {
         $sql1 = "SELECT p.*, r.razonsocial, r.numdocumento,r.direccion, r.celular, r.email,r.carrera_profesional, CONCAT( pa.`nombre`,' ', pa.`apellido`) AS asesor, pa.dni AS doc_asesor,CONCAT( pai.`nombre`,' ', pai.`apellido`) AS investigador, pai.dni AS dni_investigador, di.`id_asesor`, i.titulo, di.avance, i.url_archivo

FROM tb_proyecto p INNER JOIN `tb_razonsocial` r ON 
p.`id_investigador` = r.`id_razonsocial`
LEFT JOIN `investigacion` i ON i.`id_proyecto` = p.`id_proyecto`
LEFT JOIN `detalle_investigacion` di ON di.`id_investigacion` = i.`id_investigacion`
LEFT JOIN `asesor` a ON di.`id_asesor` = a.`id_asesor`
LEFT JOIN `persona` pa ON pa.`id_persona` = a.`id_asesor`

LEFT JOIN `investigador` ii ON i.`id_investigador` = ii.`id_investigador`
LEFT JOIN `persona` pai ON pai.`id_persona` = ii.`id_persona`

 WHERE sts_proyecto ='CA' ORDER BY p.id_proyecto DESC";       
        $query = $this->dbadmin->query($sql1); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data[] = $fila;
            }
        } else {
            $data = "";
        }
        return $data;
        $query->free_result();
    }

    public function gridAsesor( ) {
        $sql1 = "SELECT p.*,a.*  FROM `usuario` u 
INNER JOIN `persona` p ON u.id_persona =  p.id_persona
INNER JOIN `asesor` a ON p.`id_persona` = a.`id_persona`
WHERE u.`id_tipocuenta`='2000'";            
        $query = $this->dbadmin->query($sql1); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data[] = $fila;
            }
        } else {
            $data = "";
        }
        return $data;
        $query->free_result();
    }

    public function gridInvestigador( ) {
        $sql1 = "SELECT p.*,i.*  FROM `usuario` u 
INNER JOIN `persona` p ON u.id_persona =  p.id_persona
INNER JOIN `investigador` i ON p.`id_persona` = i.`id_persona`
WHERE u.`id_tipocuenta`='3000'";            
        $query = $this->dbadmin->query($sql1); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data[] = $fila;
            }
        } else {
            $data = "";
        }
        return $data;
        $query->free_result();
    }

     
	public function rowProyecto($id) {
       // $this->dbadmin->where("id_proyecto", $IdArchivo);
       // $query = $this->dbadmin->get("tb_proyecto");

        $sql1 = "SELECT p.*, r.razonsocial, r.numdocumento,r.direccion, r.celular, r.email,r.carrera_profesional, a.razonsocial as asesor, a.numdocumento as doc_asesor
         FROM tb_proyecto p INNER JOIN `tb_razonsocial` r ON 
p.`id_investigador` = r.`id_razonsocial`
LEFT JOIN tb_razonsocial as a on a.id_razonsocial = p.id_asesor

 where id_proyecto ='".$id."'"; 
        $query = $this->dbadmin->query($sql1); 
        if ($query->num_rows() > 0) {
            $data = $query->row();
        } else {
            $data = "";
        }
        return $data;
        $query->free_result();
    }

    public function insertInvestigacion($post) {
        $this->dbadmin->insert("investigacion", $post);
        $id = $this->dbadmin->insert_id();    
        return $id;    
    }

    public function insertDetInvestigacion($post) {
        $this->dbadmin->insert("detalle_investigacion", $post);
        $id = $this->dbadmin->insert_id();    
        return $id;    
    }


	 

    public function updateProducto($id, $post) {
        $this->dbadmin->where("id_proyecto", $id);
        $this->dbadmin->update("tb_proyecto", $post);
    }

    public function insertProducto($post) {
        $this->dbadmin->insert("tb_proyecto", $post);
		$id = $this->dbadmin->insert_id();    
		return $id;    
    }
 

}

?>
