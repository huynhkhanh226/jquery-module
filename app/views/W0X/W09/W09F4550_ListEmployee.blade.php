@foreach($detail as $row)
    <div class="row mgb5" id="listEmp">
        <div class="col-md-2 text-center listEmpPic" empid="{{$row['EmployeeID']}}">
            <div style="height: 100px;width: 80px;border: solid 1px gray;margin: auto">
                <i class="fa fa-refresh fa-spin" style="margin-top: 50%"></i>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="liketext text-blue">
                        <label><b>{{$row['EmployeeName']}}</b></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="liketext text-blue">
                        <label><b>{{$row['EmployeeID']}} </b></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="liketext">
                        <label><b>{{$row['DutyName']}}</b></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="liketext">
                        <label><b>{{$row['DepartmentName']}} </b></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="liketext">
                        <i class="fa fa-mobile-phone"></i><label>&nbsp;<b>{{$row['Pager']}}</b></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="liketext">
                        <i class="fa fa-phone"></i><label>&nbsp;<b>{{$row['CompanyTelephone']}}</b></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="liketext">
                        <i class="fa fa-envelope"></i><label>&nbsp;<b>{{$row['Email']}}</b></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mgt5">
            <div class="row" style="margin-left:-5px;width: 80%; margin-top: 10px;">
                <div class="col-md-12 text-center clfontsize" style="position: relative">
                    <label class="text-aqua" style="position: absolute; bottom: -8px;  font-size: 125%; ">{{$row['Age']}}</label>
                </div>
            </div>
            <div class="row bg-aqua-active" style="margin-left:5%;width: 80%;margin-top:0 !important; ">
                <div class="col-md-12 text-center clfontsize pdt10 bdt">
                    <i class="fa fa-yelp"></i><i class="fa fa-yelp"></i><i class="fa fa-yelp"></i>
                </div>
            </div>
            <div class="row bg-aqua-active" style="margin-right: 0px">
                <div class="col-md-12 text-center clfontsize pdt10 bdt">
                    <label>{{$row['Birthdate']}}</label>
                </div>
            </div>
        </div>
    </div>
@endforeach