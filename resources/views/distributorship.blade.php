@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4" style="color: #e43750;">Our Distributorship</h1>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm mb-5">
                        <div class="card-body p-4">
                            <p class="lead text-justify">
                                We are pleased to be able to provide access to e-books & Physical books from the world-renowned publishing programs of our partner presses via <strong>Aries Books International, India</strong> & <strong>Cherry Lake Publishing, USA</strong>. These titles cover subjects from all disciplines across the fields of science, technology and medicine, as well as humanities and social sciences.
                            </p>
                            
                            <p class="text-justify">
                                Making a unique contribution to the world of scholarship, our e-book partner publishing program sets new standards for the integration of key schools' academic content. It offers all users a new dimension of access and usability, supporting and enhancing research.
                            </p>
                            
                            <p class="text-justify">
                                Access to these partner publisher titles through Aries Books & Cherry Lake is available to libraries worldwide under a number of attractive and flexible models, ensuring instant access to the best research available.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="text-center mb-4" style="color: #e43750;">Our Distribution Network</h2>
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead style="background-color: #e43750; color: white;">
                        <tr>
                            <th>S.No.</th>
                            <th>Company</th>
                            <th>Contact Person</th>
                            <th>Contact Information</th>
                            <th>Email ID</th>
                            <th>City</th>
                            <th>State Wise Distribution</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($distributors as $index => $distributor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $distributor->company }}</td>
                            <td>{{ $distributor->contact_person }}</td>
                            <td>{{ $distributor->contact_information }}</td>
                            <td>{{ $distributor->email_id }}</td>
                            <td>{{ $distributor->city }}</td>
                            <td>{{ $distributor->state_wise_distribution }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.text-justify {
    text-align: justify;
}

.table-responsive {
    box-shadow: 0 0 20px rgba(0,0,0,.1);
}

.table thead th {
    border: none;
    font-weight: 600;
}

.table tbody td {
    vertical-align: middle;
    padding: 12px;
}

.table tbody tr:hover {
    background-color: rgba(228, 55, 80, 0.05);
}
</style>
@endsection