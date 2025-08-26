@extends('Frontend.master')
@section('content')
<!-- Hero Section Start -->
<div class="hero-section" data-background="{{asset('frontend')}}/assets/images/duJ03Fhd1705123205.png">
   <div class="container">
      <div class="row px-45">
         <div class="col-lg-7">
            <div class="hero-content">
               <h1 class="pt-20 hero-header wow fadeInUp" data-wow-delay="0.2s">Invest for Future in Stable Platform.
               </h1>
               <p class="pt-20 hero-p wow fadeInUp" data-wow-delay="0.3s">Make a profitable business from these niches, Grow your profit, invest now. See The Platform, Feel The Shine</p>
               <a href="http://localhost/geniushyip/" data-wow-delay="0.3s" class=" template-btn secondary-btn d-xl-inline-block mt-20 wow fadeInUp">Get Started</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Hero Section End -->
<!-- Counter Section Start -->
<div class="counter-section">
   <div class="container">
      <div class="row counter-row">
         <div class="col-lg-4 col-md-6 col-12 wow fadeInUp">
            <div class="counter-box">
               <div class="icon-wraper">
                  <div class="overlay-box"></div>
                  <div class="icon-box">
                     <img src='{{asset('frontend')}}/assets/images/MeK1pBLt1704866949.png'
                     alt="">
                  </div>
               </div>
               <div class="counter-content">
                  <h3 class="counter"> <span class="counterr">1338</span> +
                  </h3>
                  <p class="counter-text ">All Members</p>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-12 wow fadeInUp">
            <div class="counter-box">
               <div class="icon-wraper">
                  <div class="overlay-box"></div>
                  <div class="icon-box">
                     <img src='{{asset('frontend')}}/assets/images/kEEGt3Hk1704867219.png'
                     alt="">
                  </div>
               </div>
               <div class="counter-content">
                  <h3 class="counter"> <span class="counterr">12.5</span> M
                  </h3>
                  <p class="counter-text ">Average Investment</p>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-12 wow fadeInUp">
            <div class="counter-box">
               <div class="icon-wraper">
                  <div class="overlay-box"></div>
                  <div class="icon-box">
                     <img src='{{asset('frontend')}}/assets/images/uEfOC1lW1704867303.png'
                     alt="">
                  </div>
               </div>
               <div class="counter-content">
                  <h3 class="counter"> <span class="counterr">200</span> +
                  </h3>
                  <p class="counter-text ">Countries</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Counter Section End -->
<!-- About Us Section Start -->
<div class="about-us-section">
    @foreach ($aboutus as  $item)
    @if ($item->status)
   <img src="{{asset($item->photo ?? '')}}" alt="about-us" class="img-fluid about-img">
   <div class="container">
      <div class="row about-us-row wow fadeInUp" data-wow-delay="0.2s">
         <div class="col-lg-6">
            <h2 class="pb-20">{{$item->title ?? ''}}</h2>
            <p class="about-paragraph">
                <span id="about-text">{{ $item->description ?? '' }}</span>
            </p>
            <div class="d-flex gap-3 about-btn">
                <a href="javascript:void(0)" id="toggle-btn" class="template-btn primary-btn abt-btn">Read More</a>
                <a href="#" class="template-btn primary-outline abt-btn">Contact Us</a>
            </div>

         </div>
      </div>
   </div>
    @endif
 @endforeach
