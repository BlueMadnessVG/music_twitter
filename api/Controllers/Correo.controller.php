<?php

class CorreoController{


public function sendcorreoban($datos){
  try{
    if(isset($datos['correo'])&&isset($datos['motivo'])){

      $correomodel=new CorreoModel();
      $back=$correomodel->EnviarCorreoban($datos['correo'],$datos['motivo']);
      $json=array('message'=>'Operacion Exitosa','status'=>200,'data'=>$back);
      echo json_encode($json);
      return;

    }else{
      echo("faltan datos we");
    }
  }catch(Exception $e){
    echo ($e);
  }
}

public function sendcorreodesban($datos){
  try{
    if(isset($datos['correo'])){

      $correomodel=new CorreoModel();
      $back=$correomodel->EnviarCorreodesban($datos['correo']);
      $json=array('message'=>'Operacion Exitosa','status'=>200,'data'=>$back);
      echo json_encode($json);
      return;

    }else{
      echo("faltan datos we");
    }
  }catch(Exception $e){
    echo ($e);
  }
}






}


?>