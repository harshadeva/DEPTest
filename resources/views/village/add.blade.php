@extends('layouts.main')
@section('psStyle')
    <style>


    </style>
@endsection
@section('psContent')
    <div class="page-content-wrapper">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" id="form1" role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible " id="errorAlert" style="display:none">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="gramasewaDivision" class="control-label">{{ __('Gramasewa Division') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span style="padding: 10px;"  class="input-group-text"><em class="mdi mdi-bank"></em></span>
                                        </div>
                                        <div  class="flex-fill">
                                        <select id="gramasewaDivision" name="gramasewaDivision" class="form-control noClear select2"
                                                onchange="setCustomValidity('');showTableData()"
                                                oninvalid="this.setCustomValidity('Please select gramasewa division')"
                                                required>
                                            <option value=""  selected>Select  gramasewa division</option>
                                            @if($gramasewaDivisions != null)
                                                @foreach($gramasewaDivisions as $gramasewaDivision)
                                                    <option value="{{$gramasewaDivision->idgramasewa_division}}">{{strtoupper($gramasewaDivision->name_en)}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->iduser_role == 3 || \Illuminate\Support\Facades\Auth::user()->iduser_role == 5)

                            <div class="form-group col-md-6">
                                <label for="village">{{ __('Village Name') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">EN</span>
                                        </div>
                                        <input autocomplete="off" type="text" class="form-control" required
                                               oninput="setCustomValidity('')"
                                               oninvalid="this.setCustomValidity('Please enter village name')"
                                               placeholder="Enter village name in english" name="village"
                                               id="village">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="village_si">ගම</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">SI</span>
                                        </div>
                                        <input autocomplete="off" type="text" class="form-control"
                                               oninput="setCustomValidity('')"
                                               oninvalid="this.setCustomValidity('Please enter village name')"
                                               placeholder="Enter village name in sinhala" name="village_si"
                                               id="village_si">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="village_ta">கிராமம்</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">TA</span>
                                        </div>
                                        <input autocomplete="off" type="text" class="form-control"
                                               oninput="setCustomValidity('')"
                                               oninvalid="this.setCustomValidity('Please enter village name')"
                                               placeholder="Enter village name in tamil" name="village_ta"
                                               id="village_ta">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3" style="margin-top: 20px;">
                                <button type="submit"
                                        class="btn btn-primary btn-block ">{{ __('Add Village') }}</button>
                            </div>
                            <div class="form-group col-md-2" style="margin-top: 20px;">
                                <button type="submit" onclick="clearAll();event.preventDefault();"
                                        class="btn btn-danger btn-block ">{{ __('Cancel') }}</button>
                            </div>
                                @endif
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="text-secondary">Villages <em id="count"></em></h6>
                            </div>
                            <div class="col-md-4 mb-1">
                                <input type="text" placeholder="Search village name here" class="float-right form-control" id="searchBox">
                            </div>

                            <div class="col-md-12">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table class="table table-striped table-bordered"
                                               cellspacing="0"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th>GRAMASEWA DIVISION</th>
                                                <th>ENGLISH</th>
                                                <th>SINHALA</th>
                                                <th>TAMIL</th>
                                                <th style='text-align:center;'>OPTIONS</th>
                                            </tr>
                                            </thead>
                                            <tbody id="villageTBody">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 " >
                                <button type="button" id="confirmBtn" onclick="confirm();event.preventDefault();"
                                        class="btn btn-primary btn-md float-right">{{ __('Confirm All Villages') }}</button>
                            </div>
                        </div>
                    </form> <!-- /form -->
                </div><!-- /card body -->
            </div><!-- /card -->

        </div> <!-- ./container -->
    </div><!-- ./wrapper -->


    <!-- modal start -->

    <div class="modal fade" id="updateModal" tabindex="-1"
         role="dialog"
         aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Update Village</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="updateForm" role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible " id="errorAlertUpdate" style="display:none">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="gramasewaDivisionU" class="control-label">{{ __('Gramasewa Division') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><em class="mdi mdi-bank"></em></span>
                                        </div>
                                        <select id="gramasewaDivisionU" name="gramasewaDivision" class="form-control"
                                                onchange="setCustomValidity('')"
                                                oninvalid="this.setCustomValidity('Please select gramasewa division')"
                                                required>
                                            <option value="" disabled selected>Select  gramasewa division</option>
                                            @if($gramasewaDivisions != null)
                                                @foreach($gramasewaDivisions as $gramasewaDivision)
                                                    <option value="{{$gramasewaDivision->idgramasewa_division}}">{{strtoupper($gramasewaDivision->name_en)}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="villageU">{{ __('Village Name') }}</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">EN</span>
                                        </div>
                                        <input autocomplete="off" type="text" class="form-control" required
                                               oninput="setCustomValidity('')"
                                               oninvalid="this.setCustomValidity('Please enter village name')"
                                               placeholder="Enter village name in english" name="village"
                                               id="villageU">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="village_siU">ගම</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">SI</span>
                                        </div>
                                        <input autocomplete="off" type="text" class="form-control"
                                               oninput="setCustomValidity('')" required
                                               oninvalid="this.setCustomValidity('Please enter village name')"
                                               placeholder="Enter village name in sinhala" name="village_si"
                                               id="village_siU">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="village_taU">கிராமம்</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">TA</span>
                                        </div>
                                        <input autocomplete="off" type="text" class="form-control"
                                               oninput="setCustomValidity('')" required
                                               oninvalid="this.setCustomValidity('Please enter village name')"
                                               placeholder="Enter village name in tamil" name="village_ta"
                                               id="village_taU">
                                    </div>
                                </div>
                            </div>
                            <input  type="hidden" name="updateId" id="updateId">
                            <div class="form-group col-md-6" style="margin-top: 20px;">
                                <button type="submit" onclick="clearAll();event.preventDefault();"
                                        class="btn btn-danger btn-block ">{{ __('Cancel') }}</button>
                            </div>
                            <div class="form-group col-md-6" style="margin-top: 20px;">
                                <button type="submit" form="updateForm"
                                        class="btn btn-primary btn-block ">{{ __('Update Village') }}</button>
                            </div>
                        </div>
                    </form> <!-- /form -->
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
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
            showTableData();
        });

        function clearAll() {
            $('input').not(".noClear").val('');
            $(":checkbox").attr('checked', false).trigger('change');
            $('select').not(".noClear").val('').trigger('change');
            $('#updateModal').modal('hide');

        }

        function showTableData() {
            let id = $('#gramasewaDivision').val();
            $.ajax({
                url: '{{route('getVillageByAuth')}}',
                type: 'POST',
                data:{id:id},
                success: function (data) {
                    if (data.success != null) {
                        let array = data.success;
                        if(array.length == 0){
                            $('#confirmBtn').hide();
                        }
                        else{
                            $('#confirmBtn').show();
                        }
                        $('#villageTBody').html('');
                        $('#count').html(' ( '+array.length+' )');
                        $.each(array, function (key1, value1) {
                            if(value1.status == 2) {
                                $('#villageTBody').append(
                                    "<tr data-id='" + value1.idgramasewa_division + "' id='" + value1.idvillage + "'>" +
                                    "<td>" + value1.gramasewa_division.name_en.toUpperCase() + "</td>" +
                                    "<td>" + value1.name_en.toUpperCase() + "</td>" +
                                    "<td>" + value1.name_si.toUpperCase() + "</td>" +
                                    "<td>" + value1.name_ta.toUpperCase() + "</td>" +
                                    "<td style='text-align: center;'>" +
                                    "<p>" +
                                    " <button type='button' " +
                                    "class='btn btn-sm btn-warning  waves-effect waves-light' onclick='showUpdateModal(" + value1.idvillage + ")'>" +
                                    " <i class='fa fa-edit'></i>" +
                                    "</button>" +
                                    " <button type='button' " +
                                    "class='btn btn-sm btn-danger  waves-effect waves-light'" +
                                    "onclick='deleteThis(" + value1.idvillage + ")'>" +
                                    " <i class='fa fa-trash'></i>" +
                                    "</button>" +
                                    " </p>" +
                                    " </td>" +
                                    "</tr>"
                                );
                            }else{
                                $('#villageTBody').append(
                                    "<tr data-id='" + value1.idgramasewa_division + "' id='" + value1.idvillage + "'>" +
                                    "<td>" + value1.gramasewa_division.name_en.toUpperCase() + "</td>" +
                                    "<td>" + value1.name_en.toUpperCase() + "</td>" +
                                    "<td>" + value1.name_si.toUpperCase() + "</td>" +
                                    "<td>" + value1.name_ta.toUpperCase() + "</td>" +
                                    "<td style='text-align: center;'>" +
                                    "<p>" +
                                    " <button title='Can not use this option on confirmed records' disabled type='button' " +
                                    "class='btn btn-sm btn-muted  waves-effect waves-light'>" +
                                    " <i class='fa fa-edit'></i>" +
                                    "</button>" +
                                    " <button  title='Can not use this option on confirmed records'  disabled type='button' " +
                                    "class='btn btn-sm btn-muted  waves-effect waves-light'>" +
                                    " <i class='fa fa-trash'></i>" +
                                    "</button>" +
                                    " </p>" +
                                    " </td>" +
                                    "</tr>"
                                );
                            }
                        });
                    }
                    else {
                        //initialize alert and variables
                        $('.notify').empty();
                        $('.alert').hide();
                        $('.alert').html("");
                        //initialize alert and variables end
                        $('#errorAlert').append('<p>Something Wrong!</p>');
                        $('html, body').animate({
                            scrollTop: $("body").offset().top
                        }, 1000);
                    }
                }


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

            //validation end

            if (completed) {

                $.ajax({
                    url: '{{route('saveVillage')}}',
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
                                title: 'VILLAGE SAVED!',
                                autoHide: true, //true | false
                                delay: 2500, //number ms
                                position: {
                                    x: "right",
                                    y: "top"
                                },
                                icon: '<em class="mdi mdi-check-circle-outline"></em>',

                                message: 'Village details saved successfully.'
                            });
                            clearAll();
                            showTableData();
                        }
                    }


                });
            }
            else {
                $('#errorAlert').html('Please provide all required fields.');
                $('#errorAlert').show();
                $('html, body').animate({
                    scrollTop: $("body").offset().top
                }, 1000);
            }
        });


        $("#searchBox").keyup(function () {

            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val();

            // Loop through the comment list
            $("tbody tr").each(function () {

                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).fadeOut();

                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).show();
                }
            });
        });

        function showUpdateModal(id) {
            $('#updateId').val(id);
            $('#gramasewaDivisionU').val($('#'+id).attr('data-id')).trigger('change');
            $('#villageU').val($('#'+id).find("td").eq(1).html());
            $('#village_siU').val($('#'+id).find("td").eq(2).html());
            $('#village_taU').val($('#'+id).find("td").eq(3).html());
            $('#updateModal').modal('show');
        }

        $("#updateForm").on("submit", function (event) {
            event.preventDefault();

            //initialize alert and variables
            $('.notify').empty();
            $('.alert').hide();
            $('.alert').html("");
            let completed = true;
            //initialize alert and variables end


            //validate user input

            //validation end

            if (completed) {

                $.ajax({
                    url: '{{route('updateVillage')}}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (data) {
                        if (data.errors != null) {
                            $('#errorAlertUpdate').show();
                            $.each(data.errors, function (key, value) {
                                $('#errorAlertUpdate').append('<p>' + value + '</p>');
                            });
                            $('html, body').animate({
                                scrollTop: $("body").offset().top
                            }, 1000);
                        }
                        if (data.success != null) {

                            notify({
                                type: "success", //alert | success | error | warning | info
                                title: 'GRAMASEWA DIVISION UPDATED!',
                                autoHide: true, //true | false
                                delay: 2500, //number ms
                                position: {
                                    x: "right",
                                    y: "top"
                                },
                                icon: '<em class="mdi mdi-check-circle-outline"></em>',

                                message: 'Gramasewa division details updated successfully.'
                            });
                            clearAll();
                            $('#updateModal').modal('hide');
                            showTableData();
                        }
                    }


                });
            }
            else {
                $('#errorAlert').html('Please provide all required fields.');
                $('#errorAlert').show();
                $('html, body').animate({
                    scrollTop: $("body").offset().top
                }, 1000);
            }
        });

        function confirm() {
            swal({
                title: 'Confirm All?',
                text:'You Will Need Administrator Permission To Revert This Process!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Confirm',
                cancelButtonText: 'No, cancel',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                buttonsStyling: false
            }).then(function () {

                $.ajax({
                    url: '{{route('confirmVillages')}}',
                    type: 'POST',
                    success: function (data) {
                        if (data.errors != null) {
                            notify({
                                type: "error", //alert | success | error | warning | info
                                title: 'PROCESS INVALID!',
                                autoHide: true, //true | false
                                delay: 2500, //number ms
                                position: {
                                    x: "right",
                                    y: "top"
                                },
                                icon: '<em class="mdi mdi-check-circle-outline"></em>',

                                message: 'Something wrong with process.contact administrator..'
                            });
                        }
                        if (data.success != null) {

                            notify({
                                type: "success", //alert | success | error | warning | info
                                title: 'VILLAGES CONFIRMED!',
                                autoHide: true, //true | false
                                delay: 2500, //number ms
                                position: {
                                    x: "right",
                                    y: "top"
                                },
                                icon: '<em class="mdi mdi-check-circle-outline"></em>',

                                message: 'villages confirmed successfully.'
                            });
                            showTableData();

                        }

                    }
                });

            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
//                if (dismiss === 'cancel') {
//                    swal(
//                        'Cancelled',
//                        'Process has been cancelled',
//                        'error'
//                    )
//                }
            })
        }



        function deleteThis(id) {
            swal({
                title: 'Delete?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Keep it',
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-success m-l-10',
                buttonsStyling: false
            }).then(function () {

                $.ajax({
                    url: '{{route('deleteVillage')}}',
                    data: {id: id},
                    type: 'POST',
                    success: function (data) {
                        if (data.errors != null) {
                            $.each(data.errors, function (key, value) {
                                notify({
                                    type: "error", //alert | success | error | warning | info
                                    title: 'PROCESS INVALID!',
                                    autoHide: true, //true | false
                                    delay: 5000, //number ms
                                    position: {
                                        x: "right",
                                        y: "top"
                                    },
                                    icon: '<em class="mdi mdi-check-circle-outline"></em>',

                                    message: value
                                });
                            });
                        }
                        if (data.success != null) {

                            notify({
                                type: "success", //alert | success | error | warning | info
                                title: 'VILLAGE DELETED!',
                                autoHide: true, //true | false
                                delay: 2500, //number ms
                                position: {
                                    x: "right",
                                    y: "top"
                                },
                                icon: '<em class="mdi mdi-check-circle-outline"></em>',

                                message: 'Village deleted successfully.'
                            });
                            showTableData();
                        }

                    }
                });

            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
//                if (dismiss === 'cancel') {
//                    swal(
//                        'Cancelled',
//                        'Process has been cancelled',
//                        'error'
//                    )
//                }
            })
        }
    </script>
@endsection