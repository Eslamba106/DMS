@extends('layouts.dashboard')

@section('title')
    {{ __('roles.roles') }}
@endsection

@section('css')
    <style>
        .custom-class {
            border: none;
            border-top: 2px solid #000;
            /* Adjust thickness and color */
            margin: 20px 0;
            /* Adjust margin as needed */
        }
    </style>
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


    <div class="mb-5"></div>
    <div class="col-md-12 mb-5">

        <div class="text-right">
            <a href="{{ route('signatures', $document->id) }}"
                class="btn btn-primary">{{ __('files.add_signature') }}</a>
            <button id="print" class="btn btn-default btn-outline" type="button"> <span><i
                        class="fa fa-print"></i> Print</span> </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body printableArea">
                <h3><b>{{ $document->name }}</b> <span class="pull-right"></span></h3>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! clean_html($document->content) !!}
                        @if ($document->signature->isNotEmpty())
                        <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                            @foreach ($document->signature as $signature)
                                <div style="text-align: center; width: 48%;">
                                    <h4>{{ App\Models\User::where('id' , $signature->user_id)->first()->name }}</h4>
                                    <img width="100px" height="100px" src="{{ $signature->image }}" alt="Signature">
                                </div>
                            @endforeach
                        </div>
                    @endif
                    
                    
                    
                        {{-- @if ($document->signature->isNotEmpty())
                            @foreach ($document->signature as $signature)
                                <h4>{{ App\Models\User::where('id' , $signature->user_id)->first()->name }}</h4>
                                <img width="100px" height="100px" src="{{ $signature->image }}" alt="Signature">
                            @endforeach
                        @endif --}}
                        <hr class="custom-class">
                    </div>

                    <div class="col-md-12">

                        <div class="pull-right mt-5 {{ Session::get('locale') == 'en' ? 'text-right' : 'text-left' }}">
                            <address>
                                <h4 class="font-bold">{{ __('dashboard.created_by') }} : {{ $document->owners->name }}</h4>

                                <p class="m-t-30"><b>{{ __('dashboard.created_at') }}</b> <i class="fa fa-calendar"></i>
                                    {{ $document->created_at->shortAbsoluteDiffForHumans() }}</p>
                            </address>
                        </div>
                    </div>

                
                </div>
            </div>
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
@section('js')
    <script src="../../dist/js/pages/samplepages/jquery.PrintArea.js"></script>

    <script>
        $(function() {
            $("#print").click(function() {
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableArea").printArea(options);
            });
        });
    </script>
@endsection
