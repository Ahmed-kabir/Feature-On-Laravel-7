@extends('admin_dashboard')
@section('main')
<main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Excel</h3></div>
                                    <div class="card-body">
                                        <h4 class="text-success text-center">{{Session::get('message')}}</h4>
                            <form method="post" action="{{url('/save-excel')}}" enctype="multipart/form-data">
                                @csrf
                                        

                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">File</label><input class="form-control py-4" id="inputEmailAddress" type="file" name="excel" aria-describedby="emailHelp" placeholder="Add File" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            
                                            <button type="Submit" class="btn btn-primary">Submit</button>
                                            </div>
                            </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                @endsection