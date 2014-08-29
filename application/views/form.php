<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">{title}</h3>
  </div>
  <div class="panel-body">
      <form action='/index.php/{module}/save' method='POST'>
          <?php 
          foreach($form as $field){
              echo '<div class="form-group">
                <label for="exampleInputFile">'.(($field->formInput == 'hidden')?'':$field->displayName).'</label>';
                switch($field->formInput){
                    case 'textarea':
                        echo '<textarea class="form-control" name="'.$field->fieldName.'">'.((!empty($info))?$info[$field->fieldName]:'').'</textarea>';
                        break;
                    case 'select':
                        echo '<select name="'.$field->fieldName.'" class="form-control" >';
                        foreach($field->selectData as $sO){
                            echo '<option value="'.$sO->id.'" '.((!empty($info) && $info[$field->fieldName] == $sO->id)?'Selected':'').'>'.$sO->value.'</option>';
                        }
                        echo '</select>';
                        break;
                    default:
                        echo '<input type="'.$field->formInput.'" class="form-control" name="'.$field->fieldName.'" value="'.((!empty($info))?$info[$field->fieldName]:'').'">';
                        break;
                }
              echo'</div>';
          }
          ?>
            <button type="submit" class="btn btn-default">Guardar</button>
      </form>
  </div>
</div>
    