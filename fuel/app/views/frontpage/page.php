<div class="row">
    <div class="advertisement">
        <?= Request::forge('image/advertisement/banner/', false)->execute(); ?>
    </div>
    <?= View::forge()->render('_includes/message'); ?>

</div>

        <div class="row">
            <div ng-controller="whatsNewsController" id="whats-news-column" class=" col-md-2 col-lg-2  " >
                <h3 ng-click="changeClass()" class="h3">What's News &#8212;</h3>
                <section ng-class="class">

                    <h4>Economy’s Supply Side Sputters</h4>
                    <p>Capital Account: WSJ columnist Greg Ip finds that supply-side troubles have replaced demand problems as the biggest threat to the U.S. economy. 53 min ago</p>
                    <h4>Samsung Makes Move Into Mobile Payments</h4>
                    <p>Samsung acquired a U.S. startup whose technology is likely to underpin the South Korean technology giant’s new mobile payment service. How LoopPay Works</p>
                    <h4>Virtu Financial Restarting IPO Process</h4>
                    <p>Virtu Financial Inc., one of the world’s biggest high-frequency trading firms, is reviving its plan to go public, according to people familiar with the matter. 16 min ago</p>
                    <h4> EU to Press Monopoly Case Against Gazprom</h4>
                    <p>European Union Competition Commissioner Margrethe Vestager said the EU will soon move ahead with an antimonopoly case against Russian energy company Gazprom OAO despite the UKraine crisis.
                        Transcript | Vestager Interview</p>
                    <h4>Prosecutor Probes HSBC’s Swiss Unit in Money-Laundering Case</h4>
                    <p>The Geneva public prosecutor’s office has begun a search of the offices of U.K. banking giant HSBC’s Swiss unit as part of a probe into alleged money-laundering activities.</p>
                </section>

            </div>
            <div class="col-sm-9 col-md-8 col-lg-7 " >

                <?php if (isset($content)): ?>
                        <?php echo $content; ?>
                    <?php endif; ?>
                <section class="secondary-stories">
                    <?php echo ( isset($secondary_story) ? $secondary_story : '' );  ?>
                </section>



            </div>
            <div class="col-sm-3 col-md-2 col-lg-3 " >





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

