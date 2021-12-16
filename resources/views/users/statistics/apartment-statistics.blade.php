@extends('layouts.backend')

@section('cdn-entrypoint')

@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-6">
        <div class="row pt-5 pb-5 mb-5">
          
          {{-- @foreach ($monthlyVisit as $item)
              <div class="text-white col-2">
                <p>Year : {{$item->year}}</p>
                <p>Month : {{$item->month}}</p>
                <p>Total Views : {{$item->views}}</p>
              </div>
          @endforeach --}}
        </div>

      </div>

      <div class="col-6">
        <canvas id="myChart"></canvas>
      </div>

    </div>

    <div>
    </div>
  </div>

@endsection

@section('scripts-entrypoint')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const monthlyVisit = {!! json_encode($monthlyVisit, JSON_HEX_TAG) !!};

console.log(monthlyVisit);

const labels = monthlyVisit.slice(1,13).map(element => element.monthname);
const data = {
  labels: labels,
  datasets: [{
    label: 'Visits',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: monthlyVisit.slice(1,13).map(element => element.views),
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

  // Functions

  function monthsNumberConverter() {

  }
</script>
@endsection