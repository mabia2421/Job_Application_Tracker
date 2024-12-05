document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterStatus = document.getElementById('filterStatus');
    const applicationsTable = document.getElementById('applicationsTable');
  
    // Mock data - Replace with data from your database
    const applications = [
      { title: 'Software Engineer', company: 'Tech Corp', status: 'Applied', date: '2024-10-05' },
      { title: 'Web Developer', company: 'Web Solutions', status: 'Interview Scheduled', date: '2024-10-10' },
      { title: 'Data Analyst', company: 'Data Inc.', status: 'Offer Received', date: '2024-09-30' }
    ];
  
    function renderTable(data) {
      applicationsTable.innerHTML = '';
      data.forEach(app => {
        const row = `
          <tr>
            <td>${app.title}</td>
            <td>${app.company}</td>
            <td>${app.status}</td>
            <td>${app.date}</td>
          </tr>`;
        applicationsTable.innerHTML += row;
      });
    }
  
    function filterApplications() {
      const searchText = searchInput.value.toLowerCase();
      const statusFilter = filterStatus.value;
      const filteredApps = applications.filter(app => {
        const matchesSearch = app.title.toLowerCase().includes(searchText) || 
                              app.company.toLowerCase().includes(searchText) ||
                              app.status.toLowerCase().includes(searchText);
        const matchesStatus = statusFilter ? app.status === statusFilter : true;
        return matchesSearch && matchesStatus;
      });
      renderTable(filteredApps);
    }
  
    searchInput.addEventListener('input', filterApplications);
    filterStatus.addEventListener('change', filterApplications);
  
    // Initial render
    renderTable(applications);
  });
  