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
              <li class="breadcrumb-item active" aria-current="page">Add User</li>
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
                  <h6 class="m-0 font-weight-bold text-primary">Add a User</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputText1" aria-describedby="emailHelp"
                        placeholder="Enter name of user" name="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="rating">Email</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="rating"
                        placeholder="Enter email" name="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="desc">Password</label>
                      <input type="text" class="form-control @error('description') is-invalid @enderror" id="desc"
                        placeholder="Enter a password" name="visible_password">
                        @error('visible_password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="desc">Role</label>
                      <input type="text" class="form-control @error('role') is-invalid @enderror" id="loc"
                        placeholder="chose a role" name="role">
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
     
      <!-- Footer -->
      @include('admin.layouts.footer')
      
      <!-- Footer -->
   