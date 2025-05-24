const ctx = document.getElementById('barChart').getContext('2d');

const data = {
    labels: ['Janvier', 'Fevrier', 'Mars', 'April', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
    datasets: [
        {
        label: 'Presence',
        data: [50, 49, 20, 54, 75, 69, 57, 82, 78, 50, 32, 25],
        backgroundColor: 'rgb(2, 152, 207)',
        borderRadius: 2
      },
      {
      label: 'Retard',
      data: [12, 19, 10, 14, 15, 9, 17, 22, 18, 10, 12, 15],
      backgroundColor: 'rgba(2, 152, 207,0.2)',
      borderRadius: 2
      },
      {
        label: 'Abscence',
        data: [0, 9, 0, 4, 5, 9, 7, 2, 8, 0, 2, 5],
        backgroundColor: 'rgba(223, 146, 3, 0.995)',
        borderRadius: 2,
        customInfo: 'Statistiques du premier trimestre'
      }
    ]
  }

  const options = {
    indexAxis: 'x',
    responsive: true,
    maintainAspectRatio: false,
    scales: {
       x: {
      stacked: true 
    },
    y: {
      stacked: true, 
      beginAtZero: true
    }
    }
  };
  

  const barChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
  });


// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

  
