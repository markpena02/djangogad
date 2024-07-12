$(document).ready(function() {
    // Sample data for file details
    var files = [
      { name: "Report2023.pdf", size: "1.5 MB", date: "2023-05-10" },
      { name: "Presentation2022.pptx", size: "3.2 MB", date: "2022-11-20" }
      // Add more files here if needed
    ];
  
    // Populate file details table
    var fileDetails = $('#fileDetails');
    files.forEach(function(file) {
      var row = $('<tr></tr>');
      row.append('<td>' + file.name + '</td>');
      row.append('<td>' + file.size + '</td>');
      row.append('<td>' + file.date + '</td>');
      row.append('<td><a href="#" class="btn btn-primary btn-sm">Download</a></td>');
      fileDetails.append(row);
    });
  
    // Download all files for a selected year
    $('.dropdown-item').click(function(e) {
      e.preventDefault();
      var year = $(this).data('year');
      alert('Downloading all files for ' + year); // Replace with actual download logic
    });
  
    // Handle file upload form submission
    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: 'upload.php', // Replace 'upload.php' with your actual server-side upload handler
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
          alert('File(s) uploaded successfully'); // Replace with actual success message or logic
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });
  });
  