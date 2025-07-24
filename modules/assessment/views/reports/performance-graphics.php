<?php get_header() ?>
<style>
table td img {
    max-width:150px;
}
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center no-print">
        <p class="h4 m-0"><?php get_title() ?></p>
    </div>
    <div class="card-body">
        <canvas id="performanceChart" width="400" height="200"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data grafik (inject dari PHP atau statis dulu)
    const labels = <?= json_encode($labels) ?>;
    const dataValues = <?= json_encode($values) ?>;

    const ctx = document.getElementById('performanceChart').getContext('2d');
    const performanceChart = new Chart(ctx, {
        type: 'bar', // atau 'line'
        data: {
            labels: labels,
            datasets: [{
                label: 'Rata-rata Nilai Aktual',
                data: dataValues,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nilai Aktual'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Parameter'
                    }
                }
            }
        }
    });
</script>
<?php get_footer() ?>
