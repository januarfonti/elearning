<h1 class="page-header"><i class="fa fa-users fa-fw"></i> <?php echo $judul ?></h1> 
<table class="table table-bordered">
    <thead >
        <tr class="info">
            <th class="text-center">Nama Mata Kuliah</th>
            <th class="text-center">Waktu</th>
            <th class="text-center">Salah</th>
            <th class="text-center">Benar</th>
            <th class="text-center">Hasil</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
            
            
                foreach($tampil_nilai->data_nilai_siswa as $row){ 
        ?>
        <tr>
            <td><?php echo $row->nama_matkul; ?></td>
            <td><?php echo $row->waktu; ?></td>
            <td><?php echo $row->salah; ?></td>
            <td><?php echo $row->benar; ?></td>
            <td><?php echo $row->hasil; ?></td>
            
        </tr>
        <?php  } ?>
    </tbody>
</table>