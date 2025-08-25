@extends('userdashboard.master')

@section('content')
<div class="container py-5">
    <h4 class="fw-bold mb-4 text-white text-center">🎲 Available Lotteries</h4>

    <div class="row g-4">
        @forelse($lotteries as $lottery)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="lottery-card-glass">
                    <!-- Image + Overlay + Price -->
                    <div class="lottery-image-wrapper position-relative">
                        <img src="{{ asset('uploads/Lottery/'.$lottery->photo) }}" alt="{{ $lottery->name }}" class="lottery-bg-image-glass">
                        <div class="lottery-overlay-glass">
                            <h3 class="lottery-title-glass">{{ $lottery->name }}</h3>
                            <span class="lottery-type-glass">{{ ucfirst($lottery->win_type) }} Draw</span>
                        </div>
                        <div class="price-badge-glass">
                            <div class="price-amount-glass">
                                ${{ rtrim(rtrim(number_format($lottery->price, 2), '0'), '.') }}
                            </div>
                            <div class="price-label-glass">Entry Price</div>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="card-content-glass">
                        @if(($lottery->first_prize && !empty(trim($lottery->first_prize))) ||
                            ($lottery->second_prize && !empty(trim($lottery->second_prize))) ||
                            ($lottery->third_prize && !empty(trim($lottery->third_prize))))
                        <div class="prizes-section-glass">
                            <h4 class="section-title-glass">🏆 Prize Pool</h4>
                            <div class="prizes-grid-glass">
                                @if($lottery->first_prize)
                                    <div class="prize-item-glass gold-glass">
                                        <span class="prize-position-glass">1st</span>
                                        <span class="prize-amount-glass">{{ $lottery->first_prize }}</span>
                                    </div>
                                @endif
                                @if($lottery->second_prize)
                                    <div class="prize-item-glass silver-glass">
                                        <span class="prize-position-glass">2nd</span>
                                        <span class="prize-amount-glass">{{ $lottery->second_prize }}</span>
                                    </div>
                                @endif
                                @if($lottery->third_prize)
                                    <div class="prize-item-glass bronze-glass">
                                        <span class="prize-position-glass">3rd</span>
                                        <span class="prize-amount-glass">{{ $lottery->third_prize }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Draw Info -->
                        <div class="draw-info-glass">
                            <div class="info-item-glass">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <span class="info-label-glass">Draw Date</span>
                                    <span class="info-value-glass">
                                        @if(!empty($lottery->draw_date))
                                            {{ \Carbon\Carbon::parse($lottery->draw_date)->format('d M Y') }}
                                        @else
                                            Pending
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="info-item-glass">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <span class="info-label-glass">Time Left</span>
                                    <span class="info-value-glass countdown-timer"
                                          data-draw-date="@if(!empty($lottery->draw_date)){{ \Carbon\Carbon::parse($lottery->draw_date)->format('Y-m-d H:i:s') }}@endif">
                                        Calculating...
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Join Button -->
                        <button type="button" class="invest-btn-glass"
                                data-lottery-id="{{ $lottery->id }}"
                                data-lottery-name="{{ $lottery->name }}"
                                data-lottery-price="{{ rtrim(rtrim(number_format($lottery->price, 2), '0'), '.') }}">
                            <span class="btn-text-glass">Join Lottery</span>
                            <i class="fas fa-dice fa-lg ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-white text-center">❌ No active lotteries available right now.</p>
            </div>
        @endforelse
    </div>
</div>

    <!-- USDT Payment Modal -->
    <div class="modal fade" id="usdtPaymentModal" tabindex="-1" aria-labelledby="usdtPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content custom-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold w-100 text-center" id="usdtPaymentModalLabel" style="color:#1F1F1F;">
                        <i class="fab fa-bitcoin text-black me-2"></i>USDT Payment
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="usdtPaymentForm" method="POST" action="">
                    @csrf
                    <input type="hidden" id="usdt_lottery_id" name="lottery_id">

                    <div class="modal-header">
                        <h5 class="modal-title">Buy Lottery Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-4">
                            <div class="alert alert-info">
                                <div class="row">
                                    <div class="col-md-6"><strong>Lottery:</strong> <span id="usdt-lottery-name">-</span></div>
                                    <div class="col-md-6"><strong>Price:</strong> $<span id="usdt-lottery-price">0</span> USDT</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="usdt_amount" class="form-label">
                                <i class="fas fa-coins me-2"></i>USDT Amount
                            </label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="usdt_amount" name="usdt_amount"
                                    placeholder="Enter USDT amount" min="0.01" step="0.01" required>
                                <span class="input-group-text">USDT</span>
                            </div>
                            <small class="text-muted">Minimum: <span id="usdt-min-amount">1</span> USDT</small>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Confirm Payment</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- ================== CSS ================== -->
<style>
/* Container backdrop */
.container { background: rgba(0,0,0,0.5); border-radius: 16px; padding: 2rem; }
/* Card */
.lottery-card-glass { background: linear-gradient(145deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); border: 1px solid rgba(255,255,255,0.2); border-radius: 20px; overflow: hidden; transition: all 0.45s ease; backdrop-filter: blur(12px); box-shadow: 0 8px 32px rgba(0,0,0,0.35); height: 100%; display: flex; flex-direction: column; }
.lottery-card-glass:hover { transform: translateY(-8px); box-shadow: 0 20px 60px rgba(0,0,0,0.45); border-color: rgba(255,255,255,0.35); }
/* Image */
.lottery-image-wrapper { position: relative; height: 200px; overflow: hidden; }
.lottery-bg-image-glass { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.lottery-card-glass:hover .lottery-bg-image-glass { transform: scale(1.08); }
/* Overlay */
.lottery-overlay-glass { position: absolute; inset: 0; background: linear-gradient(140deg, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0.25) 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 16px; }
.lottery-title-glass { font-size: 1.4rem; font-weight: 800; color: #fff; margin: 0 0 4px 0; }
.lottery-type-glass { color: #ffd700; font-size: .9rem; text-transform: uppercase; letter-spacing: .6px; }
/* Price badge */
.price-badge-glass { position: absolute; top: 14px; right: 14px; background: linear-gradient(45deg, #ff6b6b, #ee5a24); padding: 10px 14px; border-radius: 14px; text-align: center; color: #fff; box-shadow: 0 6px 18px rgba(238,90,36,0.35); }
.price-amount-glass { font-size: 1.15rem; font-weight: 800; line-height: 1; }
.price-label-glass { font-size: .7rem; opacity: .95; text-transform: uppercase; letter-spacing: .4px; }
/* Body */
.card-content-glass { padding: 22px; display: flex; flex-direction: column; flex-grow: 1; }
/* Prize section */
.prizes-section-glass { margin-bottom: 18px; }
.section-title-glass { font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: 10px; }
.prizes-grid-glass { display: grid; grid-template-columns: repeat(auto-fit,minmax(90px,1fr)); gap: 10px; }
.prize-item-glass { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 10px 8px; text-align: center; color: #fff; font-weight: 700; transition: all .25s ease; position: relative; overflow: hidden; }
.prize-item-glass:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.3); }
.gold-glass { color: #ffd700; border-color: rgba(255,215,0,0.3); }
.silver-glass { color: #c0c0c0; border-color: rgba(192,192,192,0.3); }
.bronze-glass { color: #cd7f32; border-color: rgba(205,127,50,0.3); }
.prize-position-glass { display: block; font-size: .8rem; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 3px; }
.prize-amount-glass { display: block; font-size: .95rem; }
/* Draw info */
.draw-info-glass { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.12); border-radius: 14px; padding: 14px; margin-bottom: 16px; flex-grow: 1; }
.info-item-glass { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; color: #fff; }
.info-item-glass:last-child { margin-bottom: 0; }
.info-item-glass i { color: #ffd700; width: 20px; text-align: center; }
.info-label-glass { display: block; font-size: .78rem; color: rgba(255,255,255,0.7); font-weight: 600; text-transform: uppercase; letter-spacing: .5px; }
.info-value-glass { display: block; font-size: .98rem; color: #fff; font-weight: 700; }
/* Button */
.invest-btn-glass { margin-top: auto; background: linear-gradient(135deg,#667eea 0%, #764ba2 100%); border: none; border-radius: 14px; padding: 12px 18px; color: #fff; font-weight: 800; font-size: 1rem; letter-spacing: .5px; display: flex; justify-content: center; align-items: center; gap: 8px; cursor: pointer; transition: all .35s ease; white-space: nowrap; }
.invest-btn-glass:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(102,126,234,.45); background: linear-gradient(135deg,#764ba2,#667eea); }
/* Countdown */
.countdown-timer { font-weight: 800; color: #ffeb3b; text-shadow: 0 0 10px #ffeb3b,0 0 20px #ffc107; }
.countdown-live { color:#28a745 !important; text-shadow:none; }
.countdown-soon { animation: glow 1s infinite alternate; }
@keyframes glow{ 0%{ text-shadow:0 0 6px #ffeb3b,0 0 10px #ffc107; } 100%{ text-shadow:0 0 16px #ffeb3b,0 0 28px #ffc107; } }
/* Modal */
.custom-modal { background: rgba(255,255,255,.97); color:#000; border: 1px solid rgba(0,0,0,.1); border-radius: 16px; }
/* Responsive */
@media (max-width: 991.98px){ .col-lg-4{ flex: 0 0 50%; max-width: 50%; } }
@media (max-width: 767.98px){ .col-lg-4, .col-md-6{ flex: 0 0 100%; max-width: 100%; } }
</style>

<!-- ================== JS ================== -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // countdown timer
    function toSafeDate(dateStr){
        if(!dateStr) return null;
        const isoish = dateStr.replace(' ', 'T');
        const d = new Date(isoish);
        return isNaN(d.getTime()) ? null : d;
    }
    function fmt(diff){
        const d = Math.floor(diff/(1000*60*60*24));
        const h = Math.floor((diff%(1000*60*60*24))/(1000*60*60));
        const m = Math.floor((diff%(1000*60*60))/(1000*60));
        const s = Math.floor((diff%(1000*60))/1000);
        if(d>0) return `${d}d ${h}h ${m}m ${s}s`;
        if(h>0) return `${h}h ${m}m ${s}s`;
        if(m>0) return `${m}m ${s}s`;
        return `${s}s`;
    }
    function update(el){
        const raw = el.getAttribute('data-draw-date');
        if(!raw || raw.trim()===''){ el.textContent='Draw time not set'; el.className='info-value-glass text-muted'; return; }
        const target = toSafeDate(raw);
        if(!target){ el.textContent='Invalid date'; el.className='info-value-glass text-danger'; return; }
        const now = new Date();
        const diff = target-now;
        if(diff<=0){ el.textContent='🎉 Draw Live Now!'; el.className='info-value-glass countdown-live'; return; }
        el.textContent = fmt(diff);
        if(diff<60*1000) el.className='info-value-glass countdown-timer countdown-soon';
        else el.className='info-value-glass countdown-timer';
    }
    const timers=document.querySelectorAll('.countdown-timer');
    timers.forEach(update);
    setInterval(()=>{ timers.forEach(update); },1000);

    // modal open & form action
    const modalEl = document.getElementById('usdtPaymentModal');
    if(modalEl && typeof bootstrap!=='undefined'){
        const modal = new bootstrap.Modal(modalEl);
        document.querySelectorAll('.invest-btn-glass').forEach(btn=>{
            btn.addEventListener('click', e=>{
                e.preventDefault();
                const id = btn.getAttribute('data-lottery-id');
                const name = btn.getAttribute('data-lottery-name');
                const price = btn.getAttribute('data-lottery-price');

                document.getElementById('usdt_lottery_id').value = id;
                document.getElementById('usdt-lottery-name').textContent = name;
                document.getElementById('usdt-lottery-price').textContent = price;
                const minSpan = document.getElementById('usdt-min-amount');
                if(minSpan) minSpan.textContent = price;
                const input = document.getElementById('usdt_amount');
                if(input){ input.setAttribute('min', price); input.value = price; }

                // set actual form action
                document.getElementById('usdtPaymentForm').setAttribute(
                    'action',
                    "{{ route('buy.package', ':id') }}".replace(':id', id)
                );

                modal.show();
            });
        });

        // form submit
        document.getElementById('usdtPaymentForm')?.addEventListener('submit', e=>{
            const amount = parseFloat(document.getElementById('usdt_amount')?.value || 0);
            if(amount <= 0){ alert('Enter valid USDT amount'); e.preventDefault(); return; }
        });
    }
});
</script>

@endsection
