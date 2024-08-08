<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Edit Schedules
    </title>
    <!-- Favicon -->
    <link href="./images/favicon.png" rel="icon" type="image/png"> 
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="./js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="./css/argon-dash.css?v=1.1.2" rel="stylesheet" />
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
</head>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var locationFilter = document.getElementById('location-filter');
        var applyButton = document.getElementById('applyLocationFilterBtn');
        applyButton.addEventListener('click', function () {
            var selectedLocation = locationFilter.value;
            console.log('Selected Location:', selectedLocation);
            // Hide all rows initially
            var allRows = document.querySelectorAll('.location-row');
            allRows.forEach(function (row) {
                row.style.display = 'none';
            });
            // Show rows based on the selected location
            if (selectedLocation === '') {
                // If 'All Locations' is selected, show all rows
                allRows.forEach(function (row) {
                    row.style.display = '';
                });
            } else {
                // Show rows matching the selected location
                var selectedRows = document.querySelectorAll('.location-row-' + selectedLocation);
                selectedRows.forEach(function (row) {
                    row.style.display = '';
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#locationSearch').on('keyup', function() {
            var searchText = $(this).val().toLowerCase(); // Get the search text
            $('.location-item').each(function() {
                var locationText = $(this).text().toLowerCase(); // Get the location text
                var containsText = locationText.includes(searchText); // Check if location text contains search text
                $(this).toggle(containsText); // Show/hide based on search
            });
        });
    });  
</script>
<script>
   $(document).ready(function() {
    $('#classSearch').on('keyup', function() { // Update ID here
        var searchText = $(this).val().toLowerCase(); // Get the search text
        $('.class-item').each(function() {
            var classText = $(this).text().toLowerCase(); // Get the class text
            var containsText = classText.includes(searchText); // Check if class text contains search text
            $(this).toggle(containsText); // Show/hide based on search
        });
    });
});
</script>
<script>
$(document).ready(function() {
    // Toggle dropdown when button is clicked
    $('.dropdown-toggle').click(function() {
        // Close all other dropdowns
        $('.dropdown-menu').removeClass('show');
        // Toggle current dropdown
        $(this).next('.dropdown-menu').toggleClass('show');
    });
    // Close dropdown when clicking outside
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.dropdown').length) {
            $('.dropdown-menu').removeClass('show');
        }
    });
    // Search users in dropdown
    $('.user-search').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        $(this).siblings('.dropdown-checkbox-list').find('.form-check').each(function() {
            var userName = $(this).find('.form-check-label').text().toLowerCase();
            if (userName.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    // Update button text based on selected checkboxes
    $('.dropdown-checkbox-list input[type="checkbox"]').change(function() {
        var selectedUsers = [];
        // Find checkboxes within the same row
        $(this).closest('tr').find('.dropdown-checkbox-list input[type="checkbox"]:checked').each(function() {
            selectedUsers.push($(this).next('label').text());
        });
        var buttonText = selectedUsers.length > 0 ? selectedUsers.join(', ') : 'Select Users';
        $(this).closest('.dropdown').find('.dropdown-toggle').text(buttonText);
    });
});
</script>
<style>
    .form-group {
    margin-bottom: 0rem !important; 
    }
    .dropdown-menu {
        max-height: 200px; /* Set max height to enable scrolling */
        overflow-y: auto; /* Enable vertical scrollbar */
    }
    /* WebKit-specific scrollbar styles */
    .dropdown-menu::-webkit-scrollbar {
        width: 8px; /* Width of the scrollbar */
    }
    .dropdown-menu::-webkit-scrollbar-track {
        background: #f1f1f1; /* Track color */
    }
    .dropdown-menu::-webkit-scrollbar-thumb {
        background-color: #888; /* Thumb color */
        border-radius: 10px; /* Rounded corners */
    }
    /* Hide the default scrollbar in other browsers */
    .dropdown-menu {
        scrollbar-width: thin; /* Firefox */
        scrollbar-color: #f1f1f1 #888; /* Firefox scrollbar color */
    }
    .body{}
    /* CSS to set the text color based on background color */
    td[data-color="red"] {
        background-color: red;
        color: white; /* Text color for red cells */
    }
    td[data-color="green"] {
        background-color: green;
        color: black; /* Text color for green cells */
    }
    .table-wrapper {
    overflow-x: auto; /* Enable horizontal scrolling */
    max-width: 100%; /* Ensure the table wrapper doesn't overflow */
    max-height: 600px;
    overflow-y: auto;
   }
.table {
    border-collapse: collapse;
    width: 100%;
    table-layout: fixed; /* Important for fixed column width */
}
.static-column {
    position: sticky;
    left: 0;
    background-color: white;
    z-index: 1;
    /* Set width for the static columns */
    width: 170px; /* Adjust according to your needs */
}
.static-column + .static-column {
    margin-left: -1px; /* Adjust for any gap caused by default spacing */
}
.static-column:nth-child(2) {
    left: 171px;
    width: 280px;
}
.static-column:nth-child(3) {
    left: 320px;
    width: 310px;/* Adjust based on the width of the first static column */
}
.btn-custom {
    background-color: #16A796;
    color: #fff; /* Optionally, change text color to white */
}
.btn-custom:hover {
    color: #575151; /* Change text color to white on hover */
}
#locationDropdown + .dropdown-menu {
    width: 100%;
    max-height: 300px;
    overflow-y: auto;
    padding: 10px;
}
#classDropdown + .dropdown-menu {
    width: 100%;
    max-height: 300px;
    overflow-y: auto;
    padding: 10px;
}
/* Style for the search input */
#locationSearch {
    width: calc(100% - 20px);
    margin-bottom: 10px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
