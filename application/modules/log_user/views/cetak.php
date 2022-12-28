<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body>
    <div class="container p-3">
        <h4 class="text-center">LAPORAN LOG USERS</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>IP Address</th>
                    <th>Sistem Operasi</th>
                    <th>Browser</th>
                    <th>Tanggal/Waktu</th>
                </tr>
            </thead>

            <tbody>

                <?php $no = 1;
                foreach ($get_log as $data) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->ip ?></td>
                        <td><?= $data->os ?></td>
                        <td><?= $data->browser ?> - <?= $data->versi ?></td>
                        <td><?= $data->time ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>

</html>