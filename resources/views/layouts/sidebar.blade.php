<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('root') }}">
                        <i class="ri-home-7-line"></i> <span>Home</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarEmployee" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarEmployee">
                        <i class="ri-map-pin-user-line"></i> <span>Employee</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarEmployee">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('personal-information.index') }}" class="nav-link">Personal
                                    Information</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('employee-bank.index') }}" class="nav-link">Bank Information</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('leave-request.index') }}" class="nav-link">Leave Request</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCareer" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCareer">
                        <i class="ri-bar-chart-fill"></i> <span>Career</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCareer">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('career-transition-history.index') }}" class="nav-link">Transition</a>
                            </li>
                        </ul>
                    </div>
                </li>

                @if (Auth::user()->hasNoParentJobPosition())
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarManagement" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarManagement">
                            <i class="ri-survey-line"></i> <span>Management</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarManagement">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('job-application.index') }}" class="nav-link">Recruitment</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('job-position.career-transition') }}" class="nav-link">Career
                                        Transition</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('retirement-request.index') }}" class="nav-link">Retirement
                                        Requests</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPayroll" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPayroll">
                        <i class="ri-secure-payment-line"></i> <span>Payroll</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPayroll">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('pay-slip.index') }}" class="nav-link">My Payroll</a>
                            </li>
                            @if (Auth::user()->hasNoParentJobPosition())
                                {{-- <li class="nav-item">
                                    <a href="#" class="nav-link">Payment Process</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('employee-payroll.index') }}" class="nav-link">Employee Payroll
                                        Data</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>

                @if (Auth::user()->hasNoParentJobPosition())
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarReport" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarReport">
                            <i class="ri-file-paper-2-line"></i> <span>Report</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarReport">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('pay-slip.generator') }}" class="nav-link">Payslip</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('retirement-request.generator') }}" class="nav-link">Retirement</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSetting" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarSetting">
                            <i class="ri-settings-line"></i> <span>Setting</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSetting">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#sidebarCompanySetting" class="nav-link" data-bs-toggle="collapse"
                                        role="button" aria-expanded="false"
                                        aria-controls="sidebarCompanySetting">Company Setting</a>
                                    <div class="collapse menu-dropdown" id="sidebarCompanySetting">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="{{ route('job-position.index') }}" class="nav-link">Job
                                                    Position</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('payroll-period.index') }}"
                                                    class="nav-link">Payroll Period</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="#sidebarMasterData" class="nav-link" data-bs-toggle="collapse"
                                        role="button" aria-expanded="false" aria-controls="sidebarMasterData">Master
                                        Data</a>
                                    <div class="collapse menu-dropdown" id="sidebarMasterData">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="{{ route('users.index') }}" class="nav-link">Users</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Roles</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Bank</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>

<div class="vertical-overlay"></div>
