@extends('layouts.backend')

@section('cdn-entrypoint')

@endsection

@section('content')
    @foreach ($monthlyVisit as $item)
        <div class="text-white">
          <p>Year : {{$item->year}}</p>
          <p>Month : {{$item->month}}</p>
          <p>Total Views : {{$item->views}}</p>
        </div>
    @endforeach
    <canvas id="myChart"></canvas>

@endsection

@section('scripts-entrypoint')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July',
  'August',
  'September',
  'October',
  'November',
  'December'
  ];
const data = {
  labels: labels,
  datasets: [{
    label: 'Visits',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: [0, 10, 5, 2, 20, 30, 45],
  }]
};

const config = {
  type: 'bar',
  data: data,
  options: {}
};

const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
@endsection