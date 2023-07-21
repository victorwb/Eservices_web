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
            <h1 class="h3 mb-0 text-gray-800">Items</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Forms</li>
              <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-9">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit a Item</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('item.update', [$item->id])}}" method="POST" enctype="multipart/form-data">@csrf
                  {{method_field('PUT')}}
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputText1" aria-describedby="emailHelp"
                      value="{{$item->name}}" name="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                      <label for="rating">Rating</label>
                      <input type="text" class="form-control @error('rating') is-invalid @enderror" id="rating"
                      value="{{$item->rating}}" name="rating">
                        @error('rating')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="rating">Price</label>
                      <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                      value="{{$item->price}}" name="price">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="type_name">Type</label>
                    
                      <select class="form-select @error('type_name') is-invalid @enderror" name="type_name" aria-label="Default select example">
                     
                      <option selected>{{$item->type_name}}</option>
                      <option value="hotel">hotel</option>
                      <option value="shop">shop</option>
                      <option value="hostel">hostel</option>
                      <!-- <option value="hotel">hotel</option>                       -->
                      </select>
                        @error('type_name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="type_id">Type name</label>
                    
                      <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" aria-label="Default select example">
                     
                      <option selected>{{$item->type_id}}</option>
                      @foreach($hotels as $hotel)
                      <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                      @endforeach
                     
                        @error('type_id')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="desc">Description</label>
                      <input type="text" class="form-control @error('description') is-invalid @enderror" id="desc"
                      value="{{$item->description}}" name="description">
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="rating">No.</label>
                      <input type="text" class="form-control @error('rating') is-invalid @enderror" id="no"
                      value="{{$item->no}}" name="no">
                        @error('no')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="image" >
                        <label class="custom-file-label" for="customFile">Choose photo</label>
                        <img src="{{Storage::url($item->image)}}" width='150'/>
                        <br/><br/>
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
   