@extends('layouts.dashboard')

@section('title')
<?php
$current_url = url()->current();
$url = explode('/', $current_url);
$end_url = end($url);
$lang = Session::get('locale') ;
?>
    {{ ($lang == 'ar') ? "تتبع ملف" :   "Follow File" }}
@endsection


@section('page_name')
    {{ __('documents.files') }}
@endsection
@section('css')
@endsection
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('documents.file') ." : ". $docs->name }}</h4>
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


    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    {{-- <th><input class="bulk_check_all" type="checkbox" /></th> --}}
                    <th scope="col">{{ __('roles.Actions') }}</th>
                    <th scope="col"> {{ __("dashboard.edited_by")}}</th>
                    <th scope="col">{{ __('dashboard.edited_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($actions as $action)
                <?php $user_action = App\Models\User::find($action->user_id); ?>
                    <tr>
                        
                        <td> {!! clean_html($action->action) !!}</td>
                        <td>
                            
                            {{ $user_action->name }}
                        </td>
                        <td>
                            
                            {{ $action->created_at->format('d-m-Y  ') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">{{ __('No documents found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
   
    </div>


    
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

