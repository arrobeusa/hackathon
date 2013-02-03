<?php include('./includes/_top.php') ?>

<?php

  $m   = new Mongo();
  $db  = $m->hackathon;
  $col = $db->collections;

  $collections = array();
  foreach ($col->find() as $col) {
      $collections[] = array(
          'id'          => (string) $col['_id'],
          'name'        => $col['name'],
          'description' => $col['description'],
          'vendor'      => $col['vendor']
      );
  }
  
  $collections_json = json_encode($collections, true);
?>


<div id="container" class="container">
  <div class="btn-group" style="margin-bottom:10px;">
    <a class="btn" href="#" data-toggle="modal" data-target="#createCollectionModal">Create New Collection</a>
  </div>

  <div class="collections-list" data-bind="foreach: $root.collections">
    <div class="collection" data-bind="click: $root.showCollection, css: {last: $index() == $root.collections().length - 1}">
      <div class="collection-icon"></div>
      <div class="collection-name" data-bind="text: name"></div>
      <div class="vendor-name" data-bind="text: vendor.name"></div>
    </div>
  </div>

  <!-- Modal -->
  <div id="createCollectionModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
      <form id="collection-form" action="#" data-bind="submit: handleCreateCollection">
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
</div>



<script type="text/javascript">

    
PageModel = function(params){
  var self = this;

  self.collections = ko.observableArray(params.collections_data);
  
    
  self.handleCreateCollection = function(){
    var url    = samplefy.routes.api_create_collection;
    var vendor = self.assignedVendor();    
        
    $.ajax({
      type: "POST",
      url: url,
      data: JSON.stringify({
        collection: {
          "name"         : self.name(),
          "description"  : self.description(),
          "vendor"       : ko.toJS(vendor)
        }        
      }),      
      success: function(res){
        var form = $('#collection-form');
        form[0].reset();
        self.assignedVendor(null);
        self.collections.push(res);
        $('#createCollectionModal').modal('hide');
      },
      error: function(res) {
        alert('There was an error');
      },
      dataType: 'json',
      contentType: 'application/json'
    });    
  
  }

  // new Collection
  //self.id             = ko.observable();
  self.name           = ko.observable();
  self.description    = ko.observable();
  self.assignedVendor = ko.observable();
  
  self.availableVendors     = ko.observableArray([
    { "id"  : 1234, "name": 'Home Simpson' },
    { "id"  : 4567, "name": 'Billy Randle' },
    { "id"  : 2345, "name": 'Cindy Dweller'}
  ]);

  self.availableTeamMembers = ko.observableArray(['tm 1', 'tm 2']);

  /**
   * 
   */
  self.showCollection = function(collection){
    var url = "/show_collection.php?id=__ID__";
    url = url.replace("__ID__", collection.id);
    alert(url);
    window.location.href = url;
  }
}

  
  
  var collections_data = '<?php echo $collections_json ?>';
  
  ko.applyBindings(new PageModel({
    "collections_data": $.parseJSON(collections_data)
  }));
</script>


<?php include('./includes/_bottom.php') ?>
