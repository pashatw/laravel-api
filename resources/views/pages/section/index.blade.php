@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Section</h1>
            <a href="{{route('section.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Create Data
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
                        <h6 class="m-0 font-weight-bold text-primary">List</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="sectionTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Task</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->
@stop

@section('script_extra')
    <script type="text/javascript">
        $(document).ready(function(){ 
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

                        $('#sectionTable tbody').html('');

                        $.each(response.payload, function(i, item) {
                            $('<tr>').html(
                                '<td>'+item.section_name+'</td>'+
                                '<td>'+item.task.length+'</td>'+
                                '<td>'+
                                    '<a href="{{route('section.detail')}}/'+item.id+'" class="d-none d-sm-inline-block btn btn-sm btn-default shadow-sm">Detail</a> '+
                                    '<a href="{{route('section.edit')}}/'+item.id+'" class="d-none d-sm-inline-block btn btn-sm btn-default shadow-sm"><i class="fas fa-pencil-alt fa-sm"></i> Edit</a> '+
                                    '<a href="#" data-id="'+item.id+'" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm sectionDelete"><i class="fas fa-trash-alt fa-sm"></i> Delete</a>'+
                                '</td>'
                            ).appendTo('#sectionTable tbody');
                        });
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

            $('#sectionTable').on('click', '.sectionDelete', function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                console.log('delete', id);

                if (confirm("Section will be deleted?")) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('ajax.section.delete')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id' : id
                        },
                        success: function(response) {
                            getSection()
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log(xhr, ajaxOptions, thrownError)
                            var response = xhr.responseJSON;
                            if (response != null) {
                                alert(response?.message)
                            }
                        }
                    });
                }else{
                    return false;
                }
            })
        });
    </script>
@stop