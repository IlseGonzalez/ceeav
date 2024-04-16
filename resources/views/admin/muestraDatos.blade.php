<?php 
$html="";
if ($mostrar=='delitosIm') {
   foreach ($regs as $reg){
    $html .='<div>'.$reg->delito.'</div>';
   }
}

if ($mostrar=='observacionesIm') {
    foreach ($regs as $reg) {
        $html .='<div>'.$reg->tipo_daño.'|'.$reg->observacion.'</div>';
    }
}

if($mostrar=='delitosPj'){
    foreach ($regs as $reg) {
        $html .= '<div>'.$reg->delito.'</div>';
    }
}

if ($mostrar=='observacionesPj') {
    foreach ($regs as $reg) {
        $html .='<div>'.$reg->tipo_daño.'|'.$reg->observacion.'</div>';
    }
}

if($mostrar=='violacionesOdh'){
    foreach ($regs as $reg) {
        $html .= '<div>'.$reg->derecho_violado.'</div>';
    }
}

if ($mostrar=='observacionesOdh') {
    foreach ($regs as $reg) {
        $html .='<div>'.$reg->tipo_daño.'|'.$reg->observacion.'</div>';
    }
}

echo $html;
?>
