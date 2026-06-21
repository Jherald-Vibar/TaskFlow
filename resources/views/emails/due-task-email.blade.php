<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Task Reminder</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f5f7fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .email-container {
      width: 100%;
      padding: 30px 0;
      background-color: #f5f7fa;
    }
    .email-content {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.07);
      overflow: hidden;
    }
    .email-header {
      padding: 30px 20px;
      background-color: #2d88ff;
      text-align: center;
    }
    .email-header img {
      max-width: 120px;
    }
    .email-title {
      font-size: 24px;
      font-weight: bold;
      color: #ffffff;
      margin-top: 10px;
    }
    .email-body {
      padding: 25px 30px;
      color: #333;
    }
    .email-body h3 {
      font-size: 20px;
      margin-bottom: 15px;
      color: #2d88ff;
    }
    .email-body p {
      font-size: 15px;
      margin: 8px 0;
      color: #444;
    }
    .email-button {
      display: inline-block;
      margin-top: 25px;
      padding: 12px 24px;
      background-color: #2d88ff;
      color: #ffffff;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 15px;
    }
    .footer {
      text-align: center;
      padding: 20px;
      font-size: 13px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="email-content">
      <div class="email-header">
        <img src="https://i.ibb.co/TBpX5Vd4/taskflowlogo.png" alt="TaskFlow Logo" />
        <div class="email-title">🔔 Task Reminder</div>
      </div>
      <div class="email-body">
        <h3>📝 Task: {{ $task->task_name ?? 'N/A' }}</h3>
        <p><strong>👤 Created By:</strong> {{ $user->name }}</p>
        <p><strong>📅 Due Date:</strong> {{ $task->due_date ?? 'No due date' }}</p>
        <p><strong>📝 Description:</strong> {{ $task->description ?? 'No description' }}</p>
        <p>Don't forget to complete it on time 💪</p>

        <a href="{{ route('user-task') }}" class="email-button">View Task</a>
      </div>
      <div class="footer">
        You're receiving this email because a task is due in your TaskFlow account.<br />
        &copy; {{ date('Y') }} TaskFlow. All rights reserved.
      </div>
    </div>
  </div>
</body>
</html>
