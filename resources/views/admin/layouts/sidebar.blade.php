 <div class="main-sidebar sidebar-style-2">
     <aside id="sidebar-wrapper">
         <div class="sidebar-brand">
             <a href="{{ route('admin.dashboard') }}">Stisla</a>
         </div>
         <div class="sidebar-brand sidebar-brand-sm">
             <a href="{{ route('admin.dashboard') }}">St</a>
         </div>
         <ul class="sidebar-menu">
             <li class="menu-header {{ setActive(['admin.dashboard.*']) }}">Dashboard</li>
             <li class="dropdown">
                 <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                         class="fas fa-fire"></i><span>Dashboard</span></a>
             </li>
             <li class="menu-header">Starter</li>
             <li class="dropdown {{ setActive(['admin.slider.*', 'admin.brand.*', 'admin.flash-sale.*']) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                     <span>Website Managment</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="{{ setActive(['admin.slider.*']) }}" href="{{ route('admin.slider.index') }}">Main
                             Page Sliders</a></li>
                     <li><a class="{{ setActive(['admin.brand.*']) }}" href="{{ route('admin.brand.index') }}">Main
                             Page Brands</a></li>
                     <li><a class="{{ setActive(['admin.setting.*']) }}" href="{{ route('admin.setting.index') }}">
                             Main Page Settings</a>
                     </li>
                     <li><a class="{{ setActive(['admin.flash-sale.*']) }}"
                             href="{{ route('admin.flash-sale.index') }}">
                             Flash Sale Pages</a></li>
                 </ul>
             </li>
             <li class="menu-header">Products</li>
             <li
                 class="dropdown {{ setActive([
                     'admin.products.*',
                     'admin.products-image-gallery.*',
                     'admin.products-variant.*',
                     'admin.products-variant-item.*',
                     'admin.seller-products.*',
                     'admin.seller-pending-products.*',
                 ]) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                     <span>Product Managment</span></a>
                 <ul class="dropdown-menu">
                     <li
                         class="{{ setActive([
                             'admin.products.*',
                             'admin.products-image-gallery.*',
                             'admin.products-variant.*',
                             'admin.products-variant-item.*',
                         ]) }}">
                         <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
                     </li>
                     <li class="{{ setActive(['admin.seller-products.*']) }}"><a class="nav-link"
                             href="{{ route('admin.seller-products.index') }}">Seller Products</a></li>
                     <li class="{{ setActive(['admin.seller-pending-products.*']) }}"><a class="nav-link"
                             href="{{ route('admin.seller-pending-products.index') }}">Seller Pending Products</a></li>
                 </ul>


             </li>
             <li class="menu-header">Categories</li>
             <li
                 class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                     <span>Categories Managment</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="{{ setActive(['admin.category.*']) }}"
                             href="{{ route('admin.category.index') }}">Categories</a></li>
                     <li><a class="{{ setActive(['admin.sub-category.*']) }}"
                             href="{{ route('admin.sub-category.index') }}">Sub
                             Categories</a></li>
                     <li><a class="{{ setActive(['admin.child-category.*']) }}"
                             href="{{ route('admin.child-category.index') }}">Child
                             Categories</a></li>
                 </ul>
             </li>
         </ul>
         <ul class="sidebar-menu">
             <li class="menu-header">Transactions</li>
             <li
                 class="dropdown {{ setActive(['admin.vendor-profile.*', 'admin.coupon.*', 'admin.shipping-rule.*']) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                     <span>Vendor Managment</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="{{ setActive(['admin.vendor-profile.*']) }}"
                             href="{{ route('admin.vendor-profile.index') }}">Vendors Managment</a></li>
                     <li><a class="{{ setActive(['admin.coupon.*']) }}"
                             href="{{ route('admin.coupon.index') }}">Coupons Managment</a></li>
                     <li><a class="{{ setActive(['admin.shipping-rule.*']) }}"
                             href="{{ route('admin.shipping-rule.index') }}">Shipping Managment</a></li>
                     <li><a class="{{ setActive(['admin.payment-settings.*']) }}"
                             href="{{ route('admin.payment-settings.index') }}">Payment Managment</a></li>
                 </ul>
             </li>
         </ul>
     </aside>
 </div>
