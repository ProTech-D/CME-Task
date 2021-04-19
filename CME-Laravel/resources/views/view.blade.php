<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('include.css')
    <title>CME Task</title>
</head>

<body class="bg-dark">
    <!-- Include Header -->
    @include('include.header')
    <!--Navigation-->
    <div class="container-fluid">
        <div class="row" id="vue-root">
            <div class="col">
                <div class="card mt-4">
                @include('include.newclient')
                    <div>
                        <div class="card">
                            <div class="card-header">
                                All CLients
                            </div>
                            <div class="card-body">

                                <div id="table" class="table-responsive">
                                    <table class="table table-bordered align-middle" id="myTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th> Client ID </td>
                                                <th> Client Name </td>
                                                <th> Client Email</td>
                                                <th> Company </td>
                                            </tr>
                                        </thead>
                                        <tbody id="allclientsTr">
                                            <tr v-for="client in clients">
                                                <td>@{{client.id}}</td>
                                                <td>@{{client.name}}</td>
                                                <td>@{{client.email}}</td>
                                                <td>@{{client.company_name}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                All API CLients
                            </div>
                            <div class="card-body">
                                <div id="table2" class="table-responsive">
                                    <table class="table table-bordered align-middle" id="myTableApi">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th> Client Name </td>
                                                <th> Client Email</td>
                                                <th> Company </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="apiclient in apiclients">
                                                <td>@{{apiclient.name}}</td>
                                                <td>@{{apiclient.email}}</td>
                                                <td>@{{apiclient.company_name}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    @include('include.footer')
</body>
@include('include.js')
@include('include.script')


</html>