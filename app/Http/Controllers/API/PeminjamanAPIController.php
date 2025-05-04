<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PeminjamBuku;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\KoleksiBuku;

class PeminjamanAPIController extends Controller
{
  public function getPeminjaman()
  {
    $userId = auth()->id();
    $peminjaman = PeminjamBuku::where('user_id', $userId)
      ->with('buku')
      ->orderBy('tanggal_pinjam', 'desc')
      ->get();

    return response()->json([
      'status' => 'success',
      'data' => $peminjaman
    ]);
  }

  public function pinjamBuku(Request $request)
  {
    $request->validate([
      'buku_id' => 'required|exists:koleksi_buku,id',
    ]);

    $bookId = $request->buku_id;
    $userId = auth()->id();
    $book = KoleksiBuku::findOrFail($bookId);

    // Check if user already borrowed this book
    $existingBorrow = PeminjamBuku::where('user_id', $userId)
      ->where('buku_id', $bookId)
      ->where('returned', '0')
      ->first();

    if ($book->stok_buku <= 0) {
      return response()->json([
        'status' => 'error',
        'message' => 'Stok buku habis'
      ], 400);
    }

    if ($existingBorrow) {
      return response()->json([
        'status' => 'error',
        'message' => 'Anda sudah meminjam buku ini'
      ], 400);
    }

    // Create new borrow record
    $pinjam = PeminjamBuku::create([
      'user_id' => $userId,
      'buku_id' => $bookId,
      'tanggal_pinjam' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
      'returned' => '0',
    ]);

    // Decrease book stock
    $book->stok_buku = $book->stok_buku - 1;
    $book->save();

    return response()->json([
      'status' => 'success',
      'message' => 'Buku berhasil dipinjam',
      'data' => $pinjam
    ], 201);
  }

  public function kembalikanBuku($id)
  {
    $pinjam = PeminjamBuku::findOrFail($id);

    // Verify the borrower is the authenticated user
    if ($pinjam->user_id != auth()->id()) {
      return response()->json([
        'status' => 'error',
        'message' => 'Unauthorized'
      ], 403);
    }

    if ($pinjam->returned == 1) {
      return response()->json([
        'status' => 'error',
        'message' => 'Buku sudah dikembalikan sebelumnya'
      ], 400);
    }

    $book = KoleksiBuku::findOrFail($pinjam->buku_id);
    $book->stok_buku = $book->stok_buku + 1;
    $book->save();

    $pinjam->returned = 1;
    $pinjam->tanggal_kembali = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
    $pinjam->save();

    return response()->json([
      'status' => 'success',
      'message' => 'Buku berhasil dikembalikan',
      'data' => $pinjam
    ]);
  }
}
