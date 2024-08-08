<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
      Person Activity Dashboard
    </title>
    
    <!-- Favicon -->
    <link href="./images/favicon.png" rel="icon" type="image/png"> 
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="./js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> --}}
    <link href="./css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
    
    {{-- {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
   <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script>
      $(document).ready(function () {
          $('input[type=date]').change(function () {
              this.form.submit();
          });
      
          $('.filterable .btn-filter').click(function () {
              // ... (your existing filter logic)
          });
      
          $('.filterable .filters input').keyup(function (e) {
              // ... (your existing filter logic)
          });
      
          $('#preview-btn').click(function () {
              previewTable();
          });
          $('#export-btn').click(function () {
            const table = $('.filterable .table')[0];
            const filterDate = $('#filter_date').val(); // Get the selected date

            // Check if there are rows in the table
            if ($(table).find('tbody tr').length > 0) {
                exportToExcel(table, filterDate);
            } else {
                // Show an alert when there's no data to export
                alert('No data available in the table for export.');
            }
        });

        function formatDateString(dateString) {
            const dateParts = dateString.split('-'); // Assuming date is in yyyy-mm-dd format
            const formattedDate = dateParts[2] + dateParts[1] + dateParts[0]; // Format to ddmmyyyy
            return formattedDate;
        }

        function exportToExcel(table, filterDate) {
            const headers = ['Day', 'Time From', 'Time To', 'Person', 'Activity', 'Class', 'Location', 'Remarks'];

            // Remove the "Action" header from headers
            const actionIndex = headers.indexOf('Action');
            if (actionIndex !== -1) {
                headers.splice(actionIndex, 1);
            }

            const dataRows = [];
            $('.filterable .table tbody tr').each(function () {
                const rowData = [];
                $(this).find('td:not(:last-child)').each(function () { // Exclude last td (Action column)
                    rowData.push($(this).text());
                });
                dataRows.push(rowData);
            });

            const ws = XLSX.utils.aoa_to_sheet([headers].concat(dataRows));

            // Format date as ddmmyyyy for sheet name
            const formattedDate = formatDateString(filterDate);
            const sheetName = 'Timetable_' + formattedDate; // Set the customized sheet name

            // Set font size
            ws['!cols'] = [{ wch: 12 }, { wch: 15 }, { wch: 15 }, { wch: 20 }, { wch: 20 }, { wch: 15 }, { wch: 20 }, { wch: 20 }];

            XLSX.utils.sheet_add_aoa(ws, [['Selected Date: ' + filterDate]], { origin: 'A1' });

            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, sheetName); // Set the customized sheet name
            XLSX.writeFile(wb, sheetName + '.xlsx'); // Set the filename with the customized sheet name
        }
    });
</script>

<script>
/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/



$(document).ready(function() {

  $('input[type=date]').change(function () {
    this.form.submit();
  });

    $('.filterable .btn-filter').click(function() {
        var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });
    $('.filterable .filters input').keyup(function(e) {
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function() {
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table
                .find('.filters th').length + '">No result found</td></tr>'));
        }
    });
});
</script>
</head>
<body class="">
  <style>
.btn-custom {
    background-color: #16A796;
    color: #fff; /* Optionally, change text color to white */
}
.btn-custom:hover {
    color: #575151; /* Change text color to white on hover */
}
.table-container {
    max-height: 550px; /* Adjust the height as needed */
    overflow-y: auto; /* Vertical scroll */
    position: relative;
}
.sticky-header {
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 100;
}
table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    .sticky-header th {
        position: sticky;
        top: 0;
        z-index: 100;
        background-color: #fff;
    }


  </style>
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
            <a class="btn btn-custom" href="{{url('/home')}}">
                <i class="ni ni-single-02 text-yellow"></i> Home
            </a>
            {{-- <a class="btn btn-custom mr-2" href="{{url('/admin')}}" target="_self">
                <i class="ni ni-key-25 text-info"></i> Person Activity
            </a> --}}
            <a class="btn btn-custom mr-2" href="{{url('/locationadmin')}}" target="_self">
                <i class="ni ni-key-25 text-info"></i> Campus Activity
            </a>
            <a class="btn btn-custom mr-2" href="{{url('/classadmin')}}" target="_self">
                <i class="ni ni-key-25 text-info"></i> Class Activity
            </a>
            
            <a class="btn btn-custom mr-2" href=" {{url('/roles')}}" target="_self">
                <i class="ni ni-key-25 text-info"></i> Location Activity
            </a>
            <a class="btn btn-custom mr-2" href="{{url('/getSchedules')}}" target="_self">
                <i class="ni ni-key-25 text-info"></i>Monthly Schedule
            </a>
            <a class="btn btn-custom mr-2" href="{{url('/mutable')}}" target="_self">
                <i class="ni ni-key-25 text-info"></i>Edit
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
                    href="{{url('/admin')}}">Person Activity Dashboard</a>
              
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
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-md-4 text-center">
                                    <div>
                                        <button id="export-btn" style="background-color: #1BA998; color: #FFFFFF;" class="btn">Export to Excel</button>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                               
                                <div class="divs">
                                    <form method="GET" id="filter_form">
                                      @php
                                        // $formattedDate =;
                                        // dd($formattedDate);
                                      @endphp
                                    
                                        <input type="date" id="filter_date" name="userdate" value="<?php echo date('Y-m-d', strtotime($currentdate)); ?>"/>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                
                            </div>
                        </div>
                    </div>
                           
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="panel panel-primary filterable">
                                <div class="panel-heading">
                                    <div class="col pull-right text-right">
                                  
                                        <button class="btn btn-primary btn-sm btn-filter"><span
                                                class="glyphicon glyphicon-filter"></span> Filter</button>
                                    </div>
                                    
                                    
                                    <h3 class="mb-10 panel-title"></h3>
                                </div>
                                <div class="table-container">
                                <table  class=" table table-bordered table-responsive" >
                                    <thead>
                                        <tr class="filters sticky-header">
                                            {{-- <th><input type="text" class="form-control" placeholder="Date" disabled></th> --}}
                                            <th><b><input type="text" class="form-control" placeholder="Day" disabled></b></th>
                                            <th><input type="text" class="form-control" placeholder="Time From"disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Time To" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Person" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Activity" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Class" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Location" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="Topic" disabled></th>
                                            {{-- <th><input type="text" class="form-control" placeholder="Action" disabled></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admindata as $data)
                                        <tr>
                                            {{-- <td>{{ \Carbon\Carbon::parse($data->date)->format('d F, Y') }}</td> --}}
                                            <td>{{$data->day}}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->time_from)->format('h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->time_to)->format('h:i A') }}</td>
                                            <td>{{ $data->user ? $data->user->name : 'Unknown' }}</td>
                                            <td>{{$data->activity->activity_name}} </td>
                                            <td>{{$data->class->class_name}} </td>
                                            <td>{{$data->location->location}} </td>
                                            <td>{{$data->remarks}}</td>
                                            {{-- <td>
                                              <a style="background-color: #1BA998; color: #fff;" href="edit/{{ $data->id }}" class="btn edit-button"><span class="edit-icon">&#9998;</span></a>
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- classtable -->
                                
                            </div>
                            {{-- <div class="col-md-1"></div>
          </div> --}}
                        </div>
                    </div>

                    </div>
                </div>

            </div>
            <!-- Footer -->
            {{-- <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer> --}}
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