<?php $this->load->view('header', $header_data); ?>
                <?php if($error): ?>
                <div class="alert alert-error">
                    <?php 
                    if($error == 'general') echo 'กรอกข้อมูลไม่เรียบร้อย';
                    else if($error == 'id_taken') echo 'รหัสประชาชน '.$username.' ถูกใช้ในการสมัครไปแล้ว';
                    else if($error == 'email_taken') echo 'อีเมล '.$email.' ถูกใช้ในการสมัครไปแล้ว';
                    ?>
                </div>
                <?php endif; ?>
                <pre>
                    TODO:
                    - หา javascript มาเช็คว่ากรอกข้อมูลแล้วทุกช่อง ถ้ากรอกไม่ครบไม่ให้ submit form (สำคัญมาก**)
                    - javascript เช็คว่ากรอกรหัสผ่านเกิน 6 ตัวรึเปล่า
                    - javascript datepicker วันเกิด (jqueryui)
                </pre>
                <form action="<?=base_url()?>create" method="POST" class="form-horizontal">
                    <?php
                    //var_dump($fields); //FOR DEBUGGING
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
                            <input <?=$type?> name="<?=$field['profile_name']?>" id="<?=$field['profile_name']?>" placeholder="<?=$field['default']?>"> <?=$field['description']?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" value="สมัคร" class="btn btn-primary">
                        </div>
                    </div>
                </form>
<?php $this->load->view('footer', $footer_data); ?>