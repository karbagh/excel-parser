<div class="card my-3">
    <div class="card-body {{ $integration['done'] ? 'bg-success' : 'bg-light' }}">
        {{ $integration['id'] }}
        {{ $integration['path'] }}
        {{ $integration['created'] }}
    </div>
</div>
