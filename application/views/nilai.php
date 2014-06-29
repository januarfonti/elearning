
<h1 class="page-header"><i class="fa fa-clock-o"></i> <?php echo $judul ?></h1> 

<?php echo $this->session->flashdata('pesan'); ?>

<table class="table table-bordered">
    <thead >
        <tr class="info">
            <th class="text-center">No</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Mata Kuliah</th>
            <th class="text-center">Tanggal & Jam</th>
            <th class="text-center">Nilai</th>
            
            
        </tr>
    </thead>
    <tbody>
        <?php
            
                $nomer=1;
                foreach($nilai->data_nilai as $row){ 
        ?>
        <tr>
            <td class="text-center"><?php echo $nomer; ?></td>
            <td><?php echo $row->nama; ?></td>
            <td><?php echo $row->nama_matkul; ?></td>
            <td><?php echo $row->waktu; ?></td>
            <td><?php echo $row->nilai; ?></td>
            
            
        </tr>
        <?php $nomer++; } ?>
    </tbody>
</table>