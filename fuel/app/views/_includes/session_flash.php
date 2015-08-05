
        <?php if (Session::get_flash('success')): ?>
            <div class="alert alert-success">
                <strong>Success</strong>
                <p>
                    <?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
                </p>
            </div>
        <?php endif; ?>
        <?php if (Session::get_flash('error')): ?>
            <div class="alert alert-danger">
                <strong>The sky is falling !</strong>
                <p>
                    <?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
                </p>
            </div>
        <?php endif; ?>

        <?php if (Session::get_flash('warning')): ?>
            <div class="alert alert-warning">
                <strong>Warning</strong>
                <p>
                    <?php echo implode('</p><p>', e((array) Session::get_flash('warning'))); ?>
                </p>
            </div>
        <?php endif; ?>

