<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach ($tanggal_pengembalian as $item)
                {{$item}},
            @endforeach
        ],
        datasets: [{
            label: 'Selesai Dipinjam',
            data: [
                @foreach ($count as $item)
                    {{$item}},
                @endforeach
            ],
            backgroundColor: '#f012be',
            borderWidth: 1
        }]
    },
    options: {
        events: ['mouseout', 'touchstart', 'touchmove'],
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

Livewire.on('ubahBulanTahun', (count, tanggal_pengembalian) => {
    myChart.data.labels = tanggal_pengembalian;
    myChart.data.datasets[0].data = count;
    myChart.update();
})
</script>
