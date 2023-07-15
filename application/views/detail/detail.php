</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh Tabel dengan Bootstrap 5 dan DataTables</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Load DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
</head>
<body>

    <div class="container my-4">
        <label for="filter-label-transfer">Filter Label Transfer:</label>
        <select class="form-select mb-3" id="filter-label-transfer">
            <option value="">Semua</option>
            <?php 
                    for ($i = 0; $i < count($label_transfer); $i++) {
                ?>

            <option value="<?= $label_transfer[$i]['id_label_transfer'] ?>"><?= $label_transfer[$i]['label_transfer']?></option>

            <?php }?>
        </select>
        <table class="table table-striped" id="table-transaksi">
            <thead>
                <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">ID</th>
                    <th scope="col">Jenis Transfer</th>
                    <th scope="col">ID Keluarga</th>
                    <th scope="col">Jenis Tranfer</th>
                    <th scope="col">Label Transfer</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    for ($i = 0; $i < count($transfer); $i++) {
                    //   echo $transfer[$i]['nominal'];
                    
                    // var_dump($transfer);
                ?>
                    <tr>
                    <!-- <th scope="row">1</th> -->
                    <td><?= $i; ?></td>
                    <td><?= $transfer[$i]['id_transfer']?></td>
                    <td><?= $transfer[$i]['id_keluarga']?></td>
                    <td><?= $transfer[$i]['jenis_transfer']?></td>
                    <td><?= $transfer[$i]['id_label_transfer']?></td>
                    <td>Rp <?= $transfer[$i]['nominal']?></td>
                    <td><?= $transfer[$i]['waktu']?></td>
                    <td><?= $transfer[$i]['keterangan_transfer']?></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Total Nominal:</th>
                    <th id="total-nominal"></th>
                    <th colspan="2"></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Load Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- Load DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            var table = $('#table-transaksi').DataTable();

            // Hitung total nominal
            var totalNominal = 0;
            $('tbody tr').each(function(index, element) {
                var nominal = $(element).find('td:nth-child(5)').text();
                nominal = nominal.replace('Rp ', '').replace('.', '').replace(',', '.');
                if (!isNaN(nominal)) {
                    totalNominal += parseFloat(nominal);
                }
            });
            $('#total-nominal').text('Rp ' + totalNominal.toLocaleString());

            // Filter data berdasarkan label transfer
            $('#filter-label-transfer').on('change', function() {
                var labelTransfer = $(this).val();

                // Reset filter
                table
                    .search('')
                    .columns().search('')
                    .draw();

                // Terapkan filter berdasarkan label transfer
                if (labelTransfer) {
                    table
                        .columns(4)
                        .search(labelTransfer)
                        .draw();
                }

                // Hitung ulang total nominal
                var filteredTotalNominal = 0;
                $('tbody tr:visible').each(function(index, element) {
                    var nominal = $(element).find('td:nth-child(6)').text();
                    nominal = nominal.replace('Rp ', '').replace('.', '').replace(',', '.');
                    if (!isNaN(nominal)) {
                        filteredTotalNominal += parseFloat(nominal);
                    }
                });
                $('#total-nominal').text('Rp ' + filteredTotalNominal.toLocaleString());
            });
        });
    </script>
</body>
</html>