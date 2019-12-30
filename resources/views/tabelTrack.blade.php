
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th width="10">

            </th>
            <th>
                No
            </th>
            <th>
                {{ trans('cruds.pengunjung.fields.nama') }}
            </th>
            <th>
                Posisi Terakhir
            </th>
            <th>
                Jam
            </th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1 ?>
        @foreach($users as $user)
        <tr>
            <td>
            </td>
            <td>
            <?php echo $no; $no++?>
            </td>
            <td>
            <?php echo $user->nama ?>          
            </td>
            <td>
            <?php echo $user->nama_area?> 
            </td>
            <td>
            <?php $waktu=substr($user->timestamp,10);
                echo"$waktu";
            ?> 
            </td>
        </tr>
        @endforeach
    </tbody>
</table>