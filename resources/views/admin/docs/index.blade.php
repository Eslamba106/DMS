@extends('layouts.dashboard')

@section('title')
    {{ __('roles.roles') }}
@endsection


@section('page_name')
    {{ __('roles.all_roles') }}
@endsection
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('departments.departments') }}</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('dashboard.home') }} </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('dashboard.dashboard') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="m-2 d-inline">
        <a href="" class="btn  btn-sm btn-outline-primary mr-2 mb-4"  data-excel_id=""
            data-toggle="modal" data-target="#excel_id">{{ __('documents.add_document') }}</a>
    </div>
    <div class="modal fade" id="excel_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('documents.add_document') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">{{ __('documents.name') }}</label>
                                <input class="form-control" type="text" name="name">
                                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('departments.departments') }}</label>
                                <select class="form-control" name="department_id" >
                                    <option value="0">{{ __('departments.departments') }}</option>
                                    @foreach ($departments as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="form-group">
                                <label for="">{{ __('documents.file') }}</label>
                                <input class="form-control" type="file" name="file_path">
                                @error('file_path') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('dashboard.cancel') }}</button>
                            <button type="submit" class="btn btn-success">{{ __('dashboard.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5"></div>
    <form action="" method="get">

    <div class="col-12">
        <div class="card">
            <div class="input-group mb-3 d-flex justify-content-end">

            <button type="submit" name="bulk_action_btn" value="delete" class="btn btn-danger delete_confirm mt-3 {{ (Session::get('locale') == 'en') ?  "mr-2" : "ml-2"}}"> <i class="la la-trash"></i> {{__('dashboard.delete')}}</button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input class="bulk_check_all" type="checkbox" /></th>
                            <th scope="col">{{ __('roles.name') }}</th>
                            <th scope="col">{{ __('roles.Actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($documents as $department)
                            <tr>
                                <th scope="row">
                                    <label>
                                        <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                            value="{{ $department->id }}" />
                                        <span class="text-muted">#{{ $department->id }}</span>
                                    </label>
                                </th>
                                <td>{{ $department->name }}</td>
                                <td>
                                    {{-- <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-primary btn-sm"><i
                                        title="@lang('dashboard.edit')" class="fa fa-edit"></i> </a> --}}
                                    <a href="{{ route('documents.show', $department->id) }}" class="btn btn-outline-info btn-sm"
                                        title="@lang('dashboard.show')" target="_blank"><i class="fa fa-eye"></i> </a>
                                    <a href="{{ route('departments.delete', $department->id) }}" class="btn btn-danger btn-sm"
                                        title="@lang('dashboard.delete')"><i class="fa fa-trash"></i> </a>
                            
                                </td>
                                {{-- <td> <span
                                        class="badge badge-pill {{ $user->status == 'active' ? 'badge-success' : 'badge-danger' }}">{{ $user->status }}</span>
                                </td> --}}
                                {{-- <td>{{ $user->role_name }} </td>
                        <td>{{ $user->email }}</td> --}}
                            </tr>
                        @empty
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </form>
    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            swal("Message", "{{ Session::get('info') }}", 'info', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            swal("Message", "{{ Session::get('error') }}", 'danger', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
@endsection
