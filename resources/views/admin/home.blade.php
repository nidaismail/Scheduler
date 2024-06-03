@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="fonts/icomoon/style.css">
<link rel="stylesheet" href="css/classic.css">
<link rel="stylesheet" href="css/classic.date.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/alert.css">
<link href="images/favicon.png" rel="icon" type="image/png">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<!-- Icons -->
<link href="./js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
<link href="./js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
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
@endpush

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add this script at the end of your HTML body -->
<script>
    $(document).ready(function() {
        // Check if jQuery is loaded
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded!');
        } else {
            console.log('jQuery is loaded!');
        }

        // Check for errors in the document ready block
        try {
            // Update the selector to target the radio buttons inside the class-item2
            $('.class-item2 input[type="radio"]').change(function() {
                // Get the selected class name
                var selectedClassName = $(this).next('label').text();

                // Update the label of the dropdown button with the ID classDropdown2
                $('#classDropdown2').html(selectedClassName + ' <span class="caret"></span>');
            });
        } catch (error) {
            console.error('Error in document ready block:', error);
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add this script at the end of your HTML body -->
<script>
    $(document).ready(function() {
        // Check if jQuery is loaded
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded!');
        } else {
            console.log('jQuery is loaded!');
        }

        // Check for errors in the document ready block
        try {
            // Update the selector to target the radio buttons inside the class-item
            $('.class-item input[type="radio"]').change(function() {
                // Get the selected class name
                var selectedClassName = $(this).next('label').text();

                // Update the label of the dropdown button with the selected class name
                $('#classDropdown').html(selectedClassName + ' <span class="caret"></span>');
            });
        } catch (error) {
            console.error('Error in document ready block:', error);
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('.class-item input[type="checkbox"]');
        var selectedClassInput = document.getElementById('selectedClass');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                var selectedClass = checkbox.parentElement.querySelector('label').innerText;

                // Update the input field with the selected class name
                selectedClassInput.value = selectedClass;
            });
        });
    });
</script>
<script>
function validate() {
    var valid = false;
    if (document.getElementById("dow1").checked) {
        valid = true;
    } else if (document.getElementById("dow2").checked) {
        valid = true;
    } else if (document.getElementById("dow3").checked) {
        valid = true;
    } else if (document.getElementById("dow4").checked) {
        valid = true;
    } else if (document.getElementById("dow5").checked) {
        valid = true;
    } else if (document.getElementById("dow6").checked) {
        valid = true;
    } else if (document.getElementById("dow7").checked) {
        valid = true;
    }
    if (valid) {
        console.log("done");
    } else {
        document.getElementById("alert").style.display = "block";
        return false;
    }
}
// This is for removing the div tag after a schedule is added ahh its a pop up actually or a better an alert. 
setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 4000);
// $('#alert').fadeOut('fast');
// }, 4000);
</script>
<script>$(document).ready(function () {
    // Attach change event listener to all checkboxes within person-item
    $('.person-item input[type="checkbox"]').on('change', function () {
        var dropdownId = $(this).closest('.dropdown-menu').attr('aria-labelledby');
        updateButtonText(dropdownId);
    });

    function updateButtonText(dropdownId) {
        var selectedPersons = [];
        // Loop through all checked checkboxes within the dropdown
        $('#' + dropdownId).siblings('.dropdown-menu').find('input[type="checkbox"]:checked').each(function () {
            var label = $(this).siblings('label').text();
            selectedPersons.push(label);
        });
        // Update the button text with the selected persons
        $('#' + dropdownId).text(selectedPersons.join(', ') || 'Select Persons');
    }
});
</script>
<script>
$(document).ready(function () {
    // Custom jQuery contains case-insensitive
    $.expr[":"].contains = $.expr.createPseudo(function (arg) {
        return function (elem) {
            return $(elem).text().toLowerCase().indexOf(arg.toLowerCase()) >= 0;
        };
    });

    // // Function to update the button text when a person is selected
    // function updateButtonText() {
    //     var selectedPersons = [];
    //     // Loop through all checked checkboxes and get their corresponding labels
    //     $('.person-item input[type="checkbox"]:checked').each(function () {
    //         var label = $(this).siblings('label').text();
    //         selectedPersons.push(label);
    //     });
    //     // Update the button text with the selected persons
    //     $('#personsDropdown').text(selectedPersons.join(', ') || 'Select Persons');
    // }

    // Search for persons in the dropdown
    $('#personSearch1, #personSearch2').on('input', function () {
        var searchQuery = $(this).val().toLowerCase();
        // Find the dropdown container
        var dropdownContainer = $(this).closest('.dropdown');
        // Find and hide all .person-item elements within the dropdown container
        dropdownContainer.find('.person-item').hide();
        // Find and show .person-item elements containing the search query
        dropdownContainer.find('.person-item:contains("' + searchQuery + '")').show();
        // Update the button text when searching
        updateButtonText();
    });

    $('#classSearch, #classSearch2').on('input', function () {
        var searchQuery = $(this).val().toLowerCase();
        // Find the dropdown container
        var dropdownContainer = $(this).closest('.dropdown');
        // Find and hide all .class-item elements within the dropdown container
        dropdownContainer.find('.class-item, .class-item2').hide();
        // Find and show .class-item elements containing the search query
        dropdownContainer.find('.class-item:contains("' + searchQuery + '"), .class-item2:contains("' + searchQuery + '")').show();
    });
});
    
