<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">{title}</h3>
  </div>
  <div class="panel-body">
      <form action='/index.php/{module}/save' method='POST'>
          <?php 
          foreach($form as $field){
              echo '<div class="form-group">
                <label for="exampleInputFile">'.(($field->formInput == 'hidden')?'':$field->displayName).'</label>
                <input type="'.$field->formInput.'" class="form-control" name="'.$field->fieldName.'" value="'.((!empty($info))?$info[$field->fieldName]:'').'">
              </div>';
          }
          ?>
            <button type="submit" class="btn btn-default">Guardar</button>
      </form>
  </div>
</div>
    