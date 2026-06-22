<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Productivity Insights Report</title>
    <style>
      body { font-family: Arial, sans-serif; }
      h2 { text-align: center; margin-bottom: 30px; }
      .insight { margin-bottom: 20px; }
      .title { font-weight: bold; font-size: 18px; margin-bottom: 5px; }
      .value { font-size: 24px; }
    </style>
</head>
<body>
  <h2>📊 Productivity Insights Report</h2>

  <div class="insight">
    <div class="title">Completion Rate</div>
    <div class="value">{{ $completionRate }}%</div>
  </div>

  <div class="insight">
    <div class="title">Most Productive Hour</div>
    <div class="value">{{ $mostProductiveHour ? $mostProductiveHour . ':00' : 'No Data' }}</div>
  </div>

  <div class="insight">
    <div class="title">Overdue Tasks</div>
    <div class="value">{{ $overdueTasks }}</div>
  </div>

  <div class="insight">
    <div class="title">Current Streak</div>
    <div class="value">{{ $streak }} day{{ $streak !== 1 ? 's' : '' }}</div>
  </div>
</body>
</html>
