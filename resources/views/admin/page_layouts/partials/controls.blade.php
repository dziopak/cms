<button id="toggle-components">+</button>
<button id="toggle-new-components" class="toggle-components">C</button>
<button id="toggle-existing-components" class="toggle-components">E</button>
<div id="layout-components" class="components-bar">
    <div class="add-widget" data-name="header">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Header'])
            <p>Static hero image</p>
        @endwrapper
    </div>


    <div class="add-widget" data-name="slider">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Slider'])
            <p>Image slider</p>
        @endwrapper
    </div>


    <div class="add-widget" data-name="carousell">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Carousell'])
            <p>Customizable slick carousell</p>
        @endwrapper
    </div>


    <div class="add-widget" data-name="footer">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Footer'])
            <p>Footer block</p>
        @endwrapper
    </div>


    <div class="add-widget" data-name="vertical-menu">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Vertical menu'])
            <p>Vertical navigation menu</p>
        @endwrapper
    </div>


    <div class="add-widget" data-name="horizontal-menu">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Horizontal menu'])
            <p>Horizontal navigation menu</p>
        @endwrapper
    </div>


    <div class="add-widget" data-name="login">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Login form'])
            <p>Displays login form for guest users</p>
        @endwrapper
    </div>
</div>
