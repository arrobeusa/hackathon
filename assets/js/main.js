var base_host = "http://hack/";

PageModel = function(){
  var self = this;

  self.projects = ko.observableArray([
    {"id": 1, "name": "product 1"},
    {"id": 2, "name": "product 2"}
  ]);

  self.sampleSummary = ko.observable('this is my sample summary');

  self.numberOfSamplesRequired = ko.observable(33);

  self.showProduct = function(product){
    var url = "show.php?product_id=__ID__";
    url = url.replace("__ID__", product.id);
    url = base_host + url;
    window.location.href = url;
  }
}