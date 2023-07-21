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
            <h1 class="h3 mb-0 text-gray-800">Healthcare Centers</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Forms</li>
              <li class="breadcrumb-item active" aria-current="page">Add Health Care</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-9">
              @if(Session::has('message'))
              <div>
                {{Session::get('message')}}
              </div>
              @endif
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add a Health Care</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('healthcare.store')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputText1" aria-describedby="emailHelp"
                        placeholder="Enter name of health care" name="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="rating">Rating</label>
                      <input type="text" class="form-control @error('rating') is-invalid @enderror" id="rating"
                        placeholder="Enter a rating" name="rating">
                        @error('rating')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="desc">Description</label>
                      <input type="text" class="form-control @error('description') is-invalid @enderror" id="desc"
                        placeholder="Enter a description of the health care" name="description">
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="desc">Location</label>
                      <input type="hidden" class="form-control @error('location') is-invalid @enderror" id="loc"
                        placeholder="choose location" name="location">
                        @error('location')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div id="map"></div>
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqLFOr4P3S7kjjR3i0633XBl-ygfGp2-U&callback=initMap"></script>
                    <br/><br/>
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" name="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                        <label class="custom-file-label" for="customFile">Choose photo</label>
                      </div>
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
   