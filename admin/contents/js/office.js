document.addEventListener('DOMContentLoaded', () => {
    const campusForm = document.getElementById('campusForm');
    const campusTableBody = document.getElementById('campusTableBody');
    const collegeForm = document.getElementById('collegeForm');
    const collegeTableBody = document.getElementById('collegeTableBody');
    const officeForm = document.getElementById('officeForm');
    const officeTableBody = document.getElementById('officeTableBody');

    const collegeCampusSelect = document.getElementById('collegeCampus');
    const officeCampusSelect = document.getElementById('officeCampus');
    const officeCollegeSelect = document.getElementById('officeCollege');

    campusForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const campusName = document.getElementById('campusName').value;
        const campusAddress = document.getElementById('campusAddress').value;

        fetch('../../../controller/admin/add_campus.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ campus_name: campusName, campus_address: campusAddress })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                addRow(campusTableBody, [data.id, campusName, campusAddress], updateCampusSelects);
            } else {
                console.error(data.message);
            }
        });

        campusForm.reset();
        const modal = bootstrap.Modal.getInstance(document.getElementById('campusModal'));
        modal.hide();
    });

    collegeForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const collegeName = document.getElementById('collegeName').value;
        const collegeCampus = document.getElementById('collegeCampus').value;

        fetch('../../../controller/admin/add_college.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ college_name: collegeName, campus_id: collegeCampus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                addRow(collegeTableBody, [data.id, collegeName, collegeCampus], updateCollegeSelects);
            } else {
                console.error(data.message);
            }
        });

        collegeForm.reset();
        const modal = bootstrap.Modal.getInstance(document.getElementById('collegeModal'));
        modal.hide();
    });

    officeForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const officeName = document.getElementById('officeName').value;
        const officeCampus = document.getElementById('officeCampus').value;
        const officeCollege = document.getElementById('officeCollege').value;

        fetch('../../../controller/admin/add_office.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ office_name: officeName, campus_id: officeCampus, college_id: officeCollege })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                addRow(officeTableBody, [data.id, officeName, officeCampus, officeCollege]);
            } else {
                console.error(data.message);
            }
        });

        officeForm.reset();
        const modal = bootstrap.Modal.getInstance(document.getElementById('officeModal'));
        modal.hide();
    });

    function addRow(tableBody, cellValues, updateSelects) {
        const row = tableBody.insertRow();
        cellValues.forEach(value => {
            const cell = row.insertCell();
            cell.textContent = value;
        });
        const actionCell = row.insertCell();
        const editButton = document.createElement('button');
        editButton.textContent = 'Edit';
        editButton.className = 'btn btn-sm btn-secondary me-2';
        actionCell.appendChild(editButton);

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.className = 'btn btn-sm btn-danger';
        actionCell.appendChild(deleteButton);

        deleteButton.addEventListener('click', () => {
            tableBody.removeChild(row);
            if (updateSelects) updateSelects();
        });

        if (updateSelects) updateSelects();
    }

    function updateCampusSelects() {
        updateSelect(collegeCampusSelect, campusTableBody);
        updateSelect(officeCampusSelect, campusTableBody);
    }

    function updateCollegeSelects() {
        updateSelect(officeCollegeSelect, collegeTableBody);
    }

    function updateSelect(selectElement, tableBody) {
        selectElement.innerHTML = '';
        Array.from(tableBody.rows).forEach(row => {
            const option = document.createElement('option');
            option.value = row.cells[0].textContent;
            option.textContent = row.cells[1].textContent;
            selectElement.appendChild(option);
        });
    }

    function loadInitialData() {
        fetch('../../../controller/admin/get_initial_data.php')
        .then(response => response.json())
        .then(data => {
            data.campus.forEach(campus => {
                addRow(campusTableBody, [campus.campus_id, campus.campus_name, campus.campus_address], updateCampusSelects);
            });
            data.college.forEach(college => {
                addRow(collegeTableBody, [college.college_id, college.college_name, college.campus_id], updateCollegeSelects);
            });
            data.office.forEach(office => {
                addRow(officeTableBody, [office.office_id, office.office_name, office.campus_id, office.college_id]);
            });
        });
    }

    // Load initial data from the database
    loadInitialData();
});
