@extends('layouts.admin')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-header">
{{--                        <h3 class="card-title">DataTable with default features</h3>--}}
                        <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm"  data-placement="left">
                            {{ __('Create New') }}
                        </a>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-sm">
                            Bulk Import
                        </button>
                        <a href="{{ route('departments.template') }}" class="btn btn-info btn-sm"  data-placement="left">
                            Download template
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @include('includes.alerts')
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>NAME</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($departments as $i=> $department)
                             <tr>
                            <td>{{ ++$i }}</td>

                            <td>{{ $department->name }}</td>

                            <td>
                                <form action="{{ route('departments.destroy',$department->id) }}" method="POST">
                                    <a class="btn btn-sm btn-primary " href="{{ route('departments.show',$department->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                    <a class="btn btn-sm btn-success" href="{{ route('departments.edit',$department->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                </form>
                            </td>
                             </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>NAME</th>
                                <th></th>

                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Departments</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('departments.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="input-group">
                        <div class="form-group">
                            <input type="file" class="form-control"  name="file" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button  type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
