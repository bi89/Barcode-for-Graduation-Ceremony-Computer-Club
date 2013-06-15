<?php $this->load->view('header', $header_data); ?>
<?php //var_dump($rounds); ?>
        <form class="form-inline" action="<?=base_url()?>" method="POST">
            <input type="text" id="id" name="id" placeholder="รหัสนิสิต">
            <select name="round">
                <?php foreach($rounds as $row): ?>
                <option value="<?=$row['no'];?>"<?=$row['current'] ? ' selected' : ''?>><?=date('j M Y - G:i', strtotime($row['datetime']));?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="status" value="ok">
            <?php if($previous): ?>
            <input type="hidden" name="previous" value="<?=$previous?>">
            <?php endif; ?>
            <?php if(isset($pre_previous)): ?>
            <input type="hidden" name="pre_previous" value="<?=$pre_previous?>">
            <?php endif; ?>
            <input type="submit" class="btn" value="เช็คชื่อ">
        </form>
        <hr>
        <?php if($success == 5): ?>
        <div class="alert alert-error">
        <h4>ยกเลิกเรียบร้อยแล้ว  <?=date('j M Y - G:i', time());?></h4>
        </div>
        <?php elseif($success == 4): ?>
        <div class="alert alert-error">
        <h4>เลขประจำตัวผิด</h4>
        </div>
        <?php elseif($success == 3): ?>
        <div class="alert alert-error">
        <h4>ผิดรอบ</h4>
        </div>
        <?php elseif($success == 2): ?>
        <div class="alert alert-danger">
        <h4>มีประวัติการเข้าแล้ว</h4>
        </div>
        <?php elseif($success == 1): ?>
        <div class="alert alert-success">
        <form class="form-inline" action="<?=base_url()?>" method="POST">
        <h4>บันทึกเรียบร้อย <?=date('j M Y - G:i', time());?>
            <input type="hidden" name="id" value="<?=$graduate_info['id']; ?>">
            <input type="hidden" name="round" value="<?=$round;?>">
            <input type="hidden" name="status" value="cancel">
            <?php if($previous): ?>
            <input type="hidden" name="previous" value="<?=$previous?>">
            <?php endif; ?>
            <?php if(isset($pre_previous)): ?>
            <input type="hidden" name="pre_previous" value="<?=$pre_previous?>">
            <?php endif; ?>
            <input type="submit" class="btn btn-link" value="ยกเลิก">
        </form>
        </h4>
        </div>
        <?php elseif($success == 0): ?>
        <div class="alert alert-danger">
        <h4>ผิดพลาด</h4>
        </div>
        <?php endif; ?>
        <?php if($wrong_order): ?>
        <div class="alert alert-info">
        <h4><?=$wrong_order?></h4>
        </div>
        <?php endif; ?>
        <?php if($graduate_info): ?>
        <div class="row-fluid profile">
            <div class="span4">
                <img src="<?=base_url()?>assets/nisit/<?=$graduate_info['image']?>.jpg" alt="<?=$graduate_info['image']?>" width="100%">
            </div>
            <div class="span5">
                <h2>ลำดับ</h2>
                <h1><?=$graduate_info['order']?></h1>
                <h3 class="name"><?=$graduate_info['name']?></h3>
                <h3><?=$graduate_info['id']?><br>คณะ<?=$graduate_info['faculty_name']?></h3>
            </div>
            <div class="span3">
                <h3>
                    ซ้อมรอบ 1 <?=$graduate_status['round1_status'] == 'ok' ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>'; ?><br>
                    ซ้อมรอบ 2 <?=$graduate_status['round2_status'] == 'ok' ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>'; ?><br>
                    รอบจริง <?=$graduate_status['round3_status'] == 'ok' ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>'; ?>
                </h3>
            </div>
        </div>
        <?php endif; ?>

<?php $this->load->view('footer', $footer_data); ?>