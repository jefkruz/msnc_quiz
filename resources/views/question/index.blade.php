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

                                <a href="{{ route('questions.create') }}" class="btn btn-primary btn-sm "  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
{{--                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-sm">--}}
{{--                                Bulk Import--}}
{{--                            </button>--}}
{{--                            <a href="{{ route('questions.template') }}" class="btn btn-info btn-sm"  data-placement="left">--}}
{{--                                <i class="fe fe-download fs-14"></i>--}}
{{--                                Download template--}}
{{--                            </a>--}}

                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            @include('includes.alerts')
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th>S/N</th>

										<th>QUESTION</th>
										<th>Options</th>
										<th>ANSWER</th>


                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $i =>$question)
                                        <tr>
                                            <td>{{ ++$i }}</td>


											<td>{{ $question->question }}</td>
											<td>
                                                @php
                                                $options = json_decode($question->options);
                                                @endphp
                                                @foreach ($options as $option)
                                                    <span class="badge badge-primary p-2">{{$option}}</span>
                                                @endforeach
{{--                                                {{ $question->options }} --}}
                                            </td>
											<td>
                                                <span class="badge badge-info p-2">{{$options[$question->answer]}}</span>
                                            </td>


                                            <td>
                                                <form action="{{ route('questions.destroy',$question->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('questions.show',$question->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('questions.edit',$question->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Questions</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('questions.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Rank</label>
                            <select class="form-control select2" style="width: 100%;" name="rank_id">
                                @foreach($ranks as $data)
                                    <option value="{{$data->id}}">{{$data->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control select2" style="width: 100%;" name="category_id">
                                @foreach($categories as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">

                                <input type="file" class="form-control"  name="file" id="exampleInputFile">


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
