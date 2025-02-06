@extends('layouts.app')

@section('content')
<div class="container">
    <div id="response">
        <div class="card d-none" id="userCard">
            <div class="card">
                <div class="card-header">{{ __('User Profile') }}</div>

                <div class="card-body">
                    <div class="row g-0">
                        <div class="col-md-4 text-center p-3">
                            <img id="userImage" src="" class="img-fluid rounded" alt="User Image">
                        </div>

                        <!-- Right Side: User Details -->
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><span id="userName"></span></h5>
                                <p class="card-text"><strong>Role:</strong> <span id="userRole"></span></p>
                                <p class="card-text"><strong>Email:</strong> <span id="userEmail"></span></p>
                                <p class="card-text"><strong>Phone:</strong> <span id="userPhone"></span></p>
                                <p class="card-text"><strong>Gender:</strong> <span id="userGender"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Left Side: User Image -->



            </div>
        </div>
    </div>
    <div id="product" class="hidden">
        <table id="productsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here via AJAX -->
            </tbody>
        </table>
    </div>
</div>

@endsection
