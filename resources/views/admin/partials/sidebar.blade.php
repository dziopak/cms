<div class="col-3 col-sm-3 col-md-2 col-lg-1 sidebar">
    <ul class="sidebar-list">
        <li class="sidebar-list-item">
            <a href="{{ route('admin.dashboard.index') }}">
                <div class="icon fa fas fa-home"></div>
                Dashboard
            </a>
        </li>
        <li class="sidebar-list-item">
            <a href="{{ route('admin.pages.index') }}">
                <div class="icon fa far fa-file"></div>
                Pages
            </a>

            <ul class="sidebar-sub-list">
                <li class="sidebar-list-item"><a href="{{ route('admin.pages.index') }}">List all</a></li>
                <li class="sidebar-list-item"><a href="{{ route('admin.pages.create') }}">Create new</a></li>
                <li class="sidebar-list-item"><a href="{{ route('admin.pages.categories.index') }}">Categories</a></li>
            </ul>
        </li>

        <li class="sidebar-list-item">
            <a href="{{ route('admin.posts.index') }}">
                <div class="icon fa fas fa-book"></div>
                Posts
            </a>

            <ul class="sidebar-sub-list">
                <li class="sidebar-list-item"><a href="{{ route('admin.posts.index') }}">List all</a></li>
                <li class="sidebar-list-item"><a href="{{ route('admin.posts.create') }}">Create new</a></li>
                <li class="sidebar-list-item"><a href="{{ route('admin.posts.categories.index') }}">Categories</a></li>
            </ul>
        </li>
        <li class="sidebar-list-item">
            <a href="{{ route('admin.users.index') }}">
                <div class="icon fa fas fa-user-circle"></div>
                Users
            </a>

            <ul class="sidebar-sub-list">
                <li class="sidebar-list-item"><a href="{{route('admin.users.index')}}">List all</a></li>
                <li class="sidebar-list-item"><a href="{{route('admin.users.create')}}">Create new</a></li>
                <li class="sidebar-list-item"><a href="{{route('admin.users.roles.index')}}">Roles</a></li>
            </ul>
        </li>
        <li class="sidebar-list-item">
            <a href="{{ route('admin.dashboard.index') }}">
                <div class="icon fa fas fa-columns"></div>
                Appearance
            </a>

            <ul class="sidebar-sub-list">
                <li class="sidebar-list-item"><a href="{{ route('admin.menus.index') }}">Menus</a></li>
                <li class="sidebar-list-item"><a href="">Widgets</a></li>
                <li class="sidebar-list-item"><a href="">Theme settings</a></li>
            </ul>
        </li>
        <li class="sidebar-list-item">
            <a href="{{ route('admin.dashboard.index') }}">
                <div class="icon fa fas fa-plug"></div>
                Addons
            </a>

            <ul class="sidebar-sub-list">
                <li class="sidebar-list-item"><a href="">Browse modules</a></li>
                <li class="sidebar-list-item"><a href="">Browse widgets</a></li>
            </ul>
        </li>
        <li class="sidebar-list-item">
            <a href="{{ route('admin.dashboard.index') }}">
                <div class="icon fa fas fa-cogs"></div>
                Settings
            </a>
            <ul class="sidebar-sub-list">
                <li class="sidebar-list-item"><a href="">General settings</a></li>
                <li class="sidebar-list-item"><a href="">SEO settings</a></li>
                <li class="sidebar-list-item"><a href="">Mail settings</a></li>
                <li class="sidebar-list-item"><a href="{{ route('admin.settings.logs.index') }}">System logs</a></li>
            </ul>
        </li>
    </ul>
    <div id="version">DMS v1.0.0</div>
</div>