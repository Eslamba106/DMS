<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Document;
use App\Models\DocumentLog;
use App\Models\Signature;
use App\Models\User;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DocumentController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected DocumentService $documentService)
    {
    }

    public function index()
    {
        $this->authorize('all_documents');

        $documents = Document::paginate();
        $departments = Department::get();
        return view('admin.docs.index', compact('documents', 'departments'));
    }
    public function main_archive()
    {
        $this->authorize('show_archive');
        $documents = Document::onlyTrashed()->paginate();
        $departments = Department::get();
        // dd();/
        return view('admin.docs.index', compact('documents', 'departments'));
    }
    public function store(Request $request)
    {
        $this->authorize('create_documents');

        $request->validate([
            'name' => 'required',
            'contents' => 'required',
            // 'department_id' => 'required',
        ]);
        $owner = auth()->user();
        // dd($request->all());
        $document = Document::create([
            'name' => $request->name,
            // 'department_id' => $request->department_id,
            'owner' => $owner->id,
            'content' => $request->contents,
        ]);
        if ($document && $request->has('department_id')) {
            $document->departments()->sync($request->department_id);
        }

        return back()->with('success', 'تم اضافة الملف بنجاح');
    }

    public function show($id)
    {
        $this->authorize('show_documents');

        $document = Document::findOrFail($id);
        return view('admin.docs.show', compact('document'));
    }
    public function show_department_documents($id)
    {
        $this->authorize('show_departments_documents');
        $documents = Document::where('department_id', $id)->get();
        return view('admin.docs.show_department_documents', compact('documents'));
    }
    public function create()
    {
        $this->authorize('create_documents');

        $departments = Department::get();

        return view('admin.docs.create', compact(['departments']));
    }
    public function edit($id)
    {
        $this->authorize('edit_documents');

        $departments = Department::get();
        $document = Document::findOrFail($id);

        return view('admin.docs.edit', compact(['departments', 'document']));
    }
    public function update(Request $request, $id)
    {
        $this->authorize('edit_documents');

        $request->validate([
            'name' => 'required',
            'contents' => 'required',
        ]);
        $owner = auth()->user();
        $document = Document::findOrFail($id);

        $oldName = $document->name;
        $oldContent = $document->content;
        $oldDepartments = $document->departments->pluck('id')->toArray();

        $document->update([
            'name' => $request->name,
            'content' => $request->contents,
        ]);
        if ($document && $request->has('department_id')) {
            $document->departments()->sync($request->department_id);
        }
        if ($oldName !== $request->name) {
            DocumentLog::create([
                'document_id' => $document->id,
                'user_id' => $owner->id,
                'action' => "عدل اسم الملف من : {$oldName} إلى : {$request->name} ",
                'created_at' => now(),
            ]);
        }

        if ($oldContent !== $request->contents) {
            DocumentLog::create([
                'document_id' => $document->id,
                'user_id' => $owner->id,
                'action' => "عدل المحتوى من : {$oldContent}  إلى : {$request->contents} ",
                'created_at' => now(),
            ]);
        }

        $newDepartments = is_array($request->department_id) ? $request->department_id : []; 

        $addedDepartments = array_diff($newDepartments, $oldDepartments);
        $removedDepartments = array_diff($oldDepartments, $newDepartments);
        
         
        foreach ($addedDepartments as $departmentId) {
            $department = Department::find($departmentId); 
            if ($department) {  
                DocumentLog::create([
                    'document_id' => $document->id,
                    'user_id' => $owner->id,
                    'action' => "تمت إضافتة الي قسم \" {$department->name}\"",
                    'created_at' => now(),
                ]);
            }
        }
        
        // تسجيل الأقسام المحذوفة
        foreach ($removedDepartments as $departmentId) {
            $department = Department::find($departmentId); // استخدم find للحصول على القسم مباشرة
            if ($department) {
                DocumentLog::create([
                    'document_id' => $document->id,
                    'user_id' => $owner->id,
                    'action' => "تمت حذفه من قسم \" {$department->name} \"",
                    'created_at' => now(),
                ]);
            }
        }
        
        

        return back()->with('success', 'تم تعديل الملف بنجاح');
    }
    public function createSignature($id)
    {
        $this->authorize('add_sginature');

        $document = Document::findOrFail($id);
        return view('admin.docs.signature', compact(['document']));
    }

    public function signature(Request $request)
    {
        $this->authorize('add_sginature');

        $request->validate([
            'signatures' => 'required|array',
            'signatures.*' => 'string',
            'document_id' => 'required',
        ]);

        foreach ($request->signatures as $signatureData) {
            Signature::create([
                'user_id' => auth()->id(),
                'document_id' => $request->document_id,
                'image' => $signatureData,
            ]);
        }
        DocumentLog::create([
            'document_id' => $request->document_id,
            'user_id' => auth()->id(),
            'action' => 'وقع علي الوثيقة',
            'created_at' => now(),
        ]);

        return back()->with('success', 'All signatures saved successfully!');
    }

    public function add_to_department(Request $request)
    {
        $this->authorize('share_with_departments');

        $document = Document::where('id', $request->document_id)->first();
        if ($document && $request->has('department_id')) {
            $document->departments()->attach($request->department_id);
        }
        return redirect()->back()->with('success', 'تم الاضافة بنجاح');
    }
    public function archive($id)
    {
        $this->authorize('archive');
        $docs = Document::findOrFail($id);
        $docs->delete();
        return redirect()->back()->with('success', 'تم الاضافة الي الارشيف');
    }
    public function delete_archive($id)
    {
        $this->authorize('delete_from_archive');
  
        $docs = Document::withTrashed()->where('id', $id)->restore();

        return redirect()->back()->with('success', 'تم الغاء الارشفة');
    }
    public function delete($id)
    {
        $this->authorize('delete_documents');
        $docs = Document::findOrFail($id);
        $docs->forceDelete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }
    public function follow($id)
    {
        $this->authorize('follow_document');

        $docs = Document::findOrFail($id);
        $actions = DocumentLog::orderBy('created_at' , 'asc')->get();
        return view('admin.docs.follow' , compact('docs' , 'actions'));
    }


}
