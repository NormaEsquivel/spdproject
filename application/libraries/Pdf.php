<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){
            $this->Image('resources/images/marca_agua.jpg',0,0,250);
            $this->Image('resources/images/logoSegey.png',20,20,40); 
            $this->Ln(20);
       }
       // El pie del pdf
       public function Footer(){
          $this->SetFont('Times','BI',10);
          $this->Cell(0,10,utf8_decode('2017, Año del Centenario de la Promulgación de la Constitución Política de los Estados Unidos Mexicanos.'),0,0,'C');
          $this->Ln(10);
          $this->SetFillColor(0,0,0); 
          $this->SetTextColor(255,255,255); 
          $this->SetFont('Times','b',10);
          $this->Cell(0,10,'www.educacion.yucatan.com.mx',0,0,'R',1);
      }
    }