@extends('Admin.master')

@section('content')
<div class="container-fluid my-4">
    <a href="{{ route('lottery.index') }}" class="btn btn-success mb-3">
        <i class="bi bi-list"></i> Lottery List
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <h6 class="mb-3 text-uppercase">Create Lottery</h6>

            <form action="{{ route('lottery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label">Lottery Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter lottery name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Price --}}
                <div class="mb-3">
                    <label class="form-label">Ticket Price (USD)</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" placeholder="Enter ticket price">
                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Write lottery description...">{{ old('description') }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Photo --}}
                <div class="mb-3">
                    <label class="form-label">Lottery Image</label>
                    <input type="file" name="photo" class="form-control">
                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Draw Date + Countdown --}}
                <div class="mb-3">
                    <label class="form-label">Draw Date & Time</label>
                    <input type="datetime-local" name="draw_date" id="draw_date" class="form-control" value="{{ old('draw_date') }}">
                    <small id="countdown" class="text-success mt-2 d-block"></small>
                    @error('draw_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Win Type --}}
                <div class="mb-3">
                    <label class="form-label">Win Type</label>
                    <select name="win_type" class="form-select">
                        <option value="daily" {{ old('win_type') == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="7days" {{ old('win_type') == '7days' ? 'selected' : '' }}>7 Days</option>
                        <option value="15days" {{ old('win_type') == '15days' ? 'selected' : '' }}>15 Days</option>
                        <option value="1month" {{ old('win_type') == '1month' ? 'selected' : '' }}>1 Month</option>
                        <option value="3months" {{ old('win_type') == '3months' ? 'selected' : '' }}>3 Months</option>
                        <option value="6months" {{ old('win_type') == '6months' ? 'selected' : '' }}>6 Months</option>
                        <option value="1year" {{ old('win_type') == '1year' ? 'selected' : '' }}>1 Year</option>
                    </select>
                    @error('win_type') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Prizes --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">1st Prize</label>
                        <input type="text" name="first_prize" class="form-control" value="{{ old('first_prize') }}" placeholder="e.g. $1000 or Car">
                        @error('first_prize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">2nd Prize</label>
                        <input type="text" name="second_prize" class="form-control" value="{{ old('second_prize') }}" placeholder="e.g. $500">
                        @error('second_prize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">3rd Prize</label>
                        <input type="text" name="third_prize" class="form-control" value="{{ old('third_prize') }}" placeholder="e.g. $250">
                        @error('third_prize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Save Lottery
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Countdown Script with 12-hour AM/PM --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const drawInput = document.getElementById('draw_date');
    const countdownEl = document.getElementById('countdown');

    function format12Hour(date) {
        let hours = date.getHours();
        const minutes = date.getMinutes();
        const seconds = date.getSeconds();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        return `${hours.toString().padStart(2,'0')}:${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')} ${ampm}`;
    }

    function updateCountdown() {
        const drawTime = drawInput.value;
        if(!drawTime) {
            countdownEl.textContent = '';
            return;
        }

        const drawDate = new Date(drawTime);
        const now = new Date();
        const diff = drawDate - now;

        if(diff <= 0) {
            countdownEl.textContent = '🎉 Draw time has arrived!';
            return;
        }

        const days = Math.floor(diff / (1000*60*60*24));
        const hours = Math.floor((diff % (1000*60*60*24)) / (1000*60*60));
        const minutes = Math.floor((diff % (1000*60*60)) / (1000*60));
        const seconds = Math.floor((diff % (1000*60)) / 1000);

        countdownEl.textContent = `⏳ ${days}d ${hours}h ${minutes}m ${seconds}s remaining | Draw Time: ${format12Hour(drawDate)}`;
    }

    drawInput.addEventListener('input', updateCountdown);
    setInterval(updateCountdown, 1000);
});
</script>
@endsection
