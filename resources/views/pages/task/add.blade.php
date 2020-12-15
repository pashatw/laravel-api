@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="justify-content-between mb-4">
            <a href="#" id="backBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
            </a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Col -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Form</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form class="form-horizontal form-label-left" id="sectionFrom" method="POST" novalidate>
                            <input id="task_id" class="form-control col-md-12 col-xs-12" name="task_id" type="hidden">

                            <div class="item form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="section_id">Section</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select class="form-control col-md-12 col-xs-12" id="section_id"></select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="task_name">Task Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input id="task_name" class="form-control col-md-12 col-xs-12" name="task_name" placeholder="" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="task_state">State</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select class="form-control col-md-12 col-xs-12" id="task_state">
                                        <option value="1">To-do</option>
                                        <option value="2">Done</option>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <a href="#" id="submitSection" form="sectionFrom" class="d-inline btn btn-primary">Save</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->
@stop

@section('script_extra')
    <script type="text/javascript">
        var idTask = "{{@$id}}";
        var idSection = null;

        getSection();

        function getSection() {
            $.ajax({
                type: "POST",
                url: "{{route('ajax.section.get_all')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response)

                    var html_results = "";
                    $.each(response.payload, function (i, row) {
                        html_results += "<option value='"+row.id+"'>"+row.section_name+"</option>";
                    });
                    $('#section_id').html(html_results);

                    if (idSection != null) {
                        $("#section_id").val(idSection)
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr, ajaxOptions, thrownError)
                    var response = xhr.responseJSON;
                    if (response != null) {
                        alert(response?.message)
                    }
                }
            });
        }

        if (idTask != null && idTask != '') {
            $.ajax({
                type: "POST",
                url: "{{route('ajax.task.get_by_id')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: idTask
                },
                success: function(response) {
                    console.log(response);
                    $("#task_name").val(response?.payload?.task_name)
                    $("#task_id").val(response?.payload?.id)
                    idSection = response?.payload?.section_id;
                    $("#section_id").val(idSection);
                    $("#task_state").val(response?.payload?.task_state);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr, ajaxOptions, thrownError)
                    var response = xhr.responseJSON;
                    if (response != null) {
                        alert(response?.message)
                    }
                }
            });
        }

        $('#submitSection').on('click', function(e){
            e.preventDefault();

            var data = {
                "_token": "{{ csrf_token() }}",
                'id' : $("#task_id").val(),
                'section_id' : $("#section_id").val(),
                'task_name' : $("#task_name").val(),
                'task_state' : $("#task_state").val(),
            }
            
            console.log('submit', data);

            $.ajax({
                type: "POST",
                url: "{{route('ajax.task.save')}}",
                data: data,
                success: function(response) {
                    console.log(response);
                    alert("Success");
                    window.location.href="{{route('task')}}";
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr, ajaxOptions, thrownError)
                    var response = xhr.responseJSON;
                    if (response != null) {
                        alert(response?.message)
                    }
                }
            });
        });
    </script>
@stop