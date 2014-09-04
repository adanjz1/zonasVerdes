<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">{title}</h3>
  </div>
  <div class="panel-body">
       <?php
          $z=0;
          if ($id==''){
          echo '<form action=\'../save\' method=\'POST\'> 
                  <div class="from-group"> 
                  <label for="NombreUsuario">Seleccione el Nombre de Usuario</label>
                  <select name="idUsuario">';
          
          foreach ($usuarios as $u){
                           // $us=0;
                           // foreach ($usuariocp as $f){
                           //       if ($u->id==$f->idUsuario){
                           //           $us=1;
                           //       }
                           //    }
                           // if ($us==0){
                                echo '<option value='.$u->id."> ".$u->username."</option>" ;
                           // }
                        } 
           echo ' </select>'
          . '</div>';
           
          echo '<div class="from-group"> 
                  <label for="NombreUsuario">Seleccione el Permiso</label>
                  <select name="idPermiso">';
          foreach ($permisos as $p){
              echo '<option value='.$p->id."> ".$p->nombre."</option>" ;
          }
           echo ' </select>     
               </div>';
          } else {
                    foreach ($permisos as $p){
                        foreach ($info as $f){
                              if ($p->id==$f->idPermiso){
                                  $z=$z+1;
                              }
                         }
                    }
                    if ($z==7){
                       echo '<div class="from-group"> 
                        <label for="NombreUsuario">El usuario tiene todos los premisos</label></div>';  
                    }else{
                        echo '<form action=\'../save\' method=\'POST\'>
                            <div class="from-group"> 
                            <label for="NombreUsuario">Nombre de Usuario:</label> 
                            <select name="idUsuario">';
                        foreach ($usuarios as $u){
                            if ($u->id==$info[0]->IdUsuario){ 
                            echo '<option value='.$u->id."> ".$u->username."</option>" ;}
                        }

                        echo ' </select>'
                        . "</div>";
                             echo '<div class="from-group"> 
                            <label for="NombreUsuario">Seleccione el Permiso</label>
                            <select name="idPermiso">';
                        foreach ($permisos as $p){
                            $c=0;
                            foreach ($info as $f){
                                  if ($p->id==$f->idPermiso){
                                      $c=1;
                                  }
                               }
                            if ($c==0){
                            echo '<option value='.$p->id."> ".$p->nombre."</option>" ;}
                        }
                        echo ' </select>'
                        . '</div>';
                        }
                }  
                
          if ($z==7) { ?>
          <a href="../lista"><button>Regresar</button></a>
          <?php }else{ ?>
        <button type="submit" class="btn btn-default">Guardar</button>
        </form>
        <?php }?>
     </div>
</div>
    