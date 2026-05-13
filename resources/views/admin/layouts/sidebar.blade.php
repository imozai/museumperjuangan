<!--<div class="sidebar" data-background-color="white" data-active-color="danger">

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="" class="simple-text">
                Museum Perjuangan<br>Admin
            </a>
        </div>

        <ul class="nav">
            <li>
                <a href="{{ url('/admin') }}">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="ti-archive"></i>
                    <p>Koleksi <b class="caret"></b></p>    
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ url('/admin/koleksi/create') }}">
                            <i class="ti-archive"></i>
                            <p>Tambah Koleksi</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/koleksi') }}">
                            <i class="ti-view-list-alt"></i>
                            <p>List Koleksi</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="ti-book"></i>
                    <p>Berita <b class="caret"></b></p>    
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ url('/admin/news/create') }}">
                            <i class="ti-book"></i>
                            <p>Tambah Berita</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/news') }}">
                            <i class="ti-view-list-alt"></i>
                            <p>List Berita</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>-->
      @if(auth()->guard()->user()->darkmode == 0)
        <ul class="nav">
          <li class="nav-item nav-profile mt-4">
            <div class="nav-link">
              <a href="#" data-toggle="modal" data-target="#profilModal">
                <div class="user-wrapper">
                  <div class="profile-image">
                    @if( auth()->guard()->user()->email == "museumperjuanganjogja@gmail.com" )
                      <img src="{{asset('uploads/superadmin.png')}}" alt="profile image">
                    @else
                      <img src="{{asset('uploads/admin.png')}}" alt="profile image">
                    @endif
                  </div>
                  <div class="text-wrapper">
                    <p class="profile-name">{{ auth()->guard('admin')->check() ? auth()->guard()->user()->name : 'Account' }}</p>
                    <div>
                      @if( auth()->guard()->user()->email != "museumperjuanganjogja@gmail.com" )
                      <small class="designation text-muted" style="text-transform: uppercase;letter-spacing: 1px;">Admin</small>
                      @else
                      <small class="designation text-muted" style="text-transform: uppercase;letter-spacing: 1px;">Master Admin</small>
                      @endif
                      <span class="status-indicator online"></span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{url('/admin')}}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Manajemen Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/admin/koleksi') }}">
                    <i class="menu-icon mdi mdi-folder-lock"></i> Koleksi
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/admin/news') }}">
                    <i class="menu-icon mdi mdi-library-books"></i> Berita
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/admin/event') }}">
                    <i class="menu-icon mdi mdi-calendar"></i> Event
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{url('/admin/kritik')}}">
              <i class="menu-icon mdi mdi-comment-multiple-outline"></i>
              <span class="menu-title">Kritik & Saran</span>
            </a>
          </li>
          <li class="nav-item border-top">
            <center>
              <small class="designation text-dark mt-4" 
              style="text-align: center; text-transform: uppercase; letter-spacing: 1px;">
                museum benteng vredeburg<br>yogyakarta<br>unit II
              </small>
            </center>
          </li>
          <li class="nav-item border-top">
              <small class="designation text-dark mt-4" id="jamNow"
              style="text-align: center; text-transform: uppercase; letter-spacing: 1px; position: absolute; bottom: 10px; left: 5px;">
              </small>
          </li>
        </ul>
<!-- ========================================================================================DARKMODE================================================================================ -->
      @else
        <ul class="nav-dark">
          <li class="nav-item nav-profile mt-4">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                    @if( auth()->guard()->user()->email == "museumperjuanganjogja@gmail.com" )
                      <img src="{{asset('uploads/superadmin.png')}}" alt="profile image">
                    @else
                      <img src="{{asset('uploads/admin.png')}}" alt="profile image">
                    @endif
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{ auth()->guard('admin')->check() ? auth()->guard()->user()->name : 'Account' }}</p>
                  <div>
                    @if( auth()->guard()->user()->email != "museumperjuanganjogja@gmail.com" )
                    <small class="designation text-muted" style="text-transform: uppercase;letter-spacing: 1px;">Admin</small>
                    @else
                    <small class="designation text-muted" style="text-transform: uppercase;letter-spacing: 1px;">Master Admin</small>
                    @endif
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{url('/admin')}}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Manajemen Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/admin/koleksi') }}">
                    <i class="menu-icon mdi mdi-folder-lock"></i> Koleksi
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/admin/news') }}">
                    <i class="menu-icon mdi mdi-library-books"></i> Berita
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/admin/event') }}">
                    <i class="menu-icon mdi mdi-calendar"></i> Event
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{url('/admin/kritik')}}">
              <i class="menu-icon mdi mdi-comment-multiple-outline"></i>
              <span class="menu-title">Kritik & Saran</span>
            </a>
          </li>
          <li class="nav-item border-top">
            <center>
              <small class="designation text-muted mt-4" 
              style="text-align: center; text-transform: uppercase; letter-spacing: 1px;">
                museum benteng vredeburg<br>yogyakarta<br>unit II
              </small>
            </center>
          </li>
          <li class="nav-item border-top">
              <small class="designation text-muted mt-4" id="jamNow"
              style="text-align: center; text-transform: uppercase; letter-spacing: 1px; position: absolute; bottom: 10px; left: 5px;">
              </small>
          </li>
        </ul>

<!-- ======================================================================================================================================================================== -->
      @endif