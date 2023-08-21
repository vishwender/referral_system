@extends('layouts/AdminDashboardLayout')
@section('content-section')
    <h2>Track Information</h2>
    <canvas id="myChart"></canvas>
    <script type="text/javascript">
        var dateLables = JSON.parse(@json($dateLables));
        var dateData = JSON.parse(@json($dateData));
        
        var canvas = document.getElementById('myChart');
        var data = {
            labels: dateLables,
            datasets: [
            {
                label: "Referral User",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(75,192,192,0.4)",
                borderColor: "rgba(75,192,192,1)",
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
                data: dateData,
            }
         ]  
    };

var option = {
  showLines: true
};
var myLineChart = Chart.Line(canvas,{
  data:data,
  options:option
});

</script>
@endsection    