<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="updateCourse">
        <div class="mb-3">
            <label for="courseName" class="form-label">Course Name</label>
            <input type="text" id="courseName" wire:model="courseName" class="form-control">
            @error('courseName') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" id="isDisabled" wire:model="isDisabled" class="form-check-input">
            <label class="form-check-label" for="isDisabled">Disable Course</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>
