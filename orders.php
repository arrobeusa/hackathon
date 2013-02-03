    <div class="container">
      <div class="row">
        <div class="create-new span2">
          <button>Create New</button>
        </div>
        <div class="span10">
          <div class="products-list" data-bind="foreach: projects">
            <div class="product" data-bind="click: $root.showProduct">
              <div data-bind="text: name"></div>
              <img src="" />
            </div>
          </div>
        </div>
      </div>
    </div>
