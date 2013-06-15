<?php $this->load->view('header', $header_data); ?>
<?php //var_dump($current); ?>
        <form action="<?=base_url()?>index.php/absence" method="GET">
            <div class="row-fluid">
                <div class="span4">
                    <input type="checkbox" class="rowfilter" id="mark1" name="mark1" value="1"<?=isset($current['mark1']) ? ' checked' : ''?>> ขาดวันที่ 1<br>
                    <input type="checkbox" class="rowfilter" id="mark2" name="mark2" value="2"<?=isset($current['mark2']) ? ' checked' : ''?>> ขาดวันที่ 2<br>
                    <input type="checkbox" class="rowfilter" id="mark3" name="mark3" value="3"<?=isset($current['mark3']) ? ' checked' : ''?>> ขาดวันที่ 3
                </div>
                <div class="span4">
                    <select name="faculty_name">
                        <option value="">คณะ</option>
                        <?php foreach($faculties as $row): ?>
                        <option value="<?=$row['name'];?>"<?=$current['faculty_name'] == $row['name'] ? ' selected' : '';?>><?=$row['name'];?></option>
                        <?php endforeach; ?>
                    </select><br>
                    ลำดับ <input type="text" class="input-small" name="from" value="<?=$current['from'] ? $current['from'] : '';?>" placeholder="1"> - 
                    <input type="text" class="input-small" name="to" value="<?=$current['to'] ? $current['to'] : '';?>" placeholder="100">
                </div>
                <div class="span4">
                    <select name="round">
                        <option value="">รอบ</option>
                        <?php foreach($rounds as $row): ?>
                        <option value="<?=$row['datetime'];?>"<?=$current['round'] == $row['datetime'] ? ' selected' : '';?>><?=date('j M Y - G:i', strtotime($row['datetime']));?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </div>
            </div>
        </form>
        <hr>
        <table id="list-table" class="table table-striped">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>เลขนิสิต</th>
                    <th>ชื่อ นามสกุล</th>
                    <th>คณะ</th>
                    <th width="5%">รอบ 1</th>
                    <th width="5%">รอบ 2</th>
                    <th width="5%">จริง</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($graduates as $row): ?>
            <?php
                $status_class = '';
                if($row['round1_status'] == 'ok') $status_class .= ' round1';
                if($row['round2_status'] == 'ok') $status_class .= ' round2';
                if($row['round3_status'] == 'ok') $status_class .= ' round3';
            ?>
                <tr <?php if($status_class) echo 'class="'.$status_class.'"';?>>
                    <td><?=$row['order'];?></td>
                    <td><?=$row['id'];?></td>
                    <td><?=$row['name'];?></td>
                    <td><?=$row['faculty_name'];?></td>
                    <td><a title="<?=date('j M Y - G:i', strtotime($row['round1_date']));?>"><i class="icon-check<?=$row['round1_status'] == 'ok' ? '' : '-empty'; ?>"></i></a></td>
                    <td><a title="<?=date('j M Y - G:i', strtotime($row['round2_date']));?>"><i class="icon-check<?=$row['round2_status'] == 'ok' ? '' : '-empty'; ?>"></i></a></td>
                    <td><a title="<?=date('j M Y - G:i', strtotime($row['round3_date']));?>"><i class="icon-check<?=$row['round3_status'] == 'ok' ? '' : '-empty'; ?>"></i></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

<?php $this->load->view('footer', $footer_data); ?>