<div class="tab" id="tab4content">


    <div class="form-group {{ $errors->has('mail_driver') ? ' has-error ' : '' }}">
        <label for="mail_driver">
            {{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_label') }}
            <sup>
                <a href="https://laravel.com/docs/5.4/mail" target="_blank" title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                    <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                    <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                </a>
            </sup>
        </label>
        <input type="text" name="mail_driver" id="mail_driver" value="smtp" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder') }}" />
    </div>


    @if ($errors->has('mail_driver'))
        <span class="error-block">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ $errors->first('mail_driver') }}
        </span>
    @endif


    <div class="form-group {{ $errors->has('mail_host') ? ' has-error ' : '' }}">
        <label for="mail_host">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_label') }}</label>
        <input type="text" name="mail_host" id="mail_host" value="smtp.mailtrap.io" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder') }}" />
    </div>

    @if ($errors->has('mail_host'))
        <span class="error-block">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ $errors->first('mail_host') }}
        </span>
    @endif


    <div class="form-group {{ $errors->has('mail_port') ? ' has-error ' : '' }}">
        <label for="mail_port">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_label') }}</label>
        <input type="number" name="mail_port" id="mail_port" value="2525" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder') }}" />
    </div>

    @if ($errors->has('mail_port'))
        <span class="error-block">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ $errors->first('mail_port') }}
        </span>
    @endif


    <div class="form-group {{ $errors->has('mail_username') ? ' has-error ' : '' }}">
        <label for="mail_username">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_label') }}</label>
        <input type="text" name="mail_username" id="mail_username" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder') }}" />
    </div>

    @if ($errors->has('mail_username'))
        <span class="error-block">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ $errors->first('mail_username') }}
        </span>
    @endif


    <div class="form-group {{ $errors->has('mail_password') ? ' has-error ' : '' }}">
        <label for="mail_password">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_label') }}</label>
        <input type="text" name="mail_password" id="mail_password" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder') }}" />
    </div>

    @if ($errors->has('mail_password'))
        <span class="error-block">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ $errors->first('mail_password') }}
        </span>
    @endif


    <div class="form-group {{ $errors->has('mail_encryption') ? ' has-error ' : '' }}">
        <label for="mail_encryption">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_label') }}</label>
        <input type="text" name="mail_encryption" id="mail_encryption" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder') }}" />
    </div>

    @if ($errors->has('mail_encryption'))
        <span class="error-block">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ $errors->first('mail_encryption') }}
        </span>
    @endif


</div>
