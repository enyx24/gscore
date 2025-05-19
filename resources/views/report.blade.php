@extends('layouts.app')

@section('title', 'Report')

@section('content')
<h1 class="text-2xl font-bold mb-4">Reports</h1>

<section class="mb-8">
  <h2 class="text-xl font-semibold mb-2">Subject Report</h2>

  <div class="flex items-center gap-4 mb-4">
    <div>
      <label for="subjectSelect" class="block text-gray-700 mb-1">Choose subject:</label>
      <select id="subjectSelect" class="p-2 border rounded w-52" onchange="loadSubjectStats()">
        <option value="toan" selected>Toán</option>
        <option value="ngu_van">Ngữ văn</option>
        <option value="ngoai_ngu">Ngoại ngữ</option>
        <option value="vat_li">Vật lí</option>
        <option value="hoa_hoc">Hóa học</option>
        <option value="sinh_hoc">Sinh học</option>
        <option value="lich_su">Lịch sử</option>
        <option value="dia_li">Địa lí</option>
        <option value="gdcd">GDCD</option>
      </select>
    </div>

    <div id="langSelectContainer" class="hidden">
      <label for="langSelect" class="block text-gray-700 mb-1">Choose language id:</label>
      <select id="langSelect" class="p-2 border rounded w-40" onchange="loadSubjectStats()">
        <option value="N1">N1</option>
        <option value="N2">N2</option>
        <option value="N3">N3</option>
        <option value="N4">N4</option>
        <option value="N5">N5</option>
        <option value="N6">N6</option>
        <option value="N7">N7</option>
      </select>
    </div>
  </div>

  <div id="chart-loading" class="text-center text-gray-600 mb-4">
    Loading...
  </div>

  <div id="chart-container"class="w-full max-w-md mx-auto">
    <canvas id="subjectChart"></canvas>
  </div>


</section>

<section>
  <h2 class="text-xl font-semibold mb-2">Top 10 - Khối A (Toán, Lý, Hóa)</h2>
  <div id="table-loading" class="text-center text-gray-600 mb-4">
    Loading...
  </div>
  <table class="w-full border mt-2 text-sm hidden" id="table-container">
    <thead>
      <tr class="bg-gray-200 text-left-center">
        <th class="p-2 border">#</th>
        <th class="p-2 border">ID</th>
        <th class="p-2 border">Tổng điểm khối A</th>
      </tr>
    </thead>
    <tbody id="top10TableBody">
    </tbody>
  </table>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let subjectChart = null;

async function loadSubjectStats() {
  const subject = document.getElementById('subjectSelect').value;
  const langSelectContainer = document.getElementById('langSelectContainer');
  const langId = document.getElementById('langSelect').value;

  const loading = document.getElementById('chart-loading');
  const canvasContainer = document.getElementById('chart-container');
  loading.classList.remove('hidden');
  canvasContainer.classList.add('hidden');

  if (subject === 'ngoai_ngu') {
    langSelectContainer.classList.remove('hidden');
  } else {
    langSelectContainer.classList.add('hidden');
  }

  let url = `/api/score-stats?subject=${subject}`;
  if (subject === 'ngoai_ngu') {
    url += `&lang_id=${langId}`;
  }

  const res = await fetch(url);
  const data = await res.json();

  if (res.status !== 200) {
    loading.textContent = data.error || 'Error loading data';
    return;
  }

  const stats = data.stats;

  const labels = [
    '>= 8 điểm',
    '[6, 8) điểm',
    '[4, 6) điểm',
    '< 4 điểm'
  ];
  const values = [
    stats.level_8_up,
    stats.level_6_8,
    stats.level_4_6,
    stats.level_below_4
  ];

  const ctx = document.getElementById('subjectChart').getContext('2d');
  if (subjectChart) subjectChart.destroy();
  
  subjectChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: `Số thí sinh điểm môn ${subject}`,
        data: values,
        backgroundColor: [
          '#10B981',
          '#3B82F6',
          '#F59E0B',
          '#EF4444'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { precision: 0 }
        }
      }
    }
  });
  loading.classList.add('hidden');
  canvasContainer.classList.remove('hidden');
}



async function loadTop10() {
  const container = document.getElementById("table-container");
  const loading = document.getElementById("table-loading");
  loading.classList.remove('hidden');
  container.classList.add('hidden');
  const res = await fetch('/api/top');
  const data = await res.json();

  if (res.status !== 200 || !data.top10_khoi_a) {
    alert('Error loading data');
    return;
  }

  const tbody = document.getElementById('top10TableBody');
  tbody.innerHTML = '';

  data.top10_khoi_a.forEach((item, index) => {
    const row = `
      <tr class="border-t">
        <td class="p-2 border text-center">${index + 1}</td>
        <td class="p-2 border text-center">${item.uid}</td>
        <td class="p-2 border text-center font-semibold">${item.total_score.toFixed(2)}</td>
      </tr>`;
    tbody.innerHTML += row;
  });
  loading.classList.add('hidden');
  container.classList.remove('hidden');
}

loadSubjectStats();
loadTop10();
</script>
@endsection
