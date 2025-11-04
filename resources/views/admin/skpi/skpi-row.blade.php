@php
    $namaCol  = "nama_sertifikat{$i}";
    $fileCol  = "file_sertifikat{$i}";
    $nilaiCol = "nilai_sertifikat{$i}";
@endphp

<tr>
    <td>{{ $skpi->$namaCol ?? '-' }}</td>
    <td>
        @if($skpi->$fileCol)
            <a href="{{ asset('storage/'.$skpi->$fileCol) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                Lihat / Unduh
            </a>
        @else
            <span class="text-muted fst-italic">Belum ada file</span>
        @endif
    </td>
    <td>
        <select name="{{ $nilaiCol }}" class="form-select">
            <option value="">Pilih nilai</option>
            @for($n=1; $n<=20; $n++)
                <option value="{{ $n }}" {{ old($nilaiCol, $skpi->$nilaiCol) == $n ? 'selected' : '' }}>
                    {{ $n }}
                </option>
            @endfor
        </select>
    </td>
</tr>
