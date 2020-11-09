@extends('Theme::index', ['css' => 'users'])

@section('module')
    <div class="user user--edit-profile">
        {!! Form::model($user, ['method' => 'PATCH', 'route' => 'front.user.update', 'files' => true]) !!}

            {{-- Title --}}
            <h2>{{ __('Theme::users.edit_profile') }}</h2>

            <div class="row">
                <div class="col" style="max-width: 160px">

                    {{-- Display avatar --}}
                    <img id="avatar" src="/images/{{ $user->photo->path ?? 'assets/no-avatar.png' }}">

                    {{-- Display user details --}}
                    <div class="user__details">
                        <strong class="user__detail user__detail--username">{{ '@' . $user->name }}</strong>
                        <strong class="user__detail">{{ $user->created_at ? __('Theme::users.registered').' '.$user->created_at->toDateString() : "" }}</strong>
                    </div>

                </div>

                {{-- Display form --}}
                <div class="col">
                    <x-form-fields :fields="$form['basic_data']" />
                    <x-form-fields :fields="$form['password_change']" />

                    {{-- Update button --}}
                    <x-update-button />
                </div>
            </div>


            {{-- Hidden fields --}}
            <input type="file" name="file" id="file" style="visibility: hidden;">
            {{ Form::hidden('user_id', $user->id) }}


        {!! Form::close() !!}
    </div>

    <script>
        $(document).ready(function() {
            $('#avatar').click(function() {
                $('#file').click();
            });

            $('#file').change(function() {

                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#avatar').attr('src', e.target.result);
                    }
                }

                reader.readAsDataURL(this.files[0]); // convert to base64 string
            });
        });
    </script>
@endsection


