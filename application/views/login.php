<?php $this->load->view('header', $header_data); ?>
                <?php if($error): ?>
                <div class="alert alert-error">
                    Invalid username/password
                </div>
                <?php endif; ?>
                <form action="<?=base_url()?>login" method="POST">
                    <p>
                        <label>Email:</label>
                        <input type="text" name="email">
                        <label>Password:</label>
                        <input type="password" name="password">
                    </p>
                    <p>
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </p>
                </form>
<?php $this->load->view('footer', $footer_data); ?>