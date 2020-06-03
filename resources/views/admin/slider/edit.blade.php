@extends('layouts.admin')

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">Edit Slider <a class="add-btn" href="{{route('admin-sl-index')}}"><i class="fas fa-arrow-left"></i> Back</a></h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('admin.dashboard') }}">Dashboard </a>
                        </li>
                        <li>
                          <a href="javascript:;">Home Page Settings</a>
                        </li>
                        <li>
                          <a href="{{ route('admin-sl-index') }}">Banner Sliders</a>
                        </li>
                        <li>
                          <a href="{{route('admin-sl-edit',$data->id)}}">Edit</a>
                        </li>
                      </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form id="geniusform" action="{{route('admin-sl-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                      @include('includes.admin.form-both') 


                                      {{-- Title Section --}}

                                      <div class="panel panel-default slider-panel">
                                                <div class="panel-heading text-center"><h3>Title</h3></div>
                                                <div class="panel-body">
                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                    <label class="control-label" for="title_text">Text*</label>

                                                  <textarea class="form-control" name="title_text" id="title_text" rows="5"  placeholder="Enter Title Text">{{$data->title_text}}</textarea>
                                                </div>
                                              </div>


                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                   <div class="row">
                                                      <div class="col-sm-6">
                                                      <label class="control-label" for="title_size">Font Size *<span> (px)</span></label>
                                                      <input class="form-control" type="number" name="title_size" value="{{$data->title_size}}" min="1">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="control-label" for="title_color">Font Color *</label>
                                                      <div class="input-group colorpicker-component cp">
                                                        <input type="text" name="title_color" value="{{$data->title_color}}"  class="form-control cp"  />
                                                        <span class="input-group-addon"><i></i></span>
                                                      </div>

                                                    </div>
                                                   </div>

                                                </div>
                                              </div>
                                        </div>
                                        </div>

                                      {{-- Title Section Ends--}}


                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">Link *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="link" placeholder="Link" required="" value="{{$data->link}}">

                          </div>
                        </div>


                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">Save</button>
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection