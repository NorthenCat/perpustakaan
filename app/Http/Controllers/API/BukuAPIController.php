<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KoleksiBuku;
use App\Models\CategoryBook;
use Illuminate\Http\Request;

class BukuAPIController extends Controller
{
    public function getAllBooks(Request $request)
    {
        $search = $request->get('search');
        $categoryId = $request->get('category_id');

        $books = KoleksiBuku::with('kategori')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'LIKE', "%$search%")
                        ->orWhere('kode_buku', 'LIKE', "%$search%")
                        ->orWhere('pengarang', 'LIKE', "%$search%");
                });
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('kategori_id', $categoryId);
            })
            ->get();

        // Transform to include full URL for cover images
        $books = $books->map(function ($book) {
            $book->cover_url = url($book->cover);
            return $book;
        });

        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);
    }

    public function getBookDetail($id)
    {
        $book = KoleksiBuku::with('kategori')->findOrFail($id);

        // Add full URL for cover image
        $book->cover_url = url($book->cover);

        return response()->json([
            'status' => 'success',
            'data' => $book
        ]);
    }

    public function getCategories()
    {
        $categories = CategoryBook::all();

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }
}
