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
                            <input id="section_id" class="form-control col-md-12 col-xs-12" name="section_id" type="hidden">

                            <div class="item form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="section_name">Section Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input id="section_name" class="form-control col-md-12 col-xs-12" name="section_name" placeholder="" type="text">
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
        var idSection = "{{@$id}}";
        if (idSection != null && idSection != '') {
            $.ajax({
                type: "POST",
                url: "{{route('ajax.section.get_by_id')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: idSection
                },
                success: function(response) {
                    console.log(response);
                    $("#section_name").val(response?.payload?.section_name)
                    $("#section_id").val(response?.payload?.id)
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
                'id' : $("#section_id").val(),
                'section_name' : $("#section_name").val(),
            }
            
            console.log('submit', data);

            $.ajax({
                type: "POST",
                url: "{{route('ajax.section.save')}}",
                data: data,
                success: function(response) {
                    console.log(response);
                    alert("Success");
                    window.location.href="{{route('section')}}";
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