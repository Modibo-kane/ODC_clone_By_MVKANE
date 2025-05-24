// const ctx2 = document.getElementById('myPieChart').getContext('2d');

//   const data2 = {
//     datasets: [{
//       label: 'Statistiques',
//       data: [60, 25, 15], // Valeurs des portions
//       backgroundColor: [
//         'rgba(75, 192, 192, 0.7)',  // Présence
//         'rgba(255, 99, 132, 0.7)',  // Absence
//         'rgba(255, 205, 86, 0.7)'   // Retard
//       ],
//       borderColor: [
//         'rgba(75, 192, 192, 1)',
//         'rgba(255, 99, 132, 1)',
//         'rgba(255, 205, 86, 1)'
//       ],
//       borderWidth: 1
//     }]
//   };

//   const options2 = {
//     responsive: true,
//     plugins: {
//       legend: {
//         position: 'bottom'
//       },
//       tooltip: {
//         callbacks: {
//           label: function(context) {
//             const label = context.label || '';
//             const value = context.parsed;
//             return `${label}: ${value}%`;
//           }
//         }
//       }
//     }
//   };

//   const myPieChart = new Chart(ctx2, {
//     type: 'pie',
//     data: data2,
//     options: options2
//   });
