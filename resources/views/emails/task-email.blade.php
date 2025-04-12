<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Task Created</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }
    .email-container {
      width: 100%;
      background-color: #f4f4f4;
      padding: 20px 0;
    }
    .email-content {
      width: 600px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin: 0 auto;
    }
    .email-header {
      text-align: center;
      padding: 20px;
    }
    .email-header img {
      max-width: 150px;
    }
    .email-title {
      font-size: 22px;
      font-weight: bold;
      color: #333;
      text-align: center;
    }
    .email-text {
      font-size: 16px;
      color: #555;
      text-align: center;
      padding: 15px;
    }
    .email-button {
      display: inline-block;
      padding: 12px 20px;
      font-size: 16px;
      font-weight: bold;
      color: #ffffff;
      background-color: rgb(247, 247, 247);
      text-decoration: none;
      border-radius: 5px;
      text-align: center;
    }
    .footer {
      font-size: 14px;
      color: #777;
      text-align: center;
      padding: 15px;
    }
    .footer-small {
      font-size: 12px;
      color: #777;
      text-align: center;
      padding: 20px;
    }
  </style>
</head>
<body>
  <table class="email-container" role="presentation" width="100%" bgcolor="#f4f4f4" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table class="email-content" role="presentation" width="600px" bgcolor="#ffffff" cellpadding="0" cellspacing="0">
          <tr>
            <td class="email-header">
              <img src="https://i.ibb.co/TBpX5Vd4/taskflowlogo.png" alt="TaskFlow Logo">
            </td>
          </tr>
          <tr>
            <td class="email-title">
              ✅ New Task Created
            </td>
          </tr>
          <tr>
            <td class="email-text">
              <h3 class="text-xl font-bold text-gray-800">📝 Task: {{ $task->task_name }}</h3>
              <p><strong>👤 Created By:</strong> {{ $user->name }}</p>
              <p><strong>📅 Due Date:</strong> {{ $task->due_date }}</p>
              <p><strong>📝 Description:</strong> {{ $task->description }}</p>
            </td>
          </tr>
          <tr>
            <td align="center" style="padding: 20px;">
              <a href="{{ route('user-task') }}" class="email-button">
                View Task
              </a>
            </td>
          </tr>
          <tr>
            <td class="footer">
              You're receiving this email because a task was created in your account.
            </td>
          </tr>
          <tr>
            <td class="footer-small">
              &copy; {{ date('Y') }} TaskFlow. All rights reserved.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
