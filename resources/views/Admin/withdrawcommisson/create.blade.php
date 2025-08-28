@extends('Admin.master')

@section('content')

<div class="container-fluid my-4">

    {{-- Back Button --}}
    <a href="{{ route('withdrawcommisson.index') }}" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>

    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h4 class="mb-4">Create Withdraw Commission</h4>

            <form action="{{ route('withdrawcommisson.store') }}" method="POST">
                @csrf

                {{-- Withdraw Commission --}}
                <div class="mb-3">
                    <label for="withdraw_commission" class="form-label">Withdraw Commission</label>
                    <input type="number" step="0.01" name="withdraw_commission" id="withdraw_commission"
                           class="form-control @error('withdraw_commission') is-invalid @enderror"
                           value="{{ old('withdraw_commission') }}" placeholder="Enter withdraw commission">
                    @error('withdraw_commission')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Money Exchange Commission --}}
                <div class="mb-3">
                    <label for="money_exchange_commission" class="form-label">Money Exchange Commission</label>
                    <input type="number" step="0.01" name="money_exchange_commission" id="money_exchange_commission"
                           class="form-control @error('money_exchange_commission') is-invalid @enderror"
                           value="{{ old('money_exchange_commission') }}" placeholder="Enter money exchange commission">
                    @error('money_exchange_commission')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                    <label class="form-check-label" for="status">Active</label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Create
                </button>

            </form>
        </div>
    </div>
</div>

@endsection
