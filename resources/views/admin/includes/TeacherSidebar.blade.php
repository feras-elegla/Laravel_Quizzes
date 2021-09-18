<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href=""><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <!-- --------------------------------- -->
            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> Controll Teahers </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\User::where('type','teacher')->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('teachers')}}"
                                          data-i18n="nav.dash.ecommerce">  Show Teachers </a>
                    </li>
                    <li><a class="menu-item" href="{{route('teachers.create')}}" data-i18n="nav.dash.crypto">Add Teacher
                              </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> Controll Student </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\User::where('type','student')->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('students')}}"
                                          data-i18n="nav.dash.ecommerce">  Show Students </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> Controll Categoris   </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Category::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('categoris')}}"
                                          data-i18n="nav.dash.ecommerce"> Show Categoris  </a>
                    </li>
                    <li><a class="menu-item" href="{{route('categoris.create')}}" data-i18n="nav.dash.crypto">
                            Add Category   </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Controll Quesstions  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Question::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('questions')}}"
                                          data-i18n="nav.dash.ecommerce"> Show Quesstions</a>
                    </li>
                    <li><a class="menu-item" href="{{route('questions.create')}}
                    " data-i18n="nav.dash.crypto">
                    Add Quesstion  </a>
                    </li>
                </ul>
            </li>
  <!-- ------------------------------ -->
                     <li class="nav-item"><a href=""><i class="la la-cogs"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> setting    </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{Auth::user()->name}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('profiles')}}"
                                          data-i18n="nav.dash.ecommerce"> Show Information </a>
                    </li>
                    <li><a class="menu-item" href="{{route('profiles.edit')}}
                    " data-i18n="nav.dash.crypto">
                    Upadte Information Profile   </a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</div>
