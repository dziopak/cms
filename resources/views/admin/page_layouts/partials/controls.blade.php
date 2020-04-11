<button id="toggle-components">+</button>
<div id="layout-components">
    <div class="add-widget" data-name="header">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Header'])
            <p>Static hero image</p>
        @endwrapper
    </div>


    <div class="add-widget" data-name="hero-slideshow">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Hero slideshow'])
            <p>Carousell of header banners</p>
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



</div>
