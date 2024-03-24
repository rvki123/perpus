@extends('partial.template')
@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<center><h1>Penerbit</h1></center>
<div class="container mt-5">
<form action="{{ route('penerbit.index') }}" method="GET" class="mb-5">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search Penerbit" value="{{ request('search') }}">
        <div class="input-group-append">
            <button class="form-group-input  btn btn-primary ms-2" type="submit">Search</button>
        </div>
    </div>
</form>

<table class="table text-center">

    <thead>
        <tr>
            <th>No</th>
            <th>Nama Penerbit</th>
            <th>Alamat</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($penerbit as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_penerbit }}</td>
            <td>{{$item->alamat}}</td>
            <td>
                <a href="{{ route('penerbit.edit', $item->penerbit_id) }}" class="btn btn-sm btn-info">Edit</a>
                <form action="{{ route('penerbit.destroy', $item->penerbit_id) }}" method="POST" class="d-inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete"/>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="container mt-5">
    <a href="{{ route('penerbit.create') }}" class="btn btn-primary">Tambah</a>
</div>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item {{ $penerbit->onFirstPage() ? 'disabled' : '' }}">
      <a class="page-link" href="{{ $penerbit->previousPageUrl() }}" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <!-- Tampilkan nomor halaman -->
    @for ($i = 1; $i <= $penerbit->lastPage(); $i++)
        <li class="page-item {{ $penerbit->currentPage() == $i ? 'active' : '' }}">
            <a class="page-link" href="{{ $penerbit->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="page-item {{ $penerbit->hasMorePages() ? '' : 'disabled' }}">
      <a class="page-link" href="{{ $penerbit->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

@endsection

