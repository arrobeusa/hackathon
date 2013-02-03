    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/jquery-ui/js/jquery-ui.min.js"></script>
    <script src="/assets/js/knockout.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/main.js"></script>

	<script type="text/javascript">
	  ko.applyBindings(new PageModel());
	
	  $(function() {
	    $( "#draggable" ).draggable();
	  });	
	
	
	
	</script>

	<div class="well">
		<div class="span4">
			<ul class="inline">
				<li><a href="#">about</a></li>
				<li><a href="#">about</a></li>
				<li><a href="#">about</a></li>
		</div>
		<div class="span4" style="float: right;">
		&copy;Samplefy 2013
		</div>
	</div>
  </body>
</html>