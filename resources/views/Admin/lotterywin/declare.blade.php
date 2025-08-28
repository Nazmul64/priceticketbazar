@extends('Admin.master')

@section('content')
<div class="container mt-4">
    <h3>🎟 Declare Winners for: {{ $lottery->name }}</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.lottery.declare', $lottery->id) }}" method="POST" class="mt-3">
        @csrf

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold">First Prize</label>
                <div class="border rounded p-2" style="max-height: 360px; overflow:auto;">
                    @foreach($tickets as $ticket)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="first_winner" value="{{ $ticket->id }}" id="first_{{ $ticket->id }}" {{ old('first_winner')==$ticket->id?'checked':'' }}>
                            <label class="form-check-label" for="first_{{ $ticket->id }}">
                                #{{ $ticket->id }} — {{ $ticket->user->name }} ({{ $ticket->user->email }})
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Second Prize</label>
                <div class="border rounded p-2" style="max-height: 360px; overflow:auto;">
                    @foreach($tickets as $ticket)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="second_winner" value="{{ $ticket->id }}" id="second_{{ $ticket->id }}" {{ old('second_winner')==$ticket->id?'checked':'' }}>
                            <label class="form-check-label" for="second_{{ $ticket->id }}">
                                #{{ $ticket->id }} — {{ $ticket->user->name }} ({{ $ticket->user->email }})
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Third Prize</label>
                <div class="border rounded p-2" style="max-height: 360px; overflow:auto;">
                    @foreach($tickets as $ticket)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="third_winner" value="{{ $ticket->id }}" id="third_{{ $ticket->id }}" {{ old('third_winner')==$ticket->id?'checked':'' }}>
                            <label class="form-check-label" for="third_{{ $ticket->id }}">
                                #{{ $ticket->id }} — {{ $ticket->user->name }} ({{ $ticket->user->email }})
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-danger mt-3">Declare Winners</button>
    </form>
</div>
@endsection
