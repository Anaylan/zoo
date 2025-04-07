@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Cage') }}</div>
                <div class="card-body">
                    <form id="animal-form" method="POST" action="{{ route('animals.update', $animal->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label required">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{$animal->name}}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="species" class="form-label required">{{ __('Species') }}</label>
                            <input type="text" name="species" class="form-control @error('species') is-invalid @enderror"
                                id="species" value="{{$animal->species}}" required>
                            @error('species')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label required">{{ __('Age') }}</label>
                            <input type="numnber" value="{{$animal->age}}" name="age" class="form-control @error('age') is-invalid @enderror"
                                id="age" required>
                            @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label required">{{ __('Description') }}</label>
                            <input type="text" value="{{$animal->description}}" name="description" class="form-control @error('description') is-invalid @enderror"
                                id="description" required>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cage_id" class="form-label required">{{ __('Cage') }}</label>
                            <input type="number" value="{{$animal->cage_id}}" name="cage_id" class="form-control @error('cage_id') is-invalid @enderror"
                                id="cage_id" required>
                            @error('cage_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <span class="submit-text">{{ __('Save changes') }}</span>
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
    var form = document.getElementById('animal-form');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        e.stopPropagation();

        window.form.handleFormSubmit(e, "Save changes success", "Save changes failed");
    })
</script>
@endsection