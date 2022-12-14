@extends('backend.layouts.master')
@section('title')
Slider Manage
@endsection
@section('nev-search')
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li>
  </ul>
@endsection
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Slider List </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Slider List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Total  Slider: {{\App\Models\Slider::count()}} </h3>
                <div class="pull-right" style="text-align:right;">
                    <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#branch-info">
                    Add Slider
                    </button>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Slider Image </th>
                    <th>Title First </th>
                    <th>Title Second </th>
                    <th>Title Third </th>
                    <th>Sub Title </th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  @foreach($sliders as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img style=" height:50px; width:50px; border-radius: 25px;" src="{{asset($item->image)}}"></td>
                        <td>{{$item->title_first}}</td>
                        <td>{{$item->title_second}}</td>
                        <td>{{$item->title_third}}</td>
                        <td>{{$item->sub_title}}</td>
                        <td>
                            <input type="checkbox" name="toogle" value="{{$item->id}}" data-toggle="switchbutton" {{$item->active == 1 ? 'checked' : ''}}  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-size="sm" data-offstyle="danger">
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#show_{{$item->id}}">
                              <i class="fas fa-folder">
                              </i>
                              View
                            </a>

                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_{{$item->id}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                            </a>
                            <form class="float-left px-2" action="{{ route('slider.destroy',$item->id) }}" method="POST">
                                @csrf 
                                @method('delete')
                                <a type="button" data-type="confirm" class="dltBtn btn-sm btn-danger js-sweetalert" title="Delete">
                                  <i class="fas fa-trash">
                                  </i>
                                  Delete
                                </a>

                            </form>
                            
                        </td>
                    </tr>
                        <!-- branch Edit model start --> 
                        <div class="modal fade" id="edit_{{$item->id}}">
                                <div class="modal-dialog">
                                <div class="modal-content bg-info">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Update Slider </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form class="add-contact-form" method="post" action="{{ route('slider.update',$item->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <!-- <input type="hidden" name="id" value="{{$item->id}}" > -->
                                        <div class="modal-body">
                                            
                                        

                                        <div class="form-group">
                                            <label>First Title :</label>
                                            <input type="text" class="form-control @error('title_first') is-invalid @enderror" placeholder="Enter First Title" name="title_first" value="{{$item->title_first}}" />
                                            @error('title_first')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Second Title :</label>
                                            <input type="text" class="form-control @error('title_second') is-invalid @enderror" placeholder="Enter Second Title" name="title_second" value="{{$item->title_second}}" />
                                            @error('title_second')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Third Title :</label>
                                            <input type="text" class="form-control @error('title_third') is-invalid @enderror" placeholder="Enter Thied Title" name="title_third" value="{{$item->title_third}}" />
                                            @error('title_third')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Sub Title :</label>
                                            <input type="text" class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter Sub Title" name="sub_title" value="{{$item->sub_title}}" />
                                            @error('sub_title')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>

                                       
                                        <div class="form-group">
                                          <label>Slider status :</label>
                                          <select class="form-control show-tick" name="active">
                                                <option selected disabled>--Select Status--</option>
                                                <option value="1" {{$item->active == 1 ? "selected" : "" }}>Active</option>
                                                <option value="0" {{$item->active == 0 ? "selected" : "" }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Image</label>
                                            <input type="file" class="form-control rounded" name="image" onchange="readURLImage(this);" >
                                            </br>
                                            @if($item->image !=null)
                                            <img style=" height:150px; width:150px; border-radius: 25px;" src="{{asset($item->image)}}" id="image">
                                            @else
                                            <img style=" height:150px; width:150px; border-radius: 25px;" src="{{asset('1.jpg')}}" id="image">
                                            @endif
                                        </div>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-outline-light">Update Slider</button>
                                        </div>
                                    </form>  
                                </div>
                                <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <!-- branch Edit model end -->   



                           <!-- branch Show model start --> 
                        <div class="modal fade" id="show_{{$item->id}}">
                            @php
                                $slider = \App\Models\Slider::where('id',$item->id)->first();
                            @endphp
                            <div class="modal-dialog">
                            <div class="modal-content bg-info">
                                <div class="modal-header">
                                <h4 class="modal-title">View Slider </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form class="add-contact-form" method="post" action="#" enctype="multipart/form-data">
                                   
                                    <!-- <input type="hidden" name="id" value="{{$item->id}}" > -->
                                    <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Title first :</strong>
                                            <p>{{ $slider->title_first }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Title Second :</strong>
                                            <p>{{ $slider->title_second }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Title Third :</strong>
                                            <p>{{ $slider->title_third }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Sub Title :</strong>
                                            <p>{{ $slider->sub_title }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Status  :</strong>
                                            @if($slider->active==1)
                                            <p>
                                              <span class="right badge badge-success">Active</span>
                                            </p>
                                            @else
                                            <p>
                                              <span class="right badge badge-danger">Inactive</span>
                                            </p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            @if($slider->image !=null)
                                            <img style=" height:150px; width:150px; border-radius: 25px;" src="{{asset($item->image)}}" id="image">
                                            @else
                                            <img style=" height:150px; width:150px; border-radius: 25px;" src="{{asset('1.jpg')}}" id="image">
                                            @endif
                                        </div>
                                    </div>
                                        
                    
                                    <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light pull-right" data-dismiss="modal">Close</button>
                                    </div>
                                </form>  
                          </div>
                          <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->
                      <!-- Department Show  model end -->    
                  @endforeach   
                  </tbody>
                
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- branch add model start --> 
  <div class="modal fade" id="branch-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Create Slider  </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="add-contact-form" method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>First Title :</label>
                        <input type="text" class="form-control @error('title_first') is-invalid @enderror" placeholder="Enter First Title" name="title_first" value="{{old('title_first')}}" />
                        @error('title_first')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Second Title :</label>
                        <input type="text" class="form-control @error('title_second') is-invalid @enderror" placeholder="Enter Second Title" name="title_second" value="{{old('title_second')}}" />
                        @error('title_second')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Third Title :</label>
                        <input type="text" class="form-control @error('title_third') is-invalid @enderror" placeholder="Enter Thied Title" name="title_third" value="{{old('title_third')}}" />
                        @error('title_third')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Sub Title :</label>
                        <input type="text" class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter Sub Title" name="sub_title" value="{{old('sub_title')}}" />
                        @error('sub_title')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label>Slider status :</label>
                      <select class="form-control show-tick" name="active">
                      
                          <option selected disabled>--Select Status--</option>
                          <option value="1" {{old("active") == 1 ? "selected" : "" }}>Active</option>
                          <option value="0" {{old("active") == 0 ? "selected" : "" }}>Inactive</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Upload Image</label>
                        <input type="file" class="form-control rounded" name="image" onchange="readURLImage(this);">
                      </br>
                      <img style="height:150px; width:150px; border-radius: 25px;" src="{{asset('1.jpg')}}" id="image">
                   </div>
                    
                    
                    
                
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-light">Save Slider</button>
                </div>
            </form>  
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- branch add model end --> 



@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('.dltBtn').click(function(e){
       
        var form = $(this).closest('form');
        var dataId = $(this).data('id');
        e.preventDefault();
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
        })
        
        

    });

</script>

<script>
$('input[name=toogle]').change(function(){
   var mode = $(this).prop('checked');
   var id = $(this).val();
   //alert(id);
   $.ajax({
       url:"{{ route('slider.status')}}",
       type:"POST",
       data:{
           _token:'{{csrf_token()}}',
           mode:mode,
           id:id,
       },
       success:function(response){
           console.log(response.status);

       }
   })
});
</script>

<script type="text/javascript">
	function readURLImage(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image')
                  .attr('src', e.target.result)
                  .width(150)
                  .height(150);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }


   function readURLImageAdd(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image1')
                  .attr('src', e.target.result)
                  .width(150)
                  .height(150);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>


@endsection