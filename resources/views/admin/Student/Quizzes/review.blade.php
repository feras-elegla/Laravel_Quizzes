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
                            <li class="breadcrumb-item"><a href=""> المراجعه الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item active">مراجعه سؤال رئيسي
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
                                <h4 class="card-title" id="basic-layout-form"> مراجعه سؤال رئيسي </h4>
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

                                    <form class="form" action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> Data Review Quizzes </h4>

                                            <!-- ----------------------------------- -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h1 for="projectinput1" style="display: block;font-weight: bolder;" class="text-center">......Quizze ......</h1>
                                                    </div>
                                                </div>
                                            </div>


                                            @foreach($quizze_question as $key =>$question)
                                            <h3 for="projectinput1" style="display: block;font-weight: bolder;">{{$question[0]->Question_title}}</h3>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        @foreach($question[0]->answers as $answer)
                                                        <div>
                                                            <input type="radio" @if($question[0]->student_answer == $answer->id) checked @endif disabled >
                                                            <label @if($question[0]->student_answer == $answer->id &&  $question[0]->iscorrect ) class="text-success"  @endif
                                                            @if($question[0]->student_answer == $answer->id &&  !$question[0]->iscorrect ) class="text-danger"  @endif for="projectinput1">{{$answer->title }}</label>
                                                        </div>
                                                        @endforeach
                                                        @foreach($question[0]->answers as $answer)
                                                        @if($answer->iscorrect)
                                                        <h4 class="text-success"> Correct Answer : {{$answer->title}}</h4>
                                                        @endif
                                                        @endforeach
                                                        @error("answer")
                                                        <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach


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
