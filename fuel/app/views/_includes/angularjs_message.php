<div ng-controller="MessageController as MC">
    <alert ng-repeat="alert in alerts" type="{{MC.alert.type}}" close="MC.closeAlert($index)">{{MC.alert.msg}}</alert>
<!--    <button class='btn btn-default' ng-click="MC.addAlert()">Add Alert</button>-->
</div>
