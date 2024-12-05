// Example JavaScript for checking and showing reminders
document.addEventListener('DOMContentLoaded', function() {
    // Mock data for reminders - Replace with data from your database
    const reminders = [
      { title: 'Job Interview', date: '2024-10-22T09:00' },
      { title: 'Follow-up Email', date: '2024-10-25T15:30' }
    ];
  
    reminders.forEach(reminder => {
      const reminderDate = new Date(reminder.date);
      const currentDate = new Date();
  
      // Check if the reminder is within the next 24 hours
      if (reminderDate - currentDate <= 24 * 60 * 60 * 1000 && reminderDate > currentDate) {
        alert(`Reminder: ${reminder.title} is coming up on ${reminderDate}`);
      }
    });
  });
  