#classSearch {
    width: calc(100% - 20px);
  
    margin-bottom: 10px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.class-item {
    margin-bottom: 5px;
    display: flex;
    margin-left: 10px;
    align-items: center;
}
/* Style for individual location items */
.location-item .class-item {
    margin-bottom: 5px;
    display: flex;
    align-items: center;
}
/* Style for radio buttons */
.class-item input[type="radio"] {
    margin-right: 5px;
    transform: scale(1.2); /* Increase the radio button size */
}
.class-item label {
    cursor: pointer;
}
/* Style for radio buttons */
.location-item input[type="radio"] {
    margin-right: 5px;
    transform: scale(1.2); /* Increase the radio button size */
}
/* Style for the labels of location items */
.location-item label {
    cursor: pointer;
}
.button-container {
    display: flex; /* Use flexbox to position buttons side by side */
    align-items: center; /* Align buttons vertically in the container */
    }
#updateButtonContainer {
    display: none;
    margin-left: 10px; /* Add some space between the buttons */
    }
.dropdown-checkbox-list .form-check {
    margin-left: 20px;
}
.user-search {
    margin-left: 20px; /* Adjust the margin as needed */
    margin-right: 10px; /* Adjust the right margin as needed */
    max-width: calc(100% - 30px); /* Calculate the max width considering both margins */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}
