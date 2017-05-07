<nav id="site-navigation" class="main-navigation" role="navigation">
	<label for="navi-anchor">
			<input type="checkbox" id="navi-anchor" autocomplete="off" />
			<div id="nav-bars">
				<div class="stripe"></div>
				<div class="stripe"></div>
				<div class="stripe"></div>
			</div>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'top-menu', 'container_class' => 'mui--text-right' ) ); ?>
			</label>
</nav>
