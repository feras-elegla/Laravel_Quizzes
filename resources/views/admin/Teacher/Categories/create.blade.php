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
                            <li class="breadcrumb-item"><a href=""> الاقسام الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item active">إضافة قسم رئيسي
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
                                <h4 class="card-title" id="basic-layout-form"> إضافة قسم رئيسي </h4>
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

                                    <form class="form" id="formdata" action="{{route('categoris.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> Data Category </h4>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Category Name </label>
                                                        <input type="text" value="" id="name" class="form-control" placeholder="  " name="name">
                                                        @error("name")
                                                        <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Category Type</label>
                                                        <select class="form-control category" name="type">
                                                            <option value="Grade" selected>
                                                                Grade
                                                            </option>
                                                            <option value="Course">
                                                                Course
                                                            </option>
                                                            <option value="Unit">
                                                                Unit
                                                            </option>
                                                            <option value="Lesson">
                                                                Lesson
                                                            </option>

                                                        </select>
                                                        @error("type")
                                                        <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ----------------------------------------------------------------------------------
                                         -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Category Type</label>
                                                        <select class="form-control parent_id" name="parent_id" style="display: none;">

                                                        </select>
                                                        @error("parent_id")
                                                        <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ************************************************************************************************************** -->


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
<script src="./Library/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        // --------------------------
        $(".category").change(function(e) {

            e.preventDefault();
            var formdata = new FormData($("#formdata")[0]);

            $.ajax({
                type: 'post',
                url: "{{route('categoris.getCategory')}}",
                enctype: "multipart/form-data",
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    $('.parent_id').show();
                    $('.parent_id').children().remove().end()
                    data.category.forEach(element => {
                        $(".parent_id").append("<option value=" + element.id + ".>" + element.name + "</option>");
                    });




                },
                error: function(reject) {

                }
            })

        });
    });
</script>

@endsection
