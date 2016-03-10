@extends('pegawai.app')

@section('content')

<table>
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama</th>
      <th>NIP</th>
    </tr>
  </thead>

  <tbody>
    @foreach($pegawai as $pegawai)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{{ $pegawai->nama }}</td>
      <td>{{ $pegawai->nip }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
