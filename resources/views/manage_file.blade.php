@extends('admin_dashboard')
@section('main')
<div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Example</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>View</th>
                                                <th>Download</th>
                                                <th>Upload Time</th>
                                               
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>View</th>
                                                <th>Download</th>
                                                <th>Upload Time</th>
                                              
                                          
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($images as $img)
                                            <tr> 
                                                <td>{{$img->title}}</td>
                                                <td>                              
                        <img src="{{asset($img->file)}}"alt="{{$img->file}}" download="{{$img->title}}" width="50" height="50">
                                                </td>
                                                <td>                              
                <a href="public/productimage/{{$img->name}}">
                    <button type="button" class="btn btn-primary">
                        <i class="glyphicon glyphicon-download">Download</i>
                    </button>
                </a>
                                                </td>
                                                <td>{{$img->created_at}}</td>
                                            </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endsection