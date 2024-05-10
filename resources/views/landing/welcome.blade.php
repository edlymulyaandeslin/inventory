@extends('layouts.landing.master', ['title' => 'Homepage'])

@section('content')
    @include('layouts.landing.hero')
    <div class="w-full px-4 py-6">
        <div class="container mx-auto">
            <div class="grid items-start grid-cols-1 gap-6 lg:grid-cols-12">
                <div class="col-span-12 lg:col-span-8">
                    <div class="flex flex-col gap-4 mb-5 md:flex-row md:justify-between">
                        <div class="flex flex-col">
                            <h1 class="text-lg font-bold text-gray-700">Daftar Barang</h1>
                            <p class="text-xs text-gray-400">
                                Kumpulan data barang yang berada di gudang
                            </p>
                        </div>
                        <form action="{{ route('product.index') }}" method="get">
                            <input
                                class="w-full p-2 text-sm text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-700"
                                placeholder="Cari Data Barang.." name="search" value="{{ $search }}" />
                        </form>
                    </div>
                    <div class="grid items-start grid-cols-1 gap-6 lg:grid-cols-2">
                        @foreach ($products as $product)
                            <div class="relative p-4 bg-white border rounded-lg shadow-custom">
                                <img src="{{ $product->image }}" class="object-cover w-full rounded-lg" />
                                <div
                                    class="font-mono absolute -top-3 -right-3 p-2 {{ $product->quantity > 0 ? 'bg-green-700' : 'bg-rose-700' }} rounded-lg text-gray-50">
                                    {{ $product->quantity }}
                                </div>
                                <div class="flex flex-col gap-2 py-2">
                                    <div class="flex justify-between">
                                        <a href="{{ route('product.show', $product->slug) }}"
                                            class="text-sm text-gray-700 hover:underline">{{ $product->name }}</a>
                                        <div class="text-sm text-gray-500">{{ $product->category->name }}</div>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ Str::limit($product->description, 35) }}
                                    </div>
                                    @if ($product->quantity > 0)
                                        <form action="{{ route('cart.store', $product->slug) }}" method="POST">
                                            @csrf
                                            <button
                                                class="w-full p-2 text-sm text-center text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300"
                                                type="submit">
                                                Tambah ke keranjang
                                            </button>
                                        </form>
                                    @else
                                        <button
                                            class="w-full p-2 text-sm text-center text-gray-700 bg-gray-200 rounded-lg cursor-not-allowed hover:bg-gray-300">
                                            Barang Tidak Tersedia
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($products->count() >= 6)
                        <div class="flex justify-center mt-8 text-center">
                            <a href="{{ route('product.index') }}"
                                class="flex items-center px-4 py-2 bg-gray-700 rounded-lg text-gray-50 hover:bg-gray-900">
                                Lihat Semua Barang
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-right"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <polyline points="7 7 12 12 7 17"></polyline>
                                    <polyline points="13 7 18 12 13 17"></polyline>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col-span-12 row-start-1 lg:col-span-4">
                    <div class="md:shadow-custom md:bg-white md:rounded-lg md:border">
                        <div class="flex flex-col p-4">
                            <h1 class="text-lg font-bold text-gray-700">Daftar Kategori</h1>
                            <p class="text-xs text-gray-400">Kumpulan data kategori yang berada di gudang</p>
                        </div>
                        <div class="flex flex-row gap-8 p-4 overflow-x-auto md:grid md:gird-cols-1 md:gap-2">
                            @foreach ($categories as $category)
                                <a href="{{ route('category.show', $category->slug) }}"
                                    class="flex flex-row items-center min-w-full gap-4 p-2 transition-transform duration-200 bg-white border border-l-4 rounded-lg border-l-sky-700 hover:scale-105">
                                    <img src="{{ $category->image }}" alt="{{ $category->name }}"
                                        class="object-cover w-20 rounded-lg">
                                    <div>
                                        <h1 class="text-sm italic text-gray-700">{{ $category->name }}</h1>
                                        <p class="text-xs text-gray-500">
                                            {{ $category->products->count() }} Produk
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