</div>
<!-- About Us Section End -->
<!-- Calculator Section Start -->
<div class="calculator-section position-relative" data-background="{{asset('frontend')}}/assets/front/images/calculator-bg.png">
   <div class="container pt-100 pb-100 calculate-container ">
      <div class="row justify-content-center">
         <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
            <img class="calcultor-img wow fadeInUp" src="{{asset('frontend')}}/assets/images/QkC6B5ul1703994506.png"
               alt="img">
         </div>
         <div class="col-lg-6 col-md-6 col-sm-12 col-12 calculation-details wow fadeInUp" data-wow-delay="0.1s">
            <div>
               <h6 class="pb-3 ">Profit Calculator</h6>
               <h2 class="pb-20  ">Calculate Your Profit</h2>
               <p class="calculator-paragraph ">
                  Aenean vulputate eleifend tellus. Aenean leo ligul porttitoeu consequat vitae eleifend acenim.
               </p>
            </div>
            <div class="calculate-form">
               <form id="profitCalculate" class="form-areas" action="https://demo.geniusocean.com/hyip-king/profit/calculate">
                  <div class="alert alert-success alert-dismissible fade show" style="display: none;">
                     <p class="m-0 text-success"></p>
                  </div>
                  <div class="alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
                     <p class="m-0 text-danger"></p>
                  </div>
                  <input type="hidden" name="_token" value="Gety1CLWTuqmcpc0MjWKHAV1zB7MfyVZDAr9wSFy" autocomplete="off">
                  <fieldset class="form-feild">
                     <div class="form-inpt">
                        <label for="plan" class="form-label">Select Plan</label>
                        <select id="plan" name="plan" class="forms nice_select w-100 rounded">
                           <option value="9">Orbit</option>
                           <option value="8">Platinum</option>
                           <option value="7">Diamond</option>
                           <option value="6">Broonze</option>
                           <option value="5">Gold</option>
                           <option value="4">Professional</option>
                        </select>
                     </div>
                     <div class="form-inpt">
                        <label for="amount" class="form-label">Enter Amount</label>
                        <input type="number" step="any" name="amount" id="amount" class="form-control forms"
                           placeholder="Enter Amount">
                     </div>
                     <div class="form-inpt">
                        <label for="profit-calculate-amount" class="form-label">Profit Amount</label>
                        <input readonly type="text" name="profit-amount" id="profit-calculate-amount"
                           class="form-control disable-forms profitCalBoxAmount" placeholder="00.00">
                     </div>
                     <div>
                        <div class="form-inpt">
                           <button type="submit" class="form-btn primary-btn-forms btn-forms">
                           Calculate Now</button>
                        </div>
                     </div>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Calculator Section End -->
<!-- Choose Us Section Start -->
@php
    $whychoose = \App\Models\Whychooseinvestmentplan::first();
@endphp

