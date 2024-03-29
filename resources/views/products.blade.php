@extends('layouts.master')

@section('title','Products')

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
                        <h2 class="page-title">Products</h2>
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
                                        
                                        <a href="{{route('admin.add-products')}}" class="btn btn--primary">
                                                                                  Add new

                                        </a>

                                   
                                    </div>

                                    <div class="table-responsive">
                                        <table id="example" class="table align-middle">
                                            <thead class="align-middle">
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                 <th>Category</th>
                                                <th>Sub Category</th>

                                                <th>Amount</th>


                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $key=>$category)
                                                <tr>
                                                    <td>{{1+$key}}</td>
                                                    <td>{{$category['name']}}</td>
                                                      <td>{{$category->categorys->name??''}}</td>
                                                      <td>{{$category->subcategorys->name??''}}</td>
                                                       <td>{{$category['amount']}}</td>
                                                    <td>
                                                        <div class="table-actions">
                                                    <button type="button"   class="table-actions_delete bg-transparent border-0 p-0 demo_check" data-bs-toggle="modal"
                                                    data-bs-target="#updateModal--{{$category['id']}}"
                                                    data-toggle="tooltip" title="">
                                                                <span class="material-icons">edit</span>
                                            </button>
                                            
                                                            <button type="button"
                                                                    @if(env('APP_ENV')!='demo')
                                                                    onclick="form_alert('delete-{{$category['id']}}','want to delete this category?')"
                                                                    @endif
                                                                    class="table-actions_delete bg-transparent border-0 p-0 demo_check">
                                                                <span class="material-icons">delete</span>
                                                            </button>
                                                            <form action="{{route('admin.product-destroy',$category['id'])}}"
                                                                  method="post" id="delete-{{$category['id']}}" class="hidden">
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
    
                  
                             @foreach($products as $key=>$category)
    
       <div class="modal fade" id="updateModal--{{$category['id']}}" tabindex="-1"
     aria-labelledby="updateModalLabel"
     aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-centered" style="--bs-modal-width: 430px">
               <div class="modal-content">
                   
                        <div class="modal-header px-4 pt-4 border-0 pb-1">
                <h3 class="text-capitalize">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                         
              <div class="modal-body">
                <form action="{{route('admin.product-update',['id' => $category['id']])}}" method="POST" id="edit-table-{{ $key }}">
                   @csrf
                   <div class="row">
             
                         <div class="col-md-6 col-lg-12">
                        <div class="mb-30">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="name" 
                                       value="{{$category['name']}}"
                                     required>
                                <label>Title</label>
                            </div>
                        </div>
                    </div>
                            
                              <div class="col-md-4 col-6">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="amount"
                                       value="{{$category['amount']}}"
                                               placeholder="amount"
                                             required>
                                        <label>Amount</label>
                                    </div>
                                </div>
                            </div>
                            
                                         <div class="col-12 mt-4 mt-md-5">
                                  <div class="mb-30">
                                                                                     <label for="editor" class="mb-2">Description <span class="text-danger">*</span></label>

                                          <section id="editor" class="dark-support">
                                                    <textarea class="ckeditor"
                                                              name="description">{{$category['description']}}</textarea>
                                                </section>
                                   
                                </div>
                            </div>
                            
                  </div>
                  </form>
             </div>
            
              <div class="modal-footer d-flex justify-content-end gap-3 border-0 pt-0 pb-4">
                <button type="button" class="btn btn--secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="submit" class="btn btn--primary" form="edit-table-{{ $key }}">update</button>
            </div>
            
             </div>
      </div>    

</div>    
   @endforeach
@endsection

@push('script')
    <script src="{{asset('public/assets')}}/plugins/select2/select2.min.js"></script>
    <script src="{{asset('public/assets')}}/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets')}}/plugins/dataTables/dataTables.select.min.js"></script>
       <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    {{--<script src="{{asset('public/assets/ckeditor/ckeditor.js')}}"></script>--}}
    <script src="{{asset('public/assets/ckeditor/jquery.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('textarea.ckeditor').each(function () {
                CKEDITOR.replace($(this).attr('id'));
            });
        });
    </script>
@endpush
