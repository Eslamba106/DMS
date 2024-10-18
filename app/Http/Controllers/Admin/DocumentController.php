<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Document;
use App\Models\Signature;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\DocumentService;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{

    public function __construct(protected DocumentService $documentService)
    {
    }

    public function index()
    {
        $documents = Document::get();
        $departments = Department::get();
        return view('admin.docs.index', compact('documents', 'departments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contents' => 'required',
            'department_id' => 'required',
        ]);
        $owner = auth()->user();

        Document::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'owner' => $owner->id,
            'content' => $request->contents,
        ]);

        return back()->with('success', 'تم اضافة الملف بنجاح');
    }

    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('admin.docs.show', compact('document'));
    }
    public function create()
    {

        $departments = Department::get();

        return view('admin.docs.create', compact(['departments']));
    }
    public function createSignature($id)
    {

        $document = Document::findOrFail($id);

        return view('admin.docs.signature', compact(['document']));
    }

    public function signature(Request $request){
        // dd($request->all());
            $request->validate([
                'signatures' => 'required|array',
                'signatures.*' => 'string',
                'document_id' => 'required',
            ]);
    
            foreach ($request->signatures as $signatureData) {
                Signature::create([
                    'user_id' => auth()->id(),  
                    'document_id' =>$request->document_id,  
                    'image' => $signatureData,
                ]);
            }
    
            return back()->with('success', 'All signatures saved successfully!');
    }
    // return back()->with('error', 'لم يتمكن من تحميل الملف. حاول مرة أخرى.');
    // }
//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required',
//             'file_path' => 'required',
//             'department_id' => 'required',
//         ]);
//         // dd($request->all());$filename = $pdf->hashName();
// // $path = $pdf->storeAs('pdfs', $filename, 'public');

//         if ($request->hasFile('file_path')) {
//             $pdf = $request->file('file_path');
//             $filename = time() . '_' . $pdf->getClientOriginalName();
//             $path = $pdf->storeAs('docs', $filename, 'public');

//             // يمكنك حفظ مسار الملف في قاعدة البيانات إذا أردت
//             Document::create([
//                 'file_path' => $path,
//                 'name' => $request->name,
//                 'department_id' => $request->department_id,
//             ]);

//             return back()->with('success', 'تم اضافة الملف بنجاح');
//         }

//         return back()->with('error', 'لم يتمكن من تحميل الملف. حاول مرة أخرى.');
//     }


    // public function updateDocumentOrder(Request $request)
    // {
    //     try {

    //         // Begin transaction
    //         DB::beginTransaction();

    //         $folderId = $request->folder_id;

    //         $this->documentService->setUpdateDocumentOrder($folderId, $request->document_ids);

    //         // Commit transaction
    //         DB::commit();

    //         return response()->json(['url' => route('getFiles', $folderId)], 200);
    //     } catch (\Throwable $th) {
    //         // Rollback transaction on failure
    //         DB::rollback();
    //         return response()->json(['error' => $th->getMessage()]);
    //     }
    // }

    // public function getFiles($folder)
    // {
    //     $tags = request()->tags ?? [];

    //     $documents = $this->documentService->getFolderFiles($folder,  $tags)['documents'];
    //     $folderInfo =  $this->documentService->getFolderFiles($folder,  $tags)['folderInfo'];
    //     $folderData =  $this->documentService->getFolderFiles($folder,  $tags)['folderData'];

    //     // dd($folderInfo);

    //     $view = view('documents.contents', ['documents' => $documents])->render();
    //     $folderInfo = view('folders.info', ['folderInfo' => $folderInfo])->render();
    //     $folders = view('layouts.sidebar', ['folders' => $folderData])->render();
    //     $categoriesView = view('folders.categories', ['folder' => $folder])->render();

    //     return response()->json([
    //         'html' => $view, 'folderInfoHml' => $folderInfo,
    //         'folder_id' => $folder, 'folderHtml' => $folders, 'categoriesHtml' => $categoriesView
    //     ]);
    // }

    // function filterDocumentByTag(Request $request)
    // {
    //     $documents = $this->documentService->setFilterDocumentByTag($request->folder,  $request->tags ?? []);

    //     $view = view('documents.contents', ['documents' => $documents])->render();

    //     return response()->json(['html' => $view]);
    // }

    // public function updateVisibility(Request $request)
    // {
    //     $documentId = $request->input('document_id');
    //     $visibility = $request->input('visibility');

    //     // Update the visibility of the document
    //     $document = Document::find($documentId);

    //     if (!$document) {
    //         return response()->json(['message' => 'Document not found'], 404);
    //     }

    //     $document->update(['visibility' => $visibility === 'private' ? 'public' : 'private']);

    //     return response()->json([
    //         'message' => 'Visibility updated successfully',
    //         'visibility' => $document->visibility,
    //         'url' => route('getFiles', $document->folder_id)
    //     ]);
    // }

    // public function sendDocumentEmail(Request $request)
    // {
    //     $notifications = $this->documentService->setSendDocumentEmail($request);

    //     $view = view('documents.comments', compact('notifications'))->render();

    //     return response()->json(['message' => 'Email sent successfully!', 'html' => $view]);
    // }

    // public function getDocumentComments(Request $request)
    // {
    //     $notifications = $this->documentService->getDocumentNotifications($request->document_id);

    //     $view = view('documents.comments', compact('notifications'))->render();

    //     return response()->json(['html' => $view]);
    // }

    // public function uploadDocumentFiles(StoreDocumentRequest $request)
    // {
    //     $folderId = $this->documentService->setUploadDocumentFiles($request);

    //     return response()->json(['message' => 'Files uploaded successfully', 'url' => route('getFiles', $folderId)], 200);
    // }

    // function changeFile(Request $request)
    // {
    //     $folderId = $this->documentService->setChangeFile($request);

    //     return response()->json(['message' => 'Document updated successfully', 'url' => route('getFiles', $folderId)], 200);
    // }
}
