@extends('layouts.dashboard')

@section('title')
    {{ __('roles.roles') }}
@endsection
@section('css')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
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
    <div class="container-fluid"> 
      
        <button id="add-signature-pad" class="btn btn-success mb-2">Add Signature</button>
        <div id="signature-pads-container"></div>

        <form id="signature-form" method="POST" action="{{ route('save.signatures') }}">
            @csrf
            <input type="hidden" name="document_id" value="{{ $document->id }}">
            <button type="submit" class="btn btn-primary">Save All Signatures</button>
            @error('document_id') <span class="error text-danger">{{ $message }}</span> @enderror
            @error('signatures') <span class="error text-danger">{{ $message }}</span> @enderror
        </form>

        {{-- <form id="signature-form" method="POST" action="{{ route('signature') }}">
            @csrf
            <input type="hidden" name="signature" id="signature-input">
        </form>
        
            <div class="form-group">
                <canvas id="signature-pad" width="400" height="200" style="border: 1px solid #000;"></canvas>
                <button id="clear" class="btn btn-danger">Clear</button>
                <button id="save" class="btn btn-primary">Save</button>

            </div>         --}}
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
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
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script>
       document.getElementById('add-signature-pad').addEventListener('click', () => {
    createSignaturePad();
});

function createSignaturePad() {
    // إنشاء عنصر الـ div لاحتواء الـ Signature Pad
    const padContainer = document.createElement('div');
    padContainer.classList.add('signature-pad-container');

    // إنشاء الـ canvas لـ Signature Pad
    const canvas = document.createElement('canvas');
    canvas.width = 400;
    canvas.height = 200;
    canvas.style.border = '1px solid #000';

    // زر لمسح التوقيع
    const clearButton = document.createElement('button');
    clearButton.textContent = 'Clear';
    clearButton.classList.add('btn', 'btn-danger'); // إضافة كلاس Bootstrap
    clearButton.addEventListener('click', () => {
        signaturePad.clear();
        inputElement.value = ''; // إفراغ قيمة الحقل المخفي عند مسح التوقيع
    });

    // زر لحذف مساحة التوقيع
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.classList.add('btn', 'btn-warning'); // يمكنك استخدام كلاس آخر لـ Bootstrap
    deleteButton.addEventListener('click', () => {
        padContainer.remove();
    });

    // إضافة الـ canvas وزري الحذف والمسح إلى الحاوية
    padContainer.appendChild(canvas);
    padContainer.appendChild(clearButton);
    padContainer.appendChild(deleteButton);
    document.getElementById('signature-pads-container').appendChild(padContainer);

    // إنشاء Signature Pad من المكتبة
    const signaturePad = new SignaturePad(canvas);

    // إنشاء حقل مخفي لتخزين بيانات التوقيع عند الإرسال
    const inputElement = document.createElement('input');
    inputElement.type = 'hidden';
    inputElement.name = 'signatures[]';

    // إضافة الحقل المخفي إلى النموذج
    document.getElementById('signature-form').appendChild(inputElement);

    // تحديث الحقل المخفي ببيانات التوقيع عند كل تغيير
    signaturePad.onEnd = () => {
        inputElement.value = signaturePad.toDataURL('image/png');
    };
}

    </script>
@endsection
