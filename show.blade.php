<title>AppUser</title>
@extends('layouts.admin')
@section('content')
<section class="content-header">
  <h1>
   View Users
  </h1>
  <ol class="breadcrumb">
     <a class="btn btn-success" href="{{ route('app_user.index') }}"> View User</a>
  </ol>
</section>
<br>

 <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="
              @if($data->logo !=null)
                {{URL::to('kyc/'.$data->mobile_no)}}/{{$data->logo}}
              @else
                {{URL::to('/dist/img/user1-128x128.jpg')}}
              @endif
              " alt="User profile picture">
              <p class="text-center">
                
              </p>
              <h3 class="profile-username text-center">{{$data->name}}
                <p>
                   @if($document)
                       @if($document->document_verified == 2)
                      <button type="button" class="btn btn-xs btn-success">Kyc Done</button>
                        @elseif($document->document_verified == 1)
                           <button type="button" class="btn btn-xs btn-warning">Still Pending</button>
                        @else
                          <button type="button" class="btn btn-xs btn-danger">Reject</button>
                        @endif
                   @endif                   
                </p>
              </h3>

              <ul class="list-group list-group-unbordered">
               
                <li class="list-group-item">
                  <b>Mobile:</b> <a class="pull-right">{{$data->mobile_no}}</a>
                </li>
                <li class="list-group-item">
                  <b>Email:</b> <a class="pull-right">{{$data->email}}</a>
                </li>
                @if($document)
                 <li class="list-group-item">
                  <b>Pan No:</b> <a class="pull-right">{{$document->pan_no}}</a>
                </li>
                 <li class="list-group-item">
                  <b>Aadhar No:</b> <a class="pull-right">{{$document->aadhar}}</a>
                </li>
                 <li class="list-group-item">
                  <b>Gst No:</b> <a class="pull-right">{{$document->gst_no}}</a>
                </li>
                @endif
                <li class="list-group-item">
                  <b>Address:</b> <a >{{$data->address}}</a>
                </li>

              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Uploaded Documents</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <section class="content">
                  <div class="uploaded-img d-flex">
                  <form action="{{route('app_user.destroy',$data->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                   <table  class="table table-bordered table-striped">
                    @if($document)
                    <tr>
                      <th>Document Name</th>
                      <th>Document Image</th>
                      <th>Document Status</th>
                    <tr>
                    <tr>
                      <td>Gst Front</td>
                       <td>
                        @if($document->gst_doc)
                        <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->gst_doc}}"   data-toggle="modal" data-target="#text" style="width: 60px">
                        <div class="modal fade" id="text" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">View Image</h4>
                              </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="col-md-12">
                                     <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->gst_doc}}" style="width: 100%">
                                   </div>
                                    </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                              </div>
                         </div>
                        @endif
                      </td>
                      <td>
                        @if($document->gst_doc_status == 2)
                          <button type="button" class="btn btn-xs btn-success">Approved</button>
                          <label class="radio-inline"><input type="radio" name="gst_doc_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="gst_doc_status" value="1">Pending</label>
                        @elseif($document->gst_doc_status == 1)
                          <button type="button" class="btn btn-xs btn-warning">Pending</button>
                          <label class="radio-inline"><input type="radio" name="gst_doc_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="gst_doc_status" value="2">Approved</label>
                        @else
                          <button type="button" class="btn btn-xs btn-danger">Reject</button>
                          <label class="radio-inline"><input type="radio" name="gst_doc_status" value="1">Pending</label>
                          <label class="radio-inline"><input type="radio" name="gst_doc_status" value="2">Approved</label>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td>Gst Back</td>
                       <td>
                        @if($document->gst_back)
                          <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->gst_back}}"   data-toggle="modal" data-target="#text1" style="width: 60px">
                        <div class="modal fade" id="text1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">View Image</h4>
                              </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="col-md-12">
                                     <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->gst_back}}" style="width: 100%">
                                   </div>
                                    </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                              </div>
                         </div>
                        @endif
                      </td>
                      <td>
                        @if($document->gst_back_status == 2)
                          <button type="button" class="btn btn-xs btn-success">Approved</button>
                          <label class="radio-inline"><input type="radio" name="gst_back_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="gst_back_status" value="1">Pending</label>
                        @elseif($document->gst_back_status == 1)
                          <button type="button" class="btn btn-xs btn-warning">Pending</button>
                          <label class="radio-inline"><input type="radio" name="gst_back_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="gst_back_status" value="2">Approved</label>
                        @else
                          <button type="button" class="btn btn-xs btn-danger">Reject</button>
                          <label class="radio-inline"><input type="radio" name="gst_back_status" value="1">Pending</label>
                          <label class="radio-inline"><input type="radio" name="gst_back_status" value="2">Approved</label>
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td>Visiting Front</td>
                       <td>
                        @if($document->visiting_doc)
                          <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->visiting_doc}}"   data-toggle="modal" data-target="#text2" style="width: 60px">
                        <div class="modal fade" id="text2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">View Image</h4>
                              </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="col-md-12">
                                     <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->visiting_doc}}" style="width: 100%">
                                   </div>
                                    </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                              </div>
                         </div>
                        @endif
                      </td>
                      <td>
                        @if($document->visiting_doc_status == 2)
                          <button type="button" class="btn btn-xs btn-success">Approved</button>
                          <label class="radio-inline"><input type="radio" name="visiting_doc_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="visiting_doc_status" value="1">Pending</label>
                        @elseif($document->visiting_doc_status == 1)
                          <button type="button" class="btn btn-xs btn-warning">Pending</button>
                          <label class="radio-inline"><input type="radio" name="visiting_doc_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="visiting_doc_status" value="2">Approved</label>
                        @else
                          <button type="button" class="btn btn-xs btn-danger">Reject</button>
                          <label class="radio-inline"><input type="radio" name="visiting_doc_status" value="1">Pending</label>
                          <label class="radio-inline"><input type="radio" name="visiting_doc_status" value="2">Approved</label>
                        @endif
                      </td>
                    </tr>

                     <tr>
                      <td>Visiting Back</td>
                       <td>
                        @if($document->visiting_back)
                        <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->visiting_back}}"   data-toggle="modal" data-target="#text3" style="width: 60px">
                        <div class="modal fade" id="text3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">View Image</h4>
                              </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="col-md-12">
                                     <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->visiting_back}}" style="width: 100%">
                                   </div>
                                    </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                              </div>
                         </div>
                        @endif
                      </td>
                      <td>
                        @if($document->visiting_back_status == 2)
                          <button type="button" class="btn btn-xs btn-success">Approved</button>
                          <label class="radio-inline"><input type="radio" name="visiting_back_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="visiting_back_status" value="1">Pending</label>
                        @elseif($document->visiting_back_status == 1)
                          <button type="button" class="btn btn-xs btn-warning">Pending</button>
                          <label class="radio-inline"><input type="radio" name="visiting_back_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="visiting_back_status" value="2">Approved</label>
                        @else
                          <button type="button" class="btn btn-xs btn-danger">Reject</button>
                          <label class="radio-inline"><input type="radio" name="visiting_back_status" value="1">Pending</label>
                          <label class="radio-inline"><input type="radio" name="visiting_back_status" value="2">Approved</label>
                        @endif
                      </td>
                    </tr>

                     <tr>
                      <td>Aadhar Front</td>
                       <td>
                        @if($document->aadhar_doc)
                        <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->aadhar_doc}}"   data-toggle="modal" data-target="#text4" style="width: 60px">
                        <div class="modal fade" id="text4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">View Image</h4>
                              </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="col-md-12">
                                     <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->aadhar_doc}}" style="width: 100%">
                                   </div>
                                    </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                              </div>
                         </div>
                        @endif
                      </td>
                      <td>
                        @if($document->aadhar_doc_status == 2)
                          <button type="button" class="btn btn-xs btn-success">Approved</button>
                          <label class="radio-inline"><input type="radio" name="aadhar_doc_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="aadhar_doc_status" value="1">Pending</label>
                        @elseif($document->aadhar_doc_status == 1)
                          <button type="button" class="btn btn-xs btn-warning">Pending</button>
                          <label class="radio-inline"><input type="radio" name="aadhar_doc_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="aadhar_doc_status" value="2">Approved</label>
                        @else
                          <button type="button" class="btn btn-xs btn-danger">Reject</button>
                          <label class="radio-inline"><input type="radio" name="aadhar_doc_status" value="1">Pending</label>
                          <label class="radio-inline"><input type="radio" name="aadhar_doc_status" value="2">Approved</label>
                        @endif
                      </td>
                    </tr>

                     <tr>
                      <td>Aadhar Back</td>
                       <td>
                        @if($document->aadhar_back)
                        <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->aadhar_back}}"   data-toggle="modal" data-target="#text5" style="width: 60px">
                        <div class="modal fade" id="text5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">View Image</h4>
                              </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="col-md-12">
                                     <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->aadhar_back}}" style="width: 100%">
                                   </div>
                                    </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                              </div>
                         </div>
                        @endif
                      </td>
                      <td>
                        @if($document->aadhar_back_status == 2)
                          <button type="button" class="btn btn-xs btn-success">Approved</button>
                          <label class="radio-inline"><input type="radio" name="aadhar_back_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="aadhar_back_status" value="1">Pending</label>
                        @elseif($document->aadhar_back_status == 1)
                          <button type="button" class="btn btn-xs btn-warning">Pending</button>
                          <label class="radio-inline"><input type="radio" name="aadhar_back_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="aadhar_back_status" value="2">Approved</label>
                        @else
                          <button type="button" class="btn btn-xs btn-danger">Reject</button>
                          <label class="radio-inline"><input type="radio" name="aadhar_back_status" value="1">Pending</label>
                          <label class="radio-inline"><input type="radio" name="aadhar_back_status" value="2">Approved</label>
                        @endif
                      </td>
                    </tr>

                     <tr>
                      <td>Pan Card</td>
                       <td>
                        @if($document->pan_doc)
                        <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->pan_doc}}"   data-toggle="modal" data-target="#text6" style="width: 60px">
                        <div class="modal fade" id="text6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">View Image</h4>
                              </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="col-md-12">
                                     <img src="{{url::to('kyc/'.$data->mobile_no)}}/{{$document->pan_doc}}" style="width: 100%">
                                   </div>
                                    </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                              </div>
                         </div>
                        @endif
                      </td>
                      <td>
                        @if($document->pan_doc_status == 2)
                          <button type="button" class="btn btn-xs btn-success">Approved</button>
                          <label class="radio-inline"><input type="radio" name="pan_doc_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="pan_doc_status" value="1">Pending</label>
                        @elseif($document->pan_doc_status == 1)
                          <button type="button" class="btn btn-xs btn-warning">Pending</button>
                          <label class="radio-inline"><input type="radio" name="pan_doc_status" value="0">Reject</label>
                          <label class="radio-inline"><input type="radio" name="pan_doc_status" value="2">Approved</label>
                        @else
                          <button type="button" class="btn btn-xs btn-danger">Reject</button>
                          <label class="radio-inline"><input type="radio" name="pan_doc_status" value="1">Pending</label>
                          <label class="radio-inline"><input type="radio" name="pan_doc_status" value="2">Approved</label>
                        @endif
                      </td>
                    </tr>

                     </tr>
                     @endif
                   </table>

                      <div class="">
                        <label>Overall Status</label>
                        <select class="form-control" name="status">
                          <option value="">Select Status</option>
                          <option value="0">Reject</option>
                          <option value="1">Pending</option>
                          <option value="2">Approved</option>
                        </select>
                      </div>
                      <div class="">
                        <label>Notification Content</label>
                        <input type="text" name="content" required class="form-control">
                      </div>
                      <div style="">
                        <button class="btn btn-success" type="submit" style="margin-top: 30px">Submit</button>
                      </div>
                      
                    </form>
                </div>
              </div>
              </section>
            </div>
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

@endsection

    <script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: -28.327750, lng: 77.295327};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBMxHnIUxX87X97oH2QOCLu9KgFMghCJw&callback=initMap">
    </script>