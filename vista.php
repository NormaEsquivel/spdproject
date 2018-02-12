<?php 
include_once "conexion.php";

class vista{

    public static function ver(){
        $sql="SELECT '' AS g_examen,ce.nombreCicloEscolar as a_aplic, date(fe.Fecha) AS fecha_apl1, '' AS fecha_apl2, t.Turno AS turno1, '' AS turno2, n.Nivel AS nivel, '' AS folio_exam, '' AS foliofeder, '  ' AS ent_proc, cct.CCT AS cct, p.CURP AS curp, concat(p.primerNombre,' ',p.segundoNombre) AS nombre, p.primerApellido AS prim_apell, p.segundoApellido AS segu_apell, 'RESULTADO' as grupo_de_desempeño, IF(clv.ClaveSS IS NULL,'NA',clv.ClaveSS) AS cve_subsis, if(ss.Subsistema IS NULL,'NA',ss.Subsistema) as subsistema, ts.Descripcio, 'Yucatán' AS ent_sede, cdm.nombreMunicipio AS munic_sede, cd.Clave AS cap, cd.Nombre AS sede, concat(cd.Calle,' #',cd.NumeroExt,' ',if(cd.NumeroInt<>0,concat(' int.',cd.NumeroInt),''),' x ',cd.Cruzamiento1,' y ',cd.Cruzamiento2,', C.P. ',cd.CodigoPostal) AS dir_sede, g.Grupo AS grupo, '' AS id_exam, tf.nombreTipoFuncion AS figura, pl.descripcionPlaza AS plaza, conc.Descripcion AS consipart, '' AS nodo, '' AS aplicacion, '' AS mecanismo
        FROM tblcatfechas fe
        INNER JOIN tblgrupofecha g_f on g_f.FechaID = fe.FechaAplicacionID
        INNER JOIN tblgrupoaplicacion g_a on g_a.GrupoAplicacionID = g_f.GrupoAplicacionID
        INNER JOIN tblgrupo g on g.idGrupo = g_a.GrupoID
        INNER JOIN tblcatturnos t ON t.TurnoID = fe.TurnoID
        INNER JOIN catetapasevaluacion ee ON ee.EtapaID = fe.EtapaID
        INNER JOIN tblcicloescolar ce ON ce.idCicloEscolar = fe.CicloEscolarID
        INNER JOIN tbltipoevaluacion te ON te.idTipoEvaluacion = fe.TipoEvaluacionID
        INNER JOIN tblpersonatipoevaluacion p_te ON p_te.idTipoEvaluacion = fe.TipoEvaluacionID
        INNER JOIN tblpersona p ON p.idPersona = p_te.idPersona AND g_a.PersonaID = p.idPersona
        INNER JOIN tblcatconcideraciones conc ON conc.ConcideracionID = p.ConsideracionID
        INNER join tbltipoadscripcion ta ON ta.idTipoAdscripcion = p.idTipoAdscripcion
        INNER JOIN tblpersonacct p_cct ON p_cct.idPersona = p.idPersona AND p_cct.idCicloEscolar = ce.idCicloEscolar
        INNER JOIN tblcct cct ON cct.idCCT = p_cct.idCCT
        INNER JOIN tblcatniveles n ON n.NivelID = cct.NivelID
        LEFT OUTER JOIN tblclavess clv on clv.ClaveSSID = cct.ClaveSSID
        LEFT OUTER JOIN tblcatsubsistemas ss ON ss.SubsistemaID = clv.SubsistemaID
        INNER JOIN cattipossostenimiento ts ON ts.SostenimientoID = cct.SostenimientoID
        INNER JOIN tblpersonacede pc ON pc.idPersona = p.idPersona
        INNER JOIN tblcedes cd ON cd.CedeID = pc.idCEDE
        INNER JOIN tblmunicipio cdm ON cdm.idMunicipio = cd.MunicipioID
        INNER JOIN tbltipofuncion tf ON tf.idTipoFuncion = p.idTipoFuncion
        INNER JOIN tblplazapersona p_pl ON p_pl.idPersona = p.idPersona
        INNER JOIN tblplazas pl ON pl.idPlaza = p_pl.idPlaza

        WHERE ce.nombreCicloEscolar = 2017";
        $sql2 = "SELECT m.*,z.Zona FROM maestros m LEFT OUTER JOIN zonas z ON z.Clave = m.Clave GROUP BY m.Clave ORDER BY m.ID";
        return (new conexion())->ejecutarconsulta($sql2);
        //$datos = $resp->fetch_array(MYSQLI_ASSOC);
        //print_r($datos);
        
    }

