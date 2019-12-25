
    
        <thead>
            <tr>
                <th width="10">

                </th>
                <th>
                    {{ trans('cruds.tracking.fields.id') }}
                </th>
                <th>
                    {{ trans('cruds.pengunjung.fields.nama') }}
                </th>
                <th>
                    Posisi Terakhir
                </th>
                <th>
                    {{ trans('cruds.kunjungan.fields.keperluan') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
            <tr data-entry-id="{{ $user->id }}">
                <td>

                </td>
                <td>
                    {{ $user->id ?? '' }}
                </td>
                <td>
                    {{ $user->name ?? '' }}
                </td>
                <td>
                    {{ $user->email ?? '' }}
                </td>
                <td>
                    @foreach($user->roles as $key => $item)
                    <span class="badge badge-info">{{ $item->title }}</span>
                    @endforeach
                </td>

            </tr>
            @endforeach
        </tbody>
    