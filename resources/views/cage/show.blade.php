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
                        <!-- передать в заголовок id клетки, в которую будет добавлятся животное -->
                        <a href="{{route('animals.create')}}" class="btn btn-primary">
                            {{ __('Add animal') }}
                        </a>
                    </div>
                    @endif
                    @if ($animals->count() <=0)
                        <p class="text-center fs-2 mb-0">{{__('Cage is empty')}}</p>
                        @else
                        <p>{{__("Animals in this cage:")}} {{$animals->count()}}</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Species')}}</th>
                                    <th scope="col">{{__('Age')}}</th>
                                    <th scope="col">{{__('Description')}}</th>
                                    @if (Auth::user())
                                    <th scope="col">{{__('Actions')}}</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody id="animals-table-body">
                                @foreach($animals as $animal)
                                <tr id="animal-row-{{$animal->id}}">
                                    <th scope="row" class="align-middle"><a href="{{route('animals.show', $animal->id)}}">{{$loop->index + 1}}</a></th>
                                    <td class="align-middle">{{$animal->name}}</td>
                                    <td class="align-middle">{{$animal->species}}</td>
                                    <td class="align-middle">{{$animal->age}}</td>
                                    <td class="align-middle">{{$animal->description}}</td>
                                    @if (Auth::user())
                                    <td class="align-middle">
                                        <div class="d-flex gap-2 flex-nowrap h-auto">
                                            <a href="{{route('animals.edit', $animal->id)}}" class="btn btn-success"><i class="bi bi-pencil-fill"></i></a>
                                            <button type="button" class="btn btn-danger delete-animal" data-id="{{$animal->id}}">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-message"></div>
    </div>
</div>

@endsection

@section('script')
<script type="module">
    document.getElementById('animals-table-body').addEventListener('click', async (e) => {
        const deleteBtn = e.target.closest('.delete-animal');
        if (!deleteBtn) return;

        const animalId = deleteBtn.dataset.id;
        const confirmDelete = confirm('Delete this animal?');

        if (!confirmDelete) return;

        try {
            const row = document.getElementById(`animal-row-${animalId}`);

            const response = await fetch(`/animals/${animalId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                throw new Error(await response.text());
            }

            row.remove();
            window.form.showToast('Deleted!');

        } catch (error) {
            window.form.showToast(error.message || 'Error!');
        }
    });
</script>
@endsection