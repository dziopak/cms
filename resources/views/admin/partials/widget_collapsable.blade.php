<div class="@classes">
    <div id="@id" class="card mb-4">
        <div class="card-body">
            <div class="card-title">    
                <strong>
                    @title
                </strong>
                <a class="float-right" data-toggle="collapse" href="#@id-content" role="button" aria-expanded="false" aria-controls="@id-content">
                    &#9856;
                </a>
            </div>
            <div class="collapse show" id="@id-content">
                @child
            </div>
        </div>
    </div>
</div>