@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href=""> الاسئله الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item active">إضافة سؤال رئيسي
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> إضافة سؤال رئيسي </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body">

                                    <form class="form" action="{{route('quizzes.getQuizzes')}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> Data Quizzes </h4>
                                                      <!-- ----------------------------------- -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1" style="display: block;">Add Answers</label>
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- ----------------------------------------- -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Category select</label>
                                                        <select class="form-control" name="category_id" >
                                                            @foreach($root_Categoris as $rootcat)
                                                            <option value="{{$rootcat->id}}" >
                                                            {{$rootcat->name}}
                                                            </option>
                                                            @foreach($rootcat->childern as $sub_1_rootcat)
                                                            <option value="{{$sub_1_rootcat->id}}" >
                                                            {{$rootcat->name}}/{{$sub_1_rootcat->name}}
                                                            </option>
                                                            @foreach($sub_1_rootcat->childern as $sub_2_rootcat)
                                                            <option value="{{$sub_2_rootcat->id}}" >
                                                            {{$rootcat->name}}/{{$sub_1_rootcat->name}}/{{$sub_2_rootcat->name}}
                                                            </option>
                                                            @foreach($sub_2_rootcat->childern as $sub_3_rootcat)
                                                            <option value="{{$sub_3_rootcat->id}}" >
                                                            {{$rootcat->name}}/{{$sub_1_rootcat->name}}/{{$sub_2_rootcat->name}}/{{$sub_3_rootcat->name}}
                                                            </option>
                                                            @endforeach
                                                            @endforeach
                                                            @endforeach
                                                            @endforeach

                                                        </select>
                                                        @error("type")
                                                        <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>







                                </div>


                                <div class="form-actions">
                                    <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                        <i class="ft-x"></i> تراجع
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> حفظ
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        <!-- // Basic form layout section end -->
    </div>
</div>
</div>


@endsection
