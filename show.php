<?php include('_top.php') ?>


    <div class="container">

      
      <div class="row">
        
        <div class="span3">
            <div id="navbarExample">
              <ul class="nav nav-list affix">
                <li class="active"><a href="#technical-documents">Technical Documents</a></li>
                <li class=""><a href="#sample-summary">Sample Summary</a></li>
                <li class=""><a href="#dates">Dates</a></li>
                <li class=""><a href="#invoices">Invoices</a></li>
                <li class=""><a href="#discussion">Discussion</a></li>
              </ul>                
            </div>            
        </div>
        
        <div class="span9">
             <div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example">
               
              <!-- Technical Documents -->
              <h4 id="technical-documents">Technical Documents</h4>
              
              <div class="row-fluid">
                <!-- Uploaded files -->
                <div class="span6">
                  
                  <?php // if file is .jpg show thumbnail, if pdf show icon ?>
                  <div class="technical-documents">
                    
                  </div>
                  <button>Upload a new document</button>
                </div>
                
                <!-- Discussion about said files -->
                <div class="span6"></div>
              </div>
              
              

              
              
              <h4 id="sample-summary">Sample Summary</h4>
              <textarea rows="3" data-bind="text: sampleSummary"></textarea>
              
             
              
              <!-- Sample Tracking -->
              <h4 id="dates">Sample Tracking</h4>
              <div class="row-fluid">
                <div class="span6">
                  <h4>Designer</h4>
                  <label>Number of samples required:</label>
                  <input type="text" data-bind="value: numberOfSamplesRequired"/>
                  
                  <label>Date Needed</label>
                  <input type="text" id="date-needed-datepicker"/>
                  
                  <?php // TODO: maybe should disable or hide unless sample has been shipped ?>
                  <label>Tracking#</label>
                  <input type="text"/>
                  
                </div>
                <div class="span6">
                  <h4>Manufacturer</h4>

                  <?php // move this down to align with Designer side ?>
                  
                  <label>Estimated Sample Ship Date</label>
                  <input type="text" id="eta-date-datepicker"/>

                  <label>Tracking#</label>
                  <input type="text"/>
                  
                </div>
              </div>
              
              
              
              <!-- Orders -->
              <?php 
              /*
               * 1) designer uploads PO
               * 2) Manufacturer uploads Quote 
               * 
               */
              ?>
              <h4 id="invoices">Orders</h4>
              <div class="row-fluid">
                <div class="span6">
                  <h4>Designer</h4>
                  <label>Upload PO</label>
                  <input type="file" />                                    
                </div>
                <div class="span6">
                  <h4>Manufacturer</h4>
                  <label>Upload Invoice</label>
                  <input type="file" />                  
                </div>
              </div>
              
              
              
            </div>      

        </div>
        
      </div>
      
      
    
    </div>

<?php include('_bottom.php') ?>
