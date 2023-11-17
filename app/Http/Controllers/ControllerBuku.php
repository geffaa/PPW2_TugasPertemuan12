<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Buku;  
use App\Models\Gallery;
use Intervention\Image\Facades\Image;

class ControllerBuku extends Controller
{


    
    public function index(){
        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id','desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage()-1);
        $total_harga = Buku::sum('harga');
        return view('buku.index', compact('data_buku', 'no', 'total_harga','jumlah_buku'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $batas = 5;
        
        $data_buku = Buku::where('judul', 'like', '%' . $search . '%')
            ->orWhere('penulis', 'like', '%' . $search . '%')
            ->orWhere('harga', 'like', '%' . $search . '%')
            ->orWhere('tgl_terbit', 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->paginate($batas);

        $no = $batas * ($data_buku->currentPage() - 1);
        $total_harga = Buku::sum('harga');
        $jumlah_buku = $data_buku->count();

        return view('buku.index', compact('data_buku', 'no', 'total_harga', 'jumlah_buku'));
    }

    public function create() {
        $buku = new Buku; 
        return view('buku.create', compact('buku'));
    }

    public function store(Request $request) {
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);
    
        $buku = Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
    
        if ($request->hasFile('thumbnail')) {
            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
    
            Image::make(storage_path().'/app/public/uploads/'.$fileName)
                ->fit(240,320)
                ->save();
    
            Buku::create([
                'judul'     => $request->judul,
                'penulis'   => $request->penulis,
                'harga'     => $request->harga,
                'tgl_terbit'=> $request->tgl_terbit,
                'filename'  => $fileName,
                'filepath'  => '/storage/' . $filePath
            ]);
        }
    
        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
    
                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/' . $filePath,
                    'foto' => $fileName,
                    'buku_id' => $buku->id
                ]);
            }
        }
    
        return redirect('/buku')->with('pesan', 'Buku baru berhasil ditambahkan');
    }
    

    public function destroy($id) {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku');
    }

    public function edit($id) {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, string $id ) {
        $buku = Buku::find($id);
    
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);
    
        if ($request->hasFile('thumbnail')) {
            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
    
            Image::make(storage_path().'/app/public/uploads/'.$fileName)
                ->fit(240,320)
                ->save();
    
            $buku->update([
                'judul'     => $request->judul,
                'penulis'   => $request->penulis,
                'harga'     => $request->harga,
                'tgl_terbit'=> $request->tgl_terbit,
                'filename'  => $fileName,
                'filepath'  => '/storage/' . $filePath
            ]);
        }
    
        if ($request->file('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
    
                $gallery = Gallery::create([
                    'nama_galeri'   => $fileName,
                    'path'          => '/storage/' . $filePath,
                    'foto'          => $fileName,
                    'buku_id'       => $id
                ]);
            }
        }
    
        return redirect('/buku')->with('pesan', 'Perubahan Data Buku Berhasil di Simpan');
    }

    public function deleteGallery($bukuId, $galleryId)
    {
        $buku = Buku::findOrFail($bukuId);
        $gallery = $buku->galleries()->findOrFail($galleryId);
        $gallery->delete();
    
        return redirect()->back()->with('success', 'Gambar berhasil dihapus');
    }

    public function galbuku($title)
{
    $bukus = Buku::where('buku_seo', $title)->first();
    $galeries = $bukus->galleries()->orderBy('id', 'desc')->paginate(5);
    return view ('buku.detail_buku', compact('bukus', 'galeries'));
}

}
