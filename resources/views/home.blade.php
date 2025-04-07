@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cages') }}</div>
                <div class="card-body">
                    @if (Auth::user())
                    <div class="d-flex justify-content-end mb-4">
                        <!-- передать в заголовк id клетки, в которую будет добавлятся животное -->
                        <a href="{{route('cages.create')}}" class="btn btn-primary">
                            {{ __('Create cage') }}
                        </a>
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('Title')}}</th>
                                <th scope="col">{{__('Animals')}}</th>
                                <th scope="col">{{__('Capacity')}}</th>
                                @if (Auth::user())
                                <th scope="col">{{__('Actions')}}</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody id="cages-table-body">
                            @foreach($cages as $cage)
                            <tr id="cage-row-{{$cage->id}}">
                                <th scope="row" class="align-middle"><a href="{{route('cages.show', $cage->id)}}">{{$loop->index + 1}}</a></th>
                                <td class="align-middle">{{$cage->title}}</td>
                                <td class="align-middle">{{count($cage->animals)}}</td>
                                <td class="align-middle">{{$cage->capacity}}</td>
                                @if (Auth::user())
                                <td class="align-middle">
                                    <div class="d-flex gap-2 flex-nowrap">
                                        <a href="{{route('cages.edit', $cage->id)}}" class="btn btn-success"><i class="bi bi-pencil-fill"></i></a>
                                        <button type="button" class="btn btn-danger delete-cage" data-id="{{$cage->id}}">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">{{__('Notification')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-message"></div>
    </div>
</div>

@endsection

@section('script')
<script type="module">
    const tableBody = document.getElementById('cages-table-body');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const toast = new bootstrap.Toast(document.getElementById('liveToast'));
    tableBody.addEventListener('click', async (e) => {
        e.stopPropagation();
        const deleteBtn = e.target.closest('.delete-cage');
        if (!deleteBtn) return;

        const cageId = deleteBtn.dataset.id;
        const confirmDelete = confirm('Delete this cage?');

        if (!confirmDelete) return;
        try {
            const row = document.getElementById(`cage-row-${cageId}`);

            const response = await fetch(`/cages/${cageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            if (!response.ok) {
                throw new Error(await response.text());
            }

            (async function() {
                await row.remove();
            })();

            window.form.showToast('Deleted!');

        } catch (error) {
            const jsonStart = error.message.indexOf('{');
            const jsonEnd = error.message.lastIndexOf('}') + 1;
            const jsonString = error.message.slice(jsonStart, jsonEnd);

            const errorDetails = JSON.parse(jsonString);
            window.form.showToast(errorDetails.message || 'Error!');
        }
    });
</script>
@endsection