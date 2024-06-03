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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add this script at the end of your HTML body -->
@section('content')

<div class="">
    @if (session('status'))
    <div class="alert alert-success" role="alert">

        {{ session('status') }}
    </div>
    @endif

    
    
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
                        
                            <p>
                                <h1 class="display-5 fw-bold">Welcome {{ $user->name }}</h1>
                                <p class="lead fw-bold">You are logged in as a  @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </p>
                            @hasanyrole(['admin', 'Superadmin'])
                            <button class="btn btn-success" onclick="window.location.href='{{ url('/home') }}'">Add Schedules</button>
                            <button class="btn btn-success" onclick="window.location.href='{{ url('/modify') }}'">Update Schedule</button>
                            <button class="btn btn-success" onclick="window.location.href='{{ url('/mutable') }}'">User Information Addition</button>
                            @endhasanyrole
                            <button class="btn btn-success" onclick="window.location.href='{{ url('/admin') }}'">Dashboards</button>
                            
                            @hasexactroles('user')
                            <button class="btn btn-success" onclick="window.location.href='{{ url('/mutable') }}'">Edit Schedules</button>
                            <button class="btn btn-success" onclick="window.location.href='{{ url('/viewdata') }}'">Verify Your Schedules</button>
                            @endhasexactroles
                            <br>
                          {{--                     
                            <div class="schedule-container">
                                <table id="schedule-table" class="table table-bordered" style="width: 100%; table-layout: fixed;">
                                <!-- Table Header -->
                                    <thead>
                                        <tr class="filters">
                                            <th style="width: 110px;"><b>name</b></th>
                                            <th style="width: 110px;"><b>Department</b></th>
                                            <th style="width: 90px;">Department_ID</th>
                                            
                                        </tr>
                                    </thead>
                                 <!-- Table Body -->
                                    <tbody>
                                        @foreach ($persons as $person)
                                        <tr>
                                            <td>{{ $person->name }}</td>
                                            <td>{{ optional($person->department)->name ?? 'N/A' }}</td>
                                            <td>{{ $person->dep_id }}</td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> --}}

                               
                       
                        


                        
                       
                        
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
</div>
@endif

{{ __('You are logged in!') }}
</div>
</div>
</div>
</div>
</div> --}}

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