<div class="choose-us-section">
    <div class="container">
        <div class="choose-section-header wow fadeInUp">
            <h6>{{ $whychoose->title ?? '' }}</h6>
            <p class="choose-section-paragraph">
                <span>{{ $whychoose->description ?? '' }}</span>
            </p>
        </div>

        <div class="row choose-us-row">
          @foreach ($Whychooseinvestmentplan as $item)
                @if ($item->status)
                    <div class="col-lg-4 col-md-6 col-12 wow fadeInUp">
                        <div class="choose-us-box">
                            <div class="icon-wraper">
                                <div class="overlay-box"></div>
                                <div class="icon-box">
                                    <i class="{{ $item->icon ?? '' }} fz_30"></i>
                                </div>
                            </div>
                            <div class="counter-content">
                                <h5 class="counter">{{ $item->main_title ?? '' }}</h5>
                                <p class="counter-text">
                                    <span>{{ $item->main_description ?? '' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<!-- Choose Us Section End -->
<!-- Offer Section Start -->
<div class="offer-section">
   <div class="container">
      <div class="offer-section-header wow fadeInUp">
         <h6>Invest Offer</h6>
         <h2>Best Investment Packages</h2>
         <p class="offer-section-paragraph">Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga magni.            </p>
      </div>
      <div class="row offer-row-box wow fadeInUp" data-wow-delay="0.1s">
    @foreach ($lotterys as $item)
       @if($item->status)
        <div class="col-lg-4 col-md-6 col-12">
            <div class="offer-box business-bg">
                <!-- Lottery Title -->
                <div class="icon-wraper">
                    <div class="overlay-box"></div>
                    <div class="icon-box business-bg">
                        <h6 class="pt-2">{{ $item->name ?? '' }}</h6>
                    </div>
                </div>

                <!-- Lottery Content -->
                <div class="offer-content">
                    <div class="offer-price">
                        <h4>{{ round($item->price ?? 0) }}$</h4>
                    </div>
                    <hr>

                    <!-- Lottery Details -->
                    <ul class="pb-40">
                        <li>{{ $item->first_prize ?? '' }}</li>
                        <li>{{ $item->second_prize ?? '' }}</li>
                        <li>{{ $item->third_prize ?? '' }}</li>

                        <!-- Countdown -->
                        <li class="lottery-item">
                            <span class="name">{{ $item->win_type ?? '' }}</span>
                            <span id="countdown-{{ $item->id }}" class="countdown"></span>
                        </li>
                    </ul>
                </div>

                <!-- Invest Button -->
                <button class="template-btn-offer primary-outline-offer invest-plan" type="button"
                        data-bs-toggle="modal" data-bs-target="#invest-modal"
                        data-title="{{ $item->name }}"
                        data-id="{{ $item->id }}"
                        data-type="1"
                        data-fixAmount="{{ round($item->price ?? 0) }}">
                    Invest Now
                </button>
            </div>
        </div>
        @endif
    @endforeach
</div>

<!-- Styles -->


   </div>
</div>
<div class="stat-section">
   <img class="stat-section-img" src="{{asset('frontend')}}/assets/front/images/Frame76.png" alt="">
   <div class="container">
      <div class="stat-section-header wow fadeInUp">
         <h6>User Statistics</h6>
         <h2>Last Deposits & Withdrawals</h2>
         <p class="stat-section-paragraph">
            Our goal is to simplify investing so that anyone can be an investor.
         </p>
      </div>
      <div class="stat-table wow fadeInUp" data-wow-delay="0.1s">
         <nav>
            <div class="nav justify-content-center pb-30" id="nav-tab" role="tablist">
               <button class="state-left-btn active active-tab-btn" id="nav-deposit-tab" data-bs-toggle="tab"
                  data-bs-target="#nav-deposit" type="button" role="tab" aria-controls="nav-deposit"
                  aria-selected="true">Deposits</button>
               <button class="state-right-btn active-tab-btn" id="nav-withdraw-tab" data-bs-toggle="tab"
                  data-bs-target="#nav-withdraw" type="button" role="tab" aria-controls="nav-withdraw"
                  aria-selected="false">Withdraw</button>
            </div>
         </nav>
         <div class="tab-content " id="nav-tabContent">
            <div class="tab-pane fade show active table-responsive p-4 tb-tb" id="nav-deposit" role="tabpanel"
               aria-labelledby="nav-deposit-tab" style="color: white;">
               <table class="table custom-table ">
                  <thead class="tb-head">
                     <tr class="tb-row">
                        <th>Date</th>
                        <th>Transaction Number</th>
                        <th>Method</th>
                        <th>Account Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                    <tbody class="tb-body">
                        @foreach ($deposite as $item)
                            <tr class="tb-row">
                                <!-- Date -->
                                <td data-label="Date">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}
                                </td>

                                <!-- Transaction Number -->
                                <td data-label="Transaction Number">
                                    {{ $item->transaction_id ?? '' }}
                                </td>

                                <!-- Payment Method -->
                                <td data-label="Method">
                                    {{ $item->payment_method ?? '' }}
                                </td>
                                 @php
                                     $user_name=\App\Models\User::where('id',$item->user_id)->first();
                                 @endphp
                                <!-- Account Name -->
                                <td data-label="Account Name">
                                    {{ $user_name->name ?? '' }}
                                </td>

                                <!-- Amount -->
                                <td data-label="Amount">
                                    {{ round($item->amount ?? '') }}$
                                </td>

                                <!-- Status -->
                                <td data-label="Status">
                                    @if($item->status == 'approved')
                                        <p class="text-success">{{ ucfirst($item->status) }}</p>
                                    @else
                                        <p class="text-danger">{{ ucfirst($item->status) }}</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
               </table>
            </div>
            <div class="tab-pane fade table-responsive p-4 tb-tb" id="nav-withdraw" role="tabpanel"
               aria-labelledby="nav-withdraw-tab" style="color: white;">
               <table class="table custom-table">
                  <thead class="tb-head">
                     <tr class="tb-row">
                        <th>Date</th>
                        <th>Transaction no</th>
                        <th>Method</th>
                        <th>Account Name</th>
                        <th>Amount</th>
                        <th>Fee</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody class="tb-body">
                     <tr class="tb-row">
                        <td data-label="Date">Jan 13, 2024</td>
                        <td data-label="Transaction Number">NLEAI3CDJUD4</td>
                        <td data-label="Method">Payoneer</td>
                        <td data-label="Account Name">
                           Mr. Mostafa
                        </td>
                        <td data-label="Amount">100$</td>
                        <td data-label="Fee">3.5$</td>
                        <td data-label="Status">
                           <p class="text-danger">Rejected</p>
                        </td>
                     </tr>
                     <tr class="tb-row">
                        <td data-label="Date">Feb 23, 2023</td>
                        <td data-label="Transaction Number">NHNVLVO6NNDN</td>
                        <td data-label="Method">Stripe</td>
                        <td data-label="Account Name">
                           Showrav mia
                        </td>
                        <td data-label="Amount">50$</td>
                        <td data-label="Fee">3$</td>
                        <td data-label="Status">
                           <p class="text-danger">Rejected</p>
                        </td>
                     </tr>
                     <tr class="tb-row">
                        <td data-label="Date">Feb 23, 2023</td>
                        <td data-label="Transaction Number">VA1XRXRPIPLM</td>
                        <td data-label="Method">Stripe</td>
                        <td data-label="Account Name">
                           Showrav mia
                        </td>
                        <td data-label="Amount">50$</td>
                        <td data-label="Fee">3$</td>
                        <td data-label="Status">
                           <p class="text-danger">Rejected</p>
                        </td>
                     </tr>
                     <tr class="tb-row">
                        <td data-label="Date">Feb 23, 2023</td>
                        <td data-label="Transaction Number">38QTE9IAQ21A</td>
                        <td data-label="Method">Stripe</td>
                        <td data-label="Account Name">
                           Showrav mia
                        </td>
                        <td data-label="Amount">50$</td>
                        <td data-label="Fee">3$</td>
                        <td data-label="Status">
                           <p class="text-danger">Rejected</p>
                        </td>
                     </tr>
                     <tr class="tb-row">
                        <td data-label="Date">Feb 23, 2023</td>
                        <td data-label="Transaction Number">LBZEQUYVCVIJ</td>
                        <td data-label="Method">Stripe</td>
                        <td data-label="Account Name">
                           Showrav mia
                        </td>
                        <td data-label="Amount">50$</td>
                        <td data-label="Fee">3$</td>
                        <td data-label="Status">
                           <p class="text-danger">Rejected</p>
                        </td>
                     </tr>
                     <tr class="tb-row">
                        <td data-label="Date">Feb 23, 2023</td>
                        <td data-label="Transaction Number">VKGG0TEXSAAK</td>
                        <td data-label="Method">Stripe</td>
                        <td data-label="Account Name">
                           Showrav mia
                        </td>
                        <td data-label="Amount">50$</td>
                        <td data-label="Fee">3$</td>
                        <td data-label="Status">
                           <p class="text-success">Completed</p>
                        </td>
                     </tr>
                     <tr class="tb-row">
                        <td data-label="Date">Feb 16, 2023</td>
                        <td data-label="Transaction Number">MGVVYPBNOSZG</td>
                        <td data-label="Method">Nagad</td>
                        <td data-label="Account Name">
                           Showrav mia
                        </td>
                        <td data-label="Amount">12.06$</td>
                        <td data-label="Fee">0.2$</td>
                        <td data-label="Status">
                           <p class="text-danger">Rejected</p>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="gateways-section">
   <div class="container">
      <div class="gateways-section-header wow fadeInUp">
         <h6>Payment Getaways</h6>
         <h2>Our Payment Gateway</h2>
         <p class="gateways-section-paragraph">
            Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga magni
         </p>
      </div>
      <div class="row px-45 gateways-sliderr wow fadeInUp" data-wow-delay="0.2s">
         <div class="col px-2">
            <div class="gateways-box">
               <img class="mx-auto d-block" src="{{asset('frontend')}}/assets/images/k5R7wnnZ1704874703.png" alt="">
            </div>
         </div>
         <div class="col px-2">
            <div class="gateways-box">
               <img class="mx-auto d-block" src="{{asset('frontend')}}/assets/images/0Irqc6ug1704874692.png" alt="">
            </div>
         </div>
         <div class="col px-2">
            <div class="gateways-box">
               <img class="mx-auto d-block" src="{{asset('frontend')}}/assets/images/cISchOW01704874681.png" alt="">
            </div>
         </div>
         <div class="col px-2">
            <div class="gateways-box">
               <img class="mx-auto d-block" src="{{asset('frontend')}}/assets/images/X2uWfb701704874671.png" alt="">
            </div>
         </div>
         <div class="col px-2">
            <div class="gateways-box">
               <img class="mx-auto d-block" src="{{asset('frontend')}}/assets/images/pbBZTyJF1704874655.png" alt="">
            </div>
         </div>
         <div class="col px-2">
            <div class="gateways-box">
               <img class="mx-auto d-block" src="{{asset('frontend')}}/assets/images/x8DGNrrI1704874583.png" alt="">
            </div>
         </div>
         <div class="col px-2">
            <div class="gateways-box">
               <img class="mx-auto d-block" src="{{asset('frontend')}}/assets/images/DlOwnD2g1704874511.png" alt="">
            </div>
         </div>
         <div class="col px-2">
            <div class="gateways-box">
               <img class="mx-auto d-block" src="{{asset('frontend')}}/assets/images/5iYGWthV1704874547.png" alt="">
            </div>
         </div>
         <div class="col px-2">
            <div class="gateways-box">
               <img class="mx-auto d-block" src="{{asset('frontend')}}/assets/images/RYoblVwB1704874559.png" alt="">
            </div>
         </div>
         <div class="col px-2">
            <div class="gateways-box">
               <img class="mx-auto d-block" src="{{asset('frontend')}}/assets/images/kCDqJMGY1704874571.png" alt="">
            </div>
         </div>
      </div>
   </div>
</div>
<div class="testimonial-section">
   <div class="container">
      <div class="testimonial-section-header wow fadeInUp">
         <h6>Testimonial</h6>
         <h2>Check Our Client Feedback</h2>
         <p class="testimonial-section-paragraph">
            Help agencies to define their new business objectives and then create professional software.
         </p>
      </div>
      <div class="rowr feedback-sliderr testimonial-row wow fadeInUp" data-wow-delay="0.2s">
         <div class="col px-3">
            <div class="testimonial-box">
               <div class="icon-wraper">
                  <div class="overlay-box"></div>
                  <div class="icon-box">
                     <img src="{{asset('frontend')}}/assets/images/SkogDkW61704874956.png" alt="">
                  </div>
               </div>
               <div class="counter-content">
                  <div class="left-quotes">
                     <svg xmlns="http://www.w3.org/2000/svg" width="44" height="40" viewBox="0 0 44 40"
                        fill="none">
                        <path
                           d="M1.0085 27.7571C1.0085 33.016 5.27144 37.279 10.5303 37.279C15.7892 37.279 20.0521 33.016 20.0521 27.7571C20.0521 22.4982 15.7892 18.2353 10.5303 18.2353C9.4495 18.2353 8.41495 18.4238 7.44645 18.7558C9.58926 6.4662 19.1728 -1.45917 10.2889 5.06357C0.438003 12.2966 0.997954 27.4661 1.00898 27.7441C1.00898 27.7485 1.0085 27.7523 1.0085 27.7571Z"
                           fill="white" />
                        <path
                           d="M23.9568 27.7571C23.9568 33.016 28.2197 37.279 33.4786 37.279C38.7375 37.279 43.0005 33.016 43.0005 27.7571C43.0005 22.4982 38.7375 18.2353 33.4785 18.2353C32.3977 18.2353 31.3632 18.4238 30.3947 18.7558C32.5375 6.4662 42.121 -1.45917 33.2371 5.06357C23.3863 12.2966 23.9461 27.4661 23.9572 27.7441C23.9572 27.7485 23.9568 27.7523 23.9568 27.7571Z"
                           fill="white" />
                     </svg>
                  </div>
                  <h5>Michael Jenkins JR.</h5>
                  <p>
                     <span>Replacing a maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create. Replacing a maintains the amount of lines. When replacing a selection. </span>
                  </p>
                  <div class="right-quotes">
                     <svg xmlns="http://www.w3.org/2000/svg" width="44" height="40" viewBox="0 0 44 40"
                        fill="none">
                        <path
                           d="M42.9915 12.2429C42.9915 6.98397 38.7286 2.72103 33.4697 2.72103C28.2108 2.72103 23.9479 6.98397 23.9479 12.2429C23.9479 17.5018 28.2108 21.7647 33.4697 21.7647C34.5505 21.7647 35.5851 21.5762 36.5535 21.2442C34.4107 33.5338 24.8272 41.4592 33.7111 34.9364C43.562 27.7034 43.002 12.5339 42.991 12.2559C42.991 12.2515 42.9915 12.2477 42.9915 12.2429Z"
                           fill="white" />
                        <path
                           d="M20.0432 12.2429C20.0432 6.98397 15.7803 2.72103 10.5214 2.72103C5.26247 2.72103 0.999527 6.98397 0.999527 12.2429C0.999527 17.5018 5.26255 21.7647 10.5215 21.7647C11.6023 21.7647 12.6368 21.5762 13.6053 21.2442C11.4625 33.5338 1.87898 41.4592 10.7629 34.9364C20.6137 27.7034 20.0539 12.5339 20.0428 12.2559C20.0428 12.2515 20.0432 12.2477 20.0432 12.2429Z"
                           fill="white" />
                     </svg>
                  </div>
               </div>
            </div>
         </div>
         <div class="col px-3">
            <div class="testimonial-box">
               <div class="icon-wraper">
                  <div class="overlay-box"></div>
                  <div class="icon-box">
                     <img src="{{asset('frontend')}}/assets/images/bkkVubWo1704875037.png" alt="">
                  </div>
               </div>
               <div class="counter-content">
                  <div class="left-quotes">
                     <svg xmlns="http://www.w3.org/2000/svg" width="44" height="40" viewBox="0 0 44 40"
                        fill="none">
                        <path
                           d="M1.0085 27.7571C1.0085 33.016 5.27144 37.279 10.5303 37.279C15.7892 37.279 20.0521 33.016 20.0521 27.7571C20.0521 22.4982 15.7892 18.2353 10.5303 18.2353C9.4495 18.2353 8.41495 18.4238 7.44645 18.7558C9.58926 6.4662 19.1728 -1.45917 10.2889 5.06357C0.438003 12.2966 0.997954 27.4661 1.00898 27.7441C1.00898 27.7485 1.0085 27.7523 1.0085 27.7571Z"
                           fill="white" />
                        <path
                           d="M23.9568 27.7571C23.9568 33.016 28.2197 37.279 33.4786 37.279C38.7375 37.279 43.0005 33.016 43.0005 27.7571C43.0005 22.4982 38.7375 18.2353 33.4785 18.2353C32.3977 18.2353 31.3632 18.4238 30.3947 18.7558C32.5375 6.4662 42.121 -1.45917 33.2371 5.06357C23.3863 12.2966 23.9461 27.4661 23.9572 27.7441C23.9572 27.7485 23.9568 27.7523 23.9568 27.7571Z"
                           fill="white" />
                     </svg>
                  </div>
                  <h5>Alinor Rose</h5>
                  <p>
                     <span>Replacing a maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create. Replacing a maintains the amount of lines. When replacing a selection. </span>
                  </p>
                  <div class="right-quotes">
                     <svg xmlns="http://www.w3.org/2000/svg" width="44" height="40" viewBox="0 0 44 40"
                        fill="none">
                        <path
                           d="M42.9915 12.2429C42.9915 6.98397 38.7286 2.72103 33.4697 2.72103C28.2108 2.72103 23.9479 6.98397 23.9479 12.2429C23.9479 17.5018 28.2108 21.7647 33.4697 21.7647C34.5505 21.7647 35.5851 21.5762 36.5535 21.2442C34.4107 33.5338 24.8272 41.4592 33.7111 34.9364C43.562 27.7034 43.002 12.5339 42.991 12.2559C42.991 12.2515 42.9915 12.2477 42.9915 12.2429Z"
                           fill="white" />
                        <path
                           d="M20.0432 12.2429C20.0432 6.98397 15.7803 2.72103 10.5214 2.72103C5.26247 2.72103 0.999527 6.98397 0.999527 12.2429C0.999527 17.5018 5.26255 21.7647 10.5215 21.7647C11.6023 21.7647 12.6368 21.5762 13.6053 21.2442C11.4625 33.5338 1.87898 41.4592 10.7629 34.9364C20.6137 27.7034 20.0539 12.5339 20.0428 12.2559C20.0428 12.2515 20.0432 12.2477 20.0432 12.2429Z"
                           fill="white" />
                     </svg>
                  </div>
               </div>
            </div>
         </div>
         <div class="col px-3">
            <div class="testimonial-box">
               <div class="icon-wraper">
                  <div class="overlay-box"></div>
                  <div class="icon-box">
                     <img src="{{asset('frontend')}}/assets/images/PfPouLT41704875060.png" alt="">
                  </div>
               </div>
               <div class="counter-content">
                  <div class="left-quotes">
                     <svg xmlns="http://www.w3.org/2000/svg" width="44" height="40" viewBox="0 0 44 40"
                        fill="none">
                        <path
                           d="M1.0085 27.7571C1.0085 33.016 5.27144 37.279 10.5303 37.279C15.7892 37.279 20.0521 33.016 20.0521 27.7571C20.0521 22.4982 15.7892 18.2353 10.5303 18.2353C9.4495 18.2353 8.41495 18.4238 7.44645 18.7558C9.58926 6.4662 19.1728 -1.45917 10.2889 5.06357C0.438003 12.2966 0.997954 27.4661 1.00898 27.7441C1.00898 27.7485 1.0085 27.7523 1.0085 27.7571Z"
                           fill="white" />
                        <path
                           d="M23.9568 27.7571C23.9568 33.016 28.2197 37.279 33.4786 37.279C38.7375 37.279 43.0005 33.016 43.0005 27.7571C43.0005 22.4982 38.7375 18.2353 33.4785 18.2353C32.3977 18.2353 31.3632 18.4238 30.3947 18.7558C32.5375 6.4662 42.121 -1.45917 33.2371 5.06357C23.3863 12.2966 23.9461 27.4661 23.9572 27.7441C23.9572 27.7485 23.9568 27.7523 23.9568 27.7571Z"
                           fill="white" />
                     </svg>
                  </div>
                  <h5>Akash Ahmed jibon</h5>
                  <p>
                     <span>Replacing a maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create. Replacing a maintains the amount of lines. When replacing a selection. </span>
                  </p>
                  <div class="right-quotes">
                     <svg xmlns="http://www.w3.org/2000/svg" width="44" height="40" viewBox="0 0 44 40"
                        fill="none">
                        <path
                           d="M42.9915 12.2429C42.9915 6.98397 38.7286 2.72103 33.4697 2.72103C28.2108 2.72103 23.9479 6.98397 23.9479 12.2429C23.9479 17.5018 28.2108 21.7647 33.4697 21.7647C34.5505 21.7647 35.5851 21.5762 36.5535 21.2442C34.4107 33.5338 24.8272 41.4592 33.7111 34.9364C43.562 27.7034 43.002 12.5339 42.991 12.2559C42.991 12.2515 42.9915 12.2477 42.9915 12.2429Z"
                           fill="white" />
                        <path
                           d="M20.0432 12.2429C20.0432 6.98397 15.7803 2.72103 10.5214 2.72103C5.26247 2.72103 0.999527 6.98397 0.999527 12.2429C0.999527 17.5018 5.26255 21.7647 10.5215 21.7647C11.6023 21.7647 12.6368 21.5762 13.6053 21.2442C11.4625 33.5338 1.87898 41.4592 10.7629 34.9364C20.6137 27.7034 20.0539 12.5339 20.0428 12.2559C20.0428 12.2515 20.0432 12.2477 20.0432 12.2429Z"
                           fill="white" />
                     </svg>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="cta">
   <div class="container">
      <div class="cta-container">
         <div class="cta-rows">
            <div class="row ">
               <div class="col-lg-6 col-md-12">
                  <div class="cta-content">
                     <h2>Start Your Financial Journey Today</h2>
                     <p>
                        <span data-metadata="<!--(figmeta)eyJmaWxlS2V5IjoiMWRNSU9Pd0g1N3diVkZONXBBdXg0bSIsInBhc3RlSUQiOjU3MjUyODcsImRhdGFUeXBlIjoic2NlbmUifQo=(/figmeta)-->"></span><span data-buffer="<!--(figma)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(/figma)-->"></span><span style="white-space-collapse: preserve;">Deserunt hic consequatur ex placeat! atque repellend us inventore quisquam, perferendis.</span>
                     </p>
                     <a href="https://codecanyon.net/user/geniusocean/portfolio"
                        class="template-btn-cta white-btn-cta position-relative cta-btn z-1">
                     Join With Us                            </a>
                  </div>
               </div>
               <div class="col-lg-6 col=md-12">
                  <img class="cta-img" src="{{asset('frontend')}}/assets/images/T7cRdMQk1704874850.png" alt="">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
