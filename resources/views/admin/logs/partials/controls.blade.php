<div class="form-group row">
    <div class="col-4 pr-0">
        <input type="text" placeholder="{{ __('admin/logs.search') }}" name="search" class="form-control">
    </div>

    <div class="col-3 pr-0">
        <select id="log-type" class="form-control">
            <option value="0">{{ __('admin/logs.action_types.all') }}</option>
            <option value="PAGE">{{ __('admin/logs.action_types.pages') }}</option>
            <option value="PAGE_CATEGORY">{{ __('admin/logs.action_types.page_categories') }}</option>
            <option value="POST">{{ __('admin/logs.action_types.posts') }}</option>
            <option value="POST_CATEGORY">{{ __('admin/logs.action_types.post_categories') }}</option>
            <option value="USER">{{ __('admin/logs.action_types.users') }}</option>
            <option value="ROLE">{{ __('admin/logs.action_types.roles') }}</option>
            <option value="MAIL">{{ __('admin/logs.action_types.mails') }}</option>
        </select>
    </div>

    <div class="col-3 pr-0">
        <select id="log-crud" class="form-control">
            <option value="0">{{ __('admin/logs.actions.all') }}</option>
            <option value="1">{{ __('admin/logs.actions.create') }}</option>
            <option value="2">{{ __('admin/logs.actions.modify') }}</option>
            <option value="3">{{ __('admin/logs.actions.delete') }}</option>
        </select>
    </div>

    <div class="col-2">
        <button id="filter-button" class="btn btn-primary w-100">{{ __('admin/logs.filter') }}</button>
    </div>
</div>
