@extends('layouts.backend')

@section('cdn-entrypoint')

@endsection

@section('content')

<section class="bg-container ">
  <div class="container">
    <div class="row">
        <div class="col-12">
          <h1 class="text-white text-center pt-5 pb-5">Up-to-date statistics of your apartments</h1>
        </div>

        <div class="col-12 d-flex align-items-center mt-5 mb-5">
          <div class="col-6 float-left">
            <canvas id="myChart"></canvas>
          </div>

          <div class="col-6 float-right text-center ">
            <h2 class="text-white">Monthly visits</h2>
          </div>
        </div>

        <div class="col-12 d-flex align-items-center mt-5 mb-5">
          <div class="col-6 float-left text-center ">
            <h2 class="text-white">Daily Visits</h2>
          </div>

          <div class="col-6 float-right">
            <canvas id="myOtherChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-12">
        <h1 class="text-white text-center pt-5 pb-5">Improve your Statistics</h1>
      </div>
    </div>
  </div>
</section>
  
@endsection

@section('scripts-entrypoint')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  
const monthlyVisit = {!! json_encode($monthlyVisit, JSON_HEX_TAG) !!};
const dailyVisit = {!! json_encode($dailyVisit, JSON_HEX_TAG) !!};

console.log(monthlyVisit);
console.log(dailyVisit);

monthlyVisits();
dailyVisits();


// Functions

function monthlyVisits() {
  const labels = monthlyVisit.slice(1,13).map(element => element.monthname);
  const data = {
    labels: labels,
    datasets: [{
      label: 'Monthly Visits',
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
}

function dailyVisits() {
  const labels = dailyVisit.slice(1,13).map(element => element.day);
  const data = {
    labels: labels,
    datasets: [{
      label: 'Daily Visits',
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
      document.getElementById('myOtherChart'),
      config
    );
}


</script>
@endsection