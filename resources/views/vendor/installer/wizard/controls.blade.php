
<input id="tab1" type="radio" name="tabs" class="tab-input" checked />
<label for="tab1" class="tab-label">
    <i class="fa fa-cog fa-2x fa-fw" aria-hidden="true"></i>
    <br />
    {{ trans('installer_messages.environment.wizard.tabs.environment') }}
</label>


<input id="tab2" type="radio" name="tabs" class="tab-input" />
<label for="tab2" class="tab-label">
    <i class="fa fa-database fa-2x fa-fw" aria-hidden="true"></i>
    <br />
    {{ trans('installer_messages.environment.wizard.tabs.database') }}
</label>


<input id="tab4" type="radio" name="tabs" class="tab-input" />
<label for="tab4" class="tab-label">
    <i class="fa fa-envelope fa-2x fa-fw" aria-hidden="true"></i>
    <br />
    {{ trans('installer_messages.environment.wizard.tabs.mailing') }}
</label>


<input id="tab3" type="radio" name="tabs" class="tab-input" />
<label for="tab3" class="tab-label">
    <i class="fa fa-cogs fa-2x fa-fw" aria-hidden="true"></i>
    <br />
    {{ trans('installer_messages.environment.wizard.tabs.application') }}
</label>

