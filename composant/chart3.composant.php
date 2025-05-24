<div class="canvasSeulCo">
    <div class="seul">
      <div class="facont">
          <i class="fa-solid fa-user-group fa-xl"></i>
      </div>
      <span><h1>180</h1> Apprenant</span>
    </div>
    <canvas id="pieChart"></canvas>
</div>
<script>
   const ctx2 = document.getElementById('pieChart').getContext('2d');

const data2 = {
  labels: ['Fille', 'Garçon'], // <-- labels ici
  datasets: [{
    data: [39, 51], // une seule liste de données
    backgroundColor: [
      'rgb(255, 100, 4)',
      'rgb(0, 183, 255)'
    ],
    borderColor: [
      'rgb(255, 100, 4)',
      'rgb(0, 183, 255)'
    ],
    borderWidth: 3
  }]
};

const options2 = {
  responsive: true,
  plugins: {
    legend: {
      position: 'bottom', // ou 'top' / 'right' / 'left'
      labels: {
        boxWidth: 20,
        padding: 15
      }
    },
    tooltip: {
      callbacks: {
        label: function(context) {
          const label = context.label || '';
          const value = context.parsed;
          return `${label}: ${value}%`;
        }
      }
    }
  }
};

const myPieChart = new Chart(ctx2, {
  type: 'doughnut',
  data: data2,
  options: options2
});


    </script>