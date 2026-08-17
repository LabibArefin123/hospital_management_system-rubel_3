 <div id="contactFilterSection" class="card shadow-sm border-0 mb-4 d-none">

     <div class="card-body">

         <div class="row">

             {{-- SEARCH --}}
             <div class="col-md-3">

                 <div class="form-group">

                     <label>
                         Search
                     </label>

                     <input type="text" id="searchFilter" class="form-control" placeholder="Name, email or phone">

                 </div>

             </div>

             {{-- DEPARTMENT --}}
             <div class="col-md-3">

                 <div class="form-group">

                     <label>
                         Department
                     </label>

                     <input type="text" id="departmentFilter" class="form-control" placeholder="Department">

                 </div>

             </div>

             {{-- SERVICE --}}
             <div class="col-md-3">

                 <div class="form-group">

                     <label>
                         Service
                     </label>

                     <input type="text" id="serviceFilter" class="form-control" placeholder="Service">

                 </div>

             </div>

             {{-- DATE --}}
             <div class="col-md-3">

                 <div class="form-group">

                     <label>
                         Date
                     </label>

                     <input type="date" id="dateFilter" class="form-control">

                 </div>

             </div>

         </div>

         <div class="text-right">

             <button id="resetFilterBtn" class="btn btn-danger">

                 <i class="fas fa-sync-alt mr-1"></i>

                 Reset Filters

             </button>

         </div>

     </div>

 </div>