    public static function getRFC($Maestro){
        $sql="SELECT * FROM nomina2 WHERE Maestro = '".$Maestro."'";
        $resp = (new conexion())->ejecutarconsulta($sql);
        $datos = $resp->fetch_array(MYSQLI_ASSOC);
        return $datos['Rfc'];
        // print_r($datos);
    }
    
    public static function addrow($Maestro,$RFC,$Hrs,$Clave,$Escuela){
        $sql="INSERT INTO asignacion (Maestro, RFC, HRS, Clave, Escuela) VALUES ('".$Maestro."','".$RFC."','".$Hrs."','".$Clave."','".$Escuela."')";
        return (new conexion())->ejecutarconsulta($sql);
    }


}

$vista = new vista();
$resp = $vista::ver();
foreach ($resp as $d) {
    //print_r($d);
    // echo (strlen($d['Nombre1'])>0?$d['Clave']." ".$d['Escuela']." ".$d['HRS1']." ".$d['Nombre1']."\n":"");
    // echo (strlen($d['Nombre2'])>0?$d['Clave']." ".$d['Escuela']." ".$d['HRS2']." ".$d['Nombre2']."\n":"");
    // echo (strlen($d['Nombre3'])>0?$d['Clave']." ".$d['Escuela']." ".$d['HRS3']." ".$d['Nombre3']."\n":"");
    // echo (strlen($d['Nombre4'])>0?$d['Clave']." ".$d['Escuela']." ".$d['HRS4']." ".$d['Nombre4']."\n":"");
    if (strlen($d['Nombre1'])>0) {
        $Rfc=$vista::getRFC($d['Nombre1']);
        //echo $d['Clave']." ".$d['Escuela']." ".c." ".$d['Nombre1']." ".$Rfc."\n";
        $vista::addrow($d['Nombre1'],$Rfc,$d['HRS1'],$d['Clave'],$d['Escuela']);
    }
    if (strlen($d['Nombre2'])>0) {
        $Rfc=$vista::getRFC($d['Nombre2']);
        //echo $d['Clave']." ".$d['Escuela']." ".$d['HRS2']." ".$d['Nombre2']." ".$Rfc."\n";
        $vista::addrow($d['Nombre2'],$Rfc,$d['HRS2'],$d['Clave'],$d['Escuela']);
    }
    if (strlen($d['Nombre3'])>0) {
        $Rfc=$vista::getRFC($d['Nombre3']);
        //echo $d['Clave']." ".$d['Escuela']." ".$d['HRS3']." ".$d['Nombre3']." ".$Rfc."\n";
        $vista::addrow($d['Nombre3'],$Rfc,$d['HRS3'],$d['Clave'],$d['Escuela']);
    }
    if (strlen($d['Nombre4'])>0) {
        $Rfc=$vista::getRFC($d['Nombre4']);
        //echo $d['Clave']." ".$d['Escuela']." ".$d['HRS4']." ".$d['Nombre4']." ".$Rfc."\n";
        $vista::addrow($d['Nombre4'],$Rfc,$d['HRS4'],$d['Clave'],$d['Escuela']);
    }
}
//$vista::addrow("juanito","xaxx010101000",4,"casca3232","rolandocalles");
// echo date("Y-m-d H:i:s");
// echo "\n";
// echo date("Y-m-d H:i:s",strtotime("03/12/17 23:59:30"));echo "\n";
// $date = explode("/","03/12/17");
// echo date("Y-m-d",strtotime($date[1]."/".$date[0]."/".$date[2]));
?>
