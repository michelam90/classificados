<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f7fb;
      font-family: Arial, sans-serif;
    }
    .card {
      border-radius: 15px;
      border: none;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .schedule-status {
      font-size: 0.75rem;
      padding: 2px 8px;
      border-radius: 10px;
      margin-left: 8px;
    }
    .pending {
      background-color: #ffe6cc;
      color: #d96b00;
    }
    .calendar-day.active {
      background-color: #007bff;
      color: #fff;
      border-radius: 50%;
      display: inline-block;
      width: 28px;
      height: 28px;
      line-height: 28px;
    }
    .avatar-sm {
      width: 35px;
      height: 35px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #fff;
    }
    .avatar-md {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
    }
    /* Efeitos coloridos no Happy Birthday */
    .birthday-banner {
      position: relative;
      padding: 15px 0;
    }
    .birthday-banner::before,
    .birthday-banner::after {
      content: "";
      position: absolute;
      width: 50px;
      height: 3px;
      top: 50%;
      transform: translateY(-50%);
    }
    .birthday-banner::before {
      left: 15%;
      background: linear-gradient(90deg, #ff4b5c, #ffb347);
    }
    .birthday-banner::after {
      right: 15%;
      background: linear-gradient(90deg, #6a11cb, #2575fc);
    }
    .birthday-lines {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0; left: 0;
      pointer-events: none;
    }
    .birthday-lines span {
      position: absolute;
      width: 30px;
      height: 3px;
      border-radius: 2px;
    }
    .birthday-lines .line1 { background: #ff4b5c; top: 10%; left: 20%; transform: rotate(20deg); }
    .birthday-lines .line2 { background: #ffa41b; top: 20%; right: 25%; transform: rotate(-25deg); }
    .birthday-lines .line3 { background: #4caf50; bottom: 20%; left: 25%; transform: rotate(15deg); }
    .birthday-lines .line4 { background: #2575fc; bottom: 15%; right: 20%; transform: rotate(-20deg); }
  </style>
</head>
<body>
  <div class="container py-4">
    <!-- Cabeçalho -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
      <h6 class="mb-2 mb-md-0">Monday, 10 Feb 2020, 02:30 PM</h6>
      <div class="d-flex align-items-center">
        <i class="bi bi-bell me-3 fs-5"></i>
        <div class="d-flex">
          <img src="https://via.placeholder.com/35" class="avatar-sm me-n2">
          <img src="https://via.placeholder.com/35" class="avatar-sm me-n2">
          <img src="https://via.placeholder.com/35" class="avatar-sm me-n2">
          <img src="https://via.placeholder.com/35" class="avatar-sm">
        </div>
        <button class="btn btn-primary btn-sm rounded-circle ms-3">+</button>
      </div>
    </div>

    <div class="row g-4">
      <!-- Ilustração -->
      <div class="col-lg-4">
        <div class="card p-4 text-center h-100">
          <img src="https://via.placeholder.com/200x160" class="img-fluid" alt="Ilustração">
        </div>
      </div>

      <!-- Calendário -->
      <div class="col-lg-4">
        <div class="card p-3 h-100">
          <h6 class="text-center mb-3">Feb 2020</h6>
          <table class="table table-bordered text-center mb-0">
            <thead class="table-light">
              <tr>
                <th>Sun</th><th>Mon</th><th>Tue</th>
                <th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
              </tr>
            </thead>
            <tbody>
              <tr><td></td><td></td><td></td><td></td><td></td><td>31</td><td>1</td></tr>
              <tr><td>2</td><td>3</td><td>4</td><td><span class="calendar-day active">5</span></td><td>6</td><td>7</td><td>8</td></tr>
              <tr><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td></tr>
              <tr><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td></tr>
              <tr><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Agenda e Aniversários -->
      <div class="col-lg-4">
        <div class="card p-3 mb-3">
          <h6 class="mb-3">Schedules</h6>
          <ul class="list-unstyled mb-0">
            <li class="mb-3">
              <strong>23 Aug 2020</strong><br>
              Meeting at 9:00 PM with manager 
              <span class="schedule-status pending">Pending</span>
            </li>
            <li class="mb-3">
              <strong>25 Aug 2020</strong><br>
              Marketing Strategy Solution Seminar 
              <span class="schedule-status pending">Pending</span>
            </li>
            <li class="mb-3">
              <strong>26 Aug 2020</strong><br>
              JS Staff Annual Dinner 2018
            </li>
            <li>
              <strong>28 Aug 2020</strong><br>
              JS Program 2019-2020 
              <span class="schedule-status pending">Pending</span>
            </li>
          </ul>
        </div>

        <div class="card p-3 position-relative">
          <div class="birthday-lines">
            <span class="line1"></span>
            <span class="line2"></span>
            <span class="line3"></span>
            <span class="line4"></span>
          </div>
          <h6 class="text-center text-primary birthday-banner">Happy Birthday</h6>
          <div class="text-center">
            <img src="https://via.placeholder.com/60" class="avatar-md mb-2">
            <p class="mb-0 fw-bold">Ahmed Syed Ali</p>
            <small>10 Feb 2020</small>
          </div>
          <hr>
          <h6>Upcoming Birthday</h6>
          <div class="d-flex align-items-center">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-2">
            <div>
              <p class="mb-0 fw-bold">Ahmed Syed Ali</p>
              <small>23 April</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
