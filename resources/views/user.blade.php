@extends('layouts.master')

@section('title','Users')

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('public/assets')}}/plugins/select2/select2.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets')}}/plugins/dataTables/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets')}}/plugins/dataTables/select.dataTables.min.css"/>
@endpush

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-wrap mb-3">
                        <h2 class="page-title">users</h2>
                    </div>

        

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="all-tab-pane">
                            <div class="card">
                                <div class="card-body">
                                    <div class="data-table-top d-flex flex-wrap gap-10 justify-content-between">
                                        <form action="{{url()->current()}}" class="search-form search-form_style-two"
                                              method="POST">
                                            @csrf
                                            <div class="input-group search-form__input_group">
                                            <span class="search-form__icon">
                                                <span class="material-icons">search</span>
                                            </span>
                                                <input type="search" class="theme-input-style search-form__input"
                                                       value="{{$search}}" name="search"
                                                       placeholder="search here">
                                            </div>
                                            <button type="submit" class="btn btn--primary">Search</button>
                                        </form>

                                   
                                    </div>

                                    <div class="table-responsive">
                                        <table id="example" class="table align-middle">
                                            <thead class="align-middle">
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>email</th>

                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $key=>$user)
                                                <tr>
                                                    <td>{{1+$key}}</td>
                                                    <td>{{$user['name']}}</td>
                                                                                                        <td>{{$user['email']}}</td>

                                                    <td>
                                                        <div class="table-actions">
                                             
                                            
                                                            <button type="button"
                                                                    @if(env('APP_ENV')!='demo')
                                                                    onclick="form_alert('delete-{{$user['id']}}','want to delete this user?')"
                                                                    @endif
                                                                    class="table-actions_delete bg-transparent border-0 p-0 demo_check">
                                                                <span class="material-icons">delete</span>
                                                            </button>
                                                            <form action="{{route('admin.users-destroy',$user['id'])}}"
                                                                  method="post" id="delete-{{$user['id']}}" class="hidden">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
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
    

   
@endsection

@push('script')
    <script src="{{asset('public/assets')}}/plugins/select2/select2.min.js"></script>
    <script src="{{asset('public/assets')}}/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets')}}/plugins/dataTables/dataTables.select.min.js"></script>
@endpush
