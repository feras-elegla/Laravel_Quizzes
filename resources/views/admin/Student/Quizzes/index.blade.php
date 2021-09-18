@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الاختبارات الرئيسية </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('teachers')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> الاختبارات الرئيسية
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
                                    <h4 class="card-title">جميع الاختبارات الرئيسية </h4>
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
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>Id </th>
                                                <th> CategoryId</th>
                                                 <th>No_Question</th>
                                                 <th>Quizze_duration</th>
                                                 <th>total </th>
                                                 <th>start</th>
                                                 <th>end</th>
                                         <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($Quizzes)
                                                @foreach($Quizzes as $quizze)
                                                    <tr>
                                                        <td>{{$quizze->id}}</td>
                                                        <td>{{$quizze -> category_id}}</td>
                                                        <td>{{$quizze->No_Question}}</td>
                                                         <td>{{$quizze->Quizze_duration}}</td>
                                                         <td @if($quizze->total<($quizze->total/2)) class="text-danger" @else class="text-success" @endif>{{$quizze->total}}/{{$quizze->No_Question}}</td>
                                                        <td>{{$quizze -> start}}</td>
                                                        <td>{{$quizze->end}}</td>


                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('questions.review',$quizze -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">review</a>

                                                                <a href="{{route('questions.delete',$quizze -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">Delete</a>


                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
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
