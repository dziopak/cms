
<div class="card mb-3">
    <div class="card-body">
        <div class="card-title">    
            <strong>

                {{-- Display translated or static title --}}
                {{ __($params['title']) }}

            </strong>
        </div>
        @child
    </div>
</div>
