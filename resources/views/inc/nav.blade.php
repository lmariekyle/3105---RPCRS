
            <div class="sidebar m-2 h-100" id="side_nav">
                <div class="header-box px-2 pt-3">
                    <h1 class="fs-4 d-flex justify-content-center">
                        <span class="GIM">GIM</span>
                    </h1>
                    <ul class="list-unstyled px-2">
                    <li class="d-flex justify-content-center" >
                        <a href="/dashboard/home" class="text-decoration-none py-2 d-block">
                            <div class="d-flex justify-content-center">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <div class="GIMText">
                                Dashboard
                            </div>
                        </a>
                    </li>
                    <div class="space"></div>
                    <li class="active d-flex justify-content-center">
                        <a href="/members" class="text-decoration-none py-2 d-block">
                            <div class="d-flex justify-content-center">
                                <i class="fa-solid fa-dumbbell"></i>
                            </div>
                            <div class="GIMText">
                              Gym Members
                            </div>
                        </a>
                    </li>
                    <div class="space"></div>
                    <li class="d-flex justify-content-center">
                        <a href="/employees" class="text-decoration-none py-2 d-block">
                            <div class="d-flex justify-content-center">
                                <i class="fa-solid fa-user" ></i>
                            </div>
                            <div class="GIMText">
                                Employees
                            </div>
                        </a>
                    </li>
                    <div class="space"></div>
                    <li class="d-flex justify-content-center">
                        <a href="/classes" class="text-decoration-none py-2 d-block">
                            <div class="d-flex justify-content-center">
                              <i class="fa-solid fa-chalkboard"></i>
                            </div>
                            <div class="GIMText px-3">
                              Classes
                            </div>
                        </a>
                    </li>
                    <div class="space"></div>
                    <li class="d-flex justify-content-center">
                      <a href="/membership" class="text-decoration-none py-2 d-block">
                        <div class="d-flex justify-content-center">
                          <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="GIMText">
                          Membership
                        </div>
                      </a>
                    </li>
                    </ul>

                    <hr class="h-color mx-2"></hr>

                </div>
            </div>
<script>
    $(".sidebar ul li").on('click' , function(){
        $(".sidebar ul li.active").removeClass('active');
        $(this).addClass('active');
    });
</script>