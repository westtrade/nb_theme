<!-- include/footer -->

<footer class="footer container">    
    <div class="col-xs-12 text-center visible-xs">
        <?php echo  __show_block('block', '1', false, true, 'visible-xs-inline-block'); ?>
        <br>
    </div>

    <?php echo  __show_block('nbmod', 'nbmod_copyright', false, true, 'col-md-3 col-xs-4'); ?> 

    <div class="col-md-3 hidden-xs text-center">
        <?php echo  __show_block('block', '2', false, true, 'inline-block'); ?>
    </div> 
    
    <div class="col-md-4 hidden-xs text-center">
        <?php echo  __show_block('block', '1', false, true, 'inline-block'); ?>        
    </div> 


    <div class="col-md-2 col-xs-4 text-right">
        <?php echo  __show_block('nbmod', 'nbmod_developer_info', false, false, 'text-left inline-block'); ?>        
    </div>

</footer>

<!--/ include/footer -->
