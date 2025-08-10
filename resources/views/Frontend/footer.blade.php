<footer class="footer-section" data-background="{{asset('frontend')}}/assets/front/images/Footer-bg.png">
   <div class="container">
      <div class="footer-tops">
         <div class="row gap-4 gap-md-0 footer-section-row">
            <div class="col-xl-4 col-lg-3 col-md-6 wow fadeInLeft" data-wow-delay="0.1s">
               <div class="footer-logo">
                  <img src="{{asset('frontend')}}/assets/images/WrK86hHx1659607850.png" alt="">
               </div>
               <div class="footer-paragraph">
                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo...</p>
               </div>
               <div class="footer-socials-icons">
                  <div class="d-flex gap-2 social-links">
                     <a class="common-icon" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                     <a class="common-icon" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                     <a class="common-icon" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                  </div>
               </div>
            </div>
            <div class="col-xl-2 offset-xl-1 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
               <div class="footer-links ">
                  <h5 class="p-0 m-0">Useful Links</h5>
                  <hr class="m-0 p-0">
                  <ul>
                     <li>
                        <a href="provicay.html">Privacy Policy</a>
                     </li>
                     <li>
                        <a href="support-policy.html">Support</a>
                     </li>
                     <li>
                        <a href="terms.html">Terms Condition</a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
               <div class="footer-links ">
                  <h5 class="p-0 m-0">Company</h5>
                  <hr class="m-0 p-0 footer-company-hr">
                  <ul>
                     <li><a href="https://demo.geniusocean.com/hyip-king"
                        target="_self">Home</a>
                     </li>
                     <li><a href="about.html"
                        target="_self">About</a>
                     </li>
                     <li><a href="plans.html"
                        target="_self">Plans</a>
                     </li>
                     <li><a href="blogs.html"
                        target="_self">Blog</a>
                     </li>
                     <li><a href="contact.html"
                        target="_self">Contact Us</a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
               <div class="footer-contact">
                  <h5 class="p-0 m-0">Contact Us</h5>
                  <hr class="m-0 p-0 footer-contact-hr">
                  <ul>
                     <li><i class="fas fa-phone-alt px-1"></i> +0123456789</li>
                     <li><i class="fas fa-envelope px-1"></i>admin@geniusocean.com</li>
                     <li><i class="fas fa-map-marker-alt px-1"></i> New York, United States</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <hr class="bottom-footer-top-hr">
   <div class="footer-bottom">
      <p>COPYRIGHT © {{ \Carbon\Carbon::now()->format('Y') }}.All Rights Reserved By <a href="#">priceticketbazar.com</a></p>
   </div>
</footer>
<!-- Invest Modal -->
<div class="modal modal-position fade" id="invest-modal">
   <div class="modal-dialog">
      <div class="modal-content model-area">
         <form class="investForm modal-form" action="https://demo.geniusocean.com/hyip-king/user/invest/amount" method="POST">
            <input type="hidden" name="_token" value="Gety1CLWTuqmcpc0MjWKHAV1zB7MfyVZDAr9wSFy" autocomplete="off">
            <div class="modal-body p-4">
               <h4 class="modal-title text-center plan-title">Basic Plan</h4>
               <div class="pt-3 pb-1">
                  <label for="amount" class="form-label">Enter Amount</label>
                  <div class="input-group input--group">
                     <input type="number" step="any" name="amount"
                        class="form-group-input form-control form--control bg--section" placeholder="0.00"
                        id="modalAmount">
                     <button type="button" class="input-group-text">USD</button>
                  </div>
                  <label for="amount" class="form-label">Select Wallet</label>
                  <div class="input-group input--group">
                     <select name="wallet" id="investMethod" class="forms nice_select w-100 rounded"
                        required>
                        <option value="checkout">Checkout</option>
                        <option value="main_wallet">Main Balance</option>
                        <option value="interest_wallet">Interest Balance</option>
                     </select>
                  </div>
               </div>
               <input type="hidden" name="investId" id="investId" value="">
               <div class="d-flex gap-3 modal-btns">
                  <button type="button" class="template-btn primary-outline w-50"
                     data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="template-btn primary-btn w-50">Proceed</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!--Esential Js Files-->
<script src="{{asset('frontend')}}/assets/front/js/jquery.min.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/popper.min.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/bootstrap.min.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/slick.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/jquery-ui.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/nice-select.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/wow.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/parallax.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/tilt-js.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/waypoints.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/counterup.min.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/preloader.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/script.js"></script>
<script src="{{asset('frontend')}}/assets/front/js/custom.js"></script>
<script>
   'use strict';
   let mainurl = '#';
   let tawkto = '0';
</script>
<script type="text/javascript">
   if (tawkto == 1) {
       var Tawk_API = Tawk_API || {},
           Tawk_LoadStart = new Date();
       (function() {
           var s1 = document.createElement("script"),
               s0 = document.getElementsByTagName("script")[0];
           s1.async = true;
           s1.src = 'https://embed.tawk.to/5bc2019c61d0b77092512d03/default';
           s1.charset = 'UTF-8';
           s1.setAttribute('crossorigin', '*');
           s0.parentNode.insertBefore(s1, s0);
       })();
   }
</script>
<script>
   'use strict';





</script>
<script>
   'use strict';

   $('.invest-plan').on('click', function() {
       $('#modalAmount').val('');
       $('#modalAmount').prop('readonly', false)

       let id = $(this).data('id');
       let title = $(this).data('title');
       let type = $(this).data('type');

       if (type == 1) {
           $('#modalAmount').val($(this).attr('data-fixAmount'));
           $('#modalAmount').prop('readonly', true)
       }
       $('#investId').val(id);
       $('.plan-title').text(title);
   });

   $(document).on('change', '#investMethod', function() {
       var val = $(this).val();
       if (val == 'checkout') {
           $('.investForm').prop('action', 'user/invest/amount.html');
       }

       if (val == 'main_wallet') {
           $('.investForm').prop('action', 'user/invest/main.html');
       }

       if (val == 'interest_wallet') {
           $('.investForm').prop('action', 'user/invest/interest.html');
       }
   });
</script>
</body>
</html>
