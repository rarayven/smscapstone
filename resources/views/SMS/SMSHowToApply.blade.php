@extends('SMS.SMSMain')
@section('title')
<title>Quezon City Council Scholarship Management System</title>
@section('override')
{!! Html::style("css/stylesheet.css") !!}
{!! Html::style("css/style.css") !!}
@endsection
@section('middlecontent')
<!--contents here-->
<div class="content">
 <div class="container">
    <div class="row equal">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                 <i class="fa fa-mortar-board fa-3x fa-fw"></i>
                 <div class="text">
                    <h3>New Applicants</h3>
                </div>
            </div>
            <div class="panel-body">
                <p>Must <strong>completely</strong> fulfill the following before clicking the button below: </p>
                <ul>
                 <li>Barangay Certificate/Indigency</li>
                 <li>Latest Income Tax Return of Parents/Affidavit of Non Filing</li>
                 <li>(2 pcs.)2x2 Photo with Nameplate</li>
                 <li>(2 pcs.)Long White Folder with Cover</li>
                 <li>Birth Certificate (Xerox Copy)</li>
                 <li>Previous Grades (Xerox Copy)</li>
                 <li>Latest Registration (Xerox Copy)</li>
                 <li>FORM 138 for High School Graduate (Xerox Copy)</li>
             </ul>
             <button class="btn btn-large btn-block"><a  href="{{ url('account/apply') }}" style="color: white;">Apply Now!</a></button>    
         </div>
     </div> <!-- end of column-->
 </div>
 <div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
         <i class="fa fa-refresh fa-3x fa-fw"></i>
         <h3 class="">Renewal</h3>
     </div>
     <div class="panel-body">
        <p>Must <strong>completely</strong> fulfill the following before clicking the button below: <br><Br><Br></p>
        <ul>
         <li>Xerox copy of previous Statement of Account</li>
         <li>Xerox copy of Certificate of Scholarship</li>
         <li>Xerox copy of previous Certificate of Registration</li>
     </ul>
     <br><Br><Br>
     <button class="btn btn-large btn-block">Renew Scholarship!</button>  
 </div>
