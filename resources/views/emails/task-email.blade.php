<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Task Notification</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f9fafb;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .email-wrapper {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }
    .email-header {
      background-color: #4f46e5;
      padding: 20px;
      text-align: center;
    }
    .email-header img {
      max-width: 120px;
    }
    .email-body {
      padding: 30px;
      color: #1f2937;
    }
    .email-body h2 {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 16px;
      color: #111827;
    }
    .email-body p {
      font-size: 15px;
      line-height: 1.6;
      color: #4b5563;
    }
    .task-box {
      background-color: #f3f4f6;
      border-left: 4px solid #4f46e5;
      padding: 16px;
      margin: 20px 0;
      border-radius: 8px;
    }
    .task-box h3 {
      margin: 0;
      font-size: 18px;
      color: #111827;
    }
    .task-box p {
      margin: 6px 0;
      font-size: 14px;
      color: #374151;
    }
    .email-footer {
      text-align: center;
      font-size: 13px;
      color: #9ca3af;
      padding: 20px;
      background-color: #f9fafb;
    }
    .action-button {
      display: inline-block;
      background-color: #4f46e5;
      color: #ffffff;
      padding: 12px 24px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="email-header">
      <img src="https://i.ibb.co/TBpX5Vd4/taskflowlogo.png" alt="TaskFlow Logo">
    </div>
    <div class="email-body">
      <h2>✅ New Task Created</h2>

      @foreach ($notif as $n)
        <div class="task-box">
          <h3>📝 {{ $n->task->task_name ?? 'Unnamed Task' }}</h3>
          <p><strong>👤 Created By:</strong> {{ $user->name }}</p>
          <p><strong>📅 Due Date:</strong> {{ $n->task->due_date ?? 'Not set' }}</p>
          <p><strong>📝 Description:</strong> {{ $n->task->description ?? 'No description provided' }}</p>
        </div>
      @endforeach

      <div style="text-align:center;">
        <a href="{{ route('user-task') }}" class="action-button">View Task</a>
      </div>
    </div>
    <div class="email-footer">
      You're receiving this email because a new task was assigned to your account.<br>
      &copy; {{ date('Y') }} TaskFlow. All rights reserved.
    </div>
  </div>
</body>
</html>
