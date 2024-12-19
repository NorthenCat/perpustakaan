<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KoleksiBuku;
use App\Models\CategoryBook;
use App\Models\PeminjamBuku;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    public function home(Request $request)
    {   
        $categories = CategoryBook::all();
        $search = $request->get('search');
        $searchCategory = $request->get('category');

        $books = KoleksiBuku::with('kategori')
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('judul', 'LIKE', "%$search%")
                      ->orWhere('kode_buku', 'LIKE', "%$search%");
                });
            })
            ->when($searchCategory, function($query) use ($searchCategory) {
                $query->where('kategori_id', $searchCategory);
            })
            ->get();

        return view('user.home.index', compact('books', 'categories', 'search', 'searchCategory'));
    }

    public function detail($id)
    {   
        $book = KoleksiBuku::findOrFail($id);
        return view('user.detail.index', compact('book'));
    }

    public function pinjam($id)
    {   
        $book = KoleksiBuku::findOrFail($id);
        $userid = auth()->user()->id;

        // Check if user already borrowed this book
        $existingBorrow = PeminjamBuku::where('user_id', $userid)
        ->where('buku_id', $id)
        ->where('returned', '0')
        ->first();

        if($book->stok_buku <= 0){
            return redirect()->back()->with('error', 'Stok buku habis');
        }

        if ($existingBorrow) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini');
        }
        else {
        // Create new borrow record
        PeminjamBuku::create([
            'user_id' => $userid,
            'buku_id' => $id,
            'tanggal_pinjam' =>  Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'returned' => '0',
        ]);
        // Decrease book stock
        $book->stok_buku = $book->stok_buku - 1;
        $book->save();
        }   
        return redirect()->back()->with('success', 'Buku berhasil dipinjam');
    }

    public function history()
    {   
        $userid = auth()->user()->id;
        $history = PeminjamBuku::where('user_id', $userid)
            ->with('buku')
            ->orderBy('tanggal_pinjam', 'desc')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->tanggal_pinjam)->format('d-m-Y');
            });
            // dd($history);
        return view('user.history.index', compact('history'));
    }

    public function return($id)
    {   
        $pinjam = PeminjamBuku::findOrFail($id);
        $book = KoleksiBuku::findOrFail($pinjam->buku_id);
        $book->stok_buku = $book->stok_buku + 1;
        $book->save();
        $pinjam->returned = 1;
        $pinjam->tanggal_kembali = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $pinjam->save();
        return redirect()->back()->with('success', 'Terimakasih sudah mengembalikan buku ini.');
    }
}