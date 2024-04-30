<nav class="navbar navbar-expand-lg navbar-landing fixed-top job-navbar" id="navbar">
    <div class="container-fluid custom-container">
        <a class="navbar-brand" href="index">
            <img src="{{ URL::asset('build/images/logo-dark.png') }}" class="card-logo card-logo-dark"
                alt="logo dark" height="17">
            <img src="{{ URL::asset('build/images/logo-light.png') }}" class="card-logo card-logo-light"
                alt="logo light" height="17">
        </a>
        <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                <li class="nav-item">
                    <a class="nav-link fs-14 active" href="#hero">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-14" href="#process">Process</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-14" href="#categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-14" href="#findJob">Find Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-14" href="#candidates">Candidates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-14" href="#blog">Submit Application</a>
                </li>
            </ul>

            <div class="">
                <a href="auth-signin-basic" class="btn btn-soft-primary"><i
                        class="ri-user-3-line align-bottom me-1"></i> Login & Register</a>
            </div>
        </div>

    </div>
</nav>