</script>
<script>
    document.getElementById('start_time').addEventListener('change', function() {
        var selectedTime = this.value;
        var selectedHour = parseInt(selectedTime.split(':')[0]);
        var validationMessage = document.getElementById('timeValidationError');

        if (selectedHour < 8) {
            validationMessage.textContent = 'Time must be between 8 AM and 3 PM.';
            this.classList.add('is-invalid');
        } else {
            validationMessage.textContent = '';
            this.classList.remove('is-invalid');
        }
    });
</script>
@endpush


@section('content')

<div class="">
    @if (session('status'))
    <div class="alert alert-success" role="alert">

        {{ session('status') }}
    </div>
    @endif

    
    <form class="myform" method="POST" action="{{ route('save') }}" onsubmit="return validate();">
        @csrf
        <div class="container px-lg-5">
            
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                {{-- <div style="padding-top: 10px" class="col-md-4 col-sm-12">
                    <a href="{{ route('requestResource') }}"> <button type="button"
                            class="btn btn-success rounded-3 justify-content-center">Request a Resource</button></a>
                </div> --}}
                <div class="content">
                    <div class="container text-left">
                        <div class="row p-4 justify-content-center" id="successMessage">
                            @if(session()->has('success'))
                            <div class="alert alert-success">
                                <i class="fa fa-check-circle"></i>
                                {{ session()->get('success') }}
                            </div>
                            @endif
                        
                            @if(session()->has('error'))
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-circle"></i>
                                {{ session()->get('error') }}
                            </div>
                            @endif
                        </div>
                        <div id="alert" class="error-msg" role="alert">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <span style="">
                                Please Select a Day.
                            </span>
                        </div>
                        <div class="row justify-content-center given-mar">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            
                                            <label for="input_from">Select</label>
                                            <input type="radio" id="id" value="Class" name="category" class="pad">
                                            <label for="" class="cat">Class</label>
                                            <input type="radio" id="ids" value="Person" name="category"
                                                checked="checked">
                                            <label for="" class="cat">Person</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 removed" id="displayPerson">
                                        <div class="form-group">
                                            <label for="input_from">Person</label>
                                            <div class="dropdown">
                                                <button class="form-control dropdown-toggle" type="button" id="personsDropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select Persons
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="personsDropdown1">
                                                    <input type="text" id="personSearch1" class="form-control" placeholder="Search Persons...">
                                                    @foreach($persons as $person)
                                                        <div class="form-check person-item">
                                                            <input type="checkbox" name="persons[]" id="person_{{ $person->userID }}" value="{{ $person->userID }}" class="form-check-input">
                                                            <label class="form-check-label" for="person_{{ $person->userID }}">{{ $person->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-3 removedClass" id="displayClass">
                                        <div class="form-group">
                                            <label for="input_from">Class</label>
                                            <div class="dropdown">
                                                <button class="form-control dropdown-toggle @error('class') is-invalid @enderror" type="button" id="classDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select Class
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="classDropdown">
                                                    <input type="text" id="classSearch" class="form-control" placeholder="Search Classes...">
                                                    @foreach($clas as $cl)
                                                        <div class="form-check class-item">
                                                            <input type="radio" name="class" id="class_{{ $cl->id }}" value="{{ $cl->id }}" class="form-check-input" @if(old('class') == $cl->id) checked @endif>
                                                            <label class="form-check-label" for="class_{{ $cl->id }}">{{ $cl->class_name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @error('class')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="input_from">Date From</label>
                                            <input type="date" data-date="" data-date-format="DD MMMM YYYY" min="0"
                                                   name="start_date" class="form-control" id="start_date" placeholder=""
                                                   required value="{{ old('start_date', date('Y-m-d')) }}">
                                        </div>
 
                                     </div>
                                     <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="input_to">Date To</label>
                                            @php
                                                // Get the current year and month
                                                $currentYear = date('Y');
                                                $currentMonth = date('m');
                                                
                                                // Calculate the end date of the current month
                                                $endOfMonth = date('Y-m-t', strtotime("$currentYear-$currentMonth-01"));
                                            @endphp
                                            <input type="date" data-date="" data-date-format="DD MMMM YYYY"
                                                   name="end_date" class="form-control" id="end_date"
                                                   placeholder="End Date" required
                                                   value="{{ old('end_date', $endOfMonth) }}">
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div> 
                       
                        {{-- <div class="row justify-content-center given-mar">
                            <div class="col-lg-7">
                                <div action="#" class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input_from">Date From</label>
                                            <input type="date" data-date="" data-date-format="DD MMMM YYYY" min="0"
                                                   name="start_date" class="form-control" id="start_date" placeholder=""
                                                   required value="{{ old('start_date', date('Y-m-d')) }}">
                                        </div>
 
                                     </div>
                                    {{-- @php
                                    $today = \Carbon\Carbon::now(); //Current Date and Time
                                   $lastDayofMonth =    \Carbon\Carbon::parse($today)->endOfMonth()->toDateString();
                                   dd($lastDayofMonth);
                                   @endphp --}}
                                   {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="input_to">Date To</label>
                                        @php
                                            // Get the current year and month
                                            $currentYear = date('Y');
                                            $currentMonth = date('m');
                                            
                                            // Calculate the end date of the current month
                                            $endOfMonth = date('Y-m-t', strtotime("$currentYear-$currentMonth-01"));
                                        @endphp
                                        <input type="date" data-date="" data-date-format="DD MMMM YYYY"
                                               name="end_date" class="form-control" id="end_date"
                                               placeholder="End Date" required
                                               value="{{ old('end_date', $endOfMonth) }}">
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div> --}} 
                        <div class="row justify-content-center given-mar">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="input_from">Time From</label>
                                            <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" value="{{ old('start_time', '08:00') }}" required>
                                            @error('start_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="input_to">Time To</label>
                                            <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" value="{{ old('end_time', '15:00') }}" required>
                                            @error('end_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="size">Slot Size</label>
                                            <select name="size" id="size" class="form-control @error('size') is-invalid @enderror" required>
                                                <option value="" disabled>Select a Slot</option>
                                                
                                            </select>
                                            @error('activity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="dowPicker">
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow1" name="day[]" value="Sunday" class="@error('day') is-invalid @enderror" @if(old('day') && in_array('Sunday', old('day'))) checked @endif>
                                        <label for="dow1">Sun</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow2" name="day[]" value="Monday" class="@error('day') is-invalid @enderror" @if(old('day') && in_array('Monday', old('day'))) checked @endif>
                                        <label for="dow2">Mon</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow3" name="day[]" value="Tuesday" class="@error('day') is-invalid @enderror" @if(old('day') && in_array('Tuesday', old('day'))) checked @endif>
                                        <label for="dow3">Tue</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow4" name="day[]" value="Wednesday" class="@error('day') is-invalid @enderror" @if(old('day') && in_array('Wednesday', old('day'))) checked @endif>
                                        <label for="dow4">Wed</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow5" name="day[]" value="Thursday" class="@error('day') is-invalid @enderror" @if(old('day') && in_array('Thursday', old('day'))) checked @endif>
                                        <label for="dow5">Thur</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow6" name="day[]" value="Friday" class="@error('day') is-invalid @enderror" @if(old('day') && in_array('Friday', old('day'))) checked @endif>
                                        <label for="dow6">Fri</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow7" name="day[]" value="Saturday" class="@error('day') is-invalid @enderror" @if(old('day') && in_array('Saturday', old('day'))) checked @endif>
                                        <label for="dow7">Sat</label>
                                    </div>
                                </div>
                                @error('day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center given-mar">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="activity">Activity</label>
                                            <select name="activity" id="activity" class="form-control @error('activity') is-invalid @enderror" required>
                                                <option value="" disabled>Select Activity</option>
                                                @foreach($activities as $act)
                                                    <option value="{{$act->id}}" @if($act->id == old('activity', $defaultActivityId)) selected @endif>{{$act->activity_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('activity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <select name="location" id="location" class="form-control @error('location') is-invalid @enderror" required>
                                                <option value="" disabled selected>Select Location</option>
                                                @foreach($locations as $loc)
                                                    <option value='{{$loc->id}}' {{ old('location') == $loc->id ? 'selected' : '' }}>{{$loc->location}}</option>
                                                @endforeach
                                            </select>
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <br>
                                    <br>

                                    <div class="col-md-6 hidden" id="showPerson">
                                        <label for="persons[]">Person</label>
                                        <div class="form-group">
                                            <div class="dropdown">
                                                <button class="form-control dropdown-toggle" type="button" id="personsDropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select Persons
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="personsDropdown2">
                                                    <input type="text" id="personSearch2" class="form-control" placeholder="Search Persons...">
                                                    @foreach($persons as $person)
                                                        <div class="form-check person-item">
                                                            <input type="checkbox" name="persons[]" id="person_{{ $person->userID }}" value="{{ $person->userID }}" class="form-check-input" {{ in_array($person->userID, old('persons', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="person_{{ $person->userID }}">{{ $person->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @error('persons')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 hiddenClass" id="showClass">
                                        <label for="class">Class</label>
                                        <div class="form-group">
                                            <div class="dropdown">
                                                <button class="form-control dropdown-toggle" type="button" id="classDropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select Class
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="classDropdown2">
                                                    <input type="text" id="classSearch2" class="form-control" placeholder="Search Classes...">
                                                    @foreach($clas as $cl)
                                                        <div class="form-check class-item2">
                                                            <input type="radio" name="class" id="class_{{ $cl->id }}" value="{{ $cl->id }}" class="form-check-input" {{ old('class') == $cl->id ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="class_{{ $cl->id }}">{{ $cl->class_name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @error('class')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="remarks">Topic</label>
                                            <input type="text" name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror" value="{{ old('remarks') }}" required>
                                            @error('remarks')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-">
                                <div class="row">
                                    <div style="padding-top: 10px" class="col-md-4 col-sm-12">
                                        <a href="{{ route('save') }}" id="schedule-form"> <button type="submit"
                                                class="btn btn-success rounded-3 justify-content-center">Submit
                                            </button>
                                        </a>
                                    </div>
                                    <div style="padding-top: 10px" class="col-md-4 col-sm-12">
                                        <input type="reset" class="btn btn-success rounded-3 justify-content-center "
                                            name="Reset">
                                    </div>
                                    
                                    <div style="padding-top: 10px" class="col-md-4 col-sm-12">
                                        <a href="{{ url('/viewdata') }}"> <button type="button"
                                        class="btn btn-success rounded-3 justify-content-center">Preview</button></a>
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
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#start_time').change(function() {
                console.log('Time selected:', $(this).val());
                var selectedTime = $(this).val();
                var selectedHour = parseInt(selectedTime.split(':')[0]);
                var validationMessage = $('#timeValidationError');

                if (selectedHour < 8) {
                    validationMessage.text('Time must be between 8 AM and 3 PM.');
                    $(this).addClass('is-invalid');
                } else {
                    validationMessage.text('');
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
@push('script')


@endpush

@prepend('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script>
$(document).ready(function() {
    $('.person-input').change(function() {
        $('.person-input').val($(this).val())
    })
    $('.class-input').change(function() {
        $('.class-input').val($(this).val())
    })
    $("div.hidden").hide();
    $("div.removedClass").hide();
    $('#pers').prop('required', true);
    $('#cls').prop('required', false);
    $('#pers2').prop('required', false);
    $('#cls2').prop('required', true);
    // $("#display" + divalue).show();
    //         $("div.removed").not($("#display" + divalue)).hide();
    //         $("#show" + divalue).hide();
    //         $("div.hidden").not($("#show" + divalue)).show();

    $('input:radio[name="category"]').on('change', function() {
        var divalue = $(this).val();
        if (divalue == "") {
            $("div.hidden").hide();
            $("div.removed").hide();

        } else if (divalue == "Person") {
            $('#pers').prop('disabled', false);
            $('#cls').prop('disabled', false);
            $("#display" + divalue).show();
            $('#pers').prop('required', true);
            $('#cls').prop('required', false);
            $('#pers2').prop('required', false);
            $('#cls2').prop('required', true);

            // $("#ids").prop( "checked", false );
            $('#cls').prop('disabled', 'disabled');
            $("div.removedClass").not($("#display" + divalue)).hide();
            $("#show" + divalue).hide();
            $("#show" + divalue).prop('disabled', 'disabled');
            $("div.hiddenClass").not($("#show" + divalue)).show();
        } else if (divalue == "Class") {
            $('#pers').prop('disabled', false);
            $('#cls').prop('disabled', false);
            $('#cls').prop('required', true);
            $('#pers').prop('required', false);
            $('#pers2').prop('required', true);
            $('#cls2').prop('required', false);
            $("#display" + divalue).show();
            // $("#id").prop( "checked", false );
            $('#pers').prop('disabled', 'disabled');
            $("div.removed").not($("#display" + divalue)).hide();
            $("#show" + divalue).hide();
            $("div.hidden").not($("#show" + divalue)).show();
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#location').on('change', function() {

        var locationId = $(this).val();
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var startTime = $('#start_time').val();
        var endTime = $('#end_time').val();
        var selectedDays = [];
        $("input[name='day[]']:checked").each(function(index, obj) {
            selectedDays.push($(obj).val())
        });
        //'check-location-availability'
        $.ajax({
            url: '{{ route('check-location-availability') }}',
            method: 'POST',
            data: {
                location_id: locationId,
                start_date: startDate,
                end_date: endDate,
                start_time: startTime,
                end_time: endTime,
                selectedDays: JSON.stringify(selectedDays)
            },
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                }
            }
        });
    });

    $("input").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format(this.getAttribute("data-date-format"))
        )
    }).trigger("change")



});
</script>


@endprepend
