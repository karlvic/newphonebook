<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PB demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
        rel="stylesheet" />
</head>

<body class="bg-secondary">

    <div class="container">

        <div class="row">
            <div class="search-container">
                <img src="https://cdn-icons-png.flaticon.com/512/183/183552.png" alt="PB icon" class="mt-3 mb-3"
                    width="80" height="100">
                @csrf
                <input type="text" class="form-floating" id="search" name="search" placeholder="Search">
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

                <br>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-light mb-3" data-bs-toggle="modal" data-bs-target="#providersId">
                    Providers
                </button>

                <!-- Modal -->
                <div class="modal fade" id="providersId" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="providers" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="providers">Providers</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('saveProviders') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="z" placeholder="text"
                                            name="provider">
                                        <label for="z">Provider</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="x" placeholder="text"
                                            name="phoneNumber">
                                        <label for="x">Phone Number</label>
                                    </div>
                                    <div class="">
                                        <table class="table table-hover text-center table-dark table-striped mt-3">
                                            <thead>
                                                <tr>
                                                    <th scope="col">PROVIDER</th>
                                                    <th scope="col">PHONENO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($providers as $item)
                                                    <tr>
                                                        <td>{{ $item->phoneno }}</td>
                                                        <td>{{ $item->provider }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
                </div>
            </div>
            <div class="col bg-primary">
                <div class="table-responsive">
                    <table class="table table-hover text-center table-dark table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">LASTNAME</th>
                                <th scope="col">FIRSTNAME</th>
                                <th scope="col">MIDDLENAME</th>
                                <th scope="col">GENDER</th>
                                <th scope="col">ADDRESS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('subscribers.search-results', ['users' => $users])
                        </tbody>
                    </table>
                </div>

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
        //Get table id
        $(document).ready(function() {
            $("tr").click(function() {
                var id = $(this).attr('id');
            });
            
        });
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
                    }
                });
            });
        });
    </script>


</body>

</html>
