@extends('Admin.master')

@section('content')
<div class="container-fluid my-4">
    <a href="{{ route('lottery.index') }}" class="btn btn-success mb-3">
        <i class="bi bi-list"></i> Lottery List
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <h6 class="mb-3 text-uppercase">Edit Lottery</h6>

            <form action="{{ route('lottery.update', $lottery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label">Lottery Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $lottery->name) }}" placeholder="Enter lottery name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Price --}}
                <div class="mb-3">
                    <label class="form-label">Ticket Price (USD)</label>
                    <input type="number" step="0.01" name="price" class="form-control"
                           value="{{ old('price', $lottery->price) }}" placeholder="Enter ticket price">
                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="Write lottery description...">{{ old('description', $lottery->description) }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Photo --}}
                <div class="mb-3">
                    <label class="form-label">Lottery Image</label>
                    <input type="file" name="new_photo" class="form-control">
                    @if($lottery->photo)
                        <img src="{{ asset('uploads/Lottery/'.$lottery->photo) }}" alt="Lottery Image" width="80" class="img-thumbnail mt-2">
                    @endif
                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Draw Date + Countdown --}}
                <div class="mb-3">
                    <label class="form-label">Draw Date & Time</label>
                    <input type="datetime-local" name="draw_date" id="draw_date" class="form-control"
                           value="{{ old('draw_date', $lottery->draw_date ? $lottery->draw_date->format('Y-m-d\TH:i') : '') }}">
                    <small id="countdown" class="text-success mt-2 d-block"></small>
                    @error('draw_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Win Type --}}
                <div class="mb-3">
                    <label class="form-label">Win Type</label>
                    <select name="win_type" class="form-select" required>
                        @php
                            $types = ['daily'=>'Daily','7days'=>'7 Days','15days'=>'15 Days','1month'=>'1 Month','3months'=>'3 Months','6months'=>'6 Months','1year'=>'1 Year'];
                        @endphp
                        @foreach($types as $key => $label)
                            <option value="{{ $key }}" {{ old('win_type', $lottery->win_type) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('win_type') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Prizes --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">1st Prize</label>
                        <input type="text" name="first_prize" class="form-control"
                               value="{{ old('first_prize', $lottery->first_prize) }}" placeholder="e.g. $1000 or Car">
                        @error('first_prize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">2nd Prize</label>
                        <input type="text" name="second_prize" class="form-control"
                               value="{{ old('second_prize', $lottery->second_prize) }}" placeholder="e.g. $500">
                        @error('second_prize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">3rd Prize</label>
                        <input type="text" name="third_prize" class="form-control"
                               value="{{ old('third_prize', $lottery->third_prize) }}" placeholder="e.g. $250">
                        @error('third_prize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ old('status', $lottery->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $lottery->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Update Lottery
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Countdown Script with AM/PM --}}
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
