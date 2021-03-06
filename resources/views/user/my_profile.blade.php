@extends('layouts.main')
@section('psStyle')
    <style>
        input[type=radio] {
            border: 0px;
            width: 100%;
            height: 2em;
        }
    </style>
@endsection
@section('psContent')
    <div class="page-content-wrapper">

        <div class="container-fluid">

            <form class="form-horizontal" id="form1" role="form">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Profile Details') }}</h5>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible " id="errorAlert" style="display:none">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <input type="hidden" value="{{$user->idUser}}" id="userId" name="userId">
                            <input type="hidden" value="{{$user->iduser_role}}" id="userRole" name="userRole">
                            <div class="form-group col-md-3">
                                <label for="displayUserRole">{{ __('User Role') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em
                                                        class="mdi mdi-account-circle"></em></span>
                                        </div>
                                        <input readonly type="text" class="form-control"
                                               value="{{$user->userRole->role}}"
                                               placeholder="" name="displayUserRole" id="displayUserRole">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="title" class="control-label">{{ __('add_user_title') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em
                                                        class="mdi mdi-account-star-variant"></em></span>
                                        </div>
                                        <select id="title" class="form-control" name="title"
                                                onchange="setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Please select title')" required>
                                            <option value="" disabled selected>Select title</option>
                                            @if($userTitles != null)
                                                @foreach($userTitles as $userTitle)
                                                    <option value="{{$userTitle->iduser_title}}">{{$userTitle->name_en}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="firstName">{{ __('add_user_fname') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em class="mdi mdi-account"></em></span>
                                        </div>
                                        <input autocomplete="on" type="text" class="form-control" required
                                               oninput="setCustomValidity('')" value="{{$user->fName}}"
                                               oninvalid="this.setCustomValidity('Please enter first name')"
                                               placeholder="" name="firstName" id="firstName">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="lastName">{{ __('add_user_lname') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em
                                                        class="mdi mdi-account-multiple"></em></span>
                                        </div>
                                        <input autocomplete="on" type="text" class="form-control" required
                                               value="{{$user->lName}}"
                                               oninput="setCustomValidity('')"
                                               oninvalid="this.setCustomValidity('Please enter last name')"
                                               placeholder="" name="lastName" id="lastName">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 viewToggle">
                                <label for="nic">{{ __('NIC No') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em
                                                        class="mdi mdi-credit-card-scan"></em></span>
                                        </div>
                                        <input autocomplete="on" type="text" class="form-control" required
                                               value="{{$user->nic}}"
                                               oninput="setCustomValidity('')"
                                               oninvalid="this.setCustomValidity('Please Enter NIC No')"
                                               placeholder="" name="nic" id="nic">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 viewToggle">
                                <label for="email">{{ __('Email') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em class="mdi mdi-at"></em></span>
                                        </div>
                                        <input autocomplete="on" type="email" class="form-control"
                                               value="{{$user->email}}"
                                               placeholder="" name="email" id="email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 viewToggle">
                                <label for="phone">{{ __('Phone') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em
                                                        class="mdi mdi-phone-classic"></em></span>
                                        </div>
                                        <input autocomplete="on" type="number" class="form-control"
                                               value="{{$user->contact_no1}}"
                                               placeholder="" name="phone" id="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-8 viewToggle">
                                <label for="address">{{ __('Address') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em
                                                        class="mdi mdi-book-open"></em></span>
                                        </div>
                                        <input autocomplete="on" type="text" class="form-control"
                                               value="{{$user->address}}"
                                               placeholder="" name="address" id="address">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="username">{{ __('Username') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em
                                                        class="mdi mdi-account-settings"></em></span>
                                        </div>
                                        <input oninput="setCustomValidity('')"
                                               oninvalid="this.setCustomValidity('Please enter user name')"
                                               autocomplete="on" type="text" class="form-control" required
                                               value="{{$user->username}}"
                                               placeholder="" name="username" id="username">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 viewToggle">
                                <label for="dob">{{ __('Date of Birth') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em class="mdi mdi-calendar"></em></span>
                                        </div>
                                        <input autocomplete="off" type="text" class="form-control datepicker-autoclose"
                                               value="{{$user->bday}}"
                                               required onchange="setCustomValidity('')"
                                               oninvalid="this.setCustomValidity('Please enter a valid date')"
                                               placeholder="mm/dd/yyyy" name="dob" id="dob">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="oldPassword">{{ __('Old Password') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em class="mdi mdi-key"></em></span>
                                        </div>
                                        <input autocomplete="off" type="password" class="form-control"
                                               title="Password must contain: Minimum 6 characters"
                                               placeholder="Enter Old Password" pattern="^.{6,}$"
                                               name="oldPassword" id="oldPassword">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password">{{ __('New Password') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em class="mdi mdi-key-variant"></em></span>
                                        </div>
                                        <input autocomplete="off" type="password" class="form-control"
                                               title="Password must contain: Minimum 6 characters"
                                               placeholder="Enter New Password" pattern="^.{6,}$"
                                               name="password" id="password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password_confirmation">{{ __('password_confirmation') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em class="mdi mdi-key-variant"></em></span>
                                        </div>
                                        <input autocomplete="off" type="password" class="form-control"
                                               placeholder="Re-enter Password" name="password_confirmation"
                                               id="password_confirmation">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-md-4">
                                <label style="margin-left: 5px;" class="control-label ">{{ __('Gender') }}</label>
                                <div class="row">
                                    <label style="margin-left: 5px;" class="radio-inline"><input
                                                style="margin-left: 5px;" type="radio" value="1"
                                                name="gender">&nbsp;{{ __('Male') }}
                                    </label>
                                    &nbsp;
                                    &nbsp;
                                    <label style="margin-left: 5px;" class="radio-inline"><input
                                                style="margin-left: 5px;" type="radio" value="2"
                                                name="gender">&nbsp;{{ __('Female') }}</label>
                                    <label style="margin-left: 5px;" class="radio-inline"><input
                                                style="margin-left: 5px;" type="radio" value="3"
                                                name="gender">&nbsp;{{ __('Other') }}</label>
                                </div>
                            </div>
                        </div>
                        <div id="officeAdminDetails" style="display: none;" class="row">
                            <div class="form-group col-md-4">
                                <label for="payment">{{ __('Payment') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">RS.</span>
                                        </div>
                                        <input autocomplete="off" type="number" min="0"
                                               value="{{isset($user->officeAdmin) ? $user->officeAdmin->payment : ''}}"
                                               oninput="this.value = this.value < 0 ? 0 : this.value;"
                                               class="form-control"
                                               placeholder="0.00" id="payment" name="payment">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- /card body -->
                </div><!-- /card -->
                <br/>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title">{{ __('Setting') }}</h5>
                                <hr/>
                            </div>
                            <div class="col-md-6">
                                <h6>{{ __('SMS Alert on Login') }}</h6>
                                @if(\Illuminate\Support\Facades\Auth::user()->login_alert == 1 )

                                    <input type="checkbox" name="smsAlert"
                                           class="btn  btn-sm btn-danger" checked
                                           id="smsAlert"
                                           switch="none"/>
                                    <label for="smsAlert"
                                           data-on-label="On"
                                           data-off-label="Off"></label>
                                @else
                                    <input type="checkbox" name="smsAlert"
                                           class="btn  btn-sm btn-danger"
                                           id="smsAlert"
                                           switch="none"/>
                                    <label for="smsAlert"
                                           data-on-label="On"
                                           data-off-label="Off"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <button type="submit"
                                        class="btn btn-primary btn-block ">{{ __('Save Changes') }}</button>
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" onclick="clearAll();event.preventDefault();"
                                        class="btn btn-danger btn-block ">{{ __('add_user_cancel_btn') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> <!-- /form -->
        </div> <!-- ./container -->
    </div><!-- ./wrapper -->
@endsection
@section('psScript')

    <script language="JavaScript" type="text/javascript">
        $(document).ready(function () {
            initializeDate();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#userRole').val({{$user->iduser_role}}).trigger('change');
            $('#office').val({{$user->idoffice}}).trigger('change');
            $('#title').val({{$user->iduser_title}}).trigger('change');
            $("input:radio[value='{{$user->gender}}']").prop('checked', true);


        });

        function clearAll() {
            $('input').not('.noClear').val('').attr('checked', false);
            $('select').val('').trigger('change');
        }

        function initializeDate() {
            jQuery('.datepicker-autoclose').datepicker({
                autoclose: true,
                todayHighlight: true
            });

        }

        $("#form1").on("submit", function (event) {
            event.preventDefault();

            //initialize alert and variables
            $('.notify').empty();
            $('.alert').hide();
            $('.alert').html("");
            let completed = true;
            //initialize alert and variables end

            //validate user input
            let userRole = $('#userRole').val();

            //validation end

            if (completed) {

                $.ajax({
                    url: '{{route('updateUser')}}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (data) {
                        if (data.errors != null) {
                            $('#errorAlert').show();
                            $.each(data.errors, function (key, value) {
                                $('#errorAlert').append('<p>' + value + '</p>');
                            });
                            $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);
                        }
                        if (data.success != null) {

                            notify({
                                type: "success", //alert | success | error | warning | info
                                title: 'USER DETAILS UPDATED!',
                                autoHide: true, //true | false
                                delay: 2500, //number ms
                                position: {
                                    x: "right",
                                    y: "top"
                                },
                                icon: '<em class="mdi mdi-check-circle-outline"></em>',

                                message: 'User details updated successfully.'
                            });
                            window.location.replace("{{route('viewUser')}}");
//                            clearAll();
                        }
                    }


                });
            }
            else {
                $('#errorAlert').html('Please provide required fields.');
                $('#errorAlert').show();
                $('html, body').animate({
                    scrollTop: $("body").offset().top
                }, 1000);
            }
        });

    </script>
@endsection