@if ($user->avatar)
    <img class="mr-4 float-left" width="100" src="{{ getPublicPath() }}/images/{{$user->photo->path ?? 'assets/no-avatar.png'}}">
@endif
<div style="display: inline-block;">
    <strong>{{'@'.$user->name}}</strong><br />

    @if ($user->first_name && $user->last_name)
    <span>{{$user->first_name.' '.$user->last_name}}</span><br />
    @endif

    {{ __('admin/general.created_at') }} {{$user->created_at}}<br />
    <small>{{$user->role->name}}</small>
</div>
