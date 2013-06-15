<?php $this->load->view('header', $header_data); ?>
                <pre>
                    TODO:
                    - หา javascript มาเช็คว่ากรอกข้อมูลแล้วทุกช่อง ถ้ากรอกไม่ครบไม่ให้ submit form (สำคัญมาก**)
                    - javascript datepicker วันเกิด (jqueryui)
                    - หาสคริบสำหรับอัพโหลดรูป (ปรึกษานัท)
                </pre>
                <?php if($success): ?>
                <div class="alert alert-success">
                    อัพเดตข้อมูลเรียบร้อยแล้ว
                </div>
                <?php endif; ?>
                <form action="<?=base_url()?>profile/edit/?step=<?=$step?>" method="POST" class="form-horizontal">
                    <?php
                    var_dump($fields); //FOR DEBUGGING
                    foreach($fields as $field): 
                        switch ($field['type']) {
                        case 'email':
                            $type = 'type="email"';
                            break;
                        case 'text-medium':
                            $type = 'type="text"';
                            break;
                        case 'text-large':
                            $type = 'type="text" class="input-xxlarge"';
                            break;
                        case 'password':
                            $type = 'type="password"';
                            break;
                        case 'file':
                            $type = 'type="text"';
                            break;
                        case 'datepicker':
                            $type = 'type="text" class="datepicker"';
                            break;
                        default:
                            $type = 'type="text"';
                        }
                    ?>
                    <div class="control-group">
                        <label class="control-label" for="<?=$field['profile_name']?>"><?=$field['displayname']?></label>
                        <div class="controls">
                            <?php if($field['type'] == 'textarea-long'): ?>
                            <textarea name="<?=$field['profile_name']?>" id="<?=$field['profile_name']?>" cols="30" rows="10"></textarea>
                            <?php else: ?>
                            <input <?=$type?> name="<?=$field['profile_name']?>" id="<?=$field['profile_name']?>" value="<?=$field['value']?>" placeholder="<?=$field['default']?>"> <?=$field['description']?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <input type="hidden" name="step" value="<?=$step?>">
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" value="อัพเดต" class="btn btn-primary">
                        </div>
                    </div>
                </form>
<?php $this->load->view('footer', $footer_data); ?>