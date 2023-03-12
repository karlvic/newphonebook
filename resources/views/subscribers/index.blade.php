<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PB demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<body class="bg-secondary">

    <div class="container">

        <div class="row">
            <div class="search-container">
                <img src="https://cdn-icons-png.flaticon.com/512/183/183552.png" alt="PB icon" class="mt-3 mb-3"
                    width="80" height="100">
                @csrf
                <input type="text" id="search" name="search" placeholder="Search">
            </div>
        </div>
        <div class="row">
            <div class="col bg-primary">
                <p class="mt-3">Subscribers</p>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-light mb-3" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
                    Add
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">New Subscriber Information</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('saveUsers') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="z" placeholder="Password"
                                            name="firstname">
                                        <label for="z">First Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="x" placeholder="text"
                                            name="middlename">
                                        <label for="x">Middle Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="c" placeholder="Password"
                                            name="lastname">
                                        <label for="c">Last Name</label>
                                    </div>
                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                        name="gender">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="v" placeholder="Password"
                                            name="adds">
                                        <label for="v">Address</label>
                                    </div>
                                    <input type="hidden" name="deleted" value=0 id="">
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><br>

                <button id="edit-btn" class="btn btn-light mb-3">Edit</button><br>

                <!-- Button trigger modal -->
                <button type="button" id="providers-btn" disabled class="btn btn-light mb-3" data-bs-toggle="modal"
                    data-bs-target="#providersId">
                    Providers
                </button>

                @include('subscribers.providers')

            </div>

            <div class="col">
                <!-- Add the "editable-cell" class to the table cells that you want to be editable -->
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">LASTNAME</th>
                            <th scope="col">FIRSTNAME</th>
                            <th scope="col">MIDDLENAME</th>
                            <th scope="col">GENDER</th>
                            <th scope="col">ADDRESS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('subscribers.search-results')
                    </tbody>
                </table>
                <div class="pagination-container">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script>
        //Get search    
        $(document).ready(function() {
            $('#search').on('input', function() {
                var query = $(this).val();
                $.ajax({
                    url: '/subscribers/search',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $('tbody').html(response);
                        $('.edit-cell').off('click keypress');
                        applyEditFunctionality();
                    }
                });
            });

            function applyEditFunctionality() {
                var isEditing = false;
                var editingCell = null;
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $("#edit-btn").click(function() {
                    isEditing = true;
                    $(this).attr("disabled", true);
                });

                $("table td").click(function() {
                    if (isEditing && editingCell == null) {
                        editingCell = $(this);
                        var value = editingCell.text().trim();
                        editingCell.html("<input type='text' value='" + value + "'>");
                        editingCell.find("input").focus();
                    }
                });

                $("table td").on("keydown", "input", function(event) {
                    if (event.which == 13) {
                        event.preventDefault();
                        var value = $(this).val().trim();
                        var id = editingCell.parent().attr("id");
                        var column = editingCell.attr("data-column");

                        $.ajax({
                            url: "/subscriber/update",
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: {
                                id: id,
                                column: column,
                                value: value
                            },
                            success: function(response) {
                                editingCell.text(value);
                                editingCell = null;
                                isEditing = false;
                                $("#edit-btn").attr("disabled", false);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });

                $(document).click(function(event) {
                    if (isEditing && editingCell != null && !editingCell.is(event.target) && editingCell
                        .has(
                            event.target).length === 0) {
                        var value = editingCell.find("input").val().trim();
                        editingCell.text(value);
                        editingCell = null;
                        isEditing = false;
                        $("#edit-btn").attr("disabled", false);
                    }
                });
            }

            applyEditFunctionality();
        });
    </script>

    <script>
        $(document).ready(function() {
            var isEditing = false;
            var editingCell = null;
            var originalValue = null;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $("#edit-btn").click(function() {
                isEditing = true;
                $(this).attr("disabled", true);
            });

            $("table td").click(function() {
                if (isEditing && editingCell == null) {
                    editingCell = $(this);
                    originalValue = editingCell.text().trim();
                    var value = originalValue;
                    editingCell.html("<input type='text' value='" + value + "'>");
                    editingCell.find("input").focus();
                }
            });

            $("table td").on("keydown", "input", function(event) {
                if (event.which == 13) {
                    event.preventDefault();
                    var value = $(this).val().trim();
                    var id = editingCell.parent().attr("id");
                    var column = editingCell.attr("data-column");

                    $.ajax({
                        url: "/subscriber/update",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            id: id,
                            column: column,
                            value: value
                        },
                        success: function(response) {
                            editingCell.text(value);
                            editingCell = null;
                            isEditing = false;
                            $("#edit-btn").attr("disabled", false);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            $(document).click(function(event) {
                if (isEditing && editingCell != null && !editingCell.is(event.target) && editingCell.has(
                        event.target).length === 0) {
                    editingCell.text(originalValue);
                    editingCell = null;
                    originalValue = null;
                    isEditing = false;
                    $("#edit-btn").attr("disabled", false);
                }

                if ($(event.target).closest('table').length === 0) {
                    if (editingCell != null) {
                        editingCell.text(originalValue);
                        editingCell = null;
                        originalValue = null;
                    }
                    isEditing = false;
                    $("#edit-btn").attr("disabled", false);
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            var $tableRows = $('table tbody tr');
            var $providersBtn = $('#providers-btn');
            var selectedRowId = null;

            // Disable the providers button on page load
            $providersBtn.prop('disabled', true);

            // Listen for clicks on table rows
            $tableRows.click(function() {
                if ($(this).hasClass('active')) {
                    // If the clicked row is already active, remove the "active" class and disable the button
                    $(this).removeClass('active');
                    $providersBtn.prop('disabled', true);
                } else {
                    // If the clicked row is not active, remove "active" class from all rows, add it to the clicked row, and enable the button
                    $tableRows.removeClass('active');
                    $(this).addClass('active');
                    $providersBtn.prop('disabled', false);

                    // Get the ID of the clicked row
                    selectedRowId = $(this).attr('id');
                }
            });

            // Listen for clicks outside the table
            $(document).click(function(event) {
                if (!$(event.target).closest('table').length) {
                    // Remove active class from all rows
                    $tableRows.removeClass('active');

                    // Disable the providers button
                    $providersBtn.prop('disabled', true);

                    selectedRowId = null;
                }
            });

            // Listen for clicks on the providers button
            $providersBtn.click(function() {
                // Get the input values
                var provider = $('#z').val();
                var phoneNumber = $('#x').val();

                // Send the AJAX request to update the subscriber detail
                $.ajax({
                    url: '{{ route('saveProviders') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        provider: provider,
                        phoneNumber: phoneNumber,
                        headerId: selectedRowId,
                    },
                    success: function(response) {
                        // Do something on success, such as showing a success message
                        console.log('Subscriber detail updated successfully.');
                    },
                    error: function(xhr, status, error) {
                        // Do something on error, such as showing an error message
                        console.error('An error occurred while updating the subscriber detail:',
                            error);
                    }
                });

                // Close the modal
                $('#providersId').modal('hide');
            });
        });
    </script>




</body>

</html>