</div> <!-- end of column-->
</div>
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
         <i class="fa fa-university fa-3x fa-fw"></i>
         <h3 class="">Participating Schools</h3>
     </div>
     <div class="panel-body">
        <p>The following are the <strong>only</strong> schools being supported by the Quezon City Council Scholarship Program: </p>
        <table class="table table-condensed">
            <tr>
                <td><img src="{{ asset('img/logos/adamson.png') }}" style="width: 45px;"><p>Adamson</p></td>
                <td><img src="{{ asset('img/logos/arellano.png') }}" style="width: 45px;"><p>Arellano</p></td>
                <td><img src="{{ asset('img/logos/ateneo.png') }}" style="width: 45px;"><p>AdMU</p></td>
                <td><img src="{{ asset('img/logos/ceu.png') }}" style="width: 45px;"><p>CEU</p></td>
            </tr>
            <tr>
                <td><img src="{{ asset('img/logos/la-salle.png') }}" style="width: 45px;"><p>DLSU</p></td>
                <td><img src="{{ asset('img/logos/letran.png') }}" style="width: 45px;"><p>Letran</p></td>
                <td><img src="{{ asset('img/logos/earist.png') }}" style="width: 45px;"><p>EARIST</p></td>
                <td><img src="{{ asset('img/logos/pnu.png') }}" style="width: 45px;"><p>PNU</p></td>
            </tr>
            <tr>
                <td><img src="{{ asset('img/logos/pup.png') }}" style="width: 45px;"><p>PUP</p></td>
                <td><img src="{{ asset('img/logos/ncba.png') }}" style="width: 45px;"><p>NCBA</p></td>
                <td><img src="{{ asset('img/logos/miriam.png') }}" style="width: 45px;"><p>Miriam</p></td>
                <td><img src="{{ asset('img/logos/neu.png') }}" style="width: 45px;"><p>NEU</p></td>
            </tr>
        </table>
        <button class="btn btn-large btn-block" data-toggle="modal" data-target="#myModal">View Full List
        </button> 
        <!--- M O D A L -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Participating Schools List (continued)</h4>
                    </div>
                    <div class="modal-body">
                     <table class="table table-condensed"> <!--40 SCHOOLS-->
                         <tr>
                             <td>
                                <img src="{{ asset('img/logos/feu.png') }}" style="width: 40px;"><p>FEU</p>
                            </td>
                            <td>
                                <img src="{{ asset('img/logos/feu-fern.png') }}" style="width: 53px;"><p>FEU-FERN</p>
                            </td>
                            <td>
                                <img src="{{ asset('img/logos/feu-eac.png') }}" style="width: 40px;"><p>FEU-EAC</p>
                            </td>
                            <td>
                                <img src="{{ asset('img/logos/urs.png') }}" style="width: 37px;"><p>URS</p>
                            </td>
                            <td>
                                <img src="{{ asset('img/logos/lpu.png') }}" style="width: 48px;"><p>LPU</p>
                            </td>
                            <td>
                                <img src="{{ asset('img/logos/philsca.png') }}" style="width: 36px;"><p>PHILSCA</p>
                            </td>
                            <td>
                                <img src="{{ asset('img/logos/san-beda.png') }}" style="width: 45px;"><p>San Beda</p>
                            </td>
                        </tr>
                        <tr>
                         <td>
                            <img src="{{ asset('img/logos/feu-nrmf.png') }}" style="width: 40px;"><p>FEU-NRMF</p>
                        </td>
                        <td>
                            <img src="{{ asset('img/logos/pcu.png') }}" style="width: 40px;"><p>PCU</p>
                        </td>
                        <td>
                            <img src="{{ asset('img/logos/OLFU.png') }}" style="width: 40px;"><p>OLFU</p>
                        </td>
                        <td>
                            <img src="{{ asset('img/logos/NTC.png') }}" style="width: 40px;"><p>NTC</p>
                        </td>
                        <td>
                            <img src="{{ asset('img/logos/RTU.png') }}" style="width: 40px;"><p>RTU</p>
                        </td>
                        <td>
                            <img src="{{ asset('img/logos/nu.png') }}" style="width: 40px;"><p>NU</p>
                        </td>
                        <td>
                            <img src="{{ asset('img/logos/san-sebastian.png') }}" style="width: 40px;"><p>San<BR>Sebastian</p>
                        </td>
                    </tr>
                    <tr>
                     <td>
                        <img src="{{ asset('img/logos/sti.png') }}" style="width: 60px;"><p>STI</p>
                    </td>
                    <td>
                        <img src="{{ asset('img/logos/tip.png') }}" style="width: 40px;"><p>TIP</p>
                    </td>
                    <td>
                        <img src="{{ asset('img/logos/tua.png') }}" style="width: 40px;"><p>TUA</p>
                    </td>
                    <td>
                        <img src="{{ asset('img/logos/tup.png') }}" style="width: 40px;"><p>TUP</p>
                    </td>
                    <td>
                        <img src="{{ asset('img/logos/UE.png') }}" style="width: 40px;"><p>UE</p>
                    </td>
                    <td>
                        <img src="{{ asset('img/logos/ust.png') }}" style="width: 40px;"><p>UST</p>
                    </td>
                    <td>
                        <img src="{{ asset('img/logos/up.png') }}" style="width: 40px;"><p>UP</p>
                    </td>
                </tr>
                <tr>
                 <td>
                    <img src="{{ asset('img/logos/saci.png') }}" style="width: 40px;"><p>SACI</p>
                </td>
                <td>
                    <img src="{{ asset('img/logos/mcu.png') }}" style="width: 40px;"><p>MCU</p>
                </td>
                <td>
                    <img src="{{ asset('img/logos/mpc.png') }}" style="width: 40px;"><p>MPC</p>
                </td>
                <td>
                    <img src="{{ asset('img/logos/bsu.png') }}" style="width: 40px;"><p>BSU</p>
                </td>
                <td>
                    <img src="{{ asset('img/logos/wcc.gif') }}" style="width: 60px;"><Br><p>WCC</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>
</div>
</div> <!-- end of column-->
</div>
</div>
</div>
</div>
@endsection
@section('endscript')
<script type="text/javascript">
 $.backstretch("../../img/backgrounds/1apply.jpg");
</script>
@endsection
