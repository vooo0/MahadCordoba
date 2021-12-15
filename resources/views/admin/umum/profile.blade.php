@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />

@endpush

@section('content')
<div class="profile-page tx-13">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="profile-header">
        <div class="cover">
          <div class="gray-shade"></div>
          <figure>
            <img src="{{ url('https://via.placeholder.com/1148x272') }}" class="img-fluid" alt="profile cover">
          </figure>
          <div class="cover-body d-flex justify-content-between align-items-center">
            <div>
              <img class="profile-pic" src="{{ url('https://via.placeholder.com/100x100') }}" alt="profile">
              <span class="profile-name">{{Auth::user()->name}}</span>
            </div>
            <div class="d-none d-md-block">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i data-feather="edit" class="btn-icon-prepend"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row profile-body">
    <!-- left wrapper start -->
    <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
      <div class="card rounded">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="card-title mb-0">Tentang</h6>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="git-branch" class="icon-sm mr-2"></i> <span class="">Update</span></a>
                <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View all</span></a>
              </div>
            </div>
          </div>
          <p></p>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Sebagai:</label>
            <p class="text-muted"> Admin {{Auth::user()->level}}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Bergabung Pada:</label>
            <p class="text-muted">{{date_format(Auth::user()->created_at, 'd-m-Y')}}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Alamat:</label>
            <p class="text-muted">{{Auth::user()->alamat}}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
            <p class="text-muted">{{Auth::user()->email}}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Telephone:</label>
            <p class="text-muted">{{Auth::user()->telephone}}</p>
          </div>
        </div>
      </div>
    </div>
    <!-- left wrapper end -->
    <!-- middle wrapper start -->
    <div class="col-md-8 col-xl-6 middle-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card rounded">
            <div class="card-header">
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <img class="img-xs rounded-circle" src="{{ url('https://via.placeholder.com/37x37') }}" alt="">													
                  <div class="ml-2">
                    <p>Mike Popescu</p>
                    <p class="tx-11 text-muted">created_at</p>
                  </div>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Unfollow</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Go to post</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="share-2" class="icon-sm mr-2"></i> <span class="">Share</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy link</span></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus minima delectus nemo unde quae recusandae assumenda.</p>
              <img class="img-fluid" src="{{ url('https://via.placeholder.com/513x432') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- middle wrapper end -->
    <!-- right wrapper start -->
    <div class="d-none d-xl-block col-xl-3 right-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card rounded">
            <div class="card-body">
              <h6 class="card-title">Mungkin Anda Kenal</h6>
              @foreach($getRandom as $key => $value)
                <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">    
                  <div class="d-flex align-items-center hover-pointer">
                      <img class="img-xs rounded-circle" src="{{ url('https://via.placeholder.com/37x37') }}" alt="">													
                      <div class="ml-2">
                          <p>{{$value->name}}</p>
                          @if($value->email == NULL)
                              <p class="tx-11 text-muted">Tidak Dicantumkan</p>                          
                          @endif
                          <p class="tx-11 text-muted">{{$value->email}}</p>
                        </div>
                    </div>
                    <button class="btn btn-icon"><i data-feather="phone" data-toggle="tooltip" title="Hubungi"></i></button>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- right wrapper end -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="label">Upload Foto</label>
          <input name="foto" type="file" id="myDropify" class="border"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush