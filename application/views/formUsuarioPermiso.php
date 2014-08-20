<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">{title}</h3>
  </div>
  <div class="panel-body">
      <form action='/index.php/{module}/save' method='POST'>
          <?php
          echo '<div class="from-group"> 
                  <label for="NombreUsuario">Seleccione el Nombre de Usuario</label>
                  <select name="idUsuario">';
          foreach ($usuarios as $u){
              echo '<option value='.$u->id."> ".$u->username."</option>" ;
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
          /*foreach($form as $field){
              echo '<div class="form-group">
                <label for="exampleInputFile">'.(($field->formInput == 'hidden')?'':$field->displayName).'</label>
                <input type="'.$field->formInput.'" class="form-control" name="'.$field->fieldName.'" value="'.((!empty($info))?$info[$field->fieldName]:'').'">
              </div>';
          }*/
          ?>
            <button type="submit" class="btn btn-default">Guardar</button>
      </form>
  </div>
</div>
    