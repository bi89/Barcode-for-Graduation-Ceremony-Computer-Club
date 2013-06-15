<?php $this->load->view('header', $header_data); ?>
<?php //var_dump($rounds); ?>
        <form class="form-inline" action="<?=base_url()?>index.php/map" method="POST">
            <select name="id">
                <?php foreach($graduates as $graduate): ?>
                    <option value="<?=$graduate['id']?>"><?=$graduate['id'].' - '.$graduate['name']?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" id="barcode_no" name="barcode_no" placeholder="barcode">
            <input type="submit" class="btn" value="Map">
        </form>
        <?php if(isset($id)): ?>
        <div class="alert alert-success">
            <?=$id?> - <?=$barcode_no?> Added!
        </div>
        <?php endif; ?>
<?php $this->load->view('footer') ?>