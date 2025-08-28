<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('backend')}}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Snacked</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}" >
                <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>
        <li>
            <a href="{{ route('slider.index') }}">
                <div class="parent-icon"><i class="fas fa-sliders-h"></i></div>
                <div class="menu-title">Slider</div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-cash-coin"></i></div>
                <div class="menu-title">Commission</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('commissionsetting.index') }}">
                        <i class="bi bi-circle"></i> Commission Settings
                    </a>
                </li>
            </ul>
        </li>
            <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-wallet2"></i></div>
                <div class="menu-title">Waletesetting Create</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('waletesetting.index') }}">
                        <i class="bi bi-circle"></i>Waletesetting
                    </a>
                </li>
            </ul>
        </li>


           <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bi bi-cash-stack"></i></div>
                    <div class="menu-title">Deposit Approve</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('approve.index') }}">
                            <i class="bi bi-circle"></i> Deposit List
                        </a>
                    </li>
                </ul>
            </li>
             <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bi bi-cash-stack"></i></div>
                    <div class="menu-title">Lottery</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('lottery.index') }}">
                            <i class="bi bi-ticket-perforated"></i> Lottery Create
                        </a>
                    </li>
                </ul>
            </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="menu-title">Why Choose Us Investment</div>
            </a>
            <ul>
                <li><a href="{{route('whychooseusinvesment.index')}}"><i class="bi bi-circle"></i>Why Choose Us Investment</a></li>
            </ul>
        </li>

           <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bi bi-info-circle"></i></div>
                    <div class="menu-title">About Us</div>
                </a>
                <ul>
                    <li> <a href="{{route('aboutus.index')}}"><i class="bi bi-circle"></i>About Us</a></li>
                </ul>
            </li>


            <li>
                <a href="{{ route('counter.index') }}">
                    <div class="parent-icon"><i class="bi bi-speedometer2"></i></i></div>
                    <div class="menu-title">counter</div>
                </a>
            </li>
             <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-gear-fill"></i></div>
                        <div class="menu-title">Settings</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('settings.index')}}" target="_blank">
                                <i class="bi bi-circle"></i>Settings
                            </a>
                        </li>
                         <li>
                            <a href="{{route('privacypolicy.index')}}" target="_blank">
                                <i class="bi bi-circle"></i>privacypolicy
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bi bi-envelope-fill"></i></div>
                    <div class="menu-title">Contact</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('contact.index') }}" target="_blank">
                            <i class="bi bi-circle"></i> Contact
                        </a>
                    </li>
                </ul>
            </li>
       <li>
            <a href="{{ route('partner.index') }}">
                <div class="parent-icon"><i class="bi bi-people"></i></div>
                <div class="menu-title">Partner</div>
            </a>
        </li>


        <li>
            <a href="{{ route('Termscondition.index') }}">
                <div class="parent-icon"><i class="bi bi-file-text-fill"></i></div>
                <div class="menu-title">Terms & Conditions</div>
            </a>
        </li>

        <li>
            <a href="javascript:;">
                <div class="parent-icon"><i class="bi bi-telephone-fill"></i></div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    /* Hide submenus initially */
    .metismenu ul {
        display: none;
    }

    /* Highlight active menu */
    .metismenu .has-arrow.active {
        background-color: #f1f1f1;
    }

    /* Pointer cursor on clickable menu */
    .metismenu .has-arrow {
        cursor: pointer;
    }
</style>

<script>
$(document).ready(function(){
    $('.metismenu .has-arrow').on('click', function(e){
        e.preventDefault();
        let $this = $(this);

        // Accordion effect (close others)
        $('.metismenu .has-arrow').not($this).removeClass('active').next('ul').slideUp();

        // Toggle current menu
        $this.toggleClass('active');
        $this.next('ul').slideToggle(200);
    });
});
</script>
