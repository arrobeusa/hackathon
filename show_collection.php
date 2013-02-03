<?php

include('./includes/_top.php');

$collection_id = $_GET['id'];


  $m   = new Mongo();
  $db  = $m->hackathon;
  $col = $db->samples;

  $samples = array();
  foreach ($col->find() as $col) {
      $samples[] = array(
          'id'                   => (string) $col['_id'],
          'name'                 => @$col['name'],
          'special_instructions' => @$col['special_instructions'],
          'collection_id'        => @$col['collection_id']
      );
  }
  
  $samples_json = json_encode($samples, true);


?>

<div id="container" class="container">
  
  <div class="btn-toolbar">
    <div class="btn-group">
      <a class="btn" href="#" data-toggle="modal" data-target="#createSampleModal">Create New Sample</a>
      <a class="btn" href="#" data-toggle="modal" data-target="#addToShipmentModal">Add to Shipment</a>
      <a class="btn" href="#" data-toggle="modal" data-target="#logPO">Log PO</a>
    </div>
    <div class="btn-group">
      <a class="btn" href="#">Notify Vendor</a>
      <a class="btn" href="#">Poke Vendor</a>
    </div>   
  </div>
  
  <div class="section">
    <h3>Samples</h3>
    <div class="samples-list row-fluid" data-bind="foreach: samples">
      <div class="sample span3" data-bind="css: {last: $index() == 3}">
        <input type="checkbox" data-bind="value:id, checked: $root.addedToShipment" selected="false" />
        <span class="name" data-bind="text: name"></span>
      </div>  
    </div>
  </div>

  <div class="vendor-info" data-bind="with: vendor">
    <div data-bind="text: name"></div>
    <div data-bind="text: phone_no"></div>
    <div data-bind="text: address"></div>
  </div>

  <div class="section">
    <h3>Shipments</h3>
    <table class="shipments">
      <tr>
        <th>Date Sent</th>
        <th>Tracking Number</th>
        <th>Date Receive</th>
        <th>-</th>
      </tr>
      <tbody data-bind="foreach: shipments">
        <tr class="shipment">
          <td class="date" data-bind="text: date_sent"></td>
          <td class="tracking-number" data-bind="text: tracking_number"></td>
          <td class="date" data-bind="text: date_received"></td>
          <td><button>Receive Shipment</button></td>
        </tr>
      </tbody>
    </table>
  </div>
    
  <div class="section">
    <h3>Documents</h3>
    <div class="uploaded-documents" data-bind="foreach: uploadedDocuments">
      <div class="uploaded-document">
        <div class="document-name" data-bind="text: name"></div>
        <img src="" data-bind="attr:{src: 'FILES/' + file_name}"/>        
      </div>
    </div>    
    <div class="upload-trigger"></div>  
  </div>
</div>   



<!-- Create Sample Modal -->
<div id="createSampleModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <form id="sample-form" action="#" data-bind="submit: handleCreateSample">
      <label>Sample Name:</label>
      <input placeholder="Name of Sample" type="text" data-bind="value: name" />

      <label>Special Instructions:</label>
      <textarea data-bind="value: special_instructions"></textarea>
      
      <?php if (false): ?>
      <label>Image:</label>
      <input type="file"/>
      <?php endif ?>
      
      
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
    <form id="addToShipmentForm" action="#" data-bind="submit: handleAddToShipment">
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
  
  PageModel = function(params){
    var self = this;
     
    self.samples   = ko.observableArray(params.samples_data);


    // new Sample
    self.name                 = ko.observable();
    self.special_instructions = ko.observable();

    self.shipments = ko.observableArray([
      {"id": 1234, "date_sent": "2013-01-01", "tracking_number": "16Z64X2690303019162", "date_received": "2013-01-22"},
      {"id": 4567, "date_sent": "2013-02-01", "tracking_number": "5JK64X2698770319165", "date_received": ""}
    ]);     
    self.vendor    = ko.observable();
     
    
    self.uploadedDocuments = ko.observableArray([
      {"name": "Purchase Order", "file_name": "text_enriched.png"},
      {"name": "Invoice", "file_name": "text_enriched.png"},
      {"name": "Sample deposit invoice", "file_name": "text_enriched.png"}
    ]);
    
    self.addedToShipment = ko.observableArray();
    
    self.handleCreateSample = function(){
      var url    = samplefy.base_host = samplefy.routes.api_create_sample;
      $.ajax({
        type: "POST",
        url: url,
        data: JSON.stringify({
          sample: {
            "name"         : self.name(),
            "special_instructions"  : self.special_instructions(),
          }        
        }),      
        success: function(res){
          var form = $('#sample-form');
          form[0].reset();
          self.samples.push(res);
          $('#createSampleModal').modal('hide');
        },
        error: function(res) {
          alert('There was an error');
        },
        dataType: 'json',
        contentType: 'application/json'
      });    
         
     }
   
    self.handleAddToShipment = function(){
    
      var form = $('#addToShipmentForm');
      form[0].reset();
      $('#addToShipmentModal').modal('hide');
       
    }
  }
  
  var samples_data = '<?php echo $samples_json ?>';  
  ko.applyBindings(new PageModel({
    "samples_data": $.parseJSON(samples_data)
  }));
  
</script>
    

<?php include('./includes/_bottom.php') ?>
   