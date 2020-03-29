<button id="toggle-components">+</button>
<div id="dashboard-components">    
    <div class="add-widget" data-name="recentPosts">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Newest posts', 'thumbnail' => '/images/widgets/posts_statistics.png'])
            <p>Shows list of latest posts added to the database</p>
        @endwrapper
    </div>
    
    <div class="add-widget" data-name="postsStatistics">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Posts statistics'])
        <p>Shows all statistics related to posts.</p>
        @endwrapper
    </div>
    <div class="add-widget" data-name="recentLogs">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Recent Logs'])
        <p>Shows recent actions done by admin panel users</p>
        @endwrapper
    </div>
    <div class="add-widget" data-name="recentlyLoggedIn">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Recently Logged in', 'thumbnail' => '/images/widgets/recently_logged_in.png'])
        <p>Shows list of recently active users</p>
        @endwrapper
    </div>
    <div class="add-widget" data-name="contentStatistics">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Content Statistics'])
        <p>Shows amount of users, posts, pages and other content entries</p>
        @endwrapper
    </div>
    <div class="add-widget" data-name="Widget Divider">
        @wrapper('admin.partials.widgets.new_widget', ['title' => 'Widget divider'])
        <p>Separate widgets from each other to keep dashboard clean and readable</p>
        @endwrapper
    </div>
</div>