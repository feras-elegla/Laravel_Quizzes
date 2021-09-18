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
                            <li class="breadcrumb-item"><a href=""> الكوزات الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item active">بيانات انتهاء الكوزات
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
                                <h4 class="card-title" id="basic-layout-form"> تفاصيل الاختبار </h4>
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

                                    <form class="form" action="{{route('quizzes')}}" method="GET" enctype="multipart/form-data">
                                        @csrf


                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> Data Quizzes </h4>
                                            <!-- ----------------------------------- -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <h1 for="projectinput1" style="display: block;font-weight: bolder;">...... Quizze {{ $quizze->id}}......</h1>
                                                            <label>This Quizzes is Start At {{ $quizze->start}}</label>
                                                            <br>
                                                                <label>This Quizzes is Closed At {{ $quizze->end}}</label>
                                                                <br>
                                                                    <label>Number of Question to this Exame is {{ $quizze->No_Question}}</label>
                                                                    <br>
                                                                        @if($quizze->total > ($quizze->No_Question/2))
                                                                             <label class="text-success">You are succsess in exame ... Final Grade is  {{ $quizze->total}}/{{$quizze->No_Question}}</label>
                                                                            @else
                                                                            <label class="text-danger">You are Faild in exame  Final Grade is {{ $quizze->total}}/{{$quizze->No_Question}}</label>
                                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i>  الرجوع الى قائمه الكوزات
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
