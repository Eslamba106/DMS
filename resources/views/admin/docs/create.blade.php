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
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <form action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data" >
            @csrf

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">{{ __('roles.name') }}</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('departments.departments') }}</label>
                                <select name="department_id" id="" class="form-control">
                                    <option value="">{{ __('departments.select_department') }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <h4 class="card-title">{{ __('files.content') }}</h4>

                            <textarea id="mymce" name="contents"></textarea>
                            <div class="form-group mt-2"
                                style="text-align: {{ Session::get('locale') == 'en' ? 'right;margin-right:10px' : 'left;margin-left:10px' }}">
                                <button type="submit" class="btn btn-primary mt-2">{{ __('dashboard.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

    <!-- This Page JS -->
    <script src="../../assets/libs/tinymce/tinymce.min.js"></script>
    <script src="../../assets/libs/tinymce/themes/modern/theme.min.js"></script>
    <script>
        $(document).ready(function() {

            if ($("#mymce").length > 0) {
                tinymce.init({
                    selector: "textarea#mymce",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

                });
            }
        });
    </script>
    {{-- <script>
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
            clearButton.classList.add('btn', 'btn-danger' ,'m-2');
            clearButton.addEventListener('click', () => {
                signaturePad.clear();
            });

            // زر لحذف مساحة التوقيع
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.classList.add('btn' , 'btn-primary');
            // deleteButton.style.backgroundColor = 'red';
            // deleteButton.style.color = 'white';
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
            padContainer.appendChild(inputElement);

            // تحديث الحقل المخفي ببيانات التوقيع عند كل تغيير
            signaturePad.onEnd = () => {
                inputElement.value = signaturePad.toDataURL('image/png');
            };
        }
    </script> --}}
@endsection
