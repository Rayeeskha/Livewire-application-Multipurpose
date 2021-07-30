<div>
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <span class="fa  fa-user-circle"></span>&nbsp;Users</h3>

               <div class="d-flex justify-content-end">
               	 <button wire:click.prevent="addNew" class="btn btn-primary">
                	<span class="fa fa-plus-circle mr-1">&nbsp;Add New Users</span>
                </button>
               </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}
                    </td>
                    <td>{{ $user->email }}</td>
                    <td> 
                    	<a href="javascript:void(0)" wire:click.prevent="edit({{ $user }})">
                    		<span class="fa fa-edit"></span>
                    	</a>
                    	<a href="javascript:void(0)"  wire:click.prevent="confirmUserRemoval({{ $user->id }})">
                    		<span  class="fa fa-trash text-danger" style="margin-left: 15px"></span>
                    	</a>
                    </td>
                  </tr>
                  @endforeach
                  
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!--------Add Users ------->
	

	<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">
            <span class="fa  fa-user-circle"></span>&nbsp;
            
            @if($showEditModal)
                Edit User
            @else
              Add New User
            @endif    

        </h5>

	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
    	      <div class="modal-body">
    	          <div class="form-group">
    			    <label for="exampleInputEmail1">Name</label>
    			    <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" id="name" aria-describedby="nameHelp" placeholder="Enter Full Name">

              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror

    			  </div>
    			  <div class="form-group">
    			    <label for="exampleInputPassword1">Email Address</label>
    			    <input type="text"   wire:model.defer="state.email" id="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Enter Email Address">

              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
    			  </div>
    			  <div class="form-group">
    			    <label for="exampleInputPassword1">Password</label>
    			    <input type="password" wire:model.defer="state.password" class="form-control @error('password') is-invalid @enderror"  placeholder="Password">
              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
    			  </div>
    			  <div class="form-group">
    			    <label for="exampleInputPassword1">Confirm Password</label>
    			    <input type="password" wire:model.defer="state.password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"  placeholder="Confirm Password">

              @error('password_confirmation')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
    			  </div>
    		  </div>
    	      <div class="modal-footer">
    	        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;&nbsp;Close</button>
    	        <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span>&nbsp;
              @if($showEditModal)
              Update
              @else
              Save
              @endif
            </button>
    	      </div>
	      </form>
	    </div>
	  </div>
	</div>
<!-------- Users ------->

<!--------Confirmation Modal Section ----------->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Delete User</h5>
      </div>

      <div class="modal-body">
        <h4>Are you sure you want to delete this user?</h4>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
        <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete User</button>
      </div>
    </div>
  </div>
</div>
<!--------Confirmation Modal Section ----------->
</div>



