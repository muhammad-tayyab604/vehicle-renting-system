     <div class="leftAdmin w-[16%] border p-6 h-[100vh]">
         <div class="dash flex items-center hover:text-[var(--main-color)] duration-300">
             <i class="fa-solid fa-gauge-high text-[var(--text-color)]"></i>
             <a href="{{ route('adminIndex') }}">
                 <p class="p-4">Dashboard</p>
             </a>
         </div>
         <div class="dash flex items-center hover:text-[var(--main-color)] duration-300">
             <i class="fa-solid fa-cloud-arrow-up text-[var(--text-color)]"></i>
             <a href="{{ route('admin.vehicles.vehicleupload') }}">
                 <p class="p-4">Vehicle Upload</p>
             </a>
         </div>
         <div class="dash flex items-center hover:text-[var(--main-color)] duration-300">
             <i class="fa-solid fa-pen-to-square text-[var(--text-color)]"></i>
             <a href="{{ route('admin.edit.vehicles.vehicledit') }}">
                 <p class="p-4">Edit Vehicle</p>
             </a>
         </div>
         <div class="dash flex items-center hover:text-[var(--main-color)] duration-300">
             <i class="fa-solid fa-gears text-[var(--text-color)]"></i>
             <a href="{{ route('admin.categoryIndex') }}">
                 <p class="p-4">Add Category</p>
             </a>
         </div>

         <div class="dash flex items-center hover:text-[var(--main-color)] duration-300">
             <i class="fa-solid fa-book text-[var(--text-color)]"></i>
             <a href="{{ route('admin.booking.list') }}">
                 <p class="p-4">Booking List</p>
             </a>
         </div>
         <div class="dash flex items-center hover:text-[var(--main-color)] duration-300">
             <i class="fa-solid fa-person-military-pointing text-[var(--text-color)]"></i>
             <a href="{{ route('verify.customer') }}">
                 <p class="p-4">Verify Customer</p>
             </a>
         </div>
         <div class="dash flex items-center hover:text-[var(--main-color)] duration-300">
             <i class="fa-solid fa-percentage text-[var(--text-color)]"></i>
             <a href="{{ route('discounts.coupons') }}">
                 <p class="p-4">Create Discounts</p>
             </a>
         </div>
         <div class="dash flex items-center hover:text-[var(--main-color)] duration-300">
             <i class="fa-solid fa-tags text-[var(--text-color)]"></i>
             <a href="{{ route('coupons.index') }}">
                 <p class="p-4">Coupons</p>
             </a>
         </div>
     </div>
