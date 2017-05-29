@php

	$menuHtml = '<li>Пусто...</li>';
	$generate_menu = config( 'admin.settings.generate_menu_array' );
	$items = $generate_menu ? \Egorryaroslavl\Admin\AdminController::mainMenu() : config( 'admin.menu' );
	$Count = count( $items );

	if( $Count > 0 ){

		$menuHtml = '';

		for( $i = 0; $i < $Count; $i++ ){
 
			$menuHtml .= '
		<div class="col-lg-4 col-md-4">
		<a href="' . $items[ $i ][ 'url' ] . '">
			<div class="widget icon-menu-item style1 lazur-bg">
				<div class="row">
					<div class="col-xs-4">
						<i class="' . $items[ $i ] [ 'icon' ] . ' fa-5x"></i>
					</div>
					<div class="col-xs-8 iconMenu" style="margin-left:-30px">
						<span> Раздел </span>
						<h2>' . $items[ $i ] [ 'title' ] . '</h2>
					</div>
				</div>
			</div>
			</a>
		</div>
            ';
		}
	}
@endphp
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{!! $menuHtml !!}
	</div>
</div>