<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
      Dashboard
    </title>
    <!-- Favicon -->
    <link href="./images/favicon.png" rel="icon" type="image/png"> 
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="./js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="./css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
    
    {{-- {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
</head>

  <style>
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
.dropdown-menu {
    /* Other styles */
    overflow-y: auto; /* Ensure scrollbar is visible only when needed */
    max-height: 200px; /* Set a maximum height to enable scrolling */
}

.dropdown-menu::-webkit-scrollbar {
    width: 10px; /* Width of the scrollbar */
}

/* Track */
.dropdown-menu::-webkit-scrollbar-track {
    background: #f1f1f1; /* Color of the track */
}

/* Handle */
.dropdown-menu::-webkit-scrollbar-thumb {
    background: #888; /* Color of the scrollbar handle */
}

/* Handle on hover */
.dropdown-menu::-webkit-scrollbar-thumb:hover {
    background: #555; /* Color of the scrollbar handle on hover */
}
/* .body{
    overflow-y: hidden;
} */
</style>
<body>       
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
            <!-- User or any other elements you want -->
            <!-- ... -->
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
                <a class="btn btn-custom mr-2" href="{{url('/admin')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i> Person Activity
                </a>
                <a class="btn btn-custom mr-2" href="{{url('/classadmin')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i> Class Activity
                </a>
                <a class="btn btn-custom mr-2" href="{{url('/locationadmin')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i> Location Activity
                </a>
                <a class="btn btn-custom" href="{{url('/home')}}">
                    <i class="ni ni-single-02 text-yellow"></i> Home
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
                    href="{{url('/admin')}}">Dashboard</a>
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Header -->
        <div class="header bg-gradient-primary pb-1 pt-5 pt-md-8">
            <div class="container-fluid">
               
            </div>
        </div>
        <div class="container-fluid mt--7">
            <div class="row mt-5">
                <div class="col-xl-12 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-md-12 text-center">
                               
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                    <div class="panel-heading">
                        <form class="" method="GET" action="/getSchedules">
                            @csrf
                            <div class="container px-lg-5">
                                <div class="p-4 p-lg-5 rounded-3 text-center">
                                    <div class="content">
                                        <div class="container text-left">
                                            <div class="row justify-content-center given-mar">
                                                <div class="col-lg-10">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                
                                                                    <label for="class">Class</label>
                                                                    <div class="dropdown">
                                                                        <button class="form-control dropdown-toggle" type="button" id="classDropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            Select Class
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="classDropdown2">
                                                                            <input type="text" id="classSearch2" class="form-control" placeholder="Search Classes..." >
                                                                            @foreach($clas as $cl)
                                                                                <div class="form-check class-item2">
                                                                                    <input type="radio" name="class" id="class_{{ $cl->id }}" value="{{ $cl->id }}" class="form-check-input" >
                                                                                    <label class="form-check-label" for="class_{{ $cl->id }}">{{ $cl->class_name }}</label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="input_from">Date From</label>
                                                                <input type="date" data-date="" data-date-format="DD MMMM YYYY" min="0"
                                                                    name="start_date" class="form-control" id="start_date" placeholder="" style=""
                                                                    required value="<?php echo date('Y-m-d'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="input_to">Date To</label>
                                                                <input type="date" data-date="" data-date-format="DD MMMM YYYY"
                                                                    name="end_date" class="form-control" id="end_date"
                                                                    placeholder="End Date" required
                                                                    value="<?php echo date('Y-m-t', strtotime('0 months')); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                           
                                                                <div  class="col-md-4 col-sm-12" style="padding-top: 2.5rem;">
                                                                     <button type="submit"
                                                                            class="btn btn-success rounded-3 justify-content-center">Get Schedules
                                                                        </button></a>
                            
                                                                </div>
                                                            
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-wrapper">
                    @if($class)
                        <table class="table table-bordered table-responsive">
                            <thead style="text-align: center;">
                                <tr>
                                    <th colspan="{{ count($schedules) + 1 }}">Time Table For <span style="color: #448BC4"> {{ $class->class_name }}</span> From {{ \Carbon\Carbon::parse($startDate)->format('F jS, Y') }} 
                                        To {{ \Carbon\Carbon::parse($endDate)->format('F jS, Y') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules->groupBy('date') as $date => $daySchedules)
                                    <tr>
                                        <td> {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}
                                            <br>  {{ $daySchedules->first()->day }}</td>
                                        @foreach($daySchedules->groupBy('user.name') as $person => $schedulesByPerson)
                                            <td>
                                                <strong>{{ $person }}</strong><br>
                                                @foreach($schedulesByPerson as $schedule)
                                                    {{ \Carbon\Carbon::parse($schedule->time_from)->format('h:i A') }} - {{ \Carbon\Carbon::parse($schedule->time_to)->format('h:i A') }}<br>
                                                    {{ $schedule->remarks }}<br><br>
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                   
                
                    @else
        <p> Select a class to view its available information.</p>
    @endif
                </div>
                
                
                
            </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="col pull-right text-left">
        <h3 class="mb-10 panel-title"></h3>
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