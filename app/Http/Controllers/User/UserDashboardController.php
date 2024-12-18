<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KoleksiBuku;
use App\Models\CategoryBook;

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
        $existingBorrow = PeminjamanBuku::where('user_id', $userid)
        ->where('buku_id', $id)
        ->where('status', 'dipinjam')
        ->first();

        if ($existingBorrow) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini');
        }
        else {
        // Create new borrow record
        PeminjamanBuku::create([
            'user_id' => $userid,
            'buku_id' => $id,
            'tanggal_pinjam' => now(),
            'returned' => '0',
        ]);
    }   
        return redirect()->back()->with('success', 'Buku berhasil dipinjam');
        

    }
}