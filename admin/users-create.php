<?php include('includes/header.php'); ?>


  <div class="row" style="max-width: 1000px; margin-left: 100px;">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
            <h4 >
              <h4 style ="font-family: Comic Sans MS;">Add Users</h4>
              <a href="users.php" class="btn btn-danger" style=" margin-left: 800px;">Back</a>
            </h4>
          </div>
          <div class="card-body">

          <?= Functions::alertMessage(); ?>
              <form action="code.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3">
                     <label>Name</label>
                     <br/><br/><br/><br/>
                     <input type="text"  name="name" class="form-control">
                    </div>        
                    </div>

                    <div class="col-md-6">
                    <div class="mb-3">
                     <label>phone No.</label>
                     <br/><br/><br/><br/>
                     <input type="text"  name="phone" class="form-control">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                     <label>Email</label>
                     <br/><br/><br/><br/>
                     <input type="email"  name="email" class="form-control">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                     <label>Password</label>
                     <br/><br/><br/>
                     <input type="password"  name="password" class="form-control">
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="mb-3">
                     <label>Select a Role</label>
                     <br/><br/><br/><br/>
                     <select name="role" class="form-select">
                        <option value="">Select a Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                     </select>
                    </div>
                    </div>
                    
                    <div class="col-md-3">
                    <div class="mb-3 ">
                    <label>Select a Role</label>
                    <br/><br/><br/><br/><br/>
                    <input type="checkbox"  name="is_ban" style="width:30px ;height:30px" />
                    </div>
                    </div>
                </div>
                  
                 <div class="col-md-6">
                 <div class="mb-3 text-end" style=" margin-left: 800px;">
                 <br/><br/><br/><br/><br/>
                      <button type="submit" name="SaveUser" class="btn btn-primary"  >Save</button>
                    </div>
                    
                 </div>




                
                    
                    
                    
                    
                    
                    

                </form>
          </div>
       </div>
    </div>
   </div>
 








<?php include('includes/footer.php'); ?>