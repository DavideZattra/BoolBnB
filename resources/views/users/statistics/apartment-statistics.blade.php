@extends('layouts.backend')

@section('cdn-entrypoint')

@endsection

@section('content')

<section class="bg-container pt-2 pb-5">
  <div class="container">
    <div class="row">

        <div class="col-12 pt-5">
          <h1 class="text-white text-center pt-5 pb-5">Up-to-date statistics of your apartments</h1>
        </div>

        {{-- First line --}}
        <div class="col-12 d-flex flex-wrap align-items-center mt-5 mb-5">

          {{-- Chart --}}
          <div class="col-12 col-lg-6 position-relative">
            <canvas id="myChart"></canvas>
          </div>

          <div class="col-12 col-lg-6 text-center pt-5 pt-lg-0">
            <h2 class="text-white">Monthly visits</h2>
          </div>
        </div>

        {{-- Second line --}}
        <div class="col-12 d-flex flex-wrap align-items-center mt-5 mb-5">

          {{-- Chart --}}

          <div class="col-12 col-lg-6 text-center pt-5 pt-lg-0 d-none d-lg-block">
            <h2 class="text-white">Daily Visits</h2>
          </div>
          
          <div class="col-12 col-lg-6 position-relative">
            <canvas id="myOtherChart"></canvas>
          </div>

          <div class="col-12 col-lg-6 text-center pt-5 pt-lg-0 d-block d-lg-none">
            <h2 class="text-white">Daily Visits</h2>
          </div>

        </div>

      </div>
      <div class="col-12 text-center pt-5 pb-5">
        <h1 class="text-white text-center pt-5 pb-5">Want to improve your statistics?</h1>
        <a class="btn btn-outline-secondary text-white" href="{{route('users.braintree.payment', $apartment)}}">To sponsorships</a>
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
      label: 'Views',
      backgroundColor: 'rgb(137, 155, 165)',
      borderColor: 'rgb(255, 99, 132)',
      data: monthlyVisit.slice(1,13).map(element => element.views),
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      plugins: {
        legend: {
          display: false
        }
      },
      responsive: true, 
    }
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
      backgroundColor: 'rgb(231, 111, 81)',
      borderColor: 'rgb(231, 111, 81)',
      data: monthlyVisit.slice(1,13).map(element => element.views),
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      plugins: {
        legend: {
          display: false
        }
      },
      responsive: true,
    }
  };

  const myChart = new Chart(
      document.getElementById('myOtherChart'),
      config
    );
}


</script>
@endsection