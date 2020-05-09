<div class="tab" id="tab1content">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group {{ $errors->has('app_name') ? ' has-error ' : '' }}">
        <label for="app_name">
            {{ trans('installer_messages.environment.wizard.form.app_name_label') }}
        </label>
        <input type="text" name="app_name" id="app_name" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.app_name_placeholder') }}" />
    </div>
    @if ($errors->has('app_name'))
        <span class="error-block">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ $errors->first('app_name') }}
        </span>
    @endif

    <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
        <label for="app_url">
            {{ trans('installer_messages.environment.wizard.form.app_url_label') }}
        </label>
        <input type="url" name="app_url" id="app_url" value="http://localhost" placeholder="{{ trans('installer_messages.environment.wizard.form.app_url_placeholder') }}" />
    </div>
    @if ($errors->has('app_url'))
        <span class="error-block">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ $errors->first('app_url') }}
        </span>
    @endif

    <div class="form-group {{ $errors->has('environment') ? ' has-error ' : '' }}">
        <label for="environment">
            {{ trans('installer_messages.environment.wizard.form.app_environment_label') }}
        </label>
        <select name="environment" id="environment" onchange='checkEnvironment(this.value);'>
            <option value="local" selected>{{ trans('installer_messages.environment.wizard.form.app_environment_label_local') }}</option>
            <option value="development">{{ trans('installer_messages.environment.wizard.form.app_environment_label_developement') }}</option>
            <option value="qa">{{ trans('installer_messages.environment.wizard.form.app_environment_label_qa') }}</option>
            <option value="production">{{ trans('installer_messages.environment.wizard.form.app_environment_label_production') }}</option>
            <option value="other">{{ trans('installer_messages.environment.wizard.form.app_environment_label_other') }}</option>
        </select>
        <div id="environment_text_input" style="display: none;">
            <input type="text" name="environment_custom" id="environment_custom" placeholder="{{ trans('installer_messages.environment.wizard.form.app_environment_placeholder_other') }}"/>
        </div>
    </div>

    <div class="form-group {{ $errors->has('app_log_level') ? ' has-error ' : '' }}">
        <label for="app_log_level">
            {{ trans('installer_messages.environment.wizard.form.app_log_level_label') }}
        </label>
        <select name="app_log_level" id="app_log_level">
            <option value="debug" selected>{{ trans('installer_messages.environment.wizard.form.app_log_level_label_debug') }}</option>
            <option value="info">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_info') }}</option>
            <option value="notice">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_notice') }}</option>
            <option value="warning">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_warning') }}</option>
            <option value="error">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_error') }}</option>
            <option value="critical">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_critical') }}</option>
            <option value="alert">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_alert') }}</option>
            <option value="emergency">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_emergency') }}</option>
        </select>
    </div>
    @if ($errors->has('app_log_level'))
        <span class="error-block">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ $errors->first('app_log_level') }}
        </span>
    @endif

    <div class="form-group {{ $errors->has('app_debug') ? ' has-error ' : '' }}">
        <label for="app_debug">
            {{ trans('installer_messages.environment.wizard.form.app_debug_label') }}
        </label>
        <label for="app_debug_true">
            <input type="radio" name="app_debug" id="app_debug_true" value="1" checked />
            {{ trans('installer_messages.environment.wizard.form.app_debug_label_true') }}
        </label>
        <label for="app_debug_false">
            <input type="radio" name="app_debug" id="app_debug_false" value="0" />
            {{ trans('installer_messages.environment.wizard.form.app_debug_label_false') }}
        </label>
    </div>
    @if ($errors->has('app_debug'))
        <span class="error-block">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ $errors->first('app_debug') }}
        </span>
    @endif
</div>
