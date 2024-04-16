<?php 
$html='<option value="" selected disabled> Selecciona una opcion [. . .]</option>';

if($mostrar=='localidad'){
    foreach ($regs as $reg) {
        $html .= '<option data-id_localidad="'.$reg->id.'" value="'.$reg->id.'">'.$reg->localidad.'</option>';
    }
}

if($mostrar=='delito'){
    foreach ($regs as $reg) {
        $html .= '<option data-id_delito="'.$reg->id.'" value="'.$reg->id.'">'.$reg->delito.'</option>';
    }
}



echo $html;
?>