<?php include('./includes/_top.php') ?>

<?php

  $m   = new Mongo();
  $db  = $m->hackathon;
  $col = $db->collections;

  $collections = $col->find();

?>


<a class="btn" href="#" data-toggle="modal" data-target="#createCollectionModal">Create New Collection</a>

<div class="collections-list" data-bind="foreach: $root.collections">
  <div class="collection">
    <div class="collection-icon"></div>
    <div class="collection-name" data-bind="text: name"></div>
  </div>
</div>

<!-- Modal -->
<div id="createCollectionModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <form action="#" data-bind="submit: handleCreateCollection">
      <label>Collection Name:</label>
      <input placeholder="Name of collection" type="text" data-bind="value: name" />

      <label>Collection Description:</label>
      <textarea></textarea>

      <label>Assign to Vendor:</label>
      <select data-bind="options: availableVendors, optionsText: 'name', value: assignedVendor, optionsCaption: 'Choose...'"></select>

      <label>Add Team Members:</label>
      <select data-bind="options: availableTeamMembers"></select>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" data-bind="click: handleCreateCollection">Create Collection</button>
  </div>
</div>




<script type="text/javascript">

    
PageModel = function(){
  
  var self = this;

  self.collections = ko.observableArray([
    {"id": 1, "name": "col 1"},
    {"id": 2, "name": "col 2"}
  ]);
  
    
  self.handleCreateCollection = function(){
    var url = samplefy.base_host = samplefy.routes.api_create_collection;
    $.ajax({
      type: "POST",
      url: url,
      data: JSON.stringify({
        collection: {
          "name": self.name()
        }        
      }),      
      success: function(res){
        console.log(res);
        self.collections.push(res);
        $('#createCollectionModal').modal('hide');
      },
      dataType: 'json',
      contentType: 'application/json'
    });    
  
  }

  // new Collection
  self.name           = ko.observable();
  self.description    = ko.observable();
  self.assignedVendor = ko.observable();
  
  self.availableVendors     = ko.observableArray([{
      "id"  : 1234,
      "name": 'vendor 1'
  }]);
  self.availableTeamMembers = ko.observableArray(['tm 1', 'tm 2']);

  
  //self.sampleSummary = ko.observable('this is my sample summary');
  //self.numberOfSamplesRequired = ko.observable(33);
//  self.showProduct = function(product){
//    var url = "show.php?product_id=__ID__";
//    url = url.replace("__ID__", product.id);
//    url = base_host + url;
//    window.location.href = url;
//  }



}  
  
  
  
  ko.applyBindings(new PageModel());
</script>


<?php include('./includes/_bottom.php') ?>
