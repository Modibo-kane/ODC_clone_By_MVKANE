
<div class="container-principale">
  <div class="logo">
    <img src="../image/logoOrange.jpg" alt="Logo Orange Digital Center">
  </div>

  <div class="stats-container">
    <!-- Bloc 1 : Insertion -->
    <div class="stat-block">
      <div class="chart" data-percent="100">
        <svg viewBox="0 0 100 100">
          <circle class="bg-circle" r="45" cx="50" cy="50"/>
          <circle class="value-circle" r="45" cx="50" cy="50"/>
        </svg>
        <div class="percentage">100%</div>
      </div>
      <div class="label">
        <span class="highlight">Taux d'insertion</span>
        <span class="normal">Professionnelle</span>
      </div>
    </div>

    <!-- Bloc 2 : Féminisation -->
    <div class="stat-block">
      <div class="chart" data-percent="56">
        <svg viewBox="0 0 100 100">
          <circle class="bg-circle" r="45" cx="50" cy="50"/>
          <circle class="value-circle" r="45" cx="50" cy="50"/>
        </svg>
        <div class="percentage">56%</div>
      </div>
      <div class="label">
        <span class="highlight">Taux de</span>
        <span class="normal">Féminisation</span>
      </div>
    </div>

    <!-- Bloc 3 : Développeurs -->
    <div class="stat-block">
      <div class="icon">
        <i class="fas fa-user-group fa-3x teal"></i>
      </div>
      <div class="label">
        <span class="highlight">Communauté de plus de</span>
        <span class="normal">1000 Développeurs</span>
      </div>
    </div>

    <!-- Bloc 4 : Centres -->
    <div class="stat-block">
      <div class="icon">
        <i class="fas fa-location-dot fa-2x teal"></i>
        <i class="fas fa-location-dot fa-2x teal"></i>
        <i class="fas fa-location-dot fa-2x teal"></i>
      </div>
      <div class="label">
        <span class="highlight orange">4 Centres</span>
        <span class="normal small">Dakar, Diamniadio<br>Ziguinchor, et Saint-Louis</span>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const charts = document.querySelectorAll('.chart');
    charts.forEach(chart => {
      const percent = chart.dataset.percent;
      const circle = chart.querySelector('.value-circle');
      const radius = circle.r.baseVal.value;
      const circumference = 2 * Math.PI * radius;

      circle.style.strokeDasharray = `${circumference}`;
      circle.style.strokeDashoffset = `${circumference}`;
      setTimeout(() => {
        const offset = circumference - (percent / 100) * circumference;
        circle.style.strokeDashoffset = offset;
      }, 100);
    });
  });
</script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