.schedule-container {
    max-height: 380px; /* Adjust the max-height as needed */
    overflow-y: auto;
    margin-top: 1.5rem;
}
.schedule-container table {
    border-collapse: collapse;
    width: 100%;
}
.schedule-container th, .schedule-container td {
    padding: 8px;
    text-align: left;
}
.schedule-container thead {
    background-color: #fff;
}
.schedule-container th {
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 1;
}
@media (max-width: 767px) {
    .btn {
        margin-left: 0px !important;
        margin-top: 1rem !important;
    }
    .col-md-3{
        padding-left: 0% !important;
    }
    label {
    display: inline-block;
    margin-bottom: 1.5rem;
    margin-top: 0.5rem;
    padding-left: 0px !important;
}
}
</style>
<script>
 $(document).ready(function() {
    $('#editSelectedButton').on('click', function() {
        // Show the hidden columns for Person and Remarks
        $('#personColumn').show();
        $('#remarksColumn').show();

        // Show the hidden columns for Person and Remarks in the table body
        $('.personData').show();
        $('.remarksData').show();

        // Show the Update button
        $('#updateButtonContainer').show();
        $('#editSelectedButton').hide();
    });
    // Click event handler for the Update button
    $('#updateButton').on('click', function() {
        var updatedData = [];
        // Loop through each row in the table
        $('tbody tr').each(function() {
            var rowData = {};
            var scheduleId = $(this).find('.schedule-id').text().trim(); // Retrieve schedule ID from hidden <td>
            rowData.scheduleId = scheduleId;
            // Initialize an array to store the selected user IDs
            var selectedUsers = [];
            // Find all checked checkboxes within the .personData container
            $(this).find('.personData input[type="checkbox"]:checked').each(function() {
                selectedUsers.push($(this).val()); // Add the value of each checked checkbox to the selectedUsers array
            });
            rowData.person = selectedUsers; // Assign the array of selected user IDs to the rowData object
            // Retrieve remarks from the corresponding input field
            rowData.remarks = $(this).find('.remarksData input').val();
            updatedData.push(rowData);
        });
        console.log('Updated Data:', updatedData);
        // Add CSRF token to headers
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        // Send the updated data to the server using AJAX
        $.ajax({
            url: '/updateSchedules', // Update with your server endpoint
            type: 'POST',
            data: JSON.stringify(updatedData),
            contentType: 'application/json',
            success: function(response) {
                // Handle success response
                alert('Schedules updated successfully.');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error('Error updating schedules:', error);
                alert('An error occurred while updating schedules.');
            }
        });
    });
});
</script>
<body class="">
    <header class="navbar navbar-expand-md navbar-light bg-white">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="https://www.anth.pk/" target="_blank">
                <img src="./images/brand/CIRS.png" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <!-- Collapse content -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="https://www.anth.pk/" target="_blank">
                            <img src="./images/brand/CIRS.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <a class="btn btn-custom" href="{{url('/home')}}">
                    <i class="ni ni-single-02 text-yellow"></i> Home
                </a>
                <a class="btn btn-custom mr-2" href="{{url('/classadmin')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i> Class Activity
                </a>
                <a class="btn btn-custom mr-2" href="{{url('/locationadmin')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i> Campus Activity
                </a>
                <a class="btn btn-custom mr-2" href="{{url('/getSchedules')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i>Monthly Schedule
                </a>
                <a class="btn btn-custom mr-2" href="{{url('/admin')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i> Person Activity
                </a>
            </div>
        </div>
    </header>
      <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"
                    href="{{url('/admin')}}">Edit Schedules</a>
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Header -->
        <div class="header bg-gradient-primary pb-1 pt-1 pt-md-8">
            <div class="container-fluid">  
            </div>
        </div>
        <div class="container-fluid mt--7">
            <div class="row mt-5">
                <div class="col-xl-12 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0 " style="padding-left: 3rem;">
                            <div class="row align-items-center">
                                <div class="col-md-12 text-center">
                                <div class="divs">
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                    <div class="panel-heading">
                        <form class="" method="GET" action="{{ url('/mutable') }}"> <!-- Adjust the route name as per your routes file -->
                            @csrf
                            <div class="container">
                                <div class="rounded-3 text-center">
                                    <div class="content">
                                        <div class="container text-left">
                                            <div class="row justify-content-center given-mar">
                                                <div class="col-lg-12">
                                                    <div class="row justify-content-between">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="input_from" style="color: grey; font-size: 16px; font-weight: bold; text-transform: uppercase;">Date From</label>
                                                                <input type="date" data-date="" data-date-format="DD MMMM YYYY" min="0"
                                                                    name="start_date" class="form-control" id="start_date" placeholder=""
                                                                    style="" required value="{{ date('Y-m-d') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="input_to" style="color: grey; font-size: 16px; padding-left:14px; font-weight: bold; text-transform: uppercase;">Date To</label>
                                                                <input type="date" data-date="" data-date-format="DD MMMM YYYY"
                                                                    name="end_date" class="form-control" id="end_date"
                                                                    placeholder="End Date" required
                                                                    value="{{ date('Y-m-t', strtotime('0 months')) }}">
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-1"></div> --}}
                                                        <div class="col-md-3">
                                                            <div style="padding-left: 0rem; ">
                                                                <div class="form-group">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-success form-control dropdown-toggle btn-block" type="button" id="locationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 1.8rem;">
                                                                            Select location
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="locationDropdown">
                                                                            <input type="text" id="locationSearch" class="form-control" placeholder="Search Locations...">
                                                                            @foreach($locations as $location)
                                                                            <div class="form-check location-item">
                                                                                <input type="radio" name="location" id="location_{{ $location->id }}" value="{{ $location->id }}" class="form-check-input me-2">
                                                                                <label class="form-check-label" for="location_{{ $location->id }}">{{ $location->location }}</label>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-1"></div> --}}
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-success form-control dropdown-toggle btn-block" type="button" id="classDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 1.8rem;">
                                                                        Select Class
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="classDropdown"> <!-- Change the ID here -->
                                                                        <input type="text" id="classSearch" class="form-control" placeholder="Search class...">
                                                                        @foreach($classes as $class)
                                                                        <div class="form-check class-item">
                                                                            <input type="radio" name="class" id="class_{{ $class->id }}" value="{{ $class->id }}" class="form-check-input me-2">
                                                                            <label class="form-check-label" for="class_{{ $class->id }}">{{ $class->class_name }}</label>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-1"></div> --}}
                                                        <div class="col-md-2"><button type="submit" class="btn btn-success rounded-3  btn-block" style="margin-top: 1.8rem ; margin-left: 3.8rem;">Get Schedules</button>
                                                        </div>
                                                            

                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if(isset($schedules))
                            @if(isset($_GET['location']) && isset($_GET['class']) && isset($_GET['start_date']) && isset($_GET['end_date']))
                                @php
                                    $selectedLocationId = $_GET['location'];
                                    $selectedClassId = $_GET['class'];
                                    $selectedLocation = $locations->firstWhere('id', $selectedLocationId);
                                    $selectedClass = $classes->firstWhere('id', $selectedClassId);
                                    $startDate = $_GET['start_date'];
                                    $endDate = $_GET['end_date'];
                                @endphp
                                @if($selectedLocation && $selectedClass)
                                    <p style="text-align: center; margin:1rem;">
                                        <span style="font-weight: bold;">
                                            Schedules for 
                                            <span style="color:#2DCE89;">{{ $selectedLocation->location }}</span>
                                            and
                                            <span style="color:#2DCE89;">{{ $selectedClass->class_name }}</span>
                                            From
                                            <span style="color:#2DCE89;">{{ date('d-m-Y', strtotime($startDate)) }}</span>
                                            To
                                            <span style="color:#2DCE89;">{{ date('d-m-Y', strtotime($endDate)) }}</span>
                                        </span>
                                    </p>
                                @endif
                            @else
                                @if(isset($_GET['location']) && isset($_GET['start_date']) && isset($_GET['end_date']))
                                    @php
                                        $selectedLocationId = $_GET['location'];
                                        $selectedLocation = $locations->firstWhere('id', $selectedLocationId);
                                        $startDate = $_GET['start_date'];
                                        $endDate = $_GET['end_date'];
                                    @endphp
                                @if($selectedLocation)
                                    <p style="text-align: center; margin:1rem;">
                                        <span style="font-weight: bold;">
                                            Schedules for 
                                            <span style="color:#2DCE89;">{{ $selectedLocation->location }}</span>
                                            From
                                            <span style="color:#2DCE89;">{{ date('d-m-Y', strtotime($startDate)) }}</span>
                                            To
                                            <span style="color:#2DCE89;">{{ date('d-m-Y', strtotime($endDate)) }}</span>
                                        </span>
                                    </p>
                                @endif
                            @endif
                            @if(isset($_GET['class']) && isset($_GET['start_date']) && isset($_GET['end_date']))
                                @php
                                    $selectedClassId = $_GET['class'];
                                    $selectedClass = $classes->firstWhere('id', $selectedClassId);
                                    $startDate = $_GET['start_date'];
                                    $endDate = $_GET['end_date'];
                                @endphp

                                @if($selectedClass)
                                    <p style="text-align: center; margin:1rem;">
                                        <span style="font-weight: bold;">
                                            Schedules for 
                                            <span style="color:#2DCE89;">{{ $selectedClass->class_name }}</span>
                                            From
                                            <span style="color:#2DCE89;">{{ date('d-m-Y', strtotime($startDate)) }}</span>
                                            To
                                            <span style="color:#2DCE89;">{{ date('d-m-Y', strtotime($endDate)) }}</span>
                                        </span>
                                    </p>
                                @endif
                            @endif
                        @endif
                        <div class="schedule-container">
                            <table id="schedule-table" class="table table-bordered" style="width: 100%; table-layout: fixed;">
                            <!-- Table Header -->
                                <thead>
                                    <tr class="filters">
                                        <th style="width: 110px;"><b>Date</b></th>
                                        <th style="width: 110px;"><b>Day</b></th>
                                        <th style="width: 90px;">Time From</th>
                                        <th style="width: 90px;">Time To</th>
                                        <th style="width: 200px;">Person</th>
                                        <th style="width: 150px;">Activity</th>
                                        <th style="width: 120px;">Class</th>
                                        <th style="width: 200px;">Location</th>
                                        <th style="width: 200px;">Topic</th>
                                        <th id="personColumn" style="display: none; width: 180px;">Person</th>
                                        <th id="remarksColumn" style="display: none; width: 180px;">Topic</th>
                                    </tr>
                                </thead>
                             <!-- Table Body -->
                                <tbody>
                                    @foreach ($schedules as $schedule)
                                    <tr>
                                        <td class="schedule-id" style="display: none;"> {{ $schedule->id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d F, Y') }}</td> 
                                        <td>{{ date('l', strtotime($schedule->date)) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule->time_from)->format('h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule->time_to)->format('h:i A') }}</td>
                                        <td>{{ $schedule->user ? $schedule->user->name : 'No User' }}</td>
                                        <td>{{ $schedule->activity->activity_name }}</td>
                                        <td>{{ $schedule->class->class_name }}</td>
                                        <td>{{ $schedule->location->location }}</td>
                                        <td>{{ $schedule->remarks }}</td>
                                        {{-- <td>
                                            <input type="checkbox" class="schedule-checkbox individualCheckbox" data-schedule-id="{{ $schedule->id }}">
                                        </td> --}}
                                        <td class="personData" style="display: none;">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown_{{ $schedule->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select Users
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="userDropdown_{{ $schedule->id }}">
                                                    <input type="text" class="form-control user-search" placeholder="Search users...">
                                                    <div class="dropdown-checkbox-list">
                                                        @foreach ($users as $user)
                                                            <div class="form-check user-item">
                                                                <input class="form-check-input" type="checkbox" id="user_{{ $schedule->id }}_{{ $user->id }}" value="{{ $user->userID }}" name="user_ids[]">
                                                                <label class="form-check-label" for="user_{{ $schedule->id }}_{{ $user->id }}">
                                                                    {{ $user->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="remarksData" style="display: none;">
                                            <input type="text" class="form-control" value="{{ $schedule->remarks }}">
                                        </td>
                                        {{-- <td>
                                            <a style="background-color: #1BA998; color: #fff;" href="edit/{{ $schedule->id }}" class="btn edit-button"><span class="edit-icon">&#9998;</span></a>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                        @endif
                        <div class = "button-container">
                            <button id="editSelectedButton" class="btn btn-primary">Edit Selected Schedules</button>
                            <div id="updateButtonContainer" style="display: none;">
                                <button id="updateButton" class="btn btn-primary">Update Selected Schedules</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--   Core   -->
<script src="./js/plugins/jquery/dist/jquery.min.js"></script>
<script src="./js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!--   Optional JS   -->
<script src="./js/plugins/chart.js/dist/Chart.min.js"></script>
<script src="./js/plugins/chart.js/dist/Chart.extension.js"></script>
<!--   Argon JS   -->
<script src="./js/argon-dashboard.min.js?v=1.1.2"></script>
<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
<script>
    // Initialize Bootstrap tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script>
    $(document).ready(function() {
        $('#filter_date').change(function() {
            $('#filter_form').submit();
        })
       
    })
    window.TrackJS &&
        TrackJS.install({
            token: "ee6fab19c5a04ac1a32a645abde4613a",
            application: "argon-dashboard-free"
        });          
</script>
</body>
</html>