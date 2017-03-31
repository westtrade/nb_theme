
<!-- include/head -->

<div id="top_cart">
	<div class="container">
		<div class="row">

			<div class="col-xs-12">		
				<?php echo  __show_block('nbmod', 'nbmod_cart', false, false); ?>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


			</div>
		</div>
	</div>
</div>


<header id="navbar" role="banner" class="navbar container navbar-nano">

        <div class="navbar-header">
			<?php if ($logo): ?>
				<a class="logo navbar-btn pull-left col-xs-9 col-md-12" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
					<img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
				</a>
			<?php endif; ?>
        </div>

        <div class="navbar-collapse collapse text-center">
            <?php echo __show_block('system', 'main-menu', false, true); ?>
            <?php echo __show_block('nbmod', 'nbmod_lang_selector'); ?>
        </div>


</header>

<?php if (!empty($breadcrumb)): ?>
    <div id="breadcrumbs">
        <div class="container">
                <?php echo $breadcrumb;  ?>
        </div>
    </div>
<?php endif; ?>

<!--/ include/head -->
