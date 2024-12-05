document.addEventListener('DOMContentLoaded', function() {
    // Mock data - Replace with real data from your database
    const applications = [
      { status: 'Applied' },
      { status: 'Interview Scheduled' },
      { status: 'Offer Received' },
      { status: 'Applied' },
      { status: 'Rejected' }
    ];
  
    // Calculate statistics
    const totalApplications = applications.length;
    const interviewsScheduled = applications.filter(app => app.status === 'Interview Scheduled').length;
    const offersReceived = applications.filter(app => app.status === 'Offer Received').length;
  
    // Display statistics
    document.getElementById('totalApplications').textContent = totalApplications;
    document.getElementById('interviewsScheduled').textContent = interviewsScheduled;
    document.getElementById('offersReceived').textContent = offersReceived;
  
    // Progress Chart
    const ctx = document.getElementById('progressChart').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Applied', 'Interview Scheduled', 'Offer Received', 'Rejected'],
        datasets: [{
          data: [
            applications.filter(app => app.status === 'Applied').length,
            interviewsScheduled,
            offersReceived,
            applications.filter(app => app.status === 'Rejected').length
          ],
          backgroundColor: ['#007bff', '#ffc107', '#28a745', '#dc3545']
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
  });
  