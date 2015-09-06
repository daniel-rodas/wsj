
<nav ng-controller="NavigationController as NC" id="navigation-user">
    <ul class="nav navbar-right nav-pills">

        <li><a  ng-click="NC.open('section-menu')">

                Sections <span  class="glyphicon glyphicon-th-list" aria-hidden="true"></span> </a></li>
        <?= $userOptions ?>


        <li  dropdown on-toggle="toggled(open)">
            <a href id="simple-dropdown" dropdown-toggle>
                <span class="glyphicon glyphicon-cog"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="simple-dropdown">
                <li><a href="#">Language</a></li>
                <li><a href="#">Type Size</a></li>
                <li class="divider"></li>
                <li><a href="#">Share</a></li>
            </ul>
        </li>
    </ul>
    <?= View::forge()->render('header/modal'); ?>

</nav>



