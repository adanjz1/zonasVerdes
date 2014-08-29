<script>
$(function(){
    $('.glyphicon-plus').click(function(){
        document.location='/index.php/{module}/add';
    });
    $('.edit').click(function(){
        document.location='/index.php/{module}/add/'+$(this).parent().parent().attr('rel');
    });
    $('.delete').click(function(){
        document.location='/index.php/{module}/delete/'+$(this).parent().parent().attr('rel');
    });
});
</script>
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">{title}</h3>
  </div>
  <div class="panel-body">
      <button class="btn btn-primary glyphicon glyphicon-plus">
                    Add
        </button>
        <div class="tablaInOut table-responsive">
            <table class="table table-bordred table-striped">
                <thead>
                    <tr>
                    <?php
                    $json = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/application/config/modulos/'.$nombreJson.'.json');
                    $json = json_decode($json);
                    foreach($json->fields as $f){
                          if($f->showList){
                              ?> <th><?=$f->displayName;?></th>                               
                         <?php } 
                        }                   
                    ?>
                              <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($table as $t){?>
                        <tr rel='<?=$t->id?>'>
                            <?php foreach($rows as $r){?>
                                <td><?=$t->{$r}?></td>
                            <?php } ?>
                            <td class="text-center">
                                <button class="btn btn-info btn-xs edit">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </button> 
                                <button  class="btn btn-danger btn-xs delete">
                                    <span class="glyphicon glyphicon-remove"></span> Del
                                </button>
                            </td>
                        </tr>        
                    <?php } ?>
                </tbody>
            </table>
            <ul class="pagination"></ul>
            <div class="totalData"></div>
        </div>
    </div>
</div>
    