<div class="page-header">
    <h1>Perhitungan</h1>
</div>
<?php
$c = $db->get_results("SELECT * FROM tb_rel_alternatif WHERE nilai < 0 ");
if (!$ALTERNATIF || !$KRITERIA) :
    echo "Tampaknya anda belum mengatur alternatif dan kriteria. Silahkan tambahkan minimal 3 alternatif dan 2 kriteria.";
elseif ($c) :
    echo "Tampaknya anda belum mengatur nilai alternatif. Silahkan atur pada menu <strong>Nilai Alternatif</strong>.";
else :
    $data = get_data(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Pengaturan</h3>
        </div>
        <div class="panel-body">
            <?php
            $succes = false;
            if ($_POST) {
                $acak = $_POST['acak'];
                $jumlah = $_POST['jumlah'];
                $maksimum = $_POST['maksimum'];

                $clusters = explode(',', $_POST['cluster']);

                if (($acak == 0 || $acak == 1) && $jumlah < 2) {
                    print_msg('Masukkan minimal 2 cluster');
                } elseif ($acak == 2 && count($clusters) < 2) {
                    print_msg('Masukkan minimal 2 cluster manual');
                } else if ($maksimum < 10) {
                    print_msg('Masukkan minimal 10 iterasi');
                } else {
                    $succes = true;
                }
            }
            ?>
            <form method="post" action="?m=hitung#hasil">
                <div class="form-group">
                    <label>Pusat Centroid <span class="text-danger">*</span></label>
                    <select class="form-control aw" name="acak" onchange="display()">
                        <?= get_acak_option(set_value('acak', 1)) ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Cluster Dicari <span class="text-danger">*</span></label>
                    <input class="form-control aw" type="text" name="jumlah" value="<?= set_value('jumlah', 4) ?>" />
                </div>
                <div class="form-group">
                    <label>Masukkan Cluster <span class="text-danger">*</span></label>
                    <input class="form-control aw" type="text" name="cluster" value="<?= set_value('cluster', '1, 3, 5, 7') ?>" />
                </div>
                <div class="form-group">
                    <label>Maksimum Iterasi <span class="text-danger">*</span></label>
                    <input class="form-control aw" type="text" name="maksimum" value="<?= set_value('maksimum', 100) ?>" />
                </div>
                <div class="form-group">
                    <button class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span>Proses</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    if ($succes) {
        include 'hitung_hasil_centroid.php';
        // include 'hitung_hasil_mz.php';
    }

    ?>
<?php endif ?>
<script>
    $(function() {
        display();
    })

    function display() {
        var cluster = $('select[name="acak"]').val();
        if (cluster == '2') {
            $('input[name="cluster"]').prop('readonly', false);
            $('input[name="jumlah"]').prop('readonly', true);
        } else {
            $('input[name="cluster"]').prop('readonly', true);
            $('input[name="jumlah"]').prop('readonly', false);
        }
    }
</script>