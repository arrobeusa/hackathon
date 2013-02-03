<?php

$sample_id = $_GET['id'];


  $m   = new Mongo();
  $db  = $m->hackathon;
  $col = $db->samples;

  $samples = array();
  $id = new MongoId($sample_id);
  
  $sample = $col->findOne(array("_id" => $id));  
  $sample = array(
      'id'            => (string) $sample['_id'],
      'name'          => $sample['name'],
      'description'   => $sample['description'],
      'conversation'  => $sample['conversation']
  );

  $samples_json = json_encode($sample, true);
  
  //echo $samples_json; exit;
  
?>


<?php include('./includes/_top.php') ?>


<div id="container" class="container">
  <div class="btn-group">
    <a class="btn" href="#" data-toggle="modal" data-target="#uploadTechSpecModal">Upload Tech Spec</a>
  </div>
  
  <h3>Technical Documents</h3>
  
  <h3>Sample Summary</h3>
  
  <div id="comments">    
    <h3>Comments</h3>
    <div class="btn-group">
      <a class="btn" href="#" data-toggle="modal" data-target="#addCommentModal">Add Comment</a>
    </div>
    <div class="comments" data-bind="foreach: comments">
      <div class="comment" data-bind="css:{designer: author == 'designer'}">
        <div class="body" data-bind="text: body"></div>
        <div class="image" data-bind="if: typeof img != 'undefined'">
          <img data-bind="attr:{src: '/FILES/' + img}"/>
        </div>
        <div class="created_at" data-bind="text: created_at"></div>
      </div>
   </div>
  </div>
  
  
  
</div>


<!-- Upload File Modal -->
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

<!-- Add Comment Modal -->
<div id="addCommentModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Add Comment</h3>
  </div>
  <div class="modal-body">
    <form id="addCommentForm" action="#" data-bind="submit: handleAddComments">
      <label>Comment:</label>
      <input placeholder="Add a comment" type="text" data-bind="value: body" />
      <label>Associate a file with this comment:</label>
      <input type="file" />     
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" data-bind="click: handleAddComments">Upload</button>
  </div>
</div>

<script type="text/javascript">
  
  PageModel = function(params){
    var self = this;
    
    self.body     = ko.observable();
    self.sample   = params.sample;
    self.comments = ko.observableArray(self.sample.conversation);
    
    /**
     * 
     */
    self.handleUploadFile = function(){
      
    }
  
    /**
     * 
     */
    self.handleAddComments = function(){  
      var url = samplefy.base_host + samplefy.routes.api_add_comment;
      url     = url.replace("__SAMPLE_ID__", params.sample_id);

      $.ajax({
        type: "POST",
        url: url,
        data: JSON.stringify({
          comment: {
            "body"              : self.body(),
            "sample_id"         : params.sample_id,
            "author"            : "designer"

          }        
        }),      
        success: function(res){
          var form = $('#addCommentForm');
          form[0].reset();
          $('#addCommentModal').modal('hide');
        },
        error: function(res) {
          alert('There was an error');
        },
        dataType: 'json',
        contentType: 'application/json'
      });    
      
      return false;      
    }
  }

  var params = {
    "sample_id": '<?php echo $sample_id ?>',
    "sample"   : $.parseJSON('<?php echo $samples_json ?>')
  }

  ko.applyBindings(new PageModel(params));
</script>



<?php

include('./includes/_bottom.php');

