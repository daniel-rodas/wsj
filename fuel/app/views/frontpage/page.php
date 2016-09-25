<div class="row">
    <div class="advertisement">
        <?= Request::forge('image/advertisement/banner/', false)->execute(); ?>
    </div>
    <?= View::forge()->render('_includes/message'); ?>

</div>

<div class="row">
<rn-whats-news><h3>What's News</h3></rn-whats-news>
    <div class="col-sm-9 col-md-8 col-lg-7 ">

        <?php if (isset($content)): ?>
                <?php echo $content; ?>
            <?php endif; ?>
        <section class="secondary-stories">
            <?php echo ( isset($secondary_story) ? $secondary_story : '' );  ?>
        </section>



    </div>
    <div class="col-sm-3 col-md-2 col-lg-3 ">
        <table class="table table-condensed">
            <tr>
                <th></th>
                <th>LAST</th>
                <th>CHANGE</th>
                <th>%CHG</th>
                <th>1 Day</th>

            </tr>
            <tr>
                <td>DJIA</td>
                <td>17977.04</td>
                <td>-80.61</td>
                <td>0.45%</td>


            </tr>
            <tr>
                <td>Nasdaq</td>
                <td>4988.25</td>
                <td>-7.73</td>
                <td>0.15%</td>


            </tr>
            <tr>
                <td>FTSE 100</td>
                <td>7064.30</td>
                <td>-25.47</td>
                <td>0.36%</td>


            </tr>
            <tr>
                <td>Nikkei 255</td>
                <td>19901.11</td>
                <td>-2.78</td>
                <td>0.03%</td>


            </tr>
            <tr>
                <td>Crude Oil</td>
                <td>52.32</td>
                <td>+0.41</td>
                <td>0.79%</td>


            </tr>
        </table>

        <?php if (isset($more_news)): ?>
            <?php echo $more_news; ?>
        <?php endif; ?>

    </div>
</div>
<!-- End. Row -->

