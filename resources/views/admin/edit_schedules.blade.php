<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Scheduling System</title>
    <link rel="icon" href="{{ url('images/favicon.jpg') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="./js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- Icons font CSS-->
    <link href="asset/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="asset/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="./js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- Vendor CSS-->
    <link href="asset/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="asset/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('asset/css/main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

<!-- Add this script at the end of your HTML body -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add this script at the end of your HTML body -->


    

    <style>
        .form-control{
            text-align: left;
        }
        .dropdown-menu{
            width: 100%;
            padding-left: 8px;
            padding-right: 8px
        }
        .dropdown-menu {
            width: 100%;
            padding: 10px;
            max-height: 200px;
            overflow-y: auto;
        }
    
        .dropdown-item {
            display: block;
            width: 100%;
            padding: 5px;
            color: #333;
            text-decoration: none;
        }
    
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
    
        .input-group {
            margin-bottom: 10px;
        }
    </style>
    <style>
   
     
  #alert{
  display: none;
    }
    .error-msg,
    .warning-msg {
    width: 340px;
    margin: 10px 5px;
    padding: 10px;
    border-radius: 8px 4px 4px 4px;
    }
    .error-msg {
    color: #9F6000;
    background-color: #FEEFB3;
    }
    .warning-msg {
    color: #D8000C;
    background-color: #FFBABA;
    }
      input {
        width: 100%;
        box-sizing: border-box;
        color:"white";
        }
        input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        }
      
        body
         {background-color: #1BA998;
       


    align-content: center;
    }  .form-group {
        margin-bottom: 20px;
    }

    .input-label {
        display: block;
        margin-bottom: 5px;
        font-size: 16px;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    /* Custom styling for dropdowns */
    .form-control select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 30px; /* Adjust the value based on your design */
        background: url('path-to-your-arrow-icon.png') no-repeat right center; /* Replace with your arrow icon */
    }
    #successMessage .alert-success {
        background-color: #1BA998;
        border-color: #ffeeba;
        color: white;
    }

    #successMessage .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

        </style>
  

  <script>
    $(document).ready(function () {
      // Custom jQuery contains case-insensitive
      $.expr[":"].contains = $.expr.createPseudo(function (arg) {
          return function (elem) {
              return $(elem).text().toLowerCase().indexOf(arg.toLowerCase()) >= 0;
          };
      }); 
      
      // Search for persons in the dropdown
      $('#user_id').on('input', function () {
          var searchQuery = $(this).val().toLowerCase();
          
          // Find the dropdown container
          var dropdownContainer = $(this).closest('.dropdown');
          
          // Find and hide all .person-item elements within the dropdown container
          dropdownContainer.find('.person-item').hide();
          
          // Find and show .person-item elements containing the search query
          dropdownContainer.find('.person-item:contains("' + searchQuery + '")').show();
      });
  }); 
  </script>
  

</head>

<div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
    <div class="wrapper wrapper--w960">
        <div class="card card-2">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title">Update</h2>
                <form action="{{ url('/update-schedule', ['id' => $selectedIds[0]]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row p-4 justify-content-center" id="successMessage">
                    @if(session()->has('success') || $errors->any())
                        <div class="alert {{ $errors->any() ? 'alert-danger' : 'alert-success' }} error-msg">
                            <i class="{{ $errors->any() ? 'fa fa-exclamation-circle' : 'fa fa-check-circle' }}"></i>
                            {{ $errors->any() ? 'Error: ' : '' }}
                            @if(session()->has('success'))
                                {{ session()->get('success') }}
                            @elseif($errors->any())
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endif
                </div>
                <input type="hidden" name="selected_ids" value="{{ implode(',', $selectedIds) }}">
              
                    <!-- <label for="user_id" class="input-label">Person</label>
                    <select id="user_id" class="form-control" name="user_id[]" multiple>
                        {{-- @foreach ($users as $user)
                            <option value="{{ $user->userID }}" {{ $schedules[0]->user->userID == $user->userID ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach --}}
                    </select> -->



                    
                    <div class="col-md-6 removed" id="displayPerson">
                        <div class="form-group">
                          <div class="dropdown">
                            <label><b>Select Person:</b></label>
                            <div class="dropdown-menu" aria-labelledby="personsDropdown">
                              <!-- Move the search input here -->
                              <input type="text" id="user_id" class="form-control" placeholder="Search Persons...">
                              @foreach($users as $user)
                                <div class="form-check person-item">
                                  <input type="checkbox" name="user_id[]" id="" value="{{ $user->userID }}" class="form-check-input">
                                  <label class="form-check-label" for="">{{ $user->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
            <br>
            <br>
                <div class="input-group">
                <label for="remarks"><b>Remarks:</b></label>
                    <div class="rs-select2 js-select-simple select--no-search">
                    <input class="input--style-2" type="text" id="remarks" name="remarks" value="{{ $schedules[0]->remarks }}">
                        
                    </div>
                </div> 
                <div>
                    <button  type="submit" style="padding: 10px 20px; background-color: #1BA998; color: white; line-height: 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; text-decoration: none;">
                        Update
                    </button>
                    <br>
                    <br>
                    <button style="padding: 10px 20px; background-color: #1BA998; color: white; line-height: 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; text-decoration: none;">
                        <span style="margin-right: 5px; font-size: 12px; line-height: 12px;">&#8592;</span> <a href="{{ url('/mutable') }}">Go Back</a>
                    </button>
                    </div>
    </form>
                
                
                
                    
                    
            
            </div>
        </div>
    </div>
</div>
     
    <!-- Jquery JS-->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="asset/vendor/select2/select2.min.js"></script>
    <script src="asset/vendor/datepicker/moment.min.js"></script>
    <script src="asset/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="asset/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->