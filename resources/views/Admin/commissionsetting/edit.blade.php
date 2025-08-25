@extends('Admin.master')

@section('content')
<div class="row">
    <div class="col-12 mx-auto">

        <a href="{{ route('commissionsetting.index') }}" class="btn btn-success mb-3">
            <i class="bi bi-list"></i> Commission List
        </a>

        <h6 class="mb-3 text-uppercase">Edit Commission</h6>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('commissionsetting.update', $commission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- Refer Commission --}}
                    <div class="mb-3">
                        <label class="form-label">Lottery Percentages (%)</label>
                        <input type="number" step="0.01" name="lottery_percentages" class="form-control"
                            value="{{ old('lottery_percentages', $commission->refer_commission) }}"
                            placeholder="Enter refer lottery_percentages">
                        @error('lottery_percentages')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Refer Commission (%)</label>
                        <input type="number" step="0.01" name="refer_commission" class="form-control"
                            value="{{ old('refer_commission', $commission->refer_commission) }}"
                            placeholder="Enter refer commission">
                        @error('refer_commission')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Generation Commission --}}
                    <div class="mb-3">
                        <label class="form-label">Generation Commission (%)</label>
                        <input type="number" step="0.01" name="generation_commission" class="form-control"
                            value="{{ old('generation_commission', $commission->generation_commission) }}"
                            placeholder="Enter generation commission">
                        @error('generation_commission')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Generation Level 1 --}}
                    <div class="mb-3">
                        <label class="form-label">Generation Level 1 (%)</label>
                        <input type="number" step="0.01" name="generation_level_1" class="form-control"
                            value="{{ old('generation_level_1', $commission->generation_level_1) }}">
                        @error('generation_level_1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Generation Level 2 --}}
                    <div class="mb-3">
                        <label class="form-label">Generation Level 2 (%)</label>
                        <input type="number" step="0.01" name="generation_level_2" class="form-control"
                            value="{{ old('generation_level_2', $commission->generation_level_2) }}">
                        @error('generation_level_2')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Generation Level 3 --}}
                    <div class="mb-3">
                        <label class="form-label">Generation Level 3 (%)</label>
                        <input type="number" step="0.01" name="generation_level_3" class="form-control"
                            value="{{ old('generation_level_3', $commission->generation_level_3) }}">
                        @error('generation_level_3')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Generation Level 4 --}}
                    <div class="mb-3">
                        <label class="form-label">Generation Level 4 (%)</label>
                        <input type="number" step="0.01" name="generation_level_4" class="form-control"
                            value="{{ old('generation_level_4', $commission->generation_level_4) }}">
                        @error('generation_level_4')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Generation Level 5 --}}
                    <div class="mb-3">
                        <label class="form-label">Generation Level 5 (%)</label>
                        <input type="number" step="0.01" name="generation_level_5" class="form-control"
                            value="{{ old('generation_level_5', $commission->generation_level_5) }}">
                        @error('generation_level_5')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Weekly Team Commission --}}
                    <div class="mb-3">
                        <label class="form-label">Weekly Team Commission (%)</label>
                        <input type="number" step="0.01" name="weekly_team_commission" class="form-control"
                            value="{{ old('weekly_team_commission', $commission->weekly_team_commission) }}">
                        @error('weekly_team_commission')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $commission->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $commission->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Submit Button Right Side --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Save Commission
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
