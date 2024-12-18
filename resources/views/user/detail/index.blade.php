@extends('user.layout')
@section('content')
    <div class="w-full max-w-5xl grid grid-cols-1 sm:grid-cols-[1fr,2fr] gap-4 bg-white rounded-lg p-6 mx-auto">
        <div class="w-full">
            <img src="{{ asset('img/books/cover/' . $book->cover) }}" alt=""
                class="w-full object-cover object-center rounded-lg">
        </div>
        <div class="flex flex-col space-y-3 break-all">
            <h1 class="text-2xl font-bold">{{ $book->judul }}</h1>
            <h1 class="text-base text-gray-400 italic">{{ $book->kode_buku }}</h1>
            <h1 class="text-xl">Pengarang: <span class="font-semibold">{{ $book->pengarang }}</span></h1>
            <h1 class="text-xl">Penerbit: <span class="font-semibold">{{ $book->penerbit }} -
                    {{ $book->tahun_terbit->format('d/m/Y') }}</span></h1>

            <p
                class="@if ($book->stok_buku <= 5) text-red-500 bg-red-300 @else text-blue-500 bg-blue-300 @endif rounded-md px-3 py-1 w-fit font-semibold">
                Stok:{{ $book->stok_buku }}
            </p>
            <h1 class="text-xl font-semibold">Deskripsi: </h1>
            <p> {{ $book->deskripsi }} </p>

            <form action="{{ route('pinjam-buku', $book->id) }}" method="POST">
                <button
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md transition-all mt-4">
                    Pinjam Buku
                </button>
            </form>
        </div>
    </div>
@endsection
