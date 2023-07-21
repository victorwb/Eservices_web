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
            <h1 class="h3 mb-0 text-gray-800">Restaurants</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Restaurants</li>
            </ol>
          </div>
          <a href="{{route('restaurant.create')}}" class="btn btn-primary mb-1">Add new</a>
          <!-- Row -->
          <div class="row">
          
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Rating</th>
                        <th>Description</th>
                        <th>photo</th>
                        <th colspan='3'>action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>Name</th>
                        <th>Rating</th>
                        <th>Description</th>
                        <th>photo</th>
                        <th colspan="3">action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @if(count($restaurants)>0)
                      @foreach($restaurants as $restaurant)
                      <tr>
                        <td>{{$restaurant->name}}</td>
                        <td>{{$restaurant->rating}}</td>
                        <td>{{$restaurant->description}}</td>
                        <td><img src="{{Storage::url($restaurant->image)}}" width='100'/></td>
                        <th><a href="{{route('restaurant.edit',[$restaurant->id])}}" class="btn btn-secondary mb-1">edit</a></th>
                        <th><a href="{{route('item.index')}}?id={{$restaurant->id }}&&type=Restaurant" class="btn btn-primary mb-1">view products</a></th>
                        <th><form action="{{route('restaurant.destroy',[$restaurant->id])}}" method="POST"
                        onsubmit="return confirmDelete()">@csrf
                        {{method_field('DELETE')}}
                          <!--because of resourceful routing -->
                          
                          <button class="btn btn-danger mb-1" type="submit">delete</button>
                        </form></th>
                      </tr>
                      @endforeach
                      @else
                      <td>No restaurants yet</td>
                      @endif
                                        
                    </tbody>
                  </table>
                  </div>
              </div>
            </div>

          
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      @include('admin.layouts.footer')
      
      <!-- Footer -->
   