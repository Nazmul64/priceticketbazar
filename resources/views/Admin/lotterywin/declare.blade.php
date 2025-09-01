@extends('Admin.master')

@section('content')
<div class="container mt-4">
    <h3>🎟 Declare Winners for: {{ $lottery->name }}</h3>

    @if($buyers->isEmpty())
        <div class="alert alert-warning">No eligible buyers for this lottery.</div>
    @else
        <form action="{{ route('admin.lottery.declare', $lottery->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>
                    <input type="checkbox" id="randomCheckbox" name="random" value="1"> Select Random Winners
                </label>
            </div>

            <div id="manual-select">
                <h4>Manual Selection</h4>

                <!-- 🔎 Search box -->
                <input type="text" id="searchBox" class="form-control mb-3" placeholder="Search user by name...">

                @foreach(['first','second','third'] as $pos)
                    <div class="winner-section mb-3">
                        <strong>{{ ucfirst($pos) }} Winner:</strong>
                        <div class="user-list border rounded p-2" data-position="{{ $pos }}">
                            @foreach($buyers as $buyer)
                                <div class="user-item" data-name="{{ strtolower($buyer->user->name) }}">
                                    <label class="d-block mb-1">
                                        <input type="radio" name="{{ $pos }}_winner" value="{{ $buyer->user->id }}">
                                        {{ $buyer->user->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <input type="number"
                               name="{{ $pos }}_prize"
                               class="form-control mt-2 prize-input"
                               placeholder="Enter {{ ucfirst($pos) }} Prize Amount"
                               value="{{ $lottery->{$pos.'_prize'} ?? 0 }}"
                               style="display:none;">
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success mt-3">Declare Winners</button>
        </form>
    @endif
</div>



@endsection
