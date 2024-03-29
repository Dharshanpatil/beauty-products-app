@extends('layouts.master')

@section('title','Add Product')

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
                        <h2 class="page-title">Add Product</h2>
                    </div>

                    <!-- Category Setup -->
                    <div class="card category-setup mb-30">
                        <div class="card-body p-30">
                            <form action="{{route('admin.product-store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                        <div class="row mt-4">
                              
                              <div class="col-md-4 col-6">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="name"
                                           value="{{old('name')}}"
                                               placeholder="name"
                                             required>
                                        <label>Name</label>
                                    </div>
                                </div>
                            </div>
                            
                              <div class="col-md-4 col-6">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="amount"
                                           value="{{old('amount')}}"
                                               placeholder="amount"
                                             required>
                                        <label>Amount</label>
                                    </div>
                                </div>
                            </div>
                            
                            
                             <div class="col-md-4 col-6">
                                <div class="mb-30">
                                    <select class="select-identity theme-input-style mb-30" name="category"  id="category"
                                                required>
                                            <option selected disabled>Categories</option>
                                            @foreach($categories as $mcategor)
                                          <option value="{{$mcategor->id}}">{{$mcategor->name}}</option>
                                           @endforeach
                                        </select>
                                </div>
                            </div>
                            
                            
                             <div class="col-md-4 col-6">
                                <div class="mb-30">
                                       <div class="mb-30" id="sub-category-selector">
                                            <div class="form-floating">
                                                    <select class="subcategory-select theme-input-style w-100" name="sub_category_id" id="sub_category_id">
                                                                                                    <option selected disabled>Sub Categories</option>

                                                    </select>
                                                     </div>
                                                </div>
                                </div>
                            </div>
                            
                                                         <div class="col-lg-3 col-sm-5 mb-5 mb-sm-0">
                                                <div class="d-flex flex-column align-items-center gap-3">
                                                    <p class="mb-0">Thumbnail image'</p>
                                                    <div>
                                                        <div class="upload-file">
                                                            <input type="file" class="upload-file__input"
                                                                   name="thumbnail">
                                                            <div class="upload-file__img">
                                                                <img
                                                                    src="{{asset('public/assets')}}/img/media/upload-file.png"
                                                                    alt="">
                                                            </div>
                                                            <span class="upload-file__edit">
                                                                <span class="material-icons">edit</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                            </div>


                                            <div class="col-12 mt-4 mt-md-5">
                                  <div class="mb-30">
                                                                                     <label for="editor" class="mb-2">Description <span class="text-danger">*</span></label>

                                          <section id="editor" class="dark-support">
                                                    <textarea class="ckeditor"
                                                              name="description">{{old('description')}}</textarea>
                                                </section>
                                   
                                </div>
                            </div>
                            

                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-20 mt-30">
                                            <button class="btn btn--secondary"
                                                    type="reset">Reset</button>
                                            <button class="btn btn--primary" type="submit">Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Category Setup -->


                </div>
            </div>
        </div>
    </div>

   
@endsection

@push('script')
    <script src="{{asset('public/assets')}}/plugins/select2/select2.min.js"></script>
    <script src="{{asset('public/assets')}}/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets')}}/plugins/dataTables/dataTables.select.min.js"></script>
    <script>
    $(document).ready(function () {
     $('#sub_category_id').val('');

    // Handle category change event
    $('#category').change(function () {
        var categoryId = $(this).val();
        populateSubcategories('{{url('/')}}/admin/get-subs/'+categoryId);
    });
});

function populateSubcategories(route) {
    $.ajax({
        url: route,
        method: 'GET',
        success: function (response) {
            var subcategories = response.data;
            var options = subcategories.map(subcategory => `<option value="${subcategory._id}">${subcategory.name}</option>`);
            console.log(options);
            $('#sub_category_id').html(options);
        }
    });
}

//             function ajax_switch_category(route) {
//           var select = document.getElementById('sub-category-id');

// select.innerHTML = '';
//         var disabledOption = document.createElement('option');
// disabledOption.value = '';
// disabledOption.text = 'Sub-category';
// disabledOption.disabled = true;
// select.appendChild(disabledOption);
//                   $.get({
//                 url: route,
//                 dataType: 'json',
//                 data: {},
//                 beforeSend: function () {
//                     /*$('#loading').show();*/
//                 },
//                 success: function (response) {
//                       //                  $('#sub-category-selector').html(response.template);

//                   response.data.forEach(function(option) {
//             var optionElement = document.createElement('option');
//             optionElement.value = option.id;
//             optionElement.text = option.name;
//             select.appendChild(optionElement);
//         });
//                 },
//                 complete: function () {
//                     /*$('#loading').hide();*/
//                 },
//             });
//         }
    </script>
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
