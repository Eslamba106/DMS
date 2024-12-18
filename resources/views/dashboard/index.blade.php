@extends('layouts.dashboard')

@section('content')
    
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">{{ __('dashboard.dashboard') }}</h4>
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

@endsection
