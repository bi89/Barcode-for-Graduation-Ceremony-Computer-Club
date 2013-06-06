<?php $this->load->view('header', $header_data); ?>
        <div class="row">
            <dl class="dl-horizontal">
            <?php 
            foreach($profile as $row): 
            ?>
            	<dt><?=$row['displayname']?></dt>
            	<dd><?=$row['value'];?></dd>
        	<?php endforeach; ?>
        	</dl>
        </div>
<?php $this->load->view('footer', $footer_data); ?>