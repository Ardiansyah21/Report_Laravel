<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PDF;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::orderBy('created_at' , 'DESC')->simplePaginate(2);
        // compact untuk kirim data
        return view("dashboard.index", compact('reports'));
    }

    public function login()
    {
        return view('login');
    }

    public function data(Request $request)
    {
        $search = $request->search;
        $reports = Report::with('response')->where('nama', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
        // compact untuk kirim data
        return view("dashboard.data", compact('reports'));
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ],[
            'email.exists' => "This email doesn't exists"
        ]);

        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
        if(Auth::user()->role == 'admin'){
            return redirect()->route('data');
        }elseIf(Auth::user()->role == 'petugas'){
            return redirect()->route('data.petugas');
        }
            return redirect()->route('data');
        } else {
            return redirect('/')->with('fail', "Gagal login, periksa dan coba lagi!");
        }
    }

    public function exportpdf(){
        $reports = Report::with('response')->get()->toArray();

       view()->share('reports', $reports);
        $pdf = PDF::loadview('dashboard.datapengaduan-pdf')->setPaper('a4', 'landscape');
        return $pdf->download('data.pdf');
    }

    public function createpdf($id){
        $reports = Report::with('response')->get()->toArray();

       view()->share('reports', $reports);
        $pdf = PDF::loadview('dashboard.datapengaduan-pdf',)->setPaper('a4', 'landscape');
        return $pdf->download('data.pdf');
    }
    public function logout()
    { 
        Auth::logout();
        return redirect('/login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    public function datapetugas( Request $request)
    {
        $search = $request->search;
        $reports = Report::with('response')->where('nama', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
        // compact untuk kirim data
        return view("dashboard.petugas", compact('reports'));    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        {
            $request->validate([
                'nik' => 'required',
                'nama' => 'required|min:3',
                'no_tlp' => 'required',
                'pengaduan' => 'required',
                'foto' => 'required|image|mimes:jpeg,jpg,png,svg',
            ]);
    
            $image = $request->file('foto');
            $imgName = rand(). '.' .  $image->extension();
            $path = public_path('assets/image/');
            $image->move($path, $imgName);
    
            Report::create([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'no_tlp' => $request->no_tlp,
                'pengaduan' => $request->pengaduan,
                'foto' => $imgName,
    
            ]);
    
            return redirect()->back()->with('sucessAdd', 'Berhasil menambahkan data baru!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Report::where('id', $id)->firstOrFail();
        //$data isinya -> nik sampe foto dr pengaduan 
        //hapus foto data dr folder public : path . nama fotonya
        //nama foto nya diambil dari $data yang diatas trs ngambil dari column 'foto'
        $image = public_path('assets/image/'.$data['foto']);
        unlink($image);

        $data->delete();
        Response::where('report_id',$id)->delete();
        return redirect()->back();
}
}