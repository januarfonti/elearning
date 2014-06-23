<?php
	foreach($judul->result() as $jdl)
	{
		?> <h1 class="page-header"><span class="glyphicon glyphicon-book"></span>  Mata Kuliah <?php echo $jdl->nama_matkul; ?></h1> <?php
		
	}
?>

<form name="ljkform" method="post" action="<?php echo base_url(); ?>index.php/rest_client/hasiltes">
<table width="600" cellpadding="2" cellspacing="1" class="widget-small">
<?php
	$nomor=1;
	foreach($soal->result_array() as $jwb)
	{
		$no_soal=$jwb["no_soal"];
		$id_mk=$jwb["id_matkul"];
		$matkul=$jwb["nama_matkul"];
		echo "<tr><td width='20'>".$nomor."</td><td>".$jwb["pertanyaan"]."</td></tr><tr>";
		echo "<td></td><td><input type='radio' value='a' name='pilih[".$jwb["id_soal"]."]'>A. ".$jwb["jwb_a"]."</td></tr>";
		echo "<td></td><td><input type='radio' value='b' name='pilih[".$jwb["id_soal"]."]'>B. ".$jwb["jwb_b"]."</td></tr>";
		echo "<td></td><td><input type='radio' value='c' name='pilih[".$jwb["id_soal"]."]'>C. ".$jwb["jwb_c"]."</td></tr>";
		if($jwb["jwb_d"]!="")
		{
			echo "<td></td><td><input type='radio' value='d' name='pilih[".$jwb["id_soal"]."]'>D. ".$jwb["jwb_d"]."</td></tr>";
		}
		else
		{
			echo "";
		}
		
		$nomor++;
		?> <br /><?php
	}
	echo "<input type='hidden' name='no_soal' value='".$no_soal."'>";
	echo "<input type='hidden' name='id_mk' value='".$id_mk."'>";
	echo "<input type='hidden' name='banyak_soal' value='".$jumlah."'>";
	echo "<input type='hidden' name='matkul' value='".$matkul."'>";
?>
<tr><td></td><td><br /><input type="submit" value="Selesai dan Kirim Jawaban ke Server" name="submit" class="tombol" onclick="return confirm("yakin")"/><br /><br /></td></tr>
</table>
</form>