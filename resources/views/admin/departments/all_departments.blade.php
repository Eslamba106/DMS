@extends('layouts.dashboard')

@section('title')
    {{ __('departments.departments') }}
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
    <a href="{{route('departments.create_department')}}" class="{{ (Session::get('locale') == 'en') ?  "ml-1" : "mr-1"}}  mt-3 mb-2 btn btn-primary btn-xl" data-toggle="tooltip" title="@lang('dashboard.create')"> <i class="fa fa-plus"></i> </a>

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
                        @forelse ($departments as $department)
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
                                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-primary btn-sm"><i
                                        title="@lang('dashboard.edit')" class="fa fa-edit"></i> </a>
                                    <a href="{{ route('departments.show', $department->id) }}" class="btn btn-outline-info btn-sm"
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
@endsection
