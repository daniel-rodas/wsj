


<?php if ($balance): ?>
    <div class="row">

        <div class="col-md-6  col-md-offset-3" id="profile" style="margin-top: 25px;">
            <?php echo '<p> Balance : ' . $balance . 'G </p>'; ?>

    <?php if ($wallet): ?>

        <?php foreach ($wallet as $item): ?>
            <?php foreach ($item->addresses as $add): ?>
                <?php echo '<p>' . $add->coin . ' Address : ' . $add->address . ' </p>'; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No Wallet Setup Please Contact Support.</p>

    <?php endif; ?>

            <p class="text-center">If you're experiencing any difficulties or delays in your account being credited please call
                <strong><em>520-955-8113</em></strong>
            </p>
        </div><!-- End. class="col-md-6" id="profile" -->
    </div><!-- End Row -->
<?php else: ?>
    <p>No Balances.</p>

<?php endif; ?>