<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Todo List</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<main role="main">
    <div class="jumbotron">
        <div class="container">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="row">
                <div class="col-md-4 order-md-2">
                    <h4 class="mb-3">Create Activity</h4>
                    <form class="needs-validation" novalidate="" method="post" action="{{ route("add-activities") }}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <div class="mb-3">
                            <label for="username">Title</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                       required="">
                                <div class="invalid-feedback" style="width: 100%;">
                                    Your username is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description"
                                      placeholder="Description" required=""></textarea>
                        </div>

                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
                    </form>
                </div>

                <div class="col-md-8 order-md-1 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your list</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach($data as $activity)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div class="col-md-1">
                                    <h6></h6>
                                    @if($activity->type != "active")
                                        <input type="checkbox" name="check" checked disabled>
                                    @else
                                        <input type="checkbox" id="checked" name="checked" value="{{ $activity->id }}">
                                    @endif
                                </div>

                                <div class="col-md-9">
                                    <h6 class="my-0">{{ $activity->name }}</h6>
                                    <small class="text-muted">{{ $activity->description }}</small>
                                </div>

                                <div class="col-md-2">
                                    <h6></h6>
                                    <a href="{{ route('delete-activities', ["id" => $activity->id]) }}"
                                       class="btn btn-danger btn-sm btn-block">
                                        Delete
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</main>
</body>
<script type="text/javascript">
    $(function () {
        $("input[type='checkbox']").on('change', function () {
            var $id = $("input[name='checked']:checked").val();
            $.ajaxSetup({
                header: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ route('done-activities') }}",
                type: 'post',
                data: {
                    id: $id,
                    _token: "{{ csrf_token() }}"

                },
                datatype: 'JSON',
                success: function (result) {
                    if (result["success"]) {
                        location.reload();
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    })
</script>
</html>

