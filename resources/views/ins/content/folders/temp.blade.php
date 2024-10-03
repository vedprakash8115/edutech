
<div class="folder">
    <div class="folder-content">
        <i class="bi bi-folder-fill"></i>
        <span>{{ $folder->name }}</span>
    </div>

    @if ($folder->subfolders && $folder->subfolders->count() > 0)
        <div class="subfolder-container" style="display: none;">
            @foreach ($folder->subfolders as $subfolder)

                @include('ins.content.folders.temp', ['folder' => $subfolder])
            @endforeach
        </div>
    @endif
</div>
