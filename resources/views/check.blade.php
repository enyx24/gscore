@extends('layouts.app')

@section('title', 'Check scores')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Check scores</h1>

  <div class="mb-4">
    <label for="regNumber" class="block text-xl font-bold text-gray-700 mb-1">Registration Number</label>
    <div class="flex space-x-2">
        <input type="text" id="regNumber" class="w-full p-2 border rounded" placeholder="Enter registration number">
        <button onclick="checkScore()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          Check
        </button>
    </div>
  </div>

  <div id="result" class="mt-4 text-sm text-gray-800"></div>

  <script>
    function renderScore(data, regNumber) {
        const subjectOrder = [
        'ngu_van', 'toan', 'ngoai_ngu', 
        'vat_li', 'hoa_hoc', 'sinh_hoc', 
        'lich_su', 'dia_li', 'gdcd'
        ];

        const subjectNames = {
        'ngu_van': 'Ngữ văn',
        'toan': 'Toán',
        'ngoai_ngu': 'Ngoại ngữ',
        'vat_li': 'Vật lí',
        'hoa_hoc': 'Hoá học',
        'sinh_hoc': 'Sinh học',
        'lich_su': 'Lịch sử',
        'dia_li': 'Địa lí',
        'gdcd': 'GDCD'
        };
        const resultEl = document.getElementById("result");
        resultEl.innerHTML = '';
        const row = document.createElement('div');
        row.className = 'flex justify-between border-b pb-1';
        row.innerHTML = `
            <span class="text-xl font-semibold">Result for registration number: ${regNumber}</span>
        `;
        resultEl.appendChild(row);
        subjectOrder.forEach(subject => {
            const item = data.find(s => s.subject === subject);
            if (item) {
                let scoreText = item.score;
                if (subject === 'ngoai_ngu' && item.foreign_language_id) {
                scoreText += ` (${item.foreign_language_id})`;
                }

                const row = document.createElement('div');
                row.className = 'flex justify-between border-b pb-1';
                row.innerHTML = `
                <span>${subjectNames[subject]}</span>
                <span class="font-semibold">${scoreText}</span>
                `;
                resultEl.appendChild(row);
            }
        })
    }
    async function checkScore() {

        const regNumber = document.getElementById('regNumber').value.trim();
        const resultEl = document.getElementById('result');
        resultEl.innerText = 'Loading...';

        if (!regNumber) {
        resultEl.innerText = 'Please enter a registration number.';
        return;
        }

        try {
        const response = await fetch(`/api/check-score?reg=${regNumber}`);
        const data = await response.json();
        console.log(data);
        if (!response.ok) {
            resultEl.innerHTML = `<div class="text-red-600">${data.error || 'Unknown error'}</div>`;
            return;
        }
        renderScore(data, regNumber);
        
        } catch (error) {
            resultEl.innerText = 'Request failed. Please try again.';
        }
    }
    </script>

@endsection
