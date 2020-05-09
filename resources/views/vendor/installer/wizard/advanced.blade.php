<div class="tab" id="tab3content">
    <div class="block">
        <div class="info">
            <div class="form-group {{ $errors->has('broadcast_driver') ? ' has-error ' : '' }}">
                <label for="broadcast_driver">{{ trans('installer_messages.environment.wizard.form.app_tabs.broadcasting_label') }}
                    <sup>
                        <a href="https://laravel.com/docs/5.4/broadcasting" target="_blank" title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                            <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                            <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                        </a>
                    </sup>
                </label>
                <input type="text" name="broadcast_driver" id="broadcast_driver" value="log" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.broadcasting_placeholder') }}" />
            </div>
            @if ($errors->has('broadcast_driver'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('broadcast_driver') }}
                </span>
            @endif

            <div class="form-group {{ $errors->has('cache_driver') ? ' has-error ' : '' }}">
                <label for="cache_driver">{{ trans('installer_messages.environment.wizard.form.app_tabs.cache_label') }}
                    <sup>
                        <a href="https://laravel.com/docs/5.4/cache" target="_blank" title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                            <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                            <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                        </a>
                    </sup>
                </label>
                <input type="text" name="cache_driver" id="cache_driver" value="file" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.cache_placeholder') }}" />
            </div>
            @if ($errors->has('cache_driver'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('cache_driver') }}
                </span>
            @endif

            <div class="form-group {{ $errors->has('session_driver') ? ' has-error ' : '' }}">
                <label for="session_driver">{{ trans('installer_messages.environment.wizard.form.app_tabs.session_label') }}
                    <sup>
                        <a href="https://laravel.com/docs/5.4/session" target="_blank" title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                            <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                            <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                        </a>
                    </sup>
                </label>
                <input type="text" name="session_driver" id="session_driver" value="file" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.session_placeholder') }}" />
            </div>
            @if ($errors->has('session_driver'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('session_driver') }}
                </span>
            @endif

            <div class="form-group {{ $errors->has('queue_driver') ? ' has-error ' : '' }}">
                <label for="queue_driver">{{ trans('installer_messages.environment.wizard.form.app_tabs.queue_label') }}
                    <sup>
                        <a href="https://laravel.com/docs/5.4/queues" target="_blank" title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                            <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                            <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                        </a>
                    </sup>
                </label>
                <input type="text" name="queue_driver" id="queue_driver" value="sync" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.queue_placeholder') }}" />
            </div>
            @if ($errors->has('queue_driver'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('queue_driver') }}
                </span>
            @endif
        </div>
    </div>
    <div class="block">
        <div class="info">
            <div class="form-group {{ $errors->has('redis_hostname') ? ' has-error ' : '' }}">
                <label for="redis_hostname">
                    {{ trans('installer_messages.environment.wizard.form.app_tabs.redis_host') }}
                    <sup>
                        <a href="https://laravel.com/docs/5.4/redis" target="_blank" title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                            <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                            <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                        </a>
                    </sup>
                </label>
                <input type="text" name="redis_hostname" id="redis_hostname" value="127.0.0.1" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_host') }}" />
            </div>
            @if ($errors->has('redis_hostname'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('redis_hostname') }}
                </span>
            @endif

            <div class="form-group {{ $errors->has('redis_password') ? ' has-error ' : '' }}">
                <label for="redis_password">{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_password') }}</label>
                <input type="password" name="redis_password" id="redis_password" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_password') }}" />
            </div>
            @if ($errors->has('redis_password'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('redis_password') }}
                </span>
            @endif

            <div class="form-group {{ $errors->has('redis_port') ? ' has-error ' : '' }}">
                <label for="redis_port">{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_port') }}</label>
                <input type="number" name="redis_port" id="redis_port" value="6379" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_port') }}" />
            </div>
            @if ($errors->has('redis_port'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('redis_port') }}
                </span>
            @endif
        </div>
    </div>

    <div>
        <div class="info">
            <div class="form-group {{ $errors->has('pusher_app_id') ? ' has-error ' : '' }}">
                <label for="pusher_app_id">
                    {{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_id_label') }}
                    <sup>
                        <a href="https://pusher.com/docs/server_api_guide" target="_blank" title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                            <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                            <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                        </a>
                    </sup>
                </label>
                <input type="text" name="pusher_app_id" id="pusher_app_id" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_id_palceholder') }}" />
            </div>
            @if ($errors->has('pusher_app_id'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('pusher_app_id') }}
                </span>
            @endif
            <div class="form-group {{ $errors->has('pusher_app_key') ? ' has-error ' : '' }}">
                <label for="pusher_app_key">{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_key_label') }}</label>
                <input type="text" name="pusher_app_key" id="pusher_app_key" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_key_palceholder') }}" />
            </div>
            @if ($errors->has('pusher_app_key'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('pusher_app_key') }}
                </span>
            @endif
            <div class="form-group {{ $errors->has('pusher_app_secret') ? ' has-error ' : '' }}">
                <label for="pusher_app_secret">{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_secret_label') }}</label>
                <input type="password" name="pusher_app_secret" id="pusher_app_secret" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_secret_palceholder') }}" />
            </div>
            @if ($errors->has('pusher_app_secret'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('pusher_app_secret') }}
                </span>
            @endif
        </div>
    </div>
</div>
