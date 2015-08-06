<nav  ng-controller="HeaderController" id="navigation-user">
<!--<nav  style="width: 100px; background-color: red;">-->


    <ul class="nav navbar-right nav-pills">

        <li><a  ng-click="open('section-menu')">

                Sections <span  class="glyphicon glyphicon-th-list" aria-hidden="true"></span> </a></li>
        <?= $userOptions ?>


        <li role="presentation" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Language</a></li>
                <li><a href="#">Type Size</a></li>
                <li class="divider"></li>
                <li><a href="#">Share</a></li>
            </ul>
        </li>
    </ul>
    <?= View::forge()->render('header/modal'); ?>

</nav>



