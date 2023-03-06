
@php($lihat_konfigurasi_aplikasis = \App\Models\Master_konfigurasi_aplikasi::where('id_konfigurasi_aplikasis', 1)->first())
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
	<div class="sidenav-header">
		<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
		<a class="navbar-brand m-0 mainlogo" href="{{URL('/')}}">
			<img src="{{URL::asset($lihat_konfigurasi_aplikasis->logo_text_konfigurasi_aplikasis)}}" class="navbar-brand-img h-100" alt="{{$lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}">
		</a>
	</div>
	<hr class="horizontal dark mt-0">
	<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
	  	<ul class="navbar-nav">
			@php($active_dashboard 						= '')
			@php($active_icon_dashboard 				= '')
			@if(Request::segment(2) == '' || Request::segment(2) == 'dashboard')
				@php($active_dashboard 					= 'active')
				@php($active_icon_dashboard 			= 'class=activeicon')
			@endif
			<li class="nav-item">
				<a class="nav-link {{$active_dashboard}}" href="{{URL('dashboard')}}">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<svg class="c-sidebar-nav-icon">
							<use xlink:href="{{URL::asset('template/icons/coreui/free.svg#cil-speedometer')}}" {{$active_icon_dashboard}}></use>
						</svg>
					</div>
					<span class="nav-link-text ms-1">Dashboard</span>
				</a>
			</li>
			@php($id_user               = Auth::user()->id)
			@php($get_menus             = \App\Models\Master_menu::where('master_menus.menus_id',null)
															->orderBy('order_menus')
															->get())
			@foreach($get_menus as $menus)
				@php($id_menus          = $menus->id_menus)
				@php($get_sub_menus     = \App\Models\Master_menu::join('master_fiturs','master_menus.id_menus','=','master_fiturs.menus_id')
															->join('master_akses','master_fiturs.id_fiturs','=','master_akses.fiturs_id')
															->join('master_level_sistems','master_akses.level_sistems_id','=','master_level_sistems.id_level_sistems')
															->join('users','master_level_sistems.id_level_sistems','=','users.level_sistems_id')
															->where('master_menus.menus_id',$id_menus)
															->where('id',$id_user)
															->where('nama_fiturs','lihat')
															->groupBy('nama_menus')
															->orderBy('order_menus')
															->get())
				@php($total_sub_menus   = \App\Models\Master_menu::join('master_fiturs','master_menus.id_menus','=','master_fiturs.menus_id')
															->join('master_akses','master_fiturs.id_fiturs','=','master_akses.fiturs_id')
															->join('master_level_sistems','master_akses.level_sistems_id','=','master_level_sistems.id_level_sistems')
															->join('users','master_level_sistems.id_level_sistems','=','users.level_sistems_id')
															->where('master_menus.menus_id',$id_menus)
															->where('id',$id_user)
															->where('nama_fiturs','lihat')
															->count())
				@if($total_sub_menus != 0)
					@php($cek_submenus = \App\Models\Master_menu::where('link_menus',Request::segment(2))
																->where('master_menus.menus_id',$menus->id_menus)
																->count())
					<li class="nav-item mt-3">
						<h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">{{$menus->nama_menus}}</h6>
					</li>
					@foreach($get_sub_menus as $sub_menus)
						@php($active_sub_menus 						= '')
						@php($active_icon_sub_menus 				= '')
						@if(Request::segment(2) == $sub_menus->link_menus)
							@php($active_sub_menus 					= 'active')
							@php($active_icon_sub_menus 			= 'class=activeicon')
						@endif
						<li class="nav-item">
							<a class="nav-link {{$active_sub_menus}}" href="{{URL('dashboard/'.$sub_menus->link_menus)}}">
								<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
									<svg class="c-sidebar-nav-icon">
										<use xlink:href="{{URL::asset('template/icons/coreui/free.svg#'.$sub_menus->icon_menus)}}" {{$active_icon_sub_menus}}></use>
									</svg>
								</div>
								<span class="nav-link-text ms-1">{{$sub_menus->nama_menus}}</span>
							</a>
						</li>
					@endforeach
				@endif
			@endforeach
	  	</ul>
	</div>
	<div class="sidenav-footer mx-3 ">
	  	<a class="btn bg-gradient-primary mt-3 w-100" href="{{URL('dashboard/logout')}}">
			Logout
		</a>
	</div>
</aside>