<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row">
                <div class="col-md-12 col-lg-12 my-0">
                    <div class="card rounded shadow pb-1">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">MODULE MANAGEMENT</h5>
                                <div >
                                    <button id="add_temp_btn" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createTemplate"><i data-feather="plus" class="lead_icon mg-r-5"></i>ADD MODULE</button>

                                    <button id="add_submit" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add_sub_module"><i data-feather="plus" class="lead_icon mg-r-5"></i>ADD SECTION</button>
                                </div>
                            </div>  
                        </div>
            <!-- listing start -->
          
                        <div class=" border-0 customer_form">
                            <div class="card-header bg-transparent">
                                <div class="row m-2">
                                    <table class="table table-bordered list-table">
                                        <thead>
                                            <tr class="text-center">
                                              <th scope="col" class="width">Section</th>
                                              <th scope="col" class="width">URL</th>
                                              <th scope="col" class="width1">Status</th>
                                              <th scope="col" class="width1">Live Status</th>
                                              <th scope="col" class="width1">SortOrder</th>
                                              <th scope="col" class="width1">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                @if(!empty($module))
                                <div class="row m-2">
                                     @foreach($module as $module_data)
                                        <table class="table table-bordered list-table mb-4">
                                            <tr class="text-center mb-3">
                                              <th scope="col " class="width" style="word-break:break-all;">{{$module_data->module_name}}</th>

                                              @if($module_data->access_priviledge == 0)
                                                <th scope="col" class="width">{{'Super Admin'}}</th>

                                              @elseif($module_data->access_priviledge == 1)
                                                <th scope="col" class="width">{{'All'}}</th>

                                              @else($module_data->access_priviledge == )
                                                <th scope="col" class="width">{{'Subscriber'}}</th>
                                              @endif

                                              <th scope="col" class="form-switch" style="width: 10%;">
                                                <input data-id="{{$module_data->module_id}}" class="form-check-input toggle-class mx-auto mt-2" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $module_data->status ? 'checked' : '' }}>
                                              </th>
                                              <th scope="col" class="form-switch" style="width: 10%;">
                                                <input data-id="{{$module_data->module_id}}" class="form-check-input toggle-class1 mx-auto mt-2 width1" type="checkbox" data-toggle="toggle" data-on="Active" style="display:block;" data-off="InActive" {{ $module_data->completion_status ? 'checked' : '' }}>
                                              </th>
                                              <th scope="col" class="" style="width: 10%;">
                                                <input type="number" class="col-xs-1 Module_Sort_Order width1" data-id="{{$module_data->module_id}}"  placeholder="" value="{{$module_data->sort_order}}" style="width:50px;">
                                              </th>
                                              <th scope="col" class="width1" style="width:10%;">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editmodule" data-id="{{$module_data->module_id}}" class="btn btn-primary btn-xs btn-icon edit-module width1"><i class="uil uil-edit"></i></a>
                                              </th>
                                            </tr>
                                            @foreach($module_section1 as $section)
                                             @if($module_data->module_id == $section->module_id)
                                            <tr>
                                                <td scope="col" class="">{{$section->section_name}}
                                                </td>
                                                <td scope="col" class="">{{$section->section_url}}
                                                </td>
                                                <td class=" form-switch">
                                                    <input  data-id="{{$section->section_id}}"  class="form-check-input toggle-class2 mx-auto mt-2" style="display:block;" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{$section->status ? 'checked' : '' }}>
                                                </td>
                                                <th scope="col" class=" form-switch">
                                                    <input data-id="{{$section->section_id}}" class="form-check-input toggle-class3 mx-auto mt-2" type="checkbox" data-toggle="toggle" data-on="Active" style="display:block;" data-off="InActive" {{$section->completion_status ? 'checked' : ''}}>
                                              </th>
                                                <td class="" style="text-align: center;">
                                                    <input type="number" class="col-xs-1 mx-auto inputPassword2"  data-id="{{$section->section_id}}" id="inputPassword2" placeholder="" value="{{$section->sort_order}}" style="width:50px;" >
                                                </td>
                                                <td scope="col width1" style="text-align: center">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editsection" data-id="{{$section->section_id}}" class="btn btn-primary btn-xs btn-icon mx-auto editSection"><i class="uil uil-edit"></i></a>
                                                </td>
                                            </tr><br>
                                            @foreach($section->parentName as $value2)
                                            <tr>
                                                <td scope="col" class=""><i class="bi bi-arrow-right"></i> &nbsp;{{$value2->section_name}}
                                                </td>
                                                <td scope="col" class="">{{$value2->section_url}}
                                                </td>
                                                <td class=" form-switch">
                                                    <input  data-id="{{$value2->section_id}}"  class="form-check-input toggle-class2 mx-auto mt-2" style="display:block;" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{$value2->status ? 'checked' : '' }}>
                                                </td>
                                                <th scope="col" class=" form-switch">
                                                    <input data-id="{{$value2->section_id}}" class="form-check-input toggle-class3 mx-auto mt-2" type="checkbox" data-toggle="toggle" data-on="Active" style="display:block;" data-off="InActive" {{$value2->completion_status ? 'checked' : ''}}>
                                              </th>
                                                <td class="" style="text-align: center;">
                                                    <input type="number" class="col-xs-1 mx-auto inputPassword2"  data-id="{{$value2->section_id}}" id="inputPassword2" placeholder="" value="{{$value2->sort_order}}" style="width:50px;" >
                                                </td>
                                                <td scope="col width1" style="text-align: center">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editsection" data-id="{{$value2->section_id}}" class="btn btn-primary btn-xs btn-icon mx-auto editSection"><i class="uil uil-edit"></i></a>
                                                </td>
                                            </tr>
                                            <br>
                                            @endforeach
                                            @endif
                                            @endforeach
                                        </table>
                                     @endforeach
                                </div>
                                @endif 
                            </div>             
                        </div><!--end -->
                    </div><!--end col-->
                </div><!--end row-->           
            </div><!-- end listing-->
        </div><!--end layout spacing-->
    </div><!--end container-->

    <!-- Add Module Start -->
            <div class="modal fade" id="createTemplate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header border-bottom p-3">
                            <h5 class="modal-title" id="exampleModalLabel">ADD MODULE</h5>
                            <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                        </div>
                        <div class="modal-body">
                            <form  name="form" id="add_module_form" class="needs-validation" novalidate>
                                <div class="row g-3">
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="module_name" class="form-label">MODULE NAME</label>
                                        <input type="text" class="form-control" id="module_name" placeholder="Module name" value="" name="module_name" required>
                                       <div class="invalid-feedback">
                                        Please select a module name.
                                        </div>
                                        <div class="col module"></div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="access_priviledge" class="form-label">ACCESS PRIVILLAGES</label>
                                        <select class="form-select form-control" id="access_priviledge" name="access_priviledge" required>
                                             <option selected disable value="" disabled>Access privillages</option>
                                             <option value="0">Super_admin</option>
                                             <option value="1">All</option>
                                             <option value="2">Subscriber</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        Please select a valid access privillages.
                                        </div>
                                         <div class="col access"></div>
                                        <span style="color:red;">
                                          @error('access_priviledge')
                                            {{$message}}
                                          @enderror
                                        </span>
                                    </div> 
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="module_icon" class="form-label">MODULE ICON</label>
                                        <input type="text" class="form-control" id="module_icon" placeholder="Module icon" value="" name="module_icon">
                                        <!-- <div class="invalid-feedback">
                                            Please enter a module icon.
                                        </div> -->
                                         <div class="col module-icon"></div>
                                        <span style="color:red;">
                                          @error('module_icon')
                                            {{$message}}
                                          @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-lg-2 col-sm-12">   
                                         <button type="submit" id="add_module_submit" class="btn btn-primary  w-100" style="background-color: background-color: #2f55d4;">Submit</button>
                                    </div> 
                                </div>                    
                            </form><!--end form-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add module end-->

            <!-- Add Section Start -->
            <div class="modal fade" id="add_sub_module" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header border-bottom p-3">
                            <h5 class="modal-title" id="exampleModalLabel">ADD SECTION</h5>
                            <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                        </div>
                        <div class="modal-body">                           
                            <form name="form" id="add_section_form" class="needs-validation" novalidate>
                            <div class="row g-3">
                                <div class="col-lg-12 col-sm-12">
                                    <input type="hidden" name="" class="dropdown_sction_id">
                                <label for="module" class="form-label">MODULE</label>
                                <select class="form-select form-control" id="module_id" name="module_id" required>
                                         <option selected disable value="" disabled>SELECT_SECTION</option>
                                         @if(!empty($module))
                                         @foreach($module as $module_data)
                                            {{ $module_data->module_name}}
                                            <option  value="{{$module_data->module_id}}">{{ $module_data->module_name}}</option>
                                         @endforeach
                                         @endif
                                    </select>
                                <div class="invalid-feedback">
                                    Please select a module
                                </div>
                                </div> 
                            </div>
                            <div class="row g-3 m-2">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="sectionType" class="form-label">SECTION_TYPE</label><br>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input section_type is-invalid" type="radio" name="section_type" id="section_type" value="0" checked>
                                      <label class="form-check-label" for="inlineRadio1">Parent</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input section_type1 is-invalid" type="radio" name="section_type" id="section_type" value="1">
                                      <label class="form-check-label" for="inlineRadio2" >Child</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please choose a section type
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 parent" style="display:none;">
                                    <label for="parent_section" class="form-label">PARENT_SECTION</label>
                                    <select class="form-control" id="parent_section" name="parent_section">
                                        <option value="" >Parent Section</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose a parent section
                                    </div>
                                </div> 
                            </div>
                            <div class="row g-3 m-2 ">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="section_name" class="form-label">SECTION_NAME</label>
                                    <input type="text" class="form-control" id="section_name" placeholder="Section name" value="" name="section_name" 
                                        required>
                                        <div class="invalid-feedback">
                                        Please enter a section name.
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="section_url" class="form-label">SECTION_URL</label>
                                    <input type="text" class="form-control" id="section_url" placeholder="Section url" value="" name="section_url" 
                                        required>
                                    <div class="invalid-feedback">
                                    Please select a valid url.
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 m-2">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="access_priviledge" class="form-label">SECTION_ICON</label>
                                    <input type="text" class="form-control" id="section_icon" placeholder="Section icon" value="" name="section_icon">
                                    <!-- <div class="invalid-feedback">
                                    Please enter a valid icon name
                                    </div> -->
                                </div>  
                            </div>
                            <div class="row g-3 m-2 mb-3">
                                <div class="col-lg-3 col-sm-12" >   
                                    <button type="submit" id="add_section_submit" class="btn btn-primary  w-100" style="background-color: background-color: #2f55d4;">Submit</button>
                                </div> 
                            </div>                    
                            </form><!--end form-->    
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add section End -->

            <!-- Edit module Start -->
            <div class="modal fade" id="editmodule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header border-bottom p-3">
                            <h5 class="modal-title" id="exampleModalLabel">EDIT MODULE</h5>
                            <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                        </div>
                        <div class="modal-body ">
                            <form method="post" name="form" id="form" class="needs-validation update_module" novalidate>
                                    @csrf
                                    <div class="row g-3 ">
                                        <input type="hidden" name="module_id" id="moduleid">
                                        <div class="col-lg-6 col-sm-12">
                                        <label for="module_name" class="form-label">MODULE NAME</label>
                                        <input type="text" class="form-control" id="modulename" placeholder="Module name"  name="module_name" required>
                                        <div class="invalid-feedback">
                                            Please enter a module name.
                                        </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="access_priviledge" class="form-label">ACCESS PRIVILLAGES</label>
                                            <select class="form-select form-control" id="accesspriviledge" name="access_priviledge" required>
                                                    <option value="0">Super_admin</option>
                                                    <option value="1">All</option>
                                                    <option value="2">Subscriber</option>
                                            </select>
                                            <div class="invalid-feedback">
                                            Please select a valid access privillages.
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row g-3 mt-1">
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="module_icon" class="form-label">MODULE ICON</label>
                                            <input type="text" class="form-control" id="moduleicon" placeholder="Module icon" value="" name="module_icon">
                                            <div class="invalid-feedback">
                                                Please enter a module icon.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 mt-1">
                                        <div class="col-lg-2 col-sm-12" >   
                                            <button type="submit" id="update_module" class="btn btn-primary  w-100"  style="background-color: background-color: #2f55d4;">Update</button>
                                        </div> 
                                    </div>                    
                            </form> <!--end form-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit module end-->

            <!-- Edit Section Start -->
            <div class="modal fade" id="editsection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header border-bottom p-3">
                            <h5 class="modal-title" id="exampleModalLabel">EDIT SECTION</h5>
                            <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                        </div>
                        <div class="modal-body">                           
                            <form method="post" name="form" id="edit_section_form" class="needs-validation update_section" novalidate>
                            <div class="row g-3">
                                <input type="hidden" name="section_id" id="sectionId">
                                <div class="col-lg-12 col-sm-12">
                                <label for="module" class="form-label">MODULE</label>
                                <select class="form-select form-control" id="module_Id" name="module_id" required>
                                         @if(!empty($module))
                                         @foreach($module as $moduledata)
                                            <option  value="{{$moduledata->module_id}}">{{$moduledata->module_name}}</option>
                                         @endforeach
                                         @endif
                                    </select>
                                <div class="invalid-feedback">
                                    Please select a module
                                </div>
                                </div> 
                            </div>
                            <div class="row g-3 m-2">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="sectionType" class="form-label">SECTION_TYPE</label><br>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input section_type" type="radio" name="section_type" id="section_Type" value="0">
                                      <label class="form-check-label" for="inlineRadio1">Parent</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input section_type1" type="radio" name="section_type" id="section_Type1" value="1">
                                      <label class="form-check-label" for="inlineRadio2" >Child</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please choose a section type
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 parent">
                                    <label for="parent_section" class="form-label">PARENT_SECTION</label>
                                    <select class="form-control" id="parent_Section" name="parent_section">
                                    </select>

                                </div> 
                            </div>
                            <div class="row g-3 m-2 ">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="section_name" class="form-label">SECTION_NAME</label>
                                    <input type="text" class="form-control" id="section_Name" placeholder="Section name" value="" name="section_name" 
                                        required>
                                        <div class="invalid-feedback">
                                        Please enter a section name.
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="section_url" class="form-label">SECTION_URL</label>
                                    <input type="text" class="form-control" id="section_Url" placeholder="Section url" value="" name="section_url">
                                    <div class="invalid-feedback">
                                    Please select a valid url.
                                    </div>
                                 </div>
                            </div>
                            <div class="row g-3 m-2">
                                 <div class="col-lg-6 col-sm-12">
                                    <label for="access_priviledge" class="form-label">SECTION_ICON</label>
                                    <input type="text" class="form-control" id="section_Icon" placeholder="Section icon" value="" name="section_icon">
                                </div>  
                            </div>
                            <div class="row g-3 m-2 mb-3">
                                <div class="col-lg-3 col-sm-12" >   
                                    <button type="submit" id="update_section" class="btn btn-primary  w-100" style="background-color: background-color: #2f55d4;">Update</button>
                                </div> 
                            </div>                    
                            </form><!--end form-->    
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit section End -->

  
@push('scripts')
    <!--section sort order update-->
    <script>
        $(".inputPassword2").on("blur",function(e){ 
            e.preventDefault();
             var section_id = $(this).data('id');
             var sort_order = $(this).val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                type:"POST",
                url: "{{route('section-sortorder-update')}}",
                data:{section_id:section_id,sort_order:sort_order},
                dataType:"json",
                success:function(data){
                    Toaster('Sort Order Updated');
                    $('#inputPassword2').val(data.sort_order); 
                }
            }); 
        }); 
    </script>
    <!--section end-->

    <!--module sort order update-->
    <script>
        $(".Module_Sort_Order").on("blur",function(e){ 
            e.preventDefault();
            var module_id = $(this).data('id');
            var sort_order = $(this).val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                type:"POST",
                url: "{{route('module-sortorder-update')}}",
                data:{module_id:module_id,sort_order:sort_order},
                dataType:"json",
                success:function(data){
                    console.log(data);
                   
                    Toaster('Sort order updated');
                   
                    $('#Module_Sort_Order').val(data.sort_order); 
                }
            }); 
        }); 
    </script>
    <!--section end-->
        
    <!-- hide show section radio button start-->
    <script>
        $(document).ready(function(){
          $(".section_type").click(function(){
            $(".parent").hide();
          });
          $(".section_type1").click(function(){
            $(".parent").show();
          });
        });
    </script>
    <!-- hide show section end-->

    <!-- Add module start-->
    <script>
            $(document).on("submit","#add_module_form",function(e){
                e.preventDefault();
                var formData = {
                  module_name: $("#module_name").val(),
                  module_icon: $("#module_icon").val(),
                //   sort_order: $("#sort_order").val(),
                  access_privilage: $("#access_priviledge option:selected").val(),
                };
                // alert(sort_order);
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                   type:"POST",
                   url:"{{route('module-management.store')}}",
                   data: formData,
                   dataType:"json",
                   success:function(data){
                      console.log(data);
                            location.reload(true);
                      $('#createTemplate').modal('hide');
                    },
                    error: function(data) {
                        let errortext =  data.responseJSON;
                        console.log(errortext);
                        $.each(errortext, function(i, v){
                            $('.module').append(v.module_name); 
                            $('.access').append(v.access_priviledge); 
                            $('.module-icon').append(v.module_icon); 
                            $('.sort').append(v.sort_order);
                            $('.col').addClass('text-danger');
                            $('.col').delay(2000).fadeOut("slow").show();
                        });
                    }
                });
            });
    </script>
    <!-- Add module script end-->

    <!-- Add section data -->
    <script>
         $(document).on("submit","#add_section_form",function(e){
                e.preventDefault();
                let section_type = $("#sectionType:checked").val();
                var formData = {

                  module_id: $("#module_id").val(),
                  section_type : $("#sectionType").val(),
                  parent_section_id : (section_type == 0)?$("#parent_section option:selected").val(): '',
                  section_name: $("#section_name").val(),
                  section_icon: $("#section_icon").val(),
                  section_url: $("#section_url").val(),
                };
                    console.log(formData);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                 $.ajax({
                    url:"{{route('add-section')}}",
                    type:"POST",
                    data: formData,
                    dataType: "json",
                    success: function(response){
                        console.log(response);
                            location.reload(true);
                        $('#add_sub_module').modal('hide');
                    },

                });
            });
    </script>
    <!-- section end-->

    <!--DEPENDENT DROPDOWN-->
    <script>
        $(document).ready(function() {
            $('#module_id').change( function(){
                var module_id = $('#module_id').val();
               const url = "{{ route('section') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url:url,
                    type: "POST",
                    data: {
                        module_id: module_id,
                    },
                    dataType: "json",                            
                    success: function(result) 
                    {
                        let html_content= '';
                        jQuery.each(result, function(key,value){
                           html_content += '<option value="'+ value.section_id +'" id="'+parent_Section+'">'+ value.section_name +'</option>';
                        });
                        $('#parent_section').html(html_content);         
                    }
                });
            });
        });
    </script>
    <!--END DROPDOWN-->

    <!--Module status toggle button-->
    <script>
        $('.toggle-class').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0; 
        let module_id = $(this).data('id');
        $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('ModuleStatus')}}",
            data: {'status': status, 'module_id': module_id},
            success: function (data) {
                Toaster(data.message3);
                }
            });
        });
    </script>
    <!--end toggle buttton-->

    <!--Section status toggle button-->
    <script>
        $('.toggle-class2').change(function() {
        let status = $(this).prop('checked') === true ? 1 : 0; 
        let section_id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('SectionStatus')}}",
            data: {'status': status, 'section_id': section_id},
            success: function (data) {
                Toaster(data.message6);
                }
            });
        });
    </script>
    <!--end buttton-->

    <!--module livestatus toggle button-->
    <script>
        $('.toggle-class1').change(function () {
        let completion_status = $(this).prop('checked') === true ? 1 : 0; 
        let module_id = $(this).data('id');
        $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('ModuleLiveStatus')}}",
            data: {'completion_status': completion_status, 'module_id': module_id},
            success: function (data) {
                Toaster(data.message4);
                },
            error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                     }
            });
        });
    </script>
    <!--button end-->

    <!--section livestatus toggle button-->
    <script>
        $('.toggle-class3').change(function () {
        let completion_status = $(this).prop('checked') === true ? 1 : 0; 
        let section_id = $(this).data('id');
        $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('SetionLiveStatus')}}",
            data: {'completion_status': completion_status, 'section_id': section_id},
            success: function (data) {
                Toaster(data.message8);
            },
            error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                     }
            });
        });
    </script>
    <!--button end-->

    <!--EDIT DEPENDENT DROPDOWN-->
    <script>
        $(document).ready(function() {
            $('#module_Id').change( function(){
                var module_id = $('#module_Id').val();
               const url = "{{route('editdropdownn')}}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });
                $.ajax({
                    url:url,
                    type: "POST",
                    data: {
                        module_id: module_id,
                    },
                    dataType: "json",                            
                    success: function(result) 
                    {
                        let html_content= '';
                        jQuery.each(result, function(key,value){
                           html_content += '<option value="'+ key +'" id="'+parent_Section+'">'+ value.section_name +'</option>';
                        });
                        $('#parent_Section').html(html_content);                
                    }
                });
            });
        });
    </script>
    <!--END DROPDOWN-->

    <!-- Edit module data -->
    <script>
         $(document).ready(function(){
            $(".edit-module").click(function(e){
                e.preventDefault();
                var module_id = $(this).data('id');
            
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }   
                    });
                $.ajax({
                   type:"POST",
                   url:"{{route('module-edit')}}",
                   data: {module_id:module_id},
                   dataType:'json',
                   success:function(data){
                      console.log(data); 
                          $('#moduleid').val(data.module_id);    
                          $('#modulename').val(data.module_name);
                          $('#moduleicon').val(data.module_icon);
                          $('#accesspriviledge').val(data.access_priviledge);
                    },
                    error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                    }
                });
            });
         });
    </script>
    <!-- edit module end-->

    <!-- Edit section data -->
    <script>
        $(document).ready(function(){
            $(".editSection").click(function(e){
                e.preventDefault();
                var section_id = $(this).data('id');
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                   type:"POST",
                   url:"{{route('section-edit')}}",
                   data: {section_id:section_id},
                   dataType:'json',
                   success:function(data){
                      let section =  data.section;
                        $('#sectionId').val(section.section_id);    
                        $('#module_Id').val(section.module_id);
                        if(section.parent_section_id == 0){
                            $('#section_Type').prop('checked', 'true');
                        }
                        else{
                            $('#section_Type1').prop('checked', 'true');
                        }
                        $('#section_Name').val(section.section_name);
                        $('#section_Icon').val(section.section_icon);
                        $('#section_Url').val(section.section_url);

                        let module =  data.module;

                        if(section.parent_section_id != 0){
                        $("#parent_Section").html('');
                        $.each( data.module, function( key, value ) {
                          let option_html = "<option value='"+value.section_id+"'>"+ value.section_name +"</option>"
                            $("#parent_Section").append(option_html);
                            $("#parent_Section").val(section.parent_section_id);
                            $('.parent').show();
                        });
                       }
                       else{
                            $('.parent').hide();
                       }                         
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                });
            });
        });
    </script>
    <!-- edit section end-->

    <!-- module update-->
    <script>
        $(document).on("submit",".update_module",function(e){
                e.preventDefault();
                var UpdateData = {
                  module_id: $("#moduleid").val(),
                  module_name: $("#modulename").val(),
                  module_icon : $("#moduleicon").val(),
                  access_priviledge: $("#accesspriviledge option:selected").val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                   type:"POST",
                   url:"{{route('moduleupdate')}}",
                   data: UpdateData,
                   dataType:'json',
                   success:function(response){
                            location.reload(true);
                        },
                    error: function(response) {
                        var errors = response.responseJSON;
                        console.log(errors);
                     }
                });
            });
        // });
    </script>
    <!-- update module end-->

    <!-- section update-->
    <script>
        $(document).on("submit",".update_section",function(e){
                e.preventDefault();
                 let section_type = $("#sectionType:checked").val();
                var UpdateData = {
                  section_id: $("#sectionId").val(),
                  module_id: $("#module_Id").val(),
                  parent_section_id: $("#parent_Section option:selected").val()?? 0,  
                  section_name : $("#section_Name").val(),
                  section_icon : $("#section_Icon").val(),
                  section_url: $("#section_Url").val(),
                };
              
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                   type:"POST",
                   url:"{{route('sectionupdate')}}",
                   data: UpdateData,
                   dataType:'json',
                   success:function(response){
                        location.reload(true);
                    },
                    error: function(response){
                        var errors = response.responseJSON;
                     }
                });
            });
    </script>
    @endpush
    <!-- update section end-->
</x-app-layout> 
