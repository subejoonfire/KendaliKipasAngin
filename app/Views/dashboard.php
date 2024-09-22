<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendali Kipas Angin - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand text-light">Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?= base_url('/logout') ?>">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Kendali Kipas Angin</h4>
                    </div>
                    <div class="card-body">
                        <h5>Status Kipas Angin:
                            <span id="fan-status"><?= $KipasAnginStatus['status'] == 'on' ? 'Nyala' : 'Mati' ?></span>
                        </h5>
                        <a href="<?= base_url('toggle-fan') ?>" class="btn btn-warning">Tombol Kipas Angin</a>
                        <hr>
                        <h5>Grafik Suhu dan Kelembapan</h5>
                        <canvas id="chart" width="400" height="200"></canvas>
                        <hr>
                        <h5>Log Kipas Angin</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($dataKipasAngin as $log): ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= esc($log['status']) ?></td>
                                        <td><?= esc($log['timestamp']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5'],
                datasets: [{
                    label: 'Suhu (°C)',
                    data: [22, 23, 24, 25, 24, 23],
                    borderColor: 'red',
                    fill: false
                }, {
                    label: 'Kelembapan (%)',
                    data: [40, 45, 50, 55, 60, 55],
                    borderColor: 'blue',
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>