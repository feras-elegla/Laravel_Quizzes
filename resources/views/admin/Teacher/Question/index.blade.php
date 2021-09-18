@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الاقسام الرئيسية </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('teachers')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> الاقسام الرئيسية
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع الاقسام الرئيسية </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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
                                    <div class="card-body card-dashboard">
                                        @foreach($questions as $question)
                                        <h3 for="projectinput1" style="font-weight: bolder;">  {{$question->title }}</h3>
                                        <br> <br>
                                        @foreach($question->answers as $key => $question_answers)
                                        <div>
                                        <input type="checkbox"  @if($question_answers->iscorrect==1) checked @else disabled  @endif value="{{$question_answers->iscorrect}}" style="display: inline-block; width:3%;height:15px;padding-top:50px" class="form-control"  id="check" placeholder="  " name="answers.{{$key}}.iscorrect">
                                        <label for="projectinput1">{{$question_answers->title }}</label>
                                        </div>
                                           @endforeach
                                           <br><br>
                                           <a href="{{route('questions.edit',$question -> id)}}"
                                           class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Upadte</a>

                                           <a href="{{route('questions.delete',$question -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">Delete</a>


                                           <hr>
                                        @endforeach
                                        <div class="justify-content-center d-flex">



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
