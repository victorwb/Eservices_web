@include('admin.layouts.header');
<!-- Sidebar -->
@include('admin.layouts.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        @include('admin.layouts.navbar')
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
                     
          
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Forms</li>
              <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-9">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit a User</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('user.update', [$user->id])}}" method="POST" enctype="multipart/form-data">@csrf
                  {{method_field('PUT')}}
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputText1" aria-describedby="emailHelp"
                      value="{{$user->name}}" name="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="rating">Email</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="rating"
                      value="{{$user->email}}" name="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="desc">Password</label>
                      <input type="text" class="form-control @error('description') is-invalid @enderror" id="desc"
                      value="{{$user->visible_password}}" name="visible_password">
                        @error('visible_password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="desc">Role</label>
                      <input type="text" class="form-control @error('role') is-invalid @enderror" id="loc"
                      value="{{$user->role}}" name="role">
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    
                    
                    </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                        <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                      </div> -->
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>


          
        </div>
        <!---Container Fluid-->
      </div>
      <script>
            // Initialize and add the map
let map;

async function initMap() {
  // The location of Uluru
  const position = { lat: 0.6124, lng: 32.4762 };
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  // The map, centered at Uluru
  map = new Map(document.getElementById("map"), {
    zoom: 15,
    center: position,
    mapId: "DEMO_MAP_ID",
  });

  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    map: map,
    position: position,
    title: "Ndejje",
    draggable:true,
  });

  //update marker value
  google.maps.event.addListener(marker,'position_changed',
                            function (){
                              
                                let lat = marker.position.lat()
                                let lng = marker.position.lng()
                                const position = { lat:lat, lng:lng};
                                $('#loc').val(JSON.stringify(position))
                                // $('#lng').val(lng)
                            })
                            google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            marker.setPosition(pos)
                        })
}

initMap();
        </script>
   
      <!-- Footer -->
      @include('admin.layouts.footer')
      
      <!-- Footer -->
   