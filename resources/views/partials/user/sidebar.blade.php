<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="text-center image">
          @if(isset(Auth::user()->basicDetail->image))
          <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="img-circle" style="max-width:90px;" alt="User Image">
          @elseif(isset(Auth::user()->basicDetail))
             @if(Auth::user()->basicDetail->gender == 'M')
               <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsRXflGToQBiuslDfqpbRGQYbXOKS_ukUzAeoMImyCtGdpQ8Ra" class="img-circle" style="max-width:90px;" alt="User Image">
             @else
               <img src="https://cdn2.hercampus.com/jane%20doe.jpg" class="img-circle" style="max-width:90px;" alt="User Image">
             @endif
          @else
          <img src="{{ asset('images/user.png') }}" class="img-circle" style="max-width:90px;" alt="User Image">
          @endif
        </div>
        <div class="info text-center" style="position:relative;left:0">
          <label>Welcome {{ Auth::user()->name }}</label>
            {!! Form::open(['route' => ['user.profile.photo.upload'], 'method' => 'POST', 'files' => 'true']) !!}
            <input type="file" name="image" id="selectedFile3" style="display:none"  required  onchange='this.form.submit();'>
            <a><i class="fa fa-2x fa-edit" onclick="document.getElementById('selectedFile3').click();"></i></a>
            {!! Form::close() !!}
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="{{ Request::is('public/user') ? 'active' : '' }}">
        <a href="{{route('user.dashboard')}}"><i class="fa fa-line-chart"></i> <span>   Dashboard</span></a>
       </li>
       <li class="">
        <a href="{{route('user.basicDetails.index')}}"><i class="fa fa-user"></i> <span>Profile</span></a>
       </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-calendar-check-o"></i>
            <span>Appointment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user.bookings.consultation') }}"><i class="fa fa-circle-o"></i> Consultation</a></li>
            <li><a href="{{ route('user.bookings.service') }}"><i class="fa fa-circle-o"></i> Services</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-sticky-note-o"></i>
            <span>Blogs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('user.posts.create')}}"><i class="fa fa-circle-o"></i> Write Blog</a></li>
            <li><a href="{{route('user.posts.index')}}"><i class="fa fa-circle-o"></i> Posted Blogs</a></li>
          </ul>
        </li>
        <li>
        </li>
       <li class="">
        <a href="{{route('user.asks.questions')}}"><i class="fa fa-files-o"></i> <span>Ask Us</span></a>
       </li>

       <li class="">
        <a href="{{route('user.galleries.index')}}"><i class="fa fa-image"></i> <span>Gallery</span></a>
       </li>
      </ul>
    </section>
    <!-- /.sidebar -->
