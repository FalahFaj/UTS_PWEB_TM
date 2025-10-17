document.addEventListener("DOMContentLoaded", function () {
  const calendarEl = document.getElementById("calendar");
  renderCalendar(calendarEl);
});

function renderCalendar(container) {
  const today = new Date();
  createCalendar(container, today.getMonth(), today.getFullYear(), today);
}

function createCalendar(container, month, year, today) {
  const monthNames = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
  ];

  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const startDay = (firstDay.getDay() + 6) % 7; // Senin sebagai hari pertama

  const monthName = `${monthNames[month]} ${year}`;

  container.innerHTML = `
    <div class="flex justify-between items-center mb-3">
      <button id="prevBtn" class="text-gray-500 hover:text-gray-800 transition">&lt;</button>
      <h2 class="font-semibold text-gray-700">${monthName}</h2>
      <button id="nextBtn" class="text-gray-500 hover:text-gray-800 transition">&gt;</button>
    </div>

    <div class="grid grid-cols-7 text-center text-gray-400 text-sm mb-2 select-none">
      <div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div>
      <div>Jum</div><div>Sab</div><div>Min</div>
    </div>

    <div id="calendarDays" class="grid grid-cols-7 text-center gap-y-2"></div>
  `;

  const daysContainer = container.querySelector("#calendarDays");

  // Tanggal kosong sebelum tanggal 1
  for (let i = 0; i < startDay; i++) {
    daysContainer.appendChild(document.createElement("div"));
  }

  // Isi tanggal
  for (let day = 1; day <= lastDay.getDate(); day++) {
    const cell = document.createElement("div");
    cell.textContent = day;
    cell.className =
      "p-2 rounded-full text-gray-600 text-sm transition-colors duration-200 hover:bg-gray-100 cursor-pointer";

    // Tanggal hari ini
    if (
      day === today.getDate() &&
      month === today.getMonth() &&
      year === today.getFullYear()
    ) {
      cell.classList.add(
        "bg-indigo-600",
        "text-white",
        "font-semibold",
        "hover:bg-indigo-700"
      );
    }

    daysContainer.appendChild(cell);
  }

  // Navigasi bulan
  container.querySelector("#prevBtn").addEventListener("click", () => {
    changeMonth(-1, month, year, container);
  });

  container.querySelector("#nextBtn").addEventListener("click", () => {
    changeMonth(1, month, year, container);
  });
}

function changeMonth(offset, currentMonth, currentYear, container) {
  let newMonth = currentMonth + offset;
  let newYear = currentYear;

  if (newMonth < 0) {
    newMonth = 11;
    newYear--;
  } else if (newMonth > 11) {
    newMonth = 0;
    newYear++;
  }

  const today = new Date();
  createCalendar(container, newMonth, newYear, today);
}
