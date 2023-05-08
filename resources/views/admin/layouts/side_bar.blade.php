<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          
  <div class="app-brand demo">
   
      <span class="app-brand-logo demo text-end">
        
        <div style="height:50px;width: 220px;border:none;">
          <img src="{{ asset('images')}}" alt="Logo" style="max-width: 100%; max-height: 100%;">
        </div>
        
      </span>
   
  

  
  </div>
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 pt-4">
      <!-- Dashboard -->
      <li class="menu-item {{ Request::is('home') ? 'active' : '' }}">
        <a href="{{route('home')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>
      <li class="menu-item {{ Request::is('user') ? 'active' : '' }}">
        <a href="{{route('user')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">User</div>
        </a>
      </li>
    
     
     
 
      
    </ul>
  </aside>