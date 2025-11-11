<tr>
    <td>
        <img src="{{Storage::url($data->thumbnail)}}" alt="{{$data->name}}" />
    </td>
    <td>
        <strong>{{$data->name}}</strong>
    </td>
    <td>{{$data->nama_petani}}</td>
    <td>{{$data->distrik->name}}</td>
    <td>{{ Str::limit($data->alamat, 50) }}</td>
    <td>
        <a href="{{route('front.detail', $data->slug)}}" class="table-action-btn">
            Lihat Detail
        </a>
    </td>
</tr>