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

                @foreach(['first','second','third'] as $pos)
                    <label>{{ ucfirst($pos) }} Winner:</label>
                    <select name="{{ $pos }}_winner" class="form-control mb-2 user-select">
                        <option value="">-- Select --</option>
                        @foreach($buyers as $buyer)
                            <option value="{{ $buyer->user->id }}">{{ $buyer->user->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="{{ $pos }}_prize" class="form-control mb-3 prize-input"
                           placeholder="Enter {{ ucfirst($pos) }} Prize Amount" value="{{ $lottery->{$pos.'_prize'} ?? 0 }}">
                @endforeach
            </div>

            <button type="submit" class="btn btn-success mt-3">Declare Winners</button>
        </form>
    @endif
</div>

<style>
.prize-input { display: none; }
.user-select { cursor: pointer; }
</style>

<script>
const randomCheckbox = document.getElementById('randomCheckbox');
const manualSelect = document.getElementById('manual-select');

randomCheckbox.addEventListener('change', function() {
    manualSelect.style.display = this.checked ? 'none' : 'block';
});

// Show prize input when user name is clicked
document.querySelectorAll('.user-select').forEach(select => {
    select.addEventListener('change', function() {
        const input = this.nextElementSibling;
        if(this.value) {
            input.style.display = 'block';
        } else {
            input.style.display = 'none';
        }
    });
});
</script>
@endsection
