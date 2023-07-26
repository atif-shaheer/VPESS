      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="#" target="_blank">Digital House Technology</a></b>
            </span>
          </div>
        </div>

        <!-- <div class="container my-auto py-2">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - distributed by
              <b><a href="https://themewagon.com/" target="_blank">themewagon</a></b>
            </span>
          </div>
        </div> -->
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../assets2/vendor/jquery/jquery.min.js"></script>
  <script src="../assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets2/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../assets2/js/ruang-admin.min.js"></script>
  <script src="../assets2/vendor/chart.js/Chart.min.js"></script>
  <script src="../assets2/js/demo/chart-area-demo.js"></script>
  <script src="../assets2/js/demo/chart-pie-demo.js"></script>
  <script src="../assets2/js/demo/chart-bar-demo.js"></script>
  <!-- External -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

  <!-- <script>
    // Get current date
let currentDate = new Date();

// Get calendar elements
const calendarMonthYear = document.getElementById("calendar-month-year");
const calendarDates = document.querySelector(".calendar-dates");
const prevMonthBtn = document.getElementById("prev-month-btn");
const nextMonthBtn = document.getElementById("next-month-btn");

// Set calendar header
function setCalendarHeader() {
  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  ];
  const month = months[currentDate.getMonth()];
  const year = currentDate.getFullYear();
  calendarMonthYear.innerHTML = `${month} ${year}`;
}

// Set calendar dates
function setCalendarDates() {
  // Clear previous dates
  calendarDates.innerHTML = "";

  // Get first day of the month
  const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();

  // Get last day of the month
  const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();

  // Fill in empty cells before the first day
  for (let i = 0; i < firstDay; i++) {
    const emptyCell = document.createElement("div");
    emptyCell.classList.add("calendar-date");
    emptyCell.classList.add("empty-cell");
    calendarDates.appendChild(emptyCell);
  }

  // Fill in calendar dates
  for (let i = 1; i <= lastDay; i++) {
    const dateCell = document.createElement("div");
    dateCell.classList.add("calendar-date");
    dateCell.innerHTML = i;
    calendarDates.appendChild(dateCell);
  }
}

// Go to previous month
prevMonthBtn.addEventListener("click", () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  setCalendarHeader();
  setCalendarDates();
});

// Go to next month
nextMonthBtn.addEventListener("click", () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  setCalendarHeader();
  setCalendarDates();
});

// Initialize calendar
setCalendarHeader();
setCalendarDates();

  </script> -->
</body>

</html>