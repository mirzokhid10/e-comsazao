 <div class="main-sidebar sidebar-style-2">
     <aside id="sidebar-wrapper">
         <div class="sidebar-brand">
             <a href="{{ route('admin.dashboard') }}">{{ $settings->site_name }}</a>
         </div>
         <div class="sidebar-brand sidebar-brand-sm">
             <a href="{{ route('admin.dashboard') }}">{{ $settings->site_name }}</a>
         </div>
         <ul class="sidebar-menu">
             <li class="menu-header {{ setActive(['admin.dashboard.*']) }}">Dashboard</li>
             <li class="dropdown">
                 <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                         class="fas fa-fire"></i><span>Dashboard</span></a>
             </li>
         </ul>

         <ul class="sidebar-menu">
             <li class="menu-header">Starter</li>
             <li
                 class="dropdown {{ setActive([
                     'admin.slider.*',
                     'admin.brand.*',
                     'admin.setting.*',
                     'admin.flash-sale.*',
                     'admin.home-page-setting.*',
                     'admin.vendor-condition.*',
                     'admin.terms-and-conditions.*',
                     'admin.newsletter-subscriber.*',
                     'admin.about.*',
                 ]) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                     <span>Website Managment</span></a>
                 <ul class="dropdown-menu">
                     <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                             href="{{ route('admin.slider.index') }}">Main
                             Page Sliders</a></li>

                     <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                             href="{{ route('admin.brand.index') }}">Main
                             Page Brands</a></li>
                     <li class="{{ setActive(['admin.setting.*']) }}"><a class="nav-link"
                             href="{{ route('admin.setting.index') }}">
                             Main Page Settings</a>
                     </li>
                     <li class="{{ setActive(['admin.newsletter-subscriber.*']) }}"><a class="nav-link"
                             href="{{ route('admin.newsletter-subscriber.index') }}">
                             Newsletter Subscriber</a>
                     <li class="{{ setActive(['admin.terms-and-conditions.*']) }}"><a class="nav-link"
                             href="{{ route('admin.terms-and-conditions.index') }}">Terms and Conditions</a></li>
                     <li class="{{ setActive(['admin.flash-sale.*']) }}"><a class="nav-link"
                             href="{{ route('admin.flash-sale.index') }}">
                             Flash Sale Pages</a></li>
                     <li class="{{ setActive(['admin.home-page-setting.*']) }}">
                         <a class="nav-link" href="{{ route('admin.home-page-setting.index') }}">
                             Home Page Setting</a>
                     </li>
                     <li class="{{ setActive(['admin.about.*']) }}"><a class="nav-link"
                             href="{{ route('admin.about.index') }}">About</a></li>
             </li>
         </ul>

         <ul class="sidebar-menu">
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
                     <li class="{{ setActive(['admin.reviews.*']) }}"><a class="nav-link"
                             href="{{ route('admin.reviews.index') }}">Product Reviews</a></li>
             </li>
             </li>
         </ul>

         <ul class="sidebar-menu">
             <li class="menu-header">Orders </li>
             <li
                 class="dropdown {{ setActive([
                     'admin.order.*',
                     'admin.pending-orders',
                     'admin.processed-orders',
                     'admin.dropped-off-orders',
                     'admin.shipped-orders',
                     'admin.out-for-delivery-orders',
                     'admin.delivered-orders',
                     'admin.canceled-orders',
                 ]) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cart-plus"></i>
                     <span>Orders</span></a>
                 <ul class="dropdown-menu">
                     <li class="{{ setActive(['admin.order.*']) }}"><a class="nav-link"
                             href="{{ route('admin.order.index') }}">All Orders</a></li>
                     <li class="{{ setActive(['admin.pending-orders']) }}"><a class="nav-link"
                             href="{{ route('admin.pending-orders') }}">All Pending Orders</a></li>
                     <li class="{{ setActive(['admin.processed-orders']) }}"><a class="nav-link"
                             href="{{ route('admin.processed-orders') }}">All Processed Orders</a></li>
                     <li class="{{ setActive(['admin.dropped-off']) }}"><a class="nav-link"
                             href="{{ route('admin.dropped-off-orders') }}">All Dropped Off Orders</a></li>

                     <li class="{{ setActive(['admin.shipped-orders']) }}"><a class="nav-link"
                             href="{{ route('admin.shipped-orders') }}">All Shipped Orders</a></li>
                     <li class="{{ setActive(['admin.out-for-delivery-orders']) }}"><a class="nav-link"
                             href="{{ route('admin.out-for-delivery-orders') }}">All Out For Delivery
                             Orders</a></li>


                     <li class="{{ setActive(['admin.delivered-orders']) }}"><a class="nav-link"
                             href="{{ route('admin.delivered-orders') }}">All Delivered Orders</a></li>

                     <li class="{{ setActive(['admin.canceled-orders']) }}"><a class="nav-link"
                             href="{{ route('admin.canceled-orders') }}">All Canceled Orders</a></li>

                 </ul>
             </li>
         </ul>

         <ul class="sidebar-menu">
             <li class="menu-header">Transactions</li>
             <li class="{{ setActive(['admin.transaction']) }}"><a class="nav-link"
                     href="{{ route('admin.transaction') }}">
                     <i class="fas fa-money-bill-alt"></i>
                     <span>Transactions</span></a>
             </li>
         </ul>

         <ul class="sidebar-menu">
             <li class="menu-header">Blog</li>
             <li class="dropdown {{ setActive(['admin.blog-category.*', 'admin.blog-comment.*', 'admin.blog.*']) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                     <span>Blog Managment</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="{{ setActive(['admin.blog.*']) }}"
                             href="{{ route('admin.blog.index') }}">Blogs</a></li>
                     <li><a class="{{ setActive(['admin.blog-category.*']) }}"
                             href="{{ route('admin.blog-category.index') }}">Blog Categories</a></li>
                     <li><a class="{{ setActive(['admin.blog-comment.*']) }}"
                             href="{{ route('admin.blog-comment.index') }}">Blog Comments</a></li>
                 </ul>
             </li>
         </ul>

         <ul class="sidebar-menu">
             <li class="menu-header">Messages</li>
             <li><a class="nav-link {{ setActive(['admin.message.index']) }}"
                     href="{{ route('admin.message.index') }}"><i class="fas fa-envelope"></i>
                     <span>Messages</span></a></li>
         </ul>

         <ul class="sidebar-menu">
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
                 class="dropdown {{ setActive(['admin.vendor-profile.*', 'admin.vendor-requests.*', 'admin.coupon.*', 'admin.shipping-rule.*']) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                     <span>Vendor Managment</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="{{ setActive(['admin.vendor-profile.*']) }}"
                             href="{{ route('admin.vendor-profile.index') }}">Vendors Managment</a></li>
                     <li class="{{ setActive(['admin.vendor-requests.*']) }}">
                         <a href="{{ route('admin.vendor-requests.index') }}" class="nav-link">
                             <span>Vendor Requests</span>
                         </a>
                     </li>
                     <li><a class="{{ setActive(['admin.admin-list.*']) }}"
                             href="{{ route('admin.admin-list.index') }}">Admin Managment</a></li>
                     <li class="{{ setActive(['admin.manage-user.*']) }}"><a class="nav-link"
                             href="{{ route('admin.manage-user.index') }}">Users Managment</a></li>
                     <li class="{{ setActive(['admin.customer.*']) }}"><a class="nav-link"
                             href="{{ route('admin.customer.index') }}">Customer Managment</a></li>
                     <li><a class="{{ setActive(['admin.coupon.*']) }}"
                             href="{{ route('admin.coupon.index') }}">Coupons Managment</a></li>
                     <li><a class="{{ setActive(['admin.shipping-rule.*']) }}"
                             href="{{ route('admin.shipping-rule.index') }}">Shipping Managment</a></li>
                     <li><a class="{{ setActive(['admin.payment-settings.*']) }}"
                             href="{{ route('admin.payment-settings.index') }}">Payment Managment</a></li>
                 </ul>
             </li>
         </ul>

         <ul class="sidebar-menu">
             <li class="menu-header">Footer</li>
             <li
                 class="dropdown {{ setActive([
                     'admin.footer-info.*',
                     'admin.footer-grid-two.*',
                     'admin.footer-grid-three.*',
                     'admin.footer-social.*',
                 ]) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                     <span>Footer Managment</span></a>
                 <ul class="dropdown-menu">
                     <li class="{{ setActive(['admin.footer-info.*']) }}"><a class="nav-link"
                             href="{{ route('admin.footer-info.index') }}">Footer Info</a></li>
                     <li class="{{ setActive(['admin.footer-grid-two.*']) }}"><a class="nav-link"
                             href="{{ route('admin.footer-grid-two.index') }}">Footer Grid Two</a></li>
                     <li class="{{ setActive(['admin.footer-grid-three.*']) }}"><a class="nav-link"
                             href="{{ route('admin.footer-grid-three.index') }}">Footer Grid Three</a></li>
                     <li class="{{ setActive(['admin.footer-social.*']) }}"><a class="nav-link"
                             href="{{ route('admin.footer-social.index') }}">Footer Social</a></li>

                     <li class="{{ setActive(['admin.advertisement.*']) }}"><a class="nav-link"
                             href="{{ route('admin.advertisement.index') }}">Advertisement</a></li>
                 </ul>
             </li>
         </ul>
     </aside>
 </div>
