@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $animal->name }}</h4>
                    @if (Auth::user())
                    <div class="btn-group">
                        <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i> {{__('Edit')}}
                        </a>
                        <form method="POST" action="{{ route('animals.destroy', $animal->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger ms-2"
                                onclick="return confirm('Are you sure you want to delete this animal?')">
                                <i class="bi bi-trash"></i> {{__('Delete')}}
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            @if($animal->photo)
                            <img src="{{ asset('storage/' . $animal->photo) }}"
                                alt="{{ $animal->name }}"
                                class="img-fluid rounded mb-3"
                                style="max-height: 200px;">
                            @else
                            <div class="text-muted py-5">
                                <i class="bi bi-image" style="font-size: 3rem;"></i>
                                <p class="mt-2">{{__('No photo')}}</p>
                            </div>
                            @endif
                        </div>

                        <div class="col-md-8">
                            <dl class="row">
                                <dt class="col-sm-3">{{__('Species')}}</dt>
                                <dd class="col-sm-9">{{ $animal->species }}</dd>

                                <dt class="col-sm-3">{{__('Age')}}</dt>
                                <dd class="col-sm-9">{{ $animal->age }} {{__('years')}}</dd>

                                <dt class="col-sm-3">{{__('Description')}}</dt>
                                <dd class="col-sm-9">{{ $animal->description ?? 'No description' }}</dd>

                                <dt class="col-sm-3">{{__('Created')}}</dt>
                                <dd class="col-sm-9">{{ $animal->created_at->format('M d, Y H:i') }}</dd>

                                <dt class="col-sm-3">{{__('Last Updated')}}</dt>
                                <dd class="col-sm-9">{{ $animal->updated_at->format('M d, Y H:i') }}</dd>

                                @if($animal->cage)
                                <dt class="col-sm-3">{{__('Cage')}}</dt>
                                <dd class="col-sm-9">
                                    <a href="{{ route('cages.show', $animal->cage->id) }}">
                                        {{ $animal->cage->title }}
                                    </a>
                                </dd>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-muted">
                    <small>Animal ID: {{ $animal->id }}</small>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('cages.show', $animal->cage_id) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> {{__('Back to cage')}}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    dt {
        font-weight: 500;
        color: #666;
    }

    dd {
        margin-bottom: 0.8rem;
    }

    .img-placeholder {
        background-color: #f8f9fa;
        border-radius: 0.25rem;
    }
</style>
@endsection