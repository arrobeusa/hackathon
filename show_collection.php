<?php

include('./includes/_top.php');

$collection_id = $_GET['id'];


?>

<a class="btn" href="#" data-toggle="modal" data-target="#createSampleModal">Create New Sample</a>
<a class="btn" href="#" data-toggle="modal" data-target="#addToShipmentModal">Add to Shipment</a>
<a class="btn" href="#" data-toggle="modal" data-target="#logPO">Log PO</a>
<div class="samples-list" data-bind="foreach: samples">
  <div class="sample">
    <input type="checkbox" selected="false" />
    <span class="name" data-bind="text: name"></span>
  </div>  
</div>


<div class="vendor-info" data-bind="with: vendor">
  <div data-bind="text: name"></div>
  <div data-bind="text: phone_no"></div>
  <div data-bind="text: address"></div>
</div>

<div class="shipments" data-bind="foreach: shipments">
  <div class="shipment">
    <div class="sent">
      <div class="date"></div>
      <div class="tracking-number"></div>
    </div>
    <div class="received">
      <div class="date"></div>
      <div class="tracking-number"></div>
    </div>
    <button>Receive Shipment</button>
  </div>
</div>

<?php // TODO: need to add "vendor" or "designer" class to .conversation depending on source of conversation ?>
<div class="conversations">
  <div class="conversation-item">
    <div class="gravitar"></div>
    <div class="conversation-text"></div>
  </div>  
</div>    
    
<div class="uploaded-documents">
  <div class="uploaded-document"></div>
  
  <div class="upload-trigger"></div>  
  <div>
    <label>Upload a document:</label>
    <input type="file"/> 
  </div>  
</div>
    

<!-- Create Sample Modal -->
<div id="createSampleModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <form action="#" data-bind="submit: handleCreateSample">
      <label>Sample Name:</label>
      <input placeholder="Name of sample" type="text" data-bind="value: name" />

      <label>Special Instructions:</label>
      <textarea></textarea>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" data-bind="click: handleCreateSample">Create Sample</button>
  </div>
</div>

<!-- Add to Shipment Modal -->
<div id="addToShipmentModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <form action="#" data-bind="submit: handleAddToShipment">
      <label>Tracking Number:</label>
      <input placeholder="Tracking Number" type="text" data-bind="value: name" />

      <label>Comments:</label>
      <textarea></textarea>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" data-bind="click: handleAddToShipment">Save</button>
  </div>
</div>


    
<script type="text/javascript">
  
  PageModel = function(){
     var self = this;
     
     self.samples   = ko.observableArray([
       { "name": 'a sample'},
       { "name": 'another sample'}
     ]);
     self.shipments = ko.observableArray();     
     self.vendor    = ko.observable({"name": 'dsfasdf', "phone_no": 'adsfsf', "address": "343343"});
     
     
     self.handleCreateSample = function(){
       
     }
   
     self.handleAddToShipment = function(){
       
     }
  }
  
  ko.applyBindings(new PageModel());
  
</script>
    

<?php include('./includes/_bottom.php') ?>
   