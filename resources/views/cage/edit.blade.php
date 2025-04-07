@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Cage') }}</div>
                <div class="card-body">
                    <form id="cage-form" method="POST" action="{{ route('cages.update', $cage->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label required">{{ __('Title') }}</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                id="title" value="{{ old('title', $cage->title) }}" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label required">{{ __('Capacity') }}</label>
                            <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror"
                                id="capacity" value="{{ old('capacity', $cage->capacity) }}"
                                min="{{ $cage->animals->count() }}" required>
                            @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                {{ __('Current animals count: ') }} {{ $cage->animals->count() }}
                            </small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <span class="submit-text">{{ __('Save Changes') }}</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto" id="toast-title">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-message"></div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="module">
    var form = document.getElementById('cage-form');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        e.stopPropagation();

        window.form.handleFormSubmit(e, "Save changes success", "Save changes failed");
    })
</script>
@endsection