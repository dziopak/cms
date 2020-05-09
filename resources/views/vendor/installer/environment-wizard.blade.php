@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.wizard.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.wizard.title') !!}
@endsection

@section('container')
    <div class="tabs tabs-full">

        @include('vendor.installer.wizard.controls')

        <form method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}" class="tabs-wrap">
            @include('vendor.installer.wizard.environment')
            @include('vendor.installer.wizard.database')
            @include('vendor.installer.wizard.mailing')
            @include('vendor.installer.wizard.advanced')
        </form>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function checkEnvironment(val) {
            var element=document.getElementById('environment_text_input');
            if(val=='other') {
                element.style.display='block';
            } else {
                element.style.display='none';
            }
        }
        function showDatabaseSettings() {
            document.getElementById('tab2').checked = true;
        }
        function showApplicationSettings() {
            document.getElementById('tab3').checked = true;
        }
    </script>
@endsection


@section('continue')
    <div class="buttons">
        <button onclick="document.querySelector('form').submit()" class="button" type="submit">
            {{ trans('installer_messages.environment.wizard.form.buttons.install') }}
            <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
        </button>
    </div>
@endsection
