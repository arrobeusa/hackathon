<?php

$sample_id = $_GET['id'];


include('./includes/_top.php');


// upload tech spec
// upload new images
// comment on samples (conversation)

?>

<a class="btn" href="#" data-toggle="modal" data-target="#uploadTechSpecModal">Upload Tech Spec</a>



<!-- Create Sample Modal -->
<div id="uploadFileModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <form action="#" data-bind="submit: handleUploadFile">
      <label>Name:</label>
      <input placeholder="Name of file" type="text" data-bind="value: name" />
      <input type="file" />     
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" data-bind="click: handleUploadFile">Upload</button>
  </div>
</div>


<script type="text/javascript">
  
  PageModel = function(){
    var self = this;
    
    self.handleUploadFile = function(){
      
    }
  }

  ko.applyBindings(new PageModel);
</script>



<?php

include('./includes/_bottom.php